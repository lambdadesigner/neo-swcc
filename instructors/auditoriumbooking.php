<?php
include('../includes/database.php');
  $AuditoriumNum = $_GET['AuditoriumNum'];
  $BookingDate = $_GET['BookingDate'];
  $BookedBy = $_GET['BookedBy'];
  $single_input1=$_GET['singleinput1'];
  $single_input2=$_GET['singleinput2'];
 
 
 $sql = "SELECT * FROM AuditoriumBookingStatus WHERE AuditoriumNum ='.$AuditoriumNum.' AND BookingDate ='.$BookingDate.'";
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

 $row_count = sqlsrv_num_rows($result);
 $row = sqlsrv_fetch_array($result);
 if($row_count > 0){
	 echo "All ready Booked";
 }else{
	
	 $sql = "INSERT INTO AuditoriumBookingStatus (AuditoriumNum,BookingDate,BookedBy,StartTime,EndTime) VALUES('".$AuditoriumNum."','".$BookingDate."','".$BookedBy."','".$single_input1."','".$single_input2."')";
     $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 echo "Booked successfully";
 }
				
?>