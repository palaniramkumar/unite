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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../ico/favicon.png">

        <title>Edit Profile</title>

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
                ?>

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>

                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <ul class="nav nav-pills ">
                                <li > <a href="#avatar" >Avatar</a></li>
                                <li > <a href="#resume">Resume</a></li>
                                <li > <a href="#passcode">Password</a></li>
                                <li ><a href="#personal">Personal</a></li>
                                <li ><a href="#professional">Professional</a></li>
                                <li ><a href="#batch">Batch</a></li>
                               
                                <li ><a href="#communication">communication</a></li>
                                <li ><a href="#likes">Likes</a></li>
                                <li ><a href="#skill">Skill</a></li>
                                <li ><a href="#aboutme">About Me</a></li>
                                

                           
                            </ul>
                        </div>
                    </div>


                    <?
                    $sql = "select fname,lname,rollno,fathersname,gender,email, DATE_FORMAT(dob, '%d-%m-%Y') dob,branch,batch,org,desig,number,address,country,state,city,facebook,linkedin,twitter,skill,experiance,higherstudies,aboutme,ssnmoment,hobby,music,movies,scholarship,aftercollege,higherstudiesdeg from alumnireg  where rowid=$_SESSION[uid] ";
                    //echo $sql;
                    require_once('../class/dbConnection.php');
                    $db = new dbConnection();
                    $con = $db->getConnection();
                    //echo $sql;
                    //Execute insert query
                    $result = mysqli_query($con, $sql);

                    if (!$result) {
                        die('Invalid query: ' . mysql_error());
                    }
                    if ($row = mysqli_fetch_array($result)) {
                        
                    }
                    mysqli_close($con);
                    ?>


                    <div class="row row-offcanvas row-offcanvas-right" id="avatar">
                        <div class="col-xs-8 col-sm-6">
                            <div class="panel panel-default" >
                                <div class="panel-body" >
                                    <h4 class="media-heading">Change Avatar (png/jpg)</h4>
                                    <img id="imgpreview" src="<?= getProfilePic($_SESSION[uid],'256') ?>"/>
                                    <form id="myForm" action="../class/upload.php" method="post" enctype="multipart/form-data">
                                        <p><input type="file"    accept="image/jpeg,image/x-png" name="myfile"  id="filepic"></p>
                                        <input type="hidden" value="profile" name="imagetype"/>
                                        <p style="text-align: center"><input type="submit"  value="Upload"></p>

                                    </form>

                                </div>
                                
                            </div>     
                        </div>
                        <div class="col-xs-8 col-sm-6" id="resume">
				<div class="panel panel-default" >
                                <div class="panel-body" >
                                    <h4 class="media-heading">Name</h4>
                                    <div class="input-group" style="margin-bottom: 10px">
                                        <input type="text" class="form-control" id='fname' placeholder="Name" value="<?=$row['fname']?>">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" onclick='updatefield("fname",$("#fname").val())'>Change!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default" >
                                <div class="panel-body" >
                                    <h4 class="media-heading">Upload Resume (pdf)</h4>
                                    <div class="input-group" style="margin-bottom: 10px">
                                        <form id="myFormdoc" action="../class/upload.php" method="post" enctype="multipart/form-data">
                                            <p><input type="file"  accept="application/pdf"  name="myfile"  id="filedoc"></p>
                                            <input type="hidden" value="resume" name="imagetype"/>
                                            <p style="text-align: center"><input type="submit"  value="Upload"></p>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-6" >
                            <div class="panel panel-default" >
                                <div class="panel-body" >
                                    <h4 class="media-heading">Resume Status</h4>
                                    <div id="resume_status">
                                    <?
                                    $host="http://ssnunite.com";
                                         if(url_exists($host."/uploads/resume/$_SESSION[uid].pdf")){
                                            ?>
                                        <button type="button" class="btn btn-default btn-sm" onclick="window.open('<?=$host."/uploads/resume/$_SESSION[uid].pdf"?>','_blank')">
                                            <span class="glyphicon glyphicon-cloud-download"></span> Download
                                          </button>
                                                <?
                                         }
                                        else {
                                            echo "Resume is not uploaded";
                                        }
 
                                    ?>
                                    </div>
                                </div>
                            </div>
                            
                                   
                        </div>
                        <div class="col-xs-8 col-sm-6">
                            <div id="progress">
                                    <div id="bar"></div>
                                    <div id="percent">0%</div >
                                </div>
                                <div id="message"></div>
                        </div>
                    </div>

                    <div class="panel panel-default" id="passcode">
                        <div class="panel-body" >
                            <h4 class="media-heading">Change Password</h4>
                            <div class="input-group" style="margin-bottom: 10px">
                                <input type="password" class="form-control" id='password' placeholder="New Password">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick='changepassword($("#password").val())'>Change!</button>
                                </span>
                            </div>
                        </div>
                    </div>


