<?php
include('Admin_files/includes/header.php');
$AdminId = $_SESSION['AdminId'];
$AdminUserName = $_SESSION['AdminUserName'];

										
?>
			<style>
				.filterbutton {
					float: right;
					margin-top: 3px;
					padding-left: 10px;
				}
				button.btn-filter {
					padding: 5px 10px;
					font-size: 15px;
					background: #1caf9a;
					color: white;
				}
			</style>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Marks
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="Admin"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-university"></i>Regular Course</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">
									<div class="panel-heading">
										<div class="note note-success">
											<p>
												 Please try to re-size your browser window in order to see the tables in responsive mode.
											</p>
										</div>
									</div>
									<div id="myElem" class="alert alert-success" role="alert"  style="display:none">Marks Added Successfully</div>
									<!-- Content Here-->
									
									<div class="panel-body sortabletable">
										<div class="row">
											<div class="filterable col-md-12">
												<!-- <div class="panel-heading">
													<h3 class="panel-title">Users</h3>
													<a href="AdminAddMarks.php" class="btn btn-success btn-lg pull-right">ADD</a>
												</div> -->
												<?php
												if(isset($_POST['AddMarks'])){
												echo $sql = "INSERT INTO Marks(TestID,StudentID,Marks,UserID,InstructorID,EnteredBy)VALUES('".$_POST['TestID']."','".$_POST['StudentID']."','".$_POST['Marks']."','".$_POST['UserID']."','".$_POST['InstructorID']."','".$AdminId."')";
												$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												}?>
												<!-- Add Marks Start -->
												<div class="" id="addmarks"><!-- style="display:none;" -->
													<div class="col-md-12">
														<div class="border" id="myModalss">														  
														    <div class="modal-contents">
														      	<div class="modal-header">									        
														        	<h3 class="modal-title" id="myModalLabel">Add Marks</h3>
														      	</div><br>
                                                                <form name="Adminmarks" id="Adminmarks" action="" method="post">
														      	<div class="row modal-body">
															      	<div class="col-md-6">
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Test ID<span style="color:red;">*</span>
																			</div>
																			<div class="col-md-8">															
																				<input maxlength="100" type="text" required="required"  name="TestID" id="TestID" class="form-control" placeholder="Enter Test ID" value="" required="required" />
																			</div>
																		</div><br>
																      	<div class="row">
																			<div class="col-md-3 text-right">
																				Student ID<span style="color:red;">*</span>
																			</div>
																			<div class="col-md-8">									
																				<input maxlength="100" type="text" required="required"  name="StudentID" id="StudentID" class="form-control" placeholder="Enter Student ID" value="" required="required" />												
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Marks<span style="color:red;">*</span>
																			</div>
																			<div class="col-md-8">															
																				<input maxlength="100" type="text" required="required"  name="Marks" id="Marks" class="form-control" placeholder="Enter Marks" value="" required="required"/>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div class="row">
																			<div class="col-md-3 text-right">
																				User ID<span style="color:red;">*</span>
																			</div>
																			<div class="col-md-8">										
																				<input maxlength="100" type="text" required="required"  name="UserID" id="UserID" class="form-control" placeholder="Enter User ID" value="" required="required"   />
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Instuctor ID<span style="color:red;">*</span>
																			</div>
																			<div class="col-md-8">
																				<input maxlength="100" type="text" required="required"  name="InstructorID" id="InstructorID" class="form-control" placeholder="Enter Instructor ID" value="" required="required"  />
																			</div>
																		</div><br>
																	</div>
																	<br>
																</div>
                                                                <input type="submit" name="AddMarks" id="AddMarks" value="Add Marks" class="btn btn-default btn-lg pull-right">						
                                                                </form>
																<div class="clearfix"></div>
																<div class="modal-footer">
																	
																</div>
														    </div>
														</div>
													</div>
												</div>
												<!-- End AddMarks -->
												<div class="clearfix"></div>
												<br>
												<div class="col-md-12">
													<div class="panel panel-success">
														<div class="panel-heading">
															<h3 class="panel-title">Check Marks and search</h3>
														</div>
														<div class="panel-body">
															<div class="tab-content panel-body" id="marksRows">		
																<table class="table table-striped" id="marks">
																	<thead>
																		<tr class="filters">
																			<th>S.No</th>
																			<th><input type="text" class="form-control" placeholder="Test ID" ></th>
																			<th><input type="text" class="form-control" placeholder="Student ID" ></th>
																			<th><input type="text" class="form-control" placeholder="Marks" ></th>
																			<th><input type="text" class="form-control" placeholder="User ID" ></th>
																			<th><input type="text" class="form-control" placeholder="Instructor ID" ></th>
																			<th><input type="text" class="form-control" placeholder="Entered By" ></th>
																			<th><input type="text" class="form-control" placeholder="Modified By" ></th>
																			<th></th>
																		</tr>
																	</thead>
																	<tbody>

																	<?php $swe=1;
																	$sql = "SELECT TOP 100 * FROM Marks";
																	$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																	while($row = sqlsrv_fetch_array($result)){ ?>
																		<tr>
																			<td><?php echo $swe;?></td>
																			<td><?php echo $row['TestID']?></td>
																			<td><?php echo $row['StudentID']?></td>
																			<td><?php echo $row['Marks']?></td>
																			<td><?php echo $row['UserID']?></td>
																			<td><?php echo $row['InstructorID']?></td>
																			<td><?php echo $row['EnteredBy']?></td>
																			<td><?php echo $row['ModifiedBy']?></td>
																			<td><a href="AdminEditMarks.php?TestID=<?php echo $row['TestID']?>&StudentID=<?php echo $row['StudentID']?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a></td>
																		</tr>
																	<?php $swe++; }?>

																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.2.0
				</div>
				<strong>Copyright &copy; 2014-2015 <a href="#SWCC">SWCC Dashboard</a>.</strong> All rights reserved.
			</footer>

			<!-- Add the sidebar's background. This div must be placed
					 immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		<script>
		$(document).ready(function() {
			    $('#marks').DataTable( {
			    } );
				
				$('#addM').click(function(){
					//$('#marks_wrapper').fadeToggle('slow');
					$('#addmarks').fadeToggle('fast');
					$('#view').toggle();
					$('#add').toggle();
				});				
				
				$('#save').click(function(){
					var TestID = $('#TestID').val();
						if(TestID==""){
							alert("Please Enter The Required Field");
							$("#TestID").focus();
							return true;
						}
					var StudentID = $('#StudentID').val();
					if(StudentID==""){
							alert("Please Enter The Required Field");
							$("#StudentID").focus();
							return true;
						}
					var Marks = $('#Marks').val();
					if(Marks==""){
							alert("Please Enter The Required Field");
							$("#Marks").focus();
							return true;
						}
					var UserID = $('#UserID').val();
					if(UserID==""){
							alert("Please Enter The Required Field");
							$("#UserID").focus();
							return true;
						}
					var InstructorID = $('#InstructorID').val();
					if(InstructorID==""){
							alert("Please Enter The Required Field");
							$("#InstructorID").focus();
							return true;
						}
					$.ajax({
				   type: "GET",
				   url: "AdminAddMarks.php",
				   data: {"TestID": TestID, "StudentID": StudentID, "Marks": Marks, "UserID": UserID,"InstructorID": InstructorID},
				   success: function(msg){
					 //alert( "Data Saved: " + msg ); //Anything you want
					 $("#addmarks").hide();
					$("#marks_wrapper").show();
					$("#myElem").show();
					setTimeout(function() { $("#myElem").hide(); }, 5000);
				   }
				 });
					return false;
				});
			} );
		</script>
		<?php 
			include("Admin_files/includes/footer.php")
		?>
		<script type="text/javascript">
			$(window).load(function(){
				$('a.paginate_button.current').attr('style', 'color: #fff !important');
			})
		</script>