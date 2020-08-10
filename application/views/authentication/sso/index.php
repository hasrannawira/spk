<?php

// load the library
require "login.php";

// make an instance
$sso = new LoginSSO();

// set client_id and client_secret
$sso->setCredential("19105-spk-4r1", "fbe2606f-b543-41db-98db-a19f13229932");

// protocol https it's default, if you wanna change to http:// :
// $sso->setCredential("<client_id>", "<client_secret>", "http://");

// by default, redirect uri goes to current uri, if you wanna change it :
$sso->setRedirectUri('http://localhost/spk');

try{
    // get token, user information, and logout url
    $login_sso = $sso->getLogin();
    $access_token = $login_sso['token'];
    $user = $login_sso['user'];
    $logout_url = $login_sso['logout_url'];

    // if you prefer to print the output to JSON, use this:
    $sso->getLoginAsJSON();
}catch(Exception $e){
    echo $e->getMessage();
}
