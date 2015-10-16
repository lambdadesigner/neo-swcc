<?php
  include('includes/database.php');
  if($_GET['type']=="Today"){
  $currentDay = $_GET['currentDay'];
  $year =date('Y');	
  ?>

<div class="">
<div class="box-heading">
  <div class="panel">
    <div class="panel-heading">
      <h4 class="panel-title"> <a href="#F">
        <table>
          <thead>
          <td class="hsino"> S No.</td>
            <td class="hname"> Student Name</td>
            <td class="hctno">Complaint No.</td>
            <td class="hbuild">Building</td>
            <td class="hblock">Block</td>
            <td class="hrno">Room No</td>
            <td class="hdep">Department</td>
            <td class="hstatus">Status</td>
              </thead>
        </table>
        </a> </h4>
    </div>
  </div>
</div>
<div class="box-body content complaintData">
<div class="panel-group panel-group-lists" id="accordion2">
<?php 
							   $Sql = "SELECT * FROM Complaints where  Complain_on ='".$currentDay."' " ;
							  $result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_count = sqlsrv_num_rows($result_Complaints);
							  if($Complaints_count >0){
							  $i=1;
							  while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							  
							  $sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							  $result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							  
						
						?>
<div class="panel <?php echo $Complaints['priority'];?>">
<div class="panel-heading">
  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
    <table>
      <thead>
      <td class="csino" style="width:39px;"><?php echo $i++;?></td>
        <td class="cname" style="width:93px;"><img src="assets/dist/img/student/mb.png"><?php echo substr($Complaints['Complain_By_Name'],0,12);?>...</td>
        <td class="cctno" style="width:98px;"><?php echo $Complaints['Complaint_No']?></td>
        <td class="cbuild" style="width:57px;"><?php echo  $Complaints_room['BuildingNo'];?></td>
        <td class="cblock" style="width:39px;"><?php echo $Complaints_room['Section'];?></td>
        <td class="crno" style="width:64px;"><?php echo $Complaints_room['RoomNo'];?></td>
        <td class="cdep" style="width:76px;"><?php echo $Complaints['Department'];?></td>
        <td class="cstatus" style="width:40px;"><i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?></td>
          </thead>
    </table>
    </a> </h4>
</div>
<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
<div class="panel-body">
<!-- <div class="formgroup">
																	  <label>Student Name</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Building</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Block</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Room No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Bed No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Department</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Priority</label>
																	  <div class="text">some name </div>
																  </div> -->
<div class="formgroup">
<label>Message</label>
<div class="text">
  <p> <?php echo $Complaints['Message'];?> </p>
</div>
<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<select name="UpdateStatus" id="UpdateStatus" onchange="return getComplaintId(this.value,<?php echo $Complaints['Complaint_ID'];?>)" >
<option value="">Select Status</option>
<option value="pending">Pending</option>
<option value="working">Working</option>
<option value="complete">Complete</option>
<select>
<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
</div>
</div>
</div>
<div class="panel-footer">
<div align="right">
<!--<button class="btn btn-primary" id="modifyStatus[]" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">
	  Modify
	  </button>-->
<button class="btn btn-warning" id="Reply" onClick="ShowReply(<?php echo $Complaints['Complaint_ID'];?>)">


	  Reply
	  

</button>
<button class="btn btn-danger" onclick="return deleteComplain(<?php echo $Complaints['Complaint_ID'];?>);">


	  Delete
	  

</button>
</div>
</div>
</div>
</div>
<?php }
							  }else{
								  echo "No Data Found"; 
								  }?>
