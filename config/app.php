<?php

$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
[$url,] = explode('config', $url);
// $escaped_url = 'http:' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
//define("APP_URL", $escaped_url);
const APP_URL = 'http://localhost:8080/camagru/mine';
const SENDER_EMAIL_ADDRESS = 'no-reply@camagru.com';
date_default_timezone_set('Europe/Helsinki');


// http://localhost:8080/camagru/mine/activate.php?email=aleksei.shatalov@outlook.com&activation_code=b00aeec59ccdee536645bd310228767f
//http://localhost:8080/camagru/mine/reset_pass.php?email=aaaa@aa.aa&reset_code=f1160afedcad172eb972ab3b549c6fa1;
//http://localhost:8080/camagru/mine/reset_pass.php?email=aaaa@aa.aa&reset_code=f532c8c32e3f9b33438a34b0fb44fa98