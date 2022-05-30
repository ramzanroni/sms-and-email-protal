<?php
session_start();
include "../libs/database.php";
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$start = $startDate." ".'00:00:01';
$end = $endDate." ".'23:59:59';
$phoneNumber = $_POST['phoneNumber'];
$agent = $_POST['userDate'];
?>

<table id="smsResult" class="table table-bordered table-striped">
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
		if ($phoneNumber=='' && $agent=="all") 
		{
			$deptData=mysql_query("SELECT * FROM `sms_record` WHERE `date`>='$start' AND `date`<='$end' ORDER BY id DESC");

		}
		elseif ($agent=="all" && $phoneNumber!='') 
		{
			$deptData=mysql_query("SELECT * FROM `sms_record` WHERE `phone_number`='$phoneNumber' AND `date`>='$start' AND `date`<='$end' ORDER BY id DESC");
		}
		elseif ($phoneNumber!='' && $agent!='all')
		{
			$deptData=mysql_query("SELECT * FROM `sms_record` WHERE `phone_number`='$phoneNumber' AND `sender`='$agent' AND `date`>='$start' AND `date`<='$end' ORDER BY id DESC");
		}
		elseif ($phoneNumber=='' && $agent!='all') {
			$deptData=mysql_query("SELECT * FROM `sms_record` WHERE `sender`='$agent' AND `date`>='$start' AND `date`<='$end' ORDER BY id DESC");
		}


		
		while ($deptRow=mysql_fetch_assoc($deptData)) 
		{
			?>
			<tr>
				<td><?php echo $sl; ?> </td>
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
<script type="text/javascript">
	$( document ).ready(function() {
		// $("#smsResult").DataTable();
		$("#smsResult").DataTable({
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
</script>