<?php
include 'auth/session.php';

$about = "MakroPort, işletmelerin dijitalleşme yolculuklarına rehberlik etmek üzere kurulmuş bir yazılım çözüm ortağıdır.
Kültür, sanat, bilim ve eğlence alanlarındaki içerik ve uygulamalarla başlayan yolculuğunu, artık yazılım geliştirme, entegrasyon ve teknoloji danışmanlığı hizmetleriyle sürdürüyor. \n
Platformun kurucusu Cem İlker Karaduman, yaklaşık 17 yıl boyunca kamu hizmeti veren özel sektör kuruluşlarında üst düzey yöneticilik yapmıştır.
2025 yılı itibarıyla hem kendi girişimcilik projelerine odaklanmakta hem de çeşitli özel yazılım ve hizmet sektöründeki firmalara danışmanlık sunmaktadır.\n
MakroPort, bugünün dijital ihtiyaçlarına cevap verirken; yalın, ölçeklenebilir ve sektöre özel çözümleriyle fark yaratmayı hedeflemektedir.";

$vision = "Entegre teknoloji çözümleri ile işletmeleri dijital dönüşümün geleceğine taşımak.
MakroPort olarak hedefimiz, teknoloji entegrasyonunun sadece bir süreç değil, yeni iş modelleri ve rekabet avantajı yaratan bir kültür haline geldiği bir gelecek kurmaktır.";

$mission = "İşletmelerin mevcut sistemlerini koruyarak, yalın ve ölçeklenebilir yazılım çözümleriyle verimliliklerini artırmak.
Kültür, sanat, bilim ve eğlence gibi farklı içerik alanlarındaki deneyimimizi, profesyonel yazılım danışmanlığı ve uygulama geliştirme ile birleştirmek.
Kişiye özel, sürdürülebilir teknoloji projeleriyle müşterilerimizin dijital yolculuklarını uygun maliyetle ve etkin bir şekilde desteklemek.";
?>
<div class="container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>
    <?php endif; ?>

    <h2>Hakkımızda</h2>
    <p style="text-align: justify;"><?php echo nl2br($about); ?></p>
    <img src="assets/img/team1.jpeg" alt="MakroPort teknoloji işbirliği" style="max-width:100%; border-radius: 8px; margin: 20px 0;">


    <h2>Vizyonumuz</h2>
    <p style="text-align: justify;"><?php echo nl2br($vision); ?></p>

    <h2>Misyonumuz</h2>
    <p style="text-align: justify;"><?php echo nl2br($mission); ?></p>
</div>

<style>
    .container p {
    line-height: 1.8;
    margin-bottom: 1em;
}
</style>
