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

$message1="MakroPort, işletmenizdeki yazılım ihtiyaçlarına ve karşılaştığınız sorunlara etkili çözümler sunmak amacıyla kurulmuştur.
Güçlü marka iş birlikleri ve çözüm ortaklıklarımız sayesinde, mevcut sistemlerinizi değiştirmeden entegre çözümlerle iş süreçlerinizi daha verimli ve sürdürülebilir 
hale getiriyoruz. Farklı sektörlerde faaliyet gösteren, çeşitli ölçeklerdeki işletmelere özel çözümler geliştiriyoruz.
Ayrıca, ihtiyaçlarınıza özel olarak tasarlanmış yazılım uygulamalarıyla da işinize değer katıyoruz.";

$message2="MakroPort Bulut Çözümleri, iş süreçlerinizi hızlandırmak, verimliliği artırmak ve operasyonel yükleri minimuma indirmek üzere tasarlanmıştır. Geliştirdiğimiz bulut tabanlı sistemler sayesinde, şirketinizin ihtiyaç duyduğu pek çok temel fonksiyona kolayca ulaşabilir, lokasyon bağımsız çalışabilir, verilerinize güvenle erişebilirsiniz.

İşte iş yaşamınızı kolaylaştıran bazı özel çözümlerimiz:

📄 Dijital Doküman Yönetim Sistemi
Fiziksel evrak yığınlarından kurtulun. Evrakları dijital olarak arşivleyin, yetkili kişilerle kolayca paylaşın. Versiyon takibi, arama kolaylığı ve erişim kontrolü sayesinde doküman yönetimi hiç bu kadar pratik olmamıştı.
Ayrıca tüm belge süreçlerinde hiyerarşik onay mekanizması ile kontrol ve denetim sağlarsınız.

💸 Masraf Takip ve Onay Sistemi
Personel harcamaları, seyahat giderleri ya da günlük operasyonel masraflar... Tüm masraflarınızı sistematik bir şekilde takip edebilir, yönetici onay süreçlerini dijital ortamda tamamlayabilirsiniz.
Çok kademeli onay yapısı ile her adım güvenli ve izlenebilir hale gelir.

🔐 Teminat Takip ve Değerleme Sistemi
Şirketinizin aldığı ve verdiği teminatları; süresi, türü ve değeri ile birlikte izleyebilir, değerleme analizlerini zamanında yapabilirsiniz.
Her teminat hareketi için yetki bazlı işlem kontrolleri ve onay akışlarıyla risk yönetimi güçlenir.

🧾 E-Fatura ve E-Arşiv Takip Sistemleri
Tüm e-fatura ve e-arşiv süreçlerinizi merkezi bir panelden izleyin. Otomatik veri senkronizasyonu, zaman damgası, durum takibi ve geçmişe dönük erişim ile muhasebe süreçleriniz artık çok daha düzenli ve şeffaf.
Fatura oluşturma, gönderim ve iptal süreçlerinin tamamı tanımlı onay akışları ile güvence altına alınır.

📊 Raporlama ve Onay Sistemleri
Sahadan, ofisten ya da mobil cihazlardan gelen tüm verileri anlık olarak toplayın, dinamik raporlarla analiz edin.
Hazırlanan raporların paylaşımı ve karar süreçlerine aktarımı da onay yapıları ile kontrollü biçimde yürütülür.

✉️ E-Posta ve SMS Bildirim Sistemleri
Kritik süreçleri anlık olarak haber verin. Fatura kesildiğinde, onay verildiğinde ya da teminat süresi dolmak üzereyken; sistemimiz otomatik olarak ilgili kişilere bilgilendirme yapar.
Bildirimlerin içeriği ve tetikleme koşulları, sistemde tanımlı onay noktalarına göre yönetilir.";
?>
<div class="container">
<h2>MakroPort – Yeni Çözüm Ortağınız</h2>
<hr>
<?php if (isset($_SESSION['user_id'])): ?>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>
    <div class="row align-items-start">
        <div class="col-md-6">
            <p style="text-align: justify;"><?php echo nl2br($message1); ?></p>
            <h3>İş Yükünüzü Hafifletecek Bulut Çözümlerimiz...</h3>
            <p style="text-align: justify;"><?php echo nl2br($message2); ?></p>
        </div>
        <div class="col-md-6">
            <img src="assets/img/team.png" alt="Takım Resmi" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
        </div>
    </div>
<?php else: ?>
    <div class="row align-items-start">
        <div class="col-md-6">
            <p style="text-align: justify;"><?php echo nl2br($message1); ?></p>
            <h3>İş Yükünüzü Hafifletecek Bulut Çözümlerimiz...</h3>
            <p style="text-align: justify;"><?php echo nl2br($message2); ?></p>
        </div>
        <div class="col-md-6">
            <img src="assets/img/team.png" alt="Takım Resmi" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
        </div>
    </div>
<?php endif; ?>
</div>