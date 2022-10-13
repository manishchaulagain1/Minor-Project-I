<!-- Header -->
<?php
    include('modules/authentication.php');
    include('includes/header.php');
?>

<!-- Webpage Title -->
<title>Feedback</title>

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
                        <h5 class="modal-title" id="exampleModalLabel">Delete Feedback</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="modules/code.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="delete_id" class="delete_feedback_id">
                            <p>Are you sure, you want to delete this data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="DeleteFeedbackbtn" class="btn btn-primary">Delete</button>
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
                                <span class="card-title h5">Feedback</span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Message</th>
                                        <th>Given By</th>
                                        <th>Post Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT feedback_id, message, CONCAT(firstname, ' ', lastname) AS name, feedback.created_at AS created_at FROM users, feedback WHERE users.id = feedback.user_id ORDER BY feedback.created_at DESC";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0) {
                                            foreach($query_run as $row) {                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['message']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php
                                                        include_once 'modules/time_ago.php';
                                                        echo time_ago($row['created_at']);
                                                        ?>        
                                                    </td>
                                                    <td>
                                                        <button type="button" value="<?php echo $row['feedback_id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
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