<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}

$ApartSql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."'";
$Apart_result = sqlsrv_query( $conn, $ApartSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$Apart_fetch = sqlsrv_fetch_array($Apart_result);

if($_GET['action']=="Edit" && $_GET['StuName']!="")
{
	/*echo $UpdateSecSql = "UPDATE BachelorAcc SET Candidate_".$_GET['Candid']."='',Candidate_".$_GET['Candid']."_FromDate='',Candidate_".$_GET['Candid']."_ToDate='' WHERE BuildingNo='".$_GET['Build']."' AND Section='".$_GET['Sec']."' AND RoomNo='".$_GET['Rno']."'";
	
	$UpdateSec_result = sqlsrv_query( $conn, $UpdateSecSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminApartments?Apartment='.$_GET['Build'].'');*/
}
?>
	<!-- Housing Css -->
	<style type="text/css">
		/*.one .col-md-1 .heightbox:first-child:after {
		    content: '<?php echo "X";

		     ?>';
		    position: absolute;
		    top: -15px;
		    left: 50%;
		}
		.block.row {
		    padding: 20px 0;
		}*/
		.heightbox
		{
			min-height:140px;
			width:98% !important;
		}
		.filled .bedtooltip,.unfilled .bedtooltip
		{
			left: 380px !important;
			top: 0px !important;
		}
	</style>
    <link href="assets/dist/css/Housing.css" rel="stylesheet" type="text/css" />

	<body>
		<div class="container">
			<div class="row">
			<div class="col-md-12"> <br>
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $Apart_fetch['Building']?></h3>
						</div>
						<div class="panel-body blockss">
							<div class="block one row">
								<div class="left-block col-md-1 one rotate">
									G<br>R<br><br>&<br><br>G<br>L
								</div>
								<div class="right-block col-md-11 blocks">
									<strong>
										<div class="row text-center">
											<?php 
											$NoSecASql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND APT='GR'";
											$NoSecA_result = sqlsrv_query( $conn, $NoSecASql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($NoSecA_fetch = sqlsrv_fetch_array($NoSecA_result)){?>
												<div class="col-md-1"><?php echo $NoSecA_fetch['Apt'];?></div>
											<?php } ?>
										</div>
									</strong>
									<?php 									
									$SecA_result = sqlsrv_query( $conn, $NoSecASql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									while($SecA_fetch = sqlsrv_fetch_array($SecA_result)){?>
										<div class="col-md-5 border">
											<?php if($SecA_fetch['EmpID']!=""){?>
												<div class="heightbox filled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_1']?>&Sec=B&Build=<?php echo $_GET['Apartment']?>&Candid=1&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } else { ?>
												<div class="heightbox unfilled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										</div>

										<div class="col-md-1"></div>

										<strong style="position: absolute; margin:-28px 32px;">
											<div class="row text-center">
												<?php 
												$AptGl1Sql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='GL'";
												$AptGl1_result = sqlsrv_query( $conn, $AptGl1Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												while($AptGl1_fetch = sqlsrv_fetch_array($AptGl1_result)){?>
													<div class="col-md-1"><?php echo $AptGl1_fetch['Apt'];?></div>
												<?php } ?>
											</div>
										</strong>

										<div class="col-md-5 border">

											<?php 
											$AptGlSql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='GL'";
											$AptGl_result = sqlsrv_query( $conn, $AptGlSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($AptGl_fetch = sqlsrv_fetch_array($AptGl_result)){?>
											
											<?php if($AptGl_fetch['EmpID']!=""){?>
												<div class="heightbox filled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_1']?>&Sec=B&Build=<?php echo $_GET['Apartment']?>&Candid=1&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } else { ?>
												<div class="heightbox unfilled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } } ?>

										</div>
									<?php } ?>									
								</div>
							</div>
							<br>
							<div class="block two row">
								<div class="left-block col-md-1 two rotate">
									F<br>R<br><br>&<br><br>F<br>L
								</div>
								<div class="right-block col-md-11 blocks">	
									<strong>
										<div class="row text-center">
											<?php 
											$NoSecBSql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='FR'";
											$NoSecB_result = sqlsrv_query( $conn, $NoSecBSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($NoSecB_fetch = sqlsrv_fetch_array($NoSecB_result)){?>
												<div class="col-md-1"><?php echo $NoSecB_fetch['Apt'];?></div>
											<?php } ?>
										</div>
									</strong>								
									<?php 									
									$SecB_result = sqlsrv_query( $conn, $NoSecBSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									while($SecB_fetch = sqlsrv_fetch_array($SecB_result)){?>
										<div class="col-md-5 border">
											<?php if($SecB_fetch['EmpID']!=""){?>
												<div class="heightbox filled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_1']?>&Sec=B&Build=<?php echo $_GET['Apartment']?>&Candid=1&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } else { ?>
												<div class="heightbox unfilled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										</div>

										<div class="col-md-1"></div>

										<strong style="position: absolute; margin:-28px 32px;">
											<div class="row text-center">
												<?php 
												$NoSecB1Sql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='FL'";
												$NoSecB1_result = sqlsrv_query( $conn, $NoSecB1Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												while($NoSecB1_fetch = sqlsrv_fetch_array($NoSecB1_result)){?>
													<div class="col-md-1"><?php echo $NoSecB1_fetch['Apt'];?></div>
												<?php } ?>
											</div>
										</strong>

										<div class="col-md-5 border">

											<?php 
											$AptFlSql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='FL'";
											$AptFl_result = sqlsrv_query( $conn, $AptFlSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($AptFl_fetch = sqlsrv_fetch_array($AptFl_result)){?>
											
											<?php if($AptFl_fetch['EmpID']!=""){?>
												<div class="heightbox filled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_1']?>&Sec=B&Build=<?php echo $_GET['Apartment']?>&Candid=1&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } else { ?>
												<div class="heightbox unfilled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } } ?>

										</div>								
									<?php } ?>									
								</div>
							</div>
							<br>
							<div class="block three row">
								<div class="left-block col-md-1 three rotate">
									S<br>R<br><br>&<br><br>S<br>L
								</div>
								<div class="right-block col-md-11 blocks">
									<strong>
										<div class="row text-center">
											<?php 
											$NoSecCSql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='SR'";
											$NoSecC_result = sqlsrv_query( $conn, $NoSecCSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($NoSecC_fetch = sqlsrv_fetch_array($NoSecC_result)){?>
												<div class="col-md-1"><?php echo $NoSecC_fetch['Apt'];?></div>
											<?php } ?>
										</div>
									</strong>
									<?php 
									$SecC_result = sqlsrv_query( $conn, $NoSecCSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									while($SecC_fetch = sqlsrv_fetch_array($SecC_result)){?>
										<div class="col-md-5 border">
											<?php if($SecB_fetch['EmpID']!=""){?>
												<div class="heightbox filled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_1']?>&Sec=B&Build=<?php echo $_GET['Apartment']?>&Candid=1&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } else { ?>
												<div class="heightbox unfilled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										</div>

										<div class="col-md-1"></div>

										<strong style="position:absolute; margin:-28px 32px;">
											<div class="row text-center">
												<?php 
												$NoSecCSql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='SL'";
												$NoSecC_result = sqlsrv_query( $conn, $NoSecCSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												while($NoSecC_fetch = sqlsrv_fetch_array($NoSecC_result)){?>
													<div class="col-md-1"><?php echo $NoSecC_fetch['Apt'];?></div>
												<?php } ?>
											</div>
										</strong>

										<div class="col-md-5 border">

											<?php 
											$AptFlSql = "SELECT * FROM FamilyAcc WHERE Building='".$_GET['Apartment']."' AND Apt='SL'";
											$AptFl_result = sqlsrv_query( $conn, $AptFlSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($AptFl_fetch = sqlsrv_fetch_array($AptFl_result)){?>
											
											<?php if($AptFl_fetch['EmpID']!=""){?>
												<div class="heightbox filled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_1']?>&Sec=B&Build=<?php echo $_GET['Apartment']?>&Candid=1&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } else { ?>
												<div class="heightbox unfilled">
													<div class="bedtooltip">
													<i class="fa fa-close" onclick="bedtoolclose()"></i>
														<table class="table">
															<thead class="thead">
																<td>head</td>
																<td>ones</td>
															</thead>
															<tr>
																<td>
																	one
																</td>
																<td>
																	one two
																</td>
															</tr>
															<tr>
																<td>
																	two
																</td>
																<td>
																	two three
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } } ?>

										</div>			
									<?php } ?>						
								</div>
							</div>
							<br>							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<form name="addRoomStudent" id="addRoomStudent" method="post" action="AddSchedule.php">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Add Student</h4>
						</div>
						<input type="hidden" name="scenario" id="scenario" value="AddRoomStudent">				  	
						<input type="hidden" name="BuildName" id="BuildName" value="<?php echo $_GET['Apartment'];?>">
						<input type="hidden" name="RoomDetails" id="RoomDetails">				  	
					  	<div class="modal-body">
					  		<input type="text" id="RoStudentId" name="RoStudentId" value="" required="required" class="form-control" placeholder="Student ID" >
					  		<input type="text" id="RoStudentName" name="RoStudentName" value="" required="required" class="form-control" placeholder="Student Name" >
					    	<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
						    	<input class="form-control inputpickertext" type="text" id="RoFromDate" name="RoFromDate" placeholder="Join Date" />
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
							<div id="datepicker1" class="input-group date" data-date-format="yyyy-mm-dd">
						    	<input class="form-control inputpickertext" type="text" id="RoToDate" name="RoToDate" placeholder="End Date" />
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							</div>
					  	</div>
					  	<div class="modal-footer">
					    	<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
					    	<input type="submit" class="btn btn-primary" id="BookAuditorium" value="Add" >
					  	</div>
					</div>
				</form>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
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
		<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="assets/dist/js/datepicker.js"></script>
		<!-- Latest compiled and minified JavaScript 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->		
		<!-- Housing Scripts -->
			<script type="text/javascript" src="assets/dist/js/Housing-min.js"></script>
			<script type="text/javascript" src="assets/dist/js/Housing.js"></script>		
		<!-- Housing Scripts End -->
		<script type="text/javascript">
			var blockheight = $('.block').height();

			$(window).load(function(){
				$('.left-block.col-md-1').css('height' , blockheight + 'px');
			})
			function bedtoolclose(){
				 $('.bedtooltip').stop(true, true).fadeOut();
			}
			$('.heightbox').hover(function (ev) {
			    $(this).find('.bedtooltip').stop(true, true).fadeIn();
			}, function (ev) {
			    $('.bedtooltip').stop(true, true).fadeOut();
			}).mousemove(function (ev) {
			    $('.bedtooltip').css({
			        left: ev.layerX + 10,
			        top: ev.layerY + 10
			    });
			});

			var nowTemp = new Date();
			var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

			var checkin = $('#RoFromDate').datepicker({
			    beforeShowDay: function (date) {
			        return date.valueOf() >= now.valueOf();
			    },
			    autoclose: true,
			    format:'yyyy/mm/dd'
			}).on('changeDate', function (ev) {
			    if (ev.date.valueOf() > checkout.datepicker("getDate").valueOf() || !checkout.datepicker("getDate").valueOf()) {
			        var newDate = new Date(ev.date);
			        newDate.setDate(newDate.getDate() + 1);
			        checkout.datepicker("update", newDate);
			    }
			    $('#RoToDate')[0].focus();
			});

			var checkout = $('#RoToDate').datepicker({
			    beforeShowDay: function (date) {
			        if (!checkin.datepicker("getDate").valueOf()) {
			            return date.valueOf() >= new Date().valueOf();
			        } else {
			            return date.valueOf() > checkin.datepicker("getDate").valueOf();
			        }
			    },
			    autoclose: true,
			    format:'yyyy/mm/dd'
			}).on('changeDate', function (ev) {});	


			$(document).ready(function(){
				$('.btn-warning').click(function(){
					var ssc = $(this).siblings('input:hidden').val();	
					document.getElementById('RoomDetails').value = ssc;				
					//alert(ssc);
				});
			});

			// Passing Url 
			/*function addParameter(url, param, value) 
			{
			    var val = new RegExp('(\\?|\\&)' + param + '=.*?(?=(&|$))'),
			        parts = url.toString().split('#'),
			        url = parts[0],
			        hash = parts[1]
			        qstring = /\?.+$/,
			        newURL = url;
			    // Check if the parameter exists
			    if (val.test(url))
			    {
			        // if it does, replace it, using the captured group
			        // to determine & or ? at the beginning
			        newURL = url.replace(val, '$1' + param + '=' + value);
			    }
			    else if (qstring.test(url))
			    {
			        // otherwise, if there is a query string at all
			        // add the param to the end of it
			        newURL = url + '&' + param + '=' + value;
			    }
			    else
			    {
			        // if there's no query string, add one
			        newURL = url + '?' + param + '=' + value;
			    }
			    if (hash)
			    {
			        newURL += '#' + hash;
			    }
			    return newURL;
			}

			function loadUrl()
			{
				var range = $("#languag").val();
				var url1 = top.location.href;
				var param1 = "lang";
				var value1 = range;
				var stripped_url1 = addParameter(url1,param1,value1);
		 		top.location.href = stripped_url1;
			}*/
			</script>
		<style>
.datepicker{z-index:1151 !important;}
</style>
<?php
include('Admin_files/includes/footer.php');?>
	</body>
</html>