<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location:index"); 
}
$Modules_sql = "SELECT Module.ModuleID,Module.MCID,Module.ModuleName,Module.Duration,Module.Weight,Module.Abbrevation,Module.InstructorID,Module.TestTypeID,Module.GroupID,Module_Category.MCName FROM Module INNER JOIN Module_Category ON Module.MCID=Module_Category.MCID";
$Modules_result = sqlsrv_query( $conn, $Modules_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_GET['action']=="delete" && $_GET['ModId']!="")
{	

	$delsql = "DELETE FROM Module WHERE ModuleID='".$_GET['ModId']."' AND InstructorID ='".$_GET['inst']."' AND GroupID ='".$_GET['GroupID']."' ";
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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
			</style>
			<link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap-clockpicker.min.css">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Regular Modules
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>
					<?php if($_GET['action']=="" && $_GET['ModId']==""){?>
				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">									
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
		  										<span id="addd"><i class="fa fa-plus"></i> Add</span><span id="vie" style="display:none"><i class="fa fa-eye"></i> View</span> Modules
											</button>											
										</div>
										<br><br>
										<div id="myElem" class="alert alert-success" role="alert" style="display:none;" align="center">Modules Category</div>	
									</div>
									<div class="tab-content panel-body border" >
										<table class="table table-striped" id="Modules">
											<thead>
												<tr class="filters">
													<th>S.No</th>
													<th><input type="text" class="form-control" placeholder="Module ID" ></th>
													<th><input type="text" class="form-control" placeholder="Category Name" ></th>
													<th><input type="text" class="form-control" placeholder="Module Name" ></th>
													<th><input type="text" class="form-control" placeholder="Duration" ></th>
													<th><input type="text" class="form-control" placeholder="Weight" ></th>
													<th><input type="text" class="form-control" placeholder="Abbrevation" ></th>
													<th><input type="text" class="form-control" placeholder="Instructor Id" ></th>
													<th><input type="text" class="form-control" placeholder="Group Id" ></th>
													<th></th>
													<th></th>
												</tr>
												<!-- <tr class="filters1" style="background-color:#3C8DBC;">
													<th>S.No</th>
													<th>Module ID</th>
													<th>Category Name</th>
													<th>Module Name</th>
													<th>Duration</th>
													<th>Weight</th>
													<th>Abbrevation</th>
													<th>Instructor Id</th>												
													<th>Group Id</th>
													<th></th>
													<th></th>
												</tr> -->
											</thead>
											<tbody>
												<?php $jk=1; while($Modules_row = sqlsrv_fetch_array($Modules_result)){ ?>
													<tr>
														<td><?php echo $jk;?></td>
														<td><?php echo $Modules_row['ModuleID']?></td>
														<td><?php echo $Modules_row['MCName']?></td>
														<td><?php echo $Modules_row['ModuleName']?></td>
														<td><?php echo $Modules_row['Duration']; ?></td>
														<td><?php echo $Modules_row['Weight']; ?></td>
														<td><?php echo $Modules_row['Abbrevation']; ?></td>
														<td><?php echo $Modules_row['InstructorID']; ?></td>				
														<td><?php echo $Modules_row['GroupID']; ?></td>
														<td><a href="AdminModules?action=Edit&ModId=<?php echo $Modules_row['ModuleID'];?>&inst=<?php echo $Modules_row['InstructorID']?>&GroupID=<?php echo $Modules_row['GroupID'] ?>" style="cursor:pointer"> <i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a> </td>
															<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminModules?action=delete&ModId=<?php echo $Modules_row['ModuleID'];?>&inst=<?php echo $Modules_row['InstructorID']?>&GroupID=<?php echo $Modules_row['GroupID'] ?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger"></i></a> </td>
													</tr>
												<?php $jk++; }?>																						
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
										if(isset($_POST['AddModule'])){
										$ModuleId=$_POST['ModuleId'];
										$MCID=$_POST['MCID'];	
										$ModuleName=$_POST['ModuleName'];
										$Duration=$_POST['Duration'];
										$Weight=$_POST['Weight'];	
										$Abbrevation=$_POST['Abbrevation'];	
										$InstructorID=$_POST['InstructorID'];	
										$TestTypeID=$_POST['TestTypeID'];	
										$GroupId=$_POST['GroupId'];	
										
											$sql="INSERT INTO Module(ModuleID,MCID,ModuleName,Duration,Weight,Abbrevation,InstructorID,TestTypeID,GroupID)
											VALUES('".$ModuleId."','".$MCID."','".$ModuleName."','".$Duration."','".$Weight."','".$Abbrevation."','".$InstructorID."','".$TestTypeID."','".$GroupId."')";
											$sql_result = sqlsrv_query( $conn, $sql_Module_Category ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											header("Location:AdminModules"); 
											
										}
									
									?>
									
									<div class="row">
											<div class="col-md-6 col-md-offset-3">
												<div class="modals box box-default" id="myModalss" style="display:none;">
												  <!-- <div class="modal-dialog" role="document"> -->
												  	<form name="ModuleAdd" method="post" action="">
													    <div class="modal-content">
													      	<div class="modal-header">									        
													        	<h3 class="modal-title" id="myModalLabel">Add Module</h3>
													      	</div>
													      	<input type="hidden" name="scenario" id="scenario" value="addAdmModule">										      	
															<div class="row">
																<div class="col-md-3 text-right">
																	Module Id<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="ModuleId" name="ModuleId" placeholder="Module Id" class="input" data-toggle="tooltip" data-placement="right" title="Module Id" required style="width:100%;">
																</div>
															</div>
													      	<div class="row">
																<div class="col-md-3 text-right">
																	MCID<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8 styled-select">										
																	<select name="MCID" id="MCID" style="width:500px;">
																	<option value="">Select MCName</option>
																	<?php
																	$sql_Module_Category="SELECT MCID,MCName FROM Module_Category";
																	$sql_Module_Categoryresult = sqlsrv_query( $conn, $sql_Module_Category ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																	while($sql_Module_Category_row = sqlsrv_fetch_array($sql_Module_Categoryresult)){
																	?>
																		
																		<option value="<?php echo $sql_Module_Category_row['MCID'];?>"><?php echo $sql_Module_Category_row['MCName'];?></option>
																	<?php }	?>
																	</select>				
																</div>
															</div><br>
															<div class="row">
																<div class="col-md-3 text-right">
																	Module Name<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="ModuleName" name="ModuleName" placeholder="Module Name" class="input" data-toggle="tooltip" data-placement="right" title="Module Name"  required style="width:100%;">														
																</div>
															</div>
															<div class="row">
																<div class="col-md-3 text-right">
																	Duration<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Duration" name="Duration" placeholder="Duration" class="input" data-toggle="tooltip" data-placement="right" title="Duration"  required style="width:100%;">														
																</div>
															</div>
															
															<div class="row">
																<div class="col-md-3 text-right">
																	Weight<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="number" id="Weight" name="Weight" placeholder="Weight" class="input" data-toggle="tooltip" data-placement="right" title="Weight"  required style="width:100%;">														
																</div>
															</div>
															<div class="row">
																<div class="col-md-3 text-right">
																	Abbrevation<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="Abbrevation" name="Abbrevation" placeholder="Abbrevation" class="input" data-toggle="tooltip" data-placement="right" title="Abbrevation"  required style="width:100%;">														
																</div>
															</div>
															
															<div class="row">
																<div class="col-md-3 text-right">
																	InstructorID<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="InstructorID" name="InstructorID" placeholder="InstructorID" class="input" data-toggle="tooltip" data-placement="right" title="InstructorID"  required style="width:100%;">														
																</div>
															</div>
															
															<div class="row">
																<div class="col-md-3 text-right">
																	Test TypeID<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8">															
																	<input type="text" id="TestTypeID" name="TestTypeID" placeholder="TestTypeID" class="input" data-toggle="tooltip" data-placement="right" title="TestTypeID" required style="width:100%;">														
																</div>
															</div>
															
															
															<div class="row">
																<div class="col-md-3 text-right">
																	Group Id<i class="fa fa-star text-danger"></i>
																</div>
																<div class="col-md-8 styled-select">
																	<?php 
																		$grpIdsql = "SELECT * FROM SGroup";
																		$grpIdresult = sqlsrv_query( $conn, $grpIdsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>
																	<select name="GroupId" id="GroupId" style="width:500px;">
																		<option value="">Select Group Name</option>
																		<?php while($groupId_row = sqlsrv_fetch_array($grpIdresult)){?>
																			<option value="<?php echo $groupId_row['GroupID'];?>"><?php echo $groupId_row['GroupName'];?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>	
															
															<div class="modal-footer">
																<input type="submit" class="btn btn-default"  data-dismiss="modal" id="AddModule" name="AddModule">
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
				<?php }?>
				
				<!-- Edit Schedulesss Start -->
				<?php if($_GET['action']=="Edit" && $_GET['ModId']!=""){?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
											<a href="AdminModules" class="btn btn-default pull-right">View Modules </a>
											<h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Edit Modules 
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
											if(isset($_POST['EditModule'])){
												$ModuleID= $_POST['ModuleID'];
												$MCID= $_POST['MCID'];
												$ModuleName= $_POST['ModuleName'];
												$Duration= $_POST['Duration'];
												$Weight= $_POST['Weight'];
												$Abbrevation= $_POST['Abbrevation'];
												$InstructorID= $_POST['InstructorID'];
												$TestTypeID =$_POST['TestTypeID'];
												$GroupID= $_POST['GroupID'];
												 $sql="UPDATE Module SET ModuleID='".$ModuleID."',MCID='".$MCID."',ModuleName='".$ModuleName."',Duration='".$Duration."',Weight='".$Weight."',Abbrevation='".$Abbrevation."',InstructorID='".$InstructorID."',TestTypeID='".$TestTypeID."',GroupID='".$GroupID."' WHERE ModuleID='".$_GET['ModId']."' AND InstructorID='".$_GET['inst']."'AND GroupID='".$_GET['GroupID']."'";
												$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
												header("Location:AdminModules"); 
											}
										
										
											$sql = "SELECT * from Module WHERE ModuleID='".$_GET['ModId']."' AND InstructorID='".$_GET['inst']."'AND GroupID='".$_GET['GroupID']."'";
											$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$result_row = sqlsrv_fetch_array($result)?>
										<div class="modals" id="mymodule">
										  	<form name="scheduleAdd" method="post" action="">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Modules</h3>
											      	</div><br>
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
														<div class="col-md-3 text-right">
															Module ID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="ModuleID" name="ModuleID" placeholder="Module Id" class="input" data-toggle="tooltip" data-placement="right" title="Module Id" required style="width:100%;" value="<?php echo $result_row['ModuleID'];?>" readonly>
														</div>
													</div>
											      
													
													<div class="row">
														<div class="col-md-3 text-right">
															MC Name<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">										
															<select name="MCID" id="MCID" style="width:515px;">
																<option value="">Select MCID</option>
													<?php
												    $Module= "SELECT MCID,MCName FROM Module_Category";
													$resultModule = sqlsrv_query( $conn, $Module ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
													while($rowModule = sqlsrv_fetch_array($resultModule)){
													?>
																<option value="<?php echo $rowModule['MCID']?>"><?php echo $rowModule['MCName']?></option>
													<?php }?>
																
															</select>				
															
														</div>
													</div><br>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Module Name<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="ModuleName" name="ModuleName" placeholder="Module Name" class="input" data-toggle="tooltip" data-placement="right" title="Module Name" required style="width:100%;" value="<?php echo $result_row['ModuleName'];?>">
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Duration<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Duration" name="Duration" placeholder="Duration" class="input" data-toggle="tooltip" data-placement="right" title="Duration" required style="width:100%;" value="<?php echo $result_row['Duration'];?>">
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															Weight<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Weight" name="Weight" placeholder="Weight" class="input" data-toggle="tooltip" data-placement="right" title="Weight" required style="width:100%;" value="<?php echo $result_row['Weight'];?>">
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															Abbrevation<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Abbrevation" name="Abbrevation" placeholder="Abbrevation" class="input" data-toggle="tooltip" data-placement="right" title="Abbrevation" required style="width:100%;" value="<?php echo $result_row['Abbrevation'];?>">
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															Instructor ID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="InstructorID" name="InstructorID" placeholder="InstructorID" class="input" data-toggle="tooltip" data-placement="right" title="InstructorID" required style="width:100%;" value="<?php echo $result_row['InstructorID'];?>">
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															Test TypeID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="TestTypeID" name="TestTypeID" placeholder="Test Type ID" class="input" data-toggle="tooltip" data-placement="right" title="TestTypeID" required style="width:100%;" value="<?php echo $result_row['TestTypeID'];?>">
														</div>
													</div>
													
													
														<div class="row">
														<div class="col-md-3 text-right">
															Group ID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8 styled-select">										
															<select name="GroupID" id="GroupID" style="width:515px;">
																<option value="">Select GroupID</option>
													<?php
												    $SGroup= "SELECT GroupID,GroupName FROM SGroup";
													$resultSGroup = sqlsrv_query( $conn, $SGroup ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
													while($rowSGroup = sqlsrv_fetch_array($resultSGroup)){
													?>
																<option value="<?php echo $rowSGroup['GroupID']?>"><?php echo $rowSGroup['GroupName']?></option>
													<?php }?>
																
															</select>				
															
														</div>
													</div><br>
													
													<br>
													<div class="modal-footer">
														<input type="submit" class="btn btn-default"  data-dismiss="modal" name="EditModule" id="EditModule">
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
			    $('#Modules').DataTable( {
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
	    $('#Modules_wrapper').fadeToggle("slow","linear");
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