<div class="row row-offcanvas row-offcanvas-right" id="professional">
        <div class="col-xs-8 col-sm-6">
                            <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Professional Detail</h4>
                            <div class="input-group" style="margin-bottom: 10px">
                                <p>
                                    Provide the company you currently working 
                                </p>

                                <div class="control-group">
                                    <input id="itm_company" type="text" class="form-control" value="<?= $row["org"] ?>" onchange="updatefield('org',$(this).val())"
                                           placeholder="Current Company Name" data-validate="alphanumeric_only" />
                                    Total Experience in numbers.
                                    <input id="itm_experiance" type="text" class="form-control" value="<?= $row["experiance"] ?>" onchange="updatefield('experiance',$(this).val())"
                                           placeholder="Exp in Years" data-validate="numbers_only" />
                                </div>

                                <p>
                                    Optional, to provide your Designation.
                                </p>

                                <div class="control-group">
                                    <input id="itm_designation" type="text" class="form-control" value="<?= $row["desig"] ?>" onchange="updatefield('desig',$(this).val())"
                                           placeholder="Manager" data-validate="" />
                                </div>

                                <p>
                                    Optional, Currently i am doing the higher studies
                                </p>

                                <div class="control-group">
                                    <input id="itm_master_college" type="text" class="form-control" value="<?= $row["higherstudies"] ?>" onchange="updatefield('higherstudies',$(this).val())"
                                           placeholder="College Name (Optional)" data-validate="" />
                                </div>
                            </div>
                        </div>
                    </div>

       
    </div>
    <div class="col-xs-8 col-sm-6" id="personal">
                            <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Personal Detail</h4>
                            <div class="input-group" style="margin-bottom: 10px">
                                <p class="errselect">
                                    Please, provide your gender detail.
                                </p>

                                <div class="control-group">
                                    <select data-validate="not_null" class="form-control" id="itm_gender" data-placeholder="Please Select Gender" style="width:350px;" onchange="updatefield('gender',$(this).val())">


                                        <option <?= $row["gender"] == "Male" ? "selected" : "" ?> value="Male">Male</option>
                                        <option <?= $row["gender"] == "Female" ? "selectd" : "" ?> value="Female">Female</option>


                                    </select>
                                </div>
                                <p>
                                    Please, provide your Date of birth.
                                </p>

                                <div class="control-group">
                                    <input id="itm_dob" type="text" class="form-control" value="<?= $row["dob"] ?>" onchange="updatefield('dob',$(this).val())"
                                           placeholder="dd-mm-yyyy" data-validate="date_only" />
                                </div>
                            </div>
                        </div>
                    </div>


    </div>

     <div  class="col-xs-8 col-sm-6" id="batch">
                                <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Change Batch Detail</h4>
                            <div class="input-group" style="margin-bottom: 10px">
                                <select class="form-control" id="itm_year" data-validate="not_null" data-placeholder="Year of Completion" style="width:350px;" onchange="updatefield('batch',$(this).val())" >
                                   
