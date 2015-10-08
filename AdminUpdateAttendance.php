<?php
include('Admin_files/includes/header.php');
$StudentID = $_SESSION['StudentID'];

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
				.styled-select select {
					color:#ffffff;
				    background: #12C3AA;
				    padding: 10px;										    
				    font-size: 16px;
				    line-height: 1;
				    border: 0;
				}
				.border table {
				    border: 1px solid #ccc !important;
				    margin-bottom: 20px;
				}

			</style>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						<!-- Schedules -->
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>

				<!-- Main content -->
				
				<!-- Edit Schedulesss Start -->
				<?php if($_GET['action']=="Edit" && $_GET['stuID']!=""){
						if(isset($_POST['Supdate'])){
						$StudentID =$_POST['StudentID'];
						$AbsentDate =$_POST['DateAbsent'];
						$Module =$_POST['Module'];
						$StudentClass =$_POST['StudentClass'];
						$Status =$_POST['Status'];
						$Reason =$_POST['Reason'];
						$Cycle =$_POST['Cycle'];
						
						 $sql="UPDATE StudentAbsent SET StudentClass='". $StudentClass."', Status='".$Status."',Reason='".$Reason."', Cycle='".$Cycle."' WHERE StudentID='".$_GET['stuID']."' AND DateAbsent='".$AbsentDate."' AND Module='".$Module."'";

						$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
						}
					?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
										
											<h3 class="panel-title text-red"><i class="fa fa-pencil fa-lg"></i> Edit Attendance
												<!-- <div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
												</div> -->
											</h3>
											<hr>
										</div>																			

										<!-- Add / Edit Student Instructor -->
										<style type="text/css">									
										.col-md-3.text-right{
											padding-top: 18px;
										}
										.text-danger.fa.fa-star{
											font-size: 7px;										
										}
										.datepicker{z-index:1151 !important;}
										ul.select-options {
											min-height: 240px;
										}
										.styled-select select {
											color:#ffffff;
										    background: #12C3AA;
										    padding: 10px;										    
										    font-size: 16px;
										    line-height: 1;
										    border: 0;
										}
										</style>

										<?php
											$editStudsql = "SELECT * from StudentAbsent WHERE StudentID='".$_GET['stuID']."'";
											$editStudresult = sqlsrv_query( $conn, $editStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$EditStud_row = sqlsrv_fetch_array($editStudresult)?>
										<div class="modals" id="mySchedules">
										  	<form name="scheduleAdd" method="post" action="">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Attendance</h3>
											      	</div><br>
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
														<div class="col-md-3 text-right">
															Student ID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="StudentID" name="StudentID" placeholder="Student ID" class="input" data-toggle="tooltip" data-placement="right" title="Student ID" required style="width:100%;" value="<?php echo $EditStud_row['StudentID'];?>" readonly>
														</div>
													</div>
											      	<div class="row">
														<div class="col-md-3 text-right">
															Absent Date<i class="fa fa-star text-danger"></i>
														</div>
														
														
														    <input class="input" type="text" name="DateAbsent" id="DateAbsent" value="<?php echo date_format($EditStud_row['DateAbsent'],"Y-m-d");?>" readonly>
														    
														
														
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Module<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Module" name="Module" placeholder="Module" class="input" data-toggle="tooltip" data-placement="right" title="Module" required style="width:100%;" onchange="showDay(this.value);"
															value="<?php echo $EditStud_row['Module'];?>">														
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Student Class<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="StudentClass" name="StudentClass" placeholder="StudentClass" class="input" data-toggle="tooltip" data-placement="right" title="Student Class" required style="width:100%;" value="<?php echo $EditStud_row['StudentClass'];?>">
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Status<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">										
															<select name="Status" id="Status" style="width:515px;">
																
																<option value="Absent">Absent</option>
																<option value="Present">Present</option>
															</select>				
															
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Reason<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Reason" name="Reason" placeholder="Reason" class="input" data-toggle="tooltip" data-placement="right" title="Reason"  style="width:100%;" value="<?php echo $EditStud_row['Reason'];?>">
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Cycle<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Cycle" name="Cycle" placeholder="Cycle" class="input" data-toggle="tooltip" data-placement="right" title="Reason" required style="width:100%;" value="<?php echo $EditStud_row['Cycle'];?>">
														</div>
													</div>
													
													
													
													<br>
													<div class="modal-footer">
														<input type="submit" class="btn btn-primary"  data-dismiss="modal" id="AddCategory" name="Supdate">
													</div>
											    </div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</section><!-- /.content -->
				<?php } ?>
				
				<?php if($_GET['action']=="Edit" && $_GET['SCstuID']!=""){
						if(isset($_POST['Scupdate'])){
						$EmpID =$_POST['EmpID'];
						$SCID =$_POST['SCID'];
						
						$AttendanceDate =$_POST['AttendanceDate'];
						$AttendanceStatus =$_POST['AttendanceStatus'];
						$Reason =$_POST['Reason'];
						$SCClass =$_POST['SCClass'];
						
						 $sql="UPDATE SCAttendance SET AttendanceStatus='". $AttendanceStatus."', Reason='".$Reason."', SCClass='".$SCClass."' WHERE EmpID='".$_GET['SCstuID']."' AND AttendanceDate='".$AttendanceDate."' AND SCID='".$SCID."'";

						$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
						}
					?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
										
											<h3 class="panel-title text-red"><i class="fa fa-pencil fa-lg"></i> Edit Attendance
												<!-- <div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
												</div> -->
											</h3>
											<hr>
										</div>																			

										<!-- Add / Edit Student Instructor -->
										<style type="text/css">									
										.col-md-3.text-right{
											padding-top: 18px;
										}
										.text-danger.fa.fa-star{
											font-size: 7px;										
										}
										.datepicker{z-index:1151 !important;}
										ul.select-options {
											min-height: 240px;
										}
										.styled-select select {
											color:#ffffff;
										    background: #12C3AA;
										    padding: 10px;										    
										    font-size: 16px;
										    line-height: 1;
										    border: 0;
										}
										</style>

										<?php
											$editStudsql = "SELECT * from SCAttendance WHERE EmpID='".$_GET['SCstuID']."'";
											$editStudresult = sqlsrv_query( $conn, $editStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$EditStud_row = sqlsrv_fetch_array($editStudresult)?>
										<div class="modals" id="mySchedules">
										  	<form name="scheduleAdd" method="post" action="">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Attendance</h3>
											      	</div><br>
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
														<div class="col-md-3 text-right">
															EmpID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="EmpID" name="EmpID" placeholder="EmpID" class="input" data-toggle="tooltip" data-placement="right" title="EmpID" required style="width:100%;" value="<?php echo $EditStud_row['EmpID'];?>" readonly>
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															SCID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="SCID" name="SCID" placeholder="SCID" class="input" data-toggle="tooltip" data-placement="right" title="SCID" required style="width:100%;" value="<?php echo $EditStud_row['SCID'];?>" readonly>
														</div>
													</div>
													
													
													
											      	<div class="row">
														<div class="col-md-3 text-right">
															Attendance Date<i class="fa fa-star text-danger"></i>
														</div>
														
														
														    <input class="input" type="text" name="AttendanceDate" id="AttendanceDate" value="<?php echo date_format($EditStud_row['AttendanceDate'],"Y-m-d");?>" readonly>
														    
														
														
													</div>
													
													
													
													
													<div class="row">
														<div class="col-md-3 text-right">
															Status<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">										
															<select name="AttendanceStatus" id="AttendanceStatus" style="width:515px;">
																
																<option value="Absent">Absent</option>
																<option value="Present">Present</option>
															</select>				
															
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Reason<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Reason" name="Reason" placeholder="Reason" class="input" data-toggle="tooltip" data-placement="right" title="Reason"  style="width:100%;" value="<?php echo $EditStud_row['Reason'];?>">
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															SCClass<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="SCClass" name="SCClass" placeholder="SCClass" class="input" data-toggle="tooltip" data-placement="right" title="SCClass" required style="width:100%;" value="<?php echo $EditStud_row['SCClass'];?>">
														</div>
													</div>
													
													
													
													<br>
													<div class="modal-footer">
														<input type="submit" class="btn btn-primary"  data-dismiss="modal" id="AddCategory" name="Scupdate">
													</div>
											    </div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</section><!-- /.content -->
				<?php } ?> 
				
				<?php if($_GET['action']=="Edit" && $_GET['InsID']!=""){
						if(isset($_POST['Insupdate'])){
						$OriginalInstructor =$_POST['OriginalInstructor'];
						$SubstituteInstructor =$_POST['SubstituteInstructor'];
						$ClassDate =$_POST['ClassDate'];
						$ClassSession =$_POST['ClassSession'];
						
						
						 $sql="UPDATE AttendanceDelegation SET SubstituteInstructor='". $SubstituteInstructor."', ClassSession='".$ClassSession."' WHERE OriginalInstructor='".$_GET['InsID']."' AND ClassDate='".$ClassDate."'";

						$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
						}
					?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
										
											<h3 class="panel-title text-red"><i class="fa fa-pencil fa-lg"></i> Edit Attendance
												<!-- <div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
												</div> -->
											</h3>
											<hr>
										</div>																			

										<!-- Add / Edit Student Instructor -->
										<style type="text/css">									
										.col-md-3.text-right{
											padding-top: 18px;
										}
										.text-danger.fa.fa-star{
											font-size: 7px;										
										}
										.datepicker{z-index:1151 !important;}
										ul.select-options {
											min-height: 240px;
										}
										.styled-select select {
											color:#ffffff;
										    background: #12C3AA;
										    padding: 10px;										    
										    font-size: 16px;
										    line-height: 1;
										    border: 0;
										}
										</style>

										<?php
											$editStudsql = "SELECT * from AttendanceDelegation WHERE OriginalInstructor='".$_GET['InsID']."'";
											$editStudresult = sqlsrv_query( $conn, $editStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$EditStud_row = sqlsrv_fetch_array($editStudresult)?>
										<div class="modals" id="mySchedules">
										  	<form name="scheduleAdd" method="post" action="">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Attendance</h3>
											      	</div><br>
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
														<div class="col-md-3 text-right">
															Original Instructor<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="OriginalInstructor" name="OriginalInstructor" placeholder="Original Instructor" class="input" data-toggle="tooltip" data-placement="right" title="Original Instructor" required style="width:100%;" value="<?php echo $EditStud_row['OriginalInstructor'];?>" readonly>
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Substitute Instructor<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">										
															<select name="SubstituteInstructor" id="SubstituteInstructor" style="width:515px;">
																<?php 
																	$sql = " select SubstituteInstructor from AttendanceDelegation";
																	$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																	while($row = sqlsrv_fetch_array($result)){
																?>
																<option value="<?php echo $row['SubstituteInstructor'] ?>"><?php echo $row['SubstituteInstructor'] ?></option>
																	<?php }?>
															</select>				
															
														</div>
													</div><br>
													
													
													
											      	<div class="row">
														<div class="col-md-3 text-right">
															Attendance Date<i class="fa fa-star text-danger"></i>
														</div>
														
														
														    <input class="input" type="text" name="ClassDate" id="ClassDate" value="<?php echo date_format($EditStud_row['ClassDate'],"Y-m-d");?>" readonly>
														    
														
														
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Class Session<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="ClassSession" name="ClassSession" placeholder="ClassSession" class="input" data-toggle="tooltip" data-placement="right" title="ClassSession"  style="width:100%;" value="<?php echo $EditStud_row['ClassSession'];?>">
														</div>
													</div>
													
													
													
													
													
													<br>
													<div class="modal-footer">
														<input type="submit" class="btn btn-primary"  data-dismiss="modal" id="AddCategory" name="Insupdate">
													</div>
											    </div>
											</form>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</section><!-- /.content -->
				<?php } ?> 
				
				
				
				
				<!-- Edit Schedulesss End -->

			</div><!-- /.content-wrapper -->

			<!-- Schedules Edit -->
			<?php
				/*$il=1;
				$edStudsql = "SELECT TOP 50 * from Schdule order by Date desc";
				$edStudresult = sqlsrv_query( $conn, $edStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
				while($EditStud = sqlsrv_fetch_array($edStudresult)){?>
				<div class="modal fade" id="myModal<?php echo $il;?>" role="dialog">
					<div class="modal-dialog modal-captain">
					 	<div class="modal-header" style="background-color:#fff;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  	<h4 class="modal-title"><?php echo $EditStud['ModuleID']?></h4>
						</div>
					  	<!-- Modal content-->
					  	<div class="modal-content">
					  		<form name="editHoliday" method="post" action="AddSchedule.php">					
								<div class="modal-header">									        
						        	<h3 class="modal-title" id="myModalLabel">Edit Schedule</h3>
						      	</div><br>
						      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
								<div class="row">
									<div class="col-md-3 text-right">
										Module Id<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="ModuleId1" name="ModuleId1" placeholder="Module Id" class="input" data-toggle="tooltip" data-placement="right" title="Module Id" required style="width:100%;" value="<?php echo $EditStud['ModuleID'];?>">
									</div>
								</div>
						      	<div class="row">
									<div class="col-md-3 text-right">
										Schedule Date<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="ScheDate1" name="ScheDate1" placeholder="Schedule Date" class="input" data-toggle="tooltip" data-placement="right" title="Schedule Date" required style="width:100%;" onchange="showDay(this.value);" value="<?php echo date_format($EditStud['Date'],"Y-m-d");?>">														
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Day<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="ScheDay1" name="ScheDay1" placeholder="Schedule Day" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Schedule Day" readonly required style="width:100%;" value="<?php echo $EditStud['Day'];?>">
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-3 text-right">
										Session Id<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">										
										<select name="SchesessionId1" id="SchesessionId1" style="width:390px;">
											<option value="">Select Session ID</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
										</select>		
										<script type="text/javascript">
										for(var i=0;i<document.getElementById('SchesessionId1').length;i++)
			                            {
			            					if(document.getElementById('SchesessionId1').options[i].value=="<?php echo $EditStud['SessionID'] ?>")
			            					{
			            						document.getElementById('SchesessionId1').options[i].selected=true;
			            					}
			                            }		
										</script>		
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-3 text-right">
										Instuctor<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">
										<?php 
											$Instsql = "SELECT * FROM Instructors";
											$Instresult = sqlsrv_query( $conn, $Instsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>
										<select name="InstrucId1" id="InstrucId1" style="width:390px;">
											<option value="">Select Instructor Name</option>
											<?php while($group_row = sqlsrv_fetch_array($Instresult)){?>
												<option value="<?php echo $group_row['InstructorID'];?>"><?php echo $group_row['InstructorName'];?></option>
											<?php } ?>
										</select>
										<script type="text/javascript">
										for(var i=0;i<document.getElementById('InstrucId1').length;i++)
			                            {
			            					if(document.getElementById('InstrucId1').options[i].value=="<?php echo $EditStud['InstructorID'] ?>")
			            					{
			            						document.getElementById('InstrucId1').options[i].selected=true;
			            					}
			                            }		
										</script>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-3 text-right">
										Group Id<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">
										<?php 
											$grpIdsql = "SELECT * FROM SGroup";
											$grpIdresult = sqlsrv_query( $conn, $grpIdsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>
										<select name="SGroupId1" id="SGroupId1" style="width:390px;">
											<option value="">Select Group Name</option>
											<?php while($groupId_row = sqlsrv_fetch_array($grpIdresult)){?>
												<option value="<?php echo $groupId_row['GroupID'];?>"><?php echo $groupId_row['GroupName'];?></option>
											<?php } ?>
										</select>
										<script type="text/javascript">
										for(var i=0;i<document.getElementById('SGroupId1').length;i++)
			                            {
			            					if(document.getElementById('SGroupId1').options[i].value=="<?php echo $EditStud['GroupID'] ?>")
			            					{
			            						document.getElementById('SGroupId1').options[i].selected=true;
			            					}
			                            }		
										</script>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-3 text-right">
										Start Time<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="startTime1" name="startTime1" placeholder="Start Time" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Start Time" readonly required style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										End Time<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="endTime" name="endTime" placeholder="End Time" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="End Time" readonly required style="width:100%;">
									</div>
								</div><br>
								<br>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary"  data-dismiss="modal" id="AddCategory">Submit</button>
								</div>		  
							</form>
					  	</div>
					</div>
				</div>
				<?php $il++; } */?>

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
		<!-- Bootstrap 3.3.2 JS 
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/dist/js/bootstrap-clockpicker.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap-clockpicker.min.css">
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
			
			$(function () {
				$("#ScheDate").datepicker({ 
			        autoclose: true, 
			        todayHighlight: true,
			        format:'yyyy-mm-dd'
				}).datepicker('', new Date());;
			});

			$(document).ready(function() {
			    $('#schedules').DataTable( {
			    } );

			    $('#justs').click(function(){				
				    $('#ScheduleRows').fadeToggle("slow","linear");				    
				    $('#myModalss').fadeToggle("fast");
				    $('#addd').toggle();
				    $('#vie').toggle();
				});


				var input = $('#startTime').clockpicker({
				    placement: 'bottom',
				    align: 'left',
				    autoclose: true,
				    'default': 'now'
				});

				var input = $('#endTime').clockpicker({
				    placement: 'bottom',
				    align: 'left',
				    autoclose: true,
				    'default': 'now'
				});
			} );

			function showDay(da)
			{
				var date = new Date(da).getDay();
				if(date=="0")
				{
					var Wday = "Sunday";
				}
				if(date=="1")
				{
					var Wday = "Monday";
				}
				if(date=="2")
				{
					var Wday = "Tuesday";
				}
				if(date=="3")
				{
					var Wday = "Wednesday";
				}
				if(date=="4")
				{
					var Wday = "Thursday";
				}
				if(date=="5")
				{
					var Wday = "Friday";
				}
				if(date=="6")
				{
					var Wday = "Saturday";
				}
				//alert(Wday);
			    document.getElementById("ScheDay").value = Wday;			    
			}
			/*$(function () {
			  $("#DateAbsent").datepicker({ 
			        autoclose: true, 
			        format: 'yyyy-mm-dd',
			        todayHighlight: true
			  }).datepicker('yy-mm-dd', new Date());;
			  
			  $("#AttendanceDate").datepicker({ 
			        autoclose: true, 
			        format: 'yyyy-mm-dd',
			        todayHighlight: true
			  }).datepicker('yy-mm-dd', new Date());;
			  
			  $("#ClassDate").datepicker({ 
			        autoclose: true, 
			        format: 'yyyy-mm-dd',
			        todayHighlight: true
			  }).datepicker('yy-mm-dd', new Date());;
			  
			  
			  
			});*/  
		</script>


<?php 
	include("Admin_files/includes/footer.php")
?>