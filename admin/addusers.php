<?php
require_once('../class/dbConnection.php');
require_once('../class/CommonMethod.php');
require_once('../class/widget.php');
require_once('../class/HealthCheck.php');
$status = "true";
if ($_POST["uname"] != NULL) {
    $con = new dbConnection();
    $status = $con->validateUser($_POST["uname"], $_POST["upass"]);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../ico/favicon.png">

        <title> Activities</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/offcanvas.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../js/html5shiv.js"></script>
          <script src="../js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php
        @include("../fragment/nav.php");
        ?>

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Activity</li>
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
                            <a class="navbar-brand"  id="heading">Registration Detail </a>
				<a class="navbar-brand" href="#" onclick="ExportAllusers('all')">Export</a>

                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">

                            <ul class="nav navbar-nav navbar-right">
                               <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                  <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="date">
                                </div>

                              </form>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span id="dept_id">B.E (CSC)</span> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">B.E (CSC)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">B.E (EEE)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">B.E (ECE)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">B.E (BME)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">B.E (ME)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">B.Tech (IT)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">B.Tech (Chemical)</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">MCA</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">MBA</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.E (Communication Systems)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.E (CSE)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.E, Applied Electronics</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.E (Power Electronics & Drives)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.E (Computer and Communication)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.E. in VLSI Design (ECE Department)</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.E Software Engineering</a></li>
                                        <li><a href="#" onclick="$('#dept_id').html($(this).html())">M.Sc (IT)</a></li>
                                    </ul>
                                </li>
                                
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span id="year_id"><?=date("Y")?></span><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <?php for ($i = 2000; $i <= date("Y")+4; $i++) { ?>
                                            <li><a href="#" onclick="$('#year_id').html($(this).html())"><?= $i ?></a></li><? }
                                        ?>
                                        
                                    </ul>
                                </li>
                                
                                <li><a  style="color: white" class="btn btn-sm btn-info" onclick="ShowAllusers('restricted')">Search</a> </li>
                                <li><a  style="color: white" class="btn btn-sm btn-default" onclick="ShowAllusers('all')">All</a> </li>

                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </nav>
                    <!--End of menu-->

                    <div class="panel-body">
                        <div class="input-group">
                            <input type="text" id="friendemail"  placeholder="abc@ssn.com"class="form-control">
                            <span class="input-group-btn" >
                                <button class="btn btn-default" type="button" onclick="invitefriend($('#friendemail').val())">Invite</button>
                            </span>
                        </div>
                    </div>

                   
                    <form action="#" method="post">
                        <div class="panel panel-default" >
                            <div class="panel-body" >
                                <div class="media">
					<p align="right" >
                                        <select onchange="$('.record').hide();$('.'+this.value).show()">
                                        <option value="record">All</option>
                                        <option value="Alumni">Alumni</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Invalid">Invalid</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                    </p>
                                    <table class="table table-striped">  
                                        <thead>  
                                            <tr>  
                                                <th>Name</th>  
                                                <th>Department</th>            
                                                <th>email</th>  
                                                <th>Role</th>
                                                <th>Valid?</th>
                                                <th>Action</th>  
                                            </tr>  
                                        </thead>  
                                        <tbody id="content">  
                                            <TR><TD>Please Select...</TD></TR>
                                        </tbody>  
                                    </table> 

                                </div>
                            </div>
                        </div>


                    </form>
                </div><!--/span-->






            </div><!--/span-->


        </div><!--/row-->

        <!--hr-->

        <?php
        @include ("../fragment/footer.php");
        ?>


    </div><!--/.container-->

    <style>
        form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
        #progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
        #bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
        #percent { position:absolute; display:inline-block; top:3px; left:48%; }
    </style>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/offcanvas.js"></script>
    <script src="../js/holder.js"></script>
    <script src="../js/bootbox.min.js"></script>
    <script src="../js/jquery.form.min.js"></script>
    <script>
        var filter='all';
                                    function ShowAllusers(filter) {
                                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                            
                                        var year=$('#year_id').html();
                                        var dept=$('#dept_id').html();   
						var date=$('#date').val(); 
                                        var url="_adduser.php?action=getallvaliduser&date="+date+"&batch=" + year+"&branch=" + dept+"&filter="+filter;
                                    
                                        $.ajax({
                                            url: url,
                                            type: "POST",
                                            cache: false
                                        })
                                                .done(function(html) {

                                                    $("#content").html(html);
							 $("[data-toggle='popover']").popover();
                                                });
                                    }
					function ExportAllusers(filter) {
                                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                            
                                        var year=$('#year_id').html();
                                        var dept=$('#dept_id').html();   
						var date=$('#date').val(); 
                                        var url="_adduser.php?action=exportallvaliduser&date="+date+"&batch=" + year+"&branch=" + dept+"&filter="+filter;
                                    window.location = url;
                                                                            }

                                    //ShowAllusers(filter);
                                    function setrole(role, id) {
                                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                                        bootbox.confirm("Are you sure to make this user to '" + role + "'?", function(result) {
                                            if (result) {
                                                $.ajax({
                                                    url: "_adduser.php?action=updaterole&role=" + role + "&id=" + id+"&filter="+filter,
                                                    type: "POST",
                                                    cache: false
                                                })
                                                        .done(function(html) {

                                                            ShowAllusers(filter);

                                                        });
                                            }
                                        });


                                    }
                                    function setverification(access, id) {
                                        //alert("_ssnclick.php?action=viewstory&filter="+filter);

                                        $.ajax({
                                            url: "_adduser.php?action=updateaccess&access=" + access + "&id=" + id+"&filter="+filter,
                                            type: "POST",
                                            cache: false
                                        })
                                                .done(function(html) {

                                                    ShowAllusers(filter);

                                                });
                                    }
					 function exportXL( divid) {

                                        var form = document.createElement("form");
                                        form.setAttribute("method", "post");
                                        form.setAttribute("action", "export.php");
                                            var hiddenField = document.createElement("input");
                                            hiddenField.setAttribute("type", "hidden");
                                            hiddenField.setAttribute("name", "data");
                                            hiddenField.setAttribute("value", $('#'+divid).html());

                                            form.appendChild(hiddenField);


                                        document.body.appendChild(form);    // Not entirely sure if this is necessary
                                        form.submit();
                                    }
    </script>
</body>
</html>
