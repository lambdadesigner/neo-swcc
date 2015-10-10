<?php
include('../includes/database.php');

if($_GET['Candi']=="Student")
{

 $StudenId = $_GET['studentId'];
 $AbstDate = date("Y-m-d",strtotime($_GET['AbsentDate']));  
 $ToDate = date("Y-m-d",strtotime($_GET['ToDate']));  

 //$sql = "SELECT * FROM StudentAbsent WHERE StudentID ='$StudenId' AND DateAbsent between '$AbstDate' AND '$ToDate'"; 
 $sql = "SELECT StudentAbsent.StudentID,StudentAbsent.DateAbsent,StudentAbsent.Reason,StudentAbsent.Module,StudentAbsent.Status,Module.ModuleID,Module.ModuleName,StudentInfo.StudentName_en FROM StudentAbsent INNER JOIN Module on StudentAbsent.StudentID ='$StudenId' AND StudentAbsent.DateAbsent between '$AbstDate' AND '$ToDate' AND StudentAbsent.Module=Module.ModuleID INNER JOIN StudentInfo ON StudentInfo.StudentID=StudentAbsent.StudentID"; 
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
 $row_count = sqlsrv_num_rows($result);

 if($row_count > 0){?>

    <div class="panel-body border"> 
      <table class="table table-striped" id="marks">
        <thead>        
          <tr style="background-color:#3C8DBC; color:#fff;">                                
            <th>S.No</th>
            <th><input type="text" class="form-control" placeholder="Student ID" ></th>
            <th><input type="text" class="form-control" placeholder="Student Name" ></th>
            <th><input type="text" class="form-control" placeholder="Absent On" ></th>
            <th><input type="text" class="form-control" placeholder="Module ID" ></th>
            <th><input type="text" class="form-control" placeholder="Module Name" ></th>
            <th><input type="text" class="form-control" placeholder="Status" ></th>
            <th><input type="text" class="form-control" placeholder="Reason" ></th>
  		      <th>Edit</th>	
          </tr>
        </thead>
        <tbody>
        <?php $ii =1;while($row = sqlsrv_fetch_array($result)){ ?>
          <tr>
            <td><?php echo $ii;?></td>
            <td><?php echo $row['StudentID']?></td>
            <td><?php echo $row['StudentName_en']?></td>
            <td><?php echo date_format($row['DateAbsent'],"d-m-Y");?></td>
            <td><?php echo $row['ModuleID']?></td>
            <td><?php echo $row['ModuleName']?></td>
            <td><?php echo $row['Status']?></td>          
            <td><?php echo $row['Reason']?></td>
  		  <td><a href="AdminUpdateAttendance?action=Edit&stuID=<?php echo $row['StudentID'];?>" style="cursor:pointer"> <i class="fa fa-edit"></i></a></td> 	
          </tr>
        <?php $ii++; }?>
        </tbody>
      </table>
    </div>

 <?php }else{	?>

    <table class="table table-striped" id="marks">
      <thead>        
        <tr style="background-color:#3C8DBC;">                                
          <th>S.No</th>
          <th><input type="text" class="form-control" placeholder="Student ID" ></th>
          <th><input type="text" class="form-control" placeholder="Absent On" ></th>
          <th><input type="text" class="form-control" placeholder="Module" ></th>
          <th><input type="text" class="form-control" placeholder="Status" ></th>          
        </tr>
      </thead>
      <tbody>      
        <tr>
          <td colspan="6" align="center" style="padding:40px;">No Data Found</td>          
        </tr>      
      </tbody>
    </table>
<?php }			
}


if($_GET['Candi']=="Instructor")
{
  $InstrucId = $_GET['InstructorId'];
  $InstrAbstDate = date("Y-m-d",strtotime($_GET['InstrAbsentDate']));  
  $InstrToDate = date("Y-m-d",strtotime($_GET['InstrToDate']));  

  $Inssql = "SELECT AttendanceDelegation.OriginalInstructor,AttendanceDelegation.SubstituteInstructor,AttendanceDelegation.ClassDate,Instructors.InstructorName FROM AttendanceDelegation INNER JOIN Instructors ON AttendanceDelegation.OriginalInstructor ='$InstrucId' AND AttendanceDelegation.ClassDate between '$InstrAbstDate' AND '$InstrToDate' AND AttendanceDelegation.OriginalInstructor =Instructors.InstructorID"; 
  $Insresult = sqlsrv_query( $conn, $Inssql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
  $Insrow_count = sqlsrv_num_rows($Insresult);

  if($Insrow_count > 0){?>
    <table class="table table-striped" id="marks">
      <thead>        
        <tr style="background-color:#3C8DBC; color:#fff;">                                
          <th>S.No</th>
          <th><input type="text" class="form-control" placeholder="Instructor ID" ></th>
          <th><input type="text" class="form-control" placeholder="Instructor Name" ></th>
          <th><input type="text" class="form-control" placeholder="Substitue Instructor ID" ></th>
          <th><input type="text" class="form-control" placeholder="Substitue Instructor Name" ></th>
          <th><input type="text" class="form-control" placeholder="Absent On" ></th>
		  <th>Edit</th>
        </tr>
      </thead>
      <tbody>
      <?php $ii =1;while($Inss_row = sqlsrv_fetch_array($Insresult)){ ?>
        <tr>
          <td><?php echo $ii;?></td>
          <td><?php echo $Inss_row['OriginalInstructor']?></td>
          <td><?php echo $Inss_row['InstructorName']?></td>
          <td><?php echo $Inss_row['SubstituteInstructor']?></td>
            <?php $subsid = $Inss_row['SubstituteInstructor'];
              $Inssql11 = "SELECT InstructorName FROM Instructors WHERE InstructorID='$subsid'"; 
              $Insresult11 = sqlsrv_query( $conn, $Inssql11 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET )); 
              $Inssr_row = sqlsrv_fetch_array($Insresult11)?>          
            <td><?php echo $Inssr_row['InstructorName']?></td>          

          <td><?php echo date_format($Inss_row['ClassDate'],"d-m-Y");?></td>
			<td><a href="AdminUpdateAttendance?action=Edit&InsID=<?php echo $Inss_row['OriginalInstructor'];?>" style="cursor:pointer"> <i class="fa fa-edit"></i></a></td>
        </tr>
      <?php $ii++; }?>
      </tbody>
    </table>

  <?php }else{ ?>

    <table class="table table-striped" id="marks">
      <thead>        
        <tr style="background-color:#3C8DBC;">                                
          <th>S.No</th>
          <th><input type="text" class="form-control" placeholder="Student ID" ></th>
          <th><input type="text" class="form-control" placeholder="Absent On" ></th>
          <th><input type="text" class="form-control" placeholder="Module" ></th>
          <th><input type="text" class="form-control" placeholder="Status" ></th>          
        </tr>
      </thead>
      <tbody>      
        <tr>
          <td colspan="6" align="center" style="padding:40px;">No Data Found</td>          
        </tr>      
      </tbody>
    </table>
  <?php }     


}
if($_GET['Candi']=="StudentAttendance"){
$StudentID = $_GET['StudentID'];
$DateAbsent = $_GET['StuAttDate'];
$Module = $_GET['Module'];
$StudentClass = $_GET['StudentClass'];
$Status = $_GET['Status'];
$Reason = $_GET['Reason'];
$Cycle = $_GET['Cycle'];
 $sql = "INSERT INTO StudentAbsent (StudentID,DateAbsent,Module,StudentClass,Status,Reason,Cycle) VALUES('".$StudentID."','".$DateAbsent."','".$Module."','".$StudentClass."','".$Status."','".$Reason."','".$Cycle."')"; 
     $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	
}
if($_GET['Candi']=="InstructorsAttendance"){
$OriginalInstructor = $_GET['OriginalInstructor'];
$SubstituteInstructor = $_GET['SubstituteInstructor'];
$insAttDate = $_GET['insAttDate'];
$ClassSession = $_GET['ClassSession'];

 $sql = "INSERT INTO AttendanceDelegation (OriginalInstructor,SubstituteInstructor,ClassDate,ClassSession) VALUES('".$OriginalInstructor."','".$SubstituteInstructor."','".$insAttDate."','".$ClassSession."')"; 
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	
}


