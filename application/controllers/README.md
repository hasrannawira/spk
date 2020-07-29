# SSO BPS - PHP 5.3

Library ini berfungsi untuk melakukan login dengan menggunakan metode Single-Sign-On atau SSO. Library ini terinspirasi dari library [SSO-PHP](https://git.bps.go.id/jkd-repo/sso-php), akan tetapi untuk library yang ini dapat digunakan juga untuk php versi >= 5.3.3

## Requirements

* php >= 5.3
* php extension curl enabled 
* client_id dan client_secret dari aplikasi yang ingin dibuat SSO. kalau belum punya, Anda bisa mendaftarkan aplikasi Anda ke Subdit JKD, SIS.


## Instalation

Gunakan git clone seperti sintaks di bawah, atau download zip repository ini 

```git
git clone http://git.bps.go.id/aditya.sudyana/sso-bps---php-5.3.git
```
Setelah itu, library sudah dapat langsung digunakan tanpa harus menginstall dependency yang lain

## Usage

```php
// load the library
require "login.php";

// make an instance
$sso = new LoginSSO();

// set client_id and client_secret
$sso->setCredential("<client_id>", "<client_secret>");

// protocol https it's default, if you wanna change to http:// :
// $sso->setCredential("<client_id>", "<client_secret>", "http://");

// by default, redirect uri goes to current uri, if you wanna change it :
$sso->setRedirectUri('https://yourapplication.com');

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
```

## Feedback
Apabila ada masukan, tambahan, atau bahkan pertanyaan/error, silakan open issue, kalau ada yang bisa saya bantu, akan saya bantu semaksimal mungkin. Terima Kasih.

Semoga bisa bermanfaat.
