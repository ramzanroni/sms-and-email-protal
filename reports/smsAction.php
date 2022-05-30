<?php
session_start();
include "../libs/database.php";

if ($_POST['check']=="sendSMS") 
{
	$receiverPhone=$_POST['receiverPhone'];
	$message=$_POST['message'];
	$sender=$_SESSION['user_name'];
	$date=date("Y-m-d H:s:i");
	$preDate= date('Y-m-d H:i:s',strtotime('-2 minutes',strtotime($date)));
	$smsCheck=mysql_num_rows(mysql_query("SELECT * FROM `sms_record` WHERE `phone_number`='$receiverPhone' AND `message`='$message' AND  `date`<='$date' AND `date`>='$preDate'"));
	if ($smsCheck>0) 
	{
		echo "Someone send similer message 2 min ago. Please wait some time.";
	}
	else
	{
	$sender_id = '8809612442054';
	$api_key = 'C2001311623a002115e230.92836630';
	$url = "http://sms.viatech.com.bd/smsapi?api_key=".$api_key."&type=text&contacts=".$receiverPhone."&senderid=".$sender_id."&msg=".$message; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);
	curl_close($ch);
	$retn_msg = substr($output,0,13);
	if ($retn_msg!='') 
	{
		$smsRecord=mysql_query("INSERT INTO `sms_record`(`phone_number`, `message`, `sender`, `dept`, `date`) VALUES ('$receiverPhone','$message','$sender', '".$_SESSION['dept']."', '$date')");
			if ($smsRecord) 
			{
				echo "success";
			}
			else
			{
				echo "Something is wrong...!";
			}
		}

	}
}
?>