<?php
include('Admin_files/includes/header.php');
$AdminId = $_SESSION['AdminId'];
$AdminUserName = $_SESSION['AdminUserName'];
 $TestID = $_GET['TestID'];
 $StudentID = $_GET['StudentID'];
 
if(isset($_POST['update'])){
		
		$TestID = $_POST['TestID'];
        $StudentID = $_POST['StudentID'];
		$Marks = $_POST['Marks'];
		$UserID = $_POST['UserID'];
		$InstructorID = $_POST['InstructorID'];
		
	
	 $sql1 = "UPDATE Marks
        SET TestID='$TestID',StudentID ='$StudentID',Marks='$Marks',UserID='$UserID',InstructorID='$InstructorID',ModifiedBy='$AdminId'
         WHERE TestID ='$TestID' AND StudentID ='$StudentID'";
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
										$sql = "SELECT * FROM MARKS WHERE TestID ='$TestID' AND StudentID ='$StudentID'";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										$row = sqlsrv_fetch_array($result);
									?>
									<!-- Content Here-->
									<form  action="" method="POST">
									<div class="col-md-8">
									<label class="control-label">Test ID </label>
									<input maxlength="100" type="text" required="required"  name="TestID" id="TestID" class="form-control" placeholder="Enter Test ID" value="<?php echo $TestID ;?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Student ID</label>
									<input maxlength="100" type="text" required="required"  name="StudentID" id="StudentID" class="form-control" placeholder="Enter Student ID" value="<?php echo $StudentID ;?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Marks</label>
									<input maxlength="100" type="text" required="required"  name="Marks" id="Marks" class="form-control" placeholder="Enter Marks" value="<?php echo $row['Marks'];?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">User ID</label>
									<input maxlength="100" type="text" required="required"  name="UserID" id="UserID" class="form-control" placeholder="Enter User ID" value="<?php echo $row['UserID'];?>"  />
									</div>
									
									<div class="col-md-8">
									<label class="control-label">Instructor ID</label>
									<input maxlength="100" type="text" required="required"  name="InstructorID" id="InstructorID" class="form-control" placeholder="Enter Instructor ID" value="<?php echo $row['InstructorID'];?>"  />
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