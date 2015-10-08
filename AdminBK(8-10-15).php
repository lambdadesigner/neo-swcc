<?php
include('Admin_files/includes/header.php');
$AdminID = $_SESSION['AdminId'];

if($_SESSION['AdminId']==''){	
	 header("Location: index"); 
}
//TestID.Marks,Marks.Marks,ModuleID.Tests,TestWeight.Test,MaxMarks.Test,TestName.Test,ModuleName.Module
$sql= "select * from Schdule";
/*$sql = "SELECT *
FROM Marks
INNER JOIN Tests
ON Marks.TestID=Tests.TestID
INNER JOIN Module
ON Tests.ModuleID=Module.ModuleID
WHERE Marks.StudentID = $StudentID";*/
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
?>
<!-- Morris chart -->
    <link href="assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- Font awesome Icons -->
	<link rel="stylesheet" type="text/css" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css">

    <!-- Housing Css -->
    <link href="assets/dist/css/Housing.css" rel="stylesheet" type="text/css" />
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
		        <!-- Content Header (Page header) -->
		        <section class="content-header">
		          <h1>
		            <?php echo $lang["dashboard"];?>
		            <!-- <small>Control panel</small> -->
		          </h1>
		          <ol class="breadcrumb">
		            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $lang["Home"];?></a></li>
		            <li class="active"><?php echo $lang["dashboard"];?></li>
		          </ol>
		        </section>

		        	<!-- ALert Message -->
			        <!-- <div class="row">
			        	<div class="col-md-10 col-md-offset-1">
			        		<?php if($_GET['msg']=="Success"){?>
			        			<hr>
			        			<div class="alert alert-success alert-dismissible" role="alert">
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  <strong>Warning!</strong> Better check yourself, you're not looking too good.
								</div>				            
					        <?php } ?>
			        	</div>
			        </div> -->

			    <!-- Housing Content -->
			    <?php 
			    $housingSql = "SELECT DISTINCT BuildingNo FROM BachelorAcc";
			    $Housing_result = sqlsrv_query( $conn, $housingSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
			    ?>
			    <section class="content">

			    	<div class="col-md-12">
			    		<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Hostel Management</h3>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-8 col-md-offset-2">
										<div class="colors">
											<ul id="da-thumbs" class="da-thumbs">
												<?php $hij=1;while($Housing_fetch = sqlsrv_fetch_array($Housing_result)){?>
													<li class="panel panel-default box<?php echo $hij;?>">
													
														<a href="AdminBuildings?building=<?php echo $Housing_fetch['BuildingNo'];?>">
														<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
														<div class="hoverbg">
															<table class="table">
																<thead>
																	<td colspan="2"><h3 class="details-title"><?php echo $Housing_fetch['BuildingNo'];?> <i class="fa fa-building pull-left"></i></h3></td>
																</thead>
																<tr>
																	<td>
																		<i class="fa fa-th"></i> Rooms
																	</td>
																	<td>
																		<?php
																		$HroomSql = "SELECT COUNT(RoomNo) AS RCount FROM BachelorAcc WHERE BuildingNo='".$Housing_fetch['BuildingNo']."'";
																		$HRoom_result = sqlsrv_query( $conn, $HroomSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																		$HRoom_fetch = sqlsrv_fetch_array($HRoom_result);
																		echo $HRoom_fetch['0'];
																		?>
																	</td>
																</tr>
																<tr>
																	<td>
																		<i class="fa fa-group"></i> Filled
																	</td>
																	<td>
																		<?php
																		$FillRomSql = "SELECT count(*) FROM BachelorAcc WHERE Candidate_1!='' AND Candidate_2!='' AND Candidate_3!='' AND BuildingNo='".$Housing_fetch['BuildingNo']."'";
																		$FillRom_result = sqlsrv_query( $conn, $FillRomSql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
																		$FillRom_fetch = sqlsrv_fetch_array($FillRom_result);
																		echo $FillRom_fetch['0'];
																		?>
																	</td>
																</tr>
																<tr>
																	<td>
																		<i class="fa fa-street-view"></i> Vacant
																	</td>
																	<td>
																		<?php
																		echo $vacRooms = $HRoom_fetch['0'] - $FillRom_fetch['0'];
																		?>
																	</td>
																</tr>
																<tr>
																	<td>
																		<i class="fa fa-circle-o-notch"></i> Capacity
																	</td>
																	<td>
																		<?php echo $capa = $HRoom_fetch['0'] * 3;?>
																	</td>
																</tr>
																
																<tr>
																	<td colspan="2" align="center">
																		<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																	</td>
																</tr>
																<tr>
																	<td colspan="2" align="center">
																		<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																	</td>
																</tr>
															</table>
														</div>
														</a>
													</li>
												<?php $hij++; } ?>
												 <li class="box2">
													<a href="AdminBuildings?building=B4">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li>
												<!--<li class="box3">
													<a href="#">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li>
												<li class="box4">
													<a href="#">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li>
												<li class="box5">
													<a href="#">
													<div class="box"><img src="assets/dist/img/building-bg2.png"></div>
													<div class="hoverbg">
														<table class="table">
															<thead>
																<td colspan="2"><h3 class="details-title">Details <i class="fa fa-building pull-left"></i></h3></td>
															</thead>
															<tr>
																<td>
																	<i class="fa fa-group"></i> Filled
																</td>
																<td>
																	53
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-street-view"></i> Vacant
																</td>
																<td>
																	43
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-circle-o-notch"></i> Capacity
																</td>
																<td>
																	96
																</td>
															</tr>
															<tr>
																<td>
																	<i class="fa fa-th"></i> Rooms
																</td>
																<td>
																	35
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-success"><i class="fa fa-plus"></i> Add Student</button>
																</td>
															</tr>
															<tr>
																<td colspan="2" align="center">
																	<button class="btn btn-danger"><i class="fa fa-remove"></i> Remove Student</button>
																</td>
															</tr>
														</table>
													</div>									</a>
												</li> -->
											</ul>
										</div>
									</div>
								</div>					
							</div>
						</div>
			    	</div>
			    </section>
			    <!-- Housing Content End -->
		        <div style="min-height:500px;">
		        </div>
		      </div><!-- /.content-wrapper -->

			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.2.0
				</div>
				<strong>Copyright &copy; 2014-2015 <a href="#"></a>.</strong> All rights reserved.
			</footer>
			
			<div class="control-sidebar-bg"></div>
		</div><!-- ./wrapper -->

		<!-- jQuery 2.1.4
		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script> -->
		<!-- Bootstrap 3.3.2 JS 
		<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="assets/dist/js/app.min.js" type="text/javascript"></script>-->
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

		<!--<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- DatePicker -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
	<script src="assets/dist/js/datepicker.js"></script>
		
    <!-- Bootstrap 3.3.2 JS -->
    <script type="text/javascript">
    $(function () {
	  $("#datepicker").datepicker({ 
	        autoclose: true, 
	        todayHighlight: true
	  }).datepicker('update', new Date());;
	});
	$('.inputpickertext, i.glyphicon-calendar').click(function(){
		// alert('dasd')
		$('.datepicker').addClass('inputpicker');
	})

	$(window).on('load resize', function(e){								
		var donsize = $('#InstAttendance').height();		
		$('#HolCalendar').css('height', donsize +'px');

		//var audiclasize = $('#quicEmail').height();		
		//alert(audiclasize);
		//$('#AudiClass').css('height', audiclasize +'px');

		var windowWidth = $(window).width();
		if(windowWidth>1198 && windowWidth<1450)
		{
			$('#chart').animate({marginLeft : "-80px"},500);			
		}
		else
		{
			$('#chart').animate({marginLeft: '0px'},500);
		}

	});

    $('#Search').click(function(){
    	var Syear = $('#clicking').val();
    	var Inuser = $('#Insusers').val();    	
    	if(Inuser == "")
    	{
    		alert('Please Enter Instructor Id');
    		$('#Insusers').focus();
    		return false;
    	}
    	else
    	{
    		$.ajax({
		      url: 'ddonut.php',		      
		      type: "GET",
		      data:{"year":Syear,"Inuser":Inuser},		      		      
		      success: function(data) {
		      	if(data == "Empty")
		      	{		      		
		      		 $('#myModal').modal('show');
		      	}
		      	else
		      	{
		        	$('#donut-chart').html(data);		       	
		        }
		      }
		    })
		    return false;
		}
		return true;
    	//var data="2014";
    	//$("#donut-chart").load("ddonut.php?year=2014",{'name':data});
    });
    	
    	$('#RegStudent').click(function(){    		
    		$(this).siblings('.checkbox-text').toggleClass('hello');
    	})
    	$('#ScStudent').click(function(){    		
    		$(this).siblings('.checkbox-text').toggleClass('hello');
    	})
    	$('#RegInstuctors').click(function(){    		
    		$(this).siblings('.checkbox-text').toggleClass('hello');
    	})
    	$('#ItdInstuctors').click(function(){    		
    		$(this).siblings('.checkbox-text').toggleClass('hello');
    	})

    	
    </script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!-- Housing Scripts -->
		<script type="text/javascript" src="assets/dist/js/Housing-min.js"></script>
		<script type="text/javascript" src="assets/dist/js/Housing.js"></script>		
	<!-- Housing Scripts End -->
<?php
	include('Admin_files/includes/footer.php');
?>

<script type="text/javascript" src="assets/dist/js/donut.js"></script>
