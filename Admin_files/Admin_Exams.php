<?php
include('../includes/database.php');
  $module = $_GET['module'];
  $testId = $_GET['testId'];
  $testName = $_GET['testName'];
  $CycleId = $_GET['CycleId'];  
  $MaxMarks = $_GET['MaxMarks'];

 $sql = "SELECT * FROM Tests WHERE TestID ='.$testId.'";
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
 $row_count = sqlsrv_num_rows($result);
 if($row_count > 0){
	 echo "Exam Already Added";
 }else{
	 echo $sql = "INSERT INTO Tests (TestID,ModuleID,CycleID,MaxMarks,TestName) VALUES('".$testId."','".$module."','".$CycleId."','".$MaxMarks."','".$testName."')"; //exit;
     $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 echo "Examination Added successfully";
 }
				
?>