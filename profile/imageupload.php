<?php
    include "connect.php";

    // Insert values
    $id = $_POST["id"];
    $filename1 = $_FILES["inpfile"]["name"];
    $filename = $filename1.uniqid();
    $tempname = $_FILES["inpfile"]["tmp_name"];    
    
    $folder = "C:\laragon\www\Minor Project - Final\profile\images/".$filename;

    // Delete image from folder
    $sql="SELECT * FROM pic WHERE user_id='$id'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))   
        {
            $preimage=$row["image"];
        }
    }

    $prefolder = "C:\laragon\www\Minor Project - Final\profile\images/".$preimage;
    unlink($prefolder);
    
     // Insert and Update image  
    $sql="SELECT * FROM pic WHERE user_id='$id'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_assoc($result))   
        {
            $sql = "UPDATE pic SET image = '$filename' WHERE user_id='$id' ";

            // Now let's move the uploaded image into the folder: images
            if (move_uploaded_file($tempname, $folder) && mysqli_query($conn,$sql))  
            {
                header("Location: profile.php");
            }
            else
            {
                $sql = "UPDATE pic SET image = 'pic.png' WHERE user_id='$id' ";

                if(mysqli_query($conn,$sql))
                {
                    header("Location: profile.php");
                }
            }
        }
    }
    else
    {
        $sql = "INSERT INTO pic(user_id,image) VALUES ('$id','$filename')";

        // Now let's move the uploaded image into the folder: images
        if (move_uploaded_file($tempname, $folder) && mysqli_query($conn,$sql))  
        {
            header("Location: profile.php");
        }
        else
        {
            header("Location: profile.php");
        }
    }

    mysqli_close($conn);
?>
