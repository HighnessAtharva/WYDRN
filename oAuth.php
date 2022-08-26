<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('518704041766-41bs6d5lc0c0d8e08692m43isb78sv2b.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/WYDRN/profile.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>