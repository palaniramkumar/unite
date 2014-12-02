<?php 

require_once('./class/HealthCheck.php');
require_once('./class/dbConnection.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');
require_once('./class/poll.php');
require_once('./class/Post.php');
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
  <?=showPostHead($_REQUEST["id"])?>
    <link rel="shortcut icon" href="./ico/favicon.png">


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
     

   <? @include("./fragment/nav.php");?>

    <div class="container">

     
        
      <div class="row row-offcanvas row-offcanvas-right">
        <?=showPostbyID($_REQUEST["id"])?>

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
    function loadcomment(){
            //alert("./admin/_post.php?action=getcomment&id=<?=$_GET["id"]?>");
            $("#commentdiv").prepend("<p>Loading Comment...</p>");
            $.ajax({
                    url: "./admin/_post.php?action=getcomment&id=<?=$_GET["id"]?>",
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    $('button[data-loading-text]').button("reset");
                    $("#commentdiv").html(html);
                    //alert(html);
                });
        }
    function addcomment(){
            var comment=$("#msg").val();
            if($.trim(comment)==""){
                $("#msg").css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return;
            }
            $("#msg").css("border-color","");
            //$("#commentdiv").prepend("<p>Adding Comment...</p>");
            //alert("./admin/_post.php?action=insertcomment&id=<?=$_GET["id"]?>&comment="+comment);
            $.ajax({
                    url: "./admin/_post.php?action=insertcomment&id=<?=$_GET["id"]?>&comment="+comment,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                        $("#msg").val("");
                    loadcomment();
                });
        }
    function deletecomment(id){
            //alert("./admin/_post.php?action=deletecomment&id="+id);
            $("#commentdiv").prepend("<p>Deleting Comment...</p>");
            $.ajax({
                    url: "./admin/_post.php?action=deletecomment&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    //$("#commentdiv").html("html");
                    loadcomment();
                });
        }
     
    loadcomment();
    function Spam(id, type) {
            $.ajax({
                url: "./activity/_spam.php?action=reportspam&type=" + type + "&id=" + id,
                type: "POST",
                cache: false
            })
                    .done(function(html) {

                        alert("Reported");

                    });
        }
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

