<?php
require_once('../class/friends.php');
require_once('../class/dbConnection.php');
require_once('../class/widget.php');
require_once('../class/HealthCheck.php');
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
         <? @include '../fragment/nav.php'?>

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Activity</a></li>
                <li class="active">Search Result</li>
            </ol>

            <div class="row row-offcanvas row-offcanvas-right">

                <?php 
        @include("../fragment/activitypane.php");
    ?>
                <div class="col-xs-12 col-sm-9" >
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
                            <a class="navbar-brand" href="#" id="heading">Search Buddies</a>
                        </div>
                         <div class="collapse navbar-collapse navbar-ex1-collapse">

                            <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" action="metasearch.php" role="search">
      <div class="form-group">
        <input type="text" name="query" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
                            </ul></div>      
                    </nav>
                    <!--End of menu-->

                    <div id="content">
                        <?
                         
    require_once('../class/dbConnection.php');
    
    
    $sql="select * from alumnireg where ". str_replace("="," like '%", urldecode($_SERVER['QUERY_STRING'])."%'");
    if($_REQUEST['query']!=null)
        $sql="select * from alumnireg where  role in('Admin','Alumni','Student','Faculty')  and (org like '%$_REQUEST[query]%' or email like '%$_REQUEST[query]%' or fname like '%$_REQUEST[query]%' or country like '%$_REQUEST[query]%' )";
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error().$sql);
    }
    ?>
    <div class="panel">
        <div class="panel-body">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Search Result</div>
                <div class="panel-body">
                </div>
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Birth Day</th>
                    <th>Department</th>
                    <th>Passed Out</th>
                    <th>email</th>
                  
                    </thead>
                    <?
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><img src="<?=  getProfilePic($row["rowid"])?>" width="48"/><a href="user.php?id=<?=$row["rowid"]?>"><?= htmlspecialchars_decode($row["fname"]) ?></a></td>
                            <td><?= $row["dob"] ?></td>
                            <td><?= $row["branch"] ?></td>
                            <td><?= $row["batch"] ?></td>
                            <td><?= $row["email"] ?></td>
                            
                            </tr>  
                        <?
                    }
                    ?></table></div></div><?
        mysqli_close($con);
                        ?>
                    
                        </div>

                </div><!--/end of right pane->
        
               
              </div><!--/row-->

                <!--hr-->

             <?php
            @include ("../fragment/footer.php");
            ?>
            </div><!--/.container-->



            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="../js/jquery.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/offcanvas.js"></script>
            <script src="../js/holder.js"></script>
            <script src="../tinymce/tinymce.min.js"></script>
            <script src="../js/jquery.form.min.js"></script>
            <style>
                form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
                #progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
                #bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
                #percent { position:absolute; display:inline-block; top:3px; left:48%; }
            </style>

           

    </body>
</html>
