<?php

//start session on web page

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('988038578935-ch01n7jorh7ji547d5ufbmlaoloe5e7l.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/f-linkage/Login-System/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>