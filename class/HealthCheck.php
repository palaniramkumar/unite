<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HealthCheck
 *
 * @author Mexico
 */

    session_start();
    authorizePage();
        
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function authorizePage() {
    //$anonymous=array("Volvo","BMW","Toyota");
    //$admin=array("Volvo","BMW","Toyota");
    // echo curPageURL();
    if (($_SESSION["urole"] == "Admin") || ($_SESSION["urole"] == "Alumni")) {
           
            if (isset($_SESSION['referer'])) {
                $refurl=$_SESSION["referer"];
            unset($_SESSION['referer']);
            header('Location: ' . $refurl);
        
    }
        }
     
   //   echo "<script>alert ('$_SESSION[referer]')</script>"      ;
    $curpage = curPageURL();
    if (strstr(curPageURL(), 'admin') != false) {
        if ($_SESSION["urole"] == "Admin") {
            
            return;
        }
        $_SESSION["referer"] = $curpage;
        header('Location: ' . getHost() . "/index.php?msg=unauthorized");
    } else if (strstr(curPageURL(), 'activity') != false) {
        if (($_SESSION["urole"] == "Admin") || ($_SESSION["urole"] == "Alumni")) {
           
            return;
        }
        $_SESSION["referer"] = $curpage;
        header('Location: ' . getHost() . "/index.php?msg=unauthorized");
    }
}




    function validateUser($user_type){
        if($_SESSION["urole"]!=$user_type){
            @include("./class/CommonMethod.php");
            movePage(203,"./index.php?reason=Session Expired");
        }
    }
    function getHost(){
    $ENV="PROD";
    $HOST="http://localhost/unite/";
    if($ENV=="PROD")
       $HOST="http://$_SERVER[SERVER_NAME]/";
    return $HOST;
    }

function getsocial($url) {
    ?>
    <div style="margin: 10px;">
        <iframe src="//www.facebook.com/plugins/like.php?href=<?= $url ?>&amp;width=280&amp;height=35&amp;colorscheme=light&amp;layout=standard&amp;action=like&amp;show_faces=false&amp;send=true&amp;appId=275028862543667" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:280px; height:35px;" allowTransparency="true"></iframe>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="small" data-annotation="inline" data-width="300"></div>

        <!-- Place this tag after the last +1 button tag. -->
        <script type="text/javascript">
            (function() {
                var po = document.createElement('script');
                po.type = 'text/javascript';
                po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(po, s);
            })();
        </script>
    </div>
    <?
}
?>
