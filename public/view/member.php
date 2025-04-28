<?php
session_start(); // Oturumu başlat
$title = "MakroPort GameCity Üyelik Sayfası"; // Sayfa başlığını ayarla
$content = './public/view/member_content.php'; // İçerik dosyasının yolu
include './layout/temp.php'; // Şablon dosyasını dahil et
?>