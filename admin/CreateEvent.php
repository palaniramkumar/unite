<?php
require_once('../class/HealthCheck.php');
require_once('../class/dbConnection.php');

validateUser("Admin");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../ico/favicon.png">

        <title> Create Event</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/datepicker.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/offcanvas.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../js/html5shiv.js"></script>
          <script src="../js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
         <? @include '../fragment/adminnav.php'?>

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Admin Dashboard</a></li>
                <li class="active">Create Event</li>
            </ol>

            <div class="row row-offcanvas row-offcanvas-right">

                <? @include '../fragment/adminpane.php' ?>
                
                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>


                    <!--Menu bar-->
                    <nav class="navbar navbar-default" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand"  id="heading">New Event</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="CreateEvent.php">+New</a></li>
                                <li><a href="#" onclick="ShowAllEvent()">Open</a></li>
                                <li><a href="#" onclick =saveEvent()>Save</a></li>
                                

                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </nav>
                    <!--End of menu-->



                    <div class="row" id='content'>


                        <div class="panel-body"  >
                            <div class="col-md-5">

                                <div class="well">
                                    Event Date <input type="text" class="input-sm" placeholder="dd-mm-yyyy"   id="date" >
                                </div>
                                <div class="well">
                                    Event Time <input type="text" class="input-sm" placeholder="XX:YY"  id="time" >
                                </div>
                                <div class="well">
                                    Event Location <input type="text" class="input-sm " placeholder="Location" id="location" >
                                </div>
                                <div class="well">
                                    Misc: <br/>
                                    <input type="checkbox" id="food" value="Food">Food Type | 
                                    <input type="checkbox" id="guest" value="guest">Guest | 
                                    <input type="checkbox" id="transport" value="Transport">Transport |
                                    <input type="checkbox" id="accommodation" value="accommodation">Need Accommodation 
                                    
                                </div>
                                <div class="well">
                                    Interested In: <br/>
                                    <input type="text" id="poll" class="input-sm" placeholder="Items Sperated by (,)"></div>
                                   




                                <br/>

                                <div id="message"></div>

                            </div>
                            <div class="col-md-7 well">
                                <h2 class="featurette-heading editable" id='pHead'>[Title]</h2>
                                <p class="lead editable" id="pSum" > [Description] </p>

                            </div>
                            <input type='hidden' value="insert" id='type'/>
                            <input type='hidden' value="0" id='eventid'/>

                        </div>

                    </div>



                </div><!--/end of right pane->
        
               
              </div><!--/row-->

                <!--hr-->

                <div id="footer" >

                    <div class="container">
                        <p class="text-muted credit">.</p>
                    </div>
                </div>
                <div id="footer" class="navbar navbar-default navbar-fixed-bottom" style="padding-top: 5px;">

                    <div class="container">
                        <p class="text-muted credit">SSN Alumni (c) 2013 | <a href="#">Privacy Policy</a> |  <a href="#">Credit</a>.</p>
                    </div>
                </div>


            </div><!--/.container-->



            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="../js/jquery.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/offcanvas.js"></script>
            <script src="../js/holder.js"></script>
            <script src="../js/bootstrap-datepicker.js"></script>
            <script src="../tinymce/tinymce.min.js"></script>

            <style>
                form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
                #progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
                #bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
                #percent { position:absolute; display:inline-block; top:3px; left:48%; }
            </style>

            <script type="text/javascript">
                                    function init() {
                                        tinymce.init({
                                            selector: "h2.editable",
                                            inline: true,
                                            toolbar: "undo redo",
                                            menubar: false
                                        });
                                        tinymce.init({
                                            selector: "p.editable",
                                            inline: true,
                                            toolbar: "undo redo",
                                            menubar: false
                                        });


                                        $('#date').datepicker();

                                    }
                                    init();
                                    function saveEvent() {
                                        var title = $("#pHead").html();
                                        var summary = $("#pSum").html();
                                        var transport = $("#transport").is(':checked') ? 1 : 0;
                                        var guest = $("#guest").is(':checked') ? 1 : 0;
                                        var food = $("#food").is(':checked') ? 1 : 0;
                                        var date = $("#date").val();
                                        var time = $("#time").val();
                                        var location = $("#location").val();
                                        var type = $("#type").val();
                                        var id=$("#eventid").val();
                                        var poll=$("#poll").val();
                                        var accommodation = $("#accommodation").is(':checked') ? 1 : 0;
                                        var param = "?action="+type+"&poll="+poll+"&accommodation="+accommodation+"&title=" + title + "&detail=" + summary + "&guest=" + guest + "&food=" + food + "&date=" + date + "&transport=" + transport + "&time=" + time + "&location=" + location+"&id="+id;
                                        //alert("_event.php" + param);
                                        $.ajax({
                                            url: "_event.php" + param,
                                            type: "POST",
                                            cache: false
                                        })
                                                .done(function(html) {
                                            ShowAllEvent();
                                        })


                                    }
                                    function ShowAllEvent() {

                                        $.ajax({
                                            url: "_event.php?action=getallevent",
                                            type: "POST",
                                            cache: false
                                        })
                                                .done(function(html) {

                                            $("#content").html(html);

                                        });
                                    }
                                    function DeleteEvent(id) {
                                        $.ajax({
                                            url: "_event.php?action=deleteevent&id=" + id,
                                            type: "POST",
                                            cache: false
                                        })
                                                .done(function(html) {

                                            ShowAllEvent();

                                        });
                                    }
                                    function EditEvent(id) {
                                        $.ajax({
                                            url: "_event.php?action=editevent&id=" + id,
                                            type: "POST",
                                            cache: false
                                        })
                                                .done(function(html) {

                                            $("#content").html(html);
                                            init();
                                            $("#heading").html("Edit Event");

                                        });
                                    }
                                    function ShowAttendee(id) {
                                        $.ajax({
                                            url: "_event.php?action=exportuser&id=" + id,
                                            type: "POST",
                                            cache: false
                                        })
                                                .done(function(html) {

                                            

                                        });
                                    }
            </script>

    </body>
</html>
