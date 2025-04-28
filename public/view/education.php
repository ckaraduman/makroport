<?php
// Oturum kontrol fonksiyonunu dahil et
include('./control/session_check.php');

// Oturumun açılıp açılmadığını kontrol et
check_session();

$title = "Palmet Digital - Eğitim"; // Sayfa başlığını ayarla
$content = './public/view/education_content.php'; // İçerik dosyasının yolu
include './layout/temp1.php'; // Şablon dosyasını dahil et
?>