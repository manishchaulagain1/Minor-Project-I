<?php

if(!isset($_SESSION['auth'])) {
	$_SESSION['auth_status'] = "Login to Access Dashboard";
	header("Location: ../login.php");
	exit(0);	
}
else {
	if($_SESSION['auth'] == "1") {
		header("Location: ../dashboard/index.php");
		exit(0);
	}
	else {
		
	}
}
?>