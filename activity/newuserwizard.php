<!DOCTYPE html>
<? session_start(); ?>
<html>

    <head>
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <link href="../css/bootstrap-wizard.css" rel="stylesheet" />
        <link href="../css/chosen.css" rel="stylesheet" />

        <style type="text/css">
            .wizard-modal p {
                margin: 0 0 10px;
                padding: 0;
            }

            #wizard-ns-detail-servers, .wizard-additional-servers {
                font-size:12px;
                margin-top:10px;
                margin-left:15px;
            }
            #wizard-ns-detail-servers > li, .wizard-additional-servers li {
                line-height:20px;
                list-style-type:none;
            }
            #wizard-ns-detail-servers > li > img {
                padding-right:5px;
            }

            .wizard-modal .chzn-container .chzn-results {
                max-height:150px;
            }
            .wizard-addl-subsection {
                margin-bottom:40px;
            }
        </style>
    </head>

    <body style="padding:30px;">
    <center>
        <div style="margin-bottom:20px;">
            <a href="http://ssnunite.com" target="_blank">
                <img style="width:220px;" src="../img/logo.png">
            </a>
        </div>
        <button id="open-wizard" class="btn btn-primary">Open wizard</button>
        <button id="open-wizard" class="btn btn-danger" onclick="window.location.href = '../logout.php'">Logout</button>
	<div id="debug"></div>
    </center>


    <div class="wizard" id="wizard-demo">
        <h1>Create User Profile</h1>

        <div class="wizard-card" data-onValidated="setServerName" data-cardname="name">
            <h3>Personal Information</h3>

            <div class="wizard-input-section">
                <p>
                    To begin, Please enter your first name not father's name.
                </p>

                <div class="control-group">
                    <input id="itm_fname" type="text"
                           placeholder="First Name" data-validate="alphabets_only" />
                </div>
            </div>

            <div class="wizard-input-section">
                <p>
                    Optionally, give your Last name or initial.
                </p>

                <div class="control-group">
                    <input id ="itm_lname" type="text"
                           placeholder="Last Name (Optional)" data-validate="" />
                </div>
            </div>
            <div class="wizard-input-section ">
                <p class="errselect">
                    Please, provide your gender detail.
                </p>

                <div class="control-group">
                    <select data-validate="not_null"  style="width:220px;" id="itm_gender">
                        <option value="">Select Gender</option>
                       
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                       

                    </select>
                </div>
            </div>
            
        </div>


        <div class="wizard-card" data-cardname="group">
            <h3>College Information</h3>

            <div class="wizard-input-section">

                <div class="wizard-input-section">
                    <p class="errselect">
                        Please, provide your department.
                    </p>

                    <div class="control-group">
                        <select data-placeholder="Department" style="width:350px;" id="itm_department" class="chzn-select" data-validate="not_null">
                            <option value=""></option>
                            <optgroup label="Masters">
                                <option value="MCA">MCA</option>

                                <option value="MBA">MBA</option>
                                <option value="M.E (Communication Systems)">M.E, Communication System</option>
                                <option value="M.E (CSE)">M.E, Computer Science Engineering</option>
                                <option value="M.E, Applied Electronics">M.E, Applied Electronics</option>
                                <option value="M.E (Power Electronics & Drives)">M.E, Power Electronics & drivers</option>
                                <option value="M.E (Computer and Communication)">M.E, Computer & Communication</option>
                                <option value="M.E. in VLSI Design (ECE Department)">M.E, ECE (VLSI Design)</option>
                                <option value="M.E Manufacturing engineering">M.E Manufacturing engineering</option>
                                <option value="M.E Software Engineering">M.E, CSC (Software Engineering) </option>
                                <option value="M.Sc (IT)">MSc, Information Technology</option>	
                            </optgroup>

                            <optgroup label="Bachelore">
                                <option value="B.E (CSC)">B.E, Computer Science Engineering</option>
                                <option value="B.E (EEE)">B.E, Electrical Electronic Engineering</option>
                                <option value="B.E (ECE)">B.E, Electronic Communication Engineering</option>
                                <option value="B.E (BME)">B.E, Bio Medical Engineering</option>
                                <option value="B.E (ME)">B.E, Mechanical Engineering</option>
                                <option value="B.Tech (IT)">B.Tech, Information Technology</option>
                                <option value="B.Tech (Chemical)">B.Tech, Chemical Engineering</option>
                            </optgroup>


                        </select>
                    </div>
                </div>
                <div class="wizard-input-section">
                    <p  class="errselect">
                        When did you complete SSN College?.
                    </p>

                    <div class="control-group">
                        <select class="wizard-ns-select chzn-select" id="itm_year" data-validate="not_null" data-placeholder="Year of Completion" style="width:350px;" >
                            <option value=""></option>
                            <?php for ($i = 2000; $i <= date("Y")+4; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option><? }
                            ?>
                                <option value="0">na</option>
                        </select>
                    </div>
                </div>
                    <div class="wizard-input-section">
                <p>
                    Please, provide your Date of birth.
                </p>

                <div class="control-group">
                    <input id="itm_dob" type="text"
                           placeholder="dd-mm-yyyy" data-validate="date_only" />
                </div>
            </div>
            

            </div>
        </div>


        <div class="wizard-card" data-cardname="services" >
            <h3>Professional Information</h3>

            <div id="studentmsg"></div>
            
            <div class="wizard-input-section" id="professionalinfo">
                <div class="wizard-input-section">
                    <p>
                        Provide the company you currently working & Total Experience in numbers.
                    </p>

                    <div class="control-group">
                        <input id="itm_company" type="text"
                               placeholder="Current Company Name" data-validate="alphanumeric_only" /><br/>
                        <input id="itm_experiance" type="text"
                               placeholder="Exp in Years" data-validate="not_null" />
                    </div>
                </div>
                <div class="wizard-input-section">
                    <p>
                        Optional, to provide your Designation.
                    </p>

                    <div class="control-group">
                        <input id="itm_designation" type="text"
                               placeholder="Manager" data-validate="" />
                    </div>
                </div>
                <div class="wizard-input-section">
                    <p>
                        Optional, Currently i am doing the higher studies
                    </p>

                    <div class="control-group">
                        <input id="itm_master_college" type="text"
                               placeholder="College Name (Optional)" data-validate="" />
                    </div>
                </div>


            </div>
        </div>


        <div class="wizard-card" data-onload="" data-cardname="location">
            <h3>Communication detail</h3>

            <div class="wizard-input-section">
                <p>
                    Optional, to provide Mobile Number (Only for Admin purpose.Will not be revealed for Alumni's)
                </p>

                <div class="control-group">
                    <input id="itm_mobile" type="text"
                           placeholder="Mobile number" data-validate="" />
                </div>
            </div>
            <div class="wizard-input-section">
                <p>
                    Please, provide permanent address 
                </p>

                <div class="control-group">
                    <textarea id="itm_address" type="text"
                              placeholder="Address" data-validate="not_null" /></textarea>
                </div>
            </div>
            <div class="wizard-input-section">
                <p>
                    Optional, to provide your current location
                </p>

                <div class="control-group">
                    <input id="itm_location" type="text"
                           placeholder="Texas,US" data-validate="" />
                </div>
            </div>
        </div>






        <div class="wizard-error">
            <div class="alert alert-error">
                <strong>There was a problem</strong> with your submission.
                Please correct the errors and re-submit.
            </div>
        </div>

        <div class="wizard-failure">
            <div class="alert alert-error">
                <strong>There was a problem</strong> submitting the form.
                Please try again in a minute.
            </div>
        </div>

        <div class="wizard-success">
            <div class="alert alert-success">
                <span class="create-server-name"></span>Account
                was created <strong>successfully.</strong>
            </div>


            <a class="btn im-done" href="../index.php">Move to Home Page</a>
        </div>

    </div>
    <input type="hidden" value="<?=date("Y")?>" id="curyear"/>

    <script src="../js/jquery.js"></script>
    <script src="../js/chosen.jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-wizard.min.js"></script>


    <script type="text/javascript">

     
        function alphabets_only(el) {
            var val = el.val();
            ret = {
                status: true
            };
          
            if (/^[a-zA-Z ]*$/.test(val)==false) {
                ret.status = false;
                ret.msg = "Alphabets Only";
            }
            if ($.trim(val)=="") {
                ret.status = false;
                ret.msg = "Alphabets Only";
            }

            return ret;
        }
        function alphanumeric_only(el) {
            var val = el.val();
            ret = {
                status: true
            };
          
            if (/^[a-z\d\-_\s]+$/i.test(val)==false) {
                ret.status = false;
                ret.msg = "Input Required";
            }
            
            return ret;
        }
        function numbers_only(el) {
            var val = el.val();
            ret = {
                status: true
            };
          
            if (/^\d+$/.test(val)==false) {
                ret.status = false;
                ret.msg = "Numbers Only";
            }
            
            return ret;
        }
        //
        function date_only(el) {
            var val = el.val();
            ret = {
                status: true
            };
          
            if (/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/.test(val)==false) {
                ret.status = false;
                ret.msg = "Date is not valid";
            }
            
            return ret;
        }

        function not_null(el) {
            var val = el.val();
            ret = {
                status: true
                
            };
          
            if ($.trim(val)==="") {
                ret.status = false;
                ret.msg = "Please Select";
                $('.errselect').css('background-color',"#F2DEDE");
            }
            else
                $('.errselect').css('background-color',"white");
            if($(el).attr("id")=="itm_year"){
            if($("#itm_year").val()>=$("#curyear").val()){
                    
                    $("#professionalinfo").hide();
                    $("#studentmsg").html("This details are not applicable, you can continue to the next screen");
                    $("#itm_company").val("na")
                    $("#itm_experiance").val("0")
                }
                else{
                    $("#professionalinfo").show();
                    $("#studentmsg").html("");
                    $("#itm_company").val("")
                    $("#itm_experiance").val("")
                }
            }
            return ret;
        }

        $(function() {

            $.fn.wizard.logging = true;

            var wizard = $("#wizard-demo").wizard({
                showCancel: false
            });

            $(".chzn-select").chosen();

            wizard.el.find(".wizard-ns-select").change(function() {
                wizard.el.find(".wizard-ns-detail").show();
                
            });

            wizard.el.find(".create-server-service-list").change(function() {
                var noOption = $(this).find("option:selected").length == 0;
                wizard.getCard(this).toggleAlert(null, noOption);
            });

            wizard.cards["name"].on("validated", function(card) {
                var hostname = card.el.find("#new-server-fqdn").val();
                
            });

            wizard.on("submit", function(wizard) {
                var fname = $("#itm_fname").val();
                var lname = $("#itm_lname").val();
                var dob = $("#itm_dob").val();
                var gender = $("#itm_gender").val();
                var branch = $("#itm_department").val();
                var batch = $("#itm_year").val();
                var org = $("#itm_company").val();
                var desig = $("#itm_designation").val();
                var higherstudies = $("#itm_master_college").val();
                var country = $("#itm_location").val();
                var mobile = $("#itm_mobile").val();
                var address = $("#itm_address").val();
                var experiance = $("#itm_experiance").val();
                var param = "&fname=" + fname + "&lname=" + lname + "&dob=" + dob + "&gender=" + gender + "&branch=" + branch + "&batch=" + batch + "&org=" + org + "&desig=" + desig + "&higherstudies=" + higherstudies + "&country=" + country + "&mobile=" + mobile + "&address=" + address + "&experiance=" + experiance
                //$('#debug').html("_register.php?action=update" + param);
                //return;
                $.ajax({
                    url: "_register.php?action=update" + param,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {

                    wizard.trigger("success");
                    wizard.hideButtons();
                    wizard._submitting = false;
                    wizard.showSubmitCard("success");
                    wizard.updateProgressBar(0);

                });




            });

            wizard.on("reset", function(wizard) {
                wizard.setSubtitle("");
                wizard.el.find("#new-server-fqdn").val("");
                wizard.el.find("#new-server-name").val("");
            });

            wizard.el.find(".wizard-success .im-done").click(function() {
                wizard.reset().close();
            });

            wizard.el.find(".wizard-success .create-another-server").click(function() {
                wizard.reset();
            });

            $(".wizard-group-list").click(function() {
                alert("Disabled for demo.");
            });

            $("#open-wizard").click(function() {
                wizard.show();
            });

            wizard.show();
        });
        function UpdateProfile() {

        }
    </script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35033623-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

    
</script>



</body>
</html>
