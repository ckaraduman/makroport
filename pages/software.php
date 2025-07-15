<?php

include 'auth/session.php';

$message="İşinize Güç Katacak Akıllı Yazılım Çözümleri
MakroPort olarak işletmenizin dijital dönüşüm yolculuğuna değer katan, sade ama güçlü çözümler sunuyoruz. Amacımız; halihazırda kullandığınız sistemleri bozmadan, iş süreçlerinize entegre edilebilecek esnek, hızlı ve uygun maliyetli yazılım çözümleri üretmek.

İş ortaklarımızla kurduğumuz güçlü bağlar ve sektör deneyimimiz sayesinde, her ölçekten işletmeye özel çözümler geliştiriyoruz. Sadece bir yazılım üreticisi değil; ihtiyaçlarınızı anlayan ve size en uygun çözüm yolunu sunan bir çözüm ortağı olarak hareket ediyoruz.

Öne Çıkan Hizmetlerimiz:
✅ Mevcut Sistemlerle Sorunsuz Entegrasyon
Kullandığınız uygulamaları değiştirmek zorunda değilsiniz. MakroPort yazılımları, mevcut sisteminize zarar vermeden çalışır; verilerinizi korur ve süreçlerinizi kesintiye uğratmaz.

✅ Web Servis & API Entegrasyonları
İster iç sistemleriniz arasında veri akışı sağlayın, ister dış dünyaya açılın... Geliştirdiğimiz RESTful servisler sayesinde farklı sistemler, uygulamalar ve veri kaynakları arasında güvenli ve verimli iletişim kurabilirsiniz.

✅ Finans Kurumları ile Uyumlu Entegrasyonlar
Banka sistemleri, ödeme servisleri, e-fatura/e-defter platformları gibi finansal yapılarla entegre çalışan çözümler geliştiriyoruz. Böylece ödeme, mutabakat ve raporlama işlemleri tek tıkla gerçekleşiyor.

✅ Kamu Kurumları ile Dijital Uyum
GİB, SGK, e-Devlet, EPDK gibi kurumlarla iletişim sağlayan sistemlerle uyumlu entegrasyonlarımız sayesinde resmi süreçler otomatikleştiriliyor, hata payı azalıyor, zaman kazanıyorsunuz.

✅ Hızlı Uygulama Geliştirme ve Devreye Alma
Projelerinizi aylarca beklemeyin. Modüler mimarimiz ve tecrübeli ekibimizle, projeleri çok daha hızlı devreye alıyor; sizi iş gücü ve zaman maliyetinden kurtarıyoruz.

Neden MakroPort?
Çünkü biz sadece yazılım yapmıyoruz.
👉 İş süreçlerini analiz ediyor, size özel çözümler geliştiriyor ve bunları sürdürülebilir şekilde hayata geçiriyoruz.

İşletmenizin dijitalleşme sürecine değer katmak ve rekabet avantajı sağlamak istiyorsanız, gelin birlikte çalışalım.
MakroPort: Yazılımda Basitlik, Entegrasyonda Güç.";

?>
<div class="container">
<?php if (isset($_SESSION['user_id'])): ?>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>
<div class="row align-items-start">
    <div class="col-md-6">
        <img src="assets/img/partner.png" alt="Takım Resmi" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
    </div>
    <div class="col-md-6">
        <p style="text-align: justify;"><?php echo nl2br($message); ?></p>
    </div>
</div>

<?php else: ?>
    <div class="row align-items-start">
        <div class="col-md-6">
            <img src="assets/img/partner.png" alt="Takım Resmi" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-md-6">
            <p style="text-align: justify;"><?php echo nl2br($message); ?></p>
        </div>
    </div>
<?php endif; ?>
</div>