<?php for ($i = 2000; $i <= date("Y") + 4; $i++) { ?>
                                        <option value="<?= $i ?>" <?= $row["batch"] == $i ? "selected" : "" ?>><?= $i ?></option><? }
?>
                                </select>
                            </div>
                        </div>
                    </div>

        </div>
</div>
<div class="row row-offcanvas row-offcanvas-right" id="communication">
    <div class="col-xs-8 col-sm-6">
        
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Communication Detail</h4>
                            <div class="input-group" style="margin-bottom: 10px">

                                <p>
                                    Optional, to provide Mobile Number
                                </p>

                                <div class="control-group">
                                    <input id="itm_mobile"  type="text" class="form-control" value="<?= $row["number"] ?>" onchange="updatefield('number',$(this).val())"
                                           placeholder="Mobile number" data-validate="" />
                                </div>
                                <p>
                                    Please, provide permanent address 
                                </p>

                                <div class="control-group">
                                    <textarea id="itm_address" type="text" class="form-control" onchange="updatefield('address',$(this).val())"
                                              placeholder="Address" data-validate="alphanumeric_only" /><?= $row["address"] ?></textarea>
                                </div>
                                <p>
                                    Optional, to provide your current location
                                </p>

                                <div class="control-group">
                                    <input id="itm_location" type="text" class="form-control" value="<?= $row["country"] ?>" style="width:350px;" onchange="updatefield('country',$(this).val())"
                                           placeholder="Texas,US" data-validate="" />
                                </div>
                            </div>
                        </div>
                    </div>

          
    </div>
    <div class="col-xs-8 col-sm-6" id="social">
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Social Media Detail</h4>
                            <div class="input-group" style="margin-bottom: 10px">

                                <p>
                                    Optional, to provide Facebook 
                                </p>

                                <div class="control-group">
                                    <input id="itm_facebook" type="text" class="form-control" value="<?= $row["facebook"] ?>" onchange="updatefield('facebook',$(this).val())"
                                           placeholder="facebook" data-validate="" />
                                </div>
                                <p>
                                    Optional, to provide  Twitter 
                                </p>

                                <div class="control-group">
                                    <input id="itm_twitter" type="text" class="form-control" value="<?= $row["twitter"] ?>" onchange="updatefield('twitter',$(this).val())"
                                           placeholder="twitter" data-validate="" />
                                </div>
                                <p>
                                    Optional, to provide linkedIn
                                </p>

                                <div class="control-group">
                                    <input id="itm_linkedin" type="text" class="form-control" value="<?= $row["linkedin"] ?>" style="width:350px;" onchange="updatefield('linkedin',$(this).val())"
                                           placeholder="linkedin" data-validate="" />
                                </div>
                                
                            </div>
                        </div>
                    </div>

    </div>
