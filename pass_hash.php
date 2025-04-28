<?php
//Kullanıcıdan gelen düz şifre
$plainPassword = "123456";

// Şifreyi hashleyin (şifrelenmiş olarak veritabanına kaydedilecek)
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

echo $hashedPassword;
// Veritabanına kaydetme işlemi
// $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
// $stmt->bindParam(':email', $email);
// $stmt->bindParam(':password', $hashedPassword);
// $stmt->execute();
?>