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
					<h3 class="card-title">Department</h3>
					<button type="button" class="btn btn-info float-right btn-sm" onclick="departmentData()">
						Add Department
					</button>
				</div>
				<div class="card-body">
					<table id="district" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Department Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$deptData=mysql_query("SELECT * FROM `department` ORDER BY `id` DESC");
							while ($deptRow=mysql_fetch_assoc($deptData)) 
							{
								?>
									<tr>
										<td><?php echo $sl; ?></td>
										<td><?php echo $deptRow['department_name']; ?></td>
										<td>
											<a href="#" class="btn btn-warning mr-2 ml-2 btn-sm" onclick="openEditModal(<?php echo $deptRow['id']; ?>)"><i class="far fa-edit"></i></a>
											<?php 
												if ($deptRow['action']==1) 
												{
													?>
													<a href="#" class="btn btn-danger mr-2 ml-2 btn-sm" onclick="changeActive(<?php echo $deptRow['id']; ?>, '0')"><i class="far fa-times-circle"></i></a>
													<?php
												}
												else
												{
													?>	
													<a href="#" class="btn btn-success btn-sm mr-2 ml-2" onclick="changeActive(<?php echo $deptRow['id']; ?>, '1')"><i class="far fa-check-circle"></i></a>
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

<div class="modal fade" id="deptModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Department</h4>
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