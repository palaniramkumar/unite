<?php
function executeURL($url){
            $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
      
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    
}
$access_token="https://graph.facebook.com/oauth/access_token?client_id=275028862543667&client_secret=ef977d961e046ea92eb4ab37e8e72003&grant_type=client_credentials&".  rand(1, 99999999);
$getToken=executeURL($access_token);
//echo $getToken;
$graph_url= "https://graph.facebook.com/ssnalumni/feed?fields=id%2Cname%2Cmessage&method=GET&format=json&suppress_http_code=1&$getToken";
$getResult=executeURL($graph_url);
//$obj = json_decode($getResult);
$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($getResult, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);
?>
<a href="#" class="list-group-item active">
    Facebook (ssnalumni) 
  </a>
<div style="overflow:scroll;overflow-x:hidden;;height: 250px;font-size: small"">
<?
$i=0;
foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
       // echo "$key:\n";
    } else {
        
        if($key=="message")
            echo "<a href='http://facebook.com/ssnalumni' target='_blank' class='list-group-item'>".$val."</a>";
    }
}
//echo $getResult ;
        
?>
</div>