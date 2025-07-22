<?php
include 'auth/session.php';
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$org_id = isset($_GET['organization_id']) ? intval($_GET['organization_id']) : 0;
$organization = null;
$error = '';
$success = '';

// 1. Kullanıcının bu organizasyona ait olup olmadığını kontrol et
$stmt = $conn->prepare("
    SELECT o.* 
    FROM organizations o
    JOIN user_organization uo ON uo.organization_id = o.organization_id
    WHERE uo.user_id = ? AND o.organization_id = ?
");
$stmt->bind_param("ii", $user_id, $org_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $error = "Bu organizasyonu düzenlemeye yetkiniz yok.".$org_id.$user_id;
} else {
    $organization = $result->fetch_assoc();

    // Eğer form gönderilmişse (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['organization_name']);
        $email = trim($_POST['kep_address']);
        $phone = trim($_POST['phone']);

        if ($name === '' || $email === '') {
            $error = 'Lütfen tüm gerekli alanları doldurun.';
        } else {
            // Güncelleme işlemi
            $update = $conn->prepare("UPDATE organizations SET organization_name = ?, kep_address = ?, phone = ? WHERE organization_id = ?");
            $update->bind_param("sssi", $name, $email, $phone, $org_id);
            if ($update->execute()) {
                $success = "Organizasyon bilgileri başarıyla güncellendi.";
                // Güncel bilgileri tekrar al
                $organization['organization_name'] = $name;
                $organization['kep_email'] = $email;
                $organization['phone'] = $phone;
            } else {
                $error = "Güncelleme başarısız: " . $update->error;
            }
            $update->close();
        }
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Organizasyon Düzenle</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Organizasyon Bilgilerini Düzenle</h2>
    <hr>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if ($organization): ?>
        <form method="POST">
            <div class="mb-3">
                <label for="organization_name" class="form-label">Organizasyon Adı</label>
                <input type="text" class="form-control" id="organization_name" name="organization_name"
                       value="<?= htmlspecialchars($organization['organization_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="kep_email" class="form-label">KEP E-posta</label>
                <input type="email" class="form-control" id="kep_address" name="kep_address"
                       value="<?= htmlspecialchars($organization['kep_address']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefon</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       value="<?= htmlspecialchars($organization['phone']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
            <a href="/makrodocs" class="btn btn-secondary">Geri Dön</a>
        </form>
    <?php endif; ?>
</div>
</body>
</html>

