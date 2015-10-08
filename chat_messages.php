<?php
session_start();
error_reporting(0);
include('includes/database.php');

date_default_timezone_set("Asia/Kolkata");
$currtime = date("Y-m-d h:i:sa");

if($_GET['insert']=="add")
{	
	$sqls = "INSERT INTO Chat_Messages([From],[To],Message,Sent,Status) VALUES('".$_SESSION['StudentID']."','".$_SESSION['chatting_user']."','".$_GET['message']."','".$currtime."','unseen')";
	$result = sqlsrv_query( $conn, $sqls ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	$Idata_query = "SELECT * FROM Chat_Messages where ([from]='".$_SESSION['StudentID']."' and [to]='".$_SESSION['chatting_user']."') OR ([from]='".$_SESSION['chatting_user']."' and [to]='".$_SESSION['StudentID']."') ORDER BY sent";
	$Idata_result = sqlsrv_query( $conn, $Idata_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

	while($Ichat_data = sqlsrv_fetch_array($Idata_result)){

		if($Ichat_data['From']!=$_SESSION['StudentID'])
		{		                        
		 $Iusers = "SELECT StudentName_en FROM StudentInfo where StudentID='".$Ichat_data['From']."'";
		 $Iusersresult = sqlsrv_query( $conn, $Iusers ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));		
		?>			                        
		<!-- Message. Default to the left -->
		<div class="direct-chat-msg">
		  <div class="direct-chat-info clearfix">
		    <span class="direct-chat-name pull-left"><?php while($Iusers_name = sqlsrv_fetch_array($Iusersresult)){ echo $Iusers_name['StudentName_en']; } ?></span>
		    <span class="direct-chat-timestamp pull-right"><?php $vals=strtotime($Ichat_data['Sent']); echo date("j M Y G:i a",$vals);?></span>
		  </div><!-- /.direct-chat-info -->
		  <img class="direct-chat-img img-circle" class="img-cir" src="assets/dist/img/user1-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
		  <div class="direct-chat-text">
		    <?php echo $Ichat_data['Message'];?>
		  </div><!-- /.direct-chat-text -->
		</div><!-- /.direct-chat-msg -->

		<?php } else { ?>

		<!-- Message to the right -->
		<div class="direct-chat-msg right">
		  <div class="direct-chat-info clearfix">
		    <span class="direct-chat-name pull-right"><?php echo $_SESSION['StudentName_en'];?></span>
		    <span class="direct-chat-timestamp pull-left"><?php $vals=strtotime($Ichat_data['Sent']); echo date("j M Y G:i a",$vals);?></span>
		  </div><!-- /.direct-chat-info -->
		  <img class="direct-chat-img img-circle" src="assets/dist/img/user3-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
		  <div class="direct-chat-text">
		    <?php echo $Ichat_data['Message'];?>
		  </div><!-- /.direct-chat-text -->
		</div><!-- /.direct-chat-msg -->

		<?php } 

		}
}

if($_GET['process']=="data")
{
	$_SESSION['chatting_user'] = $_GET['chat_Id'];
	$data_query = "SELECT * FROM Chat_Messages where ([from]='".$_SESSION['StudentID']."' and [to]='".$_GET['chat_Id']."') OR ([from]='".$_GET['chat_Id']."' and [to]='".$_SESSION['StudentID']."') ORDER BY sent";
	$data_result = sqlsrv_query( $conn, $data_query ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
	$row_count = sqlsrv_num_rows($data_result);

	if($row_count > 0)
	{

	  while($userchat_data = sqlsrv_fetch_array($data_result)){

		if($userchat_data['From']!=$_SESSION['StudentID'])
		{		                        
		 $users = "SELECT StudentName_en FROM StudentInfo where StudentID='".$userchat_data['From']."'";
		 $usersresult = sqlsrv_query( $conn, $users ,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));		
		?>			                        
		<!-- Message. Default to the left -->
		<div class="direct-chat-msg">
		  <div class="direct-chat-info clearfix">
		    <span class="direct-chat-name pull-left"><?php while($users_name = sqlsrv_fetch_array($usersresult)){ echo $users_name['StudentName_en']; } ?></span>
		    <span class="direct-chat-timestamp pull-right"><?php $vals=strtotime($userchat_data['Sent']); echo date("j M Y G:i a",$vals);?></span>
		  </div><!-- /.direct-chat-info -->
		  <img class="direct-chat-img img-circle" class="img-cir" src="assets/dist/img/user1-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
		  <div class="direct-chat-text">
		    <?php echo $userchat_data['Message'];?>
		  </div><!-- /.direct-chat-text -->
		</div><!-- /.direct-chat-msg -->

		<?php } else { ?>

		<!-- Message to the right -->
		<div class="direct-chat-msg right">
		  <div class="direct-chat-info clearfix">
		    <span class="direct-chat-name pull-right"><?php echo $_SESSION['StudentName_en'];?></span>
		    <span class="direct-chat-timestamp pull-left"><?php $vals=strtotime($userchat_data['Sent']); echo date("j M Y G:i a",$vals);?></span>
		  </div><!-- /.direct-chat-info -->
		  <img class="direct-chat-img img-circle" src="assets/dist/img/user3-128x128.jpg" alt="message user image" /><!-- /.direct-chat-img -->
		  <div class="direct-chat-text">
		    <?php echo $userchat_data['Message'];?>
		  </div><!-- /.direct-chat-text -->
		</div><!-- /.direct-chat-msg -->

		<?php } 

		}
	}
	else
	{
		echo "No Conversation Started";
	}
		
}
?>