 <?php 
include('includes/header.php');
//print_r($_SESSION);
$EmpID = $_SESSION['EmpID'];

?>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Salary Certificate
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
								<div class="col-md-6 BorderRight">
									<div class="panel-heading rightborder">
										<h2 class=""><!--<i class="fa fa-plane text-green"> </i>--> Salary Statement</h2>
									</div>
									<div class="panel-body">
										<h4 class="BorderBottom" id="salarystatement">Salary Statement</h4>
										<?php 
										$sql = "select * from SCStudentInfo where EmpID = '$EmpID'";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										$row = sqlsrv_fetch_array($result)?>
										<form class="flightform" action="PDF/salarypdf.php" method="post"><!--arabpdf/salarypdf1.php-->
											<input type="hidden" class="h1" name="SalaryStatement" value="Salary Statement" />
											<input type="text" placeholder="Student ID, eg: 1091983948" id="StudentId" name="StundentId" class="input" autofocus  data-toggle="tooltip" data-placement="right" title="Student ID, eg: 1091983948" value="<?php echo $row['EmpID']?>" required>
											<input type="text" placeholder="Full Name"  data-toggle="tooltip" data-placement="right" id="FullName" name="FullName" title="Please provide your full name" value="<?php echo $row['StudentName_en']?>" required >
											<input type="text" placeholder="Affilation" data-toggle="tooltip" data-placement="right" id="Affilation" name="Affilation" title="Your college affilation" value="" required>
											<input type="text" placeholder="Job Title" data-toggle="tool

											tip" data-placement="right" id="JobTitle" name="JobTitle" title="Provide your Job title" value="<?php echo $row['JobTitle_en']?>" required>
											<input type="text" placeholder="Joining date of your job" data-toggle="tooltip" data-placement="right" id="StartJobDate" name="StartJobDate" title="Provide your Joining date of your job" value="" required>
											<input type="text" placeholder="Nationality" data-toggle="tooltip" data-placement="right" id="Nationality" name="Nationality" title="Provide your NationalId" value="" required>
											<input type="text" placeholder="Transportation" data-toggle="tooltip" data-placement="right" id="Transportation" name="Transportation" title="Provide your Full Name as per your Transportation" value="" required>
											<input type="text" placeholder="Basic Salary" data-toggle="tooltip" data-placement="right" id="BasicSalary" name="BasicSalary" title="Provide your Basic salary" value="" required>
											<input type="text" placeholder="Other Allowence" data-toggle="tooltip" data-placement="right" id="OtherAllowence" name="OtherAllowence" title="Provide your other allowence" value="" required>
											<!-- <div class="form-group">
								                <div class="icon-addon addon-sm">
								                    <input type="text" placeholder="Email" class="form-control" id="email">
								                    <label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>
								                </div>
								            </div> -->
								            <br /><br />
											
											<input type="submit" name="submit" value="Generate PDF">
										</form>
										<p class="p">
											
										</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="container-fluid">
										<div class="">
											<div class="panel-body">
												<section class="swccformbg">
													<div class="row">
														<div class="col-md-12 text-center">
															<header>
																<img src="assets/dist/img/header.png" class="img-responsive" />
															</header>
															<content class="">
																<h3>Salary Statement</h3>
																<table class="col-md-12 text-right tables">
																	<tr>
																		<td class="col-md-6">
																			<p id="StudentId"></p>
																		</td>
																		<td class="col-md-6">
																			<p id="FullName"></p>
																		</td>
																	</tr><tr>
																		<td class="col-md-6">
																			<p id="Affilation"></p>
																		</td>
																		<td class="col-md-6">
																			<p id="JobTitle"></p>
																		</td>
																	</tr><tr>
																		<td class="col-md-6">
																			<p id="StartJobDate"></p>
																		</td>
																		<td class="col-md-6">
																			<p id="Nationality"></p>
																		</td>
																	</tr><tr>
																		<td class="col-md-6">
																			<p id="Transportation"></p>
																		</td>
																		<td class="col-md-6">
																			<p id="BasicSalary"></p>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2">
																			<p id="OtherAllowence"></p>
																		</td>
																	</tr>
																</table>
																<div class="clearfix">

																</div>
																<p class="margintop text-right">تشهد المؤسسة العامة لتحلية المياه المالحة ( إدارة التشغيل والصيانة بالساحل الشرقي) أن

																	الموظف الواردة بياناته أدناه يعمل لديها وقد أعطي هذه الشهادة بناء على طلبه لتقديمها لمن 

																	يهمه الأمر دون مسئولية على المؤسسة.
																	</p>
																<div class="row margintop">
																	<div class="col-md-6">
																		مشرف شئون المتدربين
																		<br>
																		خالد بن عبد الله النعيم
																	</div>
																	<div class="col-md-6">
																		 الختم الرسمي
																	</div>
																</div>
															</content>
															<footer>
																<table class="col-md-12">
																	<tr>
																		<td class="col-md-6">
																			Attatch:
																		</td>
																		<td class="col-md-6">
																			Date:
																		</td>
																		<td class="col-md-6">
																			Ref.:
																		</td>											
																	</tr>
																</table>
															</footer>
														</div>
													</div>
												</section>					
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
		<script>
			$( "#StudentId" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#StudentId" ).text( value );
			  })
			  .keyup();
			  $( "#Affilation" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#Affilation" ).text( value );
			  })
			  .keyup();
			  $( "#StartJobDate" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#StartJobDate" ).text( value );
			  })
			  .keyup();
			  $( "#Transportation" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#Transportation" ).text( value );
			  })
			  .keyup();
			  $( "#FullName" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#FullName" ).text( value );
			  })
			  .keyup();
			  $( "#JobTitle" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#JobTitle" ).text( value );
			  })
			  .keyup();
			  $( "#Nationality" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#Nationality" ).text( value );
			  })
			  .keyup();
			  $( "#BasicSalary" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#BasicSalary" ).text( value );
			  })
			  .keyup();
			  $( "#OtherAllowence" )
			  .keyup(function() {
			    var value = $( this ).val();
			    $( "p#OtherAllowence" ).text( value );
			  })
			  .keyup();
		</script>
	</body>
</html>
