<?php
session_start();
error_reporting(0);
include('includes/database.php');

//print_r($_POST); exit;
if($_POST['ModuleType']=="Category")
{	
	$sqls = "INSERT INTO Module_Category(MCID,MCName,HierarachyID,Stage) VALUES('".$_POST['CategoryId']."','".$_POST['CategoryName']."','".$_POST['HeirarchyId']."','".$_POST['stage']."')";
	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AdminModuleCategory?err=success');
}

if($_POST['ModuleType']=="Modules")
{	
	$sqls1 = "INSERT INTO Module(ModuleID,MCID,ModuleName,Duration,Weight,Abbrevation,InstructorID,GroupID) VALUES('".$_POST['ModuleId']."','".$_POST['MCategory']."','".$_POST['ModuleName']."','".$_POST['Duration']."','".$_POST['Weight']."','".$_POST['Abbrevation']."','".$_POST['MInstructor']."','".$_POST['GroupID']."')";
	$result1 = sqlsrv_query( $conn, $sqls1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AdminModules?err=success');
}

if($_POST['ModuleType']=="ItdModules")
{	
	echo $Itd_sqls = "INSERT INTO ITD_Modules(ModuleName,ModuleCode,ModuleColor,ModuleWeight,ModuleCreditHours,IsOrientation,IsOpenDay) VALUES('".$_POST['ModuleName']."','".$_POST['ModuleCode']."','".$_POST['ModuleColor']."','".$_POST['ModuleWeight']."','".$_POST['ModuleCreditHours']."','".$_POST['IsOrientation']."','".$_POST['IsOpenDay']."')"; //exit;
	$Itd_result = sqlsrv_query( $conn, $Itd_sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AdminItdModule?err=success');
}


?>