<?php
session_start();
include "../libs/database.php";
if ($_POST['type']=="EMAIL_DATA_SHOW") {
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$start = $startDate." ".'00:00:01';
	$end = $endDate." ".'23:59:59';
	$email = $_POST['email'];
	$agent = $_POST['userDate'];
	if ($email=='' && $agent=="all") 
	{
		$searchSql=mysql_query("SELECT * FROM `email_record` WHERE `date`>='$start' AND `date`<='$end' ORDER BY id DESC");

	}
	elseif ($agent=="all" && $email!='') 
	{
		$searchSql=mysql_query("SELECT * FROM `email_record` WHERE `email`='$email' AND `date`>='$start' AND `date`<='$end' ORDER BY id DESC");
	}
	elseif ($email!='' && $agent!='all')
	{
		$searchSql=mysql_query("SELECT * FROM `email_record` WHERE `email`='$email' AND `sender`='$agent' AND `date`>='$start' AND `date`<='$end' ORDER BY id DESC");
	}
	elseif ($email=='' && $agent!='all') {
		$searchSql=mysql_query("SELECT * FROM `email_record` WHERE `sender`='$agent' AND `date`>='$start' AND `date`<='$end' ORDER BY id DESC");
	}
	?>
	<table class="table table-bordered table-striped">
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
			while ($emailRow=mysql_fetch_assoc($searchSql)) 
			{
				?>
				<tr>
					<td><?php echo $sl; ?></td>
					<td><?php echo $emailRow['email']; ?></td>
					<td><?php echo $emailRow['subject']; ?></td>
					<td><?php echo $emailRow['cc']; ?></td>
					<td><?php echo $emailRow['sender']; ?></td>
					<td><?php echo $emailRow['date']; ?></td>
					<td><button type="button" class="btn btn-info float-right btn-sm" onclick="emailDataShow('<?php echo $emailRow['id']; ?>')">Show</button></td>
				</tr>
				<?php
				$sl++;
			}
			?>
		</tbody>
	</table>
	<script type="text/javascript">
		$(function () {
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
	<?php

}

if ($_POST['type']=="EMAIL_BODY_SHOW") {
	$select = mysql_fetch_assoc(mysql_query("SELECT * FROM `email_record` WHERE `id`='".$_POST['email_id']."'"));
	?>
	<div class="card-body">
		<div class="mailbox-read-info">
			<h5><?php echo $select['subject']; ?></h5>
			<h6>From: <?php echo $select['email']; ?>
			<span class="mailbox-read-time float-right"><?php echo $select['date']; ?></span></h6>
		</div>
		<div class="mailbox-read-message p-3">

			<p class="p-5"><?php echo $select['body']; ?></p>
		</div>
		<!-- /.mailbox-read-message -->
	</div>
	<?php  
	if ($select['file'] != '') 
	{
		?>
		<div class="card-footer bg-white">
			<ul class="mailbox-attachments d-flex align-items-stretch clearfix">
				<li>
					<span class="mailbox-attachment-icon"><i class="fas fa-file"></i></span>

					<div class="mailbox-attachment-info">
						<a href="#"  class="mailbox-attachment-name"><i class="fas fa-file"></i> <?php echo $select['file']; ?></a>
						<span class="mailbox-attachment-size clearfix mt-1">
							<a href="<?php echo "../smspanel/file/".$select['file']; ?>" download class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
						</span>
					</div>
				</li>
			</ul>
		</div>
		<?php
	}
	?>
<?php } ?>
