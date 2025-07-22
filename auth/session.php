<?php
if (session_status() === PHP_SESSION_NONE) {
    // Cookie parametreleri session_start'tan önce ayarlanmalı!
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    session_start();
}

// Eğer oturum açık değilse ve tarayıcıda remember_token varsa kullanıcıyı hatırla
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    require_once __DIR__ . '/../config/db.php';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_token = ?");
    $stmt->execute([$_COOKIE['remember_token']]);
    $user = $stmt->fetch();

    if ($user) {
        // Kullanıcı geçerli, oturumu başlat
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['fullname'] = $user['fullname'] ?? '';
    } else {
        // Token geçersizse çerezi sil
        setcookie('remember_token', '', time() - 3600, "/", "", false, true);
    }
}
