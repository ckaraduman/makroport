<?php

include 'auth/session.php';

$message1="📄 Dijital Doküman Yönetim Sistemi
Fiziksel evrak yığınlarından kurtulun. Evrakları dijital olarak arşivleyin, yetkili kişilerle kolayca paylaşın. Versiyon takibi, arama kolaylığı ve erişim kontrolü sayesinde doküman yönetimi hiç bu kadar pratik olmamıştı.
Ayrıca tüm belge süreçlerinde hiyerarşik onay mekanizması ile kontrol ve denetim sağlarsınız.";

?>

<div class="container">
    <h2>MakroDocs – Dijital Doküman Yönetim Sistemi</h2>
    <hr>
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>
        <button type="button" class="btn btn-primary">MakroDocs</button>
    <?php else: ?>
        <div class="row align-items-start">
            <!-- Sol taraf: Metin -->
            <div class="col-md-6">
                <img src="assets/img/MakroDocs.png" alt="Takım Resmi" class="img-fluid rounded shadow mb-3" style="max-width: 70%; height: auto;">
            </div>

            <!-- Sağ taraf: Resim ve butonlar alt alta -->
            <div class="col-md-6 text-center">
                <p style="text-align: justify;"><?php echo nl2br($message1); ?></p>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a class="btn btn-primary mb-2" href="/login" role="button">Giriş Yap</a>
                    <a class="btn btn-secondary" href="/register" role="button">Kayıt Ol</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
