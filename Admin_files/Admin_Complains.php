<?php
include('includes/database.php');

if($_GET['type']=="Month"){
$currentMonth = $_GET['currentMonth'];
$year =date('Y');	
?>

									<div class="">
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
							 $Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$year."-".$currentMonth."-01' AND '".$year."-".$currentMonth."-31'";
							$result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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
																	<td class="csino" style="width:39px;"> <?php echo $i++;?></td>
																	<td class="cname" style="width:93px;"><?php echo substr($Complaints['Complain_By_Name'],0,12);?>...</td>
																	<td class="cctno" style="width:98px;"><?php echo $Complaints['Complaint_No']?></td>
																	
																	<td class="cbuild" style="width:57px;"><?php echo  $Complaints_room['BuildingNo'];?></td>
																	<td class="cblock" style="width:39px;"> <?php echo $Complaints_room['Section'];?></td>
																	<td class="crno" style="width:64px;"> <?php echo $Complaints_room['RoomNo'];?></td>
																	<td class="cdep" style="width:76px;"><?php echo $Complaints['Department'];?></td>
																	<td class="cstatus" style="width:40px;"><i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?></td>

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
															</div>
														  </div>
														  <div class="panel-footer">
																<div align="right">
																	<button class="btn btn-primary">Modify</button>
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
										

    
<?php }			
if($_GET['type']=="Year"){
$currentYear = $_GET['currentYear'];
$year =date('Y');
?>	
<div class="">
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
							  $Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$year."-01-01' AND '".$year."-12-31'";
							$result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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
																	<td class="csino" style="width:39px;"> <?php echo $i++;?></td>
																	<td class="cname" style="width:93px;"><?php echo substr($Complaints['Complain_By_Name'],0,12);?>...</td>
																	<td class="cctno" style="width:98px;"><?php echo $Complaints['Complaint_No']?></td>
																	
																	<td class="cbuild" style="width:57px;"><?php echo  $Complaints_room['BuildingNo'];?></td>
																	<td class="cblock" style="width:39px;"> <?php echo $Complaints_room['Section'];?></td>
																	<td class="crno" style="width:64px;"> <?php echo $Complaints_room['RoomNo'];?></td>
																	<td class="cdep" style="width:76px;"><?php echo $Complaints['Department'];?></td>
																	<td class="cstatus" style="width:40px;"><i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?></td>

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
															</div>
														  </div>
														  <div class="panel-footer">
																<div align="right">
																	<button class="btn btn-primary">Modify</button>
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
	
<?php }
if($_GET['type']=="ComplaintStatus"){
$Status = $_GET['Status'];
$Complaint_No = $_GET['Complaint_No'];	
$sql = "UPDATE Complaints SET Status='".$Status."' WHERE Complaint_No='".$Complaint_No."'"; 
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));		
	
}
?>