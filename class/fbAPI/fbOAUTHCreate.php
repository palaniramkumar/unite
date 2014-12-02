<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
require './src/facebook.php';
require_once '../dbConnection.php';
require_once '../CommonMethod.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
    'appId' => '275028862543667',
    'secret' => 'ef977d961e046ea92eb4ab37e8e72003',
        ));

// Get User ID
//$facebook->setAccessToken('275028862543667|YSrfS7s94jhtU_kx4AH62vDBy38');
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        //$user_profile = $facebook->api('/me');
        $user_profile = $facebook->api(array(
            'method' => 'fql.query',
            'query' => 'SELECT uid, name, work_history,
 education_history, current_location, profile_url, email FROM user WHERE uid  = me()',
        ));
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl(array('scope' => 'email,read_stream'));
}

if ($user != null):
    //$obj = json_decode($user_profile);
    $name = $user_profile[0]["name"];
    $email = $user_profile[0]["email"];
    $_SESSION["email"]=$email;
    $profileurl = $user_profile[0]["profile_url"];
    $bool = 0;
    foreach ($user_profile[0]["education_history"] as &$college) {

        if (strpos($college["name"], 'SSN') !== FALSE)
            $bool = 1;
    }
    //echo "welcome! ".$email;
    $db = new dbConnection();

    //$_SESSION['token'] = "facebook";
        $db->createaccount($email, $name, "facebook");
 else: ?>

<p align="center" style="margin: 10px;padding: 10px;background-color: #0077a3;color: white;font-weight: 900"> <a style="color: white; display: table-cell; " href="<?php echo $loginUrl; ?>">Connect with Facebook</a></p>
<script>window.location.href = '<?=$loginUrl?>' </script>
<?php endif ?>


