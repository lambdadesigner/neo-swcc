<?php
session_start();
error_reporting(0);
include('includes/database.php');

//print_r($_POST); exit;
if($_POST['scenario']=="add")
{
	echo $sqls = "INSERT INTO ITD_Holidays(HolidayName,FromDate,ToDate,IsTeacherHoliday,IsAnnualHoliday) VALUES('".$_POST['HolidayName']."','".$_POST['StartDate']."','".$_POST['EndDate']."','".$_POST['IsTeach']."','".$_POST['IsAnnual']."')"; 
	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:Holidays?err=success');
}

if($_POST['scenario']=="edit")
{	
	echo $sqls = "UPDATE ITD_Holidays SET HolidayName='".$_POST['HolidayName']."',FromDate='".$_POST['StartDate']."',ToDate='".$_POST['EndDate']."',IsTeacherHoliday='".$_POST['IsTeach']."',IsAnnualHoliday='".$_POST['IsAnnual']."' WHERE HolidayID = '".$_POST['HolidayId']."'"; 
	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:Holidays?err=success');
}

if($_POST['scenario']=="addProfiles")
{
	//print_r($_POST); exit;
	echo $sqls = "INSERT INTO StudentInfo (StudentID,FirstNameE,FirstNameA,StudentGroup,NationalID,Issuedate,BirthPlace,DoB,SecondNameA,ThrdNameA,LastNameA,SecondNameE,ThrdNameE,LastNameE,StudentName_ar,StudentName_en,Mobile) VALUES ('".$_POST['StudentId']."','".$_POST['FirstNameE']."','".$_POST['FirstNameA']."','".$_POST['SGroupName']."','".$_POST['NationalId']."','".$_POST['Issuedate']."','".$_POST['BirthPlace']."','".$_POST['BirthDate']."','".$_POST['SecondNameA']."','".$_POST['ThirdNameA']."','".$_POST['LastNameA']."','".$_POST['SecondNameE']."','".$_POST['ThirdNameE']."','".$_POST['LastNameE']."','".$_POST['StudentNameA']."','".$_POST['StudentNameE']."','".$_POST['Mobile']."')"; //exit;
	
	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AllProfiles?err=success');
}

if($_POST['scenario']=="EditStudentProfiles")
{
	echo $sqls = "UPDATE StudentInfo SET StudentID='".$_POST['StudentId']."',FirstNameE='".$_POST['FirstNameE']."',FirstNameA='".$_POST['FirstNameA']."',StudentGroup='".$_POST['SGroupName']."',NationalID='".$_POST['NationalId']."',Issuedate='".$_POST['Issuedate']."',BirthPlace='".$_POST['BirthPlace']."',DoB='".$_POST['BirthDate']."',SecondNameA='".$_POST['SecondNameA']."',ThrdNameA='".$_POST['ThirdNameA']."',LastNameA='".$_POST['LastNameA']."',SecondNameE='".$_POST['SecondNameE']."',ThrdNameE='".$_POST['ThirdNameE']."', LastNameE='".$_POST['LastNameE']."',StudentName_ar='".$_POST['StudentNameA']."',StudentName_en='".$_POST['StudentNameE']."',Mobile='".$_POST['Mobile']."' WHERE StudentID='".$_POST['StudentId']."'"; 
	//exit;	
	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	header('location:AllProfiles?err=successed');
}

if($_POST['scenario']=="EditInstructorProfile")
{

	
}
?>