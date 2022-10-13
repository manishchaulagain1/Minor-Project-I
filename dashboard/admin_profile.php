<!-- Header -->
<?php
    include('modules/authentication.php');
    include('includes/header.php');
?>

<!-- Webpage Title -->
<title>Admin Profile</title>

<!-- Navbar -->
<?php
    include('includes/navbar.php');
?>

<div class="container-fluid size-adjust">
    <div class="row">

        <!-- Sidebar -->
        <?php
            include('includes/sidebar.php');
            include('modules/connection.php');
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">  
            </div>

	    	<section class="container-fluid">
	    		<div class="row">
	    			<div class="col-md-12">
	    				<div class="card">
	            			<div class="card-header">
	            				<span class="card-title h5">Admin Profile</span>
	                			<a href="users.php" class="btn btn-danger btn-sm float-right">Back</a>
	            			</div>
	            			<!-- /.card-header -->
	            			<div class="card-body">
	            				<div class="col-md-6">
	            					<form class="form" action="modules/code.php" method="POST">
								      <div class="modal-body">
								      	<?php
								      		if(isset($_SESSION['auth_user']['user_id'])) {
								      			$user_id = $_SESSION['auth_user']['user_id'];
								      			$query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
								      			$query_run = mysqli_query($conn, $query);

								      			if(mysqli_num_rows($query_run) > 0) {
								      				foreach($query_run as $row) {
								      					?>
								      					<input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
								      					<div class="form-group">
												        	<label for="firstname">First Name</label>
												        	<input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" class="form-control" placeholder="First Name" autocomplete="off" required>
												        </div>
								      					<div class="form-group">
												        	<label for="lastname">Last Name</label>
												        	<input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" class="form-control" placeholder="Last Name" autocomplete="off" required>
												        </div>
												        <div class="form-group">
												        	<label for="phone">Phone Number</label>
												        	<input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" class="form-control" placeholder="Phone Number" autocomplete="off" required>
												        </div>
												        <div class="form-group">
												        	<label for="email">Email</label>
												        	<input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Email" autocomplete="off" required>
												        </div>
								      					<div class="form-group">
												        	<label for="address">Address</label>
												        	<input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" class="form-control" placeholder="Address" autocomplete="off" required>
												        </div>
								      					<?php
								      				}
								      			}
								      			else {
								      				echo "<h4>No Record Found!</h4>";
								      			}
								      		}
								      	?>
								      </div>
								      <div class="modal-footer">
								        	<button type="submit" name="updateUser" class="btn btn-info">Update</button>
								      </div>
								  	</form>
	            				</div>
	            			</div>
	      				</div>
	    			</div>
	    		</div>
	    	</section>
	    </main>
  	</div>
</div>

<?php include('includes/footer.php'); ?>