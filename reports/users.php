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
					<h3 class="card-title">Users</h3>
					<button type="button" class="btn btn-info float-right btn-sm" onclick="usertData()">
						Add User
					</button>
				</div>
				<div class="card-body">
					<table id="district" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Name</th>
								<th>User Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>User Role</th>
								<th>Department</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							$userData=mysql_query("SELECT users.id AS 'id', users.name AS 'name', users.user_name AS 'user_name', users.email AS 'email', users.phone AS 'phone', users.role AS 'role', department.department_name AS 'department_name', users.status AS 'status' FROM `users` INNER JOIN department ON users.dept=department.id WHERE users.role!='superadmin'");
							while ($userRow=mysql_fetch_assoc($userData)) 
							{
								?>
								<tr>
									<td><?php echo $sl; ?></td>
									<td><?php echo $userRow['name']; ?></td>
									<td><?php echo $userRow['user_name']; ?></td>
									<td><?php echo $userRow['email']; ?></td>
									<td><?php echo $userRow['phone']; ?></td>
									<td><?php echo $userRow['role']; ?></td>
									<td><?php echo $userRow['department_name']; ?></td>
									<td>
										<a href="#" class="btn btn-warning mr-2 ml-2 btn-sm" onclick="userEditModal(<?php echo $userRow['id']; ?>)"><i class="far fa-edit"></i></a>
											<?php 
												if ($userRow['status']==1) 
												{
													?>
													<a href="#" class="btn btn-danger mr-2 ml-2 btn-sm" onclick="userActivity(<?php echo $userRow['id']; ?>, '0')"><i class="far fa-times-circle"></i></a>
													<?php
												}
												else
												{
													?>	
													<a href="#" class="btn btn-success btn-sm mr-2 ml-2" onclick="userActivity(<?php echo $userRow['id']; ?>, '1')"><i class="far fa-check-circle"></i></a>
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

<div class="modal fade" id="userModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">User</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="userData">

			</div> 
		</div>
	</div>
</div>


<script>         
	$(function () {
		$("table").DataTable({
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