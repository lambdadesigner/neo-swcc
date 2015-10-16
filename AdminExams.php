<?php
include('Admin_files/includes/header.php');
$StudentID = $_SESSION['StudentID'];
$sql = "SELECT Distinct (Module.ModuleName),Tests.TestID,Tests.TestName,Tests.TestType,Tests.TestWeight,Tests.MaxMarks FROM Tests INNER JOIN Module ON Module.ModuleID=Tests.ModuleID";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_POST['scenario']=="editAdmExamss")
{
	echo $updatesql = "UPDATE Tests SET TestID='".$_POST['TestID']."',ModuleID='".$_POST['ModuleName']."',CycleID='".$_POST['CycleId']."',TestType='".$_POST['TestType']."',TestWeight='".$_POST['TestWeight']."',MaxMarks='".$_POST['MaxMarks']."',TestName='".$_POST['TestName']."' WHERE TestID='".$_GET['ModId']."'"; //exit;
	$updatesql_result = sqlsrv_query( $conn, $updatesql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminExams');
}

if($_GET['action']=="delete")
{	
	echo $delsql = "DELETE FROM Tests WHERE TestID='".$_GET['Testid']."'"; //exit;
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminExams');
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
			  background: #a6e1ec;			  
			}
			.dataTable tbody tr td{
			  padding: 18px;
			}
			.border table {
				border: 1px solid #ccc;
				margin-bottom: 20px;
			} 
			.dataTable tr td{
			  border: 1px solid #f9f9f9;
			}
			table{
				border:1px solid #a6e1ec !important;
			}
			</style>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Examinations
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href=""><i class="fa fa-edit text-red"></i> Examinations</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="panel box box-info">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">
									<!-- Showing Classrooms -->
									<?php if($_GET['action']=="" && $_GET['ModId']==""){?>
										<div class="panel-heading">
											<h3 class="panel-title text-red"><!-- <i class="fa fa-pencil fa-lg"></i> Examinations -->
												<div class="pull-right">
													<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal1" style="margin-top:-13px;">
														<span class="glyphicon glyphicon-plus"></span> Add Exam
													</button>
												</div>
											</h3>
											<hr>
										</div>
										<div class="panel-body">
											<table class="table table-striped" id="examinations">
												<thead>												
													<tr class="filters1">
														<th><span>S.No</span></th>
														<th><input type="text" class="form-control" placeholder="Module Name" ></th>
														<th><input type="text" class="form-control" placeholder="Test Id" ></th>
														<th><input type="text" class="form-control" placeholder="Test Name" ></th>
														<th><input type="text" class="form-control" placeholder="Test Type" ></th>
														<th><input type="text" class="form-control" placeholder="Test Weight" ></th>	
														<th><input type="text" class="form-control" placeholder="Max Marks" ></th>	
														<th></th>
														<th></th>	
													</tr>
												</thead>
												<tbody>
												<?php $jj=1; while($row = sqlsrv_fetch_array($result)){ ?>
													<tr>
														<td><?php echo $jj;?></td>
														<td><?php echo $row['ModuleName']?></td>
														<td><?php echo $row['TestID']?></td>
														<td><?php echo $row['TestName']?></td>
														<td><?php echo $row['TestType']?></td>
														<td><?php echo $row['TestWeight']?></td>
														<td><?php echo $row['MaxMarks']?></td>	
														<td><a href="AdminExams?action=Edit&ModId=<?php echo $row['TestID'];?>" style="cursor:pointer"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a></td>
																
														<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminExams?action=delete&Testid=<?php echo $row['TestID'];?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger"></i></a> </td>												
													</tr>
												<?php $jj++; }?>												
													
												</tbody>
											</table>
										</div>
									<?php } ?>
									<!-- End Showing Examinations -->

									<!-- Edit Examinations -->
									<?php if($_GET['action']=="Edit" && $_GET['ModId']!=""){?>
										<section class="content">
											<div class="panel">
												<div class="row">
													<div class="panel filterable">
														<div class="panel-heading">											
															<a href="AdminExams" class="btn btn-default pull-right" style="margin-top:-21px;"><i class="fa fa-arrow-left"></i> Back</a>
														</div>			
														<?php
															$editExamsql = "SELECT * from Tests WHERE TestID='".$_GET['ModId']."'";
															$editExamresult = sqlsrv_query( $conn, $editExamsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
															$EditExam_row = sqlsrv_fetch_array($editExamresult)?>
														<div class="modals" id="mySchedules">
														  	<form name="scheduleAdd" method="post">
															    <div class="modal-content col-md-6 col-md-offset-3">
															      	<div class="modal-header">									        
															        	<h3 class="modal-title" id="myModalLabel">Edit Examinations</h3>
															      	</div><br>
															      	<input type="hidden" name="scenario" id="scenario" value="editAdmExamss">										      	
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Test Id
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="TestID" name="TestID" placeholder="Test Id" class="input" data-toggle="tooltip" data-placement="right" title="Test Id" required style="width:100%;" value="<?php echo $EditExam_row['TestID'];?>">
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Test Name
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="TestName" name="TestName" placeholder="Test Name" class="input" data-toggle="tooltip" data-placement="right" title="Test Name" required style="width:100%;" value="<?php echo $EditExam_row['TestName'];?>">
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Module Name
																		</div>
																		<div class="col-md-8 styled-select">
																			<?php 
																			$ModuleN_sql = "SELECT Distinct ModuleID,ModuleName FROM Module";
																			$ModuleN_result = sqlsrv_query( $conn, $ModuleN_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>										
																			<select name="ModuleName" id="ModuleName" style="width:100%;">
																				<option value="">Select Module Name</option>
																				<?php while($ModN_row = sqlsrv_fetch_array($ModuleN_result)){?>
																		  	  		<option value="<?php echo $ModN_row['ModuleID'];?>"><?php echo $ModN_row['ModuleName'];?></option>
																			  	<?php } ?>
																			</select>				
																			<script type="text/javascript">
																			for(var i=0;i<document.getElementById('ModuleName').length;i++)
												                            {
												            					if(document.getElementById('ModuleName').options[i].value=="<?php echo $EditExam_row['ModuleID'] ?>")
												            					{
												            						document.getElementById('ModuleName').options[i].selected=true;
												            					}
												                            }		
																			</script>
																		</div>
																	</div><br>
															      	<div class="row">
																		<div class="col-md-3 text-right">
																			Cycle Id
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="CycleId" name="CycleId" placeholder="Cycle Id" class="input" data-toggle="tooltip" data-placement="right" title="Cycle Id" required style="width:100%;" value="<?php echo $EditExam_row['CycleID'];?>">
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Test Type
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="TestType" name="TestType" placeholder="Test Type" class="input" data-toggle="tooltip" data-placement="right" title="Test Type" required style="width:100%;" value="<?php echo $EditExam_row['TestType'];?>">	
																		</div>
																	</div><br>				
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Test Weight
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="TestWeight" name="TestWeight" placeholder="Test Weight" class="input inputpickertext" data-toggle="tooltip" data-placement="right"title="Test Weight" required style="width:100%;" value="<?php echo $EditExam_row['TestWeight'];?>">
																		</div>
																	</div><br>
																	<div class="row">
																		<div class="col-md-3 text-right">
																			Max Marks
																		</div>
																		<div class="col-md-8">															
																			<input type="text" id="MaxMarks" name="MaxMarks" placeholder="Max Marks" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Max Marks" required style="width:100%;" value="<?php echo $EditExam_row['MaxMarks'];?>">
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
										</section><!-- /.content -->
									<?php } ?>
									<!-- End Edit Examinations -->


									<!-- Add Modal -->
									<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content" style="background-color:#FFE4C4;">

									      	<div class="modal-header">
									        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        	<h4 class="modal-title" id="myModalLabel">Examinations</h4>
									      	</div>
									      	<div class="modal-body">									      		
											  	<input type="text" id="testId" name="testId" required="required" class="form-control" placeholder="Test Id" >
											    <?php 
												  $Module_sql = "SELECT Distinct ModuleID,ModuleName FROM Module";
												  $Module_result = sqlsrv_query( $conn, $Module_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>
												<div class="styled-select">
												  	<select style="width:570px;" id="module">
												  		<option value="">Select Module Name</option>
												  		<?php while($Mod_row = sqlsrv_fetch_array($Module_result)){?>
												  	  		<option value="<?php echo $Mod_row['ModuleID'];?>"><?php echo $Mod_row['ModuleName'];?></option>
													  	<?php } ?>
													</select>
												</div>									      
												<input type="text" id="testName" name="testName" required="required" class="form-control" placeholder="Test Name" >
												<input type="text" id="CycleId" name="CycleId" required="required" class="form-control" placeholder="Cycle Id (e.g only Numbers)" >
												<input type="text" id="MaxMarks" name="MaxMarks" required="required" class="form-control" placeholder="Maximum Marks" >
										      	<div class="modal-footer">
										        	<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
										        	<button type="button" class="btn btn-default"  data-dismiss="modal" id="AddExamination">Add Examinations</button>
										      	</div>
										      	<span id="errmsg"></span>
										    </div>

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
				<strong>Copyright &copy; 2014-2015 <a href="#">SWCC Dashboard</a>.</strong> All rights reserved.
			</footer>
			
			<!-- Add the sidebar's background. This div must be placed
					 immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<!-- jQuery 2.1.4 
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>-->
		<!-- Bootstrap 3.3.2 JS 
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>-->
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
			        	$('.filters').show();
			        	$('.filters1').hide();
			            $filters.prop('disabled', false);
			            $filters.first().focus();
			        } else {
			        	$('.filters').hide();
			        	$('.filters1').show();
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
			    $('#examinations').DataTable( {
			    } );
			});

			$('#AddExamination').click(function(){
				//var classroom = $('#classroom').val();
				var module1 = $('select#module option:selected').val();
				var testId1 = $('#testId').val();
				var testName1 = $('#testName').val();
				var CycleId1 = $('#CycleId').val();
				var MaxMarks1 = $('#MaxMarks').val();
				
				$.ajax({
				   type: "GET",
				   url: "Admin_files/Admin_Exams.php",
				   data: {"module": module1, "testId": testId1, "testName": testName1, "CycleId": CycleId1, "MaxMarks": MaxMarks1},
				   success: function(msg){
					// alert( "Data Saved: " + msg ); //Anything you want
					$("#myElem").show();
					setTimeout(function() { $("#myElem").hide(); }, 5000);
				   }
				 });
			
			});	

			$("#CycleId").keypress(function (e) {		     	
		     	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {		        
		        	$("#errmsg").html("Digits Only").show().delay(1000).fadeOut("slow");
		               return false;
		    	}
		   	});
			
		</script>
<?php
include('Admin_files/includes/footer.php');
?>
