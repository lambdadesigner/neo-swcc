<?php
include('includes/header.php');
$InstructorID = $_SESSION['InstructorID'];

if($_SESSION['InstructorID']==''){	
	 header("Location: ../index"); 
}
$sql = "SELECT * FROM AuditoriumBookingStatus";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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
			<link rel="stylesheet" type="text/css" href="../assets/dist/css/bootstrap-clockpicker.min.css">
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
									<div class="panel-heading">
										<!-- <h3 class="panel-title">Users</h3> -->
										<div class="pull-right">
											<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
										</div>
									</div>
									<div id="myElem" class="alert alert-success" role="alert"  style="display:none">Auditorium Booked</div>
									<table class="table table-striped" id="auditorium">
										<thead>
											<tr class="filters" style="display:none">
												<th><input type="text" class="form-control" placeholder="Auditorium Number" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booking Date" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booked By" disabled></th>
												<th><input type="text" class="form-control" placeholder="Start Time" disabled></th>
												<th><input type="text" class="form-control" placeholder="End Time" disabled></th>
												
											</tr>
											<tr class="filters1">
												<th>Auditorium Number</th>
												<th>Booking Date</th>
												<th>Booked By</th>
												<th>Start Time</th>
												<th>End Time</th>
												
											</tr>
										</thead>
										<tbody>
										<?php while($row = sqlsrv_fetch_array($result)){ ?>
											<tr>
												<td><?php echo $row['AuditoriumNum']?></td>
												<td><?php $BookingDate = date_format($row['BookingDate'], 'Y-m-d'); echo $BookingDate; ?></td>
											
												<td><?php echo $row['BookedBy']?></td>
												<td><?php $StartTime = date_format($row['StartTime'], 'H:i:s'); echo $StartTime; ?></td>
												<td><?php $EndTime = date_format($row['EndTime'], 'H:i:s'); echo $EndTime; ?></td>
											</tr>
										<?php }?>
											
											
										</tbody>
									</table>
									<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  										Auditorium Booking
									</button>
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
											    <input class="form-control" type="text" id="BookingDate"  />
											    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
									      </div>
										  <input type="text" id="BookedBy" name="BookedBy" value="" required="required" class="form-control" placeholder="Booked By" >
										  <input class="form-control" id="single-input1" value="" placeholder="Start Time" name="StartTime">
										  <input class="form-control" id="single-input2" value="" placeholder="End Time" name="EndTime">
									      <div class="modal-footer">
									        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
									        <button type="button" class="btn btn-primary"  data-dismiss="modal" id="BookAuditorium">Book Auditorium</button>
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
				<strong>Copyright &copy; 2014-2015 <a href="#SWCC"></a>.</strong> All rights reserved.
			</footer>

			
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<!-- jQuery 2.1.4 -->
		<script src="../plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Swcc App -->
		<script src="../dist/js/app.min.js" type="text/javascript"></script>
		<!-- Swcc for demo purposes -->
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		<!-- Page level javascript -->
		<script type="text/javascript" src="../assets/dist/js/bootstrap-clockpicker.min.js"></script>

		



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

</script>

<script type="text/javascript" src="../assets/dist/js/bootstrap-clockpicker.min.js"></script>
			
		<script src="../assets/dist/js/datepicker.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
					$('#BookAuditorium').click(function(){
						
					
						var AuditoriumNum = $('#AuditoriumNum').val();
						var BookingDate   = $('#BookingDate').val();
						var BookedBy      = $('#BookedBy').val();
						var singleinput1 = $('#single-input1').val();
						var singleinput2 = $('#single-input2').val();
						
						$.ajax({
						   type: "GET",
						   url: "../instructors/auditoriumbooking.php",
						   data: {"AuditoriumNum": AuditoriumNum, "BookingDate": BookingDate, "BookedBy": BookedBy, "singleinput1": singleinput1,"singleinput2": singleinput2},
						   success: function(msg){
							// alert( "Data Saved: " + msg ); //Anything you want
							$("#myElem").show();
							setTimeout(function() { $("#myElem").hide(); }, 5000);
						   }
						 });
					
					});	
						
				});


		</script>
	
	</body>
</html>
<?php 
	include("../includes/footer.php")
?>
