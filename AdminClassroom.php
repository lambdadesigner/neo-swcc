<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];
if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql = "SELECT * FROM ClassroomBookingStatus";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

if($_GET['action']=="delete")
{	
	echo $delsql = "DELETE FROM ClassroomBookingStatus WHERE ClassNum='".$_GET['Classid']."' AND BookedDate='".$_GET['date']."'"; //exit;
	$delsql_result = sqlsrv_query( $conn, $delsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminClassroom');
}

if($_POST['scenario']=="editAdmClassroom")
{
	echo $updatesql = "UPDATE ClassroomBookingStatus SET ClassNum='".$_POST['AuditoriumNum']."',BookedDate='".$_POST['BookingDate']."',BookedBy='".$_POST['BookedBy']."',Occupancy='".$_POST['Occupancy']."',OccString='".$_POST['OccString']."' WHERE ClassNum='".$_GET['ModId']."' AND BookedDate='".$_GET['date']."'"; //exit;
	$updatesql_result = sqlsrv_query( $conn, $updatesql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	header('location:AdminClassroom');
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
			  background: #F7F5D9;			  
			}
			.dataTable tbody tr td{
			  padding: 10px;
			}
			.border table {
				border: 1px solid #ccc;
				margin-bottom: 20px;
			} 
			table{
				border:1px solid #F7F5D9 !important;
			}
			.dataTable tr td{
			  border: 1px solid #f9f9f9;
			}
			</style>
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
						<li><a href="Admin"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-leaf"></i> Class Room </a></li>
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

										<script type="text/javascript">
										$(document).ready(function() {
											$('#classroom').DataTable( {
											} );
										});
										</script>
										<div class="panel-heading">
											<!-- <h3 class="panel-title">Users</h3> -->
											<div class="pull-right">
												<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
										  		<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Class Room Booking</button>
											</div><br><br>
										</div>

										<div class="tab-content panel-body" id="auditoriumRows">	
											<table class="table" id="classroom">
												<thead>
													<tr class="filters">
														<th>S.No</th>
														<th><input type="text" class="form-control" placeholder="Class Num" ></th>
														<th><input type="text" class="form-control" placeholder="Booked Date" ></th>
														<th><input type="text" class="form-control" placeholder="Booked By" ></th>
														<th><input type="text" class="form-control" placeholder="Occupancy" ></th>
														<th><input type="text" class="form-control" placeholder="OccString" ></th>	
														<th>Edit</th>
														<th>Delete</th>											
													</tr>

													<!-- <tr class="filters1" style="background-color:#1CAF9A;display:none;">
														<th>S.No</th>
														<th>Class Num</th>
														<th>Booked Date</th>
														<th>Booked By</th>
														<th>Occupancy</th>
														<th>OccString</th>												
													</tr> -->
												</thead>
												<tbody>
												<?php $jk=1;while($row = sqlsrv_fetch_array($result)){ ?>
													<tr>
														<td><?php echo $jk;?></td>
														<td><?php echo $row['ClassNum']?></td>
														<td><?php $startDate = date_format($row['BookedDate'], 'Y-m-d'); echo $startDate; ?></td>													
														<td><?php echo $row['BookedBy']?></td>
														<td><?php echo $row['Occupancy']?></td>
														<td><?php echo $row['OccString']?></td>
														<td><a href="AdminClassroom?action=Edit&ModId=<?php echo $row['ClassNum'];?>&date=<?php echo date_format($row['BookedDate'],"Y-m-d");?>" style="cursor:pointer"><i class="fa fa-edit fa-lg" data-toggle="tooltip" data-placement="top" title="Click to edit"></i></a></td>
															
														<td><a onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'AdminClassroom?action=delete&Classid=<?php echo $row['ClassNum'];?>&date=<?php echo date_format($row['BookedDate'],"Y-m-d");?>'; return false;}" style="cursor:pointer"><i class="fa fa-close text-danger" data-toggle="tooltip" data-placement="top" title="Click to delete"></i></a> </td>
													</tr>
												<?php $jk++;}?>												
												</tbody>
											</table>
										</div>
									<?php } ?>
									<!-- End Showing Classrooms -->

									<!-- Edit Classrooms -->
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
																$editClassql = "SELECT * from ClassroomBookingStatus WHERE ClassNum='".$_GET['ModId']."' AND BookedDate='".$_GET['date']."'";
																$editClasresult = sqlsrv_query( $conn, $editClassql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																$EditClas_row = sqlsrv_fetch_array($editClasresult);?>
															<div class="modals" id="mySchedules">
															  	<form name="editAuditorium" method="post">
																    <div class="modal-content col-md-6 col-md-offset-3">
																      	<div class="modal-header">									        
																        	<h3 class="modal-title" id="myModalLabel"><i class="fa fa-pencil fa-lg"></i> Edit Class Room</h3>
																      	</div>
																      	<br>
																      	<input type="hidden" name="scenario" id="scenario" value="editAdmClassroom">										      	
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Classroom No.<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">															
																				<input type="text" id="AuditoriumNum" name="AuditoriumNum" required="required" class="form-control" placeholder="Auditorium Number" value="<?php echo $EditClas_row['ClassNum']?>" >
																			</div>
																		</div><br>
																      	<div class="row">
																			<div class="col-md-3 text-right">
																				Booking Date<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">			
																				<input class="form-control inputpickertext" type="text" id="BookingDate" name="BookingDate" placeholder="Booked Date" value="<?php echo date_format($EditClas_row['BookedDate'],"Y-m-d");?>"/>
																			</div>
																		</div><br>																		
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Booked By<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">
																				  <input class="form-control" id="single-input2" placeholder="Booked By" name="BookedBy" value="<?php echo $EditClas_row['BookedBy'];?>">			
																			</div>
																		</div><br>																		
																		<div class="row">
																			<div class="col-md-3 text-right">
																				Occupancy<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">
																				  <input class="form-control" id="single-input2" placeholder="Booked By" name="Occupancy" value="<?php echo $EditClas_row['Occupancy'];?>">			
																			</div>
																		</div><br>																		
																		<div class="row">
																			<div class="col-md-3 text-right">
																				OccString<i class="fa fa-star text-danger"></i>
																			</div>
																			<div class="col-md-8">
																				  <input class="form-control" id="single-input2" placeholder="Booked By" name="OccString" value="<?php echo $EditClas_row['OccString'];?>">			
																			</div>
																		</div>
																		<br><br>
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



									<!-- POPUP -->
									<div class="container">
									 
									  <!-- Trigger the modal with a button -->
									  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Class Room Booking</button> -->

									  <!-- Modal -->
									  <div class="modal fade" id="myModal" role="dialog">
										<div class="modal-dialog">
										 <div class="modal-header">
											  <button type="button" class="close" data-dismiss="modal">&times;</button>
											  <h4 class="modal-title">Class Room Booking</h4>
											</div>
										  <!-- Modal content-->
										  <div class="modal-content">
										   
											<form name="classbooking" method="POST">
												<div class="modal-body">
													<div class="col-md-12 classroombooking">
														<div class="row">
															<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
															    <input class="form-control inputpickertext" type="text" name="BookDate" id="BookDate" required="required"/>
															    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
															</div>
															<br>
															<div class="styled-select">
																<select name="classroom col-md-6 col-sm-6" id="classroom" required="required" style="width:100%;">
																	<option value="">Select Class Room</option>
																	<?php
																		$sql_classroom = "SELECT DISTINCT ClassNum FROM ClassroomBookingStatus";
																		$result_sql_classroom = sqlsrv_query( $conn, $sql_classroom ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																		while($row = sqlsrv_fetch_array($result_sql_classroom) ){?>
																		<option value="<?php echo $row['ClassNum']; ?>"><?php echo $row['ClassNum']; ?></option>
																	<?php }?>
																</select>
															</div><br>
															<div class="">
																<input maxlength="100" type="text" id="bookedby" required name="bookedby" class="form-control" placeholder="Booked By" required="required"/>													
															</div>
															<div class="">

																<input maxlength="100" type="text" id="OccString" required="required" name="OccString" class="form-control" placeholder="Occ String" required="required"/>
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
						
		</script>
		<script>
			
			$(function () {
				  $("#BookingDate").datepicker({ 
				        autoclose: true, 
				        todayHighlight: true,
				        format:'yyyy-mm-dd'
				  }).datepicker('', new Date());;

				  $("#BookDate").datepicker({ 
				        autoclose: true, 
				        todayHighlight: true,
				        format:'yyyy-mm-dd'
				  }).datepicker('', new Date());;
				});
				
		$(document).ready(function(){
			$('#classroomsave').click(function(){
				//var classroom = $('#classroom').val();
			
				 
				var BookDate = $('#BookDate').val();
				if(BookDate ==""){
					alert("Please enter date");
					BookDate.focus();
					}
				var classroom = $('select#classroom option:selected').val();
				 
				 if(classroom == ""){
					 alert("Please Select Classroom");
					 classroom.focus();
					 }
				var bookedby = $('#bookedby').val();
					if(bookedby==""){
						alert('please enter bookedby');
						bookedby.focus();
						}
				var OccString = $('#OccString').val();
				if(OccString==""){
						alert('please enter OccString');
						OccString.focus();
						}
				
				$.ajax({
				   type: "GET",
				   url: "instructors/classroombooking.php",
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