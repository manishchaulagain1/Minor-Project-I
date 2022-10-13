<!-- Modal Header -->
<div class="modal-header">
    <h5 class="text-center">Venue Booked Details:</h5>
    <button type="button" class="close"  data-dismiss="modal">&times;</button>
</div>

<!-- Modal Content -->
<div class="modal-body" id="modal-body">
    <?php
        include "connect.php";
        // Select values
        $id=$_POST["val"];

        $sql="SELECT * FROM events WHERE user_id ='$id'"; 
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0)
        {
            while($row = mysqli_fetch_assoc($result))   
            {
    ?>
        <div class="custom-file text-center" style="height:320px;" id="viewcontent">
            <div class="row form-group">
                <div class="col">
                    <label for="">Date:</label>
                </div>
                <div class="col">
                    <label for=""><?=$row["event_date"]?></label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col">
                    <label for="">Start Time:</label>
                </div>
                <div class="col">
                    <label for=""><?=$row["start_time"]?></label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col">
                    <label for="">End Time:</label>
                </div>
                <div class="col">
                    <label for=""><?=$row["end_time"]?></label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col">
                    <label for="">No. of Guests:</label>
                </div>
                <div class="col">
                    <label for=""><?=$row["guest"]?></label>
                </div>
            </div> 
            <div class="row form-group">
                <div class="col">
                    <label for="">Event Type:</label>
                </div>
                <div class="col">
                    <label for=""><?=$row["event_type"]?></label>
                </div>
            </div> 
            <div class="row form-group">
                <div class="col">
                    <label for="">Booking Status:</label>
                </div>
                <div class="col">
                    <label for=""><?=$row["event_status"]?></label>
                </div>
            </div> 
            <div class="row form-group">
                <div class="col">
                                            
                    <input type="submit" id="delete" class="btn btn-dark btn-sm" value="Delete"
                        <?php 
                            if((strtotime($row["event_date"])-'172800')<=strtotime(date("Y-m-d")))
                            {
                                echo 'disabled';
                            }
                        ?> 
                    >
                    <script>
                        $(document).ready(function(){
                            $("#delete").click(function(){
                                $.ajax({
                                    type: "POST",
                                    url: 'delete_booking.php',
                                    data: {id: '<?=$id?>'},
                                    success: function(data){
                                        $("#modal-body").html(data);
                                        $("#date").val("");
                                        $("#stime").val("");
                                        $("#etime").val("");
                                        $("#guest").val("");
                                        $("#eventtype").val("Events");
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    <?php
            }
        }
        else
        {
    ?>

        <div class="custom-file text-center mt-3" style="height:50px;">
            <h4>Venue has not been Booked yet</h4>
        </div>

    <?php  
        }
            mysqli_close($conn);
    ?>
</div>


