<?php
function getDailyWord() {
    $words = file(__DIR__ . '/../data/kelimeler.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $dayIndex = date('z'); // 0–365 arası gün numarası
    return trim($words[$dayIndex % count($words)]);
}
