<?php
    include "connect.php";

    // Insert values
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    $mobile=$_POST["mobile"];
    $cpassword=$_POST["cpassword"];
    $cpassword=md5($cpassword);
    $role = '0';

    $sql="SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        echo "<script> alert('This email has already been regestered');</script>";
        echo "<script> window.location = '../registration.php';</script>";
    }
    else
    {
        $sql="INSERT INTO users (firstname,lastname,email,address,phone,password,role_id)
                VALUES('$fname','$lname','$email','$address','$mobile','$cpassword','$role')";
    
        if(mysqli_query($conn,$sql))
        {
            echo "<script> alert('Registeration has been successful');</script>";
            echo "<script> window.location = '../login.php';</script>";
        }
        else
        {
            echo "Error:".$sql."<br>".mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>