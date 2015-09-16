 <?php 
include('includes/header.php');
//print_r($_SESSION);
$StudentID  =  $_SESSION['StudentID'];

?>
	 <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->

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
										<h2 class=""><i class="fa fa-plane text-green"> </i> Flight Discounts</h2>
									</div>
									<?php 
										$sql = "SELECT StudentInfo.NationalID,StudentInfo.DoB,StudentInfo.StudentName_en,StudentInfo.StudentID,StudentInfo.Issuedate,StudentJobInfo.JobTitle FROM StudentInfo JOIN StudentJobInfo ON StudentJobInfo.StudentID = StudentInfo.StudentID WHERE StudentInfo.StudentID = $StudentID";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										$row = sqlsrv_fetch_array($result)?>
									<div class="panel-body">
										<h4 class="BorderBottom">Flight discount form</h4>
										<form class="flightform" action="<?php if($_REQUEST['lang']=="ar"){?>PDF/flightpdf_ar.php<?php }else{ ?>PDF/flightpdf.php<?php } ?>" method="post">
											<input type="text" placeholder="NationalID, " id="NationalId" name="NationalId" class="input" autofocus  data-toggle="tooltip" data-placement="right" title="NationalID, eg: 1091983948" value="<?php echo $row['NationalID']?>">
											<input maxlength="100" type="text" required="required" id="IssueDate" name="IssueDate" class="form-control" placeholder="Enter Issue Date" value="<?php echo $row['Issuedate']?>" />
											
											<input type="text" placeholder="IssuePlace" data-toggle="tooltip" required="required" data-placement="right" id="IssuePlace" name="IssuePlace" title="Please provide Issue Place" value="">
											<br /><br />
											<select id="FYear" name="FYear">
												<option value="">-- Year --</option>
												<option value="2010">2010</option>
												<option value="2011">2011</option>
												<option value="2012">2012</option>
												<option value="2013">2013</option>
												<option value="2014">2014</option>
												<option value="2015">2015</option>
											</select><br /><br />
											<input type="text" placeholder="Student ID" required="required" data-toggle="tooltip" data-placement="right" id="StudentId" name="StudentId" title="Provide your Student Id" value="<?php echo $row['StudentID']?>">
											<input type="text" placeholder="BirthDate" required="required" data-toggle="tooltip" data-placement="right" id="BirthDate" name="BirthDate" title="Provide your BirthDate" value="<?php echo $row['DoB']?>">
											<input maxlength="100" type="text" id="FDate" required="required" name="FDate" class="form-control" placeholder="Enter Date" />
											<input type="text" placeholder="Name" required="required" data-toggle="tooltip" data-placement="right" id="FName" name="FName" title="Provide your Full Name as per your Transportation" value="<?php echo $row['StudentName_en']?>">
											<input type="text" placeholder="Signature" required="required" data-toggle="tooltip" data-placement="right" id="FSignature" name="FSignature" title="Provide Signature" value="<?php //echo $row['Salary']?>">
											<input type="text" placeholder="The manager in charge name" required="required" data-toggle="tooltip" data-placement="right" id="FIncharge" name="FIncharge" title="Provide The manager in charge name" value="<?php //echo $row['HardshipAllowance']?>">
											<input type="text" placeholder="Job Title" data-toggle="tooltip" required="required" data-placement="right" id="FJobTitle" name="FJobTitle" title="Provide Job Title" value="<?php echo $row['JobTitle']?>">
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
															<h4 ><?php echo $lang["Certificate definition"];?></h4><br>
															<h3><?php echo $lang["flight mater1"];?></h3>
															<table class="col-md-12 text-right tables pdftable">
																<tr>
																	<td>																	
																		<p id="NationalId"></p>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table class="col-md-12 table">
																			<tr>
																				<td class="col-md-6">
																					<p id="IssueDate"></p>
																				</td>
																				<td class="col-md-6">
																					<p id="IssuePlace"></p>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																		<p id="FYear">--Year--</p>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table class="col-md-12 table">
																			<tr>
																				<td class="col-md-6">
																					<p id="StudentId"></p>
																				</td>
																				<td class="col-md-6">
																					<p id="BirthDate"></p>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																	<?php echo $lang["flight mater2"];?>
																	</td>
																</tr>
																<tr>
																	<td>
																		<table class="col-md-12 table">
																			<tr>
																				<td class="col-md-4">
																					<p id="FSignature"></p>
																				</td>
																				<td class="col-md-4">
																					<p id="FName"></p>
																				</td>
																				<td class="col-md-4">
																					<p id="FDate">Enter Date</p>
																				</td>
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td>
																		
																	</td>
																</tr>
															</table>
															<table class="col-md-12 text-right tables second-table">
																<tr>
																	<td colspan="3">
																		<p>
																			<?php echo $lang["flight mater3"];?>	
																		</p>
																	</td>
																</tr>
																<tr>
																	<td class="col-md-4">
																		Official Seal
																	</td>
																	<td class="col-md-4 fourboxes">
																		<div class="borderbottom">
																			<p id="FIncharge" placeholder="">this is placeholder in P tag</p>
																		</div>
																		<div class="borderbottom">
																			<p id="FJobTitle"></p>																			
																		</div>
																		<div class="borderbottom">
																			<p id="FSignature"></p>
																		</div>
																		<div class="borderbottom">
																			<p id="FDate">Enter Date</p>
																		</div>
																	</td>
																	<td class="col-md-4 fourboxes">
																		<div class="borderbottom">
																			<p>:<?php echo $lang["The manager in charge name"];?></p>
																		</div>
																		<div class="borderbottom">
																			<p>:<?php echo $lang["Job Title"];?></p>
																		</div>
																		<div class="borderbottom">
																			<p>:<?php echo $lang["Signature"];?></p>
																		</div>
																		<div class="borderbottom">
																			<p>:<?php echo $lang["Date"];?></p>
																		</div>
																	</td>
																</tr>
															</table>
															<table class="col-md-12 tables second-table">
																<tr>
																	<td>
																		<p>
																			<?php echo $lang["flight mater4"];?>
																		</p>
																		
																	</td>
																</tr>
															</table>
														</content>
														<footer>
														<div class="row margintop">
																	<div class="col-md-6">
																		<?php echo $lang["I have read the above conditions"];?>
																		<br>
																		:<?php echo $lang["Beneficiary Name"];?>
																	</div>
																	
																</div>
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
				<strong>Copyright &copy; 2014-2015 <a href="http://#.com">SWCC Dashboard</a>.</strong> All rights reserved.
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

			$( "#IssueDate" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#IssueDate" ).text( value );
				})
				.keyup();

			$( "#IssuePlace" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#IssuePlace" ).text( value );
				})
				.keyup();

			$( "#FYear" )
				.change(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#FYear" ).text( value );
				})
				.keyup();

			$( "#BirthDate" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#BirthDate" ).text( value );
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

			$( "#FSignature" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#FSignature" ).text( value );
				})
				.keyup();

			$( "#FName" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#FName" ).text( value );
				})
				.keyup();

			$( "#FDate" )
				.change(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#FDate" ).text( value );
				})
				.keyup();

			$( "#FIncharge" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#FIncharge" ).text( value );
				})
				.keyup();

			$( "#FJobTitle" )
				.keyup(function() {
				  var value = $( this ).val();
				  if(value === '') {
					  value = $(this).attr('placeholder');
				  }
				  $( "p#FJobTitle" ).text( value );
				})
				.keyup();			
			  
			</script>
		<!--<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->

	<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
		

	<script type="text/javascript">	
	$(function() {
		/*$( "#FDate" ).datepicker({       
			dateFormat : 'yy-mm-dd',
			changeMonth : true,
			changeYear : true,
			maxDate : 'd'
		});	*/

		$("#FDate").datepicker({ 
			autoclose: true, 
			todayHighlight: true
		}).datepicker('update', new Date());;
		var text = $( this ).text();
		$( "p#FDate" ).val( text );
	});
	/*
	$(function() {
		$( "#datepicker11" ).datepicker({
			dateFormat : 'yy-mm-dd',
			changeMonth : true,
			changeYear : true,
			yearRange: '-50y:c+nn',
			maxDate: '-1d'
		});
	});*/

	$(function() {
		/*$( "#IssueDate" ).datepicker({   
			dateFormat : 'yy-mm-dd',    
			changeMonth : true,
			changeYear : true,
			yearRange: '-15y:+5y'       
		});*/

		$("#IssueDate").datepicker({ 
			autoclose: true, 
			todayHighlight: true
		}).datepicker('update', new Date());;
	});    
	</script>
	</body>
</html>
