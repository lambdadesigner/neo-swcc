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
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-default"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-default"></i> Profile</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">
									<div class="panel-heading">
										<h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Short Course Marks
											<div class="pull-right">
												<button class="btn btn-default" id="addM"><span id="add"><i class="fa fa-plus"></i> ADD</span><span id="view" style="display:none;">View All Records</span></button>
											</div>
										</h3>
										<hr>
									</div>
									<div id="myElem" class="alert alert-success" role="alert"  style="display:none">Marks Added Successfull</div>
										<div class="panel-body border">
											<table class="table table-striped" id="marks">
												<thead>
													<tr class="filters">
														<th>Short Course ID</th>
														<th>Employee ID</th>
														<th>Attendance</th>
														<th>Activities</th>
														<th>Participation</th>
														<th>Exam</th>
														
														<th>Update</th>
													</tr>
												</thead>
												<tbody>

												<?php 
												$sql = "SELECT * FROM SCMarks";
												$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												while($row = sqlsrv_fetch_array($result)){ ?>
													<tr>
														<td><?php echo $row['SCID']?></td>
														<td><?php echo $row['EmpID']?></td>
														<td><?php echo $row['Attendance']?></td>
														<td><?php echo $row['Activities']?></td>
														<td><?php echo $row['Participation']?></td>
														<td><?php echo $row['Exam']?></td>
														
														<td class="text-center"> <a href="AdminEditSCMarks.php?EmpID=<?php echo $row['EmpID']?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a></td>
													</tr>
												<?php }?>
													
													
												</tbody>
											</table>
										</div>
										<div class="row">
											<div class="col-md-6 col-md-offset-3">
												<!--Adding Marks-->
												<div id="addmarks" style="display:none;">
													<!--<form  action="AdminAddMarks.php" method="POST">-->
														<div class="col-md-8">
														<label class="control-label">Short Course ID* </label>
														<input maxlength="100" type="text" required="required"  name="SCID" id="SCID" class="form-control" placeholder="Enter Short Course ID" value=""  />
														</div>
														
														<div class="col-md-8">
														<label class="control-label">Employee ID*</label>
														<input maxlength="100" type="text" required="required"  name="EmpID" id="EmpID" class="form-control" placeholder="Enter Employee ID" value=""  />
														</div>
														
														<div class="col-md-8">
														<label class="control-label">Attendance*</label>
														<input maxlength="100" type="text" required="required"  name="Attendance" id="Attendance" class="form-control" placeholder="Enter Attendance" value=""  />
														</div>
														
														<div class="col-md-8">
														<label class="control-label">Activities*</label>
														<input maxlength="100" type="text" required="required"  name="Activities" id="Activities" class="form-control" placeholder="Enter Activities" value=""  />
														</div>
														
														<div class="col-md-8">
														<label class="control-label">Participation*</label>
														<input maxlength="100" type="text" required="required"  name="Participation" id="Participation" class="form-control" placeholder="Enter Participation" value=""  />
														</div>
														
														<div class="col-md-8">
														<label class="control-label">Exam*</label>
														<input maxlength="100" type="text" required="required"  name="Exam" id="Exam" class="form-control" placeholder="Enter Exam" value=""  />
														</div>
														
														<div class="col-md-8">
																																			
														<input type="submit" name="save" id="save" value="Save" class="btn btn-success btn-lg pull-right">						
														</div>
													
													<!--</form>-->
												</div>
												<!--End Add Marks-->
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
					$('#marks_wrapper').fadeToggle('slow');
					$('#addmarks').fadeToggle('fast');
					$('#view').toggle();
					$('#add').toggle();
				});				
				
				$('#save').click(function(){
					var SCID = $('#SCID').val();
					
					if(SCID==""){
							alert("Please Enter The Required Field");
							$("#SCID").focus();
							return true;
						}
					
					var EmpID = $('#EmpID').val();
					if(EmpID==""){
							alert("Please Enter The Required Field");
							$("#EmpID").focus();
							return true;
						}
					var Attendance = $('#Attendance').val();
					if(Attendance==""){
							alert("Please Enter The Required Field");
							$("#Attendance").focus();
							return true;
						}
					var Activities = $('#Activities').val();
					if(Activities==""){
							alert("Please Enter The Required Field");
							$("#Activities").focus();
							return true;
						}
					var Participation = $('#Participation').val();
					if(Participation==""){
							alert("Please Enter The Required Field");
							$("#Participation").focus();
							return true;
						}
					var Exam = $('#Exam').val();
					if(Exam==""){
							alert("Please Enter The Required Field");
							$("#Exam").focus();
							return true;
						}
					
					$.ajax({
				   type: "GET",
				   url: "AdminAddSCMarks.php",
				   data: {"SCID": SCID, "EmpID": EmpID, "Attendance": Attendance, "Activities": Activities,"Participation": Participation,"Exam": Exam},
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