<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script>
        $(document).ready(function(){
            // Dropdown menüdeki bağlantılar için tıklama olayını tanımla
            $('.dropdown-item').on('click', function (e) {
                var url = $(this).attr('href'); // Tıklanan öğenin href değerini al

                if (url === "/logout") {
                    // Eğer URL "/logout" ise sayfayı tamamen yenile
                    window.location.href = url;
                } else {
                    e.preventDefault(); // Varsayılan tıklama davranışını engelle
                    
                    // AJAX isteği gönder
                    $.ajax({
                        url: url,
                        success: function(response){
                            // response ile dönen veriyi ana ekrandaki div'e yerleştir
                            $('#content').html(response);
                        },
                        error: function(){
                            $('#content').html('<p>İçerik yüklenemedi.</p>');
                        }
                    });
                }
            });

            // list-group-item bağlantıları için tıklama olayını tanımla
            $('.list-group-item').on('click', function (e) {
                var url = $(this).attr('href'); // Tıklanan öğenin href değerini al

                if (url === "/logout") {
                    // Eğer URL "/logout" ise sayfayı tamamen yenile
                    window.location.href = url;
                } else if (url === "/"){
                    window.location.href = url;
                } else {
                    e.preventDefault(); // Varsayılan tıklama davranışını engelle
                    
                    // AJAX isteği gönder
                    $.ajax({
                        url: url,
                        success: function(response){
                            // response ile dönen veriyi ana ekrandaki div'e yerleştir
                            $('#content').html(response);
                        },
                        error: function(){
                            $('#content').html('<p>İçerik yüklenemedi.</p>');
                        }
                    });
                }
            });
        });
    </script>
</head>
<body>
    <div class="row mt-1">
        <h1>MakroPort GameCity</h1>
    </div>

    <div class="row mt-2">
        <div class="col-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-app-list" data-bs-toggle="list" href="/" role="tab" aria-controls="list-app">Ana Sayfa</a>    
                <a class="list-group-item list-group-item-action" id="list-app-list" data-bs-toggle="list" href="/app" role="tab" aria-controls="list-app">Uygulamalar</a>
                <a class="list-group-item list-group-item-action" id="list-contact-list" data-bs-toggle="list" href="/contact" role="tab" aria-controls="list-contact">Kurumsal İletişim</a>
                <a class="list-group-item list-group-item-action" id="list-education-list" data-bs-toggle="list" href="/education" role="tab" aria-controls="list-education">Eğitimler</a>
                <a class="list-group-item list-group-item-action" id="list-ohs-list" data-bs-toggle="list" href="/test" role="tab" aria-controls="list-ohs">İSG ve Çevre</a>
                <a class="list-group-item list-group-item-action" id="list-announ-list" data-bs-toggle="list" href="/contact" role="tab" aria-controls="list-announ">İletişim ve Duyurular</a>
                <a class="list-group-item list-group-item-action" id="list-ethics-list" data-bs-toggle="list" href="/test" role="tab" aria-controls="list-ethics">Etik ve Uyum</a>
                <a class="list-group-item list-group-item-action" id="list-covid-list" data-bs-toggle="list" href="/test" role="tab" aria-controls="list-covid">COVID-19</a>
                <a class="list-group-item list-group-item-action" id="list-technical-list" data-bs-toggle="list" href="/test" role="tab" aria-controls="list-technical">Teknik Hizmetler</a>
                <a class="list-group-item list-group-item-action" id="list-directory-list" data-bs-toggle="list" href="/directory" role="tab" aria-controls="list-directory">Rehber</a>
                <a class="list-group-item list-group-item-action" id="list-gallery-list" data-bs-toggle="list" href="/gallery" role="tab" aria-controls="list-gallery">Galeri</a>
            </div>
        </div>
        <div class="col-10" id="content">
            <div class="tab-content" id="nav-tabContent">
                <?php include($content); ?>
            </div>
        </div>
    </div>
</body>
</html>
