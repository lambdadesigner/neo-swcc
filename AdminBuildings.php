<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}

$BuildSql = "SELECT * FROM BachelorAcc WHERE BuildingNo='".$_GET['building']."'";
$Build_result = sqlsrv_query( $conn, $BuildSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$Build_fetch = sqlsrv_fetch_array($Build_result);

if($_GET['action']=="Edit" && $_GET['StuName']!="")
{
	echo $UpdateSecSql = "UPDATE BachelorAcc SET Candidate_".$_GET['Candid']."='',Candidate_".$_GET['Candid']."_FromDate='',Candidate_".$_GET['Candid']."_ToDate='' WHERE BuildingNo='".$_GET['Build']."' AND Section='".$_GET['Sec']."' AND RoomNo='".$_GET['Rno']."'";
	
	$UpdateSec_result = sqlsrv_query( $conn, $UpdateSecSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminBuildings?building='.$_GET['Build'].'');
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
	</style>
    <link href="assets/dist/css/Housing.css" rel="stylesheet" type="text/css" />

	<body>
		<div class="container">
			<div class="row">
			<div class="col-md-12"> <br>
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $Build_fetch['BuildingNo']?></h3>
						</div>
						<div class="panel-body blockss">
							<div class="block one row">
								<div class="left-block col-md-1 one rotate">
									B<br>l<br>o<br>c<br>k<br> <b>A</b>
								</div>
								<div class="right-block col-md-11 blocks">
									<strong>
										<div class="row text-center">
											<?php 
											$NoSecASql = "SELECT * FROM BachelorAcc WHERE BuildingNo='".$_GET['building']."' AND Section='A'";
											$NoSecA_result = sqlsrv_query( $conn, $NoSecASql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($NoSecA_fetch = sqlsrv_fetch_array($NoSecA_result)){?>
												<div class="col-md-1"><?php echo $NoSecA_fetch['RoomNo'];?></div>
											<?php } ?>
										</div>
									</strong>
									<?php 									
									$SecA_result = sqlsrv_query( $conn, $NoSecASql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									while($SecA_fetch = sqlsrv_fetch_array($SecA_result)){?>
										<div class="col-md-1">
											<div>
											<!-- Candidate One -->
												<?php if($SecA_fetch['Candidate_1']!=""){?>
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
																		<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecA_fetch['Candidate_1']?>&Sec=A&Build=<?php echo $_GET['building']?>&Candid=1&Rno=<?php echo $SecA_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																		<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus"></i> Add</button>
																		<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="A_<?php echo $SecA_fetch['RoomNo']?>_1">
																	</td>
																</tr>
															</table>
														</div>
													</div>
												<?php } ?>
											<!-- End Candidate One -->
											<!-- Candidate Two -->
												<?php if($SecA_fetch['Candidate_2']!=""){?>
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
																		<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecA_fetch['Candidate_2']?>&Sec=A&Build=<?php echo $_GET['building']?>&Candid=2&Rno=<?php echo $SecA_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																		<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="A_<?php echo $SecA_fetch['RoomNo']?>_2"><i class="fa fa-user-plus"></i> Add</button>
																		<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="A_<?php echo $SecA_fetch['RoomNo']?>_2">
																	</td>
																</tr>
															</table>
														</div>
													</div>
												<?php } ?>
											<!-- End Candidate Two -->
											<!-- Candidate Three -->
												<?php if($SecA_fetch['Candidate_3']!=""){?>
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
																		<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecA_fetch['Candidate_3']?>&Sec=A&Build=<?php echo $_GET['building']?>&Candid=3&Rno=<?php echo $SecA_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																		<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="A_<?php echo $SecA_fetch['RoomNo']?>_3"><i class="fa fa-user-plus"></i> Add</button>
																		<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="A_<?php echo $SecA_fetch['RoomNo']?>_3">
																	</td>
																</tr>
															</table>
														</div>
													</div>
												<?php } ?>
											<!-- End Candidate Three -->
											</div>
										</div>
									<?php } ?>									
								</div>
							</div>
							<br>
							<div class="block two row">
								<div class="left-block col-md-1 two rotate">
									B<br>l<br>o<br>c<br>k<br> <b>B</b>
								</div>
								<div class="right-block col-md-11 blocks">	
									<strong>
										<div class="row text-center">
											<?php 
											$NoSecBSql = "SELECT * FROM BachelorAcc WHERE BuildingNo='".$_GET['building']."' AND Section='B'";
											$NoSecB_result = sqlsrv_query( $conn, $NoSecBSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($NoSecB_fetch = sqlsrv_fetch_array($NoSecB_result)){?>
												<div class="col-md-1"><?php echo $NoSecB_fetch['RoomNo'];?></div>
											<?php } ?>
										</div>
									</strong>								
									<?php 									
									$SecB_result = sqlsrv_query( $conn, $NoSecBSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									while($SecB_fetch = sqlsrv_fetch_array($SecB_result)){?>
									<div class="col-md-1">
										<div>
										<!-- Candidate One -->
											<?php if($SecB_fetch['Candidate_1']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_1']?>&Sec=B&Build=<?php echo $_GET['building']?>&Candid=1&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
										<!-- End Candidate One -->
										<!-- Candidate Two -->
											<?php if($SecB_fetch['Candidate_2']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecA_fetch['Candidate_2']?>&Sec=B&Build=<?php echo $_GET['building']?>&Candid=2&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_2"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_2">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate Two -->
										<!-- Candidate Three -->
											<?php if($SecB_fetch['Candidate_3']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecB_fetch['Candidate_3']?>&Sec=B&Build=<?php echo $_GET['building']?>&Candid=3&Rno=<?php echo $SecB_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="B_<?php echo $SecB_fetch['RoomNo']?>_3"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="B_<?php echo $SecB_fetch['RoomNo']?>_3">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate Three -->
										</div>
									</div>									
									<?php } ?>									
								</div>
							</div>
							<br>
							<div class="block three row">
								<div class="left-block col-md-1 three rotate">
									B<br>l<br>o<br>c<br>k<br> <b>C</b>
								</div>
								<div class="right-block col-md-11 blocks">
									<strong>
										<div class="row text-center">
											<?php 
											$NoSecCSql = "SELECT * FROM BachelorAcc WHERE BuildingNo='".$_GET['building']."' AND Section='C'";
											$NoSecC_result = sqlsrv_query( $conn, $NoSecCSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($NoSecC_fetch = sqlsrv_fetch_array($NoSecC_result)){?>
												<div class="col-md-1"><?php echo $NoSecC_fetch['RoomNo'];?></div>
											<?php } ?>
										</div>
									</strong>
									<?php 
									$SecC_result = sqlsrv_query( $conn, $NoSecCSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									while($SecC_fetch = sqlsrv_fetch_array($SecC_result)){?>
									<div class="col-md-1">
										<div>
										<!-- Candidate One -->
											<?php if($SecC_fetch['Candidate_1']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecC_fetch['Candidate_1']?>&Sec=C&Build=<?php echo $_GET['building']?>&Candid=1&Rno=<?php echo $SecC_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="C_<?php echo $SecC_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="C_<?php echo $SecC_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate One -->
										<!-- Candidate Two -->
											<?php if($SecC_fetch['Candidate_2']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecC_fetch['Candidate_2']?>&Sec=C&Build=<?php echo $_GET['building']?>&Candid=2&Rno=<?php echo $SecC_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="C_<?php echo $SecC_fetch['RoomNo']?>_2"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="C_<?php echo $SecC_fetch['RoomNo']?>_2">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate Two -->
										<!-- Candidate Three -->
											<?php if($SecC_fetch['Candidate_3']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecC_fetch['Candidate_3']?>&Sec=C&Build=<?php echo $_GET['building']?>&Candid=3&Rno=<?php echo $SecC_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="C_<?php echo $SecC_fetch['RoomNo']?>_3"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="C_<?php echo $SecC_fetch['RoomNo']?>_3">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate Three -->
										</div>
									</div>			
									<?php } ?>						
								</div>
							</div>
							<br>
							<div class="block four row">
								<div class="left-block col-md-1 four rotate">
									B<br>l<br>o<br>c<br>k<br> <b>d</b>
								</div>
								<div class="right-block col-md-11 blocks">
									<strong>
										<div class="row text-center">
											<?php 
											$NoSecDSql = "SELECT * FROM BachelorAcc WHERE BuildingNo='".$_GET['building']."' AND Section='D'";
											$NoSecD_result = sqlsrv_query( $conn, $NoSecDSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											while($NoSecD_fetch = sqlsrv_fetch_array($NoSecD_result)){?>
												<div class="col-md-1"><?php echo $NoSecD_fetch['RoomNo'];?></div>
											<?php } ?>
										</div>
									</strong>
									<?php 									
									$SecD_result = sqlsrv_query( $conn, $NoSecDSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
									while($SecD_fetch = sqlsrv_fetch_array($SecD_result)){?>
									<div class="col-md-1">
										<div>
										<!-- Candidate One -->
											<?php if($SecD_fetch['Candidate_1']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecD_fetch['Candidate_1']?>&Sec=D&Build=<?php echo $_GET['building']?>&Candid=1&Rno=<?php echo $SecD_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="D_<?php echo $SecD_fetch['RoomNo']?>_1"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="D_<?php echo $SecD_fetch['RoomNo']?>_1">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate One -->
										<!-- Candidate Two -->
											<?php if($SecD_fetch['Candidate_2']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecD_fetch['Candidate_2']?>&Sec=D&Build=<?php echo $_GET['building']?>&Candid=2&Rno=<?php echo $SecD_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" data-target="#myModal" value="D_<?php echo $SecD_fetch['RoomNo']?>_2"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="D_<?php echo $SecD_fetch['RoomNo']?>_2">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate Two -->
										<!-- Candidate Three -->
											<?php if($SecD_fetch['Candidate_3']!=""){?>
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
																	<a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminBuildings?action=Edit&StuName=<?php echo $SecD_fetch['Candidate_3']?>&Sec=D&Build=<?php echo $_GET['building']?>&Candid=3&Rno=<?php echo $SecD_fetch['RoomNo'];?>'; return false;}" class="btn btn-danger"><i class="fa fa-user-times"></i> Remove</a>
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
																<td>headsssss</td>
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
																<input type="hidden" name="ddde" id="ddde"> 
																<td colspan="2" align="center">
																	<button class="btn btn-warning" id="AddStudent" data-toggle="modal" value="D_<?php echo $SecD_fetch['RoomNo']?>_3"  data-target="#myModal"><i class="fa fa-user-plus"></i> Add</button>
																	<input type="hidden" class="formed" name="addstuValue" id="addstuValue" value="D_<?php echo $SecD_fetch['RoomNo']?>_3">
																</td>
															</tr>
														</table>
													</div>
												</div>
											<?php } ?>
										<!-- End Candidate Three -->

										</div>
									</div>		
									<?php } ?>							
								</div>
							</div>
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
						<input type="hidden" name="BuildName" id="BuildName" value="<?php echo $_GET['building'];?>">
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