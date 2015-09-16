<?php
include('../includes/INSheader.php');
	
	$getProgramId = "SELECT MAX(ProgramID) AS LastID FROM ITD_Programs";
	$resultProgramId = sqlsrv_query( $conn, $getProgramId ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	$ProgramId = sqlsrv_fetch_array($resultProgramId);
	
  $ID = $ProgramId['LastID']+1;
  echo $ProgramID =$ID;
  $ProgramName = $_GET['ProgramName'];
  $ParentProgram = $_GET['ParentProgram'];
  $HourPerDay = $_GET['HourPerDay'];
  $NumberOfBreaks = $_GET['NumberOfBreaks'];
  $BreakDuration = $_GET['BreakDuration'];
  $StartDate = $_GET['StartDate'];
  $EndDate = $_GET['EndDate'];
  $ClassStartTime = $_GET['ClassStartTime'];
  $ClassDuration = $_GET['ClassDuration'];
  $OffDay_sun = $_GET['OffDay_sun'];
  $OffDay_Mon = $_GET['OffDay_Mon'];
  $OffDay_Tue = $_GET['OffDay_Tue'];
  $OffDay_Wed = $_GET['OffDay_Wed'];
  $OffDay_Thu = $_GET['OffDay_Thu'];
  $OffDay_Fri = $_GET['OffDay_Fri'];
  $OffDay_Sat = $_GET['OffDay_Sat'];
  $IsPublished = $_GET['IsPublished'];
 echo $sql = "SET IDENTITY_INSERT ITD_Programs ON   INSERT INTO ITD_Programs (ProgramID, ProgramName,ParentProgram,HourPerDay,NumberOfBreaks,BreakDuration,StartDate,EndDate,ClassStartTime,ClassDuration,OffDay_Sun, OffDay_Mon,OffDay_Tue,OffDay_Wed, OffDay_Thu,OffDay_Fri,OffDay_Sat,IsPublished)
								VALUES('".$ID."','".$ProgramName."','".$ParentProgram."','".$HourPerDay."','".$NumberOfBreaks."','".$BreakDuration."','".$StartDate."','".$EndDate."','".$ClassStartTime."','".$ClassDuration."','".$OffDay_sun."','".$OffDay_Mon."','".$OffDay_Tue."', '".$OffDay_Wed."', '".$OffDay_Thu."','".$OffDay_Fri."','".$OffDay_Sat."','".$IsPublished."')";
     $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
  