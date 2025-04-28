<?php
echo "cem";
// Veritabanı bağlantı bilgileri
$host = '65.181.111.172'; // Veritabanı sunucusu
$dbname = 'cemilker_gamecity'; // Veritabanı adı
$username = 'cemilker_cemilker'; // Veritabanı kullanıcı adı
$password = 'z43T271RRe%'; // Veritabanı şifresi

// Bağlantıyı oluştur
$conn = new mysqli($host, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
} else {
    echo "Bağlantı başarılı!";
}

// Bağlantıyı kapat
$conn->close();
?>