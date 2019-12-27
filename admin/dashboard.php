<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="holb">

    <title>Holb Administrator - House of Lookbook</title>
    <link rel="icon" href="favicon.png" sizes="any" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/fullcalendar.min.css" />

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/menuinit.js"></script>
    <!-- Calendar JavaScript -->
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.min.js"></script>
    <!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>

</head>

<script>

$(document).ready(function () {
    $("#side-menu a").removeClass("active");
    $("#side-menu a.events").addClass("active");

    var calendar = $('#calendar').fullCalendar({
        height: 640,
        editable: true,
        events: "fetch-event.php",
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = false;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: false,
        displayEventTime: false,
        
        // select only one day
        selectConstraint:{
            start: '00:00',
            end: '24:00',
        },
        
        select: function (startDate, endDate, allDay) {
            var start = $.fullCalendar.formatDate(startDate, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(endDate, "Y-MM-DD HH:mm:ss");

            $.ajax({
                url: 'find-event.php',
                data: 'start=' + start + '&type=1',
                type: "POST",
                success: function (data) {
                    if (data === 'true') {
                        displayMessage("Event Cannot Added!");
                        calendar.fullCalendar('unselect');
                    } else {
                        var form = $("<form>\
                            <h4>Please enter event title to add:</h4> \
                            <input type='text' name='title' /><br/> \
                            <h4>Please choose package size:</h4> \
                            <input type='radio' name='size' class='size' disabled><span style='font-size: 16px; margin-left: 10px;'>S(small) </span><br/> \
                            <input type='radio' name='size' class='size' checked='checked'><span style='font-size: 16px; margin-left: 10px;'>M(medium) </span><br/> \
                            <input type='radio' name='size' class='size'><span style='font-size: 16px; margin-left: 10px;'>L(large) </span><br/> \
                            <h4>Please enter time to schedule:</h4> \
                            <input type='radio' name='event_type' class='event-type' checked='checked' /><span style='font-size: 16px; margin-left: 10px;'>Available</span><br/> \
                            <input type='time' name='hours' id='eventHours' style='line-height: 22px; margin-bottom: 5px;' /><br/> \
                            <input type='radio' name='event_type' class='event-type'><span style='font-size: 16px; margin-left: 10px;'>BUSY</span><br/> \
                            <h4>Please enter event custom text:</h4> \
                            <textarea   name='custom' rows='4' cols='50' /><br/> \
                            </form>");

                        bootbox.confirm(form, function(result) {
                            if (result) {
                                var title = form.find('input[name=title]').val();
                                var size = form.find("input.size").index(form.find("input.size:checked")) + 1;
                                var hours = form.find('input[name=hours]').val();
                                var eventType = form.find('input.event-type').index(form.find("input.event-type:checked"));
                                if (eventType === 1) {
                                    title = "BUSY - " + title;
                                } else {
                                    if (hours) {
                                        title = hours + " - " + title;
                                    }
                                }
                                var custom = encodeURI(form.find('textarea[name=custom]').val());
                                var color = '#00486b';
                                if (size === 1) {
                                    color = '#69ceff';
                                } else if (size === 2) {
                                    color = '#00acff';
                                }

                                $.ajax({
                                    url: 'add-event.php',
                                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&size=' + size + '&color=' + color + '&hours=' + hours + '&custom=' + custom + '&type=' + eventType,
                                    type: "POST",
                                    success: function (data) {
                                        
                                        
                                        if (data === 'true') {
                                            displayMessage("Event Added Successfully");
                                            $('#calendar').fullCalendar( 'refetchEvents' );
                                            calendar.fullCalendar('unselect');
                                        } else {
                                            displayMessage("Event Cannot Added!");
                                        }
                                    }
                                });
                                
                            }

                            calendar.fullCalendar('unselect');
                        });
                    }
                }
            });

            
        },
        
        editable: false,
        
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            $.ajax({
                url: 'edit-event.php',
                type: "POST",
                data:{title:event.title, start:start, end:end, id:event.id},
                success: function (response) {
                    displayMessage("Event Updated Successfully");
                }
            });
        },

        eventClick: function (event) {
            bootbox.confirm("Do you really want to delete this event?", function(result){
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "delete-event.php",
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Event Deleted Successfully");
                            }
                        }
                    });
                }
            });
        }

    });

    $(document).on("click", ".show-alert", function(e) {
        bootbox.alert("Hello world!", function() {
            console.log("Alert Callback");
        });
    });
});

function displayMessage(message) {
    $(".response").html("<div class='text-success'>"+message+"</div>");
    setInterval(function() { $(".text-success").fadeOut(); }, 1000);
}
</script>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("nav.php"); ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="page-header">Event management</h1>

                    <div class="response"></div>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>