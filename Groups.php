<?php
include('Admin_files/includes/header.php');
$StudentID = $_SESSION['StudentID'];



if($_GET['action']=="delete")
{	
	$delsql = "DELETE FROM SGroup WHERE GroupID='".$_GET['GroupID']."'";
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:Groups');
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
						Groups
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="Admin"><i class="fa fa-dashboard text-default"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-list-ul"></i> Groups</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<!-- Showing Schedules -->
				<?php if($_GET['action']=="" && $_GET['GroupID']==""){?>

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
											<?php if($_GET['err']=="success"){?>
												<span style="text-align:center; margin-left:500px; position:absolute;height:44px;padding-top:10px;" class="alert alert-success" id="succesd">
													Schedule Successfully Added....
												</span>
												<script type="text/javascript">
													setTimeout(function() { $("#succesd").fadeOut("slow"); }, 2000);
												</script>
											<?php } ?>
											
											<!-- <button type="button" class="btn btn-default pull-right" id="justs">
		  										<span id="addd"><i class="fa fa-plus"></i> Add</span><span id="vie" style="display:none"><i class="fa fa-eye"></i> View</span> Schedules
											</button> -->
											<!-- <h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Schedules
												<div class="pull-right">
													<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>&nbsp;&nbsp;&nbsp;
												</div>
											</h3> -->											
										</div>
										<?php
											if(isset($_POST['AddGroup'])){
											 $AddGroup ="INSERT INTO SGroup (GroupID,GroupName,CycleNum,Stage)VALUES('".$_POST['GroupID']."','".$_POST['GroupName']."','".$_POST['CycleNum']."','".$_POST['Stage']."')"; 
											$result = sqlsrv_query( $conn, $AddGroup ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											
											$G2M ="INSERT INTO G2M (GroupID,MCID)VALUES('".$_POST['GroupID']."','".$_POST['MCName']."')"; 
											$resultG2M = sqlsrv_query( $conn, $G2M ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											
											}
										?>
										
										<div class="panel-body sortabletable">
											<div class="row">
												<div class="filterable col-md-12">


													<div class="" id="Categories"><!-- style="display:none;" -->
														<div class="col-md-10 col-md-offset-1">
															<div class="border" id="myModalss">														  
															    <div class="modal-contents">
															      	<div class="modal-header">									        
															        	<h3 class="modal-title" id="myModalLabel">Add Groups</h3>
															      	</div><br>  

															      	<form name="AddGroup" method="post" action="">                                                              
																      	<div class="row modal-body">
																	      	<div class="col-md-6">
																				<input type="hidden" name="scenario" id="scenario" value="addAdmSchedule">	
                                                                                <div class="row">
																					<div class="col-md-3 text-right">
																						MC Name<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8 styled-select">										
																						<select name="MCName" id="MCName" style="width:100%;">
																							<option value="">Select MC Name</option>
                                                                                            <?php
                                                                                            $sql= "select * from Module_Category";
																							$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																							while($McRow = sqlsrv_fetch_array($result)){
																							?>
																							<option value="<?php echo $McRow['MCID']?>"><?php echo $McRow['MCName']?></option>
																							<?php }?>
																						</select>				
																					</div>
																				</div><br>	
                                                                                	
																				<div class="row">
																					<div class="col-md-3 text-right">
																						Group ID<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">															
																						<input type="text" id="GroupID" name="GroupID" placeholder="Group ID" class="form-control" data-toggle="tooltip" data-placement="right" title="Group ID" required style="width:100%;">
																					</div>
																				</div><br>
																				
																				<div class="row">
																					<div class="col-md-3 text-right">
																						Group Name<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">															
																						<input type="text" id="GroupName" name="GroupName" placeholder="Group Name" class="form-control" data-toggle="tooltip" data-placement="right" title="Group Name" required style="width:100%;">														
																					</div>
																				</div><br>
																																							
																			</div>

																			<div class="col-md-6">
																				<div class="row">
																					<div class="col-md-3 text-right">
																						Cycle Num<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">															
																						<input type="text" id="CycleNum" name="CycleNum" placeholder="Cycle Number" class="form-control" data-toggle="tooltip" data-placement="right" title="Cycle Number" required style="width:100%;">														
																					</div>
																				</div><br>
																			
																				<div class="row">
																					<div class="col-md-3 text-right">
																						Stage<span style="color:red;">*</span>
																					</div>
																					<div class="col-md-8">															
																						<input type="text" id="Stage" name="Stage" placeholder="Stage" class="form-control" data-toggle="tooltip" data-placement="right" title="Stage" required style="width:100%;">														
																					</div>
																				</div>
																				<br>
																			</div>	  

																			<div class="clearfix"></div>
																			<div class="modal-footer">																				
																				<input type="submit" class="btn btn-default"  data-dismiss="modal" id="AddGroup" name="AddGroup" value="Submit">
																			</div>
																	    </div>

																	</form>

																</div>
															</div>
														</div>
													</div>

													<div class="clearfix"></div>
													<br>

													<div class="col-md-12">
														<div class="panel panel-warning">
															<div class="panel-heading">
																<h3 class="panel-title">All Groups </h3>
															</div>
															<div class="panel-body">
											
																<div class="tab-content panel-body" id="ScheduleRows">									
																	<table class="table table-striped" id="groups">
																		<thead>
																			<tr class="filters">
																				<th><!-- <input type="text" class="form-control" placeholder="S.No" > -->S.No</th>
																				<th><input type="text" class="form-control" placeholder="Group ID" ></th>
																				<th><input type="text" class="form-control" placeholder="Group Name" ></th>
																				<th><input type="text" class="form-control" placeholder="Cycle Num" ></th>
																				<th><input type="text" class="form-control" placeholder="Stage" ></th>
																				
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
																		$sql_groups= "select * from SGroup";
																		$result_groups = sqlsrv_query( $conn, $sql_groups ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																		$jkl = 1; while($row_groups = sqlsrv_fetch_array($result_groups)){																	
																		?>
																			<tr>
																				<td><?php echo $jkl;?></td>
																				<td><?php echo $row_groups['GroupID']?></td>
																				<td><?php echo $row_groups['GroupName']?></td>
																				
																				<td><?php echo $row_groups['CycleNum']?></td>
																				<td><?php echo $row_groups['Stage']?></td>
																				
																				
																			
																				<!-- <td><a data-toggle="modal" data-target="#myModal<?php echo $jkl;?>" style="cursor:pointer">Edit</a> </td> -->
																				<td><a href="Groups?action=Edit&GroupID=<?php echo $row_groups['GroupID'];?>" style="cursor:pointer"> <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a> </td>
																				<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'Groups?action=delete&GroupID=<?php echo $row['GroupID'];?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger" data-toggle="tooltip" data-placement="top" title="Click to delete"></i></a> </td>
																			</tr>
																		<?php $jkl++; }?>											
																			
																		</tbody>
																	</table>
																</div>

															</div>
														</div>
													</div>
												
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
				<?php if($_GET['action']=="Edit" && $_GET['GroupID']!=""){?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
											<a href="Groups" class="btn btn-default pull-right">View Groups</a>
											<h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Edit Groups
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
												if(isset($_POST['EditGroup'])){
													
												$UpdateSql ="UPDATE SGroup SET GroupID = '".$_POST['GroupID']."',GroupName = '".$_POST['GroupName']."',CycleNum = '".$_POST['CycleNum']."',Stage = '".$_POST['Stage']."' WHERE GroupID = '".$_GET['GroupID']."'";
												$editGroupresult = sqlsrv_query( $conn, $UpdateSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												$sqlMCID = "SELECT * G2M WHERE GroupID = '".$_GET['GroupID']."' "; 
												$resultMCID = sqlsrv_query( $conn, $sqlMCID ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												$row_MCID = sqlsrv_fetch_array($resultMCID);
												$UpdateG2M ="UPDATE G2M SET GroupID = '".$_POST['GroupID']."' WHERE GroupID = '".$_GET['GroupID']."' AND MCID = '".$row_MCID['MCID']."'";
												$editGroupresult = sqlsrv_query( $conn, $UpdateSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
													
												}

										
											$editGroupSql = "SELECT * from SGroup WHERE GroupID='".$_GET['GroupID']."'";
											$editGroupresult = sqlsrv_query( $conn, $editGroupSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$EditGroupRow = sqlsrv_fetch_array($editGroupresult);
											?>
										<div class="modals" id="mySchedules">
										  	<form name="EditGroup" method="post" action="">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<!-- <div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Schedule</h3>
											      	</div><br> -->
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
														<div class="col-md-3 text-right">
															Group ID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="GroupID" name="GroupID" placeholder="Group ID" class="input" data-toggle="tooltip" data-placement="right" title="Group ID" required style="width:100%;" value="<?php echo $EditGroupRow['GroupID'];?>">
														</div>
													</div><br>
                                                    <div class="row">
														<div class="col-md-3 text-right">
															Group Name<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="GroupName" name="GroupName" placeholder="Group Name" class="input" data-toggle="tooltip" data-placement="right" title="Group Name" required style="width:100%;" value="<?php echo $EditGroupRow['GroupName'];?>">
														</div>
													</div>
											      	<br>
												
                                                <div class="row">
														<div class="col-md-3 text-right">
															Cycle Number<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="CycleNum" name="CycleNum" placeholder="Cycle Number" class="input" data-toggle="tooltip" data-placement="right" title="Cycle Number" required style="width:100%;" value="<?php echo $EditGroupRow['CycleNum'];?>">
														</div>
													</div>
											      	<br>
                                                    <div class="row">
														<div class="col-md-3 text-right">
															Group ID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Stage" name="Stage" placeholder="Stage" class="input" data-toggle="tooltip" data-placement="right" title="Stage" required style="width:100%;" value="<?php echo $EditGroupRow['Stage'];?>">
														</div>
													</div>
											      	<br>	
												
													<br>
													<div class="modal-footer">
														<input type="submit" class="btn btn-default"  data-dismiss="modal" id="EditGroup" name="EditGroup" value="Submit">
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
			    $('#groups').DataTable( {
			    });
				});


		</script>


<?php 
	include("Admin_files/includes/footer.php")
?>