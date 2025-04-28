<?php
session_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hesap Doğrulama</title>
</head>
<body>
    <h2>Hesap Doğrulama</h2>
    <form method="POST" action="">
        <label for="email">E-posta Adresi:</label><br>
        <input type="email" name="email" required><br><br>

        <label for="verification_code">Doğrulama Kodu:</label><br>
        <input type="text" name="verification_code" required><br><br>

        <input type="submit" value="Doğrula">
    </form>

    <?php
    // Veritabanı bağlantı bilgileri
    $host = '65.181.111.172'; 
    $dbname = 'cemilker_gamecity'; 
    $username = 'cemilker_cemilker'; 
    $password = 'z43T271RRe%';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Veritabanı bağlantısı başarısız: " . $e->getMessage());
    }

    // Form gönderildiğinde doğrulama işlemi yapılacak
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // E-posta ve doğrulama kodunu formdan al
        $email = $_POST['email'];
        $inputVerificationCode = $_POST['verification_code'];

        // Veritabanındaki doğrulama kodunu kontrol et
        $stmt = $pdo->prepare('SELECT verification_code, is_verified FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && !$user['is_verified'] && $user['verification_code'] === $inputVerificationCode) {
            // Kod doğru ve kullanıcı daha önce doğrulanmamışsa, doğrulama işlemini gerçekleştir
            $updateStmt = $pdo->prepare('UPDATE users SET is_verified = 1 WHERE email = :email');
            $updateStmt->bindParam(':email', $email);
            $updateStmt->execute();

            echo "<p>E-posta başarıyla doğrulandı!</p>";
        } else {
            echo "<p>Doğrulama kodu geçersiz veya hesap zaten doğrulanmış. Lütfen tekrar deneyin.</p>";
        }
    }
    ?>
</body>
</html>


