<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];
if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql = "SELECT * FROM StudentInfo";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$Sturesult = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

$Instsql = "SELECT * FROM Instructors";
$Instresult = sqlsrv_query( $conn, $Instsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$Insresults = sqlsrv_query( $conn, $Instsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Attendance
						<!-- <small></small> -->
					</h1>
					<ol class="breadcrumb">
						<li><a href="Admin"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-pencil-square-o"></i> Attendance</a></li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="">
								<div class="panel">
									<div class="panel-heading">
										<!-- <h3 class="panel-title">Users</h3> -->
										<div class="pull-right">
											<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
										</div>
									</div>
									
	                                <div class="">
                                		<div class="card">
		                                    <ul class="nav nav-tabs" role="tablist">
		                                        <li role="presentation" class="active"><a href="#RStudent" aria-controls="home" role="tab" data-toggle="tab">Student</a></li>
												<li role="presentation" ><a href="#SStudent" aria-controls="home" role="tab" data-toggle="tab">Dedicate Student</a></li>
		                                        <li role="presentation"><a href="#PInstructor" aria-controls="profile" role="tab" data-toggle="tab">Instructor</a></li>
		                                    </ul>
		                                    <!-- Tab panes -->
		                                    <div class="tab-content">
		                                        <div role="tabpanel" class="tab-pane active" id="RStudent"><br>
		                                        	<div class="col-md-9 styled-select">
		                                        		<input type="text" name="StudeName" id="StudeName" style="width:300px;" placeholder="Please Enter Student Name" title="Auto Student Name"> &nbsp;&nbsp;
			                                        	<!-- <select name="StudentName" id="StudentName">
					                                		<option value="">Select Student Name</option>
					                                		<?php while($Sturow = sqlsrv_fetch_array($Sturesult)){ ?>
					                                			<option value="<?php echo $Sturow['StudentID'];?>"><?php echo $Sturow['StudentName_en'];?></option>
					                                		<?php } ?>
					                                	</select> -->
					                                	<input type="text" name="AbsentDate" id="AbsentDate" class="inputpickertext" placeholder="From Date" readonly >
					                                	<input type="text" name="EndDate" id="EndDate" class="inputpickertext" placeholder="To Date" readonly >
					                                	<button type="button" class="btn btn-default" name="submit" id="submit">Search</button>
					                                </div><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Attendance</button><br><br><br>
													

					                                <div class="col-md-12" id="marked"></div>

		                                        	<!-- <table class="table table-striped" id="marks">
														<thead>
															<tr class="filters" style="display:none;">
																<th><input type="text" class="form-control" placeholder="Student ID" disabled></th>
																<th><input type="text" class="form-control" placeholder="Student Name" disabled></th>
																<th><input type="text" class="form-control" placeholder="Student Group" disabled></th>
																<th><input type="text" class="form-control" placeholder="National Id" disabled></th>
																<th><input type="text" class="form-control" placeholder="Birth Place" disabled></th>
																<th><input type="text" class="form-control" placeholder="DOB" disabled></th>
																<th><input type="text" class="form-control" placeholder="Mobile" disabled></th>
															</tr>
															<tr style="background-color:#3C8DBC;">																
																<th>S.No</th>
																<th>Student ID</th>
																<th>Student Name</th>
																<th>Student Group</th>
																<th>National Id</th>
																<th>Birth Place</th>
																<th>DOB</th>
																<th>Mobile</th>
															</tr>
														</thead>
														<tbody>
														<?php //$ii =1;while($row = sqlsrv_fetch_array($result)){ ?>
															<tr>
																<td><?php echo $ii;?></td>
																<td><?php echo $row['StudentID']?></td>
																<td><?php echo $row['StudentName_en']?></td>
																<td><?php echo $row['StudentGroup']?></td>
																<td><?php echo $row['NationalID']?></td>
																<td><?php echo $row['BirthPlace']?></td>
																<td><?php echo $row['DoB']?></td>
																<td><?php echo $row['Mobile']?></td>
															</tr>
														<?php //$ii++; }?>
														</tbody>
													</table> -->
		                                        </div>
												<!--Short Term course Students -->
												<div role="tabpanel" class="tab-pane" id="SStudent"><br>
		                                        	<div class="col-md-7 styled-select">
			                                        	<select name="ScStudentName" id="ScStudentName">
					                                		<option value="">Select Student Name</option>
					                                		<?php
															$sql_SStudent = "SELECT EmpID,StudentName_en FROM SCStudentInfo";
															$SStudentresult = sqlsrv_query( $conn, $sql_SStudent ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
															while($SSturow = sqlsrv_fetch_array($SStudentresult)){ ?>
					                                			<option value="<?php echo $SSturow['EmpID'];?>"><?php echo $SSturow['StudentName_en'];?></option>
					                                		<?php } ?>
					                                	</select>
					                                	
														<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
														    <input class="form-control inputpickertext" type="text" id="SCStuFromDate"/>
														    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														</div>
														<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
														    <input class="form-control inputpickertext" type="text" id="SCStuToDate"/>
														    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														</div>
					                                
					                                	<button type="button" class="btn btn-default" name="submit" id="Scsubmit">Search</button>
					                                </div><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i> Add Attendance</button><br><br><br>
													

					                                <div class="col-md-12" id="Scmarked"></div>

		                                        	<!-- <table class="table table-striped" id="marks">
														<thead>
															<tr class="filters" style="display:none;">
																<th><input type="text" class="form-control" placeholder="Student ID" disabled></th>
																<th><input type="text" class="form-control" placeholder="Student Name" disabled></th>
																<th><input type="text" class="form-control" placeholder="Student Group" disabled></th>
																<th><input type="text" class="form-control" placeholder="National Id" disabled></th>
																<th><input type="text" class="form-control" placeholder="Birth Place" disabled></th>
																<th><input type="text" class="form-control" placeholder="DOB" disabled></th>
																<th><input type="text" class="form-control" placeholder="Mobile" disabled></th>
															</tr>
															<tr style="background-color:#3C8DBC;">																
																<th>S.No</th>
																<th>Student ID</th>
																<th>Student Name</th>
																<th>Student Group</th>
																<th>National Id</th>
																<th>Birth Place</th>
																<th>DOB</th>
																<th>Mobile</th>
															</tr>
														</thead>
														<tbody>
														<?php //$ii =1;while($row = sqlsrv_fetch_array($result)){ ?>
															<tr>
																<td><?php echo $ii;?></td>
																<td><?php echo $row['StudentID']?></td>
																<td><?php echo $row['StudentName_en']?></td>
																<td><?php echo $row['StudentGroup']?></td>
																<td><?php echo $row['NationalID']?></td>
																<td><?php echo $row['BirthPlace']?></td>
																<td><?php echo $row['DoB']?></td>
																<td><?php echo $row['Mobile']?></td>
															</tr>
														<?php //$ii++; }?>
														</tbody>
													</table> -->
		                                        </div>
												<!--End Short Term course Students -->
		                                        <div role="tabpanel" class="tab-pane" id="PInstructor"><br>		                                        	
				                                	<div class="col-md-12 styled-select">
			                                        	<select name="InstructorName" id="InstructorName">
					                                		<option value="">Select Instructor Name</option>
					                                		<?php while($Insrow = sqlsrv_fetch_array($Insresults)){ ?>
					                                			<option value="<?php echo $Insrow['InstructorID'];?>"><?php echo $Insrow['InstructorName'];?></option>
					                                		<?php } ?>
					                                	</select>
					                                	<input type="text" name="InstAbsDate" id="InstAbsDate" class="inputpickertext" placeholder="From Date" readonly >
					                                	<input type="text" name="InstEndDate" id="InstEndDate" class="inputpickertext" placeholder="To Date" readonly >
					                                	<button type="button" class="btn btn-default" name="submit" id="Inssubmit">Search</button><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus"></i> Add Attendance</button>
					                                </div><br><br><br>

					                                <div class="col-md-12" id="Instmarked"></div>

		                                        	<!-- <table class="table table-striped" id="marks1">
														<thead>
															<tr class="filters" style="display:none;">
																<th><input type="text" class="form-control" placeholder="Instructor ID" disabled></th>
																<th><input type="text" class="form-control" placeholder="Instructor Name" disabled></th>
																<th><input type="text" class="form-control" placeholder="Employee Id" disabled></th>
																<th><input type="text" class="form-control" placeholder="Form Id" disabled></th>
																<th><input type="text" class="form-control" placeholder="Process" disabled></th>													
															</tr>
															<tr style="background-color:#3C8DBC;">
																<th>S.No</th>
																<th>Instructor ID</th>
																<th>Instructor Name</th>
																<th>Employee Id</th>
																<th>Form Id</th>
																<th>Process</th>
															</tr>
														</thead>
														<tbody>
															<?php //$ij =1; while($Inst_row = sqlsrv_fetch_array($Instresult)){ ?>
																<tr>
																	<td><?php echo $ij;?></td>
																	<td><?php echo $Inst_row['InstructorID']?></td>
																	<td><?php echo $Inst_row['InstructorName']?></td>
																	<td><?php echo $Inst_row['EmployeeID']?></td>
																	<td><?php echo $Inst_row['FormID']?></td>
																	<td><?php echo $Inst_row['processID']?></td>
																</tr>
															<?php //$ij++; }?>
														</tbody>
													</table> -->
		                                        </div>
												<!--popup-->
												<!-- Modal -->
												<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
													<div class="modal-content styled-select">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel"> Attendance</h4>
													  </div>
													  <input type="text" id="StudentID" name="StudentID" value="" required="required" class="form-control" placeholder="Please Enter Student ID" >
													  	
														<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
														    <input class="form-control inputpickertext" type="text" id="StuAttDate"/>
														    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														</div>
													  <input type="text" id="Module" name="Module" value="" required="required" class="form-control" placeholder="Please Enter Module" >
													  
													  <input type="text" id="StudentClass" name="StudentClass" value="" required="required" class="form-control" placeholder="Please Enter StudentClass" >
													  <select name="Status" id="Status">
					                                		<option value="">Select Status</option>
															<option value="Present">Present</option>
															<option value="Absent">Absent</option>
															
					                                	</select>
													 
													  <input type="text" id="Reason" name="Reason" value="" required="required" class="form-control" placeholder="Please Enter Reason" >
													  <input type="text" id="Cycle" name="Cycle" value="" required="required" class="form-control" placeholder="Please Enter Cycle" >
													  
													  <div class="modal-footer">
														<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
														<button type="button" class="btn btn-default"  data-dismiss="modal" id="saveStuAtt">Save Attendance</button>
													  </div>
													</div>
												  </div>
												</div>
												
												
												<!--end popup-->
												<!--popup For Instructors-->
												<!-- Modal -->
												<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
													<div class="modal-content styled-select">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Instructors Attendance</h4>
													  </div>
													  
													  <select name="OriginalInstructor" id="OriginalInstructor">
					                                		<option value="">Select Original Instructor</option>
															<?php 
															$sql = "SELECT InstructorID,InstructorName FROM Instructors";
															$result_Instructors = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
															while($row_Instructors = sqlsrv_fetch_array($result_Instructors)){ ?>
															<option value="<?php echo $row_Instructors['InstructorID']?>"><?php echo $row_Instructors['InstructorName']?></option>
															<?php }?>
															
					                                	</select>
														
														<select name="SubstituteInstructor" id="SubstituteInstructor">
					                                		<option value="">Select Substitute Instructor</option>
															<?php 
															$sql = "SELECT InstructorID,InstructorName FROM Instructors";
															$result_Instructors = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
															while($row_Instructors = sqlsrv_fetch_array($result_Instructors)){ ?>
															<option value="<?php echo $row_Instructors['InstructorID']?>"><?php echo $row_Instructors['InstructorName']?></option>
															<?php }?>
															
					                                	</select>
													  	
														<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
														    <input class="form-control inputpickertext" type="text" id="insAttDate"/>
														    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
														</div>

													  <input type="text" id="ClassSession" name="ClassSession" value="" required="required" class="form-control" placeholder="Please Enter Class Session" >
													  
													  <div class="modal-footer">
														<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
														<button type="button" class="btn btn-default"  data-dismiss="modal" id="saveIntAtt">Save Attendance</button>
													  </div>
													</div>
												  </div>
												</div>
												
												
												<!--end popup-->
												
												<!---Sc Student Add Attendance -->
												
												<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  	<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">Sc Student Attendance</h4>
													  	</div>

													  	<div class="modal-body">
														  	<div class="styled-select">
															  	<select name="employeeId" id="employeeId" style="width:100%;">
							                                		<option value="">Select Employee ID</option>
																	<?php 
																	$sql = "SELECT DISTINCT EmpID FROM SCAttendance";
																	$result_Instructors = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																	while($row_Instructors = sqlsrv_fetch_array($result_Instructors)){ ?>
																	<option value="<?php echo $row_Instructors['EmpID']?>"><?php echo $row_Instructors['EmpID']?></option>
																	<?php }?>
																	
							                                	</select>
															</div><br>
															<div class="styled-select">
																<select name="ShortCourse" id="ShortCourse" style="width:100%;">
																</select>
															</div><br>
															<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
															    <input class="form-control inputpickertext" type="text" id="ScAttDate"/>
															    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
															</div><br>
															<div class="styled-select">
																<select name="ScStatus" id="ScStatus" style="width:100%;">
								                                	<option value="">Select Status</option>
																	<option value="Present">Present</option>
																	<option value="Absent">Absent</option>
																</select>
															</div><br>
														    <input type="text" id="ScReason" name="ScReason" value="" required="required" class="form-control" placeholder="Please Enter Reason" ><br>
														    <input type="text" id="SCClass" name="SCClass" value="" required="required" class="form-control" placeholder="Please Enter SCClass" >
														</div>
													  
													  <div class="modal-footer">
														<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
														<button type="button" class="btn btn-default"  data-dismiss="modal" id="saveScAtt">Save Attendance</button>
													  </div>
													</div>
												  </div>
												</div>																								
												<!--end popup-->
												
												<!--End Sc Student Add Attendance -->
												
		                                    </div>
										</div>
									</div>           
								</div>
							</div>
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
		
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<!-- jQuery 2.1.4 -->
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
		<!-- Bootstrap 3.3.2 JS 
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->
		<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
		<!--<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>-->
		<!-- AutoComplete Script -->
		<?php 
		$autosql = "SELECT * FROM StudentInfo";
		$autoresult = sqlsrv_query( $conn, $autosql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">		
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>	
		<script>
		$(function() {
		var availableTags = [<?php while($autoSturow = sqlsrv_fetch_array($autoresult)){ ?>
			<?php echo '"'.$autoSturow['StudentName_en'].'"'.','; } ?>		  
		];
		$( "#StudeName" ).autocomplete({
		  source: availableTags
		});
		});
		</script>
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
			    // $('#marks').DataTable( {
			    // } );
			    // $('#marks1').DataTable( {
			    // } );
			} );

			$(function () {
			  $("#AbsentDate").datepicker({ 
			        autoclose: true, 
			        format: 'dd-mm-yyyy',
			        todayHighlight: true
			  }).datepicker('yy-mm-dd', new Date());;

			  $("#EndDate").datepicker({ 
			        autoclose: true, 
			        format: 'dd-mm-yyyy',
			        todayHighlight: true
			  }).datepicker('', new Date());;

			  $("#InstAbsDate").datepicker({ 
			        autoclose: true, 
			        format: 'dd-mm-yyyy',
			        todayHighlight: true
			  }).datepicker('', new Date());;

			  $("#InstEndDate").datepicker({ 
			        autoclose: true, 
			        format: 'dd-mm-yyyy',
			        todayHighlight: true
			  }).datepicker('', new Date());;
			  
			 
			  $("#StuAttDate").datepicker({ 
			        autoclose: true, 
			        format: 'dd-mm-yyyy',
			        todayHighlight: true
			  }).datepicker('', new Date());; 
			  
			   $("#insAttDate").datepicker({ 
			        autoclose: true, 
			        format: 'yyyy-mm-dd',
			        todayHighlight: true
			  }).datepicker('', new Date());; 
			  
			  
			  $("#SCStuFromDate").datepicker({ 
			        autoclose: true, 
			        format: 'yyyy-mm-dd',
			        todayHighlight: true
			  }).datepicker('', new Date());; 
			  
			  $("#SCStuToDate").datepicker({ 
			        autoclose: true, 
			        format: 'yyyy-mm-dd',
			        todayHighlight: true
			  }).datepicker('', new Date());; 
			  $("#ScAttDate").datepicker({ 
			        autoclose: true, 
			        format: 'yyyy-mm-dd',
			        todayHighlight: true
			  }).datepicker('', new Date());; 
			  
			});

			$(document).ready(function() {
				$('#submit').click(function(){
					var studId = $('#StudentName').val();
					var AbsDate = $('#AbsentDate').val();
					var EndDate = $('#EndDate').val();

					if(studId=="" || AbsDate=="" || EndDate=="")						
					{
						alert('Please Enter All The Details');
						if(studId=="")
						{
							$('.select-styled').css('border', '1px solid red');	
							return true;						
						}
						else
						{
							$('.select-styled').css('border', '0px');
						}
						if(AbsDate=="")
						{
							$('#AbsentDate').focus();
						}
						if(EndDate=="")
						{
							$('#EndDate').focus();
						}
						return true;
					}
					else
					{
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Attendance.php",
						   data: {"studentId": studId, "AbsentDate": AbsDate, "ToDate": EndDate,"Candi":"Student"},
						   success: function(msg){						   	
							 $('#marked').html(msg);
						   }
						});
						return true;
					}
					return false;
				});


				$('#Inssubmit').click(function(){
					var InstId = $('#InstructorName').val();
					var InstAbsDate = $('#InstAbsDate').val();
					var InstEndDate = $('#InstEndDate').val();

					if(InstId=="" || InstAbsDate=="" || InstEndDate=="")						
					{
						alert('Please Enter All The Details');
						if(InstId=="")
						{
							$('.select-styled').css('border', '1px solid red');	
							return true;						
						}
						else
						{
							$('.select-styled').css('border', '0px');
						}
						if(InstAbsDate=="")
						{
							$('#InstAbsDate').focus();
						}
						if(InstEndDate=="")
						{
							$('#InstEndDate').focus();
						}
						return true;
					}
					else
					{
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Attendance.php",
						   data: {"InstructorId": InstId, "InstrAbsentDate": InstAbsDate, "InstrToDate": InstEndDate,"Candi":"Instructor"},
						   success: function(msg){						   	
							 $('#Instmarked').html(msg);
						   }
						});
						return true;
					}
					return false;
				});
				
				//  Save Student Attendance
				$('#saveStuAtt').click(function(){
					
					var StudentID = $('#StudentID').val();
					var StuAttDate = $('#StuAttDate').val();
					var Module = $('#Module').val();
					var StudentClass = $('#StudentClass').val();
					var Status = $('#Status').val();
					var Reason = $('#Reason').val();
					var Cycle = $('#Cycle').val();
					
					if(StudentID==""){
						alert("Please Enter Student ID");
						$('#StudentID').focus();
						return false;	
					}
					if(StuAttDate==""){
						alert("Please Enter Date");
						$('#StuAttDate').focus();
						return false;	
					}
					if(Module==""){
						alert("Please Enter Module");
						$('#Module').focus();
						return false;	
					}
					if(StudentClass==""){
						alert("Please Enter Student Class");
						$('#StudentClass').focus();
						return false;	
					}
					if(Status==""){
						alert("Please Select Status");
						$('#Status').focus();
						return false;	
					}
					if(Status=="Absent"){
						if(Reason==""){
						alert("Please Enter Reason");
						$('#Reason').focus();
						return false;	
						}
					}
					if(Cycle==""){
						alert("Please Enter Cycle");
						$('#Cycle').focus();
						return false;	
					}
					
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Attendance.php",
						   data: {"StudentID": StudentID, "StuAttDate": StuAttDate, "Module": Module,"StudentClass": StudentClass, "Status": Status, "Reason": Reason,"Cycle": Cycle,"Candi":"StudentAttendance"},
						   success: function(msg){						   	
							 //$('#Instmarked').html(msg);
						   }
						});
						return true;
					
				});
				// End Student Attendance
				
				// Save Instructor Attendance
				$('#saveIntAtt').click(function(){
					
					var OriginalInstructor = $('#OriginalInstructor').val();
					var SubstituteInstructor = $('#SubstituteInstructor').val();
					var insAttDate = $('#insAttDate').val();
					var ClassSession = $('#ClassSession').val();
					
					
					if(OriginalInstructor==""){
						alert("Please Select Original Instructor");
						$('#OriginalInstructor').focus();
						return false;	
					}
					if(SubstituteInstructor==""){
						alert("Please Select Substitute Instructor");
						$('#SubstituteInstructor').focus();
						return false;	
					}
					if(insAttDate==""){
						alert("Please Enter Date");
						$('#insAttDate').focus();
						return false;	
					}
					
					if(ClassSession==""){
						alert("Please Enter Class Session");
						$('#ClassSession').focus();
						return false;	
					}
					
					
					
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Attendance.php",
						   data: {"OriginalInstructor": OriginalInstructor, "SubstituteInstructor": SubstituteInstructor, "insAttDate": insAttDate,"ClassSession": ClassSession,"Candi":"InstructorsAttendance"},
						   success: function(msg){						   	
							 //$('#Instmarked').html(msg);
						   }
						});
						return true;
					
				});
				// End Instructor Attendance
			
				
				
				// Sc Student Attendance Search
				$('#Scsubmit').click(function(){
					var ScStudentID = $('#ScStudentName').val();
					var SCStuFromDate = $('#SCStuFromDate').val();
					var SCStuToDate = $('#SCStuToDate').val();
						
					if(ScStudentID=="" || SCStuFromDate=="" || SCStuToDate=="")						
					{
						alert('Please Enter All The Details');
						if(ScStudentID=="")
						{
							$('.select-styled').css('border', '1px solid red');	
							return true;						
						}
						else
						{
							$('.select-styled').css('border', '0px');
						}
						if(SCStuFromDate=="")
						{
							$('#InstAbsDate').focus();
						}
						if(SCStuToDate=="")
						{
							$('#InstEndDate').focus();
						}
						return true;
					}
					else
					{
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Attendance.php",
						   data: {"ScStudentID": ScStudentID, "SCStuFromDate": SCStuFromDate, "SCStuToDate": SCStuToDate,"Candi":"ScStudent"},
						   success: function(msg){						   	
							// $('#Instmarked').html(msg);
							$('#Scmarked').html(msg);
						   }
						});
						return true;
					}
					return false;
				});
				
				// End Sc Student Attendance
				// SC Student course
				
				$('#employeeId').on('change', function() {
				var employeeID = this.value;
				
					$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Attendance.php",
						   data: {"employeeID": employeeID, "Candi":"ScStudentCourse"},
						   success: function(msg){		
								//alert(msg);
							 $('#ShortCourse').html(msg);
						   }
						});
						return true;
				
					});
				// End SC Student course
				// Save Sc Attendance
				$('#saveScAtt').click(function(){
					//alert("asfdsadg");
					var employeeId = $('#employeeId').val();
					var ShortCourse = $('#ShortCourse').val();
					var ScAttDate = $('#ScAttDate').val();
					var ScStatus = $('#ScStatus').val();
					var ScReason = $('#ScReason').val();
					var SCClass = $('#SCClass').val();
					
					
					if(employeeId==""){
						alert("Please Select EmployeeID");
						$('#employeeId').focus();
						return false;	
					}
					if(ShortCourse==""){
						alert("Please Select Short Course");
						$('#ShortCourse').focus();
						return false;	
					}
					if(ScAttDate==""){
						alert("Please Enter Date");
						$('#ScAttDate').focus();
						return false;	
					}
					
					if(ScStatus==""){
						alert("Please Select Status");
						$('#Status').focus();
						return false;	
					}
					if(ScStatus=="Absent"){
						if(ScReason==""){
						alert("Please Enter Reason");
						$('#Reason').focus();
						return false;	
						}
					}
					
					
					if(SCClass==""){
						alert("Please Enter Class");
						$('#SCClass').focus();
						return false;	
					}
						$.ajax({
						   type: "GET",
						   url: "Admin_files/Admin_Attendance.php",
						   data: {"employeeId": employeeId, "ShortCourse": ShortCourse, "ScAttDate": ScAttDate,"ScStatus": ScStatus,"ScReason": ScReason,"SCClass": SCClass, "Candi":"ScAttendanceSave"},
						   success: function(msg){
								alert(msg);
							
						   }
						});
						return true;
					
				});
				// End Sc Attendance
				

			});
			
			$(function () {
				$("#datepicker").datepicker({ 
				    autoclose: true, 
				    todayHighlight: true
				}).datepicker('update', new Date());;
			});
			
			
			
		</script>
		<style>
.datepicker{z-index:1151 !important;}
</style>

<?php
	include('Admin_files/includes/footer.php');
?>