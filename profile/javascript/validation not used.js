function validation()
{
    // alert("hello");
    var date=document.getElementById("date").value;
    var stime= document.getElementById("stime").value;
    var etime= document.getElementById("etime").value;
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