</div><div class="row row-offcanvas row-offcanvas-right" id="likes">
    <div class="col-xs-8 col-sm-6">
        
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Most Like</h4>
                            <div class="input-group" style="margin-bottom: 10px">

                                <p>
                                    Optional, to provide Favorite Movie 
                                </p>

                                <div class="control-group">
                                    <input id="itm_movie" type="text" class="form-control" value="<?= $row["movies"] ?>" onchange="updatefield('movies',$(this).val())"
                                           placeholder="i-Robot, Lord of the rings" data-validate="" />
                                </div>
                                <p>
                                    Optional, to provide Favorite Sports 
                                </p>

                                <div class="control-group">
                                    <input id="itm_hobby" type="text" class="form-control" value="<?= $row["hobby"] ?>" onchange="updatefield('hobby',$(this).val())"
                                           placeholder="Cricket, Tennis" data-validate="" />
                                </div>
                                <p>
                                    Optional, to provide Favorite Music
                                </p>

                                <div class="control-group">
                                    <input id="itm_music" type="text" class="form-control" value="<?= $row["music"] ?>" style="width:350px;" onchange="updatefield('music',$(this).val())"
                                           placeholder="AR Rahman, Illayaraja" data-validate="" />
                                </div>
                                
                            </div>
                        </div>
                    </div>

        
    </div>
    <div class="col-xs-8 col-sm-6" id="skill">
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Skills</h4>
                            <div class="input-group" style="margin-bottom: 10px;width:100%">


                                <div class="control-group">
                                    <input id="itm_skill" type="text" class="form-control" value="<?= $row["skill"] ?>" onchange="updatefield('skill',$(this).val())"
                                           placeholder="Cloud Computing, Network Security" data-validate="" />
                                </div>
                                
                            </div>
                        </div>
                    </div>      
    </div>
    <div class="col-xs-8 col-sm-6" id="aboutme">
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">About Me</h4>
                            <div class="input-group" style="margin-bottom: 10px;width:100%" >


                                <div class="control-group">
                                    <textarea id="itm_about_me" type="text" class="form-control" onchange="updatefield('aboutme',$(this).val())"
                                              placeholder="About Me" data-validate="alphanumeric_only" /><?= $row["aboutme"] ?></textarea>
                                </div>
                                
                            </div>
                        </div>
                    </div>      
    </div>
</div>
                    
                    <div class="panel panel-default" id="lifeafterssn">
                        <div class="panel-body" >
                            <h4 class="media-heading">Club Activities at SSN</h4>
                            <div class="input-group" style="width:100%" style="margin-bottom: 10px">
                                <textarea id="itm_after_ssn" type="text"  class="form-control" onchange="updatefield('ssnmoment',$(this).val())"
                                              placeholder="Sports, sympo, Cultural, EClub, IClub, Dance, Music, etc..." data-validate="alphanumeric_only" /><?= $row["ssnmoment"] ?></textarea>
                    
                               
                            </div>
                        </div>
                    </div>
    
	<!----Edited--->
	<div class="row row-offcanvas row-offcanvas-right" id="postcollege">
    <div class="col-xs-8 col-sm-6">
        
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Post College</h4>
                            <div class="input-group" style="margin-bottom: 10px">

                                <p>
                                    Post College Plan- Work or Higher Studies
                                </p>

                                <div class="control-group">
                                    <input id="itm_postcollege" type="text" class="form-control" value="<?= $row["aftercollege"] ?>" onchange="updatefield('aftercollege',$(this).val())"
                                           placeholder="Work or Higher Studies" data-validate="" />
                                </div>
                                <p>
                                    If Higher Studies, Name of the College
                                </p>

                                <div class="control-group">
                                    <input id="itm_nameofcollege" type="text" class="form-control" value="<?= $row["higherstudies"] ?>" onchange="updatefield('higherstudies',$(this).val())"
                                           placeholder="College Name" data-validate="" />
                                </div>
                                <p>
                                    Higher Study Degree and Specilization
                                </p>

                                <div class="control-group">
                                    <input id="itm_music" type="text" class="form-control" value="<?= $row["higherstudiesdeg"] ?>" style="width:350px;" onchange="updatefield('higherstudiesdeg',$(this).val())"
                                           placeholder="MS ME Wireless Software" data-validate="" />
                                </div>
                                
                            </div>
                        </div>
                    </div>

        
    </div>
