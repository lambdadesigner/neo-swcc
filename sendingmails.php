<?php
error_reporting(0);
include('includes/database.php');

date_default_timezone_set("Asia/Kolkata");
$currtime = date("Y-m-d h:i:sa");

if($_POST['RegStudent']=="on")
{
	$RStu_query = "SELECT StudentID FROM StudentInfo";
    $RStu_result = sqlsrv_query( $conn, $RStu_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

    while($RStu_data = sqlsrv_fetch_array($RStu_result)){
    	$SIds = $RStu_data['StudentID'];
    	$ssd .= $SIds.',';
    }
}
if($_POST['ScStudent']=="on")
{
	$ScStu_query = "SELECT EmpID FROM SCStudentInfo";
    $ScStu_result = sqlsrv_query( $conn, $ScStu_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

    while($ScStu_data = sqlsrv_fetch_array($ScStu_result)){
    	$ScIds = $ScStu_data['EmpID'];
    	$ssd .= $ScIds.',';
    }
}
if($_POST['RegInstuctors']=="on")
{
	$RegIns_query = "SELECT InstructorID FROM Instructors";
    $RegIns_result = sqlsrv_query( $conn, $RegIns_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

    while($RegIns_data = sqlsrv_fetch_array($RegIns_result)){
    	$RIds = $RegIns_data['InstructorID'];
    	$ssd .= $RIds.',';
    }
}
if($_POST['ItdInstructor']=="on")
{
	$RegIns_query = "SELECT InstructorID FROM ITD_Instructors";
    $RegIns_result = sqlsrv_query( $conn, $RegIns_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));	

    while($RegIns_data = sqlsrv_fetch_array($RegIns_result)){
    	$RIds = $RegIns_data['InstructorID'];
    	$ssd .= $RIds.',';
    }
}

$sqls = "INSERT INTO AllNotifications([To],Subject,Message,SentBy,SentOn) VALUES('".$ssd."','".$_POST['subject']."','".strip_tags($_POST['message'])."','".$_POST['adminID']."','".$currtime."')";
$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

header('location:Admin?msg=Success');

return true;
?>