<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit;
}
?>
<h2>Alıntılar - Yorumlar</h2>
<p>Hoş geldiniz, <?= htmlspecialchars($_SESSION['fullname']) ?></p>

<div>
    <p style="text-align: justify;">Burada başka yazarlardan, eser sahiplerinden alıntılar ve bu alıntılarla ilgili yorumlarımız yer alacaktır
    </p>
</div>

<?php $text = file_get_contents(__DIR__ . '/text.txt'); ?>
<?php $text1 = file_get_contents(__DIR__ . '/text1.txt'); ?>
<?php $text2 = file_get_contents(__DIR__ . '/text2.txt'); ?>
<?php $text3 = file_get_contents(__DIR__ . '/text3.txt'); ?>

  <div class="row g-4">
    <div class="col-md-6">
      <div style="border: 1px solid #ccc; padding: 10px;">
        <p style="column-count: 2; column-gap: 20px; column-rule: 1px solid; text-align: justify;"><?php echo $text ?></p>
      </div>
    </div>
    <div class="col-md-6">
      <div style="border: 1px solid #ccc; padding: 10px;">
        <p style="column-count: 2; column-gap: 20px; column-rule: 1px solid; text-align: justify;"><?php echo $text1 ?></p>
      </div>
    </div>
    <div class="col-md-6">
      <div style="border: 1px solid #ccc; padding: 10px;">
        <p style="column-count: 2; column-gap: 20px; column-rule: 1px solid; text-align: justify;"><?php echo $text2 ?></p>
      </div>
    </div>
    <div class="col-md-6">
      <div style="border: 1px solid #ccc; padding: 10px;">
        <p style="column-count: 2; column-gap: 20px; column-rule: 1px solid; text-align: justify;"><?php echo $text3 ?></p>
      </div>
    </div>
  </div>

