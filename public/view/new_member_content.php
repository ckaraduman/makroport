<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni Üye Kayıt Sayfası</title>

    <script>
    // Form gönderilmeden önce şifrelerin eşleşip eşleşmediğini kontrol eden fonksiyon
    function validatePasswords() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        // Eğer şifreler eşleşmezse
        if (password !== confirmPassword) {
            alert("Şifreler eşleşmiyor. Lütfen tekrar kontrol edin.");
            return false; // Formun gönderilmesini engeller
        }

        // Şifreler eşleşiyorsa form gönderilebilir
        return true;
    }
    </script>
</head>

<body>
    <div class="container">
        <h2>Üye Ol</h2>

        <form action="/record" method="POST" onsubmit="return validatePasswords()">

            <div class="mb-3 row">
                <label for="fullName" class="col-sm-2 col-form-label">Ad Soyad</label>
                <div class="col-sm-4">
                    <input type="text" id="fullName" name="fullName" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">E-posta</label>
                <div class="col-sm-4">
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="birthDate" class="col-sm-2 col-form-label">Doğum Tarihi</label>
                <div class="col-sm-4">
                    <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Şifre</label>
                <div class="col-sm-4">
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="confirmPassword" class="col-sm-2 col-form-label">Şifre (Tekrar)</label>
                <div class="col-sm-4">
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-4 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Kaydol</button>
                </div>
            </div>

        </form>
    </div>
</body>

</html>