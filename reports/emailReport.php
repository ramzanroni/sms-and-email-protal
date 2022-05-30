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
							<label>Email</label>
							<input type="email" class="form-control" id="emailData">
						</div>
						<div class="col-md-2">
							<label>Agent</label>
							<select class="form-control" id="userDate">
								<option value="all" selected>All</option>
								<?php 
								$deptData=mysql_query("SELECT * FROM `users`");
								while ($deptRow=mysql_fetch_assoc($deptData)) {
									?>
									<option value="<?php echo $deptRow['user_name'] ?>"><?php echo $deptRow['user_name'] ?></option>
								<?php } ?>
							</select>
						</div>                	
						<div class="col-md-1">
							<button  style="margin-top: 35px;" type="button" class="btn btn-info float-right btn-sm" onclick="emailallDataShow()">Search
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<div class="col-md-12" id="services_area">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h3 class="card-title">Email Report</h3>
				</div>
				<div class="card-body" id="emailView">
					<table class="table table-bordered table-striped" id="emailTbl">
						<thead>
							<tr>
								<th>SL</th>
								<th>Email</th>
								<th>Subject</th>
								<th>CC</th>
								<th>User</th>
								<th>Date Time</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$deptData=mysql_query("SELECT * FROM `email_record` WHERE `date`>='$start' AND `date`<='$end' ORDER BY `id` DESC");
							while ($deptRow=mysql_fetch_assoc($deptData)) 
							{
								?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $deptRow['email']; ?></td>
									<td><?php echo $deptRow['subject']; ?></td>
									<td><?php echo $deptRow['cc']; ?></td>
									<td><?php echo $deptRow['sender']; ?></td>
									<td><?php echo $deptRow['date']; ?></td>
									<td><button type="button" class="btn btn-info float-right btn-sm" onclick="emailDataShow('<?php echo $deptRow['id']; ?>')">Show</button></td>
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
<div class="modal fade bd-example-modal-xl" id="deptModal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Email Show</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="deptData">

			</div> 
		</div>
	</div>
</div>


<script>         

	$( document ).ready(function() {
		$("table").DataTable();
	});
	function emailallDataShow(){
		var startDate = $('#startDate').val();
		var endDate = $('#endDate').val();
		var email = $('#emailData').val();
		var userDate = $('#userDate').val();
		$.ajax({
			url: "reports/emailReportResult.php",
			type: "POST",
			data: {
				startDate: startDate,
				endDate: endDate,
				email: email,
				userDate:userDate,
				type: "EMAIL_DATA_SHOW",
			},
			success: function (response) {
				$('#emailView').html(response);
				// console.log(response);
			}
		});
	}
	function emailDataShow(id){
		$('#deptModal').modal('show');
		$.ajax({
			url: "reports/emailReportResult.php",
			type: "POST",
			data: {
				email_id: id,
				type: "EMAIL_BODY_SHOW",
			},
			success: function (response) {
				$('#deptData').html(response);
			}
		});
	}

</script>