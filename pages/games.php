<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
?>

<h2>Oyunlar Sayfası</h2>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>

<a href="/makroword">MakroWord - Kelime Bulma Oyunu</a><br>