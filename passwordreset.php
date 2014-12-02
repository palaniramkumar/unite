<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        require_once('./class/dbConnection.php');    
        $db = new dbConnection();
        $con = $db->getConnection();
        $sql="select * from  alumnireg where auth_code='$_REQUEST[authcode]' and email='$_REQUEST[email]' and auth_code <> '0'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $valid="false";
        if($result==0){
            return "email is not registered to this portal";
        }
        if($row = mysqli_fetch_array($result)){
            $_SESSION["uname"]=$row[fname];
            $_SESSION["uid"]=$row[rowid];
            $_SESSION["urole"]=$row[role];
            $valid="true";
        }
	if($row['role']=="Invalid"){
            $sql = "update  alumnireg set role ='Pending' where email like '$_REQUEST[email]'";
            $result = mysqli_query($con, $sql); //write the password validation
			if (!$result) {
				 mysqli_close($con);
                                movePage(301, "../../index.php?msg=Unable to send verfication link. Please try to login with FB/Google Auth");
		               
            		}
			 $_SESSION["urole"] = "Pending";

        }
        mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Password Reset</title>
        <style>
            ::-moz-selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            ::selection {
                background: #b3d4fc;
                text-shadow: none;
            }

            html {
                padding: 30px 10px;
                font-size: 20px;
                line-height: 1.4;
                color: #737373;
                background: #f0f0f0;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }

            html,
            input {
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            }

            body {
                max-width: 500px;
                _width: 500px;
                padding: 30px 20px 50px;
                border: 1px solid #b3b3b3;
                border-radius: 4px;
                margin: 0 auto;
                box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;
                background: #fcfcfc;
            }

            h1 {
                margin: 0 10px;
                font-size: 50px;
                text-align: center;
            }

            h1 span {
                color: #bbb;
            }

            h3 {
                margin: 1.5em 0 0.5em;
            }

            p {
                margin: 1em 0;
            }

            ul {
                padding: 0 0 0 40px;
                margin: 1em 0;
            }

            .container {
                max-width: 380px;
                _width: 380px;
                margin: 0 auto;
            }

            /* google search */

            #goog-fixurl ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            #goog-fixurl form {
                margin: 0;
            }

            #goog-wm-qt,
            #goog-wm-sb {
                border: 1px solid #bbb;
                font-size: 16px;
                line-height: normal;
                vertical-align: top;
                color: #444;
                border-radius: 2px;
            }

            #goog-wm-qt {
                width: 220px;
                height: 20px;
                padding: 5px;
                margin: 5px 10px 0 0;
                box-shadow: inset 0 1px 1px #ccc;
            }

            #goog-wm-sb {
                display: inline-block;
                height: 32px;
                padding: 0 10px;
                margin: 5px 0 0;
                white-space: nowrap;
                cursor: pointer;
                background-color: #f5f5f5;
                background-image: -webkit-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -moz-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -ms-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                background-image: -o-linear-gradient(rgba(255,255,255,0), #f1f1f1);
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                *overflow: visible;
                *display: inline;
                *zoom: 1;
            }

            #goog-wm-sb:hover,
            #goog-wm-sb:focus {
                border-color: #aaa;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
                background-color: #f8f8f8;
            }

            #goog-wm-qt:hover,
            #goog-wm-qt:focus {
                border-color: #105cb6;
                outline: 0;
                color: #222;
            }

            input::-moz-focus-inner {
                padding: 0;
                border: 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Password <span>Reset</span></h1>
            <?if($valid!="true"){?>
            <p>Sorry,Unable to Reset your password</p>
            <p>It looks like the email id and security code is invalid</p>
            <? }else {?>
            <p>Successfully Authorized the Keys. </p>
            <p>Click <a href="./activity/changepassword.php">here</a> to change your password</p>
            <?}?>
        </div>
    </body>
</html>
