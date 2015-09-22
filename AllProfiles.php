<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];
if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql = "SELECT * FROM StudentInfo";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

$Instsql = "SELECT * FROM Instructors";
$Instresult = sqlsrv_query( $conn, $Instsql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
?>
			

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Student / Instructor Profiles
						<!-- <small></small> -->
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
							<div class="">
								<div class="panel">
									<div class="panel-heading">
										<!-- <h3 class="panel-title">Users</h3> -->
										<div class="pull-right">
											<!-- <button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button> -->
										</div>
									</div>
	                                <div class="">
                                		<div class="card">
		                                    <ul class="nav nav-tabs" role="tablist">
		                                        <li role="presentation" class="active"><a href="#RStudent" aria-controls="home" role="tab" data-toggle="tab">Student</a></li>
		                                        <li role="presentation"><a href="#PInstructor" aria-controls="profile" role="tab" data-toggle="tab">Instructor</a></li>			                                        
		                                    </ul>
		                                    <!-- Tab panes -->
		                                    <div class="tab-content">
		                                        <div role="tabpanel" class="tab-pane active" id="RStudent">
		                                        	<table class="table table-striped" id="marks">
														<thead>
															<tr class="filters" style="display:none;">
																<th><input type="text" class="form-control" placeholder="Student ID" disabled></th>
																<th><input type="text" class="form-control" placeholder="Student Name" disabled></th>
																<th><input type="text" class="form-control" placeholder="Student Group" disabled></th>
																<th><input type="text" class="form-control" placeholder="National Id" disabled></th>
																<th><input type="text" class="form-control" placeholder="Birth Place" disabled></th>
																<th><input type="text" class="form-control" placeholder="DOB" disabled></th>
																<th><input type="text" class="form-control" placeholder="Mobile" disabled></th>
															</tr>
															<tr>																
																<th>S.No</th>
																<th>Student ID</th>
																<th>Student Name</th>
																<th>Student Group</th>
																<th>National Id</th>
																<th>Birth Place</th>
																<th>DOB</th>
																<th>Mobile</th>
															</tr>
														</thead>
														<tbody>
														<?php $ii =1;while($row = sqlsrv_fetch_array($result)){ ?>
															<tr>
																<td><?php echo $ii;?></td>
																<td><?php echo $row['StudentID']?></td>
																<td><?php echo $row['StudentName_en']?></td>
																<td><?php echo $row['StudentGroup']?></td>
																<td><?php echo $row['NationalID']?></td>
																<td><?php echo $row['BirthPlace']?></td>
																<td><?php echo $row['DoB']?></td>
																<td><?php echo $row['Mobile']?></td>
															</tr>
														<?php $ii++; }?>
														</tbody>
													</table>
		                                        </div>

		                                        <div role="tabpanel" class="tab-pane" id="PInstructor">
		                                        	<table class="table table-striped" id="marks1">
														<thead>
															<tr class="filters" style="display:none;">
																<th><input type="text" class="form-control" placeholder="Instructor ID" disabled></th>
																<th><input type="text" class="form-control" placeholder="Instructor Name" disabled></th>
																<th><input type="text" class="form-control" placeholder="Employee Id" disabled></th>
																<th><input type="text" class="form-control" placeholder="Form Id" disabled></th>
																<th><input type="text" class="form-control" placeholder="Process" disabled></th>													
															</tr>
															<tr>
																<th>S.No</th>
																<th>Instructor ID</th>
																<th>Instructor Name</th>
																<th>Employee Id</th>
																<th>Form Id</th>
																<th>Process</th>
															</tr>
														</thead>
														<tbody>
															<?php $ij =1; while($Inst_row = sqlsrv_fetch_array($Instresult)){ ?>
																<tr>
																	<td><?php echo $ij;?></td>
																	<td><?php echo $Inst_row['InstructorID']?></td>
																	<td><?php echo $Inst_row['InstructorName']?></td>
																	<td><?php echo $Inst_row['EmployeeID']?></td>
																	<td><?php echo $Inst_row['FormID']?></td>
																	<td><?php echo $Inst_row['processID']?></td>
																</tr>
															<?php $ij++; }?>
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
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

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
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="dist/js/app.min.js" type="text/javascript"></script>-->
		<!-- Swcc for demo purposes -->
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
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
			    $('#marks').DataTable( {
			    } );
			    $('#marks1').DataTable( {
			    } );
			} );
		</script>
<?php
	include('Admin_files/includes/footer.php');
?>
