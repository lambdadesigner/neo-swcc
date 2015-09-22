<?php 
include('Admin_files/includes/header.php');
//print_r($_SESSION);
$AdminID = $_SESSION['AdminId'];
if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}

?>
<style type="text/css">
	.BoldText{
		font-weight: bolder;
	}
</style>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<?php echo $lang['profile'];?>
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i><?php echo $lang['Home']?> </a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> <?php echo $lang['profile'];?></a></li>
					</ol>
				</section>
					<?php 
						$querys =	"SELECT * FROM AdminInfo WHERE AdminId='Adm001'";
						$result_users = sqlsrv_query( $conn, $querys ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

						$row = sqlsrv_fetch_array($result_users)
						
						
						?>
	  
   
				<!-- Main content -->
				
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="panel profile-bg">
								<div class="panel-heading">
									<h3 class="panel-title"> 	</h3>
									<div class="pull-right">
										<!--<a href="#Fakelink">Arabic </a> / <a href="#Fakelink">English</a>-->
									</div>
								</div>
								<hr>
								<div class="panel-body">
									<div class="profile-body">
										<img src="assets/images/sample-student.png" class="img-circle">
										<div class="clearfix"></div>
										<h2 class="title" data-toggle="tooltip" data-placement="top" title="Student Name"> <?php  echo $row['AFullName_en'];?></h2>
										<h4 class="student-id" data-toggle="tooltip" data-placement="top" title="Student ID"></h4>
										<hr>
										<table class="table-responsive">
											<tr>
												<td>Admin ID</td>
												<td>: <?php  echo $row['AdminId'];?></td>
											</tr>
											<tr>
												<td>Admin UserName</td>
												<td>: <?php  echo $row['AdminUserName'];?></td>
											</tr>
											<tr>
												<td>First Name</td>
												<td>: <?php  echo $row['AFirstName_en'];?></td>
											</tr>
											<tr>
												<td>Last Name</td>
												<td>: <?php  echo $row['ALastName_en'];?></td>
											</tr>
											<tr>
												<td>DOB</td>
												<td>: <?php  echo $row['DoB'];?></td>
											</tr>
											<tr>
												<td>Full Name</td>
												<td>: <?php  echo $row['AFullName_en'];?></td>
											</tr>
											<tr>
												<td class="BoldText">Mobile</td>
												<td>: <?php  echo $row['Mobile'];?></td>
											</tr>

										</table>
									</div>
								</div>
							</div>							
						</div>
					</div>
				</section>
						
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

		<!-- jQuery 2.1.4 
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>-->
		<!-- Bootstrap 3.3.2 JS 
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->

<?php include('Admin_files/includes/footer.php') ?>
	</body>
</html>
