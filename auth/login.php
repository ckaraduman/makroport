<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

    $remembered_email = $_SESSION['remember_email'] ?? ($_COOKIE['remember_email'] ?? '');
    unset($_SESSION['remember_email']); // 🔄 Kullanıldıktan sonra temizlenir
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap - MakroPort GameCity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Giriş Yap</h2>

        <!-- Geliştirilmiş hata mesajı -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger d-flex align-items-center justify-content-between fade show"
                 role="alert"
                 style="border-radius: 0.5rem; padding: 0.75rem 1rem; font-size: 0.95rem; margin-bottom: 1.25rem;">
                <div><?= $_SESSION['error'] ?></div>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Kapat"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form method="post" action="/logincontrol">
            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" name="email" id="email" class="form-control"
                       required value="<?= htmlspecialchars($remembered_email) ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1"
                    <?= $remembered_email ? 'checked' : '' ?>>
                <label class="form-check-label" for="remember">Beni hatırla</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Giriş</button>
            </div>

            <div class="mt-3 text-center">
                <a href="/register">Hesabın yok mu? Kayıt ol</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



