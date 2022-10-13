<?php
session_start();
include('authentication.php');

/*$id = $_SESSION["id"];*/
$id = $_SESSION['auth_user']['user_id'];

if(!isset($id))
{ 
  header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo-icon.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Profile</title>

    <!-- Files from Ishwor -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/Main.css">
</head>

<body> 
<?php include "profileheader.php"; ?>
<div class="container mt-4">
    <div class="row">
    
    <div class="col-md-5 d-flex justify-content-center" style="height:450px; border-bottom: 1px solid lightgrey;">
        <div class="mt-5"> 
            <?php
                include "connect.php";

                // Select values
                $sql="SELECT * FROM pic WHERE user_id='$id'";
                $result=mysqli_query($conn,$sql);

                if(mysqli_num_rows($result)>0)
                {
                    while($row = mysqli_fetch_assoc($result))   
                    {
                        if($row["image"]=='pic.png')
                        {
            ?>
                            <img src="img/<?=$row["image"]?>" width="270px" height="260px" id="photo">
            <?php
                        }
                        else
                        {
            ?>
                            <img src="images/<?=$row["image"]?>" width="270px" height="260px" id="photo">
            <?php
                        }
                    }
                }
                else
                {
            ?>
                    <img src="img/pic.png" width="270px" height="260px" id="photo">
            <?php
                }

                mysqli_close($conn);
            ?>
            
            <div class="text-center mt-4">
                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#myModal">Upload Photo</button>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="text-center">Upload Photo</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                            
                        <!-- Modal Content -->
                        <div class="modal-body">
                            <form action="imageupload.php" method="POST" enctype="multipart/form-data">
                                <div class="custom-file mb-3 mt-3">
                                    <input type="file" class="custom-file-input" id="inpfile" name="inpfile">
                                    <input type="hidden" name="id" value="<?=$id?>">
                                    <label class="custom-file-label" for="inpfile">Choose file</label>
                                </div>
                                <hr>

                                <script>
                                    // Add the following code if you want the name of the file appear on select
                                    $(".custom-file-input").on("change", function() {
                                    var fileName = $(this).val().split("\\").pop();
                                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                    });
                                </script>

                                <div class="text-center">
                                    <input type="submit" class="btn btn-dark btn-sm mr-3" value="Submit" id="submit-img">
                                    <button type="button" class="btn btn-dark btn-sm ml-3" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

        <!-- To upload image using javascript -->
        <!-- <script>
            var photo=document.getElementById("photo");
            var inpfile=document.getElementById("inpfile");
            var submit=document.getElementById("submit-img");

            submit.addEventListener('click', function(){
                var file=inpfile.files[0];

                if(file)
                {
                    var reader=new FileReader();
                    
                    reader.addEventListener('load',function(){
                        photo.setAttribute('src', this.result);
                    });

                    reader.readAsDataURL(file);
                }
                else
                {
                    photo.setAttribute('src',"images/pic.png");
                }
            });
        </script> -->
            
    <div class="col-md-7 d-flex justify-content-center align-items-center" style="height:450px; border-bottom: 1px solid lightgrey;">
        <table class="table table-sm table-borderless mt-n5" style="width:400px;">
            <?php
                include "connect.php";

                // Select values
                // When we use serialize to pass values we need to use parse_str
                $sql= "SELECT * FROM users WHERE id='$id'";
                $result=mysqli_query($conn,$sql);

                if(mysqli_num_rows($result)>0)
                {
                    while($row = mysqli_fetch_assoc($result))   
                    {
            ?>
                    <tr>
                        <td>Name:</td>
                        <td><?=$row["firstname"]?> <?=$row["lastname"]?></td>
                    </tr>

                    <tr>
                        <td>Email:</td>
                        <td><?=$row["email"]?></td>
                    </tr>

                    <tr>
                        <td>Address:</td>
                        <td><?=$row["address"]?></td>
                    </tr>

                    <tr>
                        <td>Phone:</td>
                        <td><?=$row["phone"]?></td>
                    </tr>

                    <tr>
                        <td>Booking Details:</td>
                        <td>
                            <button type="button" class="btn btn-dark btn-sm" id="view" data-toggle="modal" data-target="#booking">View</button>
                        </td>
                        <!-- The Modal -->
                        <div class="modal" id="booking">
                            <div class="modal-dialog ">
                                <div class="modal-content">

                                    <!-- View.php contents appear here -->
                                    <div id="viewmodal"></div>

                                </div>
                            </div>
                        </div>
                    </tr>

            <?php
                    }
                }
                else
                {
                    echo "O result";
                }

                mysqli_close($conn);
            ?>

        </table>
    </div>

    <div class="col-md-12" style="height:580px; border-bottom: 1px solid lightgrey;">
        <h2 class="text-center" style="margin-top:60px;">Venue Booking:</h2>

        <div style="max-width:600px" class="mt-5 mx-auto">
            <form action="" method="post" id="venue-book">
                <div class="row form-group">
                    <div class="col-4">
                        <label for="">Date:</label>
                    </div>
                    <div class="col">
                        <input class="form-control" type="date" name="date" id="date" autocomplete="off">
                        <div id="invaliddate" class="text-danger"></div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-4">
                        <label for="">Start Time: (eg. 2:51pm)</label>
                    </div>
                    <div class="col">
                        <input class="form-control" type="time" name="stime" id="stime" autocomplete="off">
                        <div id="invalidstime" class="text-danger"></div>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-4">
                        <label for="">End Time: (eg. 2:51pm)</label>
                    </div>
                    <div class="col">
                        <input class="form-control" type="time" name="etime" id="etime" autocomplete="off">
                        <div id="invalidetime" class="text-danger"></div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-4">
                        <label for="">Number of Guests:</label>
                    </div>
                    <div class="col">
                        <input class="form-control" type="number" name="guest" id="guest" autocomplete="off">
                        <div id="invalidguest" class="text-danger"></div>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-4">
                        <label for="">Event Type:</label>
                    </div>
                    <div class="col">
                        <select name="eventtype" id="eventtype" class="custom-select">
                            <option selected disabled>Events</option>
                            <option value="Conference">Conference</option>
                            <option value="Birthday">Birthday</option>
                            <option value="Marriage">Marriage</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Other">Others</options>
                        </select>
                        <div id="invalidevent" class="text-danger"></div>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?=$id?>">

                <div class="row form-group text-center mt-5">
                    <div class="col-3 offset-3">
                        <input class="btn btn-dark" type="submit" value="Submit">
                    </div>
                    <div class="col-3">
                        <input class="btn btn-dark" type="reset" value="Reset" id="reset">
                    </div>
                </div>
            </form>
            <br>
            <div id="venuealert" class="text-center"></div>
        </div>
    </div>
                
    <div class="col-md-12">
        <div class="row" style="height:420px ">
            <div class="col">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div style="width:700px;">
                    <h2 class="mb-4">Feedback:</h2>
                        <form id="feedform" action="">
                            <div class="form-group mb-4">
                                <textarea class="form-control" rows="8" name="feed" required></textarea>
                                <input type="hidden" value="<?=$id?>" name="id">
                            </div>
                            <span id="feedalert" style="margin-left:190px;"></span>
                            <button type="submit" class="btn btn-dark float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>

<!-- Ishwor bata lako code -->
<?php include "profilefooter.php"; ?>
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="../js/main.js"></script>
</body>

<!-- Jquery to reset alert and border-color when reset button is pressed -->
<script>
    $(document).ready(function(){
        $("#reset").click(function(){
            // Alert Reset
            $("#invaliddate").html("");
            $("#invalidstime").html("");
            $("#invalidetime").html("");
            $("#invalidguest").html("");
            $("#invalidevent").html("");

            // Border-Color Reset
            $("#date").attr("class","form-control");
            $("#stime").attr("class","form-control");
            $("#etime").attr("class","form-control");
            $("#guest").attr("class","form-control");
            $("#eventtype").attr("class","form-control");
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#view").click(function(){
            $.ajax({
                type: "post",
                url: "view.php",
                data: {val: <?=$id?>}, 
                success: function(data)
                {
                    $("#viewmodal").html(data);
                }
            });

            $.ajax({
                type: "post",
                url: "view-book.php",
                data: {val: <?=$id?>}, 
                dataType: 'JSON',
                success: function(data)
                {
                    $("#date").val(data['date']);
                    $("#stime").val(data['start']);
                    $("#etime").val(data['end']);
                    $("#guest").val(data['guest']);
                    $("#eventtype").val(data['type']);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#venue-book").submit(function(e){
            e.preventDefault();
            
            function validation()
            {
                // alert("hello");
                var date=document.getElementById("date").value;
                var stime= document.getElementById("stime").value;
                var etime= document.getElementById("etime").value;
                var guest= document.getElementById("guest").value;
                var eventtype= document.getElementById("eventtype").value;
                
                //For Time format        
                var timeStart = new Date("01/01/2000 " + stime).getTime();
                var timeEnd = new Date("01/01/2000 " + etime).getTime();
                var timeDiff = timeEnd - timeStart;
    
                //For Date Variable
                var insertedDate = new Date(date).getTime();
                var currentDate = new Date().getTime();

                // Reset alert Values
                document.getElementById("invaliddate").innerHTML="";
                document.getElementById("invalidstime").innerHTML="";
                document.getElementById("invalidetime").innerHTML="";
                document.getElementById("invalidguest").innerHTML="";
                document.getElementById("invalidevent").innerHTML="";

                // Date Validation
                if(date=="")
                {
                    document.getElementById("invaliddate").innerHTML="Date is empty";
                    document.getElementById("date").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else if(insertedDate<currentDate)
                {
                    document.getElementById("invaliddate").innerHTML="Booking should be made from next day";
                    document.getElementById("date").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("date").setAttribute("class","form-control border border-success");
                }

                // Start Time Validation
                if(stime=="")
                {
                    document.getElementById("invalidstime").innerHTML="Start time is empty";
                    document.getElementById("stime").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("stime").setAttribute("class","form-control border border-success");
                }

                // End Time Validation
                if(etime=="")
                {
                    document.getElementById("invalidetime").innerHTML="End Time is empty";
                    document.getElementById("etime").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("etime").setAttribute("class","form-control border border-success");
                }

                // Time Validation
                if(stime>etime || stime==etime)
                {
                    document.getElementById("invalidetime").innerHTML="Event end time should be greater than start time";
                    document.getElementById("etime").setAttribute("class","form-control border border-danger");
                    document.getElementById("stime").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("etime").setAttribute("class","form-control border border-success");
                    document.getElementById("stime").setAttribute("class","form-control border border-success");
                }

                if(timeDiff<21600000)
                {
                    document.getElementById("invalidetime").innerHTML="The minimun time for an event is 6 hr";
                    document.getElementById("etime").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("etime").setAttribute("class","form-control border border-success");
                }

                if(timeStart<946682100000 )
                {
                    document.getElementById("invalidstime").innerHTML="Venue can be booked from 5am";
                    document.getElementById("stime").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("stime").setAttribute("class","form-control border border-success");
                }


                if(timeEnd>946743300000)
                {
                    document.getElementById("invalidetime").innerHTML="Venue can be booked till 10pm";
                    document.getElementById("etime").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("etime").setAttribute("class","form-control border border-success");
                }

                // Guest Validation
                if(guest=="")
                {
                    document.getElementById("invalidguest").innerHTML="Number of guest is empty";
                    document.getElementById("guest").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else if(guest.indexOf("-")==0) 
                {
                    document.getElementById("invalidguest").innerHTML="Guests cannot be negative";
                    document.getElementById("guest").setAttribute("class","form-control border border-danger");
                    return false; 
                }
                else if(guest<31)
                {
                    document.getElementById("invalidguest").innerHTML="Guests should be more than 30";
                    document.getElementById("guest").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else if(guest>799)
                {
                    document.getElementById("invalidguest").innerHTML="Guest should be less than 800";
                    document.getElementById("guest").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("guest").setAttribute("class","form-control border border-success");
                }

                // Event Type Validation
                if(eventtype=="Events")
                {
                    document.getElementById("invalidevent").innerHTML="Event Type is empty";
                    document.getElementById("eventtype").setAttribute("class","form-control border border-danger");
                    return false;
                }
                else{
                    document.getElementById("eventtype").setAttribute("class","form-control border border-success");
                    return true;
                }
            }

            if(validation())
            {
                var formValues = $(this).serialize();
                $.ajax({
                    type: 'post',
                    url: 'venueinsert.php',
                    data: {val: formValues},
                    success: function(data){
                        $("#venuealert").html(data);
                        $("#venuealertt").fadeOut(3000);
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#feedform").submit(function(e){
            e.preventDefault();

            var formValues = $(this).serialize();
            $.ajax({
                type: 'post',
                url: 'feedback.php',
                data: {val: formValues},
                success: function(data){
                    $("textarea").val("");
                    $("#feedalert").html(data);
                    $("#feedalertt").fadeOut(3000);
                }
            });
        });
    });
</script>

</html>