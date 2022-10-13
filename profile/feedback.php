 <?php
    include "connect.php";

    // Insert Value
    parse_str($_POST["val"],$formdata);
    $feed=mysqli_real_escape_string($conn, $formdata["feed"]);
    $id=$formdata["id"];

    $sql="INSERT INTO feedback SET user_id ='$id', message ='$feed'";
    if(mysqli_query($conn, $sql))
    {
?>
        <span class="alert alert-success" id="feedalertt">
          <strong>Success!</strong> Thank you for your feedback.
        </span>
<?php
    }
    else 
    {
?>
        <span class="alert alert-danger" id="feedalertt">
            <strong>Error!</strong> Error Occured !
        </span>
<?php
        
    }

    mysqli_close($conn);
?>