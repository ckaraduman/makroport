<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
?>

<h2>Oyunlar Sayfası</h2>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['email']) ?></p>

<a href="/makroword">MakroWord - Kelime Bulma Oyunu</a><br>
<a href="/makroword1">MakroWord1 - Kelime Bulma Oyunu-1</a><br>