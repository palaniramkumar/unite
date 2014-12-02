<?php
require_once('./class/HealthCheck.php');
require_once('./class/Event.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');

require_once('./class/poll.php');
 
       $sql = "SELECT e.id id,e.title title,e.detail detail,date_format(e.date,'%d-%m-%y') date,e.time time,
       e.location location,r.userid userid,e.food food,e.transport transport,e.guest guest,e.poll poll,e.accommodation accommodation
       FROM event e left join Event_Result r on e.id=r.id and r.userid= '" .$_SESSION["uid"] . "' where e.id=$_REQUEST[id];";
    require_once('./class/dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    

    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error() . $sql);
        } else if ($row = mysqli_fetch_array($result)) {

            $postid = $row['id'];
            $head = htmlspecialchars_decode($row['title']);
            $summary = htmlspecialchars_decode($row['detail']);
            $date = htmlspecialchars_decode($row['date']);
            $time =htmlspecialchars_decode( $row['time']);
            $location = htmlspecialchars_decode($row['location']);
            $attend=$row["userid"];
            $food=$row["food"];
            $transport=$row["transport"];
            $guest=$row["guest"];
            $poll = htmlspecialchars_decode($row['poll']);
            $accommodation=$row["accommodation"];
            
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    mysqli_close($con);
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= htmlspecialchars($summary)?>">
        <meta name="author" content="Admin">
        <link rel="shortcut icon" href="./ico/favicon.png">

        <title> <?= strip_tags($head)?></title>

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
        <? @include("./fragment/nav.php"); ?>

        <div class="container">



            <div class="row row-offcanvas row-offcanvas-right">
               
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="row" style="padding-right: 50px">


            <div class="panel-body panel" >
                <div class="col-md-5">

                    <div class="well">
                        Event Date:  <?= $date ?> <?= $time ?>
                    </div>

                    <div class="well">
                        Event Location: <?= $location ?>
                    </div>
                    <?if($food==1){?>
                    <div class="well" id="misc">
                     <p> Misc: </p>
                      <?if($food==1 || $transport==1|| $guest==1){?>
                      <p><input type="radio" name="food" id="food" checked  value="0">Veg | 
                      <input type="radio"  name="food" id="food" value="1">Non-Veg </p>
                      <?}if($transport==1){?>
                       <p><input type="checkbox" id="transport" value="yes"> Yes, I Need Transportation</p>
                       <?}if($guest==1){?>
                       <p>Total Number of Guests: <select id="guest">
                               <?for($i=0;$i<10;$i++){?>
                               <option value="<?=$i?>"><?=$i?></option>
                               <?}?>
                           </select></p>
                       <?}if($accommodation==1){?>
                       <p><input type="checkbox" id="accommodation" value="yes"> Yes, I Need an Accommodation</p>
                       <?}?>
                    </div>
                    <?}
                    if($poll!="" || $poll!=NULL){
                        require_once('./class/StringTokenizer.php');
                        $token=new StringTokenizer($row["poll"],",");
                        ?><div class="well" id="pollcollection">
                            <h4>I'm Interested In</h4><?
                        while($token->hasMoreTokens()){
                            $temp=$token->nextToken();
                            ?>
                            <input type="radio"  name ="poll" id="poll" checked value="<?=$temp?>"> <?=$temp?> <br/>
                            <?
                        }
                        ?></div><?
                    }
                    ?>
                    <div class="well">
                        Mobile: <input type="text" class="input-sm" placeholder="eg.987654321" id="mobile"/> <br/>
                        Email : <input type="text" class="input-sm" placeholder="eg,demo@ssn.com" id="email"/>
                    </div>    
                    <?if($_SESSION["uid"]!=NULL){?>
                    <button class="btn btn-info"  <?=$attend==NULL?"":"disabled"?> onclick="attendEvent()"> <?=$attend==NULL?"I Attend":"Already Registered"?></button>
                    <?}else{?>
                    <button class="btn btn-info" data-loading-text="You have Registered." disabled > Login to Submit</button>
                    <?}?>


                    <br/>

                    <div id="message"></div>

                </div>
                <div class="col-md-7 well">
                    <h2 class="featurette-heading"  ><?= $head ?></h2>
                    <p class="lead"><?= $summary ?></p>
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
            function attendEvent() {
                var food = "";
                var guest = "";       
                var transport="";
                var poll="";
                var accommodation="";
                var email=$("#email").val();
                var mobile=$("#mobile").val();
                if(!$.isEmptyObject($.find('#transport')))
                       transport = $("#transport").is(':checked') ? 1 : 0;
                
                if(!$.isEmptyObject($.find('#guest')))
                    guest=$("#guest").val();
                if(!$.isEmptyObject($.find('#accommodation')))
                    accommodation=$("#accommodation").is(':checked') ? 1 : 0;
                if(!$.isEmptyObject($.find('#poll')))
                    poll=$('input[name=poll]:checked', '#pollcollection').val()
                
                if (!$.isEmptyObject($.find("input[name=food]"))) {
                     food = $("input[name=food]:checked").val();           
                }
               
                if($.trim(mobile)=="")
                {
                    $("#mobile").css("border-color","red");
                     setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                    return;   
                }
                else{
                    $("#mobile").css("border-color","green");
                }
                 if($.trim(email)=="")
                {
                    $("#email").css("border-color","red");
                     setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                    return;
                }
                else{
                    $("#email").css("border-color","green");
                }
                var url="./admin/_event.php?action=attend&id=<?= $_REQUEST['id'] ?>&food="+food+"&transport="+transport+"&guest="+guest+"&accommodation="+accommodation+"&poll="+poll+"&mobile="+mobile+"&email="+email;
               
                $.ajax({
                    url: url,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
$('#message').html("<div class='alert alert-info'>"+html+"</div>");
$('button').attr("disabled","true");
                    //alert("completed" + html);
                })

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

