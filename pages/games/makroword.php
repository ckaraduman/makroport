<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$date_key = date('Y-m-d');

// Günlük kelimeyi belirle
$words = json_decode(file_get_contents(__DIR__ . '/makrowords.json'), true);
$word_of_day = $words[crc32($date_key) % count($words)];
$_SESSION['word_of_day'] = $word_of_day;

// Tahmin geçmişi
$guesses = $_SESSION['guesses'] ?? [];

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kelime Tahmin Oyunu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .letter-box {
            width: 50px;
            height: 50px;
            display: inline-block;
            text-align: center;
            line-height: 50px;
            margin: 2px;
            font-weight: bold;
            font-size: 1.5rem;
            border-radius: 4px;
        }
        .correct { background-color: #28a745; color: white; }
        .partial { background-color: #ffc107; color: black; }
        .wrong   { background-color: #dee2e6; color: black; }
    </style>
</head>
<body class="bg-light text-center">

<div class="container py-5">
    <h2>🎯 Günlük Kelime Tahmini</h2>

    <?php foreach ($guesses as $guess): ?>
        <div class="my-2">
            <?php
            for ($i = 0; $i < strlen($guess); $i++):
                $letter = $guess[$i];
                $class = 'wrong';
                if ($word_of_day[$i] === $letter) {
                    $class = 'correct';
                } elseif (strpos($word_of_day, $letter) !== false) {
                    $class = 'partial';
                }
            ?>
                <div class="letter-box <?= $class ?>"><?= strtoupper($letter) ?></div>
            <?php endfor; ?>
        </div>
    <?php endforeach; ?>

    <?php if (count($guesses) < 6 && end($guesses) !== $word_of_day): ?>
        <form method="post" action="/wordcheck" class="mt-4">
            <input type="text" name="guess" class="form-control mb-2 text-center" maxlength="5" required placeholder="5 harfli tahmin">
            <button type="submit" class="btn btn-primary">Tahmin Et</button>
        </form>
    <?php else: ?>
        <div class="alert alert-info mt-4">
            <?php if (end($guesses) === $word_of_day): ?>
                🎉 Tebrikler! Kelimeyi bildiniz: <strong><?= strtoupper($word_of_day) ?></strong>
            <?php else: ?>
                ❌ Şansınızı kaybettiniz. Kelime: <strong><?= strtoupper($word_of_day) ?></strong>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
