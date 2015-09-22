<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];
if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql = "SELECT * FROM ClassroomBookingStatus";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
?>
				<!-- Page Level CSS -->
			<link rel="stylesheet" type="text/css" href="instructors/css/classbooking.css">
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Class Room Booking Status
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
									<div class="panel-heading">
										<!-- <h3 class="panel-title">Users</h3> -->
										<div class="pull-right">
											<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
										</div>
									</div>
									<table class="table table-striped" id="classroom">
										<thead>
											<tr class="filters" style="display:none">
												<th><input type="text" class="form-control" placeholder="Class Num" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booked Date" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booked By" disabled></th>
												<th><input type="text" class="form-control" placeholder="Occupancy" disabled></th>
												<th><input type="text" class="form-control" placeholder="OccString" disabled></th>
												
											</tr>

											<tr class="filters1" >
												<th>S.No</th>
												<th>Class Num</th>
												<th>Booked Date</th>
												<th>Booked By</th>
												<th>Occupancy</th>
												<th>OccString</th>												
											</tr>
										</thead>
										<tbody>
										<?php $jk=1;while($row = sqlsrv_fetch_array($result)){ ?>
											<tr>
												<th><?php echo $jk;?></th>
												<td><?php echo $row['ClassNum']?></td>
												<td><?php $startDate = date_format($row['BookedDate'], 'Y-m-d'); echo $startDate; ?></td>
												
												<td><?php echo $row['BookedBy']?></td>
												<td><?php echo $row['Occupancy']?></td>
												<td><?php echo $row['OccString']?></td>
											</tr>
										<?php $jk++;}?>
											
											
										</tbody>
									</table>
									<!-- POPUP -->
									<div class="container">
									 
									  <!-- Trigger the modal with a button -->
									  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Class Room Booking</button>

									  <!-- Modal -->
									  <div class="modal fade" id="myModal" role="dialog">
										<div class="modal-dialog">
										 <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal">&times;</button>
											  <h4 class="modal-title">Class Room Booking</h4>
											</div>
										  <!-- Modal content-->
										  <div class="modal-content">
										   
											<form name="classbooking" action="INSSclassbookstatus.php" method="POST">
												<div class="modal-body">
													<div class="col-md-12 classroombooking">
														<div class="row">
															<div class="col-md-7 row">
																<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
																    <input class="form-control inputpickertext" type="text" />
																    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
																</div>
															</div>
															<div class="col-md-5">
																<select name="classroom col-md-6 col-sm-6" id="classroom" style="display:none;">
																	<?php
																		$sql_classroom = "SELECT DISTINCT ClassNum FROM ClassroomBookingStatus";
																		$result_sql_classroom = sqlsrv_query( $conn, $sql_classroom ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																		while($row = sqlsrv_fetch_array($result_sql_classroom) ){?>
																		<option value="<?php echo $row['ClassNum']; ?>"><?php echo $row['ClassNum']; ?></option>
																	<?php }?>
																</select>
															</div><br>
															<div class="">
																<input maxlength="100" type="text" id="bookedby" required name="bookedby" class="form-control" placeholder="Booked By" />													
															</div>
															<div class="">

																<input maxlength="100" type="text" id="OccString" required="required" name="OccString" class="form-control" placeholder="Occ String" />
															</div>
														</div>
													</div>												  
												</div>
												<div class="modal-footer">
											  		<input type="submit" id="classroomsave" class="btn btn-default" name="submit" data-dismiss="modal" value="Save">
												</div>
											</form>
										  </div>
										  
										</div>
									  </div>
									</div>
									<!-- END POPUP -->
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
	
		<!-- Swcc App 
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		<!-- Page level javascript -->
  		<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
		<script src="assets/dist/js/datepicker.js"></script>
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
				$('#classroom').DataTable( {
				} );
			} );



		</script>
		<script>
			
			$(function () {
				  $("#datepicker").datepicker({ 
				        autoclose: true, 
				        todayHighlight: true
				  }).datepicker('update', new Date());;
				});
				
		$(document).ready(function(){
			$('#classroomsave').click(function(){
				//var classroom = $('#classroom').val();
				var classroom = $('select#classroom option:selected').val();
				var BookDate = $('#BookDate').val();
				var bookedby = $('#bookedby').val();
				var OccString = $('#OccString').val();
				
				$.ajax({
				   type: "GET",
				   url: "../instructors/classroombooking.php",
				   data: {"classroom": classroom, "BookDate": BookDate, "bookedby": bookedby, "OccString": OccString},
				   success: function(msg){
					// alert( "Data Saved: " + msg ); //Anything you want
				   }
				 });
			
			});	
				
		});

		$('.inputpickertext').click(function(){
			// alert('dasd')
			$('.datepicker').addClass('inputpicker');
		})
		</script>

<?php 
	include("Admin_files/includes/footer.php")
?>