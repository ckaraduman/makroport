<?php
// Hataları görmek için geliştirme aşamasında aktif (yayında kapatılmalı)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include './auth/session.php';
include './config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$org_id = isset($_GET['organization_id']) ? intval($_GET['organization_id']) : 0;
$organization = null;
$error = '';

// Organizasyona erişim yetkisi kontrolü
$stmt = $conn->prepare("
    SELECT o.organization_id, o.organization_name, o.kep_address, o.phone 
    FROM organizations o
    JOIN user_organization uo ON uo.organization_id = o.organization_id
    WHERE uo.user_id = ? AND o.organization_id = ?
");
$stmt->bind_param("ii", $user_id, $org_id);
$stmt->execute();
$stmt->bind_result($id, $name, $kep, $phone);

if ($stmt->fetch()) {
    $organization = [
        'organization_id' => $id,
        'organization_name' => $name,
        'kep_address' => $kep,
        'phone' => $phone
    ];
} else {
    $error = "Bu organizasyona erişim yetkiniz yok veya organizasyon bulunamadı.";
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Organizasyon Detayı</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Organizasyon Detayı</h2>
    <hr>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($organization): ?>
        <ul class="list-group">
            <li class="list-group-item"><strong>Ad:</strong> <?= htmlspecialchars($organization['organization_name']) ?></li>
            <li class="list-group-item"><strong>KEP Adresi:</strong> <?= htmlspecialchars($organization['kep_address']) ?></li>
            <li class="list-group-item"><strong>Telefon:</strong> <?= htmlspecialchars($organization['phone']) ?></li>
        </ul>
        <a href="/makrodocs" class="btn btn-secondary mt-3">Geri Dön</a>
    <?php endif; ?>
</div>
</body>
</html>

