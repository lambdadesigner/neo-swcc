<?php
include('Admin_files/includes/header.php');
$AdminId = $_SESSION['AdminId'];
$AdminUserName = $_SESSION['AdminUserName'];
$EmpID = $_GET['EmpID'];
if(isset($_POST['update'])){
		
		  $SCID = $_POST['SCID'];
		  $EmpID = $_POST['EmpID'];
		  $Attendance = $_POST['Attendance'];
		  $Activities=$_POST['Activities'];
		  $Participation = $_POST['Participation'];
		  $Exam = $_POST['Exam'];
		
	
	 $sql1 = "UPDATE SCMarks
        SET SCID='$SCID',EmpID ='$EmpID',Attendance='$Attendance',Activities='$Activities',Participation='$Participation',Exam='$Exam'
         WHERE EmpID ='$EmpID' ";
		 $result1 = sqlsrv_query( $conn, $sql1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
		 echo "Record updated successfull";
		

}

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
										<h3 class="panel-title text-red"><i class="fa fa-pencil fa-lg"></i> Marks</h3>
										
										
										
									</div>
									<?php
										$sql = "SELECT * FROM SCMarks WHERE EmpID ='$EmpID'";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										$row = sqlsrv_fetch_array($result);
									?>
									<!-- Content Here-->
									<form  action="" method="POST">
									<div class="col-md-8">
									<label class="control-label">Short Course ID </label>
									<input maxlength="100" type="text" required="required"  name="SCID" id="SCID" class="form-control" placeholder="Enter Test ID" value="<?php echo $row['SCID'] ;?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Employee ID</label>
									<input maxlength="100" type="text" required="required"  name="EmpID" id="EmpID" class="form-control" placeholder="Enter Student ID" value="<?php echo $EmpID;?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Attendance</label>
									<input maxlength="100" type="text" required="required"  name="Attendance" id="Attendance" class="form-control" placeholder="Enter Marks" value="<?php echo $row['Attendance'];?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Activities</label>
									<input maxlength="100" type="text" required="required"  name="Activities" id="Activities" class="form-control" placeholder="Enter User ID" value="<?php echo $row['Activities'];?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Participation</label>
									<input maxlength="100" type="text" required="required"  name="Participation" id="Participation" class="form-control" placeholder="Enter Instructor ID" value="<?php echo $row['Participation'];?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Exam</label>
									<input maxlength="100" type="text" required="required"  name="Exam" id="Exam" class="form-control" placeholder="Enter Instructor ID" value="<?php echo $row['Exam'];?>"  />
									</div>
									
									<div class="col-md-8">
																														
									<input type="submit" name="update" id="update" value="Update" class="btn btn-success btn-lg pull-right">						
									</div>
									
									</form>
									<!-- End Content Here-->
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

		<?php 
	include("Admin_files/includes/footer.php")
?>