<?php
include('Admin_files/includes/header.php');
$StudentID = $_SESSION['StudentID'];
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql= "select TOP 50 * from Schdule order by Date desc ";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_POST['scenario']=="addAnnouncement")
{	
	$Addsql = "INSERT INTO Announcements(AnnTitle,AnnDesc,StartDate,EndDate,CurrDate) VALUES('".$_POST['title']."','".$_POST['message']."','".$_POST['ScheDate']."','".$_POST['EndDate']."','".$_POST['currdate']."')";
	$Addsql_result = sqlsrv_query( $conn, $Addsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:Announcements?err=success');
}

if($_GET['action']=="delete")
{	
	$delsql = "DELETE FROM Schdule WHERE ModuleID='".$_GET['Moduleid']."'";
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:Announcements');
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

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Announcements
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="Admin"><i class="fa fa-dashboard text-default"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-bullhorn"></i> Announcement</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<!-- Showing Schedules -->
				<?php if($_GET['action']=="" && $_GET['ModId']==""){?>

					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">
											<div class="note note-warning">
												<p>
													 Please try to re-size your browser window in order to see the tables in responsive mode.
												</p>
											</div>																							
											<!-- <button type="button" class="btn btn-default pull-right" id="justs">
		  										<span id="addd"><i class="fa fa-plus"></i> Add</span><span id="vie" style="display:none"><i class="fa fa-eye"></i> View</span> Schedules
											</button> -->
											<!-- <h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Schedules
												<div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>&nbsp;&nbsp;&nbsp;
												</div>
											</h3> -->											
										</div>

										
										<div class="panel-body sortabletable">
											<div class="row">
												<div class="filterable col-md-12">


													<div class="" id="Categories"><!-- style="display:none;" -->
														<div class="col-md-10 col-md-offset-1">
															<div class="border" id="myModalss">														  
															    <div class="modal-contents">
															      	<div class="modal-header">									        
															        	<h3 class="modal-title" id="myModalLabel">Add Announcement</h3>
															        	<?php if($_GET['err']=="success"){?>
															        		<span style="text-align:center; margin-top:-38px; margin-left:500px; position:absolute;height:44px;padding-top:10px;" class="alert alert-success" id="succesd">
															        			Announcement Added Successfully....
															        		</span>
																			<script type="text/javascript">
																				setTimeout(function() { $("#succesd").fadeOut("slow"); }, 2000);
																			</script>
																		<?php } ?>
															      	</div><br>  

															      	<form name="scheduleAdd" method="post" action="">                                                              
																      	<div class="row modal-body">
																	      	<div class="col-md-8 col-md-offset-1">
																				<input type="hidden" name="scenario" id="scenario" value="addAnnouncement">
																				<input type="hidden" name="currdate" id="currdate" value="<?php echo date('Y-m-d');?>">
																				<div class="row">
																					<div class="col-md-3 text-right">
																						Title<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">															
																						<input type="text" id="title" name="title" placeholder="Announcement Title" class="form-control"data-toggle="tooltip" data-placement="right" title="Announcement Title" required style="width:100%;">
																					</div>
																				</div><br>
																				<div class="row">
																					<div class="col-md-3 text-right">
																						Description<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">				
																						<textarea name="message" id="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" data-toggle="tooltip" data-placement="right" readonly title="Message"></textarea>
																					</div>
																				</div><br>
																				<div class="row">
																					<div class="col-md-3 text-right">
																						Start Date<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">															
																						<input type="text" id="ScheDate" name="ScheDate" placeholder="Start Date" class="form-control inputpickertext" data-toggle="tooltip" data-placement="right" readonly title="Start Date" style="width:100%;">														
																					</div>
																				</div><br>	
																				<div class="row">
																					<div class="col-md-3 text-right">
																						End Date<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">															
																						<input type="text" id="EndDate" name="EndDate" placeholder="End Date" class="form-control inputpickertext" data-toggle="tooltip" data-placement="right" readonly title="End Date" style="width:100%;">
																					</div>
																				</div><br>																			
																																							
																			</div>	  

																			<div class="clearfix"></div>
																			<div class="modal-footer">																				
																				<button type="submit" class="btn btn-default"  data-dismiss="modal" id="Addannouncement">Submit</button>
																			</div>
																	    </div>

																	</form>

																</div>
															</div>
														</div>
													</div>

													<div class="clearfix"></div>
													<br>

													<?php /*?><div class="col-md-12">
														<div class="panel panel-warning">
															<div class="panel-heading">
																<h3 class="panel-title">All Schedules </h3>
															</div>
															<div class="panel-body">
											
																<div class="tab-content panel-body" id="ScheduleRows">									
																	<table class="table table-striped" id="schedules">
																		<thead>
																			<tr class="filters">
																				<th><!-- <input type="text" class="form-control" placeholder="S.No" > -->S.No</th>
																				<th><input type="text" class="form-control" placeholder="Module ID" ></th>
																				<th><input type="text" class="form-control" placeholder="Day" ></th>
																				<th><input type="text" class="form-control" placeholder="Date" ></th>
																				<th><input type="text" class="form-control" placeholder="Session ID" ></th>
																				<th><input type="text" class="form-control" placeholder="Instructor Id" ></th>
																				<th><input type="text" class="form-control" placeholder="Start Time" ></th>
																				<th><input type="text" class="form-control" placeholder="End Time" ></th>
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
																		<?php $jkl = 1; while($row = sqlsrv_fetch_array($result)){																	
																		?>
																			<tr>
																				<td><?php echo $jkl;?></td>
																				<td><?php echo $row['ModuleID']?></td>
																				<td><?php echo $row['Day']?></td>
																				<?php 
																				 //$date = date('Y-m-d', strtotime($row['Date']));
																				 $date = date_format( $row['Date'], 'Y-m-d' );
																				?>
																				<td><?php echo $date; ?></td>
																				<td><?php echo $row['SessionID']?></td>
																				<td><?php echo $row['InstructorID']?></td>
																				<?php 
																				 $start = date_format( $row['StartTime'], 'H:i:s' );
																				?>
																				<td><?php echo $start?></td>
																				<?php 
																				  $end = date_format( $row['EndTime'], 'H:i:s' );
																				?>
																				<td><?php echo $end;?></td>
																				<!-- <td><a data-toggle="modal" data-target="#myModal<?php echo $jkl;?>" style="cursor:pointer">Edit</a> </td> -->
																				<td><a href="AdminSchedules?action=Edit&ModId=<?php echo $row['ModuleID'];?>" style="cursor:pointer"> <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a> </td>
																				<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminSchedules?action=delete&Moduleid=<?php echo $row['ModuleID'];?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger" data-toggle="tooltip" data-placement="top" title="Click to delete"></i></a> </td>
																			</tr>
																		<?php $jkl++; }?>											
																			
																		</tbody>
																	</table>
																</div>

															</div>
														</div>
													</div><?php */?>

												
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
				<?php if($_GET['action']=="Edit" && $_GET['ModId']!=""){?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
											<a href="AdminSchedules" class="btn btn-default pull-right">View Schedules</a>
											<h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Edit Schedules
												<!-- <div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
												</div> -->
											</h3>
											<!-- <hr> -->
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
											$editStudsql = "SELECT * from Schdule WHERE ModuleID='".$_GET['ModId']."'";
											$editStudresult = sqlsrv_query( $conn, $editStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$EditStud_row = sqlsrv_fetch_array($editStudresult)?>
										<div class="modals" id="mySchedules">
										  	<form name="scheduleAdd" method="post" action="AddSchedule.php">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<!-- <div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Schedule</h3>
											      	</div><br> -->
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
														<div class="col-md-3 text-right">
															Module Id<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="ModuleId" name="ModuleId" placeholder="Module Id" class="input" data-toggle="tooltip" data-placement="right" title="Module Id" required style="width:100%;" value="<?php echo $EditStud_row['ModuleID'];?>">
														</div>
													</div><br>
											      	<div class="row">
														<div class="col-md-3 text-right">
															Schedule Date<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="ScheDate" name="ScheDate" placeholder="Schedule Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Schedule Date" readonly required style="width:100%;" onchange="showDay(this.value);"
															value="<?php echo date_format($EditStud_row['Date'],"Y-m-d");?>">														
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Day<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="ScheDay" name="ScheDay" placeholder="Schedule Day" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Schedule Day" readonly required style="width:100%;" value="<?php echo $EditStud_row['Day'];?>">	
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Session Id<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">										
															<select name="SchesessionId" id="SchesessionId" style="width:515px;">
																<option value="">Select Session ID</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
																<option value="6">6</option>
															</select>				
															<script type="text/javascript">
															for(var i=0;i<document.getElementById('SchesessionId').length;i++)
								                            {
								            					if(document.getElementById('SchesessionId').options[i].value=="<?php echo $EditStud_row['SessionID'] ?>")
								            					{
								            						document.getElementById('SchesessionId').options[i].selected=true;
								            					}
								                            }		
															</script>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Instuctor<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">
															<?php 
																$Instsql = "SELECT * FROM Instructors";
																$Instresult = sqlsrv_query( $conn, $Instsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>
															<select name="InstrucId" id="InstrucId" style="width:515px;">
																<option value="">Select Instructor Name</option>
																<?php while($group_row = sqlsrv_fetch_array($Instresult)){?>
																	<option value="<?php echo $group_row['InstructorID'];?>"><?php echo $group_row['InstructorName'];?></option>
																<?php } ?>
															</select>
															<script type="text/javascript">
															for(var i=0;i<document.getElementById('InstrucId').length;i++)
								                            {
								            					if(document.getElementById('InstrucId').options[i].value=="<?php echo $EditStud_row['InstructorID'] ?>")
								            					{
								            						document.getElementById('InstrucId').options[i].selected=true;
								            					}
								                            }		
															</script>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Group Id<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">
															<?php 
																$grpIdsql = "SELECT * FROM SGroup";
																$grpIdresult = sqlsrv_query( $conn, $grpIdsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>
															<select name="SGroupId" id="SGroupId" style="width:515px;">
																<option value="">Select Group Name</option>
																<?php while($groupId_row = sqlsrv_fetch_array($grpIdresult)){?>
																	<option value="<?php echo $groupId_row['GroupID'];?>"><?php echo $groupId_row['GroupName'];?></option>
																<?php } ?>
															</select>
															<script type="text/javascript">
															for(var i=0;i<document.getElementById('SGroupId').length;i++)
								                            {
								            					if(document.getElementById('SGroupId').options[i].value=="<?php echo $EditStud_row['GroupID'] ?>")
								            					{
								            						document.getElementById('SGroupId').options[i].selected=true;
								            					}
								                            }		
															</script>
														</div>
													</div>	<br>
													<div class="row">
														<div class="col-md-3 text-right">
															Start Time<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="startTime" name="startTime" placeholder="Start Time" class="input inputpickertext" data-toggle="tooltip" data-placement="right"title="Start Time" readonly required style="width:100%;" value="<?php //echo $EditStud_row['StartTime'];?>">
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															End Time<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="endTime" name="endTime" placeholder="End Time" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="End Time" readonly required style="width:100%;" value="<?php //echo $EditStud_row['EndTime'];?>">
														</div>
													</div><br>
													<br>
													<div class="modal-footer">
														<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddCategory">Submit</button>
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

		<script src="assets/dist/js/datepicker.js"></script>
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
				/*$("#ScheDate").datepicker({ 
			        autoclose: true, 
			        todayHighlight: true,
			        format:'yyyy-mm-dd'
				}).datepicker('', new Date());;*/
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

			} );
			var nowTemp = new Date();
			var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

			var checkin = $('#ScheDate').datepicker({
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
			    $('#EndDate')[0].focus();
			});

			var checkout = $('#EndDate').datepicker({
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
		</script>


<?php 
	include("Admin_files/includes/footer.php")
?>