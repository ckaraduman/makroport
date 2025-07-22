<?php
include './auth/session.php'; // Giriş kontrolü
include './config/db.php';    // Veritabanı bağlantısı

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Form verilerini al
    $name = trim($_POST['organization_name']);
    $taxNumber = trim($_POST['tax_number']);
    $tradeRegistry = trim($_POST['trade_registry_number']);
    $mersis = trim($_POST['mersis_number']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $kep = trim($_POST['kep_address']);
    $website = trim($_POST['website']);
    $authorizedPerson = trim($_POST['authorized_person']);
    $sector = trim($_POST['sector']);
    $logoUrl = trim($_POST['logo_url']);
    $eSignature = isset($_POST['e_signature_enabled']) ? 1 : 0;
    $kvkk = isset($_POST['kvkk_accepted']) ? 1 : 0;
    $approvalFlow = json_encode($_POST['approval_flow'], JSON_UNESCAPED_UNICODE); // JSON olarak saklanıyor

    // Hazırlanmış SQL sorgusu
    $stmt = $conn->prepare("
        INSERT INTO organizations (
            organization_name, tax_number, trade_registry_number, mersis_number,
            address, phone, email, kep_address, website,
            authorized_person, sector, logo_url,
            e_signature_enabled, kvkk_accepted, approval_flow
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssssssssssss",
        $name, $taxNumber, $tradeRegistry, $mersis,
        $address, $phone, $email, $kep, $website,
        $authorizedPerson, $sector, $logoUrl,
        $eSignature, $kvkk, $approvalFlow
    );

    if ($stmt->execute()) {
        $organizationId = $stmt->insert_id; // Yeni eklenen organizasyonun ID'si
        $userId = $_SESSION['user_id'];     // Oturumdaki kullanıcı ID'si

        // Şimdi user_organization (kullanici_kurum) tablosuna ekleyelim
        $stmt2 = $conn->prepare("
            INSERT INTO user_organization (
                user_id, organization_id, is_authorized, is_active, approval_order
            ) VALUES (?, ?, 1, 1, 1)
        ");
        $stmt2->bind_param("ii", $userId, $organizationId);

        if ($stmt2->execute()) {
            echo "Kayıt başarıyla eklendi ve kullanıcı ilişkilendirildi.";
            // Yönlendirme yapılabilir: header("Location: organization_list.php");
        } else {
            echo "Organizasyon eklendi ama kullanıcı ilişkisi eklenemedi: " . $stmt2->error;
        }

        $stmt2->close();

    } else {
        echo "Hata: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>
