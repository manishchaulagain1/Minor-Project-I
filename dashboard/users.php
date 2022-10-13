<!-- Header -->
<?php
    include('modules/authentication.php');
    include('includes/header.php');
?>

<!-- Webpage Title -->
<title>Registered Users</title>

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

        <!-- User Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="modules/code.php" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First Name" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Last Name</label>
                                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="Address" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Give Role</label>
                                <select id="role" name="role_id" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="0">Customer</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="addUser" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
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
                            <button type="submit" name="DeleteUserbtn" class="btn btn-primary">Delete</button>
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
                                <span class="card-title h5">Registered Users</span>
                                <a href="#" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary btn-sm float-right">Add New User</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT id, CONCAT(firstname, ' ', lastname) AS name, email, phone, address, role_id FROM users";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0) {
                                            foreach($query_run as $row) {                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php 
                                                        if($row['role_id'] == "0") {
                                                            echo "Customer";
                                                        }
                                                        else if($row['role_id'] == "1") {
                                                            echo "Admin";
                                                        }
                                                        else {
                                                            echo "Invalid User";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="edit_users.php?user_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                        <button type="button" value="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm deletebtn">Delete</button>
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