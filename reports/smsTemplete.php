<?php
session_start();
include "../libs/database.php";
$type = $_GET['type'];
?>
<div class="container-fluid mt-2">
	<div class="row">
		<!-- Services -->
		<div class="col-md-12" id="services_area">
			<div class="card card-info card-outline">
				<div class="card-header">
					<h3 class="card-title">Templete</h3><button type="button" class="btn btn-info float-right btn-sm" onclick="tempModal()">
						Add Templete
					</button>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Templete Name</th>
								<th>Subject</th>
								<th>Templete Type</th>
								<th>Creator</th>
								<th>Create At</th>
								<th>Update At</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$templete=mysql_query("SELECT * FROM `templete` WHERE `templete_type` = '".$type."'");
							while ($templeteRow=mysql_fetch_assoc($templete)) 
							{
								?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $templeteRow['templete_name']; ?></td>
									<td><?php echo $templeteRow['temp_subject']; ?></td>
									<td><?php echo $templeteRow['templete_type']; ?></td>
									<td><?php echo $templeteRow['creator']; ?></td>
									<td><?php echo $templeteRow['create_at']; ?></td>
									<td><?php echo $templeteRow['update_at']; ?></td>
									<td>
										<a href="#" class="btn btn-warning mr-2 ml-2 btn-sm" onclick="tempEditModal(<?php echo $templeteRow['id']; ?>)"><i class="far fa-edit"></i></a>
										<?php 
										if ($templeteRow['status']==1) 
										{
											?>
											<a href="#" class="btn btn-danger mr-2 ml-2 btn-sm" onclick="tempActiveSms(<?php echo $templeteRow['id']; ?>, '0')"><i class="far fa-times-circle"></i></a>
											<?php
										}
										else
										{
											?>	
											<a href="#" class="btn btn-success btn-sm mr-2 ml-2" onclick="tempActiveSms(<?php echo $templeteRow['id']; ?>, '1')"><i class="far fa-check-circle"></i></a>
											<?php
										}
										?>
									</td>
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

<div class="modal fade bd-example-modal-xl" id="tempModal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Templete</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="tempData">

			</div> 
		</div>
	</div>
</div>


<script>       
function tempActiveSms(id, status){
	var check="TEMPELETE_ACTION_STATUS";
    $.ajax({
        url: "reports/templeteAction.php",
        type: "POST",
        data: {
            id: id,
			status: status,
			check: check
        },
        success: function (response) {
			alert(response);
            // $("#deptData").html(response);
        }
    });
}  
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
// 	$(function () {
//     // Summernote
//     $('#message_body').summernote(
//     {
//     	height: 400,
//     	focus: true
//     }
//     );
// });
</script>