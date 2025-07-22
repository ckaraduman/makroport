<?php

include 'auth/session.php';
include 'config/db.php'; // PDO bağlantısı yapılmış varsayıyoruz

$message1 = "📄 Dijital Doküman Yönetim Sistemi
Fiziksel evrak yığınlarından kurtulun. Evrakları dijital olarak arşivleyin, yetkili kişilerle kolayca paylaşın. Versiyon takibi, arama kolaylığı ve erişim kontrolü sayesinde doküman yönetimi hiç bu kadar pratik olmamıştı.
Ayrıca tüm belge süreçlerinde hiyerarşik onay mekanizması ile kontrol ve denetim sağlarsınız.";

?>

<div class="container">
    <h2>MakroDocs – Dijital Doküman Yönetim Sistemi</h2>
    <hr>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>

        <?php
        $userId = $_SESSION['user_id'];
        $stmt = $pdo->prepare("
            SELECT o.organization_id, o.organization_name 
            FROM user_organization uo
            JOIN organizations o ON uo.organization_id = o.organization_id
            WHERE uo.user_id = ? AND uo.is_active = 1
        ");
        $stmt->execute([$userId]);
        $organizations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

    <?php if (count($organizations) > 0): ?>
            <div class="list-group mb-3">
                <?php foreach ($organizations as $org): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <?= htmlspecialchars($org['organization_name']) ?>
                        </div>
                        <div class="btn-group">
                            <a href="/org_edit?organization_id=<?= $org['organization_id'] ?>" class="btn btn-sm btn-outline-secondary">Düzenle</a>
                            <a href="/org_process?organization_id=<?= $org['organization_id'] ?>" class="btn btn-sm btn-primary">Seç</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Henüz bir organizasyona bağlı değilsiniz.</p>
        <?php endif; ?>

    <?php else: ?>
        <div class="row align-items-start">
            <!-- Sol taraf: Resim -->
            <div class="col-md-6">
                <img src="assets/img/MakroDocs.png" alt="Takım Resmi" class="img-fluid rounded shadow mb-3" style="max-width: 70%; height: auto;">
            </div>

            <!-- Sağ taraf: Metin ve butonlar -->
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


