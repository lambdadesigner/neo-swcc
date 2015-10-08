<?php
include('includes/header.php');
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
						Programs
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-10 col-md-offset-1 col-sm-offset-0 col-sm-offset-0">
							 <div class="box box-info">
								<div class="box-header with-border">
								  <h3 class="box-title">Programs</h3>
								  <i class="fa fa-tasks pull-right text-info"></i>
								  <!-- <div class="box-tools pull-right">
									<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								  </div> -->
								</div><!-- /.box-header -->
								<div class="box-body tasks">
								  <div class="table-responsive">
								  <?php 
										
								  ?>
									<table class="table no-margin">
									  <thead>
										<tr>
										  <th>ID</th>
										  <th>Program Name</th>
										  <th>Parent Program</th>
										  <th>Hours</th>
										  <th>Breaks</th>
										  <th>Minutes</th>
										  <th>Start Date</th>
										  <th>End Date</th>
										  <th>Duration</th>
										  <th>Weekdays</th>
										  <th>Is Published</th>
										</tr>
									  </thead>
									  <tbody>
									  <?php 
											$querys =	"SELECT * FROM ITD_Programs";
											$result = sqlsrv_query( $conn, $querys ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$row_count = sqlsrv_num_rows($result);
												while($row = sqlsrv_fetch_array($result)){?>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr><tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>

										<?php } ?>
									  </tbody>
									</table>
								  </div><!-- /.table-responsive -->
								</div><!-- /.box-body -->
								<div class="box-footer clearfix">
								  <!-- <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a> -->
								 <div class="clearfix"></div>
									<ul class="pagination pull-right">
									  <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
									  <li class="active"><a href="#">1</a></li>
									  <li><a href="#">2</a></li>
									  <li><a href="#">3</a></li>
									  <li><a href="#">4</a></li>
									  <li><a href="#">5</a></li>
									  <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
									</ul>
								</div><!-- /.box-footer -->
							  </div><!-- /.box -->
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
										<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
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
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Swcc App -->
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>
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
	</body>
</html>
