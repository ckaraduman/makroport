<?php
session_start(); // Oturumu başlat
$title = "MakroPort Index Page"; // Sayfa başlığını ayarla
$content = './public/view/IndexContent.php'; // İçerik dosyasının yolu
include './layout/temp.php'; // Şablon dosyasını dahil et
?>