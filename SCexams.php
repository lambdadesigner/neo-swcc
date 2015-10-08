<?php
include('includes/header.php');
$EmpID = $_SESSION['EmpID'];

$sql= "select * from SCExamScores";
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
						<?php echo $lang["Exams"];?>
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="dashboard"><i class="fa fa-dashboard text-red"></i> <?php echo $lang["Home"];?></a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i><?php echo $lang["examinations"];?></a></li>
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
										
									</div>
									
									<table class="table table-striped" id="scexams1">
										<thead>
											<tr class="filters">
												<th> <?php echo $lang["ID"];?></th>
												<th><?php echo $lang["StudentID"];?></th>
												<th><?php echo $lang["Max Score"];?></th>
												<th><?php echo $lang["Score"];?></th>
												<!--<th>Course ID </th>-->
												<th><?php echo $lang["Exam Date"];?></th>
												
											</tr>
										</thead>
										<tbody>
										<?php while($row = sqlsrv_fetch_array($result)){
																	
										?>
											<tr>
												<td><?php echo $row['ExamID']?></td>
												<td><?php echo $row['StudentID']?></td>
												
												
												<td><?php echo $row['MaxScore']?></td>
												<td><?php echo $row['Score']?></td>
											
												<!--<td><?php //echo $row['CourseID']?></td>-->
												
												<td><?php echo $row['ExamDate'];?></td>
											</tr>
										<?php }?>
											
											
										</tbody>
									</table>
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

			<!-- Control Sidebar -->
			
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<!-- jQuery 2.1.4 -->
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
		<!-- Bootstrap 3.3.2 JS -->
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<!-- Swcc App -->
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>
		<!-- Swcc for demo purposes -->
		
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

			
		</script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
		<script>
		$(document).ready(function() {
			    $('#scexams1').DataTable( {
			    } );
			} );
		</script>
	</body>
</html>
