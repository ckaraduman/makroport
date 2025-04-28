<?php
session_start(); // Oturumu başlat
$title = "MakroPort GameCity Hesap Doğrulama Sayfası"; // Sayfa başlığını ayarla
$content = './public/view/member_verify_content.php'; // İçerik dosyasının yolu
include './layout/temp.php'; // Şablon dosyasını dahil et
?>