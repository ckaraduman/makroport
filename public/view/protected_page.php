<?php
// Oturum kontrol fonksiyonunu dahil et
include('./control/session_check.php');

// Oturumun açılıp açılmadığını kontrol et
check_session();

$title = "Palmet Digital Protect Page"; // Sayfa başlığını ayarla
$content = './public/view/protected_page_content.php'; // İçerik dosyasının yolu
include './layout/temp_boot.php'; // Şablon dosyasını dahil et
?>

