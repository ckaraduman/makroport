<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    header('Location: /login?error=' . urlencode('Lütfen tüm alanları doldurunuz.'));
    exit;
}

// Kullanıcı e-posta ile sorgulanıyor
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    // Oturum üzerinden HTML mesaj gönderiyoruz
    $_SESSION['error'] = 'Bu e-posta adresi ile bir kayıt bulunamadı. Yeni bir hesap oluşturmak için <a href="/register">buraya tıklayın</a>.';
    header('Location: /login');
    exit;
}

// Diğer hata durumları
if (!password_verify($password, $user['password'])) {
    $_SESSION['error'] = 'Şifre hatalı. Lütfen bilgilerinizi kontrol ediniz.';
    header('Location: /login');
    exit;
}

// E-posta doğrulaması yapılmış mı kontrol ediliyor
if ((int)$user['is_verified'] !== 1) {
    header('Location: /verify');
    exit;
}

// Oturum bilgileri ayarlanıyor
$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['fullname'] = $user['fullname'] ?? '';


// "Beni hatırla" seçeneği
if (isset($_POST['remember']) && $_POST['remember'] === '1') {
    $token = bin2hex(random_bytes(32));
    setcookie('remember_token', $token, time() + (86400 * 30), "/", "", false, true);
    $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
    $stmt->execute([$token, $user['id']]);
} else {
    // Cookie varsa hem sil hem de veritabanından temizle
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, "/", "", false, true);
    }
    $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
    $stmt->execute([$user['id']]);
        setcookie(session_name(), session_id(), [
        'expires' => 0,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}

// Anasayfaya yönlendir
header("Location: /");
exit;

// Token hem tarayıcıdan hem veritabanından silinsin

