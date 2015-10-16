<?php
include('Admin_files/includes/header.php');
$StudentID = $_SESSION['StudentID'];
$AdminId = $_SESSION['AdminId'];
$AdminUserName = $_SESSION['AdminUserName'];
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql= "select TOP 50 * from Schdule order by Date desc ";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_GET['action']=="delete")
{	
	$delsql = "DELETE FROM SCMarks WHERE WHERE SCID='".$_GET['SCID']."' AND EmpID='".$_GET['EmpID']."'";
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminSCMarks');
}
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
			.dataTable tr{
			  background: #C9F3E5;			  
			}
			#justs{
				background-color: #C9F3E5;
			}
			#justs:hover{
				background-color: #6DEAB1 !important;
			}

			</style>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Short Course Marks
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="Admin"><i class="fa fa-dashboard text-default"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-university"></i> Short Course</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<!-- Showing Schedules -->
				<?php if($_GET['action']=="" && $_GET['EmpID']==""){?>
					<section class="content">
						<div class="panel box box-default">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">
											<?php if($_GET['err']=="success"){?>
												<span style="text-align:center; margin-left:500px; position:absolute;height:44px;padding-top:10px;" class="alert alert-success" id="succesd">
													Schedule Successfully Added....
												</span>
												<script type="text/javascript">
													setTimeout(function() { $("#succesd").fadeOut("slow"); }, 2000);
												</script>
											<?php } ?>
											
											<button type="button" class="btn btn-default pull-right" id="justs">
		  										<span id="addd"><i class="fa fa-plus"></i> Add</span><span id="vie" style="display:none"><i class="fa fa-eye"></i> View</span> Marks
											</button>
											<h3 class="panel-title text-default"><!-- <i class="fa fa-pencil fa-lg"></i> Marks -->&nbsp;
												<!-- <div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>&nbsp;&nbsp;&nbsp;
												</div> -->
											</h3>
											<br>
										</div>
										
										<div class="tab-content panel-body" id="ScheduleRows">									
											<table class="table table-striped border" id="Scmarks">
												<thead>
													<tr class="filters">
														<th><!-- <input type="text" class="form-control" placeholder="S.No" > -->S.No</th>
														<th><input type="text" class="form-control" placeholder="Short Course ID" ></th>
														<th><input type="text" class="form-control" placeholder="Employee ID" ></th>
														<th><input type="text" class="form-control" placeholder="Attendance" ></th>
														<th><input type="text" class="form-control" placeholder="Activities" ></th>
														<th><input type="text" class="form-control" placeholder="Participation" ></th>
														<th><input type="text" class="form-control" placeholder="Exam" ></th>
														
														<th></th>
														<th></th>
													</tr>
													<!--<tr>
														<th>S.No</th>
														<th>Module ID</th>
														<th>Day</th>
														<th>Date</th>
														<th>Session ID</th>
														<th>Instructor Id</th>
														<th>Start Time</th>
														<th>End Time</th>
														<th>Edit</th>
														<th>Delete</th>
													</tr>-->
												</thead>
												<tbody>
												<?php 
												$sql = "SELECT * FROM SCMarks";
												$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												$jkl = 1;
												while($row = sqlsrv_fetch_array($result)){ ?>
												
												
												
													<tr><td><?php echo $jkl;?></td>
														<td><?php echo $row['SCID']?></td>
														<td><?php echo $row['EmpID']?></td>
														<td><?php echo $row['Attendance']?></td>
														<td><?php echo $row['Activities']?></td>
														<td><?php echo $row['Participation']?></td>
														<td><?php echo $row['Exam']?></td>
														<!-- <td><a data-toggle="modal" data-target="#myModal<?php echo $jkl;?>" style="cursor:pointer">Edit</a> </td> -->
														<td><a href="AdminSCMarks?action=Edit&EmpID=<?php echo $row['EmpID'];?>&SCID=<?php echo $row['SCID'];?>" style="cursor:pointer"> <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a> </td>
														<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminSCMarks?action=Edit&EmpID=<?php echo $row['EmpID'];?>&SCID=<?php echo $row['SCID'];?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger" data-toggle="tooltip" data-placement="top" title="Click to delete"></i></a> </td>
													</tr>
												<?php $jkl++; }?>											
													
												</tbody>
											</table>
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
										</style>
										<?php
											if(isset($_POST['AddMarks'])){
												
											$sql="INSERT INTO SCMarks(SCID,EmpID,Attendance,Activities,Participation,Exam)VALUES('".$_POST['SCID']."','".$_POST['EmpID']."','".$_POST['Attendance']."','".$_POST['Activities']."','".$_POST['Participation']."','".$_POST['Exam']."')";	
											$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
											header('location:AdminSCMarks');	
											}
										
										?>
										<div class="row">
											<div class="col-md-6 col-md-offset-3">
												<div class="modals box box-default" id="myModalss" style="display:none;">
												  <!-- <div class="modal-dialog" role="document"> -->
												  	<form name="AddMarks" method="post" action="">
													    <div class="modal-content">
													      	<div class="modal-header">									        
													        	<h3 class="modal-title" id="myModalLabel">Add Marks</h3>
													      	</div><br>
													      	<input type="hidden" name="scenario" id="scenario" value="addAdmSchedule">										      	
															<div class="row">
																<div class="col-md-3 text-right">
																	Short Course ID*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="SCID" name="SCID" placeholder="SCID" class="form-control" data-toggle="tooltip" data-placement="right" title="SCID" required style="width:100%;">
																</div>
															</div><br>
													      	<div class="row">
																<div class="col-md-3 text-right">
																	Employee ID*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="EmpID" name="EmpID" placeholder="EmpID" class="form-control" data-toggle="tooltip" data-placement="right" title="EmpID" required style="width:100%;" onchange="showDay(this.value);">														
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Attendance*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Attendance" name="Attendance" placeholder="Schedule Day" class="form-control" data-toggle="tooltip" data-placement="right" title="Attendance"  required style="width:100%;">														
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Activities*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Activities" name="Activities" placeholder="Activities" class="form-control" data-toggle="tooltip" data-placement="right" title="Activities" required style="width:100%;">														
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Participation*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Participation" name="Participation" placeholder="Participation" class="form-control" data-toggle="tooltip" data-placement="right" title="Participation"  required style="width:100%;">														
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Exam*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Exam" name="Exam" placeholder="Exam" class="form-control" data-toggle="tooltip" data-placement="right" title="Exam"  required style="width:100%;">														
																</div>
															</div><br>
															<div class="modal-footer">
																<input type="submit" class="btn btn-default"  data-dismiss="modal" id="AddMarks" name="AddMarks">
															</div>
													    </div>
													</form>
												  <!-- </div> -->
												</div>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</section><!-- /.content -->
				<?php } ?>
				<!-- End Show Schedules -->
				
				<!-- Edit Schedulesss Start -->
				<?php if($_GET['action']=="Edit" && $_GET['EmpID']!=""){?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
											<a href="AdminSCMarks" class="btn btn-default pull-right">View Marks</a>
											<h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Edit Marks
												<!-- <div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
												</div> -->
											</h3>
											<hr>
										</div>																			
										<?php
											if(isset($_POST['editMarks'])){
											$sql="UPDATE SCMarks SET SCID ='".$_POST['SCID']."',EmpID ='".$_POST['EmpID']."',Attendance ='".$_POST['Attendance']."',Activities ='".$_POST['Activities']."',Participation ='".$_POST['Participation']."',Exam='".$_POST['Exam']."' WHERE SCID='".$_GET['SCID']."' AND EmpID='".$_GET['EmpID']."'";	
											$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											header('location:AdminSCMarks');
											}
										?>
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
											$sql = "SELECT * from SCMarks WHERE SCID='".$_GET['SCID']."' AND EmpID='".$_GET['EmpID']."'";
											$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$row = sqlsrv_fetch_array($result)?>
										<div class="modals" id="mySchedules">
										  	<form name="EditMarks" method="post" action="">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Marks</h3>
											      	</div><br>
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
																<div class="col-md-3 text-right">
																	Short Course ID*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="SCID" name="SCID" placeholder="SCID" class="input" data-toggle="tooltip" data-placement="right" title="SCID" required style="width:100%;" value="<?php echo $row['SCID']?>">
																</div>
															</div>
											      	
													<div class="row">
																<div class="col-md-3 text-right">
																	Employee ID*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="EmpID" name="EmpID" placeholder="EmpID" class="input" data-toggle="tooltip" data-placement="right" title="EmpID" required style="width:100%;" value="<?php echo $row['EmpID']?>">														
																</div>
															</div>
															<div class="row">
																<div class="col-md-3 text-right">
																	Attendance*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Attendance" name="Attendance" placeholder="Schedule Day" class="input" data-toggle="tooltip" data-placement="right" title="Attendance"  required style="width:100%;" value="<?php echo $row['Attendance']?>">														
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Activities*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Activities" name="Activities" placeholder="Activities" class="input" data-toggle="tooltip" data-placement="right" title="Activities" required style="width:100%;" value="<?php echo $row['Activities']?>">														
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Participation*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Participation" name="Participation" placeholder="Participation" class="input" data-toggle="tooltip" data-placement="right" title="Participation"  required style="width:100%;" value="<?php echo $row['Participation']?>">														
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Exam*<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Exam" name="Exam" placeholder="Exam" class="input" data-toggle="tooltip" data-placement="right" title="Exam"  required style="width:100%;" value="<?php echo $row['Exam']?>">														
																</div>
															</div><br>
													
													<div class="modal-footer">
														<input type="submit" class="btn btn-default"  data-dismiss="modal" id="editMarks" name="editMarks">
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
									<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddCategory">Submit</button>
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
			$(document).ready(function() {
			    $('#Scmarks').DataTable( {
			    } );
			   
			} );
			 $('#justs').click(function(){				
				    $('#ScheduleRows').fadeToggle("slow","linear");				    
				    $('#myModalss').fadeToggle("fast");
				    $('#addd').toggle();
				    $('#vie').toggle();
				});
			
		</script>


<?php 
	include("Admin_files/includes/footer.php")
?>