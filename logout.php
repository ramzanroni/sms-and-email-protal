<?php
include "libs/db_conn.php";
session_start();
	unset($_SESSION['user_name'], $_SESSION['name'], $_SESSION['role']);
	if(!isset($_SESSION['user_name']))
	{
		header("Location: ./index.php");
	}
	else
	{
		echo "Session don't destroy..!";
	}

?>