<?php

include 'auth/session.php';
require_once __DIR__ . '/../config/db.php';

// Alıntıları çek
$stmt = $pdo->query("SELECT * FROM quotes ORDER BY created_at DESC");
$quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Alıntı Listesi</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            padding: 30px;
        } */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th {
            background-color: #f3f3f3;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .actions a {
            margin-right: 8px;
            text-decoration: none;
            color: #007bff;
        }
        .excerpt {
            color: #444;
            font-style: italic;
        }
    </style>
</head>
<body>

<h2>Alıntılar</h2>
<p><a href="/add">➕ Yeni Alıntı Ekle</a></p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Başlık</th>
            <th>Yazar</th>
            <th>Kaynak</th>
            <th>Kısa Özet</th>
            <th>Durum</th>
            <th>Eklenme Tarihi</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($quotes) > 0): ?>
        <?php foreach ($quotes as $quote): ?>
            <tr>
                <td><?= $quote['id'] ?></td>
                <td><?= htmlspecialchars($quote['title']) ?></td>
                <td><?= htmlspecialchars($quote['author']) ?></td>
                <td><?= htmlspecialchars($quote['source']) ?></td>
                <td class="excerpt"><?= htmlspecialchars(mb_strimwidth($quote['excerpt'], 0, 50, "...")) ?></td>
                <td><?= htmlspecialchars($quote['status']) ?></td>
                <td><?= date("d.m.Y H:i", strtotime($quote['created_at'])) ?></td>
                <td class="actions">
                    <!-- Daha sonra aktif edeceğiz -->
                    <!-- <a href="edit-quote.php?id=<?= $quote['id'] ?>">Düzenle</a> -->
                    <!-- <a href="delete-quote.php?id=<?= $quote['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a> -->
                    <a href="/view-quote?id=<?= $quote['id'] ?>">Görüntüle</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">Henüz hiç alıntı eklenmemiş.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
