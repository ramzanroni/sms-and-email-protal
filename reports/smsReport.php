<?php
$date = date('Y-m-d');
$start = $date." ".'00:00:01';
$end = $date." ".'23:59:59';
session_start();
include "../libs/database.php";
?>
<div class="container-fluid mt-2">
	<div class="row">
		<div class="col-md-12" id="services_area">
			<div class="card card-info card-outline">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<label>Start Date</label>
							<input type="date" class="form-control" id="startDate" value="<?php echo $date; ?>">
						</div>
						<div class="col-md-3">
							<label>End Date</label>
							<input type="date" class="form-control" id="endDate" value="<?php echo $date; ?>">
						</div> 
						<div class="col-md-3">
							<label>Phone Number</label>
							<input type="text" class="form-control" id="phoneNumber">
						</div>
						<div class="col-md-2">
							<label>Agent</label>
							<select class="form-control" id="userDate">
								<option value="all">All</option>
								<?php 
								$deptData=mysql_query("SELECT * FROM `users`");
								while ($deptRow=mysql_fetch_assoc($deptData)) {
									?>
									<option value="<?php echo $deptRow['user_name'] ?>"><?php echo $deptRow['user_name'] ?></option>
								<?php } ?>
							</select>
						</div>                	
						<div class="col-md-1">
							<button  style="margin-top: 35px;" type="button" class="btn btn-info float-right btn-sm" onclick="smsallDataShow()">Search
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<div class="col-md-12" id="services_area">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h3 class="card-title">SMS Report</h3>
				</div>
				<div class="card-body" id="smsData">
					<table class="table table-bordered table-striped" id="smsRecord">
						<thead>
							<tr>
								<th>SL</th>
								<th>Phone Number</th>
								<th>Message</th>
								<th>User</th>
								<th>Date Time</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$deptData=mysql_query("SELECT * FROM `sms_record` WHERE `date`>='$start' AND `date`<='$end' AND `dept`='".$_SESSION['dept']."' ORDER BY `id` DESC ");
							while ($deptRow=mysql_fetch_assoc($deptData)) 
							{
								?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $deptRow['phone_number']; ?></td>
									<td><?php echo $deptRow['message']; ?></td>
									<td><?php echo $deptRow['sender']; ?></td>
									<td><?php echo $deptRow['date']; ?></td>
								</tr>
								<?php
								$sl++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<script>         
	$( document ).ready(function() {
		// $("#smsRecord").DataTable();
		$("#smsRecord").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			dom: 'Bfrtip',

			"buttons": [{
			extend: 'excel',
        text: 'User Export to excel',
        className: 'btn btn-info btn-xs'}]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
	function smsallDataShow(){
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();
		var phoneNumber = $('#phoneNumber').val();
		var userDate = $('#userDate').val();
		$.ajax({
			url: "reports/smsReportResult.php",
			type: "POST",
			data: {
				startDate: startDate,
				endDate: endDate,
				phoneNumber: phoneNumber,
				userDate:userDate
			},
			success: function (response) {
				$('#smsData').html(response);
			}
		});
	}

</script>