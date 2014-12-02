hi
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once('class.phpmailer.php');
$recipient="ramkumar2ky@gmail.com,palaniramkumar@gmail.com,";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers  = 'mailed-by: SSNUnite.com' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$to="info@ssnunite.com";
// Additional headers
$headers .= 'To: '.$to . "\r\n";
$headers .= 'From: SSN Alumni <noreply@ssnunite.com>' . "\r\n";
$headers .= 'Bcc: '.$recipient . "\r\n";
echo $headers;
    $body = file_get_contents('../email_template/comment.html');
    $body = str_replace('%title%', $title, $body); 
    $body = str_replace('%desc%', $msg, $body); 

mail($to,$title,$body,$headers);

?>
hi