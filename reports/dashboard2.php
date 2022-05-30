<?php
session_start();
include "./libs/database.php";
$date=date("Y-m-d");
$startDate=$date." 00:00:00";
$endDate=$date." 23:59:59";
?>
<div class="row mt-3" id="content1">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<?php
				$totalSMS=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'totalSMSCount' FROM  `sms_record`"));  
				?>
				<h3><?php echo $totalSMS['totalSMSCount']; ?></h3>

				<p>Total SMS Send</p>
			</div>
			<div class="icon">
				<i class="fas fa-at"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-success">
			<div class="inner">
				<?php
				$todaySMS=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'todaySMS' FROM `sms_record` WHERE date >= '$startDate' AND date <= '$endDate'"));  
				?>
				<h3><?php echo $todaySMS['todaySMS']; ?></h3>

				<p>Today SMS Send</p>
			</div>
			<div class="icon">
				<i class="fas fa-at"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-warning">
			<div class="inner">
				<?php
				$totalEmail=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'totalEmailCount' FROM  `email_record`"));  
				?>
				<h3 class="text-white"><?php echo $totalEmail['totalEmailCount']; ?></h3>

				<p class="text-white">Total Email Send</p>
			</div>
			<div class="icon">
				<i class="far fa-comment"></i>
			</div>
			<a href="#" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-danger">
			<div class="inner">
				<?php
				$todayEmail=mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS 'todayEmail' FROM `email_record` WHERE date >= '$startDate' AND date <= '$endDate'"));  
				?>
				<h3><?php echo $todayEmail['todayEmail']; ?></h3>

				<p>Today Email Send</p>
			</div>
			<div class="icon">
				<i class="far fa-comment"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>

<script type="text/javascript">
  $( document ).ready(function() {
    /*setInterval(loadDashboard, 2000);
    function loadDashboard() {
      $.ajax({
       url: "./dashboard.php",
       success: function (result) {
         $("#content1").html(result);
       }
      });
    }*/
  });
</script>