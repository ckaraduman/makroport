<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/lib/game-functions.php';

$kelime = getDailyWord(); // Günlük kelimeyi al
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>MakroWord - Kelime Tahmin Oyunu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/pages/games/makroword1.css" rel="stylesheet">
</head>
<body data-word="<?= $kelime ?>">
<?php include './includes/header.php'; ?>

<div class="game-container">
    <h1>MakroWord</h1>
    <p class="subtitle">Günün kelimesini 6 tahminde bulmaya çalışın!</p>

    <div id="board" class="board"></div>
    <div id="keyboard" class="keyboard"></div>

    <div id="game-message" class="game-message"></div>
</div>

<script src="/pages/games/makroword1.js"></script>

<?php include './includes/footer.php'; ?>
</body>
</html>
