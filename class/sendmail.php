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
 /*   require_once('class.phpmailer.php');
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "info@ssnunite.com";
    $mail->Password = "ssncollege";
    $mail->SetFrom("info@ssnunite.com","info [SSN Alumni]");
    $mail->Subject = $title;
    $body = file_get_contents('../email_template/comment.html');
    $body = str_replace('%title%', $title, $body); 
    $body = str_replace('%desc%', $msg, $body); 
    $mail->Body = $body;
    
    $mail->AddAddress("noreply@ssnunite.com");
	 for ($i=0; $i<sizeof($to); $i++) {
        $mail->AddBCC($to[$i]);
        //echo "here:".$to[$i];
     }
	    
    if (!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent";
    }
   */
	$recipient="";	
     for ($i=0; $i<sizeof($to); $i++) {
        $recipient.=$to[$i].",";
        //echo "here:".$to[$i];
     }

$to = "info@ssnunite.com";
    
   	
$from = "noreply@ssnunite.com";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$to="info@ssnunite.com";
// Additional headers
$headers .= 'To: '.$to . "\r\n";
$headers .= 'From: SSN Alumni <noreply@ssnunite.com>' . "\r\n";
$headers .= 'Bcc: '.$recipient . "\r\n";
$headers .='Reply-To: '. $to . "\r\n" ;
//echo $headers;
    $body = file_get_contents('../email_template/comment.html');
    $body = str_replace('%title%', $title, $body); 
    $body = str_replace('%desc%', html_entity_decode($msg), $body); 

if(mail($to,$title,$body,$headers)){
echo "Check SPAM ! Please verify your email id by clicking the verfication link. This mail may be filtered as SPAM by your email provider";
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