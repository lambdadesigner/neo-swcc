<?php
include('includes/header.php');
$StudentID = $_SESSION['StudentID'];
$sql = "SELECT Distinct (Module.ModuleName),Tests.TestID,Tests.TestName,Tests.TestType,Tests.TestWeight,Tests.MaxMarks FROM Tests INNER JOIN Module ON Module.ModuleID=Tests.ModuleID";
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

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Examinations
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
										<!-- <h3 class="panel-title text-red"><i class="fa fa-pencil fa-lg"></i> Examinations
											<div class="pull-right">
												<button class="btn btn-xs btn-filter"><span class="glyphicon glyphicon-filter filterbutton"></span> Filter</button>
											</div>
										</h3>
										<hr> -->
									</div>
									<div class="panel-body">
										<table class="table table-striped" id="examinations">
											<thead>
												<tr class="filters" style="display:none;">
													<th><input type="text" class="form-control" placeholder="Module Name" disabled></th>
													<th><input type="text" class="form-control" placeholder="Test Id" disabled></th>
													<th><input type="text" class="form-control" placeholder="Test Name" disabled></th>
													<th><input type="text" class="form-control" placeholder="Test Type" disabled></th>
													<th><input type="text" class="form-control" placeholder="Test Weight" disabled></th>
													<th><input type="text" class="form-control" placeholder="Max Marks" disabled></th>												
												</tr>
												<tr class="filters1">
													<th><span>Module Name</span></th>
													<th><span>Test Id</span></th>
													<th><span>Test Name</span></th>
													<th><span>Test Type</span></th>
													<th><span>Test Weight</span></th>
													<th><span>Max Marks</span></th>												
												</tr>
											</thead>
											<tbody>
											<?php while($row = sqlsrv_fetch_array($result)){ ?>
												<tr>
													<td><?php echo $row['ModuleName']?></td>
													<td><?php echo $row['TestID']?></td>
													<td><?php echo $row['TestName']?></td>
													<td><?php echo $row['TestType']?></td>
													<td><?php echo $row['TestWeight']?></td>
													<td><?php echo $row['MaxMarks']?></td>
													
												</tr>
											<?php }?>
												
												
											</tbody>
										</table>
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
		<!-- Bootstrap 3.3.2 JS -->
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Swcc App -->
		<script src="dist/js/app.min.js" type="text/javascript"></script>
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
			    $('#examinations').DataTable( {
			    } );
			} );
			
		</script>
<?php
include('includes/footer.php');
?>
