  <?php
    include "connect.php";

    // Select values
    $id=$_POST["val"];

    $sql="SELECT * FROM events WHERE user_id ='$id'"; 
    $result=mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result))   
    {

        $date = $row["event_date"];
        $start = $row["start_time"];
        $end = $row["end_time"];
        $guest = $row["guest"];
        $type = $row["event_type"];

        $return = array("date" => $date, "start" => $start, "end" => $end, "guest" => $guest, "type" => $type);
    }

    echo json_encode($return);
    
    mysqli_close($conn);
?>