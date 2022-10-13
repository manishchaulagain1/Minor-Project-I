<?php
    include "connect.php";

    parse_str($_POST["val"], $formdata);

    // Insert values
    $id=$formdata["id"];
    $date=$formdata["date"];
    $stime=$formdata["stime"];
    $etime=$formdata["etime"];
    $guest=$formdata["guest"];
    $eventtype=$formdata["eventtype"];
    $eventstatus="Pending";

    $sql = "SELECT * FROM events WHERE event_date='$date' AND user_id !='$id'";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
?>
        <span class="alert alert-danger" id="venuealertt">
          <strong>Error!</strong> Booking is not available for this date
        </span>
<?php  
    }
    else 
    {
        $sql="SELECT * FROM events WHERE user_id ='$id'";
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0)
        {
            $row = mysqli_fetch_assoc($result);
            
            if((strtotime($row["event_date"])-'86400')<=strtotime(date("Y-m-d")))
            {
?>
                <span class="alert alert-danger" id="venuealertt">
                  <strong>Error!</strong> Booking cannot be updated before 24 hour
                </span>
<?php
            }
            else
            {
                $sql = "UPDATE events
                        SET  event_date = '$date', start_time = '$stime', end_time = '$etime', event_type = '$eventtype', guest = '$guest', event_status = '$eventstatus'
                        WHERE user_id = '$id' ";

                if (mysqli_query($conn,$sql))  
                {
?>
                <span class="alert alert-success" id="venuealertt">
                  <strong>Success!</strong> Successfully Updated
                </span>
<?php
                }
                else
                {
                    echo "Error:".$sql."<br>".mysqli_error($conn);
                }
            }
        }
        else
        {
            $sql="INSERT INTO events (user_id, event_date, start_time, end_time, event_type, guest, event_status)
                    VALUES('$id','$date','$stime','$etime','$eventtype','$guest','$eventstatus')";
        
            if(mysqli_query($conn,$sql))
            {
?>
                <span class="alert alert-success" id="venuealertt">
                  <strong>Success!</strong> Successfully Inserted 
                </span>
<?php
            }
            else
            {
                echo "Error:".$sql."<br>".mysqli_error($conn);
            }
            
        }
    }
    
    mysqli_close($conn);
?>