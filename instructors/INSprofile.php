<?php 
include('includes/header.php');
include('../includes/database.php');
//print_r($_SESSION);
$InstructorID = $_SESSION['InstructorID'];

if($_SESSION['InstructorID']==''){	
	 header("Location: ../index"); 
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
						Profile
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>
					<?php 
						$sql ="SELECT * FROM Instructors WHERE InstructorID='$InstructorID'";
						$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										
						$row = sqlsrv_fetch_array($result)
						
						
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
										<img src="../assets/images/sample-student.png" class="img-circle">
										<div class="clearfix"></div>
										<h2 class="title" data-toggle="tooltip" data-placement="top" title="Student Name"> <?php  echo $row['InstructorName'];?></h2>
										<h4 class="student-id" data-toggle="tooltip" data-placement="top" title="Student ID"></h4>
										<hr>
										<table class="table-responsive">
											<tr>
												<td>Employee ID:</td>
												<td><?php  echo $row['EmployeeID'];?></td>
											</tr>
											<tr>
												<td>Instructor Name:</td>
												<td><?php  echo $row['InstructorName'];?></td>
											</tr>
											<tr>
												<td>Form ID:</td>
												<td><?php  echo $row['FormID'];?></td>
											</tr>
											<tr>
												<td>Process ID:</td>
												<td><?php  echo $row['processID'];?></td>
											</tr>
											<tr>
												<td>Abr:</td>
												<td><?php  echo $row['Abr'];?></td>
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

			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Create the tabs -->
				<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
					<li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

					<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<!-- Home tab content -->
					<div class="tab-pane" id="control-sidebar-home-tab">
						<h3 class="control-sidebar-heading">Recent Activity</h3>
						<ul class="control-sidebar-menu">
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-birthday-cake bg-red"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Langdons Birthday</h4>
										<p>Will be 23 on April 24th</p>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-user bg-yellow"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
										<p>New phone +1(800)555-1234</p>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
										<p>nora@example.com</p>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<i class="menu-icon fa fa-file-code-o bg-green"></i>
									<div class="menu-info">
										<h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
										<p>Execution time 5 seconds</p>
									</div>
								</a>
							</li>
						</ul><!-- /.control-sidebar-menu -->

						<h3 class="control-sidebar-heading">Tasks Progress</h3>
						<ul class="control-sidebar-menu">
							<li>
								<a href="javascript::;">
									<h4 class="control-sidebar-subheading">
										Custom Template Design
										<span class="label label-danger pull-right">70%</span>
									</h4>
									<div class="progress progress-xxs">
										<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<h4 class="control-sidebar-subheading">
										Update Resume
										<span class="label label-success pull-right">95%</span>
									</h4>
									<div class="progress progress-xxs">
										<div class="progress-bar progress-bar-success" style="width: 95%"></div>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<h4 class="control-sidebar-subheading">
										Laravel Integration
										<span class="label label-warning pull-right">50%</span>
									</h4>
									<div class="progress progress-xxs">
										<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
									</div>
								</a>
							</li>
							<li>
								<a href="javascript::;">
									<h4 class="control-sidebar-subheading">
										Back End Framework
										<span class="label label-primary pull-right">68%</span>
									</h4>
									<div class="progress progress-xxs">
										<div class="progress-bar progress-bar-primary" style="width: 68%"></div>
									</div>
								</a>
							</li>
						</ul><!-- /.control-sidebar-menu -->

					</div><!-- /.tab-pane -->
					<!-- Stats tab content -->
					<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
					<!-- Settings tab content -->
					<div class="tab-pane" id="control-sidebar-settings-tab">
						<form method="post">
							<h3 class="control-sidebar-heading">General Settings</h3>
							<div class="form-group">
								<label class="control-sidebar-subheading">
									Report panel usage
									<input type="checkbox" class="pull-right" checked />
								</label>
								<p>
									Some information about this general settings option
								</p>
							</div><!-- /.form-group -->

							<div class="form-group">
								<label class="control-sidebar-subheading">
									Allow mail redirect
									<input type="checkbox" class="pull-right" checked />
								</label>
								<p>
									Other sets of options are available
								</p>
							</div><!-- /.form-group -->

							<div class="form-group">
								<label class="control-sidebar-subheading">
									Expose author name in posts
									<input type="checkbox" class="pull-right" checked />
								</label>
								<p>
									Allow the user to show his name in blog posts
								</p>
							</div><!-- /.form-group -->

							<h3 class="control-sidebar-heading">Chat Settings</h3>

							<div class="form-group">
								<label class="control-sidebar-subheading">
									Show me as online
									<input type="checkbox" class="pull-right" checked />
								</label>
							</div><!-- /.form-group -->

							<div class="form-group">
								<label class="control-sidebar-subheading">
									Turn off notifications
									<input type="checkbox" class="pull-right" />
								</label>
							</div><!-- /.form-group -->

							<div class="form-group">
								<label class="control-sidebar-subheading">
									Delete chat history
									<a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
								</label>
							</div><!-- /.form-group -->
						</form>
					</div><!-- /.tab-pane -->
				</div>
			</aside><!-- /.control-sidebar -->
			<!-- Add the sidebar's background. This div must be placed
					 immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<!-- jQuery 2.1.4 -->
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Swcc App -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
		<!-- Swcc for demo purposes -->

<?php include('includes/footer.php') ?>
	</body>
</html>