</div>
</div>
</div>
<?php }	
  if($_GET['type']=="Month"){
  $currentMonth = $_GET['currentMonth'];
  $year =date('Y');	
  ?>
<div class="">
<div class="box-heading">
<div class="panel">
<div class="panel-heading">
<h4 class="panel-title">
<a href="#F">
<table>
<!-- <td class="hsino"> S No.</td> -->
<td class="hname">

      Student Name
      
</td>
<td class="hctno">

      Complaint No.
      
</td>
<td class="hbuild">

      Building
      
</td>
<!-- <td class="hblock">Block</td>
                                                                                                                        <td class="hrno">Room No</td> -->
<td class="hdep">

      Department
      
</td>
<td class="hstatus">

      Status
      
</td>
</table>
</a>
</h4>
</div>
</div>
</div>
<div class="box-body content complaintData">
<div class="panel-group panel-group-lists" id="accordion2">
<?php 
							   $Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$year."-".$currentMonth."-01' AND '".$year."-".$currentMonth."-31'";
							  $result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $i=1;
							  while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							  
							  $sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							  $result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							  
						
						?>
<div class="panel <?php echo $Complaints['priority'];?>">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
<table>
<tr>
<!-- <td class="csino"> <?php echo $i++;?></td> -->
<td class="cname" style="width: 103px;">
<img src="assets/dist/img/student/mb.png"> <?php echo substr($Complaints['Complain_By_Name'],0,12);?>... 

</td>
<td class="cctno" style="width: 103px;">
<?php echo strtolower($Complaints['Complaint_No']);?>
</td>
<td class="cbuild" style="width: 59px;">
<?php echo  $Complaints_room['BuildingNo'];?>
</td>
<!-- <td class="cblock"> <?php echo $Complaints_room['Section'];?></td>
																		  <td class="crno"> <?php echo $Complaints_room['RoomNo'];?></td> -->
<td class="cdep" style="width: 85px;">
<?php echo $Complaints['Department'];?>
</td>
<td class="cstatus" style="width: 47px;">
<i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?>
</td>
</tr>
</table>
</a>
</h4>
</div>
<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
<div class="panel-body">
<!-- <div class="formgroup">
																	  <label>Student Name</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Building</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Block</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Room No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Bed No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Department</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Priority</label>
																	  <div class="text">some name </div>
																  </div> -->
<div class="formgroup">
<div class="pull-right">
<div class="btn-group">
<a href="#" class="label bg-teal dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Status <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-menu-right">
<li>
<a href="#" onclick="return ChangeStatus('pending',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-info position-left"></span> Pending</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('working',<?php echo $Complaints['Complaint_ID'];?>);"><span class="status-mark bg-primary position-left"></span> Working</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('complete',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-primary position-left"></span> Complete</a>
</li>
</ul>
<input type="hidden" name="updstat" id="updstat" />
</div>
</div>
<div id="AddUpPending<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<button onclick="return UpdateComplainte(<?php echo $Complaints['Complaint_ID'];?>)">

Update Status

</button>
</div>
<label>

Message

</label>
<div class="text">
<p>
<?php echo $Complaints['Message'];?>
</p>
</div>
<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<select name="UpdateStatus" id="UpdateStatus" onchange="return getComplaintId(this.value,<?php echo $Complaints['Complaint_ID'];?>)" >
<option value="">Select Status</option>
<option value="pending">Pending</option>
<option value="working">Working</option>
<option value="complete">Complete</option>
<select>
<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
</div>
</div>
</div>
<div class="panel-footer">
<div align="right">
<!--<button class="btn btn-primary" id="modifyStatus[]" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">
	  Modify
	  </button>-->
<button class="btn btn-warning" id="Reply" onClick="ShowReply(<?php echo $Complaints['Complaint_ID'];?>)">


	  Reply
	  

</button>
<button class="btn btn-danger" onclick="return deleteComplain(<?php echo $Complaints['Complaint_ID'];?>);">


	  Delete
	  

</button>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<?php }			
  if($_GET['type']=="Year"){
  $currentYear = $_GET['currentYear'];
  $year =date('Y');
  ?>
<div class="">
<div class="box-heading">
<div class="panel">
<div class="panel-heading">
<h4 class="panel-title">
<a href="#F">
<table>
<thead>
<td class="hname">

 Student Name

</td>
<td class="hctno">

Complaint No.

</td>
<td class="hbuild">

Building

</td>
<td class="hdep">

Department

</td>
<td class="hstatus">

Status

</td>
</thead>
</table>
</a>
</h4>
</div>
</div>
</div>
<div class="box-body content complaintData">
<div class="panel-group panel-group-lists" id="accordion2">
<?php 
								$Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$year."-01-01' AND '".$year."-12-31'";
							  $result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $i=1;
							  while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							  
							  $sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							  $result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							  
						
						?>
<div class="panel <?php echo $Complaints['priority'];?>">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
<table>
<tr>
<!-- <td class="csino"> <?php echo $i++;?></td> -->
<td class="cname" style="width: 103px;">
<img src="assets/dist/img/student/mb.png"> <?php echo substr($Complaints['Complain_By_Name'],0,12);?>... 

</td>
<td class="cctno" style="width: 103px;">
<?php echo strtolower($Complaints['Complaint_No']);?>
</td>
<td class="cbuild" style="width: 59px;">
<?php echo  $Complaints_room['BuildingNo'];?>
</td>
<!-- <td class="cblock"> <?php echo $Complaints_room['Section'];?></td>
																		  <td class="crno"> <?php echo $Complaints_room['RoomNo'];?></td> -->
<td class="cdep" style="width: 85px;">
<?php echo $Complaints['Department'];?>
</td>
<td class="cstatus" style="width: 47px;">
<i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?>
</td>
</tr>
</table>
</a>
</h4>
</div>
<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
<div class="panel-body">
<!-- <div class="formgroup">
																	  <label>Student Name</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Building</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Block</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Room No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Bed No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Department</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Priority</label>
																	  <div class="text">some name </div>
																  </div> -->
<div class="formgroup">
<div class="pull-right">
<div class="btn-group">
<a href="#" class="label bg-teal dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Status <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-menu-right">
<li>
<a href="#" onclick="return ChangeStatus('pending',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-info position-left"></span> Pending</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('working',<?php echo $Complaints['Complaint_ID'];?>);"><span class="status-mark bg-primary position-left"></span> Working</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('complete',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-primary position-left"></span> Complete</a>
</li>
</ul>
<input type="hidden" name="updstat" id="updstat" />
</div>
</div>
<div id="AddUpPending<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<button onclick="return UpdateComplainte(<?php echo $Complaints['Complaint_ID'];?>)">

Update Status

</button>
</div>
<label>

Message

</label>
<div class="text">
<p>
<?php echo $Complaints['Message'];?>
</p>
</div>
<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<select name="UpdateStatus" id="UpdateStatus" onchange="return getComplaintId(this.value,<?php echo $Complaints['Complaint_ID'];?>)" >
<option value="">Select Status</option>
<option value="pending">Pending</option>
<option value="working">Working</option>
<option value="complete">Complete</option>
<select>
<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
</div>
</div>
</div>
<div class="panel-footer">
<div align="right">
<!--<button class="btn btn-primary" id="modifyStatus[]" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">
	  Modify
	  </button>-->
<button class="btn btn-warning" id="Reply" onClick="ShowReply(<?php echo $Complaints['Complaint_ID'];?>)">


	  Reply
	  

</button>
<button class="btn btn-danger" onclick="return deleteComplain(<?php echo $Complaints['Complaint_ID'];?>);">


	  Delete
	  

</button>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<?php }
  if($_GET['type']=="ComplaintStatus"){
  $Status = $_GET['Status'];
  $Complaint_No = $_GET['Complaint_No'];	
  $sql = "UPDATE Complaints SET Status='".$Status."' WHERE Complaint_ID='".$Complaint_No."'"; 
  $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));		
	  }
  if($_GET['type']=="monthly" && $_GET['months'] ==1){
  
  $month = date('m')-1;
  $year = date('Y');
  if($month < 10)
  {
	  $month= '0'.$month;
  }
	
  ?>
<div class="">
<div class="box-heading">
<div class="panel">
<div class="panel-heading">
<h4 class="panel-title">
<a href="#F">
<table>
<thead>
<td class="hname">

 Student Name

</td>
<td class="hctno">

Complaint No.

</td>
<td class="hbuild">

Building

</td>
<td class="hdep">

Department

</td>
<td class="hstatus">

Status

</td>
</thead>
</table>
</a>
</h4>
</div>
</div>
</div>
<div class="box-body content complaintData">
<div class="panel-group panel-group-lists" id="accordion2">
<?php 
							  $Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$year."-".$month."-01' AND '".$year."-".$month."-31'";
							  $result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $i=1;
							  while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							  
							  $sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							  $result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							  
						
						?>
<div class="panel <?php echo $Complaints['priority'];?>">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
<table>
<tr>
<!-- <td class="csino"> <?php echo $i++;?></td> -->
<td class="cname" style="width: 103px;">
<img src="assets/dist/img/student/mb.png"> <?php echo substr($Complaints['Complain_By_Name'],0,12);?>... 

</td>
<td class="cctno" style="width: 103px;">
<?php echo strtolower($Complaints['Complaint_No']);?>
</td>
<td class="cbuild" style="width: 59px;">
<?php echo  $Complaints_room['BuildingNo'];?>
</td>
<!-- <td class="cblock"> <?php echo $Complaints_room['Section'];?></td>
																		  <td class="crno"> <?php echo $Complaints_room['RoomNo'];?></td> -->
<td class="cdep" style="width: 85px;">
<?php echo $Complaints['Department'];?>
</td>
<td class="cstatus" style="width: 47px;">
<i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?>
</td>
</tr>
</table>
</a>
</h4>
</div>
<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
<div class="panel-body">
<!-- <div class="formgroup">
																	  <label>Student Name</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Building</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Block</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Room No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Bed No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Department</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Priority</label>
																	  <div class="text">some name </div>
																  </div> -->
<div class="formgroup">
<div class="pull-right">
<div class="btn-group">
<a href="#" class="label bg-teal dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Status <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-menu-right">
<li>
<a href="#" onclick="return ChangeStatus('pending',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-info position-left"></span> Pending</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('working',<?php echo $Complaints['Complaint_ID'];?>);"><span class="status-mark bg-primary position-left"></span> Working</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('complete',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-primary position-left"></span> Complete</a>
</li>
</ul>
<input type="hidden" name="updstat" id="updstat" />
</div>
</div>
<div id="AddUpPending<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<button onclick="return UpdateComplainte(<?php echo $Complaints['Complaint_ID'];?>)">

Update Status

</button>
</div>
<label>

Message

</label>
<div class="text">
<p>
<?php echo $Complaints['Message'];?>
</p>
</div>
<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;" >
<select name="UpdateStatus" id="UpdateStatus" onchange="return getComplaintId(this.value,<?php echo $Complaints['Complaint_ID'];?>)" >
<option value="">Select Status</option>
<option value="pending">Pending</option>
<option value="working">Working</option>
<option value="complete">Complete</option>
<select>
<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
</div>
</div>
</div>
<div class="panel-footer">
<div align="right">
<!--<button class="btn btn-primary" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">Modify</button>-->
<button class="btn btn-warning">

Reply

</button>
<button class="btn btn-danger">

Delete

</button>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<?php }	
  if($_GET['type']=="monthly" && $_GET['months'] ==3){
  
  
  
  $month = date("Y-m",strtotime("-3 Months"));
  
  $month1 = date("Y-m",strtotime("-1 Months"));
  
  ?>
<div class="">
<div class="box-heading">
<div class="panel">
<div class="panel-heading">
<h4 class="panel-title">
<a href="#F">
<table>
<thead>
<td class="hname">

 Student Name

</td>
<td class="hctno">

Complaint No.

</td>
<td class="hbuild">

Building

</td>
<td class="hdep">

Department

</td>
<td class="hstatus">

Status

</td>
</thead>
</table>
</a>
</h4>
</div>
</div>
</div>
<div class="box-body content complaintData">
<div class="panel-group panel-group-lists" id="accordion2">
<?php 
							  $Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$month."-01' AND '".$month1."-31'";
							  $result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $i=1;
							  while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							  
							  $sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							  $result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							  
						
						?>
<div class="panel <?php echo $Complaints['priority'];?>">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
<table>
<tr>
<!-- <td class="csino"> <?php echo $i++;?></td> -->
<td class="cname" style="width: 103px;">
<img src="assets/dist/img/student/mb.png"> <?php echo substr($Complaints['Complain_By_Name'],0,12);?>... 

</td>
<td class="cctno" style="width: 103px;">
<?php echo strtolower($Complaints['Complaint_No']);?>
</td>
<td class="cbuild" style="width: 59px;">
<?php echo  $Complaints_room['BuildingNo'];?>
</td>
<!-- <td class="cblock"> <?php echo $Complaints_room['Section'];?></td>
																		  <td class="crno"> <?php echo $Complaints_room['RoomNo'];?></td> -->
<td class="cdep" style="width: 85px;">
<?php echo $Complaints['Department'];?>
</td>
<td class="cstatus" style="width: 47px;">
<i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?>
</td>
</tr>
</table>
</a>
</h4>
</div>
<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
<div class="panel-body">
<!-- <div class="formgroup">
																	  <label>Student Name</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Building</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Block</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Room No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Bed No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Department</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Priority</label>
																	  <div class="text">some name </div>
																  </div> -->
<div class="formgroup">
<div class="pull-right">
<div class="btn-group">
<a href="#" class="label bg-teal dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Status <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-menu-right">
<li>
<a href="#" onclick="return ChangeStatus('pending',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-info position-left"></span> Pending</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('working',<?php echo $Complaints['Complaint_ID'];?>);"><span class="status-mark bg-primary position-left"></span> Working</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('complete',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-primary position-left"></span> Complete</a>
</li>
</ul>
<input type="hidden" name="updstat" id="updstat" />
</div>
</div>
<div id="AddUpPending<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<button onclick="return UpdateComplainte(<?php echo $Complaints['Complaint_ID'];?>)">

Update Status

</button>
</div>
<label>

Message

</label>
<div class="text">
<p>
<?php echo $Complaints['Message'];?>
</p>
</div>
<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<select name="UpdateStatus" id="UpdateStatus" onchange="return getComplaintId(this.value,<?php echo $Complaints['Complaint_ID'];?>)" >
<option value="">Select Status</option>
<option value="pending">Pending</option>
<option value="working">Working</option>
<option value="complete">Complete</option>
<select>
<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
</div>
</div>
</div>
<div class="panel-footer">
<div align="right">
<!--<button class="btn btn-primary" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">Modify</button>-->
<button class="btn btn-warning">

Reply

</button>
<button class="btn btn-danger">

Delete

</button>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<?php }	
  if($_GET['type']=="monthly" && $_GET['months'] ==6){
  
  $month = date("Y-m",strtotime("-6 Months"));
  
  $month1 = date("Y-m",strtotime("-1 Months"));
  ?>
<div class="">
<div class="box-heading">
<div class="panel">
<div class="panel-heading">
<h4 class="panel-title">
<a href="#F">
<table>
<thead>
<td class="hname">

 Student Name

</td>
<td class="hctno">

Complaint No.

</td>
<td class="hbuild">

Building

</td>
<td class="hdep">

Department

</td>
<td class="hstatus">

Status

</td>
</thead>
</table>
</a>
</h4>
</div>
</div>
</div>
<div class="box-body content complaintData">
<div class="panel-group panel-group-lists" id="accordion2">
<?php 
							  $Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$month."-01' AND '".$month1."-31'";
							  $result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $i=1;
							  while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							  
							  $sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							  $result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							  
						
						?>
<div class="panel <?php echo $Complaints['priority'];?>">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
<table>
<tr>
<!-- <td class="csino"> <?php echo $i++;?></td> -->
<td class="cname" style="width: 103px;">
<img src="assets/dist/img/student/mb.png"> <?php echo substr($Complaints['Complain_By_Name'],0,12);?>... 

</td>
<td class="cctno" style="width: 103px;">
<?php echo strtolower($Complaints['Complaint_No']);?>
</td>
<td class="cbuild" style="width: 59px;">
<?php echo  $Complaints_room['BuildingNo'];?>
</td>
<!-- <td class="cblock"> <?php echo $Complaints_room['Section'];?></td>
																		  <td class="crno"> <?php echo $Complaints_room['RoomNo'];?></td> -->
<td class="cdep" style="width: 85px;">
<?php echo $Complaints['Department'];?>
</td>
<td class="cstatus" style="width: 47px;">
<i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?>
</td>
</tr>
</table>
</a>
</h4>
</div>
<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
<div class="panel-body">
<!-- <div class="formgroup">
																	  <label>Student Name</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Building</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Block</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Room No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Bed No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Department</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Priority</label>
																	  <div class="text">some name </div>
																  </div> -->
<div class="formgroup">
<div class="pull-right">
<div class="btn-group">
<a href="#" class="label bg-teal dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Status <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-menu-right">
<li>
<a href="#" onclick="return ChangeStatus('pending',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-info position-left"></span> Pending</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('working',<?php echo $Complaints['Complaint_ID'];?>);"><span class="status-mark bg-primary position-left"></span> Working</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('complete',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-primary position-left"></span> Complete</a>
</li>
</ul>
<input type="hidden" name="updstat" id="updstat" />
</div>
</div>
<div id="AddUpPending<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<button onclick="return UpdateComplainte(<?php echo $Complaints['Complaint_ID'];?>)">

Update Status

</button>
</div>
<label>

Message

</label>
<div class="text">
<p>
<?php echo $Complaints['Message'];?>
</p>
</div>
<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<select name="UpdateStatus" id="UpdateStatus" onchange="return getComplaintId(this.value,<?php echo $Complaints['Complaint_ID'];?>)" >
<option value="">Select Status</option>
<option value="pending">Pending</option>
<option value="working">Working</option>
<option value="complete">Complete</option>
<select>
<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
</div>
</div>
</div>
<div class="panel-footer">
<div align="right">
<!--<button class="btn btn-primary" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">Modify</button>-->
<button class="btn btn-warning">

Reply

</button>
<button class="btn btn-danger">

Delete

</button>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<?php }
  if($_GET['type']=="monthly" && $_GET['months'] ==12){	
  $month = date("Y-m",strtotime("-12 Months"));
  
  $month1 = date("Y-m",strtotime("-1 Months"));
  
  ?>
<div class="">
<div class="box-heading">
<div class="panel">
<div class="panel-heading">
<h4 class="panel-title">
<a href="#F">
<table>
<thead>
<td class="hname">

 Student Name

</td>
<td class="hctno">

Complaint No.

</td>
<td class="hbuild">

Building

</td>
<td class="hdep">

Department

</td>
<td class="hstatus">

Status

</td>
</thead>
</table>
</a>
</h4>
</div>
</div>
</div>
<div class="box-body content complaintData">
<div class="panel-group panel-group-lists" id="accordion2">
<?php 
							  $Sql = "SELECT * FROM Complaints where  Complain_on BETWEEN '".$month."-01' AND '".$month1."-31'";
							  $result_Complaints = sqlsrv_query( $conn, $Sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $i=1;
							  while($Complaints = sqlsrv_fetch_array($result_Complaints)){ 
							  
							  $sql_Complaints_building="SELECT BuildingNo,Section,RoomNo FROM BachelorAcc where Candidate_1 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."' OR Candidate_2 ='".$Complaints['Complain_By']."'";
							  $result_Complaints_building = sqlsrv_query( $conn, $sql_Complaints_building ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
							  $Complaints_room = sqlsrv_fetch_array($result_Complaints_building);
							  
						
						?>
<div class="panel <?php echo $Complaints['priority'];?>">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $Complaints['Complaint_ID']?>">
<table>
<tr>
<!-- <td class="csino"> <?php echo $i++;?></td> -->
<td class="cname" style="width: 103px;">
<img src="assets/dist/img/student/mb.png"> <?php echo substr($Complaints['Complain_By_Name'],0,12);?>... 

</td>
<td class="cctno" style="width: 103px;">
<?php echo strtolower($Complaints['Complaint_No']);?>
</td>
<td class="cbuild" style="width: 59px;">
<?php echo  $Complaints_room['BuildingNo'];?>
</td>
<!-- <td class="cblock"> <?php echo $Complaints_room['Section'];?></td>
																		  <td class="crno"> <?php echo $Complaints_room['RoomNo'];?></td> -->
<td class="cdep" style="width: 85px;">
<?php echo $Complaints['Department'];?>
</td>
<td class="cstatus" style="width: 47px;">
<i class="fa fa-hourglass-2"></i> <?php echo $Complaints['Status'];?>
</td>
</tr>
</table>
</a>
</h4>
</div>
<div id="<?php echo $Complaints['Complaint_ID']?>" class="panel-collapse collapse">
<div class="panel-body">
<!-- <div class="formgroup">
																	  <label>Student Name</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Building</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Block</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Room No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Bed No.</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Department</label>
																	  <div class="text">some name </div>
																  </div>
																  <div class="formgroup">
																	  <label>Priority</label>
																	  <div class="text">some name </div>
																  </div> -->
<div class="formgroup">
<div class="pull-right">
<div class="btn-group">
<a href="#" class="label bg-teal dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Status <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-menu-right">
<li>
<a href="#" onclick="return ChangeStatus('pending',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-info position-left"></span> Pending</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('working',<?php echo $Complaints['Complaint_ID'];?>);"><span class="status-mark bg-primary position-left"></span> Working</a>
</li>
<li>
<a href="#" onclick="return ChangeStatus('complete',<?php echo $Complaints['Complaint_ID'];?>)"><span class="status-mark bg-primary position-left"></span> Complete</a>
</li>
</ul>
<input type="hidden" name="updstat" id="updstat" />
</div>
</div>
<div id="AddUpPending<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<button onclick="return UpdateComplainte(<?php echo $Complaints['Complaint_ID'];?>)">

Update Status

</button>
</div>
<label>

Message

</label>
<div class="text">
<p>
<?php echo $Complaints['Message'];?>
</p>
</div>
<div id="selectStatus<?php echo $Complaints['Complaint_ID'];?>" style="display:none;">
<select name="UpdateStatus" id="UpdateStatus" onchange="return getComplaintId(this.value,<?php echo $Complaints['Complaint_ID'];?>)" >
<option value="">Select Status</option>
<option value="pending">Pending</option>
<option value="working">Working</option>
<option value="complete">Complete</option>
<select>
<input type="hidden" name="Complaint_No" id="Complaint_No" value="<?php echo $Complaints['Complaint_No']?>">
</div>
</div>
</div>
<div class="panel-footer">
<div align="right">
<!--<button class="btn btn-primary" onClick="ShowStatus(<?php echo $Complaints['Complaint_ID'];?>)">Modify</button>-->
<button class="btn btn-warning">

Reply

</button>
<button class="btn btn-danger">

Delete

</button>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<?php }		
  
  
	  
  ?>