<?php
session_start();
function getemailstatus(){
    $sql="select flag from admin where feature = 'alow_send_mail'";
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    $flag=0;
    if ($row = mysqli_fetch_array($result)) {
        $flag=$row["flag"];
    }
    mysqli_close($con);
    return $flag;
}
//sendinlinemail("hey","test","palaniramkumar@gmail.com");
function sendinlinemail($title,$msg,$to=NULL) {
    if(getemailstatus()==0)
                return;

	$recipient="";	
     for ($i=0; $i<sizeof($to); $i++) {
        $recipient.=$to[$i].",";
        //echo "here:".$to[$i];
     }

$to = "info@ssnunite.com";
    
   	
$from = "noreply@ssnunite.com";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers  .= 'X-MSMail-Priority: High' . "\r\n";
//$headers .='X-Mailer: PHP/' . phpversion(). "\r\n"; 
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= 'Return-Path: SSN Unite <admin@ssnunite.com>'. "\r\n"; 
$headers .= "Organization: SSN Unite\r\n";
$to="info@ssnunite.com";
// Additional headers
$headers .= 'To: '.$to . "\r\n";
$headers .= 'From: SSN Alumni <noreply@ssnunite.com>' . "\r\n";
$headers .= 'Bcc: '.$recipient . "\r\n";
$headers .='Reply-To: '. $to . "\r\n" ;
//echo $headers;
$body = file_get_contents('../email_template/msg.html');
$body = str_replace('%title%', $title, $body); 
$body = str_replace('%desc%', $msg, $body); 

if(mail($to,$title,$body,$headers)){
echo "Check SPAM !  This mail may be filtered as SPAM by your email provider";
}
else 
  {
  echo("Email Message delivery failed.");
  }
    /*
     * 
     * 
     */
}

?>