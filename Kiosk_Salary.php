 <?php 
include('includes/header.php');
//print_r($_SESSION);
$StudentID  =  $_SESSION['StudentID'];

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
					
	  			<?php if($_REQUEST['lang']=="en"){?>
					<style type="text/css">
						.pdftable tr, .pdftable td{
							text-align: left;
						}
						.pdftable{
							text-align: left;
						}
						.flightform input {
							float: left;
							text-align: left;
							clear: both;
						}
						.flightform select {
							float: left;
							text-align: left;
							clear: both;
							margin-top: 20px;
						}
					</style>

				<?php }  if($_REQUEST['lang']=="ar"){ ?>
					<style type="text/css">
						.pdftable tr, .pdftable td{
							text-align: right;
						}
						.pdftable{
							text-align: right;
						}
						.flightform input {
							float: right;
							text-align: right;
							clear: both;
						}
						.flightform select {
							float: right;
							text-align: right;
							clear: both;
							margin-top: 20px;
						}
					</style>
				<?php } ?>
   
				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6 BorderRight">
									<div class="panel-heading rightborder">
										<h2 class=""><!--<i class="fa fa-plane text-green"> </i>--> <?php echo $lang["Salary Statement"];?></h2>
									</div>
									<div class="panel-body">
										<h4 class="BorderBottom" id="salarystatement"><?php echo $lang["Salary Statement"];?></h4>
										<?php 
										$sql = "SELECT StudentInfo.NationalID,StudentInfo.StudentName_en,StudentInfo.StudentID,StudentJobInfo.JobTitle,StudentJobInfo.Salary,StudentJobInfo.StartDate,StudentJobInfo.TransportAllowance,StudentJobInfo.HardshipAllowance FROM StudentInfo JOIN StudentJobInfo ON StudentJobInfo.StudentID = StudentInfo.StudentID  WHERE StudentJobInfo.StudentID = $StudentID";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										$row = sqlsrv_fetch_array($result)?>
										<form class="flightform" action="<?php if($_REQUEST['lang']=="ar"){?>PDF/salarypdf_ar.php<?php }else { ?>PDF/salarypdf.php<?php } ?>" method="post">
											<input type="hidden" class="h1" name="SalaryStatement" value="Salary Statement" />
											<input type="text" placeholder="Student ID, eg: 1091983948" id="StudentId" name="StundentId" class="input" autofocus  data-toggle="tooltip" data-placement="right" title="Student ID, eg: 1091983948" value="<?php echo $row['StudentID']?>" required>
											<input type="text" placeholder="Full Name"  data-toggle="tooltip" data-placement="right" id="FullName" name="FullName" title="Please provide your full name" value="<?php echo $row['StudentName_en']?>" required >
											<input type="text" placeholder="Affilation" data-toggle="tooltip" data-placement="right" id="Affilation" name="Affilation" title="Your college affilation" value="" required>
											<input type="text" placeholder="Job Title" data-toggle="tooltip" data-placement="right" id="JobTitle" name="JobTitle" title="Provide your Job title" value="<?php echo $row['JobTitle']?>" required>
											<input type="text" placeholder="Joining date of your job" data-toggle="tooltip" data-placement="right" id="StartJobDate" name="StartJobDate" title="Provide your Joining date of your job" value="<?php echo $row['StartDate']?>" required>
											<input type="text" placeholder="Nationality" data-toggle="tooltip" data-placement="right" id="Nationality" name="Nationality" title="Provide your NationalId" value="<?php echo $row['NationalID']?>" required>
											<input type="text" placeholder="Transportation" data-toggle="tooltip" data-placement="right" id="Transportation" name="Transportation" title="Provide your Full Name as per your Transportation" value="<?php echo $row['TransportAllowance']?>" required>
											<input type="text" placeholder="Basic Salary" data-toggle="tooltip" data-placement="right" id="BasicSalary" name="BasicSalary" title="Provide your Basic salary" value="<?php echo $row['Salary']?>" required>
											<input type="text" placeholder="Other Allowence" data-toggle="tooltip" data-placement="right" id="OtherAllowence" name="OtherAllowence" title="Provide your other allowence" value="<?php echo $row['HardshipAllowance']?>" required>
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
															<content class="pdftable">
																<h3><?php echo $lang["Salary Statement"];?></h3>
																<table class="col-md-12 text-right tables ">
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
																<p class="margintop"><?php echo $lang["Salary Statement matter"];?>
																	</p>
																<div class="row margintop">
																	<div class="col-md-6">
																		<?php echo $lang["Musharraf Affairs trainees"];?>
																		<br>
																		<?php echo $lang["Khalid bin Abdullah bliss"];?>
																	</div>
																	<div class="col-md-6">
																		 <?php echo $lang["Official Seal"];?>
																	</div>
																</div>
															</content>
															<footer>
																<table class="col-md-12">
																	<tr>
																		<td class="col-md-6">
																			<?php echo $lang["Attach"];?>:
																		</td>
																		<td class="col-md-6">
																			<?php echo $lang["Date"];?>:
																		</td>
																		<td class="col-md-6">
																			<?php echo $lang["Ref"];?>.:
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
			
			<!-- Add the sidebar's background. This div must be placed
					 immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->
		<!-- jQuery 2.1.4 -->
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Swcc App -->
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>
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
