<?php
session_start();

require_once('../class/dbConnection.php');
require_once('../class/CommonMethod.php');
require_once('../class/widget.php');
require_once('../class/StringTokenizer.php');
require_once('../class/HealthCheck.php');
$status = "true";
if ($_POST["uname"] != NULL) {
    $con = new dbConnection();
    $status = $con->validateUser($_POST["uname"], $_POST["upass"]);
}

function getAllMetaLink($item, $meta) {
    $URL = "metasearch.php";
    $token = new StringTokenizer($item, ",");
    $retString = "";
    while ($token->hasMoreTokens()) {
        $temp = trim($token->nextToken());
        $retString.="<a href='$URL?$meta=$temp'>" . $temp . "</a> , ";
    }
    return $retString;
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


                <?php
                @include("../fragment/activitypane.php");
                $sql = "select *,date_format(dob,'%d-%b') birthday from alumnireg where rowid=$_REQUEST[id]";
                //echo $sql;
                require_once('../class/dbConnection.php');
                $db = new dbConnection();
                $con = $db->getConnection();
                //Execute insert query
                $result = mysqli_query($con, $sql);

                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                }
                $row = mysqli_fetch_array($result);
                ?>

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>

                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <div class="media">
                                <a class="pull-right" href="#">
                                    <img class="media-object" src="<?= getProfilePic($_REQUEST["id"]) ?>">
                                </a>
                                <div class="media-body">
                                    <h3 class="media-heading">About <?= $row["fname"] ?> | <a href="chatter.php?refid=<?= $row["rowid"] ?>" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Send a Private Message" data-original-title="" title=""><span class="glyphicon glyphicon-envelope"></span></a> | <a href="#" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Report as SPAM" data-original-title="" title="" onclick="Spam('<?=$row[rowid]?>','spam')"><span class="glyphicon glyphicon-ban-circle"></span></a> |

                                        <?
                                        $host = "http://ssnunite.com";
                                        if (url_exists($host . "/uploads/resume/$_SESSION[uid].pdf")) {
                                            ?>
                                            <a href="#" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Download Resume" data-original-title="" title="" onclick="window.open('<?= $host . "/uploads/resume/$row[rowid].pdf" ?>', '_blank')"><span class="glyphicon glyphicon-download"></span></a>

                                            <?
                                        }
                                        ?>
                                    </h3><br/>
                                    <div class="row">
                                        <div class="col-md-4">Completed <?= $row["branch"] ?> in <?= $row["batch"] ?> </div>
                                        <div class="col-md-4"><?= $row["birthday"] ?></div>
                                        <div class="col-md-4">Skills: <?= $row["skill"] == NULL ? "Nothing Shared" : getAllMetaLink($row["skill"], "skill") ?></div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-4"><?= $row["city"] ?>, <?= $row["state"] ?> (<?= getAllMetaLink($row["country"], "country") ?>)</div>
                                        <div class="col-md-4"><?= $row["email"] ?></div>
										<div class="col-md-4"><?= $row["rollno"] ?></div>
                                        
                                    </div>
									<div class="row">
                                        <div class="col-md-4"><?= $row["fathersname"] ?></div>
										<div class="col-md-4">Scholarship - <?= $row["scholarship"] ?></div>
										<div class="col-md-4">Phone Number - <?= $row["number"][0] ?><?= $row["number"][1] ?><?= $row["number"][2] ?>...</div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Club Activities at SSN</h4>
                            <p><?= $row["ssnmoment"] == NULL ? "Nothing Shared" : $row["ssnmoment"] ?></p>
                        </div>
                    </div>
                    
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Work</h4>


                            <?php
                            $designation = new StringTokenizer($row["desig"], "/");
                            $org = new StringTokenizer($row["org"], "/");
                            while ($designation->hasMoreTokens()) {
                                echo "<p>" . getAllMetaLink($designation->nextToken(), "desig")  . getAllMetaLink($org->nextToken() , "org") . "</p>";
                            }
                            ?>
										<div class="col-md-4">After College at SSN -  <?= $row["aftercollege"] ?></div>
										<div class="col-md-4">College Name -  <?= $row["higherstudies"] ?></div>
										<div class="col-md-4">Degree and Specilization - <?= $row["higherstudiesdeg"] ?></div>
						</div>
                    </div>
					<div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Social Media</h4>
                            <p>Facebook: <?= $row["facebook"] == NULL ? "-" : $row["facebook"] ?></p>
                            <p>Twitter: <?= $row["twitter"] == NULL ? "-" : $row["twitter"] ?></p>
                            <p>Linked In: <?= $row["linkedin"] == NULL ? "-" : $row["linkedin"] ?></p>
                        </div>
                    </div>

                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Hobbies</h4>
                            <p><?= $row["hobby"] == NULL ? "Nothing Shared" : getAllMetaLink($row["hobby"], "hobby") ?></p>
                        </div>
                    </div>
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Music i love</h4>
                            <p><?= $row["music"] == NULL ? "Nothing Shared" : getAllMetaLink($row["music"], "music") ?></p>
                        </div>
                    </div>
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Movies I like</h4>
                            <p><?= $row["movies"] == NULL ? "Nothing Shared" : getAllMetaLink($row["movies"], "movies") ?></p>
                        </div>
                    </div>


                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Recent Changes</h4>

<?
$sql = "select id,msg,timestamp from Tweets where userid=$_REQUEST[id] order by timestamp desc limit 0,10";
//echo $sql;
require_once('../class/dbConnection.php');
//Execute insert query
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}
if (mysqli_num_rows($result) == 0) {
    ?><p>Nothing Shared</p><?
                            }
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <p>Tweeted the text "<?= strip_tags(htmlspecialchars_decode($row["msg"])) ?>" </p>
                            <? }
                            ?>

                        </div>
                    </div>

<? mysqli_close($con); ?>


                </div><!--/span-->


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
        <script>
        function Spam(id, type) {
            $.ajax({
                url: "_spam.php?action=reportspam&type=" + type + "&id=" + id,
                type: "POST",
                cache: false
            })
                    .done(function(html) {

                        alert("Reported");

                    });
        }
        </script>
    </body>
</html>
