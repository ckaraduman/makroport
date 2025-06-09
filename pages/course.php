<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
?>

<h2>Eğitimler Sayfası</h2>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['email']) ?></p>
<p>Burada Eğitim Materyalleri yer alacaktır.</p>