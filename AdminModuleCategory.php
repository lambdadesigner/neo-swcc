<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location:index"); 
}
$Module_sql = "SELECT * FROM Module_Category ORDER BY MCID DESC";
$Module_result = sqlsrv_query( $conn, $Module_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
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
						Module Categories
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-default"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-default"></i> Profile</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<?php if($_GET['action']=="" && $_GET['MCID']==""){?>
				<section class="content">
					<div class="panel">
						<div class="panel-body border">
							<div class="row">
								<div class="panel filterable">									
									<div class="panel-heading">
										<!-- <h3 class="panel-title">Users</h3> -->
										<?php if($_GET['err']=="success"){?>
											<span style="text-align:center" class="alert alert-success" id="succesd">
												Category Successfully Added....
											</span>
											<script type="text/javascript">
												setTimeout(function() { $("#succesd").fadeOut("slow"); }, 5000);
											</script>
										<?php } ?>
										<div class="pull-right">
											<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
											<button type="button" class="btn btn-default" id="justs">
		  										<span id="addd">Add</span><span id="vie" style="display:none">View</span> Category
											</button>											
										</div>
										<div id="myElem" class="alert alert-success" role="alert" style="display:none;" align="center">Modules Category</div>										
									</div>									
									<table class="table table-striped" id="auditorium">
										<thead>
											<!-- <tr class="filters" style="display:none">
												<th><input type="text" class="form-control" placeholder="Auditorium Number" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booking Date" disabled></th>
												<th><input type="text" class="form-control" placeholder="Booked By" disabled></th>
												<th><input type="text" class="form-control" placeholder="Start Time" disabled></th>
												<th><input type="text" class="form-control" placeholder="End Time" disabled></th>												
											</tr> -->
											<tr class="filters1" style="background-color:#39cccc;">
												<th>S.No</th>
												<th>Category ID</th>
												<th>Category Name</th>
												<th>Hierarchy ID</th>
												<th>Cycle ID</th>
												<th>Stage</th>
												<th></th>										
											</tr>
										</thead>
										<tbody>
											<?php $jk=1; while($Module_row = sqlsrv_fetch_array($Module_result)){ ?>
												<tr>
													<td><?php echo $jk;?></td>
													<td><?php echo $Module_row['MCID']?></td>
													<td><?php echo $Module_row['MCName']?></td>
													<td><?php echo $Module_row['HierarachyID']; ?></td>
												
													<td><?php echo $Module_row['CycleID']?></td>
													<td><?php echo $Module_row['Stage']; ?></td>
													 <td><a href="AdminModuleCategory?action=Edit&MCID=<?php echo $Module_row['MCID'];?>" style="cursor:pointer"> <i class="fa fa-edit"></i></a></td>
												</tr>
											<?php $jk++; }?>																						
										</tbody>
									</table>

									<div class="panel-body col-md-6 col-md-offset-3">
										<form name="moduleCategory" method="post" action="AdmModulesSection.php">
											<!-- Modal -->
											<div class="modals" id="myModalss" style="display:none;"><br>
											  <!-- <div class="modal-dialog" role="document"> -->
											    <div class="modal-content">
											      <div class="modal-header">									        
											        <h3 class="modal-title" id="myModalLabel">Category</h3>
											      </div>
											      <input type="hidden" id="ModuleType" name="ModuleType" value="Category">
												  <span style="color:red">* </span>
												  <input type="text" id="CategoryId" name="CategoryId" value="" required="required" class="form-control" placeholder="Category Id" >
												  <span style="color:red">* </span>
												  <input type="text" id="CategoryName" name="CategoryName" value="" required="required" class="form-control" placeholder="Category Name" >
												  <input type="text" id="HeirarchyId" name="HeirarchyId" class="form-control" placeholder="Hierarchy Id" >
												  <input type="text" id="stage" name="stage" class="form-control" placeholder="Stage" >										  
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
				
				<!-- Edit Schedulesss Start -->
				<?php if($_GET['action']=="Edit" && $_GET['MCID']!=""){
						
						if(isset($_POST['updatemodule'])){
							
								$MCID= $_POST['MCID'];
								$MCName= $_POST['MCName'];
								$HierarachyID= $_POST['HierarachyID'];
								$CycleID= $_POST['CycleID'];
								$Stage= $_POST['Stage'];
								
							$sql="UPDATE Module_Category SET MCID='".$MCID."',MCName='".$MCName."',HierarachyID='".$HierarachyID."',CycleID='".$CycleID."',Stage='".$Stage."'";	
							$Module_result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
						}
					
					
					?>
					<section class="content">
						<div class="panel">
							<div class="panel-body">
								<div class="row">
									<div class="panel filterable">
										<div class="panel-heading">											
											<a href="AdminModuleCategory" class="btn btn-default pull-right">View Module Categories </a>
											<h3 class="panel-title text-default"><i class="fa fa-pencil fa-lg"></i> Edit Module Categories 
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
											$editStudsql = "SELECT * from Module_Category WHERE MCID='".$_GET['MCID']."'";
											$editStudresult = sqlsrv_query( $conn, $editStudsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											$EditStud_row = sqlsrv_fetch_array($editStudresult)?>
										<div class="modals" id="module">
										  	<form name="updatemodule" method="POST" action="">
											    <div class="modal-content col-md-6 col-md-offset-3">
											      	<div class="modal-header">									        
											        	<h3 class="modal-title" id="myModalLabel">Edit ModuleCategory</h3>
											      	</div><br>
											      	<input type="hidden" name="scenario" id="scenario" value="editAdmSchedule">										      	
													<div class="row">
														<div class="col-md-3 text-right">
															MCID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="MCID" name="MCID" placeholder="MCID" class="input" data-toggle="tooltip" data-placement="right" title="MCID" required style="width:100%;" value="<?php echo $EditStud_row['MCID'];?>">
														</div>
													</div>
											      	<div class="row">
														<div class="col-md-3 text-right">
															MCName<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="MCName" name="MCName" placeholder="MCName" class="input" data-toggle="tooltip" data-placement="right" title="MCName" required style="width:100%;" value="<?php echo $EditStud_row['MCName'];?>">
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															HierarachyID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="HierarachyID" name="HierarachyID" placeholder="HierarachyID" class="input" data-toggle="tooltip" data-placement="right" title="HierarachyID" required style="width:100%;" value="<?php echo $EditStud_row['HierarachyID'];?>">
														</div>
													</div>
													
													<div class="row">
														<div class="col-md-3 text-right">
															CycleID<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="CycleID" name="CycleID" placeholder="CycleID" class="input" data-toggle="tooltip" data-placement="right" title="CycleID" required style="width:100%;" value="<?php echo $EditStud_row['CycleID'];?>">
														</div>
													</div>
													<div class="row">
														<div class="col-md-3 text-right">
															Stage<i class="fa fa-star text-danger"></i>
														</div>
														<div class="col-md-8">															
															<input type="text" id="Stage" name="Stage" placeholder="Stage" class="input" data-toggle="tooltip" data-placement="right" title="Stage" required style="width:100%;" value="<?php echo $EditStud_row['Stage'];?>">
														</div>
													</div>
													<br>
													<div class="modal-footer">
														<input type="submit" class="btn btn-default"  data-dismiss="modal" id="updatemodule" name="updatemodule">
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

$( document ).ready(function() {		
	$('#BookingDate').focus(function(){		
	    $('.datepicker-orient-top').css('z-index','10000');
	});
});

$( document ).ready(function() {		
	$('#justs').click(function(){				
	    $('#auditorium_wrapper').fadeToggle("slow","linear");
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
