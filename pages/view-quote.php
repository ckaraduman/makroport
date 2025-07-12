<?php
include 'auth/session.php';
require_once __DIR__ . '/../config/db.php';

// GET ile gelen id varsa al
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Geçersiz alıntı ID");
}

$id = (int) $_GET['id'];

// Alıntıyı veritabanından çek
$stmt = $pdo->prepare("SELECT * FROM quotes WHERE id = :id");
$stmt->execute([':id' => $id]);
$quote = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quote) {
    die("Alıntı bulunamadı.");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($quote['title'] ?? 'Alıntı Detayı') ?></title>
    <style>
        .container {
            max-width: 800px;
            margin: 30px auto;
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
        }
        h2 {
            margin-top: 0;
        }
        .meta {
            color: #555;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .content {
            text-align: justify;
            font-size: 16px;
            line-height: 1.7;
        }
        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        .two-column {
            column-count: 2;
            column-gap: 40px;
            column-rule: 1px solid #ddd;
            text-align: justify;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><?= htmlspecialchars($quote['title']) ?></h2>

    <div class="meta">
        <strong>Yazar:</strong> <?= htmlspecialchars($quote['author']) ?><br>
        <strong>Kaynak:</strong> <?= htmlspecialchars($quote['source']) ?><br>
        <strong>Eklenme Tarihi:</strong> <?= date("d.m.Y H:i", strtotime($quote['created_at'])) ?><br>
        <strong>Durum:</strong> <?= htmlspecialchars($quote['status']) ?>
    </div>

    <?php if (!empty($quote['excerpt'])): ?>
        <blockquote><em><?= htmlspecialchars($quote['excerpt']) ?></em></blockquote>
    <?php endif; ?>

    <div class="content two-column">
        <?= nl2br(htmlspecialchars($quote['content'])) ?>
    </div>

    <a href="/list-quotes" class="back">← Tüm Alıntılara Dön</a>
</div>

</body>
</html>