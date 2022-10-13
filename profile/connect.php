<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="eventmenu_db";

    // Create connection
    $conn=mysqli_connect($servername,$username,$password,$dbname);

    // Check connection
    if(!$conn)
    {
        die("Connection Failed".mysqli_connect_error());
    }
    // echo "Connected Successfully";

?>