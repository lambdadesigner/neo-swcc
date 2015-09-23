<?php
include('Admin_files/includes/header.php');
$AdminId = $_SESSION['AdminId'];
$AdminUserName = $_SESSION['AdminUserName'];
  $SCID = $_GET['SCID'];
  $EmpID = $_GET['EmpID'];
  $Attendance = $_GET['Attendance'];
  $Activities=$_GET['Activities'];
  $Participation = $_GET['Participation'];
  $Exam = $_GET['Exam'];
  
  echo $sql = "INSERT INTO SCMarks (SCID,EmpID,Attendance,Activities,Participation,Exam) VALUES('".$SCID."','".$EmpID."','".$Attendance."','".$Activities."','".$Participation."','".$Exam."')";
     $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

?>