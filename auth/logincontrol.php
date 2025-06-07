<?php
session_start();
require_once __DIR__ . '/../config/db.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    header('Location: /login?error=Eksik bilgi');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

    // Beni hatırla seçildiyse cookie ayarla
    if (!empty($_POST['remember'])) {
        // Güvenlik için sadece email saklıyoruz. Süre: 30 gün
        setcookie('remember_email', $email, time() + (86400 * 30), "/", "", false, true);
    } else {
        // Eğer checkbox işaretli değilse, daha önceki cookie'yi sil
        if (isset($_COOKIE['remember_email'])) {
            setcookie('remember_email', '', time() - 3600, "/", "", false, true);
        }
    }

    header("Location: /");
    exit;
} else {
    header('Location: /login?error=Hatalı giriş');
    exit;
}
