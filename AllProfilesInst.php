<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];
if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql = "SELECT * FROM StudentInfo";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

$Instsql = "SELECT * FROM Instructors";
$Instresult = sqlsrv_query( $conn, $Instsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_GET['action']=="delete" && $_GET['StudentId']!="")
{	
	$delsql = "DELETE FROM StudentInfo WHERE StudentID='".$_GET['Studentid']."'";
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
}

if($_GET['action']=="delete" && $_GET['Instructorid']!="")
{	
	$Instdelsql = "DELETE FROM Instructors WHERE InstructorID='".$_GET['Instructorid']."'";
	$Instdelsql_result = sqlsrv_query( $conn, $Instdelsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AllProfilesInst');
}

?>			
			<style>
			/*Tables Design*/
			table.dataTable.no-footer{
			  border: 0px;
			}

			div.dataTables_filter,div.dataTables_length { 
			  display: none !important;
			}
			table.dataTable thead th, table.dataTable thead td {
			  border-bottom: 3px solid #d9d9d9 ;
			}
			.dataTable tr{
			  background: #5AC6A2;			  
			}
			.dataTable tbody tr td{
			  padding: auto;
			}
			.border table {
				border: 1px solid #ccc;
				margin-bottom: 20px;
			} 
			.dataTable tr td{
			  border: 1px solid #f9f9f9;
			}
			</style>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Instructor Profiles
						<!-- <small></small> -->
					</h1>
					<ol class="breadcrumb">
						<li><a href="Admin"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profiles</a></li>
					</ol>
				</section>

				<!-- Student/Instructor Profiles -->
				<?php if($_GET['action']=="" && $_GET['ModId']==""){?>
				<!-- Main content -->
					<section class="content">
						<div class="panel box box-default">
							<div class="panel-body">
								<div class="">
									<div class="panel">
										<div class="panel-heading">
											<!-- <h3 class="panel-title">Users</h3> -->
											<?php if($_GET['err']=="success"){?>
												<span style="text-align:center; margin-left:500px; position:absolute;" class="alert alert-success" id="succesd">
													Profile Successfully Added....
												</span>
												<script type="text/javascript">
													setTimeout(function() { $("#succesd").fadeOut("slow"); }, 2000);
												</script>
											<?php } ?>
											<div class="pull-right">
												<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
											</div>
										</div>
										<div class="panel-body">
											<div class="card">
												<button type="button" class="btn btn-default pull-right" id="justs">
													<span id="addd"><i class="fa fa-user-plus"></i> Add Instructor</span><span id="vie" style="display:none"><i class="fa fa-arrow-left"> Back</i></span>
												</button>
												<ul class="nav nav-tabs" role="tablist">
													<!-- <li role="presentation"><a href="AllProfiles" aria-controls="home" role="tab" data-toggle="tab">Student</a></li>#RStudent 
													<li role="presentation" class="active"><a href="AllProfilesInst" aria-controls="profile" role="tab" data-toggle="tab">Instructor</a></li>#PInstructor -->
													<li role="presentation"><a href="AllProfiles" aria-controls="home">Student</a></li><!-- #RStudent -->
													<li role="presentation" class="active"><a class="btn btn-danger" aria-controls="profile">Instructor</a></li><!-- #PInstructor -->		
												</ul>		
												<style type="text/css">
													.filters th:first-child{
														width: 50px !important;
													}
													a.btn.btn-danger {
													   background: #F2DEDE !important;
													}
												</style>                                    
												<!-- Tab panes -->
												<div class="panel panel-danger">
													<div class="panel-heading">
														<h3 class="panel-title">Instructors Profiles 
														<div class="pull-right">
															<div class="dropdown text-muted">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><small class="text-red">Export<i class="icon-cog3"></i> </small>
																<span class="glyphicon glyphicon-align-justify text-red"></span></a>
																<ul class="dropdown-menu dropdown-menu-right">
																	<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
																	<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
																	<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
																	<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
																</ul>
															</div>
														</div>
														</h3>														
													</div>
													<div class="">
														<div class="tab-content">
															<div role="tabpanel" class="tab-pane active" id="PInstructor">
																<table class="table table-striped	" id="marks1">
																	<thead>
																		<tr class="filters">
																			<th>S.No</th>
																			<th><input type="text" class="form-control" placeholder="Instructor ID" ></th>
																			<th><input type="text" class="form-control" placeholder="Instructor Name" ></th>
																			<th><input type="text" class="form-control" placeholder="Employee Id" ></th>
																			<th><input type="text" class="form-control" placeholder="Form Id" ></th>
																			<th><input type="text" class="form-control" placeholder="Process" ></th>	
																			<th>Edit</th>
																			<th>Delete</th>												
																		</tr>
																		<!-- <tr style="display:none;">
																			<th>S.No</th>
																			<th>Instructor ID</th>
																			<th>Instructor Name</th>
																			<th>Employee Id</th>
																			<th>Form Id</th>
																			<th>Process</th>
																			<th>Edit</th>
																			<th>Delete</th>
																		</tr> -->
																	</thead>
																	<tbody>
																		<?php $ij =1; while($Inst_row = sqlsrv_fetch_array($Instresult)){ ?>
																			<tr>
																				<td><?php echo $ij;?></td>
																				<td><?php echo $Inst_row['InstructorID']?></td>
																				<td><?php echo $Inst_row['InstructorName']?></td>
																				<td><?php echo $Inst_row['EmployeeID']?></td>
																				<td><?php echo $Inst_row['FormID']?></td>
																				<td><?php echo $Inst_row['processID']?></td>
																				<td><a href="AllProfilesInst?action=Edit&prof=Instructor&Mdl=<?php echo $Inst_row['InstructorID'];?>" style="cursor:pointer"><i class="fa fa-pencil"></i></a> </td>
																				<td align="center"><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AllProfilesInst?action=delete&Instructorid=<?php echo $Inst_row['InstructorID'];?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-red"></i></a> </td>
																			</tr>
																		<?php $ij++; }?>
																	</tbody>
																</table>
															</div>
														</div>
														<br>
													</div>
												</div>
											   
											</div>
											<!-- Remove class of DataTable to the instructors data... -->
											<script type="text/javascript">
												$(window).load(function(){
													$('#PInstructor').find('#marks1').removeClass('dataTable');
												})
											</script>

											<!-- Add / Edit Student Instructor -->
											<style type="text/css">									
											.col-md-3.text-right{
												padding-top: 18px;
											}
											.text-danger.fa.fa-star{
												font-size: 7px;										
											}
											.datepicker{z-index:1151 !important;}
											.dataTables_paginate.paging_simple_numbers {
												border: 1px solid #d9d9d9;
												padding: 0;
												margin-top: 25px;
												margin-right: 20px;
											}
											div#marks1_info {
													margin-left: 20px;
												}
											</style>
											<?php
												if(isset($_POST['AddInstructor'])){
												  $InstructorID = $_POST['InstructorID'];	
												  $EmployeeID = $_POST['EmployeeID'];
												  $InstructorName = $_POST['InstructorName'];
												  $FormID = $_POST['FormID'];
												  $processID = $_POST['processID'];
												  $Abr = $_POST['Abr'];
												
												$sql = "INSERT INTO Instructors (InstructorID,EmployeeID,InstructorName,FormID,processID,Abr)VALUES('".$InstructorID."','".$EmployeeID."','".$InstructorName."','".$FormID."','".$processID."','".$Abr."')";
												$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												header('Location:AllProfilesInst');				  
						  
												}
											
											?>
											
											
											<div class="panel-body">
												<form name="AddInstructor" method="post" action="">
													<!-- Modal -->
													<div class="row">
														<div class="col-md-6 col-md-offset-3">
															<div class="modals box box-default" id="myModalss" style="display:none;">
															  <!-- <div class="modal-dialog" role="document"> -->
																<div class="modal-content">
																	<div class="modal-header">									        
																		<h3 class="modal-title" id="myModalLabel">Add Instructor</h3>
																	</div><br>
																	<input type="hidden" name="scenario" id="scenario" value="addProfiles">													      	
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Instructor ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="InstructorID" name="InstructorID" placeholder="Instructor ID" class="form-control" data-toggle="tooltip" data-placement="right" title="Instructor ID" required style="width:100%;">
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Employee ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="EmployeeID" name="EmployeeID" placeholder="Employee ID" class="form-control" data-toggle="tooltip" data-placement="right" title="Employee ID" style="width:100%;" value="" required>
																			
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Instructor Name<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="InstructorName" name="InstructorName" placeholder="Instructor Name" class="form-control" data-toggle="tooltip" data-placement="right" title="Instructor Name" style="width:100%;" value="" required>
																			
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Form ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="FormID" name="FormID" placeholder="Form ID" class="form-control" data-toggle="tooltip" data-placement="right" title="Form ID" style="width:100%;" value="" required>
																			
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Process ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="number" id="processID" name="processID" placeholder="Process ID " class="form-control" data-toggle="tooltip" data-placement="right" title="Process ID (Enter Numbers)" style="width:100%;" value="" required >
																			
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Abbrevation<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="Abr" name="Abr" placeholder="Abr" class="form-control" data-toggle="tooltip" data-placement="right" title="Abbrevation" required style="width:100%;" value="">
																			
																		</div>
																	</div><br>
																	
																	
																	<div class="modal-footer">
																		<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddInstructor" name="AddInstructor">Submit</button>
																	</div>

																	
																</div>
															  <!-- </div> -->
															</div>
														</div>
													</div>
													
												</form>
											</div>
										</div>           
									</div>
								</div>
							</div>
						</div>
					</section><!-- /.content -->
				<?php } ?>
			<!-- End Student/Instructor Profiles -->

				<!-- Add / Edit Student Instructor -->
				<style type="text/css">									
				.col-md-3.text-right{
					padding-top: 18px;
				}
				.text-danger.fa.fa-star{
					font-size: 7px;										
				}
				.datepicker{z-index:1151 !important;}
				.styled-select select {
					color:#ffffff;
					background: #12C3AA;
					padding: 10px;										    
					font-size: 16px;
					line-height: 1;
					border: 0;
				}
				.nav-tabs {
					border-bottom: 1px solid transparent;
				}
				</style>

			<!-- Edit Instructor Profiles Start -->
				<?php if($_GET['action']=="Edit" && $_GET['prof']=="Instructor" && $_GET['Mdl']!=""){

					  $RegedInstrsql = "SELECT * FROM Instructors WHERE InstructorID='".$_GET['Mdl']."'";
					  $RegedInstrresult = sqlsrv_query( $conn, $RegedInstrsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
					  $RegEditInstr_row = sqlsrv_fetch_array($RegedInstrresult);
					  
					  if(isset($_POST['EditInstructor'])){
						  
						  $EmployeeID = $_POST['EmployeeID'];
						  $InstructorName = $_POST['InstructorName'];
						  $FormID = $_POST['FormID'];
						  $processID = $_POST['processID'];
						  $Abr = $_POST['Abr'];
						
						$sql = "UPDATE Instructors SET EmployeeID ='".$EmployeeID."',InstructorName ='".$InstructorName."',FormID ='".$FormID."',processID ='".$processID."',Abr ='".$Abr."' WHERE InstructorID ='".$_GET['Mdl']."'";
						$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
						header('Location:AllProfilesInst');				  
						  
						}
					  
					  
					  ?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="">
									<div class="panel">
										<div class="panel-heading">											
											<div class="pull-right">
												<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
												<a href="AllProfilesInst" class="btn btn-default pull-right"><i class="fa fa-arrow-left"> Back</i></a>
											</div>
										</div>
										<div class="">
											<div class="card">	                                			
												<!-- <ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active"><a href="#RStudent" aria-controls="home" role="tab" data-toggle="tab">Student</a></li>
													<li role="presentation"><a href="#PInstructor" aria-controls="profile" role="tab" data-toggle="tab">Instructor</a></li>			
												</ul> -->		                                    
												<!-- Tab panes -->
												<div class="tab-content">
													<div role="tabpanel" class="tab-pane active" id="RStudent">
														<form name="AddProfiles" method="post" action="">
															<!-- Modal -->
															<div class="modals" id="myModalss"><br>
															  <!-- <div class="modal-dialog" role="document"> -->
																<div class="modal-content col-md-6 col-md-offset-3">
																	<div class="modal-header">									        
																		<h3 class="modal-title" id="myModalLabel">Editing <span class="text-danger"><?php echo $RegEditInstr_row['InstructorName']?></span> Profile <i class="fa fa-edit pull-right"></i></h3>
																	</div><br>
																	<input type="hidden" name="scenario" id="scenario" value="EditStudentProfiles">
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Instructor ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="InstructorID" name="InstructorID" placeholder="Instructor ID" class="input" data-toggle="tooltip" data-placement="right" title="Instructor ID" readonly style="width:100%;" value="<?php echo $RegEditInstr_row['InstructorID'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Employee ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="EmployeeID" name="EmployeeID" placeholder="Employee ID" class="input" data-toggle="tooltip" data-placement="right" title="Employee ID" style="width:100%;" value="<?php echo $RegEditInstr_row['EmployeeID'];?>" required>
																			
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Instructor Name<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="InstructorName" name="InstructorName" placeholder="Instructor Name" class="input" data-toggle="tooltip" data-placement="right" title="Instructor Name" style="width:100%;" value="<?php echo $RegEditInstr_row['InstructorName'];?>" required>
																			
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Form ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="FormID" name="FormID" placeholder="Form ID" class="input" data-toggle="tooltip" data-placement="right" title="Form ID" style="width:100%;" value="<?php echo $RegEditInstr_row['FormID'];?>" required>
																			
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Process ID<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="number" id="processID" name="processID" placeholder="Process ID " class="input" data-toggle="tooltip" data-placement="right" title="Process ID (Enter Numbers)" style="width:100%;" value="<?php echo $RegEditInstr_row['processID'];?>" required >
																			
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Abr<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="Abr" name="Abr" placeholder="Abr" class="input" data-toggle="tooltip" data-placement="right" title="Abr" required style="width:100%;" value="<?php echo $RegEditInstr_row['Abr'];?>">
																			
																		</div>
																	</div><br>
																	
																	<div class="modal-footer">
																		<input type="submit" class="btn btn-default"  data-dismiss="modal" id="EditInstructor" name="EditInstructor">
																	</div>
																</div>
															  <!-- </div> -->
															</div>
														</form>			                                        	
													</div>

									<!-- Instructor Edit -->

												</div>
											</div>

										</div>           
									</div>
								</div>
							</div>
						</div>
					</section><!-- /.content -->
				<?php } ?>
			<!-- Edit Instructor Profiles End -->

			</div><!-- /.content-wrapper -->


			<!-- Regular Student Edit Section -->
			<?php
				/*$il=1;
				$edStudsql = "SELECT * FROM StudentInfo";
				$edStudresult = sqlsrv_query( $conn, $edStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
				while($EditStud = sqlsrv_fetch_array($edStudresult)){?>

			<div class="modal fade" id="myModal<?php echo $il;?>" role="dialog">
				<div class="modal-dialog modal-captain">
					<div class="modal-header" style="background-color:#fff;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $EditStud['StudentName_en']?></h4>
					</div>
					<!-- Modal content-->
					<div class="modal-content">
						<form name="editHoliday" method="post" action="AdmHolidays.php">					
							<div class="modal-body">
								<input type="hidden" name="scenario" id="scenario" value="editStuProfile">
								<input type="hidden" name="HolidayId" id="HolidayId" value="<?php echo $EditStud['HolidayID']?>">
								<div class="row">
									<div class="col-md-3 text-right">
										Student Id<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="StudentId" name="StudentId" placeholder="Student Id" class="input" data-toggle="tooltip" data-placement="right" title="Student Id" required style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										First Name<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="FirstNameE" name="FirstNameE" placeholder="First Name En" class="input" data-toggle="tooltip" data-placement="right" title="First Name" required style="width:100%;">
										<input type="text" id="FirstNameA" name="FirstNameA" placeholder="First Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="First Name" style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Second Name<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="SecondNameE" name="SecondNameE" placeholder="Second Name En" class="input" data-toggle="tooltip" data-placement="right" title="Second Name" required style="width:100%;">
										<input type="text" id="SecondNameA" name="SecondNameA" placeholder="Second Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Second Name" style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Third Name<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="ThirdNameE" name="ThirdNameE" placeholder="Third Name En" class="input" data-toggle="tooltip" data-placement="right" title="Third Name" required style="width:100%;">
										<input type="text" id="ThirdNameA" name="ThirdNameA" placeholder="Third Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Third Name" style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Last Name<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="LastNameE" name="LastNameE" placeholder="Last Name En" class="input" data-toggle="tooltip" data-placement="right" title="Last Name" required style="width:100%;">
										<input type="text" id="LastNameA" name="LastNameA" placeholder="Last Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Last Name" style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Student Name<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="StudentNameE" name="StudentNameE" placeholder="Student Name En" class="input" data-toggle="tooltip" data-placement="right" title="Student Name" required style="width:100%;">
										<input type="text" id="StudentNameA" name="StudentNameA" placeholder="Student Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Student Name" required style="width:100%;">
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-3 text-right">
										Student Group<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8 styled-select">
										<?php 	
										$Groupsql = "select * from SGroup";
										$Grpresult = sqlsrv_query( $conn, $Groupsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )); ?>					
										<select name="SGroupName" id="SGroupName" style="width:370px;">
											<option value="">Select Group Name</option>
											<?php while($group_row = sqlsrv_fetch_array($Grpresult)){?>
												<option value="<?php echo $group_row['GroupID'];?>"><?php echo $group_row['GroupName'];?></option>
											<?php } ?>
										</select>
									</div>
								</div>														
								<div class="row">
									<div class="col-md-3 text-right">
										Nationality<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="NationalId" name="NationalId" placeholder="Enter National Id" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Enter National Id" required style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Issued On<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="Issuedate" name="Issuedate" placeholder="Issue Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Issue Date" readonly required style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Birth Place<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="BirthPlace" name="BirthPlace" placeholder="Enter Birth Place" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Enter Birth Place" required style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Date Of Birth<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="BirthDate" name="BirthDate" placeholder="Birth Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Birth Date" readonly required style="width:100%;">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Mobile<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="Mobile" name="Mobile" placeholder="Enter Mobile No" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="" style="width:100%;">
									</div>
								</div>															
							</div>	
							<div class="modal-footer">				 	    	
								<button type="submit" class="btn btn-primary" id="EditHoliday">Update</button>
							</div>			  
						</form>
					</div>
				</div>
			</div>
			<?php $il++; } */?>
			<!-- End Regular Student Edit Section -->

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
		<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
		<!-- Bootstrap 3.3.2 JS 
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
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
				$('#marks').DataTable( {
				} );
				$('#marks1').DataTable( {
				} );
			} );

			$( document ).ready(function() {		
				$('#justs').click(function(){				
					$('.panel-danger').fadeToggle("slow","linear");
					$('.nav-tabs').fadeToggle("slow","linear");
					$('#myModalss').fadeToggle("fast");
					$('#addd').toggle();
					$('#vie').toggle();
				});

				$("#BirthDate").datepicker({ 
					autoclose: true, 
					todayHighlight: true,
					format: 'yyyy/mm/dd'
				}).datepicker('', new Date());;

				$("#Issuedate").datepicker({ 
					autoclose: true, 
					todayHighlight: true,
					format: 'yyyy/mm/dd'
				}).datepicker('', new Date());;
			});
		</script>
<?php
	include('Admin_files/includes/footer.php');
?>
