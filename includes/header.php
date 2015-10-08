<?php
ob_start();
session_start();
error_reporting(0);
include('database.php');
include ('library.php'); // include the library to get the session values
$url = basename($_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Swcc | Dashboard</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.4 -->
		<link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Font Awesome Icons -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Ionicons -->
		<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="assets/dist/css/Swcc.css" rel="stylesheet" type="text/css" />
		
		<!-- Swcc Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
		<link href="assets/dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
		<link href="assets/dist/custom/custom.css" rel="stylesheet" type="text/css" />
		<link href="assets/dist/css/services.css" rel="stylesheet" type="text/css" />
		<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
		<link href="assets/dist/css/Universal.css" rel="stylesheet" type="text/css" />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
				<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<?php 		  
			if(@$_SESSION['StudentID'] !=""){	
	?>

	<body class="skin-blue sidebar-mini sidebar-collapse">
		<!-- Site wrapper -->
		<div class="wrapper">

			<header class="main-header">
				<!-- Logo -->
				<a href="#" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>Stu.</b></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>SWCC Student</b> </span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
						<li>
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<?php if($_SESSION['language']=="en"){?>English<?php }elseif($_SESSION['language']=="ar"){?>Arabic<?php }else{?>Select Language<?php } ?>
									<span class="caret"></span>
								</button>
								 
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" onChange="window.location = '?lang='+this.value+''">
									<li <?php if($_GET['lang']=="en"){?>selected="selected"<?php } ?>><a href="?lang=en">English</a></li>
									<li><a href="?lang=ar">Arabic</a></li>
								</ul>
							</div>
							 <!-- <select onChange="window.location = '?lang='+this.value+''" >
						      <option value="" selected="selected" disabled="disabled">Select language</option>
						      <option value="en" <?php if ($_GET['lang']==en) echo 'selected="selected"';?>>English</option>
						      <option value="ar" <?php if ($_GET['lang']==ar) echo 'selected="selected"';?>>Arabic</option>
						    </select>  -->
						</li>
							<!-- Notifications: style can be found in dropdown.less -->
							<li class="dropdown notifications-menu">
								<a class="dropdown-toggle" data-toggle="dropdsown" id="bells" style="cursor:pointer">
									<i class="fa fa-bell-o"></i>
									<?php 
										$noti_sql = "SELECT * FROM AllNotifications";
										$noti_result = sqlsrv_query( $conn, $noti_sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));																					
									?>
									<span class="label label-warning"><?php $idd = 0;
										while($noti_row = sqlsrv_fetch_array($noti_result))
										{
											$not_arr = explode(',',$noti_row['To']);
											if(in_array($_SESSION['StudentID'],$not_arr))
											{												
												$idd++;
											}
										}
										//echo $idd;
									?></span>
								</a>
								<ul class="dropdown-menu" id="alertdrop">
									<li class="header">You have <?php echo $idd;?> notifications</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">											
											<?php $idssa = 1;
												$noti_sql1 = "SELECT * FROM AllNotifications";
												$noti_result1 = sqlsrv_query( $conn, $noti_sql1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));													
												while($noti_row1 = sqlsrv_fetch_array($noti_result1))
												{
													$not_arr1 = explode(',',$noti_row1['To']);
													if(in_array($_SESSION['StudentID'],$not_arr1))
													{?>												
														<li>
															<a data-toggle="modal" data-target="#myModal<?php echo $idssa;?>" style="cursor:pointer">																
																<?php echo $noti_row1['Subject'];?>  <small class="pull-right" data-toggle="tooltip" data-placement="left" title="<?php echo $noti_row1['SentBy'];?>"><i class="fa fa-user-secret"></i> </small>
															</a>
														</li>
													<?php }
													$idssa++;
												}
											?>
										</ul>
									</li>
									<li class="footer"><a href="#">View all</a></li>
								</ul>
							</li>							
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdowns" id="userpanel">
									<img src="assets/dist/img/user2-160x160.jpg" class="user-image img-circle" alt="User Image" />
									<span class="hidden-xs">
									<?php 
									echo $_SESSION['StudentName_en']?></span>
								</a>
								<ul class="dropdown-menu" id="panelshow">
									<!-- User image -->
									<li class="user-header">
										<img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
										<p>
											
											

									<?php echo $_SESSION['StudentName_en']?>
											
										</p>
									</li>
									<!-- Menu Body 
									<li class="user-body">
										<div class="col-xs-4 text-center">
											<a href="#">Followers</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Sales</a>
										</div>
										<div class="col-xs-4 text-center">
											<a href="#">Friends</a>
										</div>
									</li>-->
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="profile" class="btn btn-default btn-flat"><?php echo $lang["profile"];?></a>
										</div>
										<div class="pull-right">
											<a href="logout.php" class="btn btn-default btn-flat"><?php echo $lang["Sign out"];?></a>
										</div>
									</li>
								</ul>
							</li>
							<!-- Control Sidebar Toggle Button - - >
							<li>
								<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
							</li> -->
						</ul>
					</div>
				</nav>
			</header>

			<!-- =============================================== -->

			<!-- Left side column. contains the sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">					
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						 <!-- <li class="header">MAIN NAVIGATION</li> -->
						<li <?php if($url=="dashboard_c"){?>class="active"<?php } ?>>
							<a href="dashboard_c">
								<i class="fa fa-dashboard"></i> <span><?php echo $lang["dashboard"];?></span>
							</a>
						</li>
						<li <?php if($url=="profile"){?>class="active"<?php } ?>>
							<a href="profile">
								<i class="fa fa-user"></i> <span><?php echo $lang["profile"];?></span>
							</a>
						</li>
						<li <?php if($url=="marks"){?>class="active"<?php } ?>>
							<a href="marks">
								<i class="fa fa-file-text-o"></i> <span><?php echo $lang["marks"];?></span>
							</a>
						</li>
						<li>
							<a href="attendance">
								<i class="fa fa-check-square-o"></i> <span><?php echo $lang["attendance"];?></span>
							</a>
						</li>
						<li <?php if($url=="schedules"){?>class="active"<?php } ?>>
							<a href="schedules">
								<i class="fa fa-list-ul"></i> <span><?php echo $lang["schedules"];?></span>
							</a>
						</li>
						<li>
							<a href="teachers">
								<i class="fa fa-users"></i> <span><?php echo $lang["teachers"];?></span>
							</a>
						</li>
						<?php /*?><li <?php if($url=="todos"){?>class="active"<?php } ?>>
							<a href="todos">
								<i class="fa fa-th-list"></i> <span><?php echo $lang["todo's"];?></span>
							</a>
						</li><?php */?>
						<li <?php if($url=="examinations"){?>class="active"<?php } ?>>
							<a href="examinations">
								<i class="fa fa-pencil-square-o"></i> <span><?php echo $lang["examinations"];?></span>
							</a>
						</li>
						<li class="treeview <?php if($url=="flight" || $url=="medical" || $url=="salary"){?>active<?php } ?>">
							<a href="#">
								<i class="fa fa-bookmark"></i> <span><?php echo $lang["services"];?></span> <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li <?php if($url=="flight"){?>class="active"<?php } ?>><a href="flight"><i class="fa fa-plane"></i> <?php echo $lang["flight discount"];?></a></li>
								<li <?php if($url=="salary"){?>class="active"<?php } ?>><a href="salary"><i class="fa fa-leaf"></i> <?php echo $lang["salary certificates"];?></a></li>								
								<li <?php if($url=="medical"){?>class="active"<?php } ?>><a href="medical"><i class="fa fa-medkit"></i> <?php echo $lang["medical leave"];?></a></li>
								<!-- <li><a href="#fakelink"><i class="fa fa-circle-o"></i> Certificates</a></li> -->
							</ul>
						</li>
						<li <?php if($url=="Housing"){?>class="active"<?php } ?>>
							<a href="Housing">
								<i class="fa fa-pencil-square-o"></i> <span><?php echo $lang["Housing"];?></span>
							</a>
						</li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
		  <?php }else{?>
			  <body class="skin-blue sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">

			<header class="main-header">
				<!-- Logo -->
				<a href="#" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>Stu.</b></span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>SWCC Student</b> </span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top" role="navigation">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
						<li>
							<?php /*?><div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Select Language
									<span class="caret"></span>
								</button>
								 
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" onChange="window.location = '?lang='+this.value+''">
									<li <?php if($_GET['lang']=="en"){?>selected="selected"<?php } ?>><a href="?lang=en">English</a></li>
									<li><a href="?lang=ar">Arabic</a></li>
								</ul>
							</div><?php */?>
							
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<?php if($_SESSION['language']=="en"){?>English<?php }elseif($_SESSION['language']=="ar"){?>Arabic<?php }else{?>Select Language<?php } ?>
									<span class="caret"></span>
								</button>
								 
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" onChange="window.location = '?lang='+this.value+''">
									<li <?php if($_GET['lang']=="en"){?>selected="selected"<?php } ?>><a href="?lang=en">English</a></li>
									<li><a href="?lang=ar">Arabic</a></li>
								</ul>
							</div>
							
							<?php /*<select onChange="window.location = '?lang='+this.value+''" >
					          <option value="" selected="selected" disabled="disabled">Select language</option>
					          <option value="en" <?php if ($_GET['lang']==en) echo 'selected="selected"';?>>English</option>
					          <option value="ar" <?php if ($_GET['lang']==ar) echo 'selected="selected"';?>>Arabic</option>
					        </select>*/?>
						</li>							
							<!-- Notifications: style can be found in dropdown.less -->
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdowns" id="bells">
									<i class="fa fa-bell-o"></i>
									<span class="label label-warning">10</span>
								</a>
								<ul class="dropdown-menu" id="alertdrop">
									<li class="header">You have 10 notifications</li>
									<li>
										<!-- inner menu: contains the actual data -->
										<ul class="menu">
											<li>
												<a href="#">
													<i class="fa fa-users text-aqua"></i> 5 new members joined today
												</a>
											</li>
										</ul>
									</li>
									<li class="footer"><a href="#">View all</a></li>
								</ul>
							</li>
							<!-- Tasks: style can be found in dropdown.less -->
							
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdowns" id="userpanel">
									<img src="assets/dist/img/user2-160x160.jpg" class="user-image img-circle" alt="User Image" />
									<span class="hidden-xs"><?php 
									echo $_SESSION['StudentName_en']?></span>
								</a>
								<ul class="dropdown-menu" id="panelshow">
									<!-- User image -->
									<li class="user-header">
										<img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
										<p>
											<?php 
									echo $_SESSION['StudentName_en']?>
											
										</p>
									</li>
									<!-- Menu Body -->
									
									<!-- Menu Footer-->
									<li class="user-footer">
										<div class="pull-left">
											<a href="SCprofile" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
							<!-- Control Sidebar Toggle Button - - >
							<li>
								<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
							</li> -->
						</ul>
					</div>
				</nav>
			</header>

			<!-- =============================================== -->

			<!-- Left side column. contains the sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">					
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
						 <!-- <li class="header">MAIN NAVIGATION</li> -->
						<li <?php if($url=="SCdashboard.php"){?>class="active"<?php } ?>>
							<a href="SCdashboard.php">
								<i class="fa fa-dashboard"></i> <span><?php echo $lang["dashboard"];?></span>
							</a>
						</li>
						<li <?php if($url=="SCprofile.php"){?>class="active"<?php } ?>>
							<a href="SCprofile.php">
								<i class="fa fa-user"></i> <span><?php echo $lang["profile"];?></span>
							</a>
						</li>
						
						<li>
							<a href="SCattendance">
								<i class="fa fa-check-square-o"></i> <span><?php echo $lang["attendance"];?></span>
							</a>
						</li>
						<li <?php if($url=="SCschedules.php"){?>class="active"<?php } ?>>
							<a href="SCschedules">
								<i class="fa fa-list-ul"></i> <span><?php echo $lang["schedules"];?></span>
							</a>
						</li>
						<li>
							<a href="teachers">
								<i class="fa fa-users"></i> <span><?php echo $lang["teachers"];?></span>
							</a>
						</li>
						
						<li>
							<a href="SCexams">
								<i class="fa fa-pencil-square-o"></i> <span><?php echo $lang["examinations"];?></span>
							</a>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-bookmark"></i> <span><?php echo $lang["services"];?></span> <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li <?php if($url=="SCflight.php"){?>class="active"<?php } ?>><a href="SCflight"><i class="fa fa-plane"></i> <?php echo $lang["flight discount"];?></a></li>
								<li <?php if($url=="SCsalary.php"){?>class="active"<?php } ?>><a href="SCsalary"><i class="fa fa-leaf"></i> <?php echo $lang["salary certificates"];?></a></li>
								<!--<li><a href="#fakelink"><i class="fa fa-bed"></i> <?php //echo $lang["hostel maintenance"];?></a></li>-->
								<li <?php if($url=="SCmedical.php"){?>class="active"<?php } ?>><a href="SCmedical"><i class="fa fa-medkit"></i> <?php echo $lang["medical leave"];?></a></li>
								<!-- <li><a href="#fakelink"><i class="fa fa-circle-o"></i> Certificates</a></li> -->
							</ul>
						</li>
						<li <?php if($url=="Housing"){?>class="active"<?php } ?>>
							<a href="Housing">
								<i class="fa fa-pencil-square-o"></i> <span><?php echo $lang["Housing"];?></span>
							</a>
						</li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>
				  
		  <?php }?>

		  	<!-- Notifications Modal -->
		  	<?php $idde = 1;
				$noti_sql3 = "SELECT * FROM AllNotifications";
				$noti_result3 = sqlsrv_query( $conn, $noti_sql3 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));																					

				while($noti_row3 = sqlsrv_fetch_array($noti_result3))
				{
					$not_arr3 = explode(',',$noti_row3['To']);
					if(in_array($_SESSION['StudentID'],$not_arr3))
					{?>												
						<div class="modal fade" id="myModal<?php echo $idde;?>" role="dialog">
							<div class="modal-dialog modal-captain">
							 	<div class="modal-header" style="background-color:#fff;">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								  	<h4 class="modal-title"><?php echo $noti_row3['Subject']?> <br><small><?php $vals21=strtotime($noti_row3['SentOn']); echo date("j M Y G:i a",$vals21);?></small></h4>
								</div>
							  	<!-- Modal content-->
							  	<div class="modal-content">					
									<div class="modal-body">
										<!-- <div class="col-md-12">
											<div class="row">								
												<div class="col-md-5"> -->
													Message:<span class="pull-right"></span><br>
													<?php echo $noti_row3['Message']?>						
												<!-- </div>
											</div>					  
										</div> -->																
								    </div>	
							 	    <div class="modal-footer">
							 	    	<small>From <?php echo $noti_row3['SentBy'];?></small>
							 	    	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>					  
								    </div>			  
							  	</div>
							</div>
						</div>
					<?php }
					$idde++;
				}				
			?>

	
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script type="text/javascript">		
			$("#bells").click(function(e) {
				$("#alertdrop").toggle();
				$("#panelshow").hide();
				e.stopPropagation();
			});
			$("#userpanel").click(function(e) {
				$("#panelshow").toggle();
				$("#alertdrop").hide();
				e.stopPropagation();
			});
			$(document).click(function(e) {
	        	if (!$(e.target).is('#panelshow, #panelshow *')) {
	            	$("#panelshow").hide();
	            	$("#alertdrop").hide();
	        	}
	    	});
		</script>