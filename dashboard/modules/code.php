<?php
session_start();
include('connection.php');

if(isset($_POST['logout_btn'])) {
	if($_SESSION['auth'] == 1) {
		/*session_destroy();*/
		unset($_SESSION['auth']);
		unset($_SESSION['auth_user']);

		$_SESSION['status'] = "Logged out successfully!";
		header('Location: ../../login.php');
		exit(0);
		mysqli_close($conn);
	}
	else if($_SESSION['auth'] == 0) {
		/*session_destroy();*/
		unset($_SESSION['auth']);
		unset($_SESSION['auth_user']);

		mysqli_close($conn);
		$_SESSION['status'] = "Logged out successfully!";
		header('Location: ../../login.php');
		exit(0);
		mysqli_close($conn);
	}
}

if(isset($_POST['addUser'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];
	$address = $_POST['address'];
	$role_id = $_POST['role_id'];

	if($password == $confirmPassword) {
		$checkemail = "SELECT email FROM users WHERE email='$email' ";
		$checkemail_run = mysqli_query($conn, $checkemail);

		if(mysqli_num_rows($checkemail_run) > 0) {
			// Taken -- Already exists
			$_SESSION['status'] = "Email address is already taken!";
			header("Location: ../users.php");
			exit;
		}
		else {
			// Available = Record Not Found
			$password = md5($password);
			
			$query = "INSERT INTO users (firstname, lastname, phone, email, password, address, role_id) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password', '$address', $role_id)";
			$query_run = mysqli_query($conn, $query);
			
			if($query_run) {
				$_SESSION['status'] = "User Added Successfully";
				header("Location: ../users.php");
			}
			else {
				$_SESSION['status'] = "User Registration Failed";
				header("Location: ../users.php");
			}
		}
	}
	else {
		$_SESSION['status'] = "Password and Confirm Password does not match";
		header("Location: ../users.php");
	}
}

// update/edit user
if(isset($_POST['updateUser'])) {
	$user_id = $_POST['user_id'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$address = $_POST['address'];
	$role_id = $_POST['role_id'];

	$query = "UPDATE users SET firstname='$firstname', lastname='$lastname', phone='$phone', email='$email', password='$password', address='$address', role_id='$role_id' WHERE id='$user_id' ";
	$query_run = mysqli_query($conn, $query);
	
	if($query_run) {
		$_SESSION['status'] = "User Updating Successful";
		header("Location: ../users.php");
	}
	else {
		$_SESSION['status'] = "User Updating Failed";
		header("Location: ../users.php");
	}
}

// delete user
if(isset($_POST['DeleteUserbtn'])) {
	$userid = $_POST['delete_id'];

	$query = "DELETE FROM users WHERE id='$userid' ";
	$query_run = mysqli_query($conn, $query);

	if($query_run) {
		$_SESSION['status'] = "User Deletion Successful";
		header("Location: ../users.php");
	}
	else {
		$_SESSION['status'] = "User Deletion Failed";
		header("Location: ../users.php");
	}
}

// update/edit event

if(isset($_POST['updateEvent'])) {
	$event_id = $_POST['event_id'];
	$event_date = $_POST['event_date'];
	$start_time = $_POST['start_time'];
	$end_time = $_POST['end_time'];
	$guest = $_POST['guest'];
	$event_type = $_POST['event_type'];
	$event_status = $_POST['event_status'];

	$query = "UPDATE events SET event_type='$event_type', event_date='$event_date', start_time='$start_time', end_time='$end_time', guest='$guest',
	event_status='$event_status' WHERE event_id='$event_id' ";
	$query_run = mysqli_query($conn, $query);

	if($query_run) {
		$_SESSION['status'] = "Event Updating Successful";
		header("Location: ../event.php");
	}
	else {
		$_SESSION['status'] = "Event Updating Failed";
		header("Location: ../event.php");
	}
}

// delete event

if(isset($_POST['DeleteEventbtn'])) {
	$eventid = $_POST['delete_id'];

	$query = "DELETE FROM events WHERE event_id='$eventid' ";
	$query_run = mysqli_query($conn, $query);

	if($query_run) {
		$_SESSION['status'] = "Event Deletion Successful";
		header("Location: ../event.php");
	}
	else {
		$_SESSION['status'] = "Event Deletion Failed";
		header("Location: ../event.php");
	}
}

if(isset($_POST['DeleteFeedbackbtn'])) {
	$feedbackid = $_POST['delete_id'];

	$query = "DELETE FROM feedback WHERE feedback_id='$feedbackid' ";
	$query_run = mysqli_query($conn, $query);

	if($query_run) {
		$_SESSION['status'] = "Feedback Deletion Successful";
		header("Location: ../feedback.php");
	}
	else {
		$_SESSION['status'] = "Feedback Deletion Failed";
		header("Location: ../feedback.php");
	}
}

if(isset($_POST['Approvebtn'])) {
	$statusid = $_POST['update_id'];

	$query = "UPDATE events SET event_status = 'Accepted' WHERE event_id = '$statusid' ";
	$query_run = mysqli_query($conn, $query);

	if($query_run) {
		header("Location: ../index.php");
	}
	else {
		header("Location: ../index.php");
	}
}

if(isset($_POST['Denybtn'])) {
	$statusid = $_POST['update_id'];
	$query = "UPDATE events SET event_status = 'Rejected' WHERE event_id = '$statusid' ";
	$query_run = mysqli_query($conn, $query);

	if($query_run) {
		header("Location: ../index.php");
	}
	else {
		header("Location: ../index.php");
	}
}
?>