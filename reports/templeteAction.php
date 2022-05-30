<?php
session_start();
include "../libs/database.php";
if ($_POST['check']=="tempModal") 
{
	?>
	<div class="row">
		<div class="col-md-12 p-3">		
			<div class="form-group">
				<label>Template Name<span class="text-danger">*</span></label>
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="templeteName" placeholder="Enter TemplateName">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-file-signature"></span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Templete Type<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<select class="custom-select" id="tempType" onchange="getType(this.value)">
						<option selected>Choose Templete Type</option>
						<option value="SMS">SMS</option>
						<option value="Email">Email</option>
					</select>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-chevron-circle-down"></span>
						</div>
					</div>
				</div>
			</div>
			<div id="messageBodyArea">
				
			</div>
		</div>

		<?php
	}

	if ($_POST['check']=="changeTYpe") 
	{
		if ($_POST['type']=="Email") 
		{
			?>
			<div class="form-group">
				<label>Email Subject<span class="text-danger">*</span></label>
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="templeteSubject" placeholder="Enter templete subject">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="far fa-bookmark"></span>
						</div>
					</div>
				</div>
			</div>
			

			<textarea name="message_body" id="message_body" placeholder="Describe your text here..."></textarea>
			<script>
				CKEDITOR.replace('message_body', {
					height: 300,
					filebrowserUploadUrl: "reports/upload.php"
				});
			</script>
		</div>		

		<div class="col-md-12">
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-outline-info btn-sm" onclick="addTemplete()">Store</button>
			</div>
		</div>
		<script type="text/javascript">
			$(function () {
    // Summernote
    // $('#message_body').summernote(
    // {
    // 	height: 300,
    // 	focus: true,

    // });
});
</script>
<?php
}
if ($_POST['type']=="SMS") {
	?>
	<div class="form-group">
		<label>Body<span class="text-danger">*</span></label>
		<textarea id="message_body" class="form-control" style="height: 300px !important;" placeholder="Describe your text here..."></textarea>   
	</div>
</div>		

<div class="col-md-12">
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-outline-info btn-sm" onclick="addSMSTemplete()">Store</button>
	</div>
</div>
<?php
}

}

if ($_POST['check']=="storeTemplete") 
{
	$templeteName=$_POST['templeteName'];
	$tempType=$_POST['tempType'];
	$templeteSubject=$_POST['templeteSubject'];
	$message_body=$_POST['message_body'];
	$creator=$_SESSION['name'];
	$checkTemp=mysql_num_rows(mysql_query("SELECT * FROM `templete` WHERE `templete_name`='$templeteName'"));
	if ($checkTemp>0) 
	{
		echo "This name already in our database";
	}
	else
	{
		$storeTemp=mysql_query("INSERT INTO `templete`( `templete_name`, `temp_subject`, `templete_type`, `body`, `creator`) VALUES ('$templeteName', '$templeteSubject','$tempType','$message_body','$creator')");
		if ($storeTemp) 
		{
			echo "success";
		}
		else
		{
			echo "Something is wrong..!";
		}
	}	
}

