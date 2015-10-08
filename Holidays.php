<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location:index"); 
}
$holiday_sql = "SELECT * FROM ITD_Holidays";
$Holidays_result = sqlsrv_query( $conn, $holiday_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_GET['action']=="delete")
{	
	$delsql = "DELETE FROM ITD_Holidays WHERE HolidayID='".$_GET['Holidayid']."'";
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
						List Of Holidays
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>

			<!-- Main content -->
			<!-- Holiday Show Panel -->
			<?php if($_GET['action']=="" && $_GET['Holidayid']==""){?>
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">									
									<div class="panel-heading">
										<!-- <h3 class="panel-title">Users</h3> -->
										<?php if($_GET['err']=="success"){?>
											<span style="text-align:center" class="alert alert-success" id="succesd">
												Holiday Successfully Added....
											</span>
											<script type="text/javascript">
												setTimeout(function() { $("#succesd").fadeOut("slow"); }, 5000);
											</script>
										<?php } ?>
										<div class="pull-right">
											<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
											<button type="button" class="btn btn-default" id="justs">
		  										<span id="addd"><i class="fa fa-plus"></i> Add</span><span id="vie" style="display:none"><i class="fa fa-eye"></i> View</span> Holiday
											</button>											
										</div>
										<div id="myElem" class="alert alert-success" role="alert" style="display:none;" align="center">Holiday Category</div>	
									</div>	<br>		

									<div class="panel-body border">						
										<table class="table table-striped" id="Holidays">
											<thead>
												<tr class="filters">
													<th>S.No</th>
													<th><input type="text" class="form-control" placeholder="Holiday ID" ></th>
													<th><input type="text" class="form-control" placeholder="Holiday Name" ></th>
													<th><input type="text" class="form-control" placeholder="Start Date" ></th>
													<th><input type="text" class="form-control" placeholder="End Date" ></th>
													<th><input type="text" class="form-control" placeholder="Is Teacher Holiday" ></th>
													<th><input type="text" class="form-control" placeholder="Is Annual Holiday" ></th>
													<th>Edit</th>
													<th>Delete</th>
												</tr>
												<!-- <tr class="filters1" style="background-color:#3C8DBC;">
													<th>S.No</th>
													<th>Holiday ID</th>
													<th>Holiday Name</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Is Teacher Holiday</th>
													<th>Is Annual Holiday</th>
													<th>Edit</th>
													<th>Delete</th>												
												</tr> -->
											</thead>
											<tbody>
												<?php $jk=1; while($Holiday_row = sqlsrv_fetch_array($Holidays_result)){ ?>
													<tr>
														<td><?php echo $jk;?></td>
														<td><?php echo $Holiday_row['HolidayID']?></td>
														<td><?php echo $Holiday_row['HolidayName']?></td>
														<td><?php echo date_format($Holiday_row['FromDate'],"Y-m-d"); ?></td>
														<td><?php echo date_format($Holiday_row['ToDate'],"Y-m-d"); ?></td>
														<td><?php echo $Holiday_row['IsTeacherHoliday']; ?></td>
														<td><?php echo $Holiday_row['IsAnnualHoliday']; ?></td>
														<!-- <td><a data-toggle="modal" data-target="#myModal<?php echo $jk;?>" style="cursor:pointer">Edit</a> </td> -->
														<td><a href="Holidays?action=Edit&Holidayid=<?php echo $Holiday_row['HolidayID'];?>" style="cursor:pointer">Edit</a> </td>
														<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'Holidays?action=delete&Holidayid=<?php echo $Holiday_row['HolidayID'];?>'; return false;}" style="cursor:pointer">Delete</a> </td>
													</tr>
												<?php $jk++; }?>																						
											</tbody>
										</table>
									</div>

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
										<form name="AddHoliday" method="post" action="AdmHolidays.php">
											<!-- Modal -->
											<div class="modals" id="myModalss" style="display:none;"><br>
											  <!-- <div class="modal-dialog" role="document"> -->
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Add Holiday</h3>
											      	</div>
											      	<input type="hidden" name="scenario" id="scenario" value="add">
											      	<div class="row">
														<div class="col-md-3 text-right">
															Holiday Name<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="HolidayName" name="HolidayName" placeholder="Holiday Name" class="input" data-toggle="tooltip" data-placement="right" title="Holiday Name" required style="width:100%;">
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															Start Date<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="StartDate" name="StartDate" placeholder="Start Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Start Date" required style="width:100%;">
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															End Date<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="EndDate" name="EndDate" placeholder="End Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="End Date" style="width:100%;">
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Select Holiday For Instructor
														</div>
														<div class="col-md-8 styled-select">															
															<select id="IsTeach" name="IsTeach" style="width:100%;">
																<option value="">Select Holiday For Instructor </option>
																<option value="1">Yes</option>
																<option value="0">No</option>
															</select>
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															Select Annual Holiday
														</div>
														<div class="col-md-8 styled-select">															
															<select id="IsAnnual" name="IsAnnual" style="width:100%;">
																<option value="">Select Annual Holiday</option>
																<option value="1">Yes</option>
																<option value="0">No</option>
															</select>
														</div>
													</div><br>
													<div class="modal-footer">
													<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddCategory">Submit</button>
													</div>
											    </div>
											  <!-- </div> -->
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section><!-- /.content -->
			<?php } ?>
			<!-- Holidays Show Panel End -->

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
			</style>

			<!-- Holidays Edit Panel Start -->
			<?php if($_GET['action']=="Edit" && $_GET['Holidayid']!=""){
				$holiday_sql1 = "SELECT * FROM ITD_Holidays WHERE HolidayID='".$_GET['Holidayid']."'";
				$Holidays1_result = sqlsrv_query( $conn, $holiday_sql1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
				$Holiday1_row = sqlsrv_fetch_array($Holidays1_result)?>
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="panel filterable">	
									<div class="panel-heading">										
										<div class="pull-right">
											<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
											<a href="Holidays" class="btn btn-default"><i class="fa fa-eye"></i> View</span> Holiday</a>											
										</div>
										<div id="myElem" class="alert alert-success" role="alert" style="display:none;" align="center">Holiday Category</div>	
									</div>	
									
									<div class="panel-body">
										<form name="AddHoliday" method="post" action="AdmHolidays.php">
											<!-- Modal -->
											<div class="modals" id="myModaled"><br>
											  <!-- <div class="modal-dialog" role="document"> -->
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit Holiday</h3>
											      	</div>
											      	<input type="hidden" name="scenario" id="scenario" value="edit">
											      	<input type="hidden" name="HolidayId" id="HolidayId" value="<?php echo $Holiday1_row['HolidayID']?>">
											      	<div class="row">
														<div class="col-md-3 text-right">
															Holiday Name<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="HolidayName" name="HolidayName" placeholder="Holiday Name" class="input" data-toggle="tooltip" data-placement="right" title="Holiday Name" required style="width:100%;" value="<?php echo $Holiday1_row['HolidayName'];?>">
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															Start Date<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="StartDate" name="StartDate" placeholder="Start Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Start Date" required style="width:100%;" value="<?php echo date_format($Holiday1_row['FromDate'],"Y-m-d");?>">
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															End Date<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="EndDate" name="EndDate" placeholder="End Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="End Date" style="width:100%;" value="<?php echo date_format($Holiday1_row['ToDate'],"Y-m-d");?>">
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Select Holiday For Instructor
														</div>
														<div class="col-md-8 styled-select">															
															<select id="IsTeach" name="IsTeach" style="width:100%;">
																<option value="">Select Holiday For Instructor </option>
																<option value="1">Yes</option>
																<option value="0">No</option>
															</select>
															<script type="text/javascript">
															for(var i=0;i<document.getElementById('IsTeach').length;i++)
								                            {
								            					if(document.getElementById('IsTeach').options[i].value=="<?php echo $Holiday1_row['IsTeacherHoliday'] ?>")
								            					{
								            						document.getElementById('IsTeach').options[i].selected=true;
								            					}
								                            }		
															</script>
														</div>
													</div><br>
													<div class="row">
														<div class="col-md-3 text-right">
															Select Annual Holiday
														</div>
														<div class="col-md-8 styled-select">															
															<select id="IsAnnual" name="IsAnnual" style="width:100%;">
																<option value="">Select Annual Holiday</option>
																<option value="1">Yes</option>
																<option value="0">No</option>
															</select>
															<script type="text/javascript">
															for(var i=0;i<document.getElementById('IsAnnual').length;i++)
								                            {
								            					if(document.getElementById('IsAnnual').options[i].value=="<?php echo $Holiday1_row['IsAnnualHoliday'] ?>")
								            					{
								            						document.getElementById('IsAnnual').options[i].selected=true;
								            					}
								                            }		
															</script>
														</div>
													</div><br>
													<div class="modal-footer">
													<button type="submit" class="btn btn-default"  data-dismiss="modal" id="AddCategory">Submit</button>
													</div>
											    </div>
											  <!-- </div> -->
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section><!-- /.content -->
				<?php } ?>
				<!-- Holidays Edit Panel End -->

			</div><!-- /.content-wrapper -->

			<?php /*$jk=1; 
				$holiday_sql1 = "SELECT * FROM ITD_Holidays";
				$Holidays1_result = sqlsrv_query( $conn, $holiday_sql1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
				while($Holiday1_row = sqlsrv_fetch_array($Holidays1_result)){ ?>
			<div class="modal fade" id="myModal<?php echo $jk;?>" role="dialog">
				<div class="modal-dialog modal-captain">
				 	<div class="modal-header" style="background-color:#fff;">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					  	<h4 class="modal-title"><?php echo $Holiday1_row['HolidayID']?></h4>
					</div>
				  	<!-- Modal content-->
				  	<div class="modal-content">
				  		<form name="editHoliday" method="post" action="AdmHolidays.php">					
							<div class="modal-body">
								<input type="hidden" name="scenario" id="scenario" value="edit">
								<input type="hidden" name="HolidayId" id="HolidayId" value="<?php echo $Holiday1_row['HolidayID']?>">
								<div class="row">
									<div class="col-md-3 text-right">
										Holiday Name<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="HolidayName" name="HolidayName" placeholder="Holiday Name" class="input" data-toggle="tooltip" data-placement="right" title="Holiday Name" style="width:100%;" value="<?php echo $Holiday1_row['HolidayName']?>">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Start Date<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="StartDate1" name="StartDate1" placeholder="Start Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="Start Date" required style="width:100%;" value="<?php echo date_format($Holiday1_row['FromDate'],"Y-m-d");?>">
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										End Date<i class="fa fa-star text-danger"></i>
									</div>
									<div class="col-md-8">															
										<input type="text" id="EndDate1" name="EndDate1" placeholder="End Date" class="input inputpickertext" data-toggle="tooltip" data-placement="right" title="End Date" style="width:100%;" value="<?php echo date_format($Holiday1_row['ToDate'],"Y-m-d");?>">
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-3 text-right">
										Select Holiday For Instructor
									</div>
									<div class="col-md-8">															
										<select id="IsTeach" name="IsTeach">
											<option value="">Select Holiday For Instructor </option>
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3 text-right">
										Select Annual Holiday
									</div>
									<div class="col-md-8">															
										<select id="IsAnnual" name="IsAnnual">
											<option value="">Select Annual Holiday</option>
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
										<script type="text/javascript">
										for(var i=0;i<document.getElementById('IsAnnual').length;i++)
			                            {
			            					if(document.getElementById('IsAnnual').options[i].value=="<?php echo $Holiday1_row['IsAnnualHoliday'] ?>")
			            					{
			            						document.getElementById('IsAnnual').options[i].selected=true
			            					}
			                            }		
										</script>
									</div>
								</div>															
						    </div>	
					 	    <div class="modal-footer">				 	    	
					 	    	<button type="submit" class="btn btn-default" id="EditHoliday">Update</button>
						    </div>			  
						</form>
				  	</div>
				</div>
			</div>
			
			<?php $jk++; } */?>

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
			    $('#Holidays').DataTable( {
			    } );
			} );
			$(function () {
			    $("#datepicker").datepicker({ 
			        autoclose: true, 
			        todayHighlight: true
			    }).datepicker('update', new Date());;

			    /*$("#StartDate").datepicker({ 
			        autoclose: true, 
			        todayHighlight: true
			    }).datepicker('', new Date());;

			    $("#EndDate").datepicker({ 
			        autoclose: true, 
			        todayHighlight: true
			    }).datepicker('', new Date());;

			    $("#StartDate1").datepicker({ 
			        autoclose: true, 
			        todayHighlight: true
			    }).datepicker('', new Date());;

			    $("#EndDate1").datepicker({ 
			        autoclose: true, 
			        todayHighlight: true
			    }).datepicker('', new Date());;*/

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
	    $('#Holidays_wrapper').fadeToggle("slow","linear");
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
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

		var checkin = $('#StartDate').datepicker({
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
	</body>
</html>