if($_GET['Candi']=="ScStudent")
{

 $StudenId = $_GET['ScStudentID'];
 $AbstDate = date("Y-m-d",strtotime($_GET['SCStuFromDate']));  
 $ToDate = date("Y-m-d",strtotime($_GET['SCStuToDate']));  

 $sql = "SELECT * FROM SCAttendance WHERE EmpID ='$StudenId' AND AttendanceDate between '$AbstDate' AND '$ToDate'"; 
 //$sql = "SELECT StudentAbsent.StudentID,StudentAbsent.DateAbsent,StudentAbsent.Reason,StudentAbsent.Module,StudentAbsent.Status,Module.ModuleID,Module.ModuleName,StudentInfo.StudentName_en FROM StudentAbsent INNER JOIN Module on StudentAbsent.StudentID ='$StudenId' AND StudentAbsent.DateAbsent between '$AbstDate' AND '$ToDate' AND StudentAbsent.Module=Module.ModuleID INNER JOIN StudentInfo ON StudentInfo.StudentID=StudentAbsent.StudentID"; 
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
 $row_count = sqlsrv_num_rows($result);

 if($row_count > 0){?>
    <table class="table table-striped" id="marks">
      <thead>        
        <tr style="background-color:#3C8DBC; color:#fff;">                                
          <th>S.No</th>
          <th><input type="text" class="form-control" placeholder="Employee ID" ></th>
          <th><input type="text" class="form-control" placeholder="Student ID" ></th>
          <th><input type="text" class="form-control" placeholder="Attendance Date" ></th>
          <th><input type="text" class="form-control" placeholder="Attendance Status" ></th>
          <th><input type="text" class="form-control" placeholder="Reason" ></th>
          <th><input type="text" class="form-control" placeholder="SCClass" ></th>
		  <th>Edit</th>
                
        </tr>
      </thead>
      <tbody>
      <?php $ii =1;while($row = sqlsrv_fetch_array($result)){ ?>
        <tr>
          <td><?php echo $ii;?></td>
          <td><?php echo $row['EmpID']?></td>
          <td><?php echo $row['SCID']?></td>
          <td><?php echo date_format($row['AttendanceDate'],"Y-m-d");?></td>
          <td><?php echo $row['AttendanceStatus']?></td>
          <td><?php echo $row['Reason']?></td>
          <td><?php echo $row['SCClass']?></td>          
           <td><a href="AdminUpdateAttendance?action=Edit&SCstuID=<?php echo $row['EmpID'];?>" style="cursor:pointer"> <i class="fa fa-edit"></i></a></td>        
        </tr>
      <?php $ii++; }?>
      </tbody>
    </table>

 <?php }else{	?>

    <table class="table table-striped" id="marks">
      <thead>        
        <tr style="background-color:#3C8DBC;">                                
          <th>S.No</th>
          <th><input type="text" class="form-control" placeholder="Employee ID"></th>
          <th><input type="text" class="form-control" placeholder="Student ID"></th>
          <th><input type="text" class="form-control" placeholder="Attendance Date"></th>
          <th><input type="text" class="form-control" placeholder="Attendance Status"></th>
          <th><input type="text" class="form-control" placeholder="Reason"></th>
          <th><input type="text" class="form-control" placeholder="SCClass"></th>         
        </tr>
      </thead>
      <tbody>      
        <tr>
          <td colspan="6" align="center" style="padding:40px;">No Data Found</td>          
        </tr>      
      </tbody>
    </table>
<?php }			
}

if($_GET['Candi']=="ScStudentCourse")
{
$employeeID = $_GET['employeeID'];	
$sql = "SELECT ShortCourse.SCSubject,ShortCourse.SCID FROM ShortCourse INNER JOIN SCStudent ON  SCStudent.SCID =ShortCourse.SCID AND SCStudent.EmpID='$employeeID'";
$result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));?>

<select name="ShortCourse" id="ShortCourse">
					                                		<option value="">Select Course</option>
															<?php 
															//$sql = "SELECT SCID,SCSubject FROM ShortCourse";
															//$result_ScCourse = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
															while($course_row = sqlsrv_fetch_array($result)){ //while($row_ScCourse = sqlsrv_fetch_array($result_ScCourse)){ ?>
															<option value="<?php echo $course_row['SCID']?>"><?php echo $course_row['SCSubject']?></option>
															<?php }?>
															
					                                	</select><?php
}

if($_GET['Candi']=="ScAttendanceSave"){
	
$employeeId = $_GET['employeeId'];
$ShortCourse = $_GET['ShortCourse'];
$ScAttDate = $_GET['ScAttDate'];
$ScStatus = $_GET['ScStatus'];
$ScReason = $_GET['ScReason'];
$SCClass = $_GET['SCClass'];
	
$sql = "INSERT INTO SCAttendance (EmpID,SCID,AttendanceDate,AttendanceStatus,Reason,SCClass) VALUES('".$employeeId."','".$ShortCourse."','".$ScAttDate."','".$ScStatus."','".$ScReason."','".$SCClass."')"; 
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	
	
}



?>