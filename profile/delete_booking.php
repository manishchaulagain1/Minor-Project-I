 <?php
    include "connect.php";

    $id=$_POST["id"];

    // Delete values
    $sql="DELETE FROM events WHERE user_id='$id'";
    if(mysqli_query($conn,$sql))
    {
?>
        <div class="custom-file text-center mt-3" style="height:50px;">
            <h4>Booking has been cancelled</h4>
        </div>
<?php
    }
    else 
    {
        echo "Error";    
    }
    mysqli_close($conn);
?>