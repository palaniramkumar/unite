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

    <title> Admin Dashboard</title>

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
     <? @include '../fragment/adminnav.php'?>

    <div class="container">

     <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Admin Dashboard</li>
      </ol>
        
      <div class="row row-offcanvas row-offcanvas-right">
          
           <? @include '../fragment/adminpane.php' ?>
          
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         
          <div class="panel panel-default" >
          <div class="panel-body" >
          <div class="media">
 
  <div class="media-body">
    <h4 class="media-heading">Portal Update</h4>
    <div class="row">
  <div class="col-lg-4">
    <div class="input-group">
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-edit"></span>
      </span>
        <input type="text" class="form-control" placeholder="Message" id="msg" >
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-5">
    <div class="input-group">
      <span class="input-group-addon">
        <span class="glyphicon">http://</span>
      </span>
      <input type="text" class="form-control" placeholder="Optional: Web URL" id="url">
      
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-1"><span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="addSiteUpdate()">Post</button>
      </span></div>
  <div class="col-lg-2"><span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="clearTrash()">Clear Trash</button>
      </span></div>
</div><!-- /.row -->
  </div>
</div>
          </div>
          </div>
          
          
          <!-- Extra small button group -->
          
          
          <div class="panel panel-default" >
          <div class="panel-body" >
          
              
              
              <ul class="media-list">
  <li class="media">
    
    <div class="media-body">
      <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Update List</div>

  <!-- Table -->
  <table class="table" >
      <thead>
          <tr>
              <th>Message</th>
              <th>URL</th>
              <th>Date</th>
              <th>Operation</th>
          </tr>
      </thead>
      <tbody id="table">
          
                 
          
          
      </tbody>
  </table>
</div>

              
          </div>
      
   
  </li>
</ul>
          
          </div>
</div>   
        
      
        </div><!--/span-->

       
      </div><!--/row-->

      <!--hr-->

      <div id="footer" >
         
      <div class="container">
      <p class="text-muted credit"></p>
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
    <script>
    function addSiteUpdate() {
            var msg=$("#msg").val();
            var url=$("#url").val();
            var param = "?action=insert&msg=" + msg + "&url=" + url;
            //alert("../class/SiteUpdate.php" + param)
            $.ajax({
                url: "../class/SiteUpdate.php" + param,
                type: "POST",
                cache: false
            })
                    .done(function(html) {
                alert("Added!" );
                loadupdates();
                
            })


        }
    function loadupdates(){
        var param = "?action=select";
            //alert("../class/SiteUpdate.php" + param)
            $.ajax({
                url: "../class/SiteUpdate.php" + param,
                type: "POST",
                cache: false
            })
                    .done(function(html) {
                //alert("completed");
                $("#table").html(html);
                
                
            })
    }
    function clearTrash(){
        var param = "?action=trash";
            //alert("../class/SiteUpdate.php" + param)
            $.ajax({
                url: "../class/SiteUpdate.php" + param,
                type: "POST",
                cache: false
            })
                    .done(function(html) {
                //alert("completed");
                
                
            })
    }
    function deleteupdate(id){
        var param = "?action=delete&id="+id;
            //alert("../class/SiteUpdate.php" + param)
            $.ajax({
                url: "../class/SiteUpdate.php" + param,
                type: "POST",
                cache: false
            })
                    .done(function(html) {
                //alert("completed");
                loadupdates();
                
            })
    }
    loadupdates();
    </script>
  </body>
</html>
