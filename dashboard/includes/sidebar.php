<?php
    $filename = basename($_SERVER["SCRIPT_FILENAME"], '.php');
?>
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link<?php echo ($filename == 'index') ? ' active' : ''; ?>" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php echo ($filename == 'users') ? ' active' : ''; ?>" href="users.php">Registered Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php echo ($filename == 'event') ? ' active' : ''; ?>" href="event.php">Event History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link<?php echo ($filename == 'feedback') ? ' active' : ''; ?>" href="feedback.php">Feedback</a>
            </li>
        </ul>
    </div>
</nav>