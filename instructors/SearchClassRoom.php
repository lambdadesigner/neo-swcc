<?php
include('includes/database.php');
echo $classnumber = $_REQUEST['classnumber'];
echo $BookedDate = $_REQUEST['BookedDate'];

 $sql = "SELECT * FROM ClassroomBookingStatus WHERE ClassNum ='$classnumber' AND BookedDate ='$BookedDate'";
 $result = sqlsrv_query( $conn, $sql ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
 $row = sqlsrv_num_rows($result);
 while($row = sqlsrv_fetch_array($result)){

      echo $row['ClassNum'];
	  echo date_format($row['BookedDate'], 'Y-m-d');
	  echo $row['BookedBy'];
	  echo $row['OccString'];
	 
	 }
				
?>