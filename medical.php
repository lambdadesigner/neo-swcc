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
						Services
						<!-- <small></small> -->
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
						p#MSignature, p#MJobTitle, p#IssueDateM, p#MSignature {
						    margin-top: -25px;
						    margin-left: 50px;
						    margin-right: 0;
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
										<h2 class=""><i class="fa fa-ambulance text-green"> </i> Medical Certificates</h2>
									</div>
									<?php 
										$med_sql = "SELECT StudentInfo.NationalID,StudentInfo.DoB,StudentInfo.StudentName_en,StudentInfo.StudentID,StudentInfo.Issuedate,StudentJobInfo.JobTitle FROM StudentInfo JOIN StudentJobInfo ON StudentJobInfo.StudentID = StudentInfo.StudentID WHERE StudentInfo.StudentID = $StudentID";
										$med_result = sqlsrv_query( $conn, $med_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										$med_row = sqlsrv_fetch_array($med_result)?>
									<div class="panel-body">
										<h4 class="BorderBottom"><?php echo $lang["Medical Leave "];?></h4>
										<form class="flightform" name="medicalForm" action="<?php if($_REQUEST['lang']=="ar"){?>PDF/medicalpdf_ar.php<?php } else {?>PDF/medicalpdf.php<?php } ?>" method="post">
											<input type="text" placeholder="National ID, eg: 1091983948" id="NationalId" name="NationalId" class="input" autofocus  data-toggle="tooltip" data-placement="right" title="National ID, eg: 1091983948" value="<?php echo $med_row['NationalID']?>" required>
											<input type="text" placeholder="Student ID" id="StudentId" name="StudentId" class="input" data-toggle="tooltip" data-placement="right" title="Provide Student ID" value="<?php echo $med_row['StudentID']?>" required>
											<input type="text" placeholder="Issue date" name="IssueDateM" id="IssueDateM" data-toggle="tooltip" data-placement="right" title="Issue date of your National card" required>											
											<input type="text" placeholder="Name" id="StudentName" name="StudentName" data-toggle="tooltip" data-placement="right" title="Provide your Full Name as per your National card" value="<?php echo $med_row['StudentName_en']?>" required>
											<input type="text" maxlength="20" placeholder="Job Title" name="MJobTitle" id="MJobTitle" data-toggle="tooltip" data-placement="right" title="Provide Job Title" required>											
											<input type="text" maxlength="20" placeholder="Signature" name="MSignature" id="MSignature" data-toggle="tooltip" data-placement="right" title="Your Signature" required>											
											<!-- <div class="form-group">
								                <div class="icon-addon addon-sm">
								                    <input type="text" placeholder="Email" class="form-control" id="email">
								                    <label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>
								                </div>
								            </div> -->
								            <br /><br />
											<!-- <select id="year">
												<option value="">-- Year --</option>
												<option value="2010">2010</option>
												<option value="2011">2011</option>
												<option value="2012">2012</option>
												<option value="2013">2013</option>
												<option value="2014">2014</option>
												<option value="2015">2015</option>
											</select> -->
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
															<h3>
																<?php echo $lang["Medical Leave "];?> <br>
																PLANT\DEPARTMENT المحطة / الإدارة : مركز التدريب
															</h3>
															<table class="col-md-12 text-right tables">
																<tr>
																	<td class="col-md-1">
																		
																	</td>
																	<td class="col-md-10">
																		<table class="fullwidth table thirdtable col-md-12">
																			<tr>
																				<td>
																					No
																				</td>
																				<td>
																					<p id="NationalId"></p>
																				</td>
																				<td>
																					Name
																				</td>
																				<td>
																					<p id="StudentName"></p>
																				</td>
																			</tr>
																			<tr>
																				<td>
																					No
																				</td>
																				<td>
																					<p id="StudentId"></p>
																				</td>
																				<td>
																					Job
																				</td>
																				<td>
																					<p id="MJobTitle" style="margin:0">Job Title</p>
																				</td>
																			</tr>
																		</table>
																	</td>
																	<td class="col-md-1">
																		
																	</td>
																</tr>
																<tr>
																	<td>
																		
																	</td>                             
																	<td>
																		<?php echo $lang["medical matter1"];?>
																		<br>
																		<?php echo $lang["medical matter2"];?>
																		<div class="row">
																			<div class="col-md-6">
																				الوظيفة : .....................................JOB <p id="MJobTitle"></p><hr>
																				التوقيع : ....................................SIGN <p id="MSignature"></p>                            
																			</div>
																			<div class="col-md-6">
																				  رقمها : ..........................NO <hr>
																				   التاريخ : ........................DATE <p id="IssueDateM"></p>
																			</div>
																		</div>
																	</td>
																	<td>
																		
																	</td>
																</tr>
																<tr>
																	<td>
																		
																	</td>
																	<td>
																		
																	</td>
																	<td>
																		
																	</td>
																</tr>

															</table>
														</content>
														<footer>
															<table class="col-md-12">
																<tr>
																	<td>
																		<?php echo $lang["Attach"];?>:
																	</td>
																	<td>
																		<?php echo $lang["Date"];?>:
																	</td>
																	<td>
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
				<strong>Copyright &copy; 2014-2015 <a href="#">SWCC Dashboard</a>.</strong> All rights reserved.
			</footer>
			
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
			$( "#NationalId" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
				      value = $(this).attr('placeholder');
				  }
				  $( "p#NationalId" ).text( value );
				})
				.keyup();

			$( "#StudentName" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
				      value = $(this).attr('placeholder');
				  }
				  $( "p#StudentName" ).text( value );
				})
				.keyup();

			$( "#IssueDateM" )
				.change(function() {
				  var value = $( this ).val();
				  if(value === '') {
				      value = $(this).attr('placeholder');
				  }
				  $( "p#IssueDateM" ).text( value );
				})
				.keyup();

			$( "#StudentId" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
				      value = $(this).attr('placeholder');
				  }
				  $( "p#StudentId" ).text( value );
				})
				.keyup();

			$( "#MJobTitle" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
				      value = $(this).attr('placeholder');
				  }
				  $( "p#MJobTitle" ).text( value );
				})
				.keyup();

			$( "#MSignature" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
				      value = $(this).attr('placeholder');
				  }
				  $( "p#MSignature" ).text( value );
				})
				.keyup();

			</script>

	<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

	<script type="text/javascript">	
    $(function() {
        /*$( "#IssueDateM" ).datepicker({   
        	dateFormat : 'yy-mm-dd',    
            changeMonth : true,
            changeYear : true,
            yearRange: '-15y:+5y'       
        });*/
		$("#IssueDateM").datepicker({ 
		    autoclose: true, 
		    todayHighlight: true
		}).datepicker('update', new Date());;
    });
    </script>
	</body>
</html>
