<?php
require './config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$hata = 'Mail adresiniz henüz doğrulanmamış, lütfen kayıt sırasında kullandığınız mail adresinizi kontrol ederek mail adresinizi ve MakroPort tarafından iletilen doğrulama kodunu girin.';
$ok = false;

$email_value = $_POST['email'] ?? ($_SESSION['verify_email'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $code = trim($_POST['code'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hata = 'Geçerli bir e-posta adresi girin.';
    } elseif (!preg_match('/^\d{6}$/', $code)) {
        $hata = 'Geçerli bir 6 haneli doğrulama kodu girin.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND verification_code = ? AND is_verified = 0");
        $stmt->execute([$email, $code]);
        $user = $stmt->fetch();

        if ($user) {
            $update = $pdo->prepare("UPDATE users SET is_verified = 1, verification_code = NULL WHERE id = ?");
            $update->execute([$user['id']]);
            $_SESSION['verify_email'] = $email;
            $_SESSION['remember_email'] = $email; // 🔄 Giriş ekranına taşıma
            $ok = true;
            if ($ok) {
            unset($_SESSION['verify_email']);
        }
            $hata = '';
        } else {
            $hata = 'Doğrulama kodu geçersiz veya hesap zaten doğrulanmış.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Doğrulama - MakroPort GameCity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card p-4 shadow-sm" style="width: 100%; max-width: 500px;">
    <h2 class="text-center mb-4">E-Posta Doğrulama</h2>

    <?php if ($ok): ?>
        <div class="alert alert-success">Hesabınız başarıyla doğrulandı. Giriş yapabilirsiniz.</div>
        <div class="text-center">
            <a href="/login" class="btn btn-outline-primary mt-3">Giriş Yap</a>
        </div>
    <?php else: ?>
        <?php if ($hata): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" name="email" id="email" class="form-control" required
                        value="<?= htmlspecialchars($email_value) ?>">
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Doğrulama Kodu</label>
                <input type="text" name="code" id="code" class="form-control" required maxlength="6">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Doğrula</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
