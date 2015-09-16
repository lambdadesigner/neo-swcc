<?php
include('../includes/INSheader.php');
  $classroom = $_GET['classroom'];
  $BookDate = $_GET['BookDate'];
  $bookedby = $_GET['bookedby'];
  $Occupancy='f';
  $OccString = $_GET['OccString'];
 $sql = "SELECT * FROM ClassroomBookingStatus WHERE ClassNum ='.$classroom.' AND BookedDate ='.$BookDate.'";
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
 $row_count = sqlsrv_num_rows($result);
 if($row_count > 0){
	 echo "All ready Booked";
 }else{
	 echo $sql = "INSERT INTO ClassroomBookingStatus (ClassNum,BookedDate,BookedBy,Occupancy,OccString) VALUES('".$classroom."','".$BookDate."','".$bookedby."','".$Occupancy."','".$OccString."')";
     $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	 echo "Booked successfully";
 }
				
?>