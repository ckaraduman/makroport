<?php

include 'auth/session.php';

$message1="📄 Dijital Doküman Yönetim Sistemi
Fiziksel evrak yığınlarından kurtulun. Evrakları dijital olarak arşivleyin, yetkili kişilerle kolayca paylaşın. Versiyon takibi, arama kolaylığı ve erişim kontrolü sayesinde doküman yönetimi hiç bu kadar pratik olmamıştı.
Ayrıca tüm belge süreçlerinde hiyerarşik onay mekanizması ile kontrol ve denetim sağlarsınız.";

?>
<div class="container">
<h2>MakroPort – Yeni Çözüm Ortağınız</h2>
<hr>
<?php if (isset($_SESSION['user_id'])): ?>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['email']) ?></p>
    <button type="button" class="btn btn-primary">MakroDocs</button>
<?php else: ?>
    <div class="row align-items-start">
        <div class="col-md-6">
            <p style="text-align: justify;"><?php echo nl2br($message1); ?></p>
        <div class="col-md-6">
            <img src="assets/img/MakroDocs.png" alt="Takım Resmi" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
        </div>
    </div>
<?php endif; ?>
</div>