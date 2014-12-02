<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once('sendmail1.php');
$to= array();
$to[0]="ajc.ramkumar@gmail.com";
$msg="Please verify your account by simply click this <a href=#'>link</a> Validate My Account or, simple copy paste this URL in your webbrowser.<br/>";
sendinlinemail("[SSN Alumni] Gentle Remainder - Verify Account", $msg, $to);
echo "Thank you for sending us feedback";

?>