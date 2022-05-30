<?php
session_start();
include "../libs/database.php";
if ($_POST['check']=="departmentData") 
{
	?>
	<div class="col-md-12">
		<div class="form-group">
			<label>Department Name:<span class="text-danger">*</span></label>
			<input type="text" name="deptName" id="deptName" class="form-control form-control-sm">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-outline-info btn-sm" onclick="addDept()">Save</button>
		</div>
	</div>

	<?php
}

if ($_POST['check']=="addDept") 
{
	$deptName=$_POST['deptName'];
	$checkDept=mysql_num_rows(mysql_query("SELECT * FROM `department` WHERE `department_name`='$deptName'"));
	if ($checkDept!=0) 
	{
		echo "This Name Already in Our Database. Try Another One.";
	}
	else
	{
		$inserDept=mysql_query("INSERT INTO `department`(`department_name`) VALUES ('$deptName')");
		if ($inserDept)
		{
			echo "success";
		}
		else
		{
			echo "Something is wrong";
		}
	}
}
if ($_POST['check']=="editDeptData") 
{
	$id=$_POST['id'];
	$findDept=mysql_fetch_assoc(mysql_query("SELECT * FROM `department` WHERE `id`='$id'"));
	?>
	<div class="col-md-12">
		<div class="form-group">
			<label>Department Name:<span class="text-danger">*</span></label>
			<input type="text" name="upDeptName" id="upDeptName" class="form-control form-control-sm" value="<?php echo $findDept['department_name']; ?>">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-outline-info btn-sm" onclick="updateDept(<?php echo $findDept['id']; ?>)">Update</button>
		</div>
	</div>
	<?php
}

if ($_POST['check']=="updateDept") 
{
	$upId=$_POST['upId'];
	$upDeptName=$_POST['upDeptName'];
	$checkDept=mysql_num_rows(mysql_query("SELECT * FROM `department` WHERE `department_name`='$upDeptName'"));
	if ($checkDept!=0) 
	{
		echo "This Name Already in Our Database. Try Another One.";
	}
	else
	{
		$upDateDept=mysql_query("UPDATE `department` SET `department_name`='$upDeptName' WHERE `id`='$upId'");
		if ($upDateDept) 
		{
			echo "success";
		}
		else
		{
			echo "Something is Wrong...!";
		}
	}
}

if ($_POST['check']=="updateAction") 
{
	$action=$_POST['action'];
	$id=$_POST['id'];
	$updateAction=mysql_query("UPDATE `department` SET `action`='$action' WHERE `id`='$id'");
	if ($updateAction) 
	{
		echo 'success';
	}
	else
	{
		echo "Something is Wrong..!";
	}
}
?>