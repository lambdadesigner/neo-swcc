<?php 
include('Admin_files/includes/header.php');
//print_r($_SESSION);
$AdminID = $_SESSION['AdminId'];
if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
?>
<style type="text/css">
	.BoldText{
		font-weight: bolder;
	}
</style>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Profile
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard text-red"></i> Home</a></li>
						<li><a href="#"><i class="fa fa-user text-red"></i> Profile</a></li>
					</ol>
				</section>
					<?php 
						$querys =	"SELECT * FROM AdminInfo WHERE AdminId='Adm001'";
						$result_users = sqlsrv_query( $conn, $querys ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
											
						while($row = sqlsrv_fetch_array($result_users)){?>
	  
   
				<!-- Main content -->
				<section class="content">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3 col-sm-3">
									<div class="user-wrapper col-md-8 col-md-offset-2">
										<img src="images/profile" class="img-responsive img-circle"> 
										<div class="description user-description text-center">
										   <h4><?php  echo $row['AFullName_en'];?> </h4>
										</div>
									 </div>
								</div>
								<div class="col-md-9">
									<div class="panel panel-info">
										<div class="panel-heading">
											<h3 class="panel-title"><span class="fa fa-user-secret"></span> <span class="fa fa-angle-right"></span> <?php  echo $row['AFullName_en'];?>  Profile</h3>
										</div>
										<div id="no-more-tables panel-body col-md-12">
											<table class="table-bordered table-striped table-condensed cf">
												<thead class="cf">
													<tr>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="BoldText">Student ID</td>
														<td><?php  echo $row['AdminId'];?></td>
													</tr>
													<tr>
														<td class="BoldText">User Name</td>
														<td><?php echo $row['AdminUserName'];?></td>
													</tr>
													<tr>
														<td class="BoldText">First Name <div class="pull-right"><a href="#Eng">Eng</a> / <a href="#Ara">Ara</a></div></td>
														<td><?php  echo $row['AFirstName_en'];?> / <?php  echo $row['AFirstName_ar'];?></td>
													</tr>													
													<tr>
														<td class="BoldText">Last Name <div class="pull-right"><a href="#Eng">Eng</a> / <a href="#Ara">Ara</a></div></td>
														<td><?php  echo $row['ALastName_en'];?> / <?php  echo $row['ALastName_ar'];?></td>
													</tr>
													<tr>
														<td class="BoldText">DOB</td>
														<td><?php  echo $row['DoB'];?></td>
													</tr>
													<tr>
														<td class="BoldText">Full Name <div class="pull-right"><a href="#Eng">Eng</a> / <a href="#Ara">Ara</a></div></td>
														<td><?php  echo $row['AFullName_en'];?>  <?php  echo $row['AFullName_ar'];?></td>
													</tr>
													<tr>
														<td class="BoldText">Mobile</td>
														<td><?php  echo $row['Mobile'];?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section><!-- /.content -->
						<?php }?>
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
	</body>
</html>
