<?php
session_start();
include "../libs/database.php";
$date=date("Y-m-d");
$startDate=$date." 00:00:00";
$endDate=$date." 23:59:59";
?>

<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-info">
		<div class="inner">
			<?php
			if($_SESSION['role']=="Admin" || $_SESSION['role']=="superadmin")
			{
				$totalSMS=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'totalSMSCount' FROM  `sms_record`"));  
			}
			else
			{
				$totalSMS=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'totalSMSCount' FROM  `sms_record` WHERE `dept`='".$_SESSION['dept']."'"));
			}
			?>
			<h3><?php echo $totalSMS['totalSMSCount']; ?></h3>

			<p>Total SMS Send</p>
		</div>
		<div class="icon">
			<i class="fas fa-at"></i>
		</div>
		<a href="#" onclick="smsReport()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
			<?php
			if($_SESSION['role']=="Admin" || $_SESSION['role']=="superadmin")
			{
				$todaySMS=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'todaySMS' FROM `sms_record` WHERE date >= '$startDate' AND date <= '$endDate'")); 
			}
			else
			{
				$todaySMS=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'todaySMS' FROM `sms_record` WHERE date >= '$startDate' AND date <= '$endDate' AND `dept`='".$_SESSION['dept']."'")); 
			}  
			?>
			<h3><?php echo $todaySMS['todaySMS']; ?></h3>

			<p>Today SMS Send</p>
		</div>
		<div class="icon">
			<i class="fas fa-at"></i>
		</div>
		<a href="#" onclick="smsReport()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-warning">
		<div class="inner">
			<?php
			if($_SESSION['role']=="Admin" || $_SESSION['role']=="superadmin")
			{
				$totalEmail=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'totalEmailCount' FROM  `email_record`"));  
			}
			else 
			{
				$totalEmail=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'totalEmailCount' FROM  `email_record` WHERE `dept`='".$_SESSION['dept']."'"));  
			}	
			?>
			<h3 class="text-white"><?php echo $totalEmail['totalEmailCount']; ?></h3>

			<p class="text-white">Total Email Send</p>
		</div>
		<div class="icon">
			<i class="far fa-comment"></i>
		</div>
		<a href="#" onclick="emailReport()" class="small-box-footer" style="color: white !important;">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
	<!-- small box -->
	<div class="small-box bg-danger">
		<div class="inner">
			<?php
			if($_SESSION['role']=="Admin" || $_SESSION['role']=="superadmin")
			{
			$todayEmail=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'todayEmail' FROM `email_record` WHERE date >= '$startDate' AND date <= '$endDate'"));  
		}
		else
		{
			$todayEmail=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'todayEmail' FROM `email_record` WHERE date >= '$startDate' AND date <= '$endDate' AND `dept`='".$_SESSION['dept']."'"));  
		}
			?>
			<h3><?php echo $todayEmail['todayEmail']; ?></h3>

			<p>Today Email Send</p>
		</div>
		<div class="icon">
			<i class="far fa-comment"></i>
		</div>
		<a href="#" onclick="emailReport()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>

<!-- ./col -->

