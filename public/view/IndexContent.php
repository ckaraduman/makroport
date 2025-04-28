<?php
// session_start();

if (isset($_COOKIE['rememberMe']) && isset($_COOKIE['email'])) {
    // Çerezdeki kullanıcı hash ve email değerini kontrol et
    $userHash = $_COOKIE['rememberMe'];
    $email = $_COOKIE['email'];

    // Çerezdeki hash değeri ile email hash'ini karşılaştır
    if ($userHash == hash('sha256', $email)) {
        $_SESSION['email'] = $email;
        header("Location: secret");
    }
}

if (isset($_SESSION['email'])) {
    echo "Hoş geldiniz, " . $_SESSION['email'];
} else {
?>
  <div class="row">
    <div class="col-4">
    <div class="container-fluid">
    <h2>Kullanıcı Giriş Ekranı</h2>
  <form action="/loginControl" method="post">

    <label for="exampleInputEmail1" class="form-label">E-Posta Adresi</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">KVKK kapsamında; bilgileriniz üçüncü kişilerle paylaşılmayacaktır.</div>
      <div class="mt-3">
        <label for="exampleInputPassword1" class="form-label">Şifre</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
      </div>
  <div class="mb-3 mt-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberMe">
    <label class="form-check-label" for="exampleCheck1">Beni Hatırla</label>
  </div>
  <button type="submit" class="btn btn-primary">Gönder</button>
    <div class="mt-3">
      <a href="/missing">Şifremi Unuttum</a>
    </div>
    <div class="mt-3">
      <a href="/member">Üye Ol</a>
    </div>
  </form>
</div>
    </div>
      <div class="col-8">
        <div class="container-fluid">
          <!--<img src="/public/images/GameCity.png" class="img-fluid rounded-3" style="max-width:100%;height:auto" alt="MakroPort GameCity">-->
        </div>
      </div>
    
  </div>
<?php
}
?>