<?php

session_start(); // Oturumu başlat

// Veritabanı bağlantı bilgileri
$host = '65.181.111.172'; // Veritabanı sunucusu
$dbname = 'cemilker_gamecity'; // Veritabanı adı
$username = 'cemilker_cemilker'; // Veritabanı kullanıcı adı
$password = 'z43T271RRe%'; // Veritabanı şifresi

try {
    // PDO ile veritabanına bağlan
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Kullanıcı adı ve şifreyi POST ile al
    $email = $_POST['email'];
    $inputPassword = $_POST['password'];
    $rememberMe = isset($_POST['rememberMe']);

    // Kullanıcıyı veritabanından bul
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($inputPassword, $user['password'])) {
        // Kullanıcı bilgileri doğru, oturum başlat

        // "is_verified" alanını kontrol et
        if ($user['is_verified'] == 1) {
            // Hesap doğrulanmış, giriş başarılı
            $_SESSION['email'] = $email;
            echo "Başarıyla giriş yaptınız";

            // "Remember Me" seçeneği aktifse çerezleri ayarla
            if ($rememberMe) {
                // Kullanıcı bilgilerini hashleyip çerez olarak ayarla
                $userHash = hash('sha256', $email);
                setcookie('rememberMe', $userHash, time() + (30 * 24 * 60 * 60)); // 30 gün
                setcookie('email', $email, time() + (30 * 24 * 60 * 60)); // 30 gün
            }

            header("Location: secret");
            exit(); // Yönlendirme sonrası script'in çalışmaya devam etmemesi için exit ekledik.
        } else {
            // Hesap doğrulanmamış, "member_verify" sayfasına yönlendir
            echo "Hesabınız doğrulanmamış, lütfen doğrulama işlemini tamamlayın.";
            header("Location: /verify");
            exit(); // Yönlendirme sonrası script'in çalışmaya devam etmemesi için exit ekledik.
        }
    } else {
        echo "Kullanıcı adı ve/veya şifre hatalı, lütfen kontrol ediniz!";
    }

} catch (PDOException $e) {
    echo 'Veritabanı bağlantı hatası: ' . $e->getMessage();
}

?>

<br>
<a href="logout">Çıkış Yap</a>
<br>
<a href="secret">Korumalı Sayfa</a>
