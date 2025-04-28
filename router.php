<?php

// İstenen URL'yi alın
$request = $_SERVER['REQUEST_URI'];

// İlk / işaretini ve sonrasındaki query string'i kaldırın
$request = strtok($request, '?');

// İstek URL'sine göre dosya yönlendirmesi yapın
switch ($request) {
   case '/':
      require 'index.php';
      break;
   case '/about':
      require './public/view/about.php';
      break;
   case '/contact':
      require './public/view/contact.php';
      break;
   case '/test':
      require './public/view/test.php';
      break;
   case '/secret':
      require './public/view/protected_page.php';
      break;
   case '/app':
      require './public/view/app.php';
      break;
   case '/logout':
      require './control/logout.php';
      break;
   case '/loginControl':
      require './control/loginControl.php';
      break;
   case '/directory':
      require './public/view/directory.php';
      break;
   case '/education':
      require './public/view/education.php';
      break;
   case '/gallery':
      require './public/view/gallery.php';
      break;
   case '/member':
      require './public/view/new_member.php';
      break;
   case '/record':
      require './public/view/member.php';
      break;
   case '/verify': // Yeni doğrulama sayfası yönlendirmesi
      require './public/view/member_verify.php';
      break;
   case '/missing':
      require './public/view/missing.php';
      break;
   default:
      require './public/view/404.php';
      break;
}