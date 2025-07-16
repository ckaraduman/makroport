<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
?>

<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kurum Kayıt Ekranı</title>
    <style>
        /* body { font-family: Arial; margin: 40px; } */
        form { max-width: 700px; margin: auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input[type="text"], input[type="email"], textarea, select {
            width: 100%; padding: 8px; margin-top: 5px;
        }
        .checkbox-group {
            margin-top: 10px;
        }
        button {
            margin-top: 20px; padding: 10px 20px;
        }
        .checkbox-group {

}
    </style>
</head>
<body>

    <h2>Kurum / Kuruluş / Şirket / Firma Kayıt Ekranı</h2>

    <form method="post" action="organization_register_process.php" enctype="multipart/form-data">

        <label for="organization_name">Kurum / Kuruluş Adı *</label>
        <input type="text" name="organization_name" id="organization_name" required>

        <label for="tax_number">Vergi Numarası</label>
        <input type="text" name="tax_number" id="tax_number">

        <label for="trade_registry_number">Ticaret Kayıt Numarası</label>
        <input type="text" name="trade_registry_number" id="trade_registry_number">

        <label for="mersis_number">MERSIS Numarası</label>
        <input type="text" name="mersis_number" id="mersis_number">

        <label for="address">Adres</label>
        <textarea name="address" id="address" rows="3"></textarea>

        <label for="phone">Telefon</label>
        <input type="text" name="phone" id="phone">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="kep_address">KEP Adresi</label>
        <input type="email" name="kep_address" id="kep_address">

        <label for="website">Website</label>
        <input type="text" name="website" id="website">

        <label for="authorized_person">Yetkili Kişi</label>
        <input type="text" name="authorized_person" id="authorized_person">

        <label for="sector">Sektör</label>
        <input type="text" name="sector" id="sector">

        <label for="logo_url">Logo URL or Path</label>
        <input type="text" name="logo_url" id="logo_url">

        <div class="checkbox-group">
            <label><input type="checkbox" name="e_signature_enabled" id="e_signature_enabled" value="1" style="margin-right: 10px;">Elektronik İmza</label>
        </div>

        <div class="checkbox-group">
            <label><input type="checkbox" name="kvkk_accepted" id="kvkk_accepted" value="1" style="margin-right: 10px;">KVKK Onayı</label>
        </div>

        <label for="approval_flow">Onay Hiyerarşisi (JSON format)</label>
        <textarea name="approval_flow" id="approval_flow" rows="5" placeholder='[{"role": "Manager", "order": 1}, {"role": "Director", "order": 2}]'></textarea>

        <button type="submit">Kaydet</button>

    </form>

</body>
</html>