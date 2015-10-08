<?php
include('Admin_files/includes/header.php');
$AdminId = $_SESSION['AdminId'];
$AdminUserName = $_SESSION['AdminUserName'];
  $TestID = $_GET['TestID'];
  $StudentID = $_GET['StudentID'];
  $Marks = $_GET['Marks'];
  $UserID=$_GET['UserID'];
  $InstructorID = $_GET['InstructorID'];
  
   $sql = "INSERT INTO Marks (TestID,StudentID,Marks,UserID,InstructorID,EnteredBy) VALUES('".$TestID."','".$StudentID."','".$Marks."','".$UserID."','".$InstructorID."','".$AdminId."')";
     $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

?>