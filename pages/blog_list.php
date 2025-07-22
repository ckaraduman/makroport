<?php

include 'auth/session.php';
require_once __DIR__ . '/../config/db.php';

// Alıntıları çek
$stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Makale Listesi</title>
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

<h2>Yazılar</h2>
<?php
    if ($_SESSION['email'] == 'makroport@gmail.com') {
        echo '<p><a href="/add_blog">➕ Yeni Yazı Ekle</a></p>';
    }
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Başlık</th>
            <th>Kısa Özet</th>
            <th>Durum</th>
            <th>Eklenme Tarihi</th>
            <th>İşlemler</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($articles) > 0): ?>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $article['id'] ?></td>
                <td><?= htmlspecialchars($article['title']) ?></td>
                <td class="excerpt"><?= htmlspecialchars(mb_strimwidth($article['excerpt'], 0, 50, "...")) ?></td>
                <td><?= htmlspecialchars($article['status']) ?></td>
                <td><?= date("d.m.Y H:i", strtotime($article['created_at'])) ?></td>
                <td class="actions">
                    <!-- Daha sonra aktif edeceğiz -->
                    <!-- <a href="edit-quote.php?id=<?= $article['id'] ?>">Düzenle</a> -->
                    <!-- <a href="delete-quote.php?id=<?= $article['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a> -->
                    <a href="/blog_view?id=<?= $article['id'] ?>">Görüntüle</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">Henüz hiç yazı yayımlanmamış.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
