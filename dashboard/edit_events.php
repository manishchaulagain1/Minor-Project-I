<!-- Header -->
<?php
    include('modules/authentication.php');
    include('includes/header.php');
?>

<!-- Webpage Title -->
<title>Events</title>

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
	            				<span class="card-title h5">Edit - Events</span>
	                			<a href="event.php" class="btn btn-danger btn-sm float-right">Back</a>
	            			</div>
	            			<!-- /.card-header -->
	            			<div class="card-body">
	            				<div class="col-md-6">
	            					<form action="modules/code.php" method="POST">
								      <div class="modal-body">
								      	<?php
								      		if(isset($_GET['event_id'])) {
								      			$event_id = $_GET['event_id'];
								      			$query = "SELECT * FROM events WHERE event_id='$event_id' LIMIT 1";
								      			$query_run = mysqli_query($conn, $query);

								      			if(mysqli_num_rows($query_run) > 0) {
								      				foreach($query_run as $row) {
								      					?>
								      					<input type="hidden" name="event_id" value="<?php echo $row['event_id'] ?>">
								      					<div class="form-group">
												        	<label for="event_date">Event Date</label>
												        	<input type="text" id="event_date" name="event_date" value="<?php echo $row['event_date']; ?>" class="form-control" placeholder="YYYY-MM-DD" autocomplete="off" required>
												        </div>
								      					<div class="form-group">
												        	<label for="start_time">Start Time</label>
												        	<input type="text" id="start_time" name="start_time" value="<?php echo $row['start_time']; ?>" class="form-control" placeholder="Start Time" autocomplete="off" required>
												        </div>
												        <div class="form-group">
												        	<label for="end_time">End Time</label>
												        	<input type="text" id="end_time" name="end_time" value="<?php echo $row['end_time']; ?>" class="form-control" placeholder="End Time" autocomplete="off" required>
												        </div>
												        <div class="form-group">
												        	<label for="guest">Guests</label>
												        	<input type="text" id="guest" name="guest" value="<?php echo $row['guest']; ?>" class="form-control" placeholder="No. of Guests" autocomplete="off" required>
												        </div>
												        <div class="form-group">
												        	<label for="event_type">Event Type</label>
												        	<input type="text" id="event_type" name="event_type" value="<?php echo $row['event_type']; ?>" class="form-control" placeholder="Event Type" autocomplete="off" required>
												        </div>
												        <div class="form-group">
												        	<label for="">Action</label>
												        	<div class="form-check">
  																<input class="form-check-input" type="radio" name="event_status" id="approve" value="Accepted" checked>
  																<label class="form-check-label" for="approve">Approve</label>
															</div>
															<div class="form-check">
  																<input class="form-check-input" type="radio" name="event_status" id="deny" value="Rejected">
																<label class="form-check-label" for="deny">Deny</label>
															</div>
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
								        	<button type="submit" name="updateEvent" class="btn btn-info">Update</button>
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