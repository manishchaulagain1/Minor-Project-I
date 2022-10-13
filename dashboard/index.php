<!-- Header -->
<?php
    include('modules/authentication.php');
    include('includes/header.php');
?>

<!-- Webpage Title -->
<title>Admin Dashboard</title>

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

        <!-- Approve Modal -->
        <div class="modal fade" id="ApproveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="modules/code.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="update_id" class="approveStatus_id">
                            <p>Are you sure, you want to approve this event?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="Approvebtn" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Deny Modal -->
        <div class="modal fade" id="DenyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="modules/code.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="update_id" class="denyStatus_id">
                            <p>Are you sure, you want to deny this event?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="Denybtn" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="col-md-12 mt-3">
                <?php include('modules/message.php'); ?>
            </div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4">Admin Dashboard</h1>
            </div>

            <div class="row text-center mx-5 mb-4">
                <div class="col-sm-4 mt-4 mx-3" style="max-width: 18rem;">
                    <div class="card pt-2 pb-2 bg-secondary">
                        <div class="card-body">
                            <h5 class="card-title text-light">No. of Customers</h5>
                            <p class="card-text text-light">
                                <?php
                                    $query = "SELECT * FROM users WHERE role_id = 0; ";
                                    $query_run = mysqli_query($conn, $query);
                                    
                                    $num_rows = mysqli_num_rows($query_run);
                                    echo $num_rows;
                                ?>        
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-4 mx-3" style="max-width: 18rem;">
                    <div class="card pt-2 pb-2 bg-secondary">
                        <div class="card-body">
                            <h5 class="card-title text-light">Today's Event</h5>
                            <p class="card-text text-light">
                                <?php
                                    $query = "SELECT * FROM events WHERE event_date = CURRENT_DATE() AND event_status = 'Accepted' ";
                                    $query_run = mysqli_query($conn, $query);
                                    if($row = mysqli_fetch_assoc($query_run))
                                    {
                                        echo $row["event_type"];
                                    }
                                    else 
                                    {
                                        echo "No Event Today";
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-4 mx-3" style="max-width: 18rem;">
                    <div class="card pt-2 pb-2 bg-secondary">
                        <div class="card-body">
                            <h5 class="card-title text-light">Upcoming Events</h5>
                            <p class="card-text text-light">
                                <?php
                                    $query = "SELECT * FROM events WHERE event_date > CURRENT_DATE() AND event_status = 'Accepted' ";
                                    $query_run = mysqli_query($conn, $query);
                                    
                                    $num_rows = mysqli_num_rows($query_run);
                                    echo $num_rows;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h4">Booking Status</h1>
            </div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Customer</th>
                        <th scope="col">Event Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT CONCAT(firstname, ' ', lastname) AS name, event_type, event_date, start_time, end_time, guest, event_status, event_id FROM users, events WHERE users.id = events.user_id AND NOT event_status IN ('Accepted', 'Rejected') ORDER BY event_date DESC";
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0) {
                            foreach($query_run as $row) {                                
                                ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['event_type']; ?></td>
                                    <td><?php echo $row['event_date']; ?></td>
                                    <td><?php echo $row['start_time']; ?></td>
                                    <td><?php echo $row['end_time']; ?></td>
                                    <td><?php echo $row['guest']; ?></td>
                                    <td><?php echo $row['event_status']; ?></td>
                                    <td>
                                        <button type="button" value="<?php echo $row['event_id']; ?>" class="btn btn-info btn-sm approvebtn">Approve</button>
                                        <button type="button" value="<?php echo $row['event_id']; ?>" class="btn btn-danger btn-sm denybtn">Deny</button>
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
        </main>
    </div>
</div>

<?php include('includes/footer.php'); ?>