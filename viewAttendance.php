<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location:index"); 
}


if($_GET['action']=="delete")
{	
	echo $delsql = "DELETE FROM ITD_Modules WHERE ModuleID='".$_GET['ModId']."'"; //exit;
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminItdModule');
}

if($_POST['scenario']=="editAdmItdModules")
{
	echo $updatesql = "UPDATE ITD_Modules SET ModuleName='".$_POST['ModuleName']."',ModuleCode='".$_POST['ModuleCode']."',ModuleWeight='".$_POST['ModuleWeight']."',ModuleCreditHours='".$_POST['ModuleCreditHours']."',ModuleColor='".$_POST['ModuleColor']."',IsOrientation='".$_POST['IsOrientation']."',IsOpenDay='".$_POST['IsOpenDay']."' WHERE ModuleID='".$_GET['ModId']."'"; 
	$updatesql_result = sqlsrv_query( $conn, $updatesql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AdminItdModule');
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
			<link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap-clockpicker.min.css">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Attendance
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="Admin"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-tasks"></i> Attendance</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">	
									<!-- Showing Classrooms -->
									<?php if($_GET['action']=="" && $_GET['ModId']==""){?>								
										<div class="panel-heading">
											<!-- <h3 class="panel-title">Users</h3> -->
											<?php if($_GET['err']=="success"){?>
												<span style="text-align:center" class="alert alert-success" id="succesd">
													Module Successfully Added....
												</span>
												<script type="text/javascript">
													setTimeout(function() { $("#succesd").fadeOut("slow"); }, 5000);
												</script>
											<?php } ?>
											<div class="pull-right">
												<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
												<button type="button" class="btn btn-default" id="justs">
			  										<span id="addd">Add</span><span id="vie" style="display:none">View</span> Attendance
												</button>											
											</div>
											<div id="myElem" class="alert alert-success" role="alert" style="display:none;" align="center">Attendance</div>	
										</div>	<br>

										<div class="sortabletable panel-body" id="ItdModulesRows">
											<div class="row">
												<div class="filterable col-md-12">	
													<!-- Show Itd Modules -->
													<div class="col-md-12">
														<div class="panel panel-info">
															<div class="panel-heading">
																<h3 class="panel-title">Check Attendance </h3>
															</div>
															<div class="panel-body">
																<div class="tab-content panel-body" id="CategoriesRows">	

																	<table class="table table-striped" id="resAttendance">
																		<thead>
																			<tr class="filters">
																				<th>S.No</th>
																				<th><input type="text" class="form-control" placeholder="Student ID" ></th>
																				<th><input type="text" class="form-control" placeholder="Date Absent" ></th>
																				<th><input type="text" class="form-control" placeholder="Module" ></th>
																				<th><input type="text" class="form-control" placeholder="StudentClass" ></th>
																				<th><input type="text" class="form-control" placeholder="Status" ></th>
																				<th><input type="text" class="form-control" placeholder="Reason" ></th>
																				<th><input type="text" class="form-control" placeholder="Cycle" ></th>
																				
																			</tr>
																			<!-- <tr class="filters1" style="background-color:#3C8DBC;">
																				<th>S.No</th>
																				<th>Module ID</th>
																				<th>Module Name</th>
																				<th>Module Code</th>
																				<th>Module Weight</th>
																				<th>Module CreditHours</th>
																				<th>Is Orientation</th>
																				<th>Is OpenDay</th>
																			</tr> -->
																		</thead>
																		<tbody>
																			<?php
																			$ItdModules_sql = "SELECT * FROM StudentAbsent WHERE StudentID ='".$_GET['stuID']."'";
$ItdModules_result = sqlsrv_query( $conn, $ItdModules_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																			 $jk=1; while($ItdModules_row = sqlsrv_fetch_array($ItdModules_result)){ ?>
																				<tr>
																					<td><?php echo $jk;?></td>
																					<td><?php echo $ItdModules_row['StudentID']?></td>
																					<td><?php echo date_format($ItdModules_row['DateAbsent'],'Y-m-d')?></td>
																					<td><?php echo $ItdModules_row['Module']; ?></td>
																					<td><?php echo $ItdModules_row['StudentClass']; ?></td>
																					<td><?php echo $ItdModules_row['Status']; ?></td>													
																					<td><?php echo $ItdModules_row['Reason']; ?></td>
																					<td><?php echo $ItdModules_row['Cycle']; ?></td>
																						
																				</tr>
																			<?php $jk++; }?>																						
																		</tbody>
																	</table>

																</div>
															</div>
														</div>
													</div>
													<!-- End Itd Modules -->
												</div>
											</div>

										</div>



										<div class="row">
												<div class="col-md-6 col-md-offset-3">
													<div class="modals box box-default" id="myModalss" style="display:none;">
													  <!-- <div class="modal-dialog" role="document"> -->
													  	<form name="scheduleAdd" method="post" action="AdmModulesSection.php">
														    <div class="modal-content">
														      	<div class="modal-header">									        
														        	<h3 class="modal-title" id="myModalLabel">Add Attendance</h3>
														      	</div><br>
														      	<input type="hidden" id="ModuleType" name="ModuleType" value="ItdModules">
														      	<div class="row">
																	<div class="col-md-3 text-right">
																		Module Name<i class="fa fa-star text-danger"></i>
																	</div>
																	<div class="col-md-8">															
																		<input type="text" id="ModuleName" name="ModuleName" required="required" class="form-control" placeholder="Module Name" >				  												
																	</div>
																</div><br>
																<div class="row">
																	<div class="col-md-3 text-right">
																		Module Code<i class="fa fa-star text-danger"></i>
																	</div>
																	<div class="col-md-8">															
																		<input type="text" id="ModuleCode" name="ModuleCode" class="form-control" placeholder="Module Code" >
																	</div>
																</div><br>
																<div class="row">
																	<div class="col-md-3 text-right">
																		Module Color<i class="fa fa-star text-danger"></i>
																	</div>
																	<div class="col-md-8">								
																		<input type="text" id="ModuleColor" name="ModuleColor" required="required" class="form-control" placeholder="Module Color" >
																	</div>
																</div><br>
																<div class="row">
																	<div class="col-md-3 text-right">
																		Module Weight<i class="fa fa-star text-danger"></i>
																	</div>
																	<div class="col-md-8">				
																		<input type="text" id="ModuleWeight" name="ModuleWeight" required="required" class="form-control" placeholder="Module Weight" >
																	</div>
																</div><br>
																<div class="row">
																	<div class="col-md-3 text-right">
																		Orientation <i class="fa fa-star text-danger"></i>
																	</div>
																	<div class="col-md-8 styled-select">
																		<select id="IsOrientation" name="IsOrientation" style="width:100%;">
																		  	<option value="">Select Orientation</option>
																		  	<option value="1">Yes</option>
																		  	<option value="0">No</option>
																		</select>
																	</div>
																</div><br>																
																<div class="row">
																	<div class="col-md-3 text-right">
																		Is Open Days<i class="fa fa-star text-danger"></i>
																	</div>
																	<div class="col-md-8 styled-select">															
																		<select id="IsOpenDay" name="IsOpenDay" style="width:100%;" >
																		  	<option value="">Select Open</option>
																		  	<option value="1">Yes</option>
																		  	<option value="0">No</option>
																		</select>
																	</div>
																</div><br>
																<div class="row">
																	<div class="col-md-3 text-right">
																		Credit Hours<i class="fa fa-star text-danger"></i>
																	</div>
																	<div class="col-md-8">
																		<input type="text" id="ModuleCreditHours" name="ModuleCreditHours" required="required" class="form-control" placeholder="Module Credit Hours" >
																	</div>
																</div>
																<br>
																<div class="modal-footer">
																	<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddCategory">Submit</button>
																</div>
														    </div>
														</form>
													  <!-- </div> -->
													</div>
												</div>
											</div>
										<?php } ?>
										<!-- End Showing ITD Modules -->

										<!-- Edit Itd Modules -->
										<?php if($_GET['action']=="Edit" && $_GET['ModId']!=""){?>
											<section class="content">
												<div class="panel">
													<div class="panel-body">
														<div class="row">
															<div class="panel filterable">
																<div class="panel-heading">											
																	<a href="AdminClassroom" class="btn btn-default pull-right"> Back</a>
																	<h3 class="panel-title text-default">
																		<!-- <div class="pull-right">
																			<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
																		</div> -->
																	</h3><br>
																</div>

																<?php
																	$editItdModsql = "SELECT * from ITD_Modules WHERE ModuleID='".$_GET['ModId']."'";
																	$editItdModresult = sqlsrv_query( $conn, $editItdModsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																	$EditItdMod_row = sqlsrv_fetch_array($editItdModresult);?>
																<div class="modals" id="mySchedules">
																  	<form name="editAuditorium" method="post">
																	    <div class="modal-content col-md-6 col-md-offset-3">
																	      	<div class="modal-header">									        
																	        	<h3 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-lg"></i> Edit Itd Modules</h3>
																	      	</div>
																	      	<br>
																	      	<input type="hidden" name="scenario" id="scenario" value="editAdmItdModules">										      	
																			<div class="row">
																				<div class="col-md-3 text-right">
																					Module Name<i class="fa fa-star text-danger"></i>
																				</div>
																				<div class="col-md-8">															
																					<input type="text" id="ModuleName" name="ModuleName" required="required" class="form-control" placeholder="Module Name" value="<?php echo $EditItdMod_row['ModuleName'];?>" >				  												
																				</div>
																			</div><br>
																			<div class="row">
																				<div class="col-md-3 text-right">
																					Module Code<i class="fa fa-star text-danger"></i>
																				</div>
																				<div class="col-md-8">															
																					<input type="text" id="ModuleCode" name="ModuleCode" class="form-control" placeholder="Module Code" value="<?php echo $EditItdMod_row['ModuleCode'];?>" >
																				</div>
																			</div><br>
																			<div class="row">
																				<div class="col-md-3 text-right">
																					Module Color<i class="fa fa-star text-danger"></i>
																				</div>
																				<div class="col-md-8">								
																					<input type="text" id="ModuleColor" name="ModuleColor" required="required" class="form-control" placeholder="Module Color" value="<?php echo $EditItdMod_row['ModuleColor'];?>" >
																				</div>
																			</div><br>
																			<div class="row">
																				<div class="col-md-3 text-right">
																					Module Weight<i class="fa fa-star text-danger"></i>
																				</div>
																				<div class="col-md-8">				
																					<input type="text" id="ModuleWeight" name="ModuleWeight" required="required" class="form-control" placeholder="Module Weight" value="<?php echo $EditItdMod_row['ModuleWeight'];?>" >
																				</div>
																			</div><br>
																			<div class="row">
																				<div class="col-md-3 text-right">
																					Orientation <i class="fa fa-star text-danger"></i>
																				</div>
																				<div class="col-md-8 styled-select">
																					<select id="IsOrientation" name="IsOrientation" style="width:100%;">
																					  	<option value="">Select Orientation</option>
																					  	<option value="1">Yes</option>
																					  	<option value="0">No</option>
																					</select>
																					<script type="text/javascript">
																					for(var i=0;i<document.getElementById('IsOrientation').length;i++)
														                            {
														            					if(document.getElementById('IsOrientation').options[i].value=="<?php echo $EditItdMod_row['IsOrientation'] ?>")
														            					{
														            						document.getElementById('IsOrientation').options[i].selected=true;
														            					}
														                            }		
																					</script>
																				</div>
																			</div><br>																
																			<div class="row">
																				<div class="col-md-3 text-right">
																					Is Open Days<i class="fa fa-star text-danger"></i>
																				</div>
																				<div class="col-md-8 styled-select">															
																					<select id="IsOpenDay" name="IsOpenDay" style="width:100%;" >
																					  	<option value="">Select Open</option>
																					  	<option value="1">Yes</option>
																					  	<option value="0">No</option>
																					</select>
																					<script type="text/javascript">
																					for(var i=0;i<document.getElementById('IsOpenDay').length;i++)
														                            {
														            					if(document.getElementById('IsOpenDay').options[i].value=="<?php echo $EditItdMod_row['IsOpenDay'] ?>")
														            					{
														            						document.getElementById('IsOpenDay').options[i].selected=true;
														            					}
														                            }		
																					</script>
																				</div>
																			</div><br>
																			<div class="row">
																				<div class="col-md-3 text-right">
																					Credit Hours<i class="fa fa-star text-danger"></i>
																				</div>
																				<div class="col-md-8">
																					<input type="text" id="ModuleCreditHours" name="ModuleCreditHours" required="required" class="form-control" placeholder="Module Credit Hours" value="<?php echo $EditItdMod_row['ModuleCreditHours'];?>" >
																				</div>
																			</div>
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
			
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<!-- Swcc App 
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		<!-- Page level javascript -->
		<script type="text/javascript" src="assets/dist/js/bootstrap-clockpicker.min.js"></script>

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
			    $('#resAttendance').DataTable( {
			    } );
			} );
			$(function () {
				  $("#datepicker").datepicker({ 
				        autoclose: true, 
				        todayHighlight: true
				  }).datepicker('update', new Date());;
				});
			
			


var input = $('#single-input1').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
});

// Manually toggle to the minutes view
$('#check-minutes').click(function(e){
    // Have to stop propagation here
    e.stopPropagation();
    input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
});
var input = $('#single-input2').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
});

// Manually toggle to the minutes view
$('#check-minutes').click(function(e){
    // Have to stop propagation here
    e.stopPropagation();
    input.clockpicker('show')
            .clockpicker('toggleView', 'minutes');
});

$( document ).ready(function() {		
	$('#BookingDate').focus(function(){		
	    $('.datepicker-orient-top').css('z-index','10000');
	});
});

$( document ).ready(function() {		
	$('#justs').click(function(){				
	    $('#ItdModulesRows').fadeToggle("slow","linear");
	    $('#myModalss').fadeToggle("fast");
	    $('#addd').toggle();
	    $('#vie').toggle();
	});
});

</script>

	<script type="text/javascript" src="assets/dist/js/bootstrap-clockpicker.min.js"></script>			
	<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<script src="assets/dist/js/datepicker.js"></script>
	<script type="text/javascript">
		// $(document).ready(function(){
		// 		$('#AddCategory').click(function(){				
					
		// 			var CategoryId = $('#CategoryId').val();
		// 			var CategoryName = $('#CategoryName').val();
		// 			var HeirarchyId   = $('#HeirarchyId').val();
		// 			var singleinput2 = $('#stage').val();
					
		// 			$.ajax({
		// 			   type: "GET",
		// 			   url: "instructors/auditoriumbooking.php",
		// 			   data: {"AuditoriumNum": AuditoriumNum, "BookingDate": BookingDate, "BookedBy": BookedBy, "singleinput1": singleinput1,"singleinput2": singleinput2},
		// 			   success: function(msg){
		// 				 //alert( "Data Saved: " + msg ); //Anything you want
		// 				$("#myElem").show();
		// 				setTimeout(function() { $("#myElem").hide(); }, 3000);
		// 			   }
		// 			 });
				
		// 		});							
		// 	});
	</script>
<?php 
	include("Admin_files/includes/footer.php")
?>	
	</body>
</html>
