<?php
require './config/db.php';
require './lib/PHPMailer/PHPMailer.php';
require './lib/PHPMailer/SMTP.php';
require './lib/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$hata = '';
$ok = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $birthdate = $_POST['birthdate'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($fullname) < 3) {
        $hata = 'Lütfen geçerli bir isim girin.';
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthdate)) {
        $hata = 'Doğum tarihi YYYY-AA-GG formatında olmalı.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hata = 'Geçerli bir e-posta adresi girin.';
    } elseif (strlen($password) < 6) {
        $hata = 'Şifre en az 6 karakter olmalı.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $hata = 'Bu e-posta zaten kayıtlı.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $verification_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $stmt = $pdo->prepare("INSERT INTO users (fullname, birthdate, email, password, verification_code, is_verified) VALUES (?, ?, ?, ?, ?, 0)");
            $result = $stmt->execute([$fullname, $birthdate, $email, $hash, $verification_code]);

            if ($result) {
                $mail = new PHPMailer(true);
                try {
                    // Sunucu ayarları
                    $mail->isSMTP();
                    $mail->CharSet = 'utf-8';
                    $mail->Host = 'mail.makroport.com';  // Gmail kullanıyorsanız bu
                    $mail->SMTPAuth = true;
                    $mail->Username = 'cem@makroport.com'; // GÖNDEREN adres
                    $mail->Password = 'Cem130371%';       // Gmail'de uygulama şifresi gerekiyor
                    $mail->SMTPSecure = 'tls'; // TLS kullanımı
                    $mail->Port = 587;

                    // Alıcı ve içerik
                    $mail->setFrom('cem@makroport.com', 'MakroPort GameCity');
                    $mail->addAddress($email, $fullname);

                    $mail->isHTML(true);
                    $mail->Subject = 'E-posta Doğrulama Kodu';
                    $mail->Body    = "Merhaba $fullname,<br><br>Doğrulama kodunuz: <strong>$verification_code</strong><br><br>Lütfen bu kodu sisteme girerek hesabınızı onaylayın.";
                    $mail->SMTPOptions = [
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true,
                        ]
                    ];
                    $mail->send();
                    $ok = true;
                } catch (Exception $e) {
                    $hata = 'Mail gönderilemedi. Hata: ' . $mail->ErrorInfo;
                }
            }

        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol - MakroPort GameCity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card p-4 shadow-sm" style="width: 100%; max-width: 500px;">
    <h2 class="text-center mb-4">Kayıt Ol</h2>

    <?php if ($ok): ?>
        <div class="alert alert-success">Kayıt başarılı. Lütfen e-postanızı kontrol edip doğrulama yapın.</div>
        <div class="text-center">
            <a href="/login" class="btn btn-outline-primary mt-3">Giriş Sayfasına Git</a>
        </div>
    <?php else: ?>
        <?php if ($hata): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($hata) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="fullname" class="form-label">Ad Soyad</label>
                <input type="text" name="fullname" id="fullname" class="form-control"
                       required value="<?= htmlspecialchars($_POST['fullname'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="birthdate" class="form-label">Doğum Tarihi</label>
                <input type="date" name="birthdate" id="birthdate" class="form-control"
                       required value="<?= htmlspecialchars($_POST['birthdate'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" name="email" id="email" class="form-control"
                       required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Kayıt Ol</button>
            </div>
        </form>

        <p class="mt-3 text-center">
            Zaten hesabınız var mı? <a href="/login">Giriş yapın</a>
        </p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


