<?php
session_start();
error_reporting(0);
include('includes/database.php');

//print_r($_POST); exit;
if($_POST['scenario']=="addAdmSchedule")
{
	//print_r($_POST); exit;
	echo $sqls = "INSERT INTO Schdule(ModuleID,Day,Date,SessionID,InstructorID,GroupID,StartTime,EndTime) VALUES('".$_POST['ModuleId']."','".$_POST['ScheDay']."','".$_POST['ScheDate']."','".$_POST['SchesessionId']."','".$_POST['InstrucId']."','".$_POST['SGroupId']."','".$_POST['startTime']."','".$_POST['endTime']."')"; 

	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AdminSchedules?err=success');
}

if($_POST['scenario']=="editAdmSchedule")
{
	//print_r($_POST); exit;
	//echo $sqls = "UPDATE Schdule SET ModuleID = '".$_POST['ModuleId']."',Day = '".$_POST['ScheDay']."',Date='".$_POST['ScheDate']."',SessionID='".$_POST['SchesessionId']."',InstructorID = '".$_POST['InstrucId']."',GroupID = '".$_POST['SGroupId']."',StartTime = '".$_POST['startTime']."',EndTime = '".$_POST['endTime']."')"; 

	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AdminSchedules?err=success');
}

if($_POST['scenario']=="AddRoomStudent")
{
	$Roomdet = explode('_',$_POST['RoomDetails']);	
	$sqls = "UPDATE BachelorAcc SET Candidate_".$Roomdet['2']." = '".$_POST['RoStudentId']."',Candidate_".$Roomdet['2']."_FromDate = '".$_POST['RoFromDate']."',Candidate_".$Roomdet['2']."_ToDate='".$_POST['RoToDate']."' WHERE BuildingNo='".$_POST['BuildName']."' AND Section='".$Roomdet['0']."' AND RoomNo='".$Roomdet['1']."'"; //exit;
	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AdminBuildings?building='.$_POST['BuildName'].'');
}
?>