<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql= "select * from Schdule";
/*$sql = "SELECT *
FROM Marks
INNER JOIN Tests
ON Marks.TestID=Tests.TestID
INNER JOIN Module
ON Tests.ModuleID=Module.ModuleID
WHERE Marks.StudentID = $StudentID";*/
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
?>
<!-- Morris chart -->
	<link href="assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
	<!-- jvectormap -->
	<link href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
	<!-- Date Picker -->
	<link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
	<!-- Daterange picker -->
	<link href="assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	<!-- bootstrap wysihtml5 - text editor -->
	<link href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- Font awesome Icons -->
	<link rel="stylesheet" type="text/css" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css">

	<!-- Housing Css -->
	<link href="assets/dist/css/Housing.css" rel="stylesheet" type="text/css" />
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
				  <h1>
					<?php echo $lang["dashboard"];?>
					<!-- <small>Control panel</small> -->
				  </h1>
				  <ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $lang["Home"];?></a></li>
					<li class="active"><?php echo $lang["dashboard"];?></li>
				  </ol>
				</section>
				<hr>

					<!-- ALert Message -->
					<!-- <div class="row">
						<div class="col-md-10 col-md-offset-1">
							<?php if($_GET['msg']=="Success"){?>
								<hr>
								<div class="alert alert-success alert-dismissible" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  <strong>Warning!</strong> Better check yourself, you're not looking too good.
								</div>				            
							<?php } ?>
						</div>
					</div> -->

				<!-- Housing Content -->
				<?php 
					$housingSql = "SELECT DISTINCT BuildingNo FROM BachelorAcc";
					$Housing_result = sqlsrv_query( $conn, $housingSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
				?>
				<section class="container-fluid">
					<div class="row notifications">
						<div class="col-md-3">
							<div class="box box-info">
								<h2 class="text-blue">
									10 <i class="fa fa-commenting-o text-blue pull-right"></i>
								</h2>
								<div class="value">Today's Complaints</div>
								<div class="progress">
									<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
								</div>
								<small><span class="pull-left">Progress</span> <span class="pull-right">60%</span> </small>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box box-success">
								<h2 class="text-blue">
									10 <i class="fa fa-commenting-o text-blue pull-right"></i>
								</h2>
								<div class="value">Today's Complaints</div>
								<div class="progress">
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
								</div>
								<small><span class="pull-left">Progress</span> <span class="pull-right">60%</span> </small>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box box-danger">
								<h2 class="text-blue">
									10 <i class="fa fa-commenting-o text-blue pull-right"></i>
								</h2>
								<div class="value">Today's Complaints</div>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
								</div>
								<small><span class="pull-left">Progress</span> <span class="pull-right">60%</span> </small>
							</div>
						</div>
						<div class="col-md-3">
							<div class="box box-primary">
								<h2 class="text-blue">
									10 <i class="fa fa-commenting-o text-blue pull-right"></i>
								</h2>
								<div class="value">Today's Complaints</div>
								<div class="progress">
									<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
								</div>
								<small><span class="pull-left">Progress</span> <span class="pull-right">60%</span> </small>
							</div>
						</div>
					</div>
					
					<!-- <div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Hostel Management</h3>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-10">
										<div class="colors">
											<ul id="da-thumbs" class="da-thumbs">
												<?php $hij=1;while($Housing_fetch = sqlsrv_fetch_array($Housing_result)){?>
													<li class="box<?php echo $hij;?>">
														<a href="AdminBuildings?building=<?php echo $Housing_fetch['BuildingNo'];?>">
														<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
														<div class="hoverbg">
															<table class="table">
																<thead>
																	<td colspan="2"><h3 class="details-title"><?php echo $Housing_fetch['BuildingNo'];?> <i class="fa fa-building pull-left"></i></h3></td>
																</thead>
																<tr>
																	<td>
																		<i class="fa fa-th"></i> Rooms
																	</td>
																	<td>
																		<?php
																		$HroomSql = "SELECT COUNT(RoomNo) AS RCount FROM BachelorAcc WHERE BuildingNo='".$Housing_fetch['BuildingNo']."'";
																		$HRoom_result = sqlsrv_query( $conn, $HroomSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																		$HRoom_fetch = sqlsrv_fetch_array($HRoom_result);
																		echo $HRoom_fetch['0'];
																		?>
																	</td>
																</tr>
																<tr>
																	<td>
																		<i class="fa fa-group"></i> Filled
																	</td>
																	<td>
																		<?php
																		$FillRomSql = "SELECT count(*) FROM BachelorAcc WHERE Candidate_1!='' AND Candidate_2!='' AND Candidate_3!='' AND BuildingNo='".$Housing_fetch['BuildingNo']."'";
																		$FillRom_result = sqlsrv_query( $conn, $FillRomSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																		$FillRom_fetch = sqlsrv_fetch_array($FillRom_result);
																		echo $FillRom_fetch['0'];
																		?>
																	</td>
																</tr>
																<tr>
																	<td>
																		<i class="fa fa-street-view"></i> Vacant
																	</td>
																	<td>
																		<?php
																		echo $vacRooms = $HRoom_fetch['0'] - $FillRom_fetch['0'];
																		?>
																	</td>
																</tr>
																<tr>
																	<td>
																		<i class="fa fa-circle-o-notch"></i> Capacity
																	</td>
																	<td>
																		<?php echo $capa = $HRoom_fetch['0'] * 3;?>
																	</td>
																</tr>
																
																<tr>
																	<td colspan="2" align="center">
																		<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																	</td>
																</tr>
																<tr>
																	<td colspan="2" align="center">
																		<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																	</td>
																</tr>
															</table>
														</div>
														</a>
													</li>
												<?php $hij++; } ?>
												<li class="box2">
													<a href="#">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li>
												<li class="box3">
													<a href="#">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li>
												<li class="box4">
													<a href="#">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li>
												<li class="box5">
													<a href="#">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li>
											</ul>
										</div>
									</div>
								</div>					
							</div>
						</div>
					</div> -->
					<div class="row">
					<div class="col-lg-6">
							<!-- Scripts for Attendance Charts -->
							<style type="text/css">
								#chartdiv {
									width: 100%;
									height: 500px;
									}
							</style>
							<script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
							<script src="http://www.amcharts.com/lib/3/serial.js"></script>
							<script src="http://www.amcharts.com/lib/3/themes/light.js"></script>
							<script type="text/javascript" src="assets/dist/js/attendance.js"></script>
							<div class="panel box box-info attendanceinstructor">
								<div class="panel-heading">
									<h3 class="panel-title">Attendance of Instructor
										<div class="pull-right">
											<i class="fa fa-search"></i><input id="search-box" type="text" class="search-box" />
										</div>
									</h3>
									<hr>
								</div>
								<div class="box-body">
									<div id="chartdiv"></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
						<div class="panel box box-danger complaints">
							<div class="panel-heading">
								<h3 class="panel-title upper">Complaint Box 
									<div class="pull-right complaintsorting">
										<div class="pull-left">
											<a href="#Today" class="btn btn-sort">Today</a>
											<a href="#Month" class="btn" id="ComplaintMonth">Month</a>
											<a href="#Year" class="btn" id="ComplaintYear">Year</a>
										</div>
										<div class="pull-right">
											<div class="btn-group">
												<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
													More <i class="fa fa-angle-down"></i>
													<!-- <span class="caret"></span> -->
												</a>
												<ul class="dropdown-menu">
													<li><a href="#">Last Month</a></li>
													<li><a href="#">Last 3 Months</a></li>
													<li><a href="#">Last 6 Months</a></li>
													<li class="divider"></li>
													<li><a href="#">Last Year</a></li>
												</ul>
											</div>
										</div>
									</div>
								</h3>
								<hr>
							</div>
							<div class="panel-body slimScroll">
								<div class="complaintchart">
									<div class="col-md-12 col-md-offset-0 col-lg-offset-2 col-lg-8 col-sm-offset-0 col-xs-offset-0">
										<div class="row sparkline">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
													<?php
													$sql_Complaints="SELECT * FROM Complaints ";
													$result_Complaints = sqlsrv_query( $conn, $sql_Complaints ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
													
													?>
														<small>Total</small>

														<h3 class="nomargin"><?php //echo sqlsrv_num_rows($result_Complaints); ?>167</h3>	
													</div>
													<div class="col-md-6 sparkcontent">
														<span id="sparkline">&nbsp;</span>
													</div>
												</div>

											</div>
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
													<?php
													$sql_Complaints1= "SELECT * FROM Complaints where Status = 'complete' ";
													$result_Complaints1 = sqlsrv_query( $conn, $sql_Complaints1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
													
													?>
														<small>Completed</small>
														<h3 class="nomargin"><?php //echo sqlsrv_num_rows($result_Complaints1);?>157</h3>	
													</div>
													<div class="col-md-6 sparkcontent">
														<span id="sparkline2"></span>
													</div>
												</div>

											</div>
										</div>
										<br>
										<br>
									</div>
								</div>
								<!--Complaint box Queries-->
								
								
								
								<!--End -->
								
								<div class="complaintAdmin">
									<div class="">
										<div class="" id="MonthResult">
											<div class="box-heading">
											<div class="panel">
												<div class="panel-heading">
													  <h4 class="panel-title">
														<a href="#F">
														 <table>
															<thead>
																<td class="hsino"> S No.</td>
																<td class="hname"> Student Name</td>
																<td class="hctno">Complaint No.</td>
																
																<td class="hbuild">Building</td>
																<td class="hblock">Block</td>
																<td class="hrno">Room No</td>
																<td class="hdep">Department</td>
																<td class="hstatus">Status</td>
															</thead>
														 </table>
														</a>
													  </h4>
													</div>
											</div>
											</div>
											<div class="box-body content complaintData">
												<div class="panel-group panel-group-lists" id="accordion2">
													<?php 
							$sql_Complaints="SELECT * FROM Complaints ";
							$result_Complaints = sqlsrv_query( $conn, $sql_Complaints ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							$i=1;
							while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							
							$sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							$result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							$Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							
					  
					  ?>


													<div class="panel <?php echo $Complaints['priority'];?>">
														<div class="panel-heading">
														  <h4 class="panel-title">
															<a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
															 <table>
																<thead>
																	<td class="csino"> <?php echo $i++;?></td>
																	<td class="cname"><?php echo substr($Complaints['Complain_By_Name'],0,12);?>...</td>
																	<td class="cctno"><?php echo $Complaints['Complaint_No']?></td>
																	<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
																	<td class="cbuild"><?php echo  $Complaints_room['BuildingNo'];?></td>
																	<td class="cblock"> <?php echo $Complaints_room['Section'];?></td>
																	<td class="crno"> <?php echo $Complaints_room['RoomNo'];?></td>
																	<td class="cdep"><?php echo $Complaints['Department'];?></td>
																	<td class="cstatus"><i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?></td>

																</thead>
															 </table>
															</a>
														  </h4>
														</div>
														<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
														  <div class="panel-body">
																<!-- <div class="formgroup">
																	<label>Student Name</label>
																	<div class="text">some name </div>
																</div>
																<div class="formgroup">
																	<label>Building</label>
																	<div class="text">some name </div>
																</div>
																<div class="formgroup">
																	<label>Block</label>
																	<div class="text">some name </div>
																</div>
																<div class="formgroup">
																	<label>Room No.</label>
																	<div class="text">some name </div>
																</div>
																<div class="formgroup">
																	<label>Bed No.</label>
																	<div class="text">some name </div>
																</div>
																<div class="formgroup">
																	<label>Department</label>
																	<div class="text">some name </div>
																</div>
																<div class="formgroup">
																	<label>Priority</label>
																	<div class="text">some name </div>
																</div> -->
															<div class="formgroup">
																<label>Message</label>
																<div class="text">
																	<p>
																	<?php echo $Complaints['Message'];?>
																		
																	</p> 
																</div>
																<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
																	<select name="UpdateStatus" id="UpdateStatus">
																	<option value="">Select Status</option>
																	<option value="pending">Pending</option>
																	<option value="working">Working</option>
																	<option value="complete">Complete</option>
																	
																	<select>
																</div>
															</div>
														  </div>
														  <div class="panel-footer">
																<div align="right">
																	<button class="btn btn-primary" id="modifyStatus" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">Modify</button>
																	<button class="btn btn-warning">Reply</button>
																	<button class="btn btn-danger">Delete</button>
																</div>
														  </div>
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
					</div>
					</div>
				</section>
				<!-- Housing Content End -->
				
				<!-- Main content -->
				<section class="contentainer-fluid">
				 <?php /* <!-- Small boxes (Stat box) -->
				  <div class="row">
					<div class="col-lg-3 col-xs-6">
					  <!-- small box -->
					  <div class="small-box bg-aqua">
						<div class="inner">
						  <h3>150</h3>
						  <p>New Orders</p>
						</div>
						<div class="icon">
						  <i class="ion ion-bag"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					  <!-- small box -->
					  <div class="small-box bg-green">
						<div class="inner">
						  <h3>53<sup style="font-size: 20px">%</sup></h3>
						  <p>Bounce Rate</p>
						</div>
						<div class="icon">
						  <i class="ion ion-stats-bars"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					  <!-- small box -->
					  <div class="small-box bg-yellow">
						<div class="inner">
						  <h3>44</h3>
						  <p>User Registrations</p>
						</div>
						<div class="icon">
						  <i class="ion ion-person-add"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div><!-- ./col -->
					<div class="col-lg-3 col-xs-6">
					  <!-- small box -->
					  <div class="small-box bg-red">
						<div class="inner">
						  <h3>65</h3>
						  <p>Unique Visitors</p>
						</div>
						<div class="icon">
						  <i class="ion ion-pie-graph"></i>
						</div>
						<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					  </div>
					</div><!-- ./col -->
				  </div><!-- /.row -->*/?>
				  <!-- Main row -->
				  <div class="container-fluid">
					  <div class="row">
						<!-- Left col -->
							<link rel="stylesheet" type="text/css" href="assets/dist/css/calendar.css">

						<!-- right col (We are only adding the ID to make the widgets sortable)-->
						
						<div class="col-md-6">
							<!-- Calendar -->
							<div class="box box-solid" id="HolCalendar"> <!-- bg-green-gradient -->
								<div class="box-header">
								  <i class="fa fa-calendar text-red"></i>
								  <h3 class="box-title">Holidays Calendar</h3>
								  <a href="Holidays" class="btn bg-green pull-right"><i class="fa fa-plus"> Add Holiday</i></a><hr>
								  <!-- tools box -->
								  <?php /*<div class="pull-right box-tools">
									<!-- button with a dropdown -->
									<div class="btn-group">
									  <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
									  <ul class="dropdown-menu pull-right" role="menu">
										<li><a href="#">Add new event</a></li>
										<li><a href="#">Clear events</a></li>
										<li class="divider"></li>
										<li><a href="#">View calendar</a></li>
									  </ul>
									</div>
									<button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								  </div><!-- /. tools -->*/?>
								</div><!-- /.box-header -->
								<div class="box-body">
								  <div class="row">
								  <div class="col-md-3">
									<ul>
										<li>holiday one</li>
										<li>holiday one</li>
										<li>holiday one</li>
										<li>holiday one</li>
										<li>holiday one</li>
										<li>holiday one</li>
										<li>holiday one</li>
										<li>holiday one</li>
										<li>holiday one</li>
									</ul>
								  </div>
									<div class="col-md-9">
									  <p class="text-center">							
									  </p>
									  <div class="chart">
										<div id="holder" class="row" ></div>							
									  </div>
									  <p class="text-center">							
									  </p>
									</div>
								  </div>
								</div>		                
							</div><!-- /.box -->

							<script type="text/tmpl" id="tmpl">
							  {{ 
							  var date = date || new Date(),
								  month = date.getMonth(), 
								  year = date.getFullYear(), 
								  first = new Date(year, month, 1), 
								  last = new Date(year, month + 1, 0),
								  startingDay = first.getDay(), 
								  thedate = new Date(year, month, 1 - startingDay),
								  dayclass = lastmonthcss,
								  today = new Date(),
								  i, j; 
							  if (mode === 'week') {
								thedate = new Date(date);
								thedate.setDate(date.getDate() - date.getDay());
								first = new Date(thedate);
								last = new Date(thedate);
								last.setDate(last.getDate()+6);
							  } else if (mode === 'day') {
								thedate = new Date(date);
								first = new Date(thedate);
								last = new Date(thedate);
								last.setDate(thedate.getDate() + 1);
							  }
							  
							  }}
							  <table class="calendar-table table table-condensed table-tight">
								<thead>
								  <div>
								  <tr>
									<td colspan="7" style="text-align: center">
									  <table style="white-space: nowrap; width: 100%">
										<tr>
										  <td>
											<span class="btn-group btn-group-lg">
											  {{ if (mode !== 'day') { }}
												{{ if (mode === 'month') { }}<button class="js-cal-option btn btn-link" data-mode="year">{{: months[month] }}</button>{{ } }}
												{{ if (mode ==='week') { }}
												  <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
												{{ } }}
												<button class="js-cal-years btn btn-link">{{: year}}</button> 
											  {{ } else { }}
												<button class="btn btn-link disabled">{{: date.toDateString() }}</button> 
											  {{ } }}
											</span>
										  </td>
										  <td style="text-align: right;">
											<span class="btn-group">
											  <button style="background-color: #E06D5F; color:white" class="js-cal-prev btn ">&lt;</button><!--btn-success-->
											 
											</span>
											<button style="background-color: #E06D5F; color:white" class="js-cal-option btn {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
											<button style="background-color: #E06D5F; color:white" class="js-cal-next btn">&gt;</button>
										  </td>
										  <!--<td style="text-align: right">
											<span class="btn-group">
											  <button class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">Year</button>
											  <button class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">Month</button>
											  <button class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">Week</button>
											</span>
										  </td>-->
										</tr>
									  </table>
									  
									</td>
								  </tr>
								</thead>
								{{ if (mode ==='year') {
								  month = 0;
								}}
								<tbody>
								  {{ for (j = 0; j < 3; j++) { }}
								  <tr>
									{{ for (i = 0; i < 4; i++) { }}
									<td style="padding:0px;" class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
									  {{: months[month] }}
									  {{ month++;}}
									</td>
									{{ } }}
								  </tr>
								  {{ } }}
								</tbody>
								{{ } }}
								{{ if (mode ==='month' || mode ==='week') { }}
								<thead>
								<div class="oppo">
								  <tr class="c-weeks">
									{{ for (i = 0; i < 7; i++) { }}
									  <th class="c-name">
										{{: days[i] }}
									  </th>
									{{ } }}
								  </tr>
								  </div>
								</thead>
								<tbody>
								  {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
								  <tr>
									{{ for (i = 0; i < 7; i++) { }}
									{{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
									<td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}">
									  <div class="date">{{: thedate.getDate() }}</div>				          
									  {{ thedate.setDate(thedate.getDate() + 1);}}
									</td>
									{{ } }}
								  </tr>
								  {{ } }}
								</tbody>
								{{ } }}
								{{ if (mode ==='day') { }}
								<tbody>
								  <tr>
									<td colspan="7">
									  <table class="table table-striped table-condensed table-tight-vert" >
										<thead>
										  <tr>
											<th>&nbsp;</th>
											<th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
										  </tr>
										</thead>
										<tbody>
										  <tr>
											<th class="timetitle" >All Day</th>
											<td class="{{: date.toDateCssClass() }}">  </td>
										  </tr>
										  <tr>
											<th class="timetitle" >Before 6 AM</th>
											<td class="time-0-0"> </td>
										  </tr>
										  {{for (i = 6; i < 22; i++) { }}
										  <tr>
											<th class="timetitle" >{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
											<td class="time-{{: i}}-0"> </td>
										  </tr>
										  <tr>
											<th class="timetitle" >{{: i <= 12 ? i : i - 12 }}:30 {{: i < 12 ? "AM" : "PM"}}</th>
											<td class="time-{{: i}}-30"> </td>
										  </tr>
										  {{ } }}
										  <tr>
											<th class="timetitle" >After 10 PM</th>
											<td class="time-22-0"> </td>
										  </tr>
										</tbody>
									  </table>
									</td>
								  </tr>
								</tbody>
								{{ } }}
							  </table>
							</script>
							<script src='http://assets.codepen.io/assets/common/stopExecutionOnTimeout.js?t=1'></script>
							<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
							<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
							<script>
							/*var $currentPopover = null;
							  $(document).on('shown.bs.popover', function (ev) {
								var $target = $(ev.target);
								if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
								  $currentPopover.popover('toggle');
								}
								$currentPopover = $target;
							  }).on('hidden.bs.popover', function (ev) {
								var $target = $(ev.target);
								if ($currentPopover && ($currentPopover.get(0) == $target.get(0))) {
								  $currentPopover = null;
								}
							  });*/


							//quicktmpl is a simple template language I threw together a while ago; it is not remotely secure to xss and probably has plenty of bugs that I haven't considered, but it basically works
							//the design is a function I read in a blog post by John Resig (http://ejohn.org/blog/javascript-micro-templating/) and it is intended to be loosely translateable to a more comprehensive template language like mustache easily
							$.extend({
								quicktmpl: function (template) {return new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+template.replace(/[\r\t\n]/g," ").split("{{").join("\t").replace(/((^|\}\})[^\t]*)'/g,"$1\r").replace(/\t:(.*?)\}\}/g,"',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'")+"');}return p.join('');")}
							});

							$.extend(Date.prototype, {
							  //provides a string that is _year_month_day, intended to be widely usable as a css class
							  toDateCssClass:  function () { 
								return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate(); 
							  },
							  //this generates a number useful for comparing two dates; 
							  toDateInt: function () { 
								return ((this.getFullYear()*12) + this.getMonth())*32 + this.getDate(); 
							  },
							  toTimeString: function() {
								var hours = this.getHours(),
									minutes = this.getMinutes(),
									hour = (hours > 12) ? (hours - 12) : hours,
									ampm = (hours >= 12) ? ' pm' : ' am';
								if (hours === 0 && minutes===0) { return ''; }
								if (minutes > 0) {
								  return hour + ':' + minutes + ampm;
								}
								return hour + ampm;
							  }
							});


							(function ($) {

							  //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
							  var t = $.quicktmpl($('#tmpl').get(0).innerHTML);
							  
							  function calendar($el, options) {
								//actions aren't currently in the template, but could be added easily...
								$el.on('click', '.js-cal-prev', function () {
								  switch(options.mode) {
								  case 'year': options.date.setFullYear(options.date.getFullYear() - 1); break;
								  case 'month': options.date.setMonth(options.date.getMonth() - 1); break;
								  case 'week': options.date.setDate(options.date.getDate() - 7); break;
								  case 'day':  options.date.setDate(options.date.getDate() - 1); break;
								  }
								  draw();
								}).on('click', '.js-cal-next', function () {
								  switch(options.mode) {
								  case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
								  case 'month': options.date.setMonth(options.date.getMonth() + 1); break;
								  case 'week': options.date.setDate(options.date.getDate() + 7); break;
								  case 'day':  options.date.setDate(options.date.getDate() + 1); break;
								  }
								  draw();
								}).on('click', '.js-cal-option', function () {
								  var $t = $(this), o = $t.data();
								  if (o.date) { o.date = new Date(o.date); }
								  $.extend(options, o);
								  draw();
								}).on('click', '.js-cal-years', function () {
								  var $t = $(this), 
									  haspop = $t.data('popover'),
									  s = '', 
									  y = options.date.getFullYear() - 2, 
									  l = y + 5;
								  if (haspop) { return true; }
								  for (; y < l; y++) {
									s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">'+y + '</button>';
								  }
								  $t.popover({content: s, html: true, placement: 'auto top'}).popover('toggle');
								  return false;
								}).on('click', '.event', function () {
								  /*var $t = $(this), 
									  index = +($t.attr('data-index')), 
									  haspop = $t.data('popover'),
									  data, time;
									  
								  if (haspop || isNaN(index)) { return true; }
								  data = options.data[index];
								  time = data.start.toTimeString();
								  if (time && data.end) { time = time + ' - ' + data.end.toTimeString(); }
								  $t.data('popover',true);
								  $t.popover({content: '<p><strong>' + time + '</strong></p>'+data.text, html: true, placement: 'auto left'}).popover('toggle');
								  return false;*/
								});
								function dayAddEvent(index, event) {
								  if (!!event.allDay) {
									monthAddEvent(index, event);
									return;
								  }
								  var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
									  start = event.start,
									  end = event.end || start,
									  time = event.start.toTimeString(),
									  hour = start.getHours(),
									  timeclass = '.time-22-0',
									  startint = start.toDateInt(),
									  dateint = options.date.toDateInt(),
									  endint = end.toDateInt();
								  if (startint > dateint || endint < dateint) { return; }
								  
								  if (!!time) {
									$event.html('<strong>' + time + '</strong> ' + $event.html());
								  }
								  $event.toggleClass('begin', startint === dateint);
								  $event.toggleClass('end', endint === dateint);
								  if (hour < 6) {
									timeclass = '.time-0-0';
								  }
								  if (hour < 22) {
									timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
								  }
								  $(timeclass).append($event);
								}
								
								function monthAddEvent(index, event) {
								  var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
									  e = new Date(event.start),
									  dateclass = e.toDateCssClass(),
									  day = $('.' + e.toDateCssClass()),
									  empty = $('<div/>', {'class':'clear event', html:'&nbsp;'}), 
									  numbevents = 0, 
									  time = event.start.toTimeString(),
									  endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
									  checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate()+40),
									  existing,
									  i;
								  $event.toggleClass('all-day', !!event.allDay);
								  if (!!time) {
									$event.html('<strong>' + time + '</strong> ' + $event.html());
								  }
								  if (!event.end) {
									$event.addClass('begin end');				        
									$('.' + event.start.toDateCssClass()).append($event);
									$('.begin').parent('td').find('.date').addClass('absent');
									return;
								  }
										
								  while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
									if(day.length) { 
									  existing = day.find('.event').length;
									  numbevents = Math.max(numbevents, existing);
									  for(i = 0; i < numbevents - existing; i++) {
										day.append(empty.clone());
									  }
									  day.append(
										$event.
										toggleClass('begin', dateclass === event.start.toDateCssClass()).
										toggleClass('end', dateclass === event.end.toDateCssClass())
									  );
									  $event = $event.clone();
									  $event.html('&nbsp;');
									}
									e.setDate(e.getDate() + 1);
									dateclass = e.toDateCssClass();
									day = $('.' + dateclass);
								  }
								}
								function yearAddEvents(events, year) {
								  var counts = [0,0,0,0,0,0,0,0,0,0,0,0];
								  $.each(events, function (i, v) {
									if (v.start.getFullYear() === year) {
										counts[v.start.getMonth()]++;
									}
								  });
								  $.each(counts, function (i, v) {
									if (v!==0) {
										$('.month-'+i).append('<span class="badge badge-info">'+v+'</span>');
									}
								  });
								}
								
								function draw() {
								  $el.html(t(options));
								  //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
								  $('.' + (new Date()).toDateCssClass()).addClass('today');
								  if (options.data && options.data.length) {
									if (options.mode === 'year') {
										yearAddEvents(options.data, options.date.getFullYear());
									} else if (options.mode === 'month' || options.mode === 'week') {
										$.each(options.data, monthAddEvent);
									} else {
										$.each(options.data, dayAddEvent);
									}
								  }
								}
								
								draw();    
							  }
							  
							  ;(function (defaults, $, window, document) {
								$.extend({
								  calendar: function (options) {
									return $.extend(defaults, options);
								  }
								}).fn.extend({
								  calendar: function (options) {
									options = $.extend({}, defaults, options);
									return $(this).each(function () {
									  var $this = $(this);
									  calendar($this, options);
									});
								  }
								});
							  })({
								days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
								months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
								shortMonths: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
								date: (new Date()),
									daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
									todayname: "Today",
									thismonthcss: "current",
									lastmonthcss: "outside",
									nextmonthcss: "outside",
								mode: "month",
								data: []
							  }, jQuery, window, document);
								
							})(jQuery);

							var data = [],
								date = new Date(),
								d = date.getDate(),
								d1 = d,
								m = date.getMonth(),
								y = date.getFullYear(),
								i,
								end, 
								j, 
								c = 1063, 
								c1 = 3329,
								h, 
								m,
								names = ['All Day Event', 'Long Event', 'Birthday Party', 'Repeating Event', 'Training', 'Meeting', 'Mr. Behnke', 'Date', 'Ms. Tubbs'],
								//slipsum = ["Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.", "Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.", "Yeah, I like animals better than people sometimes... Especially dogs. Dogs are the best. Every time you come home, they act like they haven't seen you in a year. And the good thing about dogs... is they got different dogs for different people. Like pit bulls. The dog of dogs. Pit bull can be the right man's best friend... or the wrong man's worst enemy. You going to give me a dog for a pet, give me a pit bull. Give me... Raoul. Right, Omar? Give me Raoul.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man."];
								slipsum = ["", "", "", "", "", "", "", "", "", ""];

							  /*for(i = 0; i < 25; i++) {
								j = Math.max(i % 15 - 10, 0);
								//c and c1 jump around to provide an illusion of random data
								c = (c * 1063) % 1061; 
								c1 = (c1 * 3329) % 3331;
								d = (d1 + c + c1) % 839 - 440;
								h = i % 36;
								m = (i % 4) * 15;
								if (h < 18) { h = 0; m = 0; } else { h = Math.max(h - 24, 0) + 8; }
								end = !j ? null : new Date(y, m, d + j, h + 2, m);
								data.push({ title: names[c1 % names.length], start: new Date(y, m, d, h, m), end: end, allDay: !(i % 6), text: slipsum[ slipsum.length ]  });
							  }*/
							  <?php  		
								/*$attend_query = "SELECT * FROM StudentAbsent where StudentID=$studentId";6
								$attend_result = sqlsrv_query( $conn, $attend_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
							  
								while($attend_row = sqlsrv_fetch_array($attend_result)){?>

								  //data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  //});

								//} ?>

								//data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  });

								<?php  	
								$attend_query = "SELECT DISTINCT FromDate,ToDate FROM ITD_Holidays";
								$attend_result = sqlsrv_query( $conn, $attend_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
							  
								while($attend_row = sqlsrv_fetch_array($attend_result)){
									$absent_date = date_format($attend_row['FromDate'], 'Y-m-d');
									$ab_year = explode('-',$absent_date);
									$mondecr = $ab_year['1'] - 1;

									$end_absent_date = date_format($attend_row['ToDate'], 'Y-m-d');
									$end_ab_year = explode('-',$end_absent_date);
									$end_mondecr = $end_ab_year['1'] - 1;
									?>

								  data.push({ title:"testing",start: new Date(<?php echo $ab_year['0'];?>,<?php echo $mondecr;?>, <?php echo $ab_year['2'];?>), end: new Date(<?php echo $end_ab_year['0'];?>,<?php echo $end_mondecr;?>, <?php echo $end_ab_year['2'];?>) });
								  //data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  });

								<?php }?>
							  
							  data.sort(function(a,b) { return (+a.start) - (+b.start); });
							  
							//data must be sorted by start date

							//Actually do everything
							$('#holder').calendar({
							  data: data
							});
							//@ sourceURL=pen.js
							</script>

							<!-- Calendar Ends -->
						</div>
						<div class="col-lg-6 connectedSortable">
							<!-- Map box -->
							<div class="box box-info" id="quicEmail">
								<div class="box-header">
									<i class="fa fa-envelope"></i>
									<h3 class="box-title">Quick Email</h3><hr>
									<!-- tools box -->
									<div class="pull-right box-tools">
										<!-- <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
									</div><!-- /. tools -->
								</div>
								<form name="mails" action="sendingmails.php" method="post">
									<div class="box-body">							
										<div class="form-group">
											<!-- <input type="email" class="form-control" name="emailto" placeholder="Email to:" /> -->
											<div class=" col-md-6">
												<div class="roundedOne">
												  <input type="checkbox" id="RegStudent" name="RegStudent" />
												  <label for="RegStudent"></label><div class="checkbox-text">All Reg. Students</div>
												</div>
											</div>
											<div class=" col-md-6">
											<div class="roundedOne">
												  <input type="checkbox" id="ScStudent" name="ScStudent" />
												  <label for="ScStudent"></label><div class="checkbox-text">All Reg. Students</div>
												</div>
											</div>
											<div class=" col-md-6">
											<div class="roundedOne">
												  <input type="checkbox" id="RegInstuctors" name="RegInstuctors" />
												  <label for="RegInstuctors"></label><div class="checkbox-text">All Reg. Students</div>
												</div>
											</div>
											<div class=" col-md-6">
											<div class="roundedOne">
												  <input type="checkbox" id="ItdInstructor" name="ItdInstructor" />
												  <label for="ItdInstructor"></label><div class="checkbox-text">All Reg. Students</div>
												</div>
											</div>
											<!-- <input type="checkbox" id="RegStudent" name="RegStudent">All Reg. Students<br> -->
											<!-- <input type="checkbox" id="ScStudent" name="ScStudent">All Short Course Students<br> -->
											<!-- <input type="checkbox" id="RegInstuctors" name="RegInstuctors">All Reg. Instructors<br> -->
											<!-- <input type="checkbox" id="ItdInstructor" name="ItdInstructor">All ITD Instuctors		<br>							 -->
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" />
										</div>
										<div>
											<textarea class="textarea" name="message" id="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
										</div>								
										<input type="hidden" class="form-control" name="adminID" id="adminID" value="Admin" /><!-- value="<?php echo $_SESSION['adminID'];?>" -->
									</div>
									<div class="box-footer clearfix">
										<input type="submit" class="pull-right btn btn-default fa fa-arrow-circle-right" id="sendEmail" name="Send" value="Send" />
									</div>
								</form>
							</div>
							<!-- /.box -->
							<div class="modal fade" id="myModal">
							  <div class="modal-dialog" role="document">
								<div class="modal-content" style="background-color:#18D4E4; border-radius:10px;">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel" style="color:#fff;">Oops Sorry..!</h4>
								  </div>
								  <div class="modal-body" align="center">
									No Data Available
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: #C3942E;border-radius: 7px;">Close</button>
									<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
								  </div>
								</div>
							  </div>
							</div>						 
						</div><!-- right col -->
					  </div><!-- /.row (main row) -->
				  </div>

				</section><!-- /.content -->
			  </div><!-- /.content-wrapper -->

			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.2.0
				</div>
				<strong>Copyright &copy; 2014-2015 <a href="#"></a>.</strong> All rights reserved.
			</footer>
			
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->
		

		<!-- jQuery 2.1.4
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script> -->
		<!-- Bootstrap 3.3.2 JS 
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->

		<!-- Page level javascript -->
		<script type="text/javascript">
		/*Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !*/
			$(document).ready(function(){
				$('.filterable .btn-filter').click(function(){
					var $panel = $(this).parents('.filterable'),
					$filters = $panel.find('.filters input'),
					$tbody = $panel.find('.table tbody');
					if ($filters.prop('disabled') == true) {
						$filters.prop('disabled', false);
						$filters.first().focus();
					} else {
						$filters.val('').prop('disabled', true);
						$tbody.find('.no-result').remove();
						$tbody.find('tr').show();
					}
				});

				$('.filterable .filters input').keyup(function(e){
					/* Ignore tab key */
					var code = e.keyCode || e.which;
					if (code == '9') return;
					/* Useful DOM data and selectors */
					var $input = $(this),
					inputContent = $input.val().toLowerCase(),
					$panel = $input.parents('.filterable'),
					column = $panel.find('.filters th').index($input.parents('th')),
					$table = $panel.find('.table'),
					$rows = $table.find('tbody tr');
					/* Dirtiest filter function ever ;) */
					var $filteredRows = $rows.filter(function(){
						var value = $(this).find('td').eq(column).text().toLowerCase();
						return value.indexOf(inputContent) === -1;
					});
					/* Clean previous no-result if exist */
					$table.find('tbody .no-result').remove();
					/* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
					$rows.show();
					$filteredRows.hide();
					/* Prepend no-result row if all rows are filtered */
					if ($filteredRows.length === $rows.length) {
						$table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
					}
				});
			});
		</script>

		<!--<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
	<!-- jQuery UI 1.11.4 -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script type="text/javascript">
	  $.widget.bridge('uibutton', $.ui.button);
	</script>

	<!-- DatePicker -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<script src="assets/dist/js/datepicker.js"></script>
		
	<!-- Bootstrap 3.3.2 JS -->
	<script type="text/javascript">
	$(function () {
	  $("#datepicker").datepicker({ 
			autoclose: true, 
			todayHighlight: true
	  }).datepicker('update', new Date());;
	});
	$('.inputpickertext, i.glyphicon-calendar').click(function(){
		// alert('dasd')
		$('.datepicker').addClass('inputpicker');
	})

	$(window).on('load resize', function(e){								
		var donsize = $('#InstAttendance').height();		
		$('#HolCalendar').css('height', donsize +'px');

		//var audiclasize = $('#quicEmail').height();		
		//alert(audiclasize);
		//$('#AudiClass').css('height', audiclasize +'px');

		var windowWidth = $(window).width();
		if(windowWidth>1198 && windowWidth<1450)
		{
			$('#chart').animate({marginLeft : "-80px"},500);			
		}
		else
		{
			$('#chart').animate({marginLeft: '0px'},500);
		}

	});

	$('#Search').click(function(){
		var Syear = $('#clicking').val();
		var Inuser = $('#Insusers').val();    	
		if(Inuser == "")
		{
			alert('Please Enter Instructor Id');
			$('#Insusers').focus();
			return false;
		}
		else
		{
			$.ajax({
			  url: 'ddonut.php',		      
			  type: "GET",
			  data:{"year":Syear,"Inuser":Inuser},		      		      
			  success: function(data) {
				if(data == "Empty")
				{		      		
					 $('#myModal').modal('show');
				}
				else
				{
					$('#donut-chart').html(data);		       	
				}
			  }
			})
			return false;
		}
		return true;
		//var data="2014";
		//$("#donut-chart").load("ddonut.php?year=2014",{'name':data});
	});
		
		$('#RegStudent').click(function(){    		
			$(this).siblings('.checkbox-text').toggleClass('hello');
		})
		$('#ScStudent').click(function(){    		
			$(this).siblings('.checkbox-text').toggleClass('hello');
		})
		$('#RegInstuctors').click(function(){    		
			$(this).siblings('.checkbox-text').toggleClass('hello');
		})
		$('#ItdInstuctors').click(function(){    		
			$(this).siblings('.checkbox-text').toggleClass('hello');
		})

		
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!-- Housing Scripts -->
		<script type="text/javascript" src="assets/dist/js/Housing-min.js"></script>
		<script type="text/javascript" src="assets/dist/js/Housing.js"></script>		
	<!-- Housing Scripts End -->









<script type="text/javascript">

	var vsino = $('.hsino').width();
	var vctno = $('.hctno').width();
	var vname = $('.hname').width();
	var vbuild = $('.hbuild').width();
	var vblock = $('.hblock').width();
	var vrno = $('.hrno').width();
	var vdep = $('.hdep').width();
	var vstatus = $('.hstatus').width();
	var vedit = $('.vedit').width();

	$(window).load(function(){
		$('.csino').css('width', vsino + 'px');
		$('.cctno').css('width', vctno + 'px');
		$('.cname').css('width', vname + 'px');
		$('.cbuild').css('width', vbuild + 'px');
		$('.cblock').css('width', vblock + 'px');
		$('.crno').css('width', vrno + 'px');
		$('.cdep').css('width', vdep + 'px');
		$('.cstatus').css('width', vstatus + 'px');
		$('.cedit').css('width', vedit + 'px');
	})

</script>








<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>


<?php
	include('Admin_files/includes/footer.php');
?>

<script type="text/javascript" src="assets/dist/js/donut.js"></script>
<script type="text/javascript">
	// jsfiddle configured to load jQuery Sparkline 2.1
// http://omnipotent.net/jquery.sparkline/
// Values to render
 var values = [100.00,100.00,100.00,80.00,80.00,66.67];

// Draw a sparkline for the #sparkline element

<?php
$year = date("Y");
 
	$SqlJan = "SELECT * FROM Complaints where  Complain_on >= '".$year."-01-01' AND Complain_on <=  '".$year."-01-31'"; 
	$SqlJan_result = sqlsrv_query( $conn, $SqlJan ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlJan_countss = sqlsrv_num_rows($SqlJan_result);

	$SqlFeb = "SELECT * FROM Complaints where  Complain_on >= '".$year."-02-01' AND Complain_on <=  '".$year."-02-28'"; 
	$SqlFeb_result = sqlsrv_query( $conn, $SqlFeb ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlFeb_countss = sqlsrv_num_rows($SqlFeb_result);

	$SqlMar = "SELECT * FROM Complaints where  Complain_on >= '".$year."-03-01' AND Complain_on <=  '".$year."-03-31'"; 
	$SqlMar_result = sqlsrv_query( $conn, $SqlMar ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlMar_countss = sqlsrv_num_rows($SqlMar_result);

	$SqlApr = "SELECT * FROM Complaints where  Complain_on >= '".$year."-04-01' AND Complain_on <=  '".$year."-04-30'"; 
	$SqlApr_result = sqlsrv_query( $conn, $SqlApr ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlApr_countss = sqlsrv_num_rows($SqlApr_result);

	$SqlMay = "SELECT * FROM Complaints where  Complain_on >= '".$year."-05-01' AND Complain_on <=  '".$year."-05-31'"; 
	$SqlMay_result = sqlsrv_query( $conn, $SqlMay ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlMay_countss = sqlsrv_num_rows($SqlMay_result);

	$SqlJun = "SELECT * FROM Complaints where  Complain_on >= '".$year."-06-01' AND Complain_on <=  '".$year."-06-30'"; 
	$SqlJun_result = sqlsrv_query( $conn, $SqlJun ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlJun_countss = sqlsrv_num_rows($SqlJun_result);

	$SqlJul = "SELECT * FROM Complaints where  Complain_on >= '".$year."-07-01' AND Complain_on <=  '".$year."-07-31'"; 
	$SqlJul_result = sqlsrv_query( $conn, $SqlJul ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlJul_countss = sqlsrv_num_rows($SqlJul_result);

	$SqlAug = "SELECT * FROM Complaints where  Complain_on >= '".$year."-08-01' AND Complain_on <=  '".$year."-08-31'"; 
	$SqlAug_result = sqlsrv_query( $conn, $SqlAug ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlAug_countss = sqlsrv_num_rows($SqlAug_result);


	$SqlSep = "SELECT * FROM Complaints where  Complain_on >= '".$year."-09-01' AND Complain_on <=  '".$year."-09-30'"; 
	$SqlSep_result = sqlsrv_query( $conn, $SqlSep ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlSep_countss = sqlsrv_num_rows($SqlSep_result);


	$SqlOct = "SELECT * FROM Complaints where  Complain_on >= '".$year."-10-01' AND Complain_on <=  '".$year."-10-31'"; 
	$SqlOct_result = sqlsrv_query( $conn, $SqlOct ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlOct_countss = sqlsrv_num_rows($SqlOct_result);

	

	$SqlNov = "SELECT * FROM Complaints where  Complain_on >= '".$year."-11-01' AND Complain_on <=  '".$year."-11-30'"; 
	$SqlNov_result = sqlsrv_query( $conn, $SqlNov ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlNov_countss = sqlsrv_num_rows($SqlNov_result);

	$SqlDec = "SELECT * FROM Complaints where  Complain_on >= '".$year."-12-01' AND Complain_on <=  '".$year."-12-31'"; 
	$SqlDec_result = sqlsrv_query( $conn, $SqlDec ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlDec_countss = sqlsrv_num_rows($SqlDec_result);

	//complaint complete 

	$SqlJan1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-01-01' AND Complain_on <=  '".$year."-01-31' AND Status ='complete'"; 
	$SqlJan_result1 = sqlsrv_query( $conn, $SqlJan1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlJan_countss1 = sqlsrv_num_rows($SqlJan_result1);

	$SqlFeb1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-02-01' AND Complain_on <=  '".$year."-02-28' AND Status ='complete'"; 
	$SqlFeb_result1 = sqlsrv_query( $conn, $SqlFeb1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlFeb_countss1 = sqlsrv_num_rows($SqlFeb_result1);

	$SqlMar1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-03-01' AND Complain_on <=  '".$year."-03-31' AND Status ='complete'"; 
	$SqlMar_result1 = sqlsrv_query( $conn, $SqlMar1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlMar_countss1 = sqlsrv_num_rows($SqlMar_result1);

	$SqlApr1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-04-01' AND Complain_on <=  '".$year."-04-30' AND Status ='complete'"; 
	$SqlApr_result1 = sqlsrv_query( $conn, $SqlApr1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlApr_countss1 = sqlsrv_num_rows($SqlApr_result1);

	$SqlMay1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-05-01' AND Complain_on <=  '".$year."-05-31' AND Status ='complete'"; 
	$SqlMay_result1 = sqlsrv_query( $conn, $SqlMay1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlMay_countss1 = sqlsrv_num_rows($SqlMay_result1);

	$SqlJun1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-06-01' AND Complain_on <=  '".$year."-06-30' AND Status ='complete'"; 
	$SqlJun_result1 = sqlsrv_query( $conn, $SqlJun1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlJun_countss1 = sqlsrv_num_rows($SqlJun_result1);

	$SqlJul1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-07-01' AND Complain_on <=  '".$year."-07-31' AND Status ='complete'"; 
	$SqlJul_result1 = sqlsrv_query( $conn, $SqlJul1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlJul_countss1 = sqlsrv_num_rows($SqlJul_result1);

	$SqlAug1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-08-01' AND Complain_on <=  '".$year."-08-31' AND Status ='complete'"; 
	$SqlAug_result1 = sqlsrv_query( $conn, $SqlAug1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlAug_countss1 = sqlsrv_num_rows($SqlAug_result1);


	$SqlSep1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-09-01' AND Complain_on <=  '".$year."-09-30' AND Status ='complete'"; 
	$SqlSep_result1 = sqlsrv_query( $conn, $SqlSep1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlSep_countss1 = sqlsrv_num_rows($SqlSep_result1);


	$SqlOct1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-10-01' AND Complain_on <=  '".$year."-10-31' AND Status ='complete'"; 
	$SqlOct_result1 = sqlsrv_query( $conn, $SqlOct1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlOct_countss1 = sqlsrv_num_rows($SqlOct_result1);

	

	$SqlNov1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-11-01' AND Complain_on <=  '".$year."-11-30' AND Status ='complete'"; 
	$SqlNov_result1 = sqlsrv_query( $conn, $SqlNov1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlNov_countss1 = sqlsrv_num_rows($SqlNov_result1);

	$SqlDec1 = "SELECT * FROM Complaints where  Complain_on >= '".$year."-12-01' AND Complain_on <=  '".$year."-12-31' AND Status ='complete'"; 
	$SqlDec_result1 = sqlsrv_query( $conn, $SqlDec1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	$SqlDec_countss1 = sqlsrv_num_rows($SqlDec_result1);




?>


 //$("#sparkline").sparkline([<?php echo $SqlJan_countss+9;?>, <?php echo $SqlFeb_countss+11;?>, <?php echo $SqlMar_countss+12;?>, <?php echo $SqlApr_countss+13;?>, <?php echo $SqlMay_countss+12;?>, <?php echo $SqlJun_countss+13;?>, <?php echo $SqlJul_countss+10;?>, <?php echo $SqlAug_countss+14;?>, <?php echo $SqlSep_countss+11;?>, <?php echo $SqlOct_countss+11;?>, <?php echo $SqlNov_countss+12;?>, <?php echo $SqlDec_countss+11;?>], {
	$("#sparkline").sparkline([9, 11, 12, 13, 12, 13, 10, 14, 13, 11, 11, 12, 11], {
	type: 'bar',
	width: '100',
	barWidth: 7,
	height: '45',
	barColor: '#F36A5B',
	negBarColor: '#e02222',
	tooltipFormat: '{{offset:offset}} {{value}}',
	tooltipValueLookups: {
		'offset': {
			0: 'Jan',
			1: 'Feb',
			2: 'Mar',
			3: 'Apr',
			4: 'May',
			5: 'Jun',
			6: 'Jul',
			7: 'Aug',
			8: 'Sep',
			9: 'Oct',
			10: 'Nov',
			11: 'Dec',
		}
	},
});
   //$("#sparkline2").sparkline([<?php echo $SqlJan_countss1;?>, <?php echo $SqlFeb_countss1;?>, <?php echo $SqlMar_countss1;?>, <?php echo $SqlApr_countss1;?>, <?php echo $SqlMay_countss1;?>, <?php echo $SqlJun_countss1;?>, <?php echo $SqlJul_countss1;?>, <?php echo $SqlAug_countss1;?>, <?php echo $SqlSep_countss1;?>, <?php echo $SqlOct_countss1;?>, <?php echo $SqlNov_countss1;?>, <?php echo $SqlDec_countss1;?>], {
  $("#sparkline2").sparkline([9, 11, 12, 13, 12, 13, 10, 14, 13, 11, 11, 12, 11], {
	type: 'bar',
	width: '100',
	barWidth: 7,
	height: '45',
	barColor: '#5B9BD1',
	negBarColor: '#e02222',
	tooltipFormat: '{{offset:offset}} {{value}}',
	tooltipValueLookups: {
		'offset': {
			0: 'Jan',
			1: 'Feb',
			2: 'Mar',
			3: 'Apr',
			4: 'May',
			5: 'Jun',
			6: 'Jul',
			7: 'Aug',
			8: 'Sep',
			9: 'Oct',
			10: 'Nov',
			11: 'Dec',
		}
	},
});





var HolidayCal = $('.attendanceinstructor').height();
$(window).load(function(){
	// alert(HolidayCal);
	$('.complaints').css('height' , HolidayCal + 'px');
})
$(window).load(function(){

	$('.complaintsorting a').click(function(){
		// alert('adsa');
		$('.complaintsorting').find('a').removeClass('btn-sort');
		$(this).addClass('btn-sort');
	})
	$('.complaintsorting .btn-group .dropdown-menu').css('left' , -70 + 'px');
	// $('.btn-group.btn-group-lg').find('.popover.fade.bottom.in').addClass('poppp');
})



// Slims scroll for complaint box
$(window).load(function() {
  $('complaints .slimScroll')
	.slimscroll({ height: '550px' })
	// .text(text);

  $('.inputpickertext').on('focus click',function(){
		// alert('dasd')
		$('.datepicker').addClass('inputpicker');
	})
	
	$('#ComplaintMonth').click(function() { 
					
					var currentMonth = (new Date).getMonth()+1;
					if(currentMonth < 10){
						currentMonth = '0'+currentMonth;	
					}
					//alert(currentMonth);
					
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Complains.php",
						   data: {"currentMonth": currentMonth,"type":"Month"},
						   success: function(msg){						   	
							 $('#MonthResult').html(msg);
						   }
						});
						return true;
					});
					
					$('#ComplaintYear').click(function() { 
					
					var currentYear = new Date().getFullYear();
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Complains.php",
						   data: {"currentYear": currentYear,"type":"Year"},
						   success: function(msg){						   	
							 $('#MonthResult').html(msg);
						   }
						});
						return true;
					});
										
					
					
					$("#UpdateStatus").change(function() {
							//get the selected value
							var Status = this.value;
							//var Complaint_No = $("#Complaint_No").val();
							
							 var user=$(this).find('input[type="hidden"]').val();
							 //$('input[name=hiddeninputname]').val(theValue);
							
								
							//make the ajax call
							$.ajax({
								
								url: "Admin_files/Admin_Complains.php",
								type: "GET",
								data: {"Status": Status, "Complaint_No": Complaint_No,"type":"ComplaintStatus"},
								success: function() {
									//console.log("Data sent!");
									
								}
							});
						});
					
					
});
		function ShowStatus(a)
		{
			$('#selectStatus'+a).show();
		}
		

</script>