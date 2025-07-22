<?php
$secrets = require_once __DIR__ . '/../config/secrets.php';

$host = $secrets['db_host'];
$name = $secrets['db_name'];
$user = $secrets['db_user'];
$pass = $secrets['db_pass'];
$charset = $secrets['db_charset'];

$dsn = "mysql:host=$host;dbname=$name;charset=$charset";
$conn = new mysqli($host, $user, $pass, $name);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Veritabanı bağlantı hatası: ' . $e->getMessage());
}