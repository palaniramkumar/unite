<?php
require_once('./class/HealthCheck.php');
require_once('./class/dbConnection.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');
require_once('./class/poll.php');
$status="true";
if($_POST["uname"]!=NULL){
    $con= new dbConnection();
    $status=  $con->validateUser($_POST["uname"], $_POST["upass"]) ;
    
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="SSN Unite">
    <link rel="shortcut icon" href="./ico/favicon.png">

    <title>Contact Us</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/offcanvas.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="./js/html5shiv.js"></script>
      <script src="./js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php 
        @include("./fragment/nav.php");
    ?>

    <div class="container">

      <ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li class="active">Contact Us</li>
</ol>
        
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="row">
              <div class="panel panel-default" style="margin:20px" >
          <div class="panel-body"><div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading table-responsive">Alumni Office Bearers</div>

  <!-- Table -->
  <table class="table "> 
     <thead><tr>
   <th>Post</th><th>Name</th><th>Contact</th>
   </tr></thead>
   <tbody>
   <tr >
   <td >President</td><td>Sathyamoorthy M</td><td><a>sathyamoorthy@gmail.com</a></td>
   </tr>
   <tr >
  <td >Vice President</td><td>Ram Kumar R</td><td><a>ramrags@gmail.com</a></td>
   </tr>
   <tr >
   <td>Secretary</td><td>Vivek M</td><td><a>sciencevivek@gmail.com</a></td>
   </tr>
<tr >
   <td>Treasurer</td><td>Sibi Melvin</td><td><a>sibimelvin@gmail.com</a></td>
   </tr>

  <tr >
   <td>Alumni Officer</td><td>Asha P</td><td><a>ashap@ssn.edu.in</a></td>
   </tr>

   <tr >
   <td rowspan="8">Executive Committee</td><td>Palani Ramkumar</td><td><a>palaniramkumar@gmail.com</a></td>
   </tr>
   <tr><td>Madhan Kumar</td><td><a>madhanks2000@gmail.com</a></td>
<tr><td>Madanish Khanna</td><td><a>madanishkanna@gmail.com</a></td>
<tr><td>Bharathram</td><td><a>a.barathram@gmail.com</a></td>
<tr><td>Aswin</td><td><a>aswinsmails@gmail.com</a></td>
<tr><td>Praveen Inbaraj</td><td><a>bloginba@gmail.com</a></td>
<tr><td>Dhakshinamoorthy</td><td><a>rdm.theinvincible@gmail.com</a></td>
<tr><td>Sivagnanam N</td><td><a>sivagnanammurthy@gmail.com</a></td>
<tr><td>Andrew</td><td><a></a></td>
</tr>
   </tbody>
   </table>

<!-- Default panel contents -->
  <div class="panel-heading table-responsive">Previous, Alumni Office Bearers</div>

  <!-- Table -->
  <table class="table "> 
        <tbody>
   <tr >
   <td >President</td><td>Sathyamoorthy</td><td><a>sathyamoorthy@gmail.com</a></td>
   </tr>
   <tr >
  <td >Vice President</td><td>Ram Raghuraman</td><td><a>ramrags@gmail.com</a></td>
   </tr>
    <tr >
   <td>Treasurer</td><td>Sibi Melvin</td><td><a>sibimelvin@gmail.com</a></td>
   </tr>
   <tr >
   <td >Secretary</td><td>Anand Venkatasamy</td><td><a>anandv267@gmail.com</a></td>
   </tr>
   <tr >
    <td >Secretary - SOMCA</td><td>Rajesh</td><td><a>rajeshs.ssn@gmail.com</a></td>
   </tr>
   <tr >
   <td>Joint Secretary</td><td>Vivek</td><td><a>sciencevivek@gmail.com</a></td>
   </tr>
  
   <tr >
   <td>IT</td><td>Palani Ramkumar</td><td><a>palaniramkumar@gmail.com</a></td>
   </tr>
   
   </tbody>
   </table>


</div></div>
</div>       

      <div class="panel-body" >
        <div class="col-md-4" >
         <!--- <img class="featurette-image img-responsive"  src="data:image/png;base64," data-src="holder.js/200x200/auto" alt="Generic placeholder image">--->
		  <img class="featurette-image img-responsive"  src="img/Contact.png" alt="Generic placeholder image">
        </div>
        <div class="col-md-7 well">
          <h2 class="featurette-heading" >Web site <span class="text-muted">Issues</span></h2>
          <p class="lead">Write a mail to <a href="mailto:issues@ssnunite.com">issues@ssnunite.com</a> or write a feedback <a href="https://docs.google.com/forms/d/1Ae4HriEZAQ9lvYyXZuPIdmudV0pXdx7sO533TXBJX1M/viewform" target="_blank">Here</a></p>
        </div>
      </div>
        
      </div>
  </div><!--/span-->

        <?php
        @include './fragment/leftpane.php';
        ?>
      </div><!--/row-->

      <!--hr-->

      <?php 
     @include ("./fragment/footer.php");
     ?>


    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/offcanvas.js"></script>
    <script src="./js/holder.js"></script>
<script>
        $(document).ready(function()
{
            
          $.ajax({
                        url: "./class/fbAPI/fbcommunityupdate.php",
                        type: "GET",
                        cache: false
                    })
                            .done(function(html) {
                               
                        $("#fbupdate").html(html);

                    });
      
  });
</script>
  </body>
</html>
