<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location:index"); 
}
$ItdModules_sql = "SELECT * FROM ITD_Modules";
$ItdModules_result = sqlsrv_query( $conn, $ItdModules_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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
						ITD Modules
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
											<button type="button" class="btn btn-primary" id="justs">
		  										<span id="addd">Add</span><span id="vie" style="display:none">View</span> Module
											</button>											
										</div>
										<div id="myElem" class="alert alert-success" role="alert" style="display:none;" align="center">Modules Category</div>	
									</div>									
									<table class="table table-striped" id="ItdModules">
										<thead>
											<!-- <tr class="filters" style="display:none">
												<th><input type="text" class="form-control" placeholder="Auditorium Number" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booking Date" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booked By" disabled></th>
												<th><input type="text" class="form-control" placeholder="Start Time" disabled></th>
												<th><input type="text" class="form-control" placeholder="End Time" disabled></th>
												
											</tr> -->
											<tr class="filters1" style="background-color:#3C8DBC;">
												<th>S.No</th>
												<th>Module ID</th>
												<th>Module Name</th>
												<th>Module Code</th>
												<th>Module Weight</th>
												<th>Module CreditHours</th>
												<th>Is Orientation</th>
												<th>Is OpenDay</th>
											</tr>
										</thead>
										<tbody>
											<?php $jk=1; while($ItdModules_row = sqlsrv_fetch_array($ItdModules_result)){ ?>
												<tr>
													<td><?php echo $jk;?></td>
													<td><?php echo $ItdModules_row['ModuleID']?></td>
													<td><?php echo $ItdModules_row['ModuleName']?></td>
													<td><?php echo $ItdModules_row['ModuleCode']; ?></td>
													<td><?php echo $ItdModules_row['ModuleWeight']; ?></td>
													<td><?php echo $ItdModules_row['ModuleCreditHours']; ?></td>													
													<td><?php echo $ItdModules_row['IsOrientation']; ?></td>
													<td><?php echo $ItdModules_row['IsOpenDay']; ?></td>
												</tr>
											<?php $jk++; }?>																						
										</tbody>
									</table>

									<div class="panel-body">
										<form name="moduleCategory" method="post" action="AdmModulesSection.php">
											<!-- Modal -->
											<div class="modals" id="myModalss" style="display:none;"><br>
											  <!-- <div class="modal-dialog" role="document"> -->
											    <div class="modal-content">
											      <div class="modal-header">									        
											        <h3 class="modal-title" id="myModalLabel">ITD Modules</h3>
											      </div>
											      <input type="hidden" id="ModuleType" name="ModuleType" value="ItdModules">
												  <span style="color:red">* </span>
												  <input type="text" id="ModuleId" name="ModuleId" required="required" class="form-control" placeholder="Module Id" >					
												  <span style="color:red">* </span>
												  <input type="text" id="ModuleName" name="ModuleName" required="required" class="form-control" placeholder="Module Name" >				  
												  <input type="text" id="ModuleCode" name="ModuleCode" class="form-control" placeholder="Module Code" >
												  <span style="color:red">* </span>
												  <input type="text" id="ModuleWeight" name="ModuleWeight" required="required" class="form-control" placeholder="Module Weight" >
												  <span style="color:red">* </span>
												  <input type="text" id="ModuleCreditHours" name="ModuleCreditHours" required="required" class="form-control" placeholder="Module Credit Hours" >
												  <select id="IsOrientation" name="IsOrientation" >
												  	<option value="">Select Orientation</option>
												  	<option value="1">Yes</option>
												  	<option value="0">No</option>
												  </select><br>
												  <select id="IsOpenDay" name="IsOpenDay" >
												  	<option value="">Select Open</option>
												  	<option value="1">Yes</option>
												  	<option value="0">No</option>
												  </select>
												  
											      <div class="modal-footer">
											        <button type="submit" class="btn btn-primary"  data-dismiss="modal" id="AddCategory">Submit</button>
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
			    $('#ItdModules').DataTable( {
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
	    $('#ItdModules_wrapper').fadeToggle("slow","linear");
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
