<?php  
session_start();
include "../libs/database.php";
// require './../PHPMailer/PHPMailerAutoload.php';
require '../PHPMailer/PHPMailerAutoload.php';

function send_email($receiver_mail, $subject, $message_body, $cc, $file)
{
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->IsHTML(true);
	$mail->Username = "abde75748@gmail.com";
	$mail->Password = "ihelpbd1234";
	$mail->SetFrom($receiver_mail);
	$mail->addcc($cc);
	$mail->Subject = $subject;
	$mail->Body = $message_body;
	$mail->AddAddress($receiver_mail);
	$mail->addAttachment($file);
	if($mail->Send()) {
		return "success";
	}
	else
	{
         return "Email Not Send";
		// return $mail->ErrorInfo;
	}
}

if ($_POST['type'] == "EMAIL_SEND_DATA_FILE") 
{
	$to_email = $_POST['to_email'];
	$PostCC = $_POST['cc'];
	$email_subject = $_POST['email_subject'];
	$email_body = $_POST['email_body'];
	$fileEmail = $_FILES['email_file']['name'];

	if ($fileEmail) {
		$file = $_FILES['email_file']['name'];
	}else{
		$newfilename='';
	}
	if ($PostCC) {
		$cc = $_POST['cc'];
	}else{
		$cc='';
	}
	if ($file !='') 
	{
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$allwoed_extention = array('pdf', 'png', 'jpg','JPEG','PNG','GIF','jpeg'.'JPG','PDF','docx','xlsx','csv');
		if(in_array($ext, $allwoed_extention)){
			if ($_FILES['file']['size'] < 10485760) {
				$newfilename = round(microtime(true)) . '.' . $ext;
				$upload = move_uploaded_file($_FILES['email_file']['tmp_name'], "../file/".$newfilename);				
			}
			else
			{
				echo "File size more large.";
			}
		}
		else
		{
			echo "File Formate Does not Support..";
		}
	}
	// echo  "../file/".$newfilename;
	$file="../file/".$newfilename;
	$sendingResult=send_email($to_email, $email_subject, $email_body, $cc, $file);
	if ($sendingResult!='') 
	{
		$emailRecord=mysql_query("INSERT INTO `email_record`( `email`, `subject`, `body`, `file`, `cc`, `sender`, `dept`) VALUES ('$to_email', '$email_subject','$email_body','$newfilename','$cc','".$_SESSION['user_name']."', '".$_SESSION['dept']."')");
			if ($emailRecord) 
			{
				echo $sendingResult;
			}
			else
			{
				echo "Something is wrong.";
			}
	}
}
?>