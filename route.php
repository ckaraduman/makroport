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
    'verify' => 'auth/verify.php',               // E-posta doğrulama sayfası
    'about' => 'pages/about.php',
    'software' => 'pages/software.php',
    'makrodocs' => 'pages/makrodocs.php',       // MakroDocs sayfası
    'org_reg' => 'pages/organization_register.php'  , // Organizasyon kaydı sayfası        
    'course' => 'pages/course.php',
    'blog' => 'pages/blog.php',
    'add' => 'pages/add-quote.php',       // Alıntı ekleme sayfası
    'list-quotes' => 'pages/list-quotes.php', // Alıntı listesi sayfası
    'view-quote' => 'pages/view-quote.php', // Alıntı detay sayfası
    'quotation' => 'pages/quotation.php',        // Alıntılar ve yorumlar sayfası
    'contact' => 'pages/contact.php',
    'send-message' => 'pages/send-message.php', // İletişim mesajı gönderme
    'games' => 'pages/games.php',
    'makroword' => 'pages/makroword.php',        // Kelime bulma oyunu
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