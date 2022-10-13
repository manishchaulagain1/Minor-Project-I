<?php
session_start();

if(!isset($_SESSION['auth'])) {
	$_SESSION['auth_status'] = "Login to Access Dashboard";
	header("Location: ../login.php");
	exit(0);	
}
else {
	if($_SESSION['auth'] == "1") {

	}
	else {
		header("Location: ../profile/profile.php");
		exit(0);
	}
}
?>