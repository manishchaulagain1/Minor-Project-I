<?php
	$host = "localhost";
	$username = "root";
	$password = "";
	$dbname = "eventmenu_db";

	// Connection
	$conn = mysqli_connect("$host", "$username", "$password", "$dbname");

	// Check connection
	if(!$conn) {
		header("Location: dbconn_error.php");
		die();
	}
?>