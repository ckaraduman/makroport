<?php
require './config/db.php';
require './lib/PHPMailer/PHPMailer.php';
require './lib/PHPMailer/SMTP.php';
require './lib/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // PHPMailer'ı Composer ile yüklediğinizi varsayıyorum

// include 'auth/session.php';
// include 'config/secrets.php'; // Mail ayarlarının olduğu dosya

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Basit bir validasyon
    if (!empty($name) && !empty($email) && !empty($message)) {
        $mail = new PHPMailer(true);
        try {
            // Mail sunucu ayarları
            $mail->isSMTP();
            $mail->CharSet    = $secrets['mail_charset'];
            $mail->Host       = $secrets['mail_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $secrets['mail_username'];
            $mail->Password   = $secrets['mail_password'];
            $mail->SMTPSecure = $secrets['mail_smtp_secure'];
            $mail->Port       = $secrets['mail_port'];
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ]
            ];

            // Mail gönderici ve alıcı bilgisi
            $mail->setFrom($secrets['mail_username'], 'İletişim Formu');
            $mail->addAddress('cemilkerkaraduman@gmail.com', 'Cem İlker Karaduman'); // Sizin mail adresiniz

            // HTML içerik
            $mail->isHTML(true);
            $mail->Subject = 'Yeni İletişim Formu Mesajı';
            $mail->Body    = "
                <h3>Yeni Mesaj</h3>
                <p><strong>Adı:</strong> $name</p>
                <p><strong>E-posta:</strong> $email</p>
                <p><strong>Mesaj:</strong><br>" . nl2br($message) . "</p>
            ";

            $mail->send();

            // Başarı mesajı
            header("Location: /contact?success=1");
            exit;
        } catch (Exception $e) {
            echo "Mesaj gönderilemedi. Hata: {$mail->ErrorInfo}";
        }
    } else {
        echo "Lütfen tüm alanları doldurun.";
    }
} else {
    header("Location: /contact");
    exit;
}
