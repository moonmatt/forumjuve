<?php
//  SELECT * FROM posts WHERE (`title` LIKE '%ciao%') OR (`msg` LIKE '%ciao%')
require_once 'dbh.inc.php';
require 'functions.php';
session_start();

if(loginCheck()){
  $username = loginCheck()[1];
  $email = loginCheck()[2];
  $id = loginCheck()[3];
  $ban = loginCheck()[5];
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel='icon' href='/forumjuve/img/favicon.png' type='image/x-icon' sizes="16x16" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="\forumjuve\css\stile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" >
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>




<link rel="stylesheet" type="text/css" href="//wpcc.io/lib/1.0.2/cookieconsent.min.css"/><script src="//wpcc.io/lib/1.0.2/cookieconsent.min.js"></script><script>window.addEventListener("load", function(){window.wpcc.init({"colors":{"popup":{"background":"#222222","text":"#ffffff","border":"#fde296"},"button":{"background":"#fde296","text":"#000000"}},"position":"bottom-right","content":{"href":"https://forumjuve.cf/privacy.txt","message":"Visitando questo sito acconsenti l'utilizzo di cookie per migliorare l'esperienza finale.","button":"Capito!","link":"Leggi tutto"}})});</script>
  </head>

  <!-- Image and text -->
  <nav class="navbar dark-bg-1 navbar-expand-lg sticky-top">
  <div class="container">
  <a class="navbar-brand" href="/forumjuve">
    <img src="/forumjuve/img/logo1.png" width="120px" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-grow-1 text-left pb-1" id="navbarSupportedContent">
  <div class="d-inline align-baseline text-light">
  <h1 class="ml10">
  <span class="text-wrapper">
    <span class="letters">Finalmente disponibile!</span>
  </span>
</h1>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</div>
  <?php
  if(loginCheck()){
    echo '
    <ul class="nav navbar-nav navbar-right ml-auto flex-nowrap" >

    <li class="nav-item">
    <a class="nav-link text-secondary" href="/forumjuve/new-post">Nuovo post</a>
  </li>


  <div class="nav-item dropdown text-light">
  <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      '.$username.'
  </a>
  <div class="dropdown-menu dropdown-menu-right dark-bg" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item text-light" href="/forumjuve/profile">Profilo <ion-icon name="person"></ion-icon></a>
    <a class="dropdown-item text-light" href="/forumjuve/msg">Messaggi Privati <ion-icon name="mail"></ion-icon></a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-light" href="/forumjuve/inc/logout">Esci <ion-icon name="log-out"></ion-icon></a>
  </div>
</div>
  
  </div>
    ';
  } else {
    echo '
    <div class="span ml-auto flex-nowrap">
    <a href="/forumjuve/signup"><button type="button" class="btn btn-sm align-baseline bg-light">Iscriviti</button></a>
    <a href="/forumjuve/login"><button type="button" class="btn btn-sm align-baseline third text-light">Accedi <ion-icon name="log-in"></ion-icon></button></a>
    </div>

    ';
  }
  ?>
  </div>
  </div>
</nav>
<script>
// Wrap every letter in a span
var textWrapper = document.querySelector('.ml10 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml10 .letter',
    rotateY: [-90, 0],
    duration: 1300,
    delay: (el, i) => 45 * i
  }).add({
    targets: '.ml10',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });
</script>

<style>
.ml10 {
  position: relative;
  font-weight: 900;
  font-size: 1em;
}

.ml10 .text-wrapper {
  position: relative;
  display: inline-block;
  padding-top: 0.2em;
  padding-right: 0.05em;
  padding-bottom: 0.1em;
  overflow: hidden;
}

.ml10 .letter {
  display: inline-block;
  line-height: 1em;
  transform-origin: 0 0;
}
</style>