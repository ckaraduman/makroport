<?php
session_start(); // Oturumu başlat

// Tüm oturum değişkenlerini temizle
session_unset();
session_destroy();

setcookie('rememberMe', '', time() - 3600); // Çerezi geçmiş bir zamana ayarla, böylece tarayıcı çerezi siler
setcookie('email', '', time() - 3600);      // Aynı şekilde email çerezini de sil

// Kullanıcıyı giriş sayfasına yönlendir
header("Location: /");
exit();
?>
