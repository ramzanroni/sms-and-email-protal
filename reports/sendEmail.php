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
					<h3 class="card-title">Send Email</h3>
				</div>
				<div class="card-body">
					<div class="form-group">
						<input class="form-control" type="email" placeholder="To:" id="receiver_email" name="receiver_email">
					</div>
					<div class="form-group">
						<input class="form-control" type="text" name="cc" id="cc" placeholder="Add CC" >
					</div>
					
					<div class="form-group">
						<select class="form-control select2" style="width: 100%;" id="smsTempSelect" onchange="selectEmail(this.value)">
							<option value="">Choose SMS Templete</option>
							<?php 
							$EmailTemplete=mysql_query("SELECT * FROM `templete` WHERE `templete_type`='Email' AND `status`=1");
							while ($emailTempleteRow=mysql_fetch_assoc($EmailTemplete)) 
							{
								?>
								<option value="<?php echo $emailTempleteRow['id']; ?>"><?php echo $emailTempleteRow['templete_name']; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<input readonly class="form-control" placeholder="Subject:" id="subject">
					</div>
					<div class="form-group">
						<textarea id="message_body_email"  class="form-control"  placeholder="Describe your text here..."></textarea>   
						<script>
							CKEDITOR.replace('message_body_email', {
								height: 300,
								filebrowserUploadUrl: "reports/upload.php"
							});
						</script>
					</div>
					<div class="form-group">
						<label class="control-label">Attachment</label>
						<input class="form-control" type="file" name="email_file" id="email_file">
					</div>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<div class="float-right">
						<button type="submit" onclick="sendEmail()"  class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
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
	function sendEmail()
	{

		var form_data = new FormData();
		var file_data = $('#email_file').prop('files')[0];
		var to_email = $("#receiver_email").val();
		var email_subject = $("#subject").val();
		var email_body = CKEDITOR.instances["message_body_email"].getData();
		var cc = $('#cc').val();
		var check="sendEmail";
		var flag=0;
		if(to_email=='')
		{
			$("#receiver_email").css({ "border": "1px solid red" });
			flag=1;
		}
		if(email_body=='')
		{
			$("#message_body_email").css({ "border": "1px solid red" });
			flag=1;
		}
		if(email_subject=='')
		{
			$("#subject").css({ "border": "1px solid red" });
			flag=1;
		}
		if(flag==0)
		{
			form_data.append('email_file', file_data);
			form_data.append('to_email', to_email);
			form_data.append('email_subject', email_subject);
			form_data.append('email_body', email_body);
			form_data.append('cc', cc);
			form_data.append('type', "EMAIL_SEND_DATA_FILE");

			Swal.fire('Please Wait. Data Loading.');
			Swal.showLoading();
			$.ajax({
				url: 'reports/sendEmailAction.php',
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'POST',
				success: function (response) {
					swal.close();
					if(response=='success')
					{
						alertMessage('Email Send Success.', 'success');
						email();
					}
					else{
						alertMessage(response, 'error');
						console.log(response);
					}
				}
			});
}
}
</script>