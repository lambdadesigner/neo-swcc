<?php
include('../includes/INSheader.php');
$InstructorID = $_SESSION['InstructorID'];
if($_SESSION['InstructorID']==''){	
	 header("Location: ../index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql = "SELECT * FROM ITD_Programs";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
?>
		<link rel="stylesheet" type="text/css" href="../assets/dist/css/bootstrap-clockpicker.min.css">
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

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						All Programs
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
									<table class="table table-striped" id="allprogarm">
										<thead>
											
											<tr class="filters1">
												<th>ID</th>
												<th>Program Name</th>
												<th>Parent Program</th>
												<th>Hours</th>
												<th>Breaks</th>
												<th>Minutes</th>
												<th>Start Date</th>
												<th>End Date</th>
												<th>Duration</th>
												<th>Weekdays</th>
												<th>Is Published</th>
												
											</tr>
										</thead>
										<tbody>
										<?php 
										$sql = "SELECT * FROM ITD_Programs where ProgramID !=0";
										$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
										while($row = sqlsrv_fetch_array($result)){ ?>
											<tr>
										  <td><a href="#fakelink"><?php echo $row['ProgramID']?></a></td>
										  <td><span class="text-warning"><?php echo $row['ProgramName']?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ParentProgram']?></span>
										  <td><span class="text-default"><?php echo $row['HourPerDay']?></span></td>
										  <td><span href="#fakelink"><?php echo $row['NumberOfBreaks']?></span></td>
										  <td><span class="text-danger"><?php echo $row['BreakDuration']?>Mins</span></td>
										  <td><span class="text-info"> <?php  $startDate = date_format($row['StartDate'], 'Y-m-d'); echo $startDate;?> </span></td>
										  <td><span class="text-danger"><?php  $endDate = date_format($row['EndDate'], 'Y-m-d'); echo $endDate;?></span></td>
										  <td><span class="text-disabled"><?php echo $row['ClassDuration']?></span>
										  <td><?php if($row['OffDay_Sun']==1){ echo '<span class="text-success">S,</span>';}else { echo '<span class="text-danger">S,</span>';} ?>
											  <?php if($row['OffDay_Mon']==1){ echo '<span class="text-success">M,</span>';}else { echo '<span class="text-danger">M,</span>';} ?>
											  <?php if($row['OffDay_Tue']==1){ echo '<span class="text-success">T,</span>';}else { echo '<span class="text-danger">T,</span>';} ?>
											  <?php if($row['OffDay_Wed']==1){ echo '<span class="text-success">W,</span>';}else { echo '<span class="text-danger">W,</span>';} ?>
											  <?php if($row['OffDay_Thu']==1){ echo '<span class="text-success">Th,</span>';}else { echo '<span class="text-danger">Th,</span>';} ?>
											  <?php if($row['OffDay_Fri']==1){ echo '<span class="text-success">F,</span>';}else { echo '<span class="text-danger">F,</span>';} ?>
											  <?php if($row['OffDay_Sat']==1){ echo '<span class="text-success">S</span>';}else { echo '<span class="text-danger">S</span>';} ?>
										  </td>
										  <td><span href="#fakelink"><?php  if($row['IsPublished'] == 0){ echo 'Not Published';}else{ echo 'Published'; }?></span></td>
										</tr>
										<?php }?>
											
											
										</tbody>
									</table>
									<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  										Add Programs
									</button>
									<!--- Add All Programs-->
									
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									  <div class="modal-dialog" role="document">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="myModalLabel">Add Program</h4>
									      </div>
										  <!-- <input type="text" id="ProgramID" name="ProgramID" value="" required="required" class="form-control" placeholder="Program ID" > -->
										  <input type="text" id="ProgramName" name="ProgramName" value="" required="required" class="form-control" placeholder="Program Name" >
										  <input type="number" id="ParentProgram" name="ParentProgram" value="" required="required" class="form-control" placeholder="Parent Program ie.Ex.1,2,3...">
										  <input type="text" id="HourPerDay" name="HourPerDay" value="" required="required" class="form-control" placeholder="Hour Per Day" >
										  <input type="text" id="NumberOfBreaks" name="NumberOfBreaks" value="" required="required" class="form-control" placeholder="Number Of Breaks" >
										  <input type="text" id="BreakDuration" name="BreakDuration" value="" required="required" class="form-control" placeholder="Break Duration" >
									      <div class="modal-body">
									        <div id="datepicker1" class="input-group date" data-date-format="yyyy-mm-dd">
											    <input class="form-control" type="text" id="StartDate"  />
											    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
									      </div>
										  
										  <div class="modal-body">
									        <div id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd">
											    <input class="form-control" type="text" id="EndDate"  />
											    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											</div>
									      </div>
										  
										  <input class="form-control" id="single-input1" value="" placeholder="Class Start Time" name="ClassStartTime">
										  
										  <input type="text" id="ClassDuration" name="ClassDuration" value="" required="required" class="form-control" placeholder="Class Duration" >
										  <input type="checkbox" id="OffDay_sun" name="OffDay_Sun" value=""> Sun
										  <input type="checkbox" id="OffDay_Mon" name="OffDay_Mon" value=""> Mon
										  <input type="checkbox" id="OffDay_Tue" name="OffDay_Tue"  value=""> Tue
										  <input type="checkbox" id="OffDay_Wed" name="OffDay_Wed" value=""> Wed
										  <input type="checkbox" id="OffDay_Thu" name="OffDay_Thu" value=""> Thu
										  <input type="checkbox" id="OffDay_Fri" name="OffDay_Fri" value=""> Fri
										  <input type="checkbox" id="OffDay_Sat" name="OffDay_Sat" value=""> Sat<br>
										  <input type="radio" name="IsPublished" value="1"> Published
										  <input type="radio" name="IsPublished" value="0" checked>Not Published
									      <div class="modal-footer">
									        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
									        <button type="button" class="btn btn-primary"  data-dismiss="modal" id="AddProgram">Add Program</button>
									      </div>
									    </div>
									  </div>
									</div>
									
									<!---END Add All Programs --->
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
			    $('#allprogarm').DataTable( {
			    } );
			} );
			
			
			$(function () {
				  $("#datepicker1").datepicker({ 
				        autoclose: true, 
				        todayHighlight: true
				  }).datepicker('update', new Date());;
				});
			
			$(function () {
				  $("#datepicker2").datepicker({ 
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
					
		
		</script>
		
		<script type="text/javascript">
			$(document).ready(function(){
					$('#AddProgram').click(function(){
						
						var ProgramID	   = $('#ProgramID').val();
						var ProgramName    = $('#ProgramName').val();
						var ParentProgram  = $('#ParentProgram').val();
						var HourPerDay     = $('#HourPerDay').val();
						var NumberOfBreaks = $('#NumberOfBreaks').val();
						var BreakDuration  = $('#BreakDuration').val();
						var StartDate      = $('#StartDate').val();
						var EndDate        = $('#EndDate').val();
						var ClassStartTime = $('#single-input1').val();
						var ClassDuration  = $('#ClassDuration').val();
						
						var sun = ($('#OffDay_sun').is(":checked"));
						
							if(sun == true){
								
						var OffDay_sun = 1;		
							}else{
								var OffDay_sun = 0;		
							}
						
						var Mon = ($('#OffDay_Mon').is(":checked"));
						
							if(Mon == true){
								
						var OffDay_Mon = 1;		
							}else{
								var OffDay_Mon = 0;		
							}
							
							var Tue = ($('#OffDay_Tue').is(":checked"));
						
							if(Tue == true){
								
						var OffDay_Tue = 1;		
							}else{
								var OffDay_Tue = 0;		
							}
						
						var Wed = ($('#OffDay_Wed').is(":checked"));
						
							if(Wed == true){
								
						var OffDay_Wed = 1;		
							}else{
								var OffDay_Wed = 0;		
							}
						var Thu = ($('#OffDay_Thu').is(":checked"));
						
							if(Thu == true){
								
						var OffDay_Thu = 1;		
							}else{
								var OffDay_Thu = 0;		
							}
						var Fri = ($('#OffDay_Fri').is(":checked"));
						
							if(Fri == true){
								
						var OffDay_Fri = 1;		
							}else{
								var OffDay_Fri = 0;		
							}
						var Sat = ($('#OffDay_Sat').is(":checked"));
						
							if(Sat == true){
								
						var OffDay_Sat = 1;		
							}else{
								var OffDay_Sat = 0;		
							}
						
						
						
						var IsPublished = $('input:radio[name=IsPublished]:checked').val();
						
			
						
						$.ajax({
						   type: "GET",
						   url: "../instructors/addprogram.php",
						   data: {"ProgramID": ProgramID,
								  "ProgramName": ProgramName,
								  "ParentProgram": ParentProgram, 
								  "HourPerDay": HourPerDay,
								  "NumberOfBreaks": NumberOfBreaks,
								  "BreakDuration": BreakDuration,
								  "StartDate": StartDate, 
								  "EndDate": EndDate,
								  "ClassStartTime": ClassStartTime,
								  "ClassDuration": ClassDuration,
								  "OffDay_sun": OffDay_sun, 
								  "OffDay_Mon": OffDay_Mon,
								  "OffDay_Tue": OffDay_Tue,
								  "OffDay_Wed": OffDay_Wed,
								  "OffDay_Thu": OffDay_Thu, 
								  "OffDay_Fri": OffDay_Fri,
								  "OffDay_Sat": OffDay_Sat,
								  "IsPublished": IsPublished
								  							  
								  },
						   success: function(msg){
							 alert( "Data Saved: " + msg ); //Anything you want
						   }
						 });
					
					});	
						
				});


		</script>
		
		<script type="text/javascript" src="../assets/dist/js/bootstrap-clockpicker.min.js"></script>
			
		<script src="../assets/dist/js/datepicker.js"></script>
		
	</body>
</html>
