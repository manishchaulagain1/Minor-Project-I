</head>
<body>
<nav class="shadow-sm main-header navbar navbar-expand navbar-dark bg-dark fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">VenueMenu</a>
    </div>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <button class="btn btn-secondary dropdown-toggle shadow-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
                if(isset($_SESSION['auth'])) {
                    echo $_SESSION['auth_user']['user_firstname']." ".$_SESSION['auth_user']['user_lastname'];
                }
                else{
                    echo "Not Logged In!";
                } 
            ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="admin_profile.php">Admin Profile</a>
                <form action="modules/code.php" method="POST">
                    <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav>