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
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
		        <!-- Content Header (Page header) -->
		        <section class="content-header">
		          <h1>
		            Dashboard
		            <small>Control panel</small>
		          </h1>
		          <ol class="breadcrumb">
		            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		            <li class="active">Dashboard</li>
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
		        
		        <!-- Main content -->
		        <section class="content">
		         <?php /* <!-- Small boxes (Stat box) -->
		          <div class="row">
		            <div class="col-lg-3 col-xs-6">
		              <!-- small box -->
		              <div class="small-box bg-aqua">
		                <div class="inner">
		                  <h3>150</h3>
		                  <p>New Orders</p>
		                </div>
		                <div class="icon">
		                  <i class="ion ion-bag"></i>
		                </div>
		                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		              </div>
		            </div><!-- ./col -->
		            <div class="col-lg-3 col-xs-6">
		              <!-- small box -->
		              <div class="small-box bg-green">
		                <div class="inner">
		                  <h3>53<sup style="font-size: 20px">%</sup></h3>
		                  <p>Bounce Rate</p>
		                </div>
		                <div class="icon">
		                  <i class="ion ion-stats-bars"></i>
		                </div>
		                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		              </div>
		            </div><!-- ./col -->
		            <div class="col-lg-3 col-xs-6">
		              <!-- small box -->
		              <div class="small-box bg-yellow">
		                <div class="inner">
		                  <h3>44</h3>
		                  <p>User Registrations</p>
		                </div>
		                <div class="icon">
		                  <i class="ion ion-person-add"></i>
		                </div>
		                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		              </div>
		            </div><!-- ./col -->
		            <div class="col-lg-3 col-xs-6">
		              <!-- small box -->
		              <div class="small-box bg-red">
		                <div class="inner">
		                  <h3>65</h3>
		                  <p>Unique Visitors</p>
		                </div>
		                <div class="icon">
		                  <i class="ion ion-pie-graph"></i>
		                </div>
		                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		              </div>
		            </div><!-- ./col -->
		          </div><!-- /.row -->*/?>
		          <!-- Main row -->
		          <div class="row">
		            <!-- Left col -->
		            <section class="col-lg-6 connectedSortable">
		              <!-- Custom tabs (Charts with tabs)-->
		            	<div class="panel box-solid bg-white-gradient">
		            		<div class="panel-heading">
		            			<h3 class="panel-title"><i class="fa fa-home text-red"></i> Instructor Attendance		            			
		            			</h3><hr>
		            		</div>
		            		<div class="pandl-body row">
		            			<div class="SelectInstructorDiv col-md-12">
									<input type="text" name="Insusers" id="Insusers" placeholder="Enter Instructor ID" />
		            				<select id="clicking">
		            					<option value="" disabled selected>Select Year</option>
		            					<option value="2015">2015</option>
		            					<option value="2014">2014</option>
		            					<option value="2013">2013</option>
		            					<option value="2012">2012</option>
		            				</select>
		            				<button name="Search" id="Search" class="btn bg-green">Search</button>
		            			</div>	
		            			
		            			<div class="col-md-8 col-md-offset-1">
		            				<div id="chart">
		            					<?php /*<select id="users">
			            					<option value="" disabled selected>Select Instructor</option>
			            					<?php
				            				$insts = "SELECT InstructorID FROM Instructors"; 
											$inst_result = sqlsrv_query( $conn, $insts ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

											while($inst_data = sqlsrv_fetch_array($inst_result)){			?>
													<option value="<?php echo $inst_data['InstructorID'];?>"><?php echo $inst_data['InstructorID'];?></option>
											<?php }	?>			            			
			            				</select>*/?>
										<svg id="donut-chart"></svg>
									</div>
		            			</div>
		            		</div>
		            	</div>

		            	 <div class="box box-solid bg-teal-gradient">
							<div class="box-header">
								<i class="fa fa-th"></i>
								<h3 class="box-title">Status Of Auditorium / Classroom</h3>
								<!-- <div class="box-tools pull-right">
									<button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
								</div> --><hr>
								<div class="row">																		
									<div class="col-md-6">
										<input maxlength="100" type="text" id="bookedby" required name="bookedby" class="form-control" placeholder="Booked By" />													
									</div>
									<div class="col-md-6">
										<div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
										    <input class="form-control inputpickertext" type="text" />
										    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										</div>
									</div>
								</div>
							</div>

							<div class="box-body border-radius-none">
								<ul class="todo-list">
				                    <li>
				                      <!-- drag handle -->
				                      <span class="handle">
				                        <i class="fa fa-ellipsis-v"></i>
				                        <i class="fa fa-ellipsis-v"></i>
				                      </span>
				                      <!-- checkbox -->
				                      <!-- todo text -->
				                      <span class="text">Design a nice theme</span>
				                      <!-- Emphasis label -->
				                      <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
				                      <!-- General tools such as edit or delete-->
				                      <div class="tools">
				                        <i class="fa fa-edit"></i>
				                        <i class="fa fa-trash-o"></i>
				                      </div>
				                    </li>
				                    <li>
				                      <span class="handle">
				                        <i class="fa fa-ellipsis-v"></i>
				                        <i class="fa fa-ellipsis-v"></i>
				                      </span>
				                      <span class="text">Make the theme responsive</span>
				                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
				                      <div class="tools">
				                        <i class="fa fa-edit"></i>
				                        <i class="fa fa-trash-o"></i>
				                      </div>
				                    </li>
				                    <li>
				                      <span class="handle">
				                        <i class="fa fa-ellipsis-v"></i>
				                        <i class="fa fa-ellipsis-v"></i>
				                      </span>
				                      <span class="text">Let theme shine like a star</span>
				                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
				                      <div class="tools">
				                        <i class="fa fa-edit"></i>
				                        <i class="fa fa-trash-o"></i>
				                      </div>
				                    </li>
				                    <li>
				                      <span class="handle">
				                        <i class="fa fa-ellipsis-v"></i>
				                        <i class="fa fa-ellipsis-v"></i>
				                      </span>
				                      <span class="text">Let theme shine like a star</span>
				                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
				                      <div class="tools">
				                        <i class="fa fa-edit"></i>
				                        <i class="fa fa-trash-o"></i>
				                      </div>
				                    </li>
				                    <li>
				                      <span class="handle">
				                        <i class="fa fa-ellipsis-v"></i>
				                        <i class="fa fa-ellipsis-v"></i>
				                      </span>
				                      <span class="text">Check your messages and notifications</span>
				                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
				                      <div class="tools">
				                        <i class="fa fa-edit"></i>
				                        <i class="fa fa-trash-o"></i>
				                      </div>
				                    </li>
				                    <li>
				                      <span class="handle">
				                        <i class="fa fa-ellipsis-v"></i>
				                        <i class="fa fa-ellipsis-v"></i>
				                      </span>
				                      <span class="text">Let theme shine like a star</span>
				                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
				                      <div class="tools">
				                        <i class="fa fa-edit"></i>
				                        <i class="fa fa-trash-o"></i>
				                      </div>
				                    </li>
				                  </ul>
							</div><!-- /.box-body 
							<div class="box-footer no-border">
							</div>--><!-- /.box-footer -->
						</div><!-- /.box -->

		              <!-- TO DO List -->
		              <div class="box box-primary">
		                <div class="box-header">
		                  <i class="ion ion-clipboard"></i>
		                  <h3 class="box-title">To Do List</h3>
		                  <div class="box-tools pull-right">
		                    <!-- <ul class="pagination pagination-sm inline">
		                      <li><a href="#">&laquo;</a></li>
		                      <li><a href="#">1</a></li>
		                      <li><a href="#">2</a></li>
		                      <li><a href="#">3</a></li>
		                      <li><a href="#">&raquo;</a></li>
		                    </ul> -->
		                  </div>
		                </div><!-- /.box-header -->
		                <div class="box-body" id="slimScroll">
		                  <ul class="todo-list">
		                    <li>
		                      <!-- drag handle -->
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <!-- checkbox -->
		                      <!-- todo text -->
		                      <span class="text">Design a nice theme</span>
		                      <!-- Emphasis label -->
		                      <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
		                      <!-- General tools such as edit or delete-->
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Make the theme responsive</span>
		                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Check your messages and notifications</span>
		                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li> <li>
		                      <!-- drag handle -->
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <!-- checkbox -->
		                      <!-- todo text -->
		                      <span class="text">Design a nice theme</span>
		                      <!-- Emphasis label -->
		                      <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
		                      <!-- General tools such as edit or delete-->
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Make the theme responsive</span>
		                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Check your messages and notifications</span>
		                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li> <li>
		                      <!-- drag handle -->
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <!-- checkbox -->
		                      <!-- todo text -->
		                      <span class="text">Design a nice theme</span>
		                      <!-- Emphasis label -->
		                      <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
		                      <!-- General tools such as edit or delete-->
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Make the theme responsive</span>
		                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Check your messages and notifications</span>
		                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li> <li>
		                      <!-- drag handle -->
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <!-- checkbox -->
		                      <!-- todo text -->
		                      <span class="text">Design a nice theme</span>
		                      <!-- Emphasis label -->
		                      <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
		                      <!-- General tools such as edit or delete-->
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Make the theme responsive</span>
		                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Check your messages and notifications</span>
		                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li> <li>
		                      <!-- drag handle -->
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <!-- checkbox -->
		                      <!-- todo text -->
		                      <span class="text">Design a nice theme</span>
		                      <!-- Emphasis label -->
		                      <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
		                      <!-- General tools such as edit or delete-->
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Make the theme responsive</span>
		                      <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Check your messages and notifications</span>
		                      <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                    <li>
		                      <span class="handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                      </span>
		                      <span class="text">Let theme shine like a star</span>
		                      <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
		                      <div class="tools">
		                        <i class="fa fa-edit"></i>
		                        <i class="fa fa-trash-o"></i>
		                      </div>
		                    </li>
		                  </ul>
		                </div><!-- /.box-body -->
		                <div class="box-footer clearfix no-border">
		                  <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
		                </div>
		              </div><!-- /.box -->

		              <!-- quick email widget -->

		            </section><!-- /.Left col -->

				<link rel='stylesheet prefetch' href='assets/bootstrap/css/bootstrap-theme.min.css'>
				<link rel="stylesheet" type="text/css" href="assets/dist/css/calendar.css">

		            <!-- right col (We are only adding the ID to make the widgets sortable)-->
		            <section class="col-lg-6 connectedSortable">
		            					
					 <!-- Calendar -->
		              <div class="box box-solid"> <!-- bg-green-gradient -->
		                <div class="box-header">
		                  <i class="fa fa-calendar text-red"></i>
		                  <h3 class="box-title">Calendar</h3><hr>
		                  <!-- tools box -->
		                  <div class="pull-right box-tools">
		                    <!-- button with a dropdown -->
		                    <!-- <div class="btn-group">
		                      <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
		                      <ul class="dropdown-menu pull-right" role="menu">
		                        <li><a href="#">Add new event</a></li>
		                        <li><a href="#">Clear events</a></li>
		                        <li class="divider"></li>
		                        <li><a href="#">View calendar</a></li>
		                      </ul>
		                    </div>
		                    <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                    <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
		                  </div><!-- /. tools -->
		                </div><!-- /.box-header -->
		                <div class="box-body">
						  <div class="row">
							<div class="col-md-12">
							  <p class="text-center">							
							  </p>
							  <div class="chart">
								<div id="holder" class="row" ></div>							
							  </div>
							  <p class="text-center">							
							  </p>
							</div>
						  </div>
						</div>		                
		              </div><!-- /.box -->

		            <script type="text/tmpl" id="tmpl">
					  {{ 
					  var date = date || new Date(),
					      month = date.getMonth(), 
					      year = date.getFullYear(), 
					      first = new Date(year, month, 1), 
					      last = new Date(year, month + 1, 0),
					      startingDay = first.getDay(), 
					      thedate = new Date(year, month, 1 - startingDay),
					      dayclass = lastmonthcss,
					      today = new Date(),
					      i, j; 
					  if (mode === 'week') {
					    thedate = new Date(date);
					    thedate.setDate(date.getDate() - date.getDay());
					    first = new Date(thedate);
					    last = new Date(thedate);
					    last.setDate(last.getDate()+6);
					  } else if (mode === 'day') {
					    thedate = new Date(date);
					    first = new Date(thedate);
					    last = new Date(thedate);
					    last.setDate(thedate.getDate() + 1);
					  }
					  
					  }}
					  <table class="calendar-table table table-condensed table-tight">
					    <thead>
					      <div>
					      <tr>
					        <td colspan="7" style="text-align: center">
					          <table style="white-space: nowrap; width: 100%">
					            <tr>
					              <td>
					                <span class="btn-group btn-group-lg">
					                  {{ if (mode !== 'day') { }}
					                    {{ if (mode === 'month') { }}<button class="js-cal-option btn btn-link" data-mode="year">{{: months[month] }}</button>{{ } }}
					                    {{ if (mode ==='week') { }}
					                      <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
					                    {{ } }}
					                    <button class="js-cal-years btn btn-link">{{: year}}</button> 
					                  {{ } else { }}
					                    <button class="btn btn-link disabled">{{: date.toDateString() }}</button> 
					                  {{ } }}
					                </span>
					              </td>
					              <td style="text-align: right;">
					                <span class="btn-group">
					                  <button style="background-color: #E06D5F; color:white" class="js-cal-prev btn ">&lt;</button><!--btn-success-->
					                 
					                </span>
					                <button style="background-color: #E06D5F; color:white" class="js-cal-option btn {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
					                <button style="background-color: #E06D5F; color:white" class="js-cal-next btn">&gt;</button>
					              </td>
					              <!--<td style="text-align: right">
					                <span class="btn-group">
					                  <button class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">Year</button>
					                  <button class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">Month</button>
					                  <button class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">Week</button>
					                </span>
					              </td>-->
					            </tr>
					          </table>
					          
					        </td>
					      </tr>
					    </thead>
					    {{ if (mode ==='year') {
					      month = 0;
					    }}
					    <tbody>
					      {{ for (j = 0; j < 3; j++) { }}
					      <tr>
					        {{ for (i = 0; i < 4; i++) { }}
					        <td style="padding:0px;" class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
					          {{: months[month] }}
					          {{ month++;}}
					        </td>
					        {{ } }}
					      </tr>
					      {{ } }}
					    </tbody>
					    {{ } }}
					    {{ if (mode ==='month' || mode ==='week') { }}
					    <thead>
					    <div class="oppo">
					      <tr class="c-weeks">
					        {{ for (i = 0; i < 7; i++) { }}
					          <th class="c-name">
					            {{: days[i] }}
					          </th>
					        {{ } }}
					      </tr>
					      </div>
					    </thead>
					    <tbody>
					      {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
					      <tr>
					        {{ for (i = 0; i < 7; i++) { }}
					        {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
					        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}">
					          <div class="date">{{: thedate.getDate() }}</div>				          
					          {{ thedate.setDate(thedate.getDate() + 1);}}
					        </td>
					        {{ } }}
					      </tr>
					      {{ } }}
					    </tbody>
					    {{ } }}
					    {{ if (mode ==='day') { }}
					    <tbody>
					      <tr>
					        <td colspan="7">
					          <table class="table table-striped table-condensed table-tight-vert" >
					            <thead>
					              <tr>
					                <th>&nbsp;</th>
					                <th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
					              </tr>
					            </thead>
					            <tbody>
					              <tr>
					                <th class="timetitle" >All Day</th>
					                <td class="{{: date.toDateCssClass() }}">  </td>
					              </tr>
					              <tr>
					                <th class="timetitle" >Before 6 AM</th>
					                <td class="time-0-0"> </td>
					              </tr>
					              {{for (i = 6; i < 22; i++) { }}
					              <tr>
					                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
					                <td class="time-{{: i}}-0"> </td>
					              </tr>
					              <tr>
					                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }}:30 {{: i < 12 ? "AM" : "PM"}}</th>
					                <td class="time-{{: i}}-30"> </td>
					              </tr>
					              {{ } }}
					              <tr>
					                <th class="timetitle" >After 10 PM</th>
					                <td class="time-22-0"> </td>
					              </tr>
					            </tbody>
					          </table>
					        </td>
					      </tr>
					    </tbody>
					    {{ } }}
					  </table>
					</script>
					<script src='http://assets.codepen.io/assets/common/stopExecutionOnTimeout.js?t=1'></script>
					<script src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
					<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
					<script>
					/*var $currentPopover = null;
					  $(document).on('shown.bs.popover', function (ev) {
					    var $target = $(ev.target);
					    if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
					      $currentPopover.popover('toggle');
					    }
					    $currentPopover = $target;
					  }).on('hidden.bs.popover', function (ev) {
					    var $target = $(ev.target);
					    if ($currentPopover && ($currentPopover.get(0) == $target.get(0))) {
					      $currentPopover = null;
					    }
					  });*/


					//quicktmpl is a simple template language I threw together a while ago; it is not remotely secure to xss and probably has plenty of bugs that I haven't considered, but it basically works
					//the design is a function I read in a blog post by John Resig (http://ejohn.org/blog/javascript-micro-templating/) and it is intended to be loosely translateable to a more comprehensive template language like mustache easily
					$.extend({
					    quicktmpl: function (template) {return new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+template.replace(/[\r\t\n]/g," ").split("{{").join("\t").replace(/((^|\}\})[^\t]*)'/g,"$1\r").replace(/\t:(.*?)\}\}/g,"',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'")+"');}return p.join('');")}
					});

					$.extend(Date.prototype, {
					  //provides a string that is _year_month_day, intended to be widely usable as a css class
					  toDateCssClass:  function () { 
					    return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate(); 
					  },
					  //this generates a number useful for comparing two dates; 
					  toDateInt: function () { 
					    return ((this.getFullYear()*12) + this.getMonth())*32 + this.getDate(); 
					  },
					  toTimeString: function() {
					    var hours = this.getHours(),
					        minutes = this.getMinutes(),
					        hour = (hours > 12) ? (hours - 12) : hours,
					        ampm = (hours >= 12) ? ' pm' : ' am';
					    if (hours === 0 && minutes===0) { return ''; }
					    if (minutes > 0) {
					      return hour + ':' + minutes + ampm;
					    }
					    return hour + ampm;
					  }
					});


					(function ($) {

					  //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
					  var t = $.quicktmpl($('#tmpl').get(0).innerHTML);
					  
					  function calendar($el, options) {
					    //actions aren't currently in the template, but could be added easily...
					    $el.on('click', '.js-cal-prev', function () {
					      switch(options.mode) {
					      case 'year': options.date.setFullYear(options.date.getFullYear() - 1); break;
					      case 'month': options.date.setMonth(options.date.getMonth() - 1); break;
					      case 'week': options.date.setDate(options.date.getDate() - 7); break;
					      case 'day':  options.date.setDate(options.date.getDate() - 1); break;
					      }
					      draw();
					    }).on('click', '.js-cal-next', function () {
					      switch(options.mode) {
					      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
					      case 'month': options.date.setMonth(options.date.getMonth() + 1); break;
					      case 'week': options.date.setDate(options.date.getDate() + 7); break;
					      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
					      }
					      draw();
					    }).on('click', '.js-cal-option', function () {
					      var $t = $(this), o = $t.data();
					      if (o.date) { o.date = new Date(o.date); }
					      $.extend(options, o);
					      draw();
					    }).on('click', '.js-cal-years', function () {
					      var $t = $(this), 
					          haspop = $t.data('popover'),
					          s = '', 
					          y = options.date.getFullYear() - 2, 
					          l = y + 5;
					      if (haspop) { return true; }
					      for (; y < l; y++) {
					        s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">'+y + '</button>';
					      }
					      $t.popover({content: s, html: true, placement: 'auto top'}).popover('toggle');
					      return false;
					    }).on('click', '.event', function () {
					      /*var $t = $(this), 
					          index = +($t.attr('data-index')), 
					          haspop = $t.data('popover'),
					          data, time;
					          
					      if (haspop || isNaN(index)) { return true; }
					      data = options.data[index];
					      time = data.start.toTimeString();
					      if (time && data.end) { time = time + ' - ' + data.end.toTimeString(); }
					      $t.data('popover',true);
					      $t.popover({content: '<p><strong>' + time + '</strong></p>'+data.text, html: true, placement: 'auto left'}).popover('toggle');
					      return false;*/
					    });
					    function dayAddEvent(index, event) {
					      if (!!event.allDay) {
					        monthAddEvent(index, event);
					        return;
					      }
					      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
					          start = event.start,
					          end = event.end || start,
					          time = event.start.toTimeString(),
					          hour = start.getHours(),
					          timeclass = '.time-22-0',
					          startint = start.toDateInt(),
					          dateint = options.date.toDateInt(),
					          endint = end.toDateInt();
					      if (startint > dateint || endint < dateint) { return; }
					      
					      if (!!time) {
					        $event.html('<strong>' + time + '</strong> ' + $event.html());
					      }
					      $event.toggleClass('begin', startint === dateint);
					      $event.toggleClass('end', endint === dateint);
					      if (hour < 6) {
					        timeclass = '.time-0-0';
					      }
					      if (hour < 22) {
					        timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
					      }
					      $(timeclass).append($event);
					    }
					    
					    function monthAddEvent(index, event) {
					      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
					          e = new Date(event.start),
					          dateclass = e.toDateCssClass(),
					          day = $('.' + e.toDateCssClass()),
					          empty = $('<div/>', {'class':'clear event', html:'&nbsp;'}), 
					          numbevents = 0, 
					          time = event.start.toTimeString(),
					          endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
					          checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate()+40),
					          existing,
					          i;
					      $event.toggleClass('all-day', !!event.allDay);
					      if (!!time) {
					        $event.html('<strong>' + time + '</strong> ' + $event.html());
					      }
					      if (!event.end) {
					        $event.addClass('begin end');				        
					        $('.' + event.start.toDateCssClass()).append($event);
					        $('.begin').parent('td').find('.date').addClass('absent');
					        return;
					      }
					            
					      while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
					        if(day.length) { 
					          existing = day.find('.event').length;
					          numbevents = Math.max(numbevents, existing);
					          for(i = 0; i < numbevents - existing; i++) {
					            day.append(empty.clone());
					          }
					          day.append(
					            $event.
					            toggleClass('begin', dateclass === event.start.toDateCssClass()).
					            toggleClass('end', dateclass === event.end.toDateCssClass())
					          );
					          $event = $event.clone();
					          $event.html('&nbsp;');
					        }
					        e.setDate(e.getDate() + 1);
					        dateclass = e.toDateCssClass();
					        day = $('.' + dateclass);
					      }
					    }
					    function yearAddEvents(events, year) {
					      var counts = [0,0,0,0,0,0,0,0,0,0,0,0];
					      $.each(events, function (i, v) {
					        if (v.start.getFullYear() === year) {
					            counts[v.start.getMonth()]++;
					        }
					      });
					      $.each(counts, function (i, v) {
					        if (v!==0) {
					            $('.month-'+i).append('<span class="badge badge-info">'+v+'</span>');
					        }
					      });
					    }
					    
					    function draw() {
					      $el.html(t(options));
					      //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
					      $('.' + (new Date()).toDateCssClass()).addClass('today');
					      if (options.data && options.data.length) {
					        if (options.mode === 'year') {
					            yearAddEvents(options.data, options.date.getFullYear());
					        } else if (options.mode === 'month' || options.mode === 'week') {
					            $.each(options.data, monthAddEvent);
					        } else {
					            $.each(options.data, dayAddEvent);
					        }
					      }
					    }
					    
					    draw();    
					  }
					  
					  ;(function (defaults, $, window, document) {
					    $.extend({
					      calendar: function (options) {
					        return $.extend(defaults, options);
					      }
					    }).fn.extend({
					      calendar: function (options) {
					        options = $.extend({}, defaults, options);
					        return $(this).each(function () {
					          var $this = $(this);
					          calendar($this, options);
					        });
					      }
					    });
					  })({
					    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
					    months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
					    shortMonths: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					    date: (new Date()),
					        daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
					        todayname: "Today",
					        thismonthcss: "current",
					        lastmonthcss: "outside",
					        nextmonthcss: "outside",
					    mode: "month",
					    data: []
					  }, jQuery, window, document);
					    
					})(jQuery);

					var data = [],
					    date = new Date(),
					    d = date.getDate(),
					    d1 = d,
					    m = date.getMonth(),
					    y = date.getFullYear(),
					    i,
					    end, 
					    j, 
					    c = 1063, 
					    c1 = 3329,
					    h, 
					    m,
					    names = ['All Day Event', 'Long Event', 'Birthday Party', 'Repeating Event', 'Training', 'Meeting', 'Mr. Behnke', 'Date', 'Ms. Tubbs'],
					    //slipsum = ["Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.", "Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.", "Yeah, I like animals better than people sometimes... Especially dogs. Dogs are the best. Every time you come home, they act like they haven't seen you in a year. And the good thing about dogs... is they got different dogs for different people. Like pit bulls. The dog of dogs. Pit bull can be the right man's best friend... or the wrong man's worst enemy. You going to give me a dog for a pet, give me a pit bull. Give me... Raoul. Right, Omar? Give me Raoul.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man."];
					    slipsum = ["", "", "", "", "", "", "", "", "", ""];

					  /*for(i = 0; i < 25; i++) {
					    j = Math.max(i % 15 - 10, 0);
					    //c and c1 jump around to provide an illusion of random data
					    c = (c * 1063) % 1061; 
					    c1 = (c1 * 3329) % 3331;
					    d = (d1 + c + c1) % 839 - 440;
					    h = i % 36;
					    m = (i % 4) * 15;
					    if (h < 18) { h = 0; m = 0; } else { h = Math.max(h - 24, 0) + 8; }
					    end = !j ? null : new Date(y, m, d + j, h + 2, m);
					    data.push({ title: names[c1 % names.length], start: new Date(y, m, d, h, m), end: end, allDay: !(i % 6), text: slipsum[ slipsum.length ]  });
					  }*/
					  <?php  		
						/*$attend_query = "SELECT * FROM StudentAbsent where StudentID=$studentId";6
						$attend_result = sqlsrv_query( $conn, $attend_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
					  
					    while($attend_row = sqlsrv_fetch_array($attend_result)){?>

					  	  //data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  //});

					  	//} ?>

					  	//data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  });

					  	<?php  	
						$attend_query = "SELECT DISTINCT FromDate FROM ITD_Holidays";
						$attend_result = sqlsrv_query( $conn, $attend_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
					  
					    while($attend_row = sqlsrv_fetch_array($attend_result)){
					    	$absent_date = date_format($attend_row['FromDate'], 'Y-m-d');
					    	$ab_year = explode('-',$absent_date);
					    	$mondecr = $ab_year['1'] - 1;
					    	?>

					  	  data.push({start: new Date(<?php echo $ab_year['0'];?>,<?php echo $mondecr;?>, <?php echo $ab_year['2'];?>) });
					  	  //data.push({ title: "Testing", start: new Date(2015, 07, 24, 8, 35), end: new Date(2015, 07, 26, 18, 35), allDay:0/*, text: slipsum[ slipsum.length ]*/  });

					  	<?php }?>
					  
					  data.sort(function(a,b) { return (+a.start) - (+b.start); });
					  
					//data must be sorted by start date

					//Actually do everything
					$('#holder').calendar({
					  data: data
					});
					//@ sourceURL=pen.js
					</script>

					<!-- Calendar Ends -->


		            <!-- Map box -->
		            <div class="box box-info">
						<div class="box-header">
							<i class="fa fa-envelope"></i>
							<h3 class="box-title">Quick Email</h3><hr>
							<!-- tools box -->
							<div class="pull-right box-tools">
								<!-- <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
							</div><!-- /. tools -->
						</div>
						<form name="mails" action="sendingmails.php" method="post">
							<div class="box-body">							
								<div class="form-group">
									<!-- <input type="email" class="form-control" name="emailto" placeholder="Email to:" /> -->
									<div class=" col-md-6">
										<div class="roundedOne">
									      <input type="checkbox" value="None" id="RegStudent" name="check" />
									      <label for="RegStudent"></label><div class="checkbox-text">All Reg. Students</div>
									    </div>
									</div>
									<div class=" col-md-6">
								    <div class="roundedOne">
									      <input type="checkbox" value="None" id="ScStudent" name="check" />
									      <label for="ScStudent"></label><div class="checkbox-text">All Reg. Students</div>
									    </div>
									</div>
								    <div class=" col-md-6">
								    <div class="roundedOne">
									      <input type="checkbox" value="None" id="RegInstuctors" name="check" />
									      <label for="RegInstuctors"></label><div class="checkbox-text">All Reg. Students</div>
									    </div>
									</div>
								    <div class=" col-md-6">
								    <div class="roundedOne">
									      <input type="checkbox" value="None" id="ItdInstructor" name="check" />
									      <label for="ItdInstructor"></label><div class="checkbox-text">All Reg. Students</div>
									    </div>
								    </div>
									<!-- <input type="checkbox" id="RegStudent" name="RegStudent">All Reg. Students<br> -->
									<!-- <input type="checkbox" id="ScStudent" name="ScStudent">All Short Course Students<br> -->
									<!-- <input type="checkbox" id="RegInstuctors" name="RegInstuctors">All Reg. Instructors<br> -->
									<!-- <input type="checkbox" id="ItdInstructor" name="ItdInstructor">All ITD Instuctors		<br>							 -->
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" />
								</div>
								<div>
									<textarea class="textarea" name="message" id="message" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
								</div>								
								<input type="hidden" class="form-control" name="adminID" id="adminID" value="Admin" /><!-- value="<?php echo $_SESSION['adminID'];?>" -->
							</div>
							<div class="box-footer clearfix">
								<input type="submit" class="pull-right btn btn-default fa fa-arrow-circle-right" id="sendEmail" name="Send" value="Send" />
							</div>
						</form>
					</div>
		            <!-- /.box -->

		            <div class="modal fade" id="myModal">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content" style="background-color:#18D4E4; border-radius:10px;">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel" style="color:#fff;">Oops Sorry..!</h4>
					      </div>
					      <div class="modal-body" align="center">
					        No Data Available
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color: #C3942E;border-radius: 7px;">Close</button>
					        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
					      </div>
					    </div>
					  </div>
					</div>

		             
		            </section><!-- right col -->
		          </div><!-- /.row (main row) -->

		        </section><!-- /.content -->
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
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
		<!-- Swcc App 
		<script src="dist/js/app.min.js" type="text/javascript"></script>-->
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
					
			<div class="nav-tabs-custom" style="display:none">
	            <!-- Tabs within a box -->
	            <ul class="nav nav-tabs pull-right">
	              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
	              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
	              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
	            </ul>
	            <div class="tab-content no-padding">
	              <!-- Morris chart - Sales -->
	              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
	              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
	            </div>
	          </div><!-- /.nav-tabs-custom -->

		<script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
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
<?php
	include('Admin_files/includes/footer.php');
?>
<script type="text/javascript" src="assets/dist/js/donut.js"></script>
