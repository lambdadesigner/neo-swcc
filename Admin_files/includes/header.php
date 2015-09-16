<?php
ob_start();
session_start();
error_reporting(0);
include('includes/database.php');
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
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Font Awesome Icons -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<!-- Ionicons -->
		<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- Theme style -->
		<link href="assets/dist/css/Swcc.css" rel="stylesheet" type="text/css" />		

		<!-- Swcc Skins. Choose a skin from the css/skins
				 folder instead of downloading all of them to reduce the load. -->
		<link href="assets/dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
		<link href="dist/custom/custom.css" rel="stylesheet" type="text/css" />
		<link href="assets/dist/css/services.css" rel="stylesheet" type="text/css" />		
		<link href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

		<!-- Donuct Chart CSS : Admin Attendance -->
		<link rel="stylesheet" type="text/css" href="assets/dist/css/donut.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
				<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

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
							<div class="dropdown">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									<?php if($_SESSION['language']=="en"){?>English<?php }elseif($_SESSION['language']=="ar"){?>Arabic<?php }else{?>Select Language<?php } ?>
									<span class="caret"></span>
								</button>
								 
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" onChange="window.location = '?lang='+this.value+''">
									<li><a href="?lang=en">English</a></li>
									<li><a href="?lang=ar">Arabic</a></li>
								</ul>
							</div>
							<!--  <select onChange="window.location = '?lang='+this.value+''" >
						      <option value="" selected="selected" disabled="disabled">Select language</option>
						      <option value="en" <?php if ($_GET['lang']==en) echo 'selected="selected"';?>>English</option>
						      <option value="ar" <?php if ($_GET['lang']==ar) echo 'selected="selected"';?>>Arabic</option>
						    </select>  -->
						</li>
							<!-- Notifications: style can be found in dropdown.less -->
							<li class="dropdown notifications-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdsown" id="bells">
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
							<!-- User Account: style can be found in dropdown.less -->
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdowns" id="userpanel">
									<img src="dist/img/user2-160x160.jpg" class="user-image img-circle" alt="User Image" />
									<span class="hidden-xs"><?php echo $_SESSION['AdminUserName']?></span>
								</a>
								<ul class="dropdown-menu" id="panelshow">
									<!-- User image -->
									<li class="user-header">
										<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
										<p>
											<?php echo $_SESSION['AdminUserName']?>
											<small>Member since Nov. 2012</small>
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
											<a href="AdminProfile" class="btn btn-default btn-flat">Profile</a>
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
						<li <?php if($url=="Admin"){?>class="active"<?php } ?>>
							<a href="Admin">
								<i class="fa fa-dashboard"></i> <span><?php echo $lang["dashboard"];?></span>
							</a>
						</li>
						<li <?php if($url=="Adminprofile"){?>class="active"<?php } ?>>
							<a href="Adminprofile">
								<i class="fa fa-user"></i> <span><?php echo $lang["profile"];?></span>
							</a>
						</li>
						<li <?php if($url=="AllProfiles"){?>class="active"<?php } ?>>
							<a href="AllProfiles">
								<i class="fa fa-user"></i> <span><?php echo $lang["Instructors"]." "; echo $lang["profile"];?></span>
							</a>
						</li>
						<li class="treeview <?php if($url=="AdminAuditorium" || $url=="AdminClassroom"){?>active<?php } ?>">
							<a href="#">
								<i class="fa fa-bars"></i> <span>Booking Status</span> <i class="fa fa-angle-left pull-right"></i>
							</a>
							<ul class="treeview-menu">
								<li <?php if($url=="AdminAuditorium"){?>class="active"<?php } ?>><a href="AdminAuditorium"><i class="fa fa-university"></i> Auditorium Status</a></li>
								<li <?php if($url=="AdminClassroom"){?>class="active"<?php } ?>><a href="AdminClassroom"><i class="fa fa-leaf"></i> Classroom Status</a></li>
							</ul>
						</li>
						<li <?php if($url=="AdminSchedules"){?>class="active"<?php } ?>>
							<a href="AdminSchedules">
								<i class="fa fa-list-ul"></i> <span><?php echo $lang["schedules"];?></span>
							</a>
						</li>
						<li <?php if($url=="AdminExams"){?>class="active"<?php } ?>>
							<a href="AdminExams">
								<i class="fa fa-pencil-square-o"></i> <span><?php echo $lang["examinations"];?></span>
							</a>
						</li>
					</ul>
				</section>
				<!-- /.sidebar -->
			</aside>		
	
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
		<link href="assets/dist/css/Universal.css" rel="stylesheet" type="text/css" />    
		<script src="assets/dist/js/Universal.js"></script>