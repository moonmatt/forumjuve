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
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel='icon' href='/forumjuve/img/favicon.png' type='image/x-icon' sizes="16x16" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="\forumjuve\css\stile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" >
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
ciao

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

