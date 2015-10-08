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

if($_GET['action']=="delete" && $_GET['Studentid']!="")
{	
	$delsql = "DELETE FROM StudentInfo WHERE StudentID='".$_GET['Studentid']."'";
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AllProfiles');
}

// if($_GET['action']=="delete" && $_GET['Instructorid']!="")
// {	
// 	$Instdelsql = "DELETE FROM Instructors WHERE InstructorID='".$_GET['Instructorid']."'";
// 	$Instdelsql_result = sqlsrv_query( $conn, $Instdelsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
// }

?>
			
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Student Profiles
						<!-- <small></small> -->
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
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
		                                <div class="panel-body border">
	                                		<div class="card">
	                                			<button type="button" class="btn btn-default pull-right" id="justs">
			  										<span id="addd"><i class="fa fa-user-plus"></i> Add Student</span><span id="vie" style="display:none"><i class="fa fa-arrow-left"> Back</i></span>
												</button>
			                                    <ul class="nav nav-tabs" role="tablist">
			                                        <!--<li role="presentation" class="active"><a href="AllProfiles" aria-controls="home" role="tab" data-toggle="tab">Student</a></li> #RStudent
			                                        <li role="presentation"><a href="AllProfilesInst" aria-controls="profile" role="tab" data-toggle="tab">Instructor</a></li> #PInstructor -->		                                        
			                                        <li role="presentation" class="active"><a href="AllProfiles" aria-controls="home">Student</a></li><!-- #RStudent -->
			                                        <li role="presentation"><a href="AllProfilesInst" aria-controls="profile">Instructor</a></li><!-- #PInstructor -->		
			                                    </ul>		                                    
			                                    <!-- Tab panes -->
			                                    <div class="tab-content">
			                                        <div role="tabpanel" class="tab-pane active" id="RStudent">
			                                        	<table class="table table-striped" id="marks">
															<thead>
																<tr class="filters">
																	<th>S.No</th>
																	<th><input type="text" class="form-control" placeholder="Student ID" ></th>
																	<th><input type="text" class="form-control" placeholder="Student Name" ></th>
																	<th><input type="text" class="form-control" placeholder="Student Group" ></th>
																	<th><input type="text" class="form-control" placeholder="National Id" ></th>
																	<th><input type="text" class="form-control" placeholder="Birth Place" ></th>
																	<th><input type="text" class="form-control" placeholder="DOB" ></th>
																	<th><input type="text" class="form-control" placeholder="Mobile" ></th>
																	<th>Edit</th>
																	<th>Delete</th>
																</tr>
																<!-- <tr style="display:none;">																
																	<th>S.No</th>
																	<th>Student ID</th>
																	<th>Student Name</th>
																	<th>Student Group</th>
																	<th>National Id</th>
																	<th>Birth Place</th>
																	<th>DOB</th>
																	<th>Mobile</th>
																	<th>Edit</th>
																	<th>Delete</th>
																</tr> -->
															</thead>
															<tbody>
															<?php $ii =1;while($row = sqlsrv_fetch_array($result)){ ?>
																<tr>
																	<td><?php echo $ii;?></td>
																	<td><?php echo $row['StudentID']?></td>
																	<td><?php echo $row['StudentName_en']?></td>
																	<td><?php echo $row['StudentGroup']?></td>
																	<td><?php echo $row['NationalID']?></td>
																	<td><?php echo $row['BirthPlace']?></td>
																	<td><?php echo $row['DoB']?></td>
																	<td><?php echo $row['Mobile']?></td>
																	<!-- <td><a data-toggle="modal" data-target="#myModal<?php echo $ii;?>" style="cursor:pointer">Edit</a> </td> -->
																	<td><a href="AllProfiles?action=Edit&prof=Student&Mdl=<?php echo $row['StudentID'];?>" style="cursor:pointer"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a> </td>
																	<td><a  onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AllProfiles?action=delete&Studentid=<?php echo $row['StudentID'];?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger"></i></a> </td>
																</tr>
															<?php $ii++; }?>
															</tbody>
														</table>
			                                        </div>

			                                        <div role="tabpanel" class="tab-pane" id="PInstructor">
			                                        	<table class="table table-striped" id="marks1">
															<thead>
																<tr class="filters" style="display:none;">
																	<th><input type="text" class="form-control" placeholder="Instructor ID" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Instructor Name" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Employee Id" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Form Id" disabled></th>
																	<th><input type="text" class="form-control" placeholder="Process" disabled></th>													
																</tr>
																<tr>
																	<th>S.No</th>
																	<th>Instructor ID</th>
																	<th>Instructor Name</th>
																	<th>Employee Id</th>
																	<th>Form Id</th>
																	<th>Process</th>
																	<th>Edit</th>
																	<th>Delete</th>
																</tr>
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
																		<td><a href="AllProfiles?action=Edit&prof=Instructor&Mdl=<?php echo $Inst_row['InstructorID'];?>" style="cursor:pointer">Edit</a> </td>
																		<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AllProfiles?action=delete&Instructorid=<?php echo $Inst_row['InstructorID'];?>'; return false;}" style="cursor:pointer">Delete</a> </td>
																	</tr>
																<?php $ij++; }?>
															</tbody>
														</table>
			                                        </div>
			                                    </div>
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
											</style>
											<div class="panel-body">
												<form name="AddProfiles" method="post" action="AdmHolidays.php">
													<!-- Modal -->
													<div class="row">
														<div class="col-md-6 col-md-offset-3">
															<div class="modals box box-default" id="myModalss" style="display:none;">
															  <!-- <div class="modal-dialog" role="document"> -->
															    <div class="modal-content">
															      	<div class="modal-header">									        
															        	<h3 class="modal-title" id="myModalLabel">Add Student</h3>
															      	</div>
															      	<input type="hidden" name="scenario" id="scenario" value="addProfiles">													      	
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
																			<select name="SGroupName" id="SGroupName" style="width:500px;">
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
																	</div><br>
																	<br>
																	<div class="modal-footer">
																		<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddCategory">Submit</button>
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

			<!-- Edit Student Profiles Start -->
				<?php if($_GET['action']=="Edit" && $_GET['prof']=="Student" && $_GET['Mdl']!=""){

					  $RegedStudsql = "SELECT * FROM StudentInfo WHERE StudentID='".$_GET['Mdl']."'";
					  $RegedStudresult = sqlsrv_query( $conn, $RegedStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
					  $RegEditStud_row = sqlsrv_fetch_array($RegedStudresult)?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="">
									<div class="panel">
										<div class="panel-heading">											
											<div class="pull-right">
												<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
												<a href="AllProfiles" class="btn btn-default pull-right"><i class="fa fa-arrow-left"> Back</i></a>
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
			                                        	<form name="AddProfiles" method="post" action="AdmHolidays.php">
															<!-- Modal -->
															<div class="modals" id="myModalss"><br>
															  <!-- <div class="modal-dialog" role="document"> -->
															    <div class="modal-content col-md-6 col-md-offset-3">
															      	<div class="modal-header">									        
															        	<h3 class="modal-title" id="myModalLabel">Editing <span class="text-danger"><?php echo $RegEditStud_row['StudentName_en']?></span> Profile <i class="fa fa-edit pull-right"></i></h3>
															      	</div><br>
															      	<input type="hidden" name="scenario" id="scenario" value="EditStudentProfiles">
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Student Id<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="StudentId" name="StudentId" placeholder="Student Id" class="input" data-toggle="tooltip" data-placement="right" title="Student Id" readonly style="width:100%;" value="<?php echo $RegEditStud_row['StudentID'];?>">
																		</div>
																	</div>
															      	<div class="row">
																		<div class="col-md-3 text-right">
																			First Name<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="FirstNameE" name="FirstNameE" placeholder="First Name En" class="input" data-toggle="tooltip" data-placement="right" title="First Name" style="width:100%;" value="<?php echo $RegEditStud_row['FirstNameE'];?>">
																			<input type="text" id="FirstNameA" name="FirstNameA" placeholder="First Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="First Name" style="width:100%;" value="<?php echo $RegEditStud_row['FirstNameA'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Second Name<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="SecondNameE" name="SecondNameE" placeholder="Second Name En" class="input" data-toggle="tooltip" data-placement="right" title="Second Name" style="width:100%;" value="<?php echo $RegEditStud_row['SecondNameE'];?>">
																			<input type="text" id="SecondNameA" name="SecondNameA" placeholder="Second Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Second Name" style="width:100%;" value="<?php echo $RegEditStud_row['SecondNameA'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Third Name<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="ThirdNameE" name="ThirdNameE" placeholder="Third Name En" class="input" data-toggle="tooltip" data-placement="right" title="Third Name" style="width:100%;" value="<?php echo $RegEditStud_row['ThrdNameE'];?>">
																			<input type="text" id="ThirdNameA" name="ThirdNameA" placeholder="Third Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Third Name" style="width:100%;" value="<?php echo $RegEditStud_row['ThrdNameA'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Last Name<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="LastNameE" name="LastNameE" placeholder="Last Name En" class="input" data-toggle="tooltip" data-placement="right" title="Last Name" style="width:100%;" value="<?php echo $RegEditStud_row['LastNameE'];?>">
																			<input type="text" id="LastNameA" name="LastNameA" placeholder="Last Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Last Name" style="width:100%;" value="<?php echo $RegEditStud_row['LastNameA'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Student Name<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="StudentNameE" name="StudentNameE" placeholder="Student Name En" class="input" data-toggle="tooltip" data-placement="right" title="Student Name" required style="width:100%;" value="<?php echo $RegEditStud_row['StudentName_en'];?>">
																			<input type="text" id="StudentNameA" name="StudentNameA" placeholder="Student Name Ar" class="input" data-toggle="tooltip" data-placement="right" title="Student Name" style="width:100%;" value="<?php echo $RegEditStud_row['StudentName_ar'];?>">
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
																			<select name="SGroupName" id="SGroupName" style="width:500px;">
																				<option value="">Select Group Name</option>
																				<?php while($group_row = sqlsrv_fetch_array($Grpresult)){?>
																					<option value="<?php echo $group_row['GroupID'];?>"><?php echo $group_row['GroupName'];?></option>
																				<?php } ?>
																			</select>
																			<script type="text/javascript">
																			for(var i=0;i<document.getElementById('SGroupName').length;i++)
												                            {
												            					if(document.getElementById('SGroupName').options[i].value=="<?php echo $RegEditStud_row['StudentGroup'] ?>")
												            					{
												            						document.getElementById('SGroupName').options[i].selected=true;
												            					}
												                            }		
																			</script>
																		</div>
																	</div>														
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Nationality<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="NationalId" name="NationalId" placeholder="Enter National Id" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Enter National Id" style="width:100%;" value="<?php echo $RegEditStud_row['NationalID'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Issued On<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="Issuedate" name="Issuedate" placeholder="Issue Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Issue Date" readonly required style="width:100%;" value="<?php echo $RegEditStud_row['Issuedate'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Birth Place<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="BirthPlace" name="BirthPlace" placeholder="Enter Birth Place" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Enter Birth Place" style="width:100%;" value="<?php echo $RegEditStud_row['BirthPlace'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Date Of Birth<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="BirthDate" name="BirthDate" placeholder="Birth Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Birth Date" readonly style="width:100%;" value="<?php echo $RegEditStud_row['DoB'];?>">
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Mobile<i class="fa fa-star text-danger"></i>
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="Mobile" name="Mobile" placeholder="Enter Mobile No" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="" style="width:100%;" value="<?php echo $RegEditStud_row['Mobile'];?>">
																		</div>
																	</div><br>
																	<br>
																	<div class="modal-footer">
																		<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddCategory">Submit</button>
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
			<!-- Edit Student Profiles End -->

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
				    $('.tab-content').fadeToggle("slow","linear");
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
