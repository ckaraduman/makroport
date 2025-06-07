<?php
$host = '65.181.111.172';
$db   = 'cemilker_gamecity';
$user = 'cemilker_cemilker';
$pass = 'z43T271RRe%';
$charset = 'latin5_turkish_ci';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Veritabanı bağlantı hatası: ' . $e->getMessage());
}