<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
?>

<h2>Hakkımızda Sayfası</h2>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['email']) ?></p>