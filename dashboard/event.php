<!-- Header -->
<?php
    include('modules/authentication.php');
    include('includes/header.php');
?>

<!-- Webpage Title -->
<title>Event History</title>

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

        <!-- Delete Modal -->
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="modules/code.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="delete_id" class="delete_user_id">
                            <p>Are you sure, you want to delete this data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="DeleteEventbtn" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">  
            </div>

            <section class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if(isset($_SESSION['status'])) {
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> <?php echo $_SESSION['status']; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title h5">Event History</span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Event Type</th>
                                        <th>Booked By</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Guests</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT event_type, CONCAT(firstname, ' ', lastname) AS name, event_date, start_time, end_time, guest, event_status, event_id FROM users, events WHERE users.id = events.user_id ORDER BY event_date DESC;";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0) {
                                            foreach($query_run as $row) {                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['event_type']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['event_date']; ?></td>
                                                    <td><?php echo $row['start_time']; ?></td>
                                                    <td><?php echo $row['end_time']; ?></td>
                                                    <td><?php echo $row['guest']; ?></td>
                                                    <td><?php echo $row['event_status']; ?></td>
                                                    <td>
                                                        <a href="edit_events.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                        <button type="button" value="<?php echo $row['event_id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else {
                                            ?>
                                            <tr>
                                                <td>No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section> 
        </main>
    </div> 
</div>

<?php include('includes/footer.php'); ?>