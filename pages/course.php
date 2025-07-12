<?php
include 'auth/session.php';
$message="Bu bölümde eğitim materyalleri, kurslar ve dersler yer alacaktır. Eğitim materyalleri, çeşitli konularda bilgi edinmek isteyenler için hazırlanmıştır. 
Farklı seviyelerdeki ilgililer için hazırlanan bu materyaller, temel bilgilerden ileri düzey konulara kadar geniş bir yelpazeyi kapsar.
Eğitimler, kullanıcıların kendi hızlarında öğrenmelerine olanak tanır ve çeşitli konularda bilgi edinmelerini sağlar.
Eğitim materyalleri, metin, video ve interaktif içeriklerle zenginleştirilmiştir.";
?>
<div class="container">
<h2>Eğitimler Sayfası</h2>

<?php if (isset($_SESSION['user_id'])): ?>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>
    <p style="text-align: justify;"><?php echo $message ?></p>
<?php else: ?>
    <p style="text-align: justify;"><?php echo $message ?></p>
<?php endif; ?>
</div>