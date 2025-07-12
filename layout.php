<?php
// Bu dosya sadece route.php tarafından çağrılır, o yüzden $page değişkeni tanımlıdır.
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>MakroPort</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Varsayılan stil dosyanız -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <?php include 'includes/header.php'; ?>

    <div class="container-fluid flex-grow-1 mt-3">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 bg-light p-3 border-end">
                <?php include 'includes/sidebar.php'; ?>
            </aside>

            <!-- Main content -->
            <main class="col-md-9 col-lg-10 p-4">
                <?php
                    $pagePath = $page;
                    if (file_exists($pagePath)) {
                        include $pagePath;
                    } else {
                        echo "<div class='alert alert-warning'>Sayfa bulunamadı: <strong>$page</strong></div>";
                    }
                ?>
            </main>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
