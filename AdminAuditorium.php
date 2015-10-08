<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location:index"); 
}
$sql = "SELECT * FROM AuditoriumBookingStatus";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_GET['action']=="delete")
{	
	$delsql = "DELETE FROM AuditoriumBookingStatus WHERE AuditoriumNum='".$_GET['Auditid']."' AND BookingDate='".$_GET['date']."'";
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminAuditorium');
}

if($_POST['scenario']=="editAdmAuditorium")
{
	echo $updatesql = "UPDATE AuditoriumBookingStatus SET AuditoriumNum='".$_POST['AuditoriumNum']."',BookingDate='".$_POST['BookingDate']."',BookedBy='".$_POST['BookedBy']."',StartTime='".$_POST['StartTime']."',EndTime='".$_POST['EndTime']."' WHERE AuditoriumNum='".$_GET['ModId']."' AND BookingDate='".$_GET['date']."'"; //exit;
	$updatesql_result = sqlsrv_query( $conn, $updatesql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminAuditorium');
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
						Auditorium Booking Status
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">
									<!-- Showing Auditoriums -->
									<?php if($_GET['action']=="" && $_GET['ModId']==""){?>
										<div class="panel-heading">
											<!-- <h3 class="panel-title">Users</h3> -->
											<div class="pull-right">
												<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
												<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal">
			  										<i class="fa fa-plus"></i> Auditorium Booking
												</button>
											</div>
											<div id="myElem" class="alert alert-success" role="alert" style="display:none;" align="center">Auditorium Booked</div>
											<br><br>
										</div>

										<div class="tab-content panel-body border" id="auditoriumRows">																		
											<table class="table table-striped" id="auditorium">
												<thead>
													<tr class="filters" style="">
														<th>S.No</th>
														<th><input type="text" class="form-control" placeholder="Auditorium Number" ></th>
														<th><input type="text" class="form-control" placeholder="Booking Date" ></th>
														<th><input type="text" class="form-control" placeholder="Booked By" ></th>
														<th><input type="text" class="form-control" placeholder="Start Time" ></th>
														<th><input type="text" class="form-control" placeholder="End Time"></th>
														<th>Edit</th>
														<th>Delete</th>
													</tr>
													<!-- <tr class="filters1" style="background-color:#1CAF9A;display:none;">
														<th>S.No</th>
														<th>Auditorium Number</th>
														<th>Booking Date</th>
														<th>Booked By</th>
														<th>Start Time</th>
														<th>End Time</th>	
														<th>S.No</th>												
													</tr> -->
												</thead>
												<tbody>
												<?php $jk=1; while($row = sqlsrv_fetch_array($result)){ ?>
													<tr>
														<td><?php echo $jk;?></td>
														<td><?php echo $row['AuditoriumNum']?></td>
														<td><?php $BookingDate = date_format($row['BookingDate'], 'Y-m-d'); echo $BookingDate; ?></td>
													
														<td><?php echo $row['BookedBy']?></td>
														<td><?php $StartTime = date_format($row['StartTime'], 'H:i:s'); echo $StartTime; ?></td>
														<td><?php $EndTime = date_format($row['EndTime'], 'H:i:s'); echo $EndTime; ?></td>

														<td><a href="AdminAuditorium?action=Edit&ModId=<?php echo $row['AuditoriumNum'];?>&date=<?php echo date_format($row['BookingDate'],"Y-m-d");?>" style="cursor:pointer"> <i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a> </td>
														
														<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminAuditorium?action=delete&Auditid=<?php echo $row['AuditoriumNum'];?>&date=<?php echo date_format($row['BookingDate'],"Y-m-d");?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger"></i></a> </td>
													</tr>
												<?php $jk++; }?>
												</tbody>
											</table>
										</div>
									<?php } ?>
									<!-- End Showing Auditoriums -->

									<!-- Edit Auditoriums -->
									<?php if($_GET['action']=="Edit" && $_GET['ModId']!=""){?>
										<section class="content">
											<div class="panel">
												<div class="panel-body">
													<div class="row">
														<div class="panel filterable">
															<div class="panel-heading">											
																<a href="AdminAuditorium" class="btn btn-default pull-right"> Back</a>
																<h3 class="panel-title text-default">
																	<!-- <div class="pull-right">
																		<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
																	</div> -->
																</h3><br>
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
																$editAuditsql = "SELECT * from AuditoriumBookingStatus WHERE AuditoriumNum='".$_GET['ModId']."' AND BookingDate='".$_GET['date']."'";
																$editAuditresult = sqlsrv_query( $conn, $editAuditsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																$EditAudit_row = sqlsrv_fetch_array($editAuditresult);?>
															<div class="modals" id="mySchedules">
															  	<form name="editAuditorium" method="post">
																    <div class="modal-content col-md-6 col-md-offset-3">
																      	<div class="modal-header">									        
																        	<h3 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-lg"></i> Edit Auditorium</h3>
																      	</div>
																      	<br>
																      	<input type="hidden" name="scenario" id="scenario" value="editAdmAuditorium">										      	
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Auditorium No.<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">															
																				<input type="text" id="AuditoriumNum" name="AuditoriumNum" required="required" class="form-control" placeholder="Auditorium Number" value="<?php echo $EditAudit_row['AuditoriumNum']?>" >
																			</div>
																		</div><br>
																      	<div class="row">
																			<div class="col-md-3 text-right">
																				Booking Date<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">			
																				<input class="form-control inputpickertext" type="text" id="BookingDate" name="BookingDate" placeholder="Booked Date" value="<?php echo date_format($EditAudit_row['BookingDate'],"Y-m-d");?>"/>
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Start Time<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">															
																				  <input class="form-control" id="single-input1" placeholder="Start Time" name="StartTime" value="<?php echo date_format($EditAudit_row['StartTime'],'H:i:s');?>">
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-3 text-right">
																				End Time<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">		
																				  <input class="form-control" id="single-input2" placeholder="End Time" name="EndTime" value="<?php echo date_format($EditAudit_row['EndTime'],'H:i:s');?>">			
																			</div>
																		</div><br>
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Booked By<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">
																				  <input class="form-control" id="single-input2" placeholder="Booked By" name="BookedBy" value="<?php echo $EditAudit_row['BookedBy'];?>">			
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
									
									<!-- Modal -->
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="myModalLabel">Auditorium Booking</h4>
									      </div>
										  <input type="text" id="AuditoriumNum" name="AuditoriumNum" value="" required="required" class="form-control" placeholder="Auditorium Number" >
									      <div class="modal-body">
									        <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
											    <input class="form-control inputpickertext" type="text" id="BookingDate"  />
											    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
									      </div>										  
										  <input class="form-control" id="single-input1" value="" placeholder="Start Time" name="StartTime">
										  <input class="form-control" id="single-input2" value="" placeholder="End Time" name="EndTime">
									      <div class="modal-footer">
									        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
									        <button type="button" class="btn btn-default"  data-dismiss="modal" id="BookAuditorium">Book Auditorium</button>
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
			    $('#auditorium').DataTable( {
			    } );
			} );
			$(function () {
				  $("#BookingDate").datepicker({ 
				        autoclose: true, 
				        todayHighlight: true
				  }).datepicker('', new Date());;
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

</script>

	<script type="text/javascript" src="assets/dist/js/bootstrap-clockpicker.min.js"></script>			
	<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<script src="assets/dist/js/datepicker.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
				$('#BookAuditorium').click(function(){									
					var AuditoriumNum = $('#AuditoriumNum').val();
					var BookingDate   = $('#BookingDate').val();
					var BookedBy      = "Admin";
					var singleinput1 = $('#single-input1').val();
					var singleinput2 = $('#single-input2').val();
					
					$.ajax({
					   type: "GET",
					   url: "instructors/auditoriumbooking.php",
					   data: {"AuditoriumNum": AuditoriumNum, "BookingDate": BookingDate, "BookedBy": BookedBy, "singleinput1": singleinput1,"singleinput2": singleinput2},
					   success: function(msg){
						 //alert( "Data Saved: " + msg ); //Anything you want
						$("#myElem").show();
						setTimeout(function() { $("#myElem").hide(); }, 3000);
					   }
					 });
				
				});							
			});
	</script>
<?php 
	include("Admin_files/includes/footer.php")
?>	