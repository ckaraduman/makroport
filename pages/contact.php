<?php
include 'auth/session.php';
$content="cemilkerkaraduman@gmail.com";
?>
<div class="container">
<h2>İletişim Sayfası</h2>
<?php if (isset($_SESSION['user_id'])): ?>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>
<div class="content col-md-6">
    <p style="text-align: justify;">Bu sayfada iletişim bilgilerinizi ve mesajınızı bırakabilirsiniz. Size en kısa sürede geri dönüş yapacağız.</p>
    <form action="/send-message" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Adınız</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-posta Adresiniz</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mesajınız</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
    </form>
        <div class="fixed-bottom"  style="bottom: 50px;">
            <p style="text-align:center; font-size: 14px;"><?php echo $content ?></p>
        </div>
</div>
<?php else: ?>
<div class="content col-md-9">
    <p style="text-align: justify;">Bu sayfada iletişim bilgilerinizi ve mesajınızı bırakabilirsiniz. Size en kısa sürede geri dönüş yapacağız.</p>
    <form action="/send-message" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Adınız</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-posta Adresiniz</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mesajınız</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
    </form>
        <div class="fixed-bottom"  style="bottom: 50px;">
            <p style="text-align:center; font-size: 14px;"><?php echo $content ?></p>
        </div>
</div>
<?php endif; ?>
</div>