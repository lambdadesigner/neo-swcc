<?php
session_start();
error_reporting(0);
include('includes/database.php');	

// If Session is Created redirection to pages
if($_SESSION['StudentID']!="")
{
	header("Location: dashboard");
}
if($_SESSION['EmpID']!="")
{
	header("Location: SCdashboard");
}
if($_SESSION['InstructorID']!="")
{
	header("Location: instructors");
}
if($_SESSION['AdminId']!="")
{
	header("Location: Admin");
}


if(isset($_POST['submit'])){
 $studentId = $_POST['studentId'];
 $DOB = $_POST['DOB'];

$querys =	"SELECT * FROM StudentInfo WHERE StudentID='$studentId' AND DoB='$DOB'";
$result_users = sqlsrv_query( $conn, $querys ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$row_count = sqlsrv_num_rows($result_users);

$querys1 =	"SELECT * FROM SCStudentInfo WHERE EmpID='$studentId' AND StudentName_en='$DOB'";
$result_scstudents = sqlsrv_query( $conn, $querys1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$row_count1 = sqlsrv_num_rows($result_scstudents);

$querys2 =	"SELECT * FROM ITD_Instructors WHERE InstructorID='$studentId' AND InstructorName='$DOB'";
$result_ITD_Instructors = sqlsrv_query( $conn, $querys2 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$row_count2 = sqlsrv_num_rows($result_ITD_Instructors);

$querys3 =	"SELECT * FROM Instructors WHERE InstructorID='$studentId' AND InstructorName='$DOB'"; 
$result_Instructors = sqlsrv_query( $conn, $querys3 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$row_count3 = sqlsrv_num_rows($result_Instructors);

$Adminquerys =	"SELECT * FROM AdminInfo WHERE AdminId='$studentId' AND DoB='$DOB'"; 
$Admin_result = sqlsrv_query( $conn, $Adminquerys ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$Admin_row_count = sqlsrv_num_rows($Admin_result);

$_SESSION["language"] = "en";

if ($row_count > 0){
 while($row = sqlsrv_fetch_array($result_users)){
	   //print_r($row);
       $_SESSION['StudentID'] = $row['StudentID'];
	   $_SESSION['StudentName_en'] = $row['StudentName_en'];
	   $_SESSION['StudentName_ar'] = $row['StudentName_ar'];
       $_SESSION['StudentGroup'] = $row['StudentGroup'];
       $_SESSION['NationalID'] = $row['NationalID'];
       $_SESSION['DoB'] = $row['DoB'];
    }
  
   header("Location: dashboard");
}
elseif($row_count1 > 0)
{
	while($row1 = sqlsrv_fetch_array($result_scstudents)){
	   //print_r($row);
       $_SESSION['EmpID'] = $row1['EmpID'];
       $_SESSION['StudentName_ar'] = $row1['StudentName_ar'];
       $_SESSION['StudentName_en'] = $row1['StudentName_en'];
       $_SESSION['Plant_en'] = $row1['Plant_en'];
	   $_SESSION['Plant_ar'] = $row1['Plant_ar'];
	   $_SESSION['JobTitle_en'] = $row1['JobTitle_en'];
	   $_SESSION['JobTitle_ar'] = $row1['JobTitle_ar'];
    }
     header("Location: SCdashboard");
}elseif($row_count3 >0){
	 while($row3 = sqlsrv_fetch_array($result_Instructors)){

	   $_SESSION['InstructorID'] = $row3['InstructorID'];
	   $_SESSION['EmployeeID'] = $row3['EmployeeID'];
	   $_SESSION['InstructorName'] = $row3['InstructorName'];
	   $_SESSION['FormID'] = $row3['FormID'];
	   $_SESSION['processID'] = $row3['processID'];
	   $_SESSION['Abr'] = $row3['Abr'];
		  
	}
	 header("Location: instructors/index");
	
	
}elseif($row_count2 >0){
	 while($row2 = sqlsrv_fetch_array($result_ITD_Instructors)){
	      $_SESSION['InstructorID'] = $row2['InstructorID'];
		  $_SESSION['InstructorEmail'] = $row2['InstructorEmail'];
		  $_SESSION['InstructorName'] = $row2['InstructorName'];
		  $_SESSION['InstructorPhone'] = $row2['InstructorPhone'];
		  $_SESSION['InstructorMobile'] = $row2['InstructorMobile'];
		  $_SESSION['InstructorAddress1'] = $row2['InstructorAddress1'];
					  
	 }
	 header("Location: instructors/ITDdashboard");
	
	
}
elseif($Admin_row_count >0){
	while($admin_row = sqlsrv_fetch_array($Admin_result)){
	    $_SESSION['AdminId'] = $admin_row['AdminId'];
		$_SESSION['AdminUserName'] = $admin_row['AdminUserName'];
		$_SESSION['AFullName_en'] = $admin_row['AFullName_en'];		
		$_SESSION['Mobile'] = $admin_row['Mobile'];
	}
	 header("Location: Admin");	
}
else
{
	 header("Location: index");
	
}
		

}
	

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=1,initial-scale=1,user-scalable=1" />
	<title>SWCC LogIn - Student/Teacher</title>

	<link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
</head>
<body>
	
	<section class="container login-form">
		<section>
			<form method="post" action="" role="login">
				<h1 class="signin"><img src="assets/images/swcc-logo.png"></h1>
			
				<div class="form-group">
					<input type="text" name="studentId" required class="form-control" placeholder="StudentId / Emp ID" value="" autofocus />
				</div>
				
				<div class="form-group">
					<input type="text" name="DOB" required class="form-control" placeholder="DOB / Student Name " value="" />
				</div>
				 <!-- <a href="student/index.php" type="submit" name="go" class="btn btn-primary btn-block btn-lg white-text">Login Now</a> -->
				 <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg white-text">
				<!-- <a class="white-text pull-right" href="#Fakelink" type="button" id="tooltip" data-toggle="tooltip" data-placement="top" title="Forgot password ?">Forgot Password ?</a> -->
				<!-- Not yet a member ? <a href="#">Register now</a> -->
			</form>
		</section>
	</section>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	
	<script>
	<!--
	$( document ).ready(function() {
	    $('#tooltip').tooltip();
	});
	-->
	</script>

</body>
</html>