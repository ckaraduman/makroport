<?php

include 'auth/session.php';
require_once __DIR__ . '/../config/db.php';

$stmt = $pdo->query("SELECT * FROM quotes ORDER BY created_at DESC");
$quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Alıntılar</title>
    <style>
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .quote-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 20px;
        }

        .quote-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .quote-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .quote-meta {
            font-size: 13px;
            color: #666;
            margin-bottom: 12px;
        }

        .quote-excerpt {
            font-style: italic;
            color: #444;
            margin-bottom: 10px;
        }

        .quote-footer {
            text-align: right;
            margin-top: auto;
        }

        .quote-footer a {
            text-decoration: none;
            color: #007bff;
        }

        .no-quotes {
            text-align: center;
            padding: 40px;
            background: #fff3cd;
            border-radius: 8px;
            color: #856404;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h2>📚 Alıntılar</h2>
        <a href="/add">➕ Yeni Alıntı Ekle</a>
    </div>

    <?php if (count($quotes) > 0): ?>
        <div class="quote-grid">
            <?php foreach ($quotes as $quote): ?>
                <div class="quote-card">
                    <div class="quote-title"><?= htmlspecialchars($quote['title']) ?></div>
                    <div class="quote-meta">
                        <?= htmlspecialchars($quote['author']) ?> | <?= htmlspecialchars($quote['source']) ?> |
                        <?= date("d.m.Y", strtotime($quote['created_at'])) ?>
                    </div>
                    <?php if (!empty($quote['excerpt'])): ?>
                        <div class="quote-excerpt">"<?= htmlspecialchars(mb_strimwidth($quote['excerpt'], 0, 120, '...')) ?>"</div>
                    <?php endif; ?>
                    <div class="quote-footer">
                        <a href="/view-quote?id=<?= $quote['id'] ?>">Detay →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-quotes">Henüz hiç alıntı eklenmemiş.</div>
    <?php endif; ?>

</div>

</body>
</html>