if ($_POST['check']=="tempEditView") 
{
	$id=$_POST['id'];
	$templeteItem=mysql_fetch_assoc(mysql_query("SELECT * FROM `templete` WHERE `id`='$id'"));
	?>
	<div class="row">
		<div class="col-md-12 p-3">		
			<div class="form-group">
				<label>Template Name<span class="text-danger">*</span></label>
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="templeteNameUp" value="<?php echo $templeteItem['templete_name']; ?>" placeholder="Enter TemplateName">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-file-signature"></span>
						</div>
					</div>
				</div>
			</div>
			<?php 
			if ($templeteItem['templete_type']=="Email")
			{
				?>
				<div class="form-group">
					<label>Email Subject<span class="text-danger">*</span></label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="templeteSubjectUp" value="<?php echo $templeteItem['temp_subject']; ?>" placeholder="Enter templete subject">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="far fa-bookmark"></span>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			
			<div class="form-group">
				<label for="exampleInputEmail1">Templete Type<span class="text-danger">*</span></label>
				<div class="input-group mb-1">
					<select class="custom-select" id="tempTypeUp" disabled>
						<option value="SMS" <?php if ($templeteItem['templete_type']=="SMS") {
							echo "selected";
						} ?>>SMS</option>
						<option value="Email" <?php if ($templeteItem['templete_type']=="Email") {
							echo "selected";
						} ?>>Email</option>
					</select>
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-chevron-circle-down"></span>
						</div>
					</div>
				</div>
			</div>
			<?php 
			if ($templeteItem['templete_type']=="SMS") 
			{
				?>
				<div class="form-group">
					<label>Body<span class="text-danger">*</span></label>
					<textarea id="message_bodyUp" name="message_bodyUp" class="form-control"><?php echo $templeteItem['body']; ?></textarea>   
				</div>

				<?php
			}
			if ($templeteItem['templete_type']=="Email") 
			{
				?>
				<div class="form-group">
					<label>Body<span class="text-danger">*</span></label>
					<textarea id="message_bodyUp" name="message_bodyUp" class="form-control"><?php echo $templeteItem['body']; ?></textarea>
				</div>
				<script>
					CKEDITOR.replace('message_bodyUp', {
						height: 300,
						filebrowserUploadUrl: "reports/upload.php"
					});
				</script> 
				<?php  
			}
			?>
		</div>
	</div>		

	<div class="col-md-12">
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-outline-info btn-sm" onclick="updateTemplete(<?php echo $templeteItem['id']; ?>)">Update</button>
		</div>
	</div>
</div>

<?php
}

if ($_POST['check']=="updateTemplete") 
{

	$templeteNameUp=$_POST['templeteNameUp'];
	$tempTypeUp=$_POST['tempTypeUp'];
	$message_bodyUp=$_POST['message_bodyUp'];
	$templeteSubjectUp=$_POST['templeteSubjectUp'];
	$creator=$_SESSION['name'];
	$id=$_POST['id'];

	$updateTemp=mysql_query("UPDATE `templete` SET `templete_name`='$templeteNameUp',`templete_type`='$tempTypeUp',`body`='$message_bodyUp',`temp_subject`='$templeteSubjectUp',`creator`='$creator', `update_at`=CURRENT_TIMESTAMP WHERE `id`='$id'");
	if ($updateTemp) 
	{
		echo 'success';
	}
	else
	{
		echo "Something is Wrong..!";
	}
}
if ($_POST['check']=="TEMPELETE_ACTION_STATUS") 
{

	$status=$_POST['status'];
	$id=$_POST['id'];

	$updateTemp=mysql_query("UPDATE `templete` SET `status`='$status' WHERE `id`='$id'");
	if ($updateTemp) 
	{
		echo 'success';
	}
	else
	{
		echo "Something is Wrong..!";
	}
}

if ($_POST['check']=="selectSMStemp") 
{
	$templeteID=$_POST['templeteID'];
	$selectSMSTemp=mysql_fetch_assoc(mysql_query("SELECT * FROM `templete` WHERE `id`='$templeteID'"));
	$user_role=$_SESSION['role'];
	$retuenArrq=array(
		"role"=>$user_role,
		"message"=>$selectSMSTemp['body']
	);
	echo json_encode($retuenArrq);
}
if ($_POST['check']=="selectEmailtemp") 
{
	$templeteID=$_POST['templeteID'];
	$selectTemp=mysql_fetch_assoc(mysql_query("SELECT * FROM `templete` WHERE `id`='$templeteID'"));
	$retuenArr=array(
		"body"=>$selectTemp['body'],
		"subject"=>$selectTemp['temp_subject']
	);
	echo json_encode($retuenArr);
	// echo $selectTemp['body'];
}
?>