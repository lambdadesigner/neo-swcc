<?php
error_reporting(0);
include('includes/database.php');

date_default_timezone_set("Asia/Kolkata");
$currtime = date("Y-m-d h:i:sa");
//exit;
if($_POST['RegStudent']=="on")
{
	echo $RStu_query = "SELECT StudentID FROM StudentInfo";
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



$sqls = "INSERT INTO AllNotifications([To],Subject,Message,SentBy,SentOn) VALUES('".$ssd."','".$_POST['subject']."','".strip_tags($_POST['message'])."','".$_POST['adminID']."','".$currtime."')";
$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

header('location:index');

return true;
?>