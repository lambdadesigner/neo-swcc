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
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">
									<div class="panel-heading">
										<h3 class="panel-title text-red"><i class="fa fa-pencil fa-lg"></i> Marks
											
										</h3>
										<hr>
									</div>
									<div id="myElem" class="alert alert-success" role="alert"  style="display:none">Marks Added Successfull</div>
									<!-- Content Here-->
									
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">
									<div class="panel-heading">
										<!-- <h3 class="panel-title">Users</h3>
										<a href="AdminAddMarks.php" class="btn btn-success btn-lg pull-right">ADD</a> -->
										<div class="pull-right">
											<button class="btn btn-xs btn-primary" id="addM"><span id="add">ADD</span><span id="view" style="display:none;">View All Records</span></button>
										</div>
										
									</div>
									<table class="table table-striped" id="marks">
										<thead>
											<tr class="filters">
												<th>Test ID</th>
												<th>Student ID</th>
												<th>Marks</th>
												<th>User ID</th>
												<th>Instructor ID</th>
												<th>Entered By</th>
												<th>Modified By</th>
												<th>Update</th>
											</tr>
										</thead>
										<tbody>

										<?php 
										$sql = "SELECT * FROM Marks";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										while($row = sqlsrv_fetch_array($result)){ ?>
											<tr>
												<td><?php echo $row['TestID']?></td>
												<td><?php echo $row['StudentID']?></td>
												<td><?php echo $row['Marks']?></td>
												<td><?php echo $row['UserID']?></td>
												<td><?php echo $row['InstructorID']?></td>
												<td><?php echo $row['EnteredBy']?></td>
												<td><?php echo $row['ModifiedBy']?></td>
												<td><a href="AdminEditMarks.php?TestID=<?php echo $row['TestID']?>&StudentID=<?php echo $row['StudentID']?>">Edit</a></td>
											</tr>
										<?php }?>
											
											
										</tbody>
									</table>
						
						<!--Adding Marks-->
								<div id="addmarks" style="display:none;">
									<!--<form  action="AdminAddMarks.php" method="POST">-->
										<div class="col-md-8">
										<label class="control-label">Test ID* </label>
										<input maxlength="100" type="text" required="required"  name="TestID" id="TestID" class="form-control" placeholder="Enter Test ID" value=""  />
										</div>
										
										<div class="col-md-8">
										<label class="control-label">Student ID*</label>
										<input maxlength="100" type="text" required="required"  name="StudentID" id="StudentID" class="form-control" placeholder="Enter Student ID" value=""  />
										</div>
										
										<div class="col-md-8">
										<label class="control-label">Marks*</label>
										<input maxlength="100" type="text" required="required"  name="Marks" id="Marks" class="form-control" placeholder="Enter Marks" value=""  />
										</div>
										
										<div class="col-md-8">
										<label class="control-label">User ID*</label>
										<input maxlength="100" type="text" required="required"  name="UserID" id="UserID" class="form-control" placeholder="Enter User ID" value=""  />
										</div>
										
										<div class="col-md-8">
										<label class="control-label">Instructor ID*</label>
										<input maxlength="100" type="text" required="required"  name="InstructorID" id="InstructorID" class="form-control" placeholder="Enter Instructor ID" value=""  />
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
				</section><!-- /.content -->
									
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