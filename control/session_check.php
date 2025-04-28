<?php

if (isset($_COOKIE['rememberMe'])) {
    // Çerezdeki kullanıcı hash değerini kontrol et
    $userHash = $_COOKIE['rememberMe'];
    // Burada kullanıcı hash değerini veritabanı ile kontrol edebilirsiniz
    // Bu örnekte basit bir kontrol yapacağız
    if ($userHash == hash('sha256', "user@example.com")) {
        $_SESSION['email'] = "user@example.com";
    }
}
function check_session() {
    session_start(); // Oturumu başlat
    if (!isset($_SESSION['email'])) {
        // Oturum değişkeni yoksa, giriş sayfasına yönlendir
        header("Location: /");
        exit();
    }
}



