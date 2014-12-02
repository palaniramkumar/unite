<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
require_once './src/Google_Client.php';
require_once './src/contrib/Google_Oauth2Service.php';
require_once '../dbConnection.php';
require_once '../CommonMethod.php';


session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
$client = new Google_Client();
$client->setApplicationName("Google OAuth");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
 $client->setClientId('100558720107-9ip7n0vehhn9m2c1lh6po8294i3d909j.apps.googleusercontent.com');
 $client->setClientSecret('3qjd-RgBG0j7dNku5UFy6nje');
 $client->setRedirectUri('http://ssnunite.com/class/googleAPI/googleOAUTHCreate.php');
 $client->setDeveloperKey('100558720107-9ip7n0vehhn9m2c1lh6po8294i3d909j@developer.gserviceaccount.com');
$oauth2 = new Google_Oauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $client->revokeToken();
}

if ($client->getAccessToken()) {
    
  $user = $oauth2->userinfo->get();

  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $name = filter_var($user['name']);

  //$img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup = "$email<div>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
  $_SESSION["email"]=$email;
  $db = new dbConnection();
  $db->createaccount($email,$name,"Google");
  
  
} else {
  $authUrl = $client->createAuthUrl();
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php if(isset($personMarkup)): ?>
<?php print $personMarkup ?>
<?php endif ?>
<?php
  if(isset($authUrl)) {
      ?><p align="center"  style="margin: 10px;padding: 10px;background-color: #ab171e;color: white;font-weight: 900"> <a class='login' style="color: white; display: table-cell; " href='<?=$authUrl?>'>Connect with Google!</a></p>
          <script>window.location.href = '<?=$authUrl?>' </script>
          <?
  } else {
   //print "<a class='logout' href='?logout'>Logout</a>";
  }
?>
</body></html>