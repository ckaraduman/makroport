<?php
// Oturum kontrol fonksiyonunu dahil et
include('./control/session_check.php');

// Oturumun açılıp açılmadığını kontrol et
check_session();

$title = "Palmet Digital - Rehber"; // Sayfa başlığını ayarla
$content = './public/view/directory_content.php'; // İçerik dosyasının yolu
include './layout/temp1.php'; // Şablon dosyasını dahil et
?>