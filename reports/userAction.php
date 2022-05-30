<?php 
session_start();
include '../libs/database.php';
if ($_POST['check']=='userLogin') 
{
	$userName=$_POST['userName'];
	$password=$_POST['password'];
	$userInfo=mysql_query("SELECT * FROM `users` WHERE `user_name`='$userName' AND `password`='$password'");
	if (mysql_num_rows($userInfo)>0) 
	{
		$userData=mysql_fetch_assoc($userInfo);
		$_SESSION['user_name']=$userData['user_name'];
		$_SESSION['name']=$userData['name'];
		$_SESSION['role']=$userData['role'];
		$_SESSION['dept']=$userData['dept'];
		echo "success";
	}
	else
	{
		echo "Please Provide valid User Information";
	}
}

if ($_POST['check']=="addUserData") 
{
	?>
	<div class="row">
		<div class="col-md-12 mt-1">
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">Name<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="name" placeholder="Enter Your Name">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">User Name<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="userName" placeholder="Enter Your Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user-check"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">Email Address<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="userEmail" placeholder="Enter Your Email">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-at"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">Phone<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="userPhone" placeholder="Enter Your Phone Number">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-mobile-alt"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">Password<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<style type="text/css">
						.tooltip > .arrow {
							left: 50% !important;
							transform: translateX(-50%);
						}
					</style>
					<input type="password" class="form-control" data-toggle="tooltip" title="Password Formate like 'Abc@12as'" data-offset="50%, 3" id="userPass" onkeyup="checkPassword(this.value)" placeholder="Enter Your Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-unlock-alt"></span>
						</div>
					</div>
					<i class="far fa-check-circle mx-3 fa-2x text-success"></i>
				</div>
				<small><span class="error" id="passwordError">Invalid password</span></small>
				<input type="hidden" id="errorField">
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">User Role<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<select class="custom-select" id="userRole">
						<option selected value="">Choose User Role</option>
						<option value="Admin">Admin</option>
						<option value="User">User</option>
						
					</select>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user-tag"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-3 float-left">
				<label for="exampleInputEmail1">User Department<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<select class="custom-select" id="userDept">
						<option selected value="">Choose User Department</option>
						<?php 
						$userDept=mysql_query("SELECT * FROM `department` WHERE `action`=1");
						while ($userDeptRow=mysql_fetch_assoc($userDept)) 
						{
							?>
							<option value="<?php echo $userDeptRow['id']; ?>"><?php echo $userDeptRow['department_name']; ?></option>
							<?php
						}
						?>
					</select>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user-shield"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-outline-info btn-sm" onclick="addUser()">Save</button>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("[data-toggle=tooltip]").tooltip('show');
		});
	</script>
	
	<?php
}

if ($_POST['check']=="addUser") 
{
	$name=$_POST['name'];
	$userName=$_POST['userName'];
	$userEmail=$_POST['userEmail'];
	$userPhone=$_POST['userPhone'];
	$userPass=$_POST['userPass'];
	$userRole=$_POST['userRole'];
	$userDept=$_POST['userDept'];
	$checkUser=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `user_name`='$userName'"));
	if ($checkUser>0) 
	{
		echo "Similer user name already exist in our database. Please try another username..";
	}
	else
	{
		$userAdd=mysql_query("INSERT INTO `users`( `name`, `user_name`, `email`, `phone`, `password`, `role`, `dept`) VALUES ('$name','$userName','$userEmail','$userPhone','$userPass','$userRole','$userDept')");
		if ($userAdd) 
		{
			echo "success";
		}
		else
		{
			echo "Something is wrong..!";
		}
	}
}


if ($_POST['check']=="addUserDataModal") 
{
	$id=$_POST['id'];
	$userRecordRow=mysql_fetch_assoc(mysql_query("SELECT users.id AS 'id', users.name AS 'name', users.user_name AS 'user_name', users.email AS 'email', users.phone AS 'phone', users.role AS 'role', department.department_name AS 'department_name', users.status AS 'status', users.password AS 'password' FROM `users` INNER JOIN department ON users.dept=department.id WHERE users.id='$id'"));
	?>
	<div class="row">
		<div class="col-md-12 mt-3">
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">Name<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="nameUp" value="<?php echo $userRecordRow['name']; ?>" placeholder="Enter Your Name">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">User Name<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="userNameUp" value="<?php echo $userRecordRow['user_name']; ?>" placeholder="Enter Your Username">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user-check"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">Email Address<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="userEmailUp" value="<?php echo $userRecordRow['email']; ?>" placeholder="Enter Your Email">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-at"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">Phone<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="userPhoneUp" value="<?php echo $userRecordRow['phone']; ?>" placeholder="Enter Your Phone Number">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-mobile-alt"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 mt-3 float-left">
				<style type="text/css">
						.tooltip > .arrow {
							left: 50% !important;
							transform: translateX(-50%);
						}
					</style>
				<label for="exampleInputEmail1">Password<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<input type="text" class="form-control" id="userPassUp" value="<?php echo $userRecordRow['password']; ?>" data-toggle="tooltip" title="Password Formate like 'Abc@12as'" data-offset="50%, 3" onkeyup="checkPassword(this.value)" placeholder="Enter Your Password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-unlock-alt"></span>
						</div>
					</div>
					<i class="far fa-check-circle mx-3 fa-2x text-success"></i>
				</div>
				<small><span class="error" id="passwordError">Invalid password</span></small>
				<input type="hidden" id="errorField">
			</div>
			<div class="col-md-6 mt-3 float-left">
				<label for="exampleInputEmail1">User Role<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<select class="custom-select" id="userRoleUp">
						<option value="Admin" <?php if ($userRecordRow['role']=="Admin"){
							echo "selected";
						} ?>>Admin</option>
						<option value="User" <?php if ($userRecordRow['role']=="User"){
							echo "selected";
						} ?>>User</option>
						
					</select>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user-tag"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 mt-3 float-left">
				<label for="exampleInputEmail1">User Department<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<select class="custom-select" id="userDeptUp">
						<?php 
						$userDept=mysql_query("SELECT * FROM `department` WHERE `action`=1");
						while ($userDeptRow=mysql_fetch_assoc($userDept)) 
						{
							?>
							<option value="<?php echo $userDeptRow['id']; ?>" <?php if ($userRecordRow['department_name']==$userDeptRow['department_name']) {
								echo "selected";
							} ?>><?php echo $userDeptRow['department_name']; ?></option>
							<?php
						}
						?>
					</select>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-user-shield"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-outline-info btn-sm" onclick="userUpdate(<?php echo $userRecordRow['id']; ?>)">Update</button>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#errorField").val('ok');
			$('.error').hide();
			$("[data-toggle=tooltip]").tooltip('show');
		});
	</script>
	<?php
}

if ($_POST['check']=="updateUser") 
{
	$idUp=$_POST['id'];
	$nameUp=$_POST['nameUp'];
	$userNameUp=$_POST['userNameUp'];
	$userEmailUp=$_POST['userEmailUp'];
	$userPhoneUp=$_POST['userPhoneUp'];
	$userPassUp=$_POST['userPassUp'];
	$userRoleUp=$_POST['userRoleUp'];
	$userDeptUp=$_POST['userDeptUp'];
	$checkUser=mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `user_name`='$userNameUp' AND `id` !='$idUp'"));
	if ($checkUser>0) 
	{
		echo "Similer user name already exist in our database. Please try another username..";
	}
	else
	{
		$updateUser=mysql_query("UPDATE `users` SET `name`='$nameUp',`user_name`='$userNameUp',`email`='$userEmailUp',`phone`='$userPhoneUp',`password`='$userPassUp',`role`='$userRoleUp',`dept`='$userDeptUp' WHERE `id`='$idUp'");
		if ($updateUser) 
		{
			echo 'success';
		}
		else
		{
			echo "Some thing is wrong..!";
		}
	}
}

if ($_POST['check']=="userActivity") 
{
	$id=$_POST['id'];
	$action=$_POST['action'];
	$updateStatus=mysql_query("UPDATE `users` SET `status`='$action' WHERE `id`='$id'");
	if ($updateStatus) 
	{
		echo 'success';
	}
	else
	{
		echo "Something is wrong...!";
	}
}
?>