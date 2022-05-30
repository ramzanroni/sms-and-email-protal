<?php
session_start();
include "../libs/database.php";
?>
<div class="container-fluid mt-2">
	<div class="row">
		<!-- Services -->
		<div class="col-md-12" id="services_area">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h3 class="card-title">Send SMS</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<input class="form-control" type="number" placeholder="Phone Number" id="receiverPhone">
						<small id="numberErr" class="text-danger"></small>
					</div>
					<div class="form-group">
						<select class="form-control select2" style="width: 100%;"  id="smsTempSelect" onchange="selectSMS(this.value)">
							<option value="">Choose SMS Templete</option>
							<?php 
								$smsTemplete=mysql_query("SELECT * FROM `templete` WHERE `templete_type`='SMS' AND `status`=1");
								while ($smsTempleteRow=mysql_fetch_assoc($smsTemplete)) 
								{
									?>
									<option value="<?php echo $smsTempleteRow['id']; ?>"><?php echo $smsTempleteRow['templete_name']; ?></option>
									<?php
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<textarea id="message_body" class="form-control" style="height: 300px" placeholder="Describe your text here..."></textarea>   
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<div class="float-right">
						<button type="submit" onclick="sendSMS()"  class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>         
	$(function () {
		$('.select2').select2();
		$("table").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
</script>