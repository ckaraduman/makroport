<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
?>

<h2>Yazılarım...</h2>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>
<p>Burada makaleler ve yazılar yer alacaktır.</p>