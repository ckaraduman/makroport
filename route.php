<?php
session_start();

$url = $_GET['url'] ?? '/';
$url = trim($url, '/');

// Route tanımları
$routes = [
    '' => 'pages/home.php',                      // Ana sayfa
    'login' => 'auth/login.php',
    'logout' => 'auth/logout.php',
    'logincontrol' => 'auth/logincontrol.php',
    'about' => 'pages/about.php',
    'contact' => 'pages/contact.php',
    'games' => 'pages/games.php',
    'register' => 'auth/register.php',
    'dashboard' => 'dashboard',
    'admin/users' => 'admin/users',
    'api/getuser' => 'api/getuser',
    'profilim' => 'user/profile',     // İstediğiniz gibi eşleme
];

// Eğer route tanımlıysa dosya yolunu al
if (array_key_exists($url, $routes)) {
    $page = $routes[$url];
}
// Tanımsızsa ama eşleşen bir dosya varsa direkt onu kullan (fallback)
elseif (file_exists("pages/$url.php")) {
    $page = $url;
}
// Hiçbiri yoksa 404
else {
    $page = '404'; // pages/404.php varsa
}

// Layout'a yönlendir
include 'layout.php';