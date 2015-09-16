<?php
session_start();
include('database.php');	

if(isset($_POST['submit'])){
 $studentId = $_POST['studentId'];
 $DOB = $_POST['DOB'];

			$querys =	"SELECT * FROM StudentInfo WHERE StudentID='$studentId' AND DoB='$DOB'";
			$result_users = sqlsrv_query( $conn, $querys ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
			$row_count = sqlsrv_num_rows($result_users);
			$querys1 =	"SELECT * FROM SCStudentInfo WHERE EmpID='$studentId' AND StudentName_en='$DOB'";
			$result_scstudents = sqlsrv_query( $conn, $querys1 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
			$row_count1 = sqlsrv_num_rows($result_scstudents);
			$querys2 =	"SELECT * FROM ITD_Instructors WHERE InstructorName='$studentId' AND InstructorEmail='$DOB'";
			$result_ITD_Instructors = sqlsrv_query( $conn, $querys2 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
			$row_count2 = sqlsrv_num_rows($result_ITD_Instructors);
			$querys3 =	"SELECT * FROM Instructors WHERE EmployeeID='$studentId' AND InstructorName='$DOB'";
			$result_Instructors = sqlsrv_query( $conn, $querys3 ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
			$row_count3 = sqlsrv_num_rows($result_Instructors);
			if ($row_count > 0){
				while($row = sqlsrv_fetch_array($result_users)){
				   //print_r($row);
				   $_SESSION['StudentID'] = $row['StudentID'];
				   $_SESSION['StudentGroup'] = $row['StudentGroup'];
				   $_SESSION['NationalID'] = $row['NationalID'];
				   $_SESSION['DoB'] = $row['DoB'];
				}
  				header("Location: dashboard.php");
				}else{
				header("Location: login.php");
			
			}elseif(isset($row_count1)){
			
			if ($row_count1 > 0){
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
				header("Location: dashboard.php");
				}else{
			
				header("Location: login.php");
				}
		
			}elseif(isset($row_count2)){
			
			if ($row_count2 > 0){
				 while($row2 = sqlsrv_fetch_array($result_ITD_Instructors)){
					   //print_r($row);
					   $_SESSION['InstructorID'] = $row2['InstructorID'];
					   $_SESSION['InstructorName'] = $row2['InstructorName'];
					   $_SESSION['InstructorSpecialCourse'] = $row2['InstructorSpecialCourse'];
					   $_SESSION['InstructorEmail'] = $row2['InstructorEmail'];
					   $_SESSION['InstructorPhone'] = $row2['InstructorPhone'];
					   $_SESSION['InstructorMobile'] = $row2['InstructorMobile'];
					   $_SESSION['InstructorImage'] = $row2['InstructorImage'];
					   }
					   header("Location: dashboard.php");
					   }else{
					   header("Location: login.php");
					   }
					
			}elseif(isset($row_count3)){
			
			if ($row_count3 > 0){
				 while($row3 = sqlsrv_fetch_array($result_ITD_Instructors)){
					   //print_r($row);
					   $_SESSION['InstructorID'] = $row3['InstructorID'];
					   $_SESSION['EmployeeID'] = $row3['EmployeeID'];
					   $_SESSION['InstructorName'] = $row3['InstructorName'];
					   $_SESSION['FormID'] = $row3['FormID'];
					   $_SESSION['processID'] = $row3['processID'];
					   $_SESSION['Abr'] = $row3['Abr'];
					  
					}
					 header("Location: dashboard.php");
					}else{
					header("Location: login.php");
				
				}

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
					<input type="text" name="studentId" required class="form-control" placeholder="StudentId OR EmpID" value="" />
				</div>
				
				<div class="form-group">
					<input type="text" name="DOB" required class="form-control" placeholder="Date Of Birthday OR StudentName " value="" />
				</div>
				 <!-- <a href="student/index.php" type="submit" name="go" class="btn btn-primary btn-block btn-lg white-text">Login Now</a> -->
				 <input type="submit" name="submit" value="Login Now" class="btn btn-primary btn-block btn-lg white-text">
				<a class="white-text pull-right" href="#Fakelink" type="button" id="tooltip" data-toggle="tooltip" data-placement="top" title="Forgot password ?">Forgot Password ?</a>
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