<?php
/*
// Bu kısım sadece üye kontrolü yapılması gereken sayfaların başında bulunacaktır.
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    // Giriş yapmamışsa başka yere yönlendir
    header("Location: /login");
    exit;
}
?>
*/


include 'auth/session.php';
// $message="Bu sayfalar; kültür, sanat, eğlence ve bilim konularında yazı ve uygulamalar barındıracaktır. 
//         Mümkün olduğunca konular birbirinden ayrılmış ve bu durum kullanıcılar için belirtilmiştir. 
//         Bazen belgesel tadında bir yazı okuyacak, bazen kolleksiyonlarla ilgili dikkatinizi çekecek konulara giriş yapacak, bazen de bilimsel tartışmaların 
//         içinde bulacaksınız kendinizi. Ayrıca eğitim materyalleri ve dokümanları ile istediğiniz konularda bilgi sahibi olmanızı desteklemeye çalışacağız.";

$message="MakroPort, işletmenizdeki yazılım ihtiyaçlarına ve karşılaştığınız sorunlara etkili çözümler sunmak amacıyla kurulmuştur.
Güçlü marka iş birlikleri ve çözüm ortaklıklarımız sayesinde, mevcut sistemlerinizi değiştirmeden entegre çözümlerle iş süreçlerinizi daha verimli ve sürdürülebilir 
hale getiriyoruz. Farklı sektörlerde faaliyet gösteren, çeşitli ölçeklerdeki işletmelere özel çözümler geliştiriyoruz.
Ayrıca, ihtiyaçlarınıza özel olarak tasarlanmış yazılım uygulamalarıyla da işinize değer katıyoruz.";
?>
<div class="container">
<h2>MakroPort – Yeni Çözüm Ortağınız</h2>
<?php if (isset($_SESSION['user_id'])): ?>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['email']) ?></p>
<p style="text-align: justify;"><?php echo $message ?></p>
<img src="assets/img/team.png" alt="Takım Resmi" class="img-fluid mb-4" style="max-width: 100%; height: auto;">
<?php else: ?>
<p style="text-align: justify;"><?php echo $message ?></p>
<img src="assets/img/team.png" alt="Takım Resmi" class="img-fluid mb-4" style="max-width: 100%; height: auto;">
<?php endif; ?>
</div>