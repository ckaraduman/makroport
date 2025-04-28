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
      });
  </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <div class="position-relative">
        <a class="navbar-brand" href="https://www.palmet.com">Palmet</a>
      </div>
      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Görev Yönetimi</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <!-- <li><a class="dropdown-item" href="{{Route('help')}}">Görevler</a></li> -->
              <li><a class="dropdown-item" href="/about">Test</a></li>
              <li><a class="dropdown-item" href="{{Route('request')}}">İş Planları</a></li>
              <li><a class="dropdown-item" href="#">Raporlar</a></li>
              <li><a class="dropdown-item" href="{{Route('sugges')}}">Tanımlar</a></li>
              <li><a class="dropdown-item" href="#">Ayarlar</a></li>
              <li><a class="dropdown-item" href="#">Kontrol Paneli</a></li>
              <li><a class="dropdown-item" href="/logout">Çıkış</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Talep Yönetimi</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{Route('help')}}">Yeni Talep</a></li>
              <li><a class="dropdown-item" href="{{Route('request')}}">Gelen Talepler</a></li>
              <li><a class="dropdown-item" href="{{Route('gsm')}}">GSM-Cihaz Talebi</a></li>
              <li><a class="dropdown-item" href="{{Route('sugges')}}">Öneriler</a></li>
              <li><a class="dropdown-item" href="#">Bildirimler</a></li>
              <li><a class="dropdown-item" href="#">Şikayetler</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Rehber Hizmetler</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('directory')}}">İletişim Bilgileri</a></li>
              <li><a class="dropdown-item" href="{{Route('dataset')}}">İletişim Bilgi Güncelle</a></li>
              <li><a class="dropdown-item" href="{{Route('insData')}}">İletişim Bilgisi Ekle</a></li>
              <li><a class="dropdown-item" href="{{Route('web')}}">Web Sitelerimiz</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tüketim Verileri</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{Route('hgf')}}">Gaz Akış Tabloları</a></li>
              <li><a class="dropdown-item" href="#">Tüketim Noktaları</a></li>
              <li><a class="dropdown-item" href="#">Ayarlar</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kaynak Yönetimi</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Kaynaklar</a></li>
              <li><a class="dropdown-item" href="#">Kaynak Kullanımı</a></li>
              <li><a class="dropdown-item" href="#">Ayarlar</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Varlık Yönetimi</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">IT-Donanım Varlıkları</a></li>
              <li><a class="dropdown-item" href="#">IT-Yazılım Varlıkları</a></li>
              <li><a class="dropdown-item" href="{{route('datalines')}}">Data Hatları</a></li>
              <li><a class="dropdown-item" href="{{route('transceiver')}}">Telsiz Cihazları</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kütüphane</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">Projeler</a></li>
              <li><a class="dropdown-item" href="#">Belgeler</a></li>
              <li><a class="dropdown-item" href="#">Referanslar</a></li>
              <li><a class="dropdown-item" href="#">Guide</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">BGYS-CBDDO-KVKK</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="#">BGYS Politikası</a></li>
              <li><a class="dropdown-item" href="#">CBDDO Rehberi</a></li>
              <li><a class="dropdown-item" href="#">KVKK Mevzuatı</a></li>
              <li><a class="dropdown-item" href="#">BGYS Organizasyonu</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5" id="content">
    <?php include($content); ?>
  </div>

</body>
</html>
