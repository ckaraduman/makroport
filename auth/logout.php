<?php
require_once __DIR__ . '/../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Eğer kullanıcı oturumu varsa, ID üzerinden token'ı sil
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

// Eğer oturum olmasa bile, cookie'den token gelirse yine temizle
if (isset($_COOKIE['remember_token'])) {
    // Tarayıcıdan çerezi sil
    setcookie('remember_token', '', time() - 3600, "/", "", false, true);

    // Veritabanında bu token'a sahip kullanıcı varsa onu da temizle
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL WHERE remember_token = ?");
    $stmt->execute([$_COOKIE['remember_token']]);
}

// Oturumu tamamen sonlandır
session_unset();
session_destroy();

// Giriş sayfasına yönlendir
header('Location: /login');
exit;
