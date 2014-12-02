<?php
require_once('./class/HealthCheck.php');
require_once('./class/dbConnection.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');
require_once('./class/poll.php');
$status = "true";
if ($_POST["uname"] != NULL) {
    $con = new dbConnection();
    $status = $con->validateUser($_POST["uname"], $_POST["upass"]);
}
if($_SESSION["uid"]!=NULL){
    movePage(302, "index.php");
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

        <title>New Registration - SSN UNITE</title>

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
                <li class="active">Registration</li>
            </ol>

            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-xs-12 col-sm-12">

                    <div class="row">
                        <div class="panel panel-default" style="margin:20px" >
                            <div class="panel-body">
                                <div class="row">
                                                                  <div class="col col-xs-6" >
                                        <div style="max-height: 250px; overflow: scroll" >
                                            
                                            <pre>
This disclaimer governs your use of our website, by using our website; you accept this disclaimer in full. If you disagree with any part of this disclaimer, do not use our website. We may revise this disclaimer from time-to-time. Please check this page regularly to ensure you are familiar with the current version. 

The website of SSN Alumni (herein after referred to as "SSN UNITE") is published for informational purposes only and no part of the website constitutes a legal contract. No contractual rights, either expressed or implied, are created by its content. Every effort is made to ensure the accuracy of information contained within; however, no warranty of accuracy is made. 

Information on the website of SSN Alumni is subject to change without prior notice. Although every reasonable effort is made to present current and accurate information, the institution makes no claims, promises, or guarantees about the accuracy, completeness, or adequacy of the information. Moreover, there may be changes in fee structure, admission policies, information on courses and changes in personnel which may not be reflected immediately on the website. 

Any links to external Web sites information provided on SSN web pages or returned from Web search engines are provided as a courtesy. They should not be construed as recommendation or endorsement by SSN of the content or views of the linked materials. In no event shall SSN be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content. SSN is also not responsible for the availability or content of sites provided by such third parties. 

Unless otherwise stated, SSN owns the intellectual property rights in the website and material on the website. One may however view, download and print pages from the website for their own personal use, subject to the restriction that one should not republish material from this website (including republication on any other website) or reproduce, duplicate, copy or otherwise exploit material on our website for a commercial purpose or edit or otherwise modify any material on the website or do any other acts without the written consent from SSN. Use of SSN logo or any insignia present in the website is also not permitted without express written consent from the SSN Trust. 

All the contents of this Site are only for general information or use. They do not constitute advice and should not be relied upon in making (or refraining from making) any decision. The information on this website is provided free-of-charge, and you acknowledge that it would be unreasonable to hold us liable in respect of this website and the information on this website. 

SSN is also not liable for any changes brought about consequent to the changes in the University rules. 

For the most accurate information, please contact the Office of SSN Alumni: 
Alumni Officer
SSN Trust
211/ 95, V.M. Street
Mylapore, Chennai - 600 004
Phone: 91 44 2498 2656; 24986474
Telefax: 91 44 2498 2656; 24986474


IT IS FURTHER EXPRESSLY UNDERSTOOD THAT SSN SHALL NOT BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES, INCLUDING BUT NOT LIMITED TO OTHER INTANGIBLE LOSSES ARISED OUT OF OR ALLEGED TO ARISE OUT OF USAGE OF THIS WEBSITE. 

This notice will be governed by and construed in accordance with the Laws of Republic of India, and any disputes relating to this notice shall be subject to the exclusive jurisdiction of the Courts of Chennai (Madras) India.
                                            </pre>
                                            
                                        </div>
                                                                  
                                    </div>
                                    <div class="col col-xs-6" style="border-left: #444 dashed">
                                <div class="input-group ">
                                    <span class="input-group-addon">@  email </span>
                                    <input type="text" id="email" class="form-control " placeholder="Valid Email ID">
                                </div><br/>
                                <div class="input-group ">
                                    <span class="input-group-addon"> Password </span>
                                    <input type="password" id="pass" class="form-control " placeholder="New Password">
                                </div><br/>
                                
                                <div class="btn-group"  >
                                    <button class="btn btn-info btn-mini"  onclick="createdummy()" >I Agree Terms & Condition. Create An Account for Me</button>
                                        
                                        </div>
                                        
                                <p style="text-align:center;margin-top:5px">------------------OR---------------</p>
                <input class="btn btn-google-plus btn-block" type="button" onclick="javascript:window.location.replace('./class/googleAPI/googleOAUTHCreate.php');" id="sign-in-google" value="Sign Up with Google">
                
                <input class="btn btn-facebook btn-block" type="button" onclick="javascript:window.location.replace('./class/fbAPI/fbOAUTHCreate.php');" id="sign-in-facebook" value="Sign Up with Facebook">
                
                                    </div>
      
                                </div>
                            </div>

                        </div>

                    </div>       
                </div>
		<div id='msg'></div>
            </div><!--/span-->



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
            function createdummy(){
            var user=$("#email").val();
            var pass=$("#pass").val();
            if(isemail() || isempty()) return;
            $.ajax({
                    url: "./activity/_register.php?action=createdummy&user="+user+"&pass="+pass,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
			$("#msg").show();
                    $("#msg").html('<div class="alert alert-danger">'+html+'</div>');
                             setTimeout(function() { $("#msg").hide();}, 10000);               })
        }
        function isemail(){
            if(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test($("#email").val())==false){
                $("#email").css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return true;
            }
             $("#email").css("border-color","gray")
            return false;
        }
        function isempty(){
            if($.trim($("#pass").val())==""){
                $("#pass").css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return true;
            }
            $("#pass").css("border-color","gray")
            return false;
        }
            </script>
    </body>
</html>