<div class="col-xs-8 col-sm-6" id="scholarship">
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Scholarship</h4>
                            <div class="input-group" style="margin-bottom: 10px;width:100%">


                                <div class="control-group">
                                    <input id="itm_scholarship" type="text" class="form-control" value="<?= $row["scholarship"] ?>" onchange="updatefield('scholarship',$(this).val())"
                                           placeholder="Walk in Walk out, Merit etc,..." data-validate="" />
                                </div>
                                
                            </div>
                        </div>
                    </div>      
    </div>
    <div class="col-xs-8 col-sm-6" id="universitynumber">
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">University Number</h4>
                            <div class="input-group" style="margin-bottom: 10px;width:100%" >


                                <div class="control-group">
                                    <textarea id="itm_universitynumber" type="text" class="form-control" onchange="updatefield('rollno',$(this).val())"
                                              placeholder="Eg.31509106001" data-validate="alphanumeric_only" /><?= $row["rollno"] ?></textarea>
                                </div>
                                
                            </div>
                        </div>
                    </div>      
    </div>
	    <div class="col-xs-8 col-sm-6" id="fathersname">
        <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Father's Name</h4>
                            <div class="input-group" style="margin-bottom: 10px;width:100%" >


                                <div class="control-group">
                                    <textarea id="itm_about_me" type="text" class="form-control" onchange="updatefield('fathersname',$(this).val())"
                                              placeholder="Eg.Ram" data-validate="alphanumeric_only" /><?= $row["fathersname"] ?></textarea>
                                </div>
                                
                            </div>
                        </div>
                    </div>      
    </div>
</div>

<!---Edited--->

<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-8 col-sm-6"></div>
    <div class="col-xs-8 col-sm-6"></div>
</div>

          







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
        <script src="../js/jquery.form.min.js"></script>
        <script>

        function updatefield( field,value){
             $.ajax({
                            url: "_register.php?action=singlefieldupdate&field="+field+"&value="+value,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                                    
                            //$("#content").html(html);
                            
                        });
        }
                                        function fileAjax() {
                                            //alert ("<p>hello</p>".replace(/<(?:.|\n)*?>/gm, ''))
                                            var options = {
                                                beforeSend: function()
                                                {
                                                    $("#progress").show();
                                                    //clear everything
                                                    $("#bar").width('0%');
                                                    $("#message").html("");
                                                    $("#percent").html("0%");
                                                },
                                                uploadProgress: function(event, position, total, percentComplete)
                                                {
                                                    $("#bar").width(percentComplete + '%');
                                                    $("#percent").html(percentComplete + '%');

                                                },
                                                success: function()
                                                {
                                                    $("#bar").width('100%');
                                                    $("#percent").html('100%');

                                                },
                                                complete: function(response)
                                                {
                                                    $("#message").html("<font color='green'>" + response.responseText + "</font>");
                                                    $("#imgpreview").attr("src", "../uploads/profile/" + response.responseText);
                                                },
                                                error: function()
                                                {
                                                    $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

                                                }

                                            };

                                            $("#myForm").ajaxForm(options);
                                        }

                                        function fileAjaxdoc() {
                                            //alert ("<p>hello</p>".replace(/<(?:.|\n)*?>/gm, ''))
                                            var options = {
                                                beforeSend: function()
                                                {
                                                    $("#progress").show();
                                                    //clear everything
                                                    $("#bar").width('0%');
                                                    $("#message").html("");
                                                    $("#percent").html("0%");
                                                },
                                                uploadProgress: function(event, position, total, percentComplete)
                                                {
                                                    $("#bar").width(percentComplete + '%');
                                                    $("#percent").html(percentComplete + '%');

                                                },
                                                success: function()
                                                {
                                                    $("#bar").width('100%');
                                                    $("#percent").html('100%');

                                                },
                                                complete: function(response)
                                                {
                                                    $("#message").html("<font color='green'>" + response.responseText + "</font>");
                                                },
                                                error: function()
                                                {
                                                    $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

                                                }

                                            };

                                            $("#myFormdoc").ajaxForm(options);
                                        }
                                        $(".nav a").click(function () {
                                            //alert("");
                                           
                                            for(i=0;i<2;i++) {
                                                $($(this).attr('href')).fadeTo('slow', 0.25).fadeTo('slow', 1.0);
                                              }
                                            
                                      });
                                        $(document).ready(function()
                                        {
                                            fileAjax();
                                            fileAjaxdoc();

                                        });
        </script>
    </body>
</html>
