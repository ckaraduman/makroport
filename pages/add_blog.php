<?php

// Kullanıcı girişi kontrolü
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}

if ($_SESSION['email'] != 'makroport@gmail.com') {
    echo "Erişim reddedildi! Sadece yetkili kullanıcılar bu sayfaya erişebilir.";
    exit; // Scripti durdur ve erişimi kes.
}

require_once __DIR__ . '/../config/db.php';

// Form gönderildiyse veriyi al ve kaydet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $excerpt = trim($_POST['excerpt']);
    $status = $_POST['status'] ?? 'published';

    // Basit doğrulama
    if (empty($content)) {
        $error = "Makale içeriği boş bırakılamaz.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO articles (title, content, excerpt, status) 
                               VALUES (:title, :content, :excerpt, :status)");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':excerpt' => $excerpt,
            ':status' => $status
        ]);

        $success = "Makale başarıyla eklendi.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Makale Ekle</title>
    <style>
        form {
            max-width: 800px;
            margin: 20px auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 16px;
        }
        label { font-weight: bold; }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

<?php if (!empty($error)): ?>
    <div class="alert error"><?= htmlspecialchars($error) ?></div>
<?php elseif (!empty($success)): ?>
    <div class="alert success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<form method="POST">
    <h2>Yeni Makale Ekle</h2>

    <label for="title">Başlık</label>
    <input type="text" name="title" id="title" placeholder="Yazının başlığı" />

    <label for="content">Yazı Metni *</label>
    <textarea name="content" id="content" rows="6" required></textarea>

    <label for="excerpt">Kısa Özet</label>
    <textarea name="excerpt" id="excerpt" rows="3"></textarea>

    <label for="status">Durum</label>
    <select name="status" id="status">
        <option value="published">Yayımla</option>
        <option value="draft">Taslak</option>
    </select>

    <button type="submit">Yazı Kaydet</button>
</form>

</body>
</html>
