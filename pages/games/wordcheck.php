<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$guess = strtolower(trim($_POST['guess'] ?? ''));
if (strlen($guess) !== 5) {
    header("Location: /makroword");
    exit;
}

// Harf kontrolü yapılabilir (isteğe bağlı)
if (!preg_match('/^[a-zçğıöşü]{5}$/u', $guess)) {
    header("Location: /makroword");
    exit;
}

$_SESSION['guesses'][] = $guess;

header("Location: /makroword");
exit;