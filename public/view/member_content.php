<?php
require './public/library/PHPMailer/src/PHPMailer.php';
require './public/library/PHPMailer/src/Exception.php';
require './public/library/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// session_start();

// Veritabanı bağlantı bilgileri
$host = '65.181.111.172'; // Veritabanı sunucusu
$dbname = 'cemilker_gamecity'; // Veritabanı adı
$username = 'cemilker_cemilker'; // Veritabanı kullanıcı adı
$password = 'z43T271RRe%'; // Veritabanı şifresi

try {
    // Veritabanına bağlan
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Formdan gelen veriler
        $email = $_POST['email'];
        $fullname = $_POST['fullName'];
        $birthdate = $_POST['birthDate'];
        $inputPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Şifreyi hashleyelim
        $verificationCode = rand(100000, 999999); // 6 haneli doğrulama kodu üret



        // Yeni kullanıcıyı veritabanına ekle
        $stmt = $pdo->prepare('INSERT INTO users (email, password, fullname, birthdate, verification_code, is_verified) VALUES (:email, :password, :fullname, :birthdate, :verification_code, 0)');
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $inputPassword);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':verification_code', $verificationCode);
        $stmt->execute();



        // Doğrulama kodunu e-posta ile gönder
        $subject = "Üyelik Doğrulama Kodu";
        $message = "Merhaba, MakroPort GameCity'e hoş geldiniz! Doğrulama kodunuz: " . $verificationCode;

        // E-posta gönderme işlemi için PHPMailer sınıfını başlatın
        $mail = new PHPMailer(true);

try {
    // Sunucu ayarları
    $mail->isSMTP();
    $mail->CharSet = 'utf-8';
    $mail->Host = 'mail.makroport.com'; // SMTP sunucusunu belirleyin
    $mail->SMTPAuth = true;
    $mail->Username = 'cem@makroport.com'; // Gönderici e-posta adresi
    $mail->Password = 'Cem130371%'; // Gönderici e-posta şifresi veya uygulama şifresi
    $mail->SMTPSecure = 'tls'; // Güvenlik protokolü (Gmail için genellikle TLS kullanılır)
    $mail->Port = 587; // SMTP portu (Gmail için 587)

    // Gönderen ve alıcı bilgileri
    $mail->setFrom('cem@makroport.com', 'MakroPort GameCity'); // Gönderen e-posta ve isim
    $mail->addAddress($email); // Alıcı e-posta ve isim

    // İçerik
    $mail->isHTML(true); // HTML formatında gönderim
    $mail->Subject = $subject; // E-posta konusu
    $mail->Body = $message; // E-posta içeriği

    $mail->send();

    echo 'E-posta başarıyla gönderildi';
    header("Location: /verify");

} catch (Exception $e) {
    echo 'E-posta gönderilemedi. Hata: ', $mail->ErrorInfo;
}
    }
} catch (PDOException $e) {
    echo 'Veritabanı bağlantı hatası: ' . $e->getMessage();
}

?>