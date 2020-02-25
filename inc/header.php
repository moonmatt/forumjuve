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
<!--<div class="preloader" id="preloader">-->
</div>
<html lang="en">
  <head>
      <style> 
        /* Set the border color */ 
        
        /* Setting the stroke to green using rgb values (0, 128, 0) */ 
          
        .custom-toggler .navbar-toggler-icon { 
            background-image: url( 
"data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E"); 
        } 
    </style> 
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel='icon' href='/img/favicon.png' type='image/x-icon' sizes="16x16" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/stile.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet" >
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/b198bf3248.js" crossorigin="anonymous"></script>
  </head>

  <!-- Image and text -->
  <nav class="navbar dark-bg-1 navbar-expand-lg sticky-top">
  <div class="container">
  <a class="navbar-brand pr-1 mr-0" href="/">
    <img src="/img/logo1.png" width="120px" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-grow-1 text-left pb-1" id="navbarSupportedContent">
  <div class="d-inline align-baseline text-light">
<a href="/badges" class="text-light">Targhette <i class="fas fa-ribbon"></i></a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
</div>
  <?php
  if(loginCheck()){
    echo '
    <ul class="nav navbar-nav navbar-right ml-auto flex-nowrap" >

    <li class="nav-item">
    <a class="nav-link text-secondary" href="/new-post">Nuovo post <i class="fas fa-pen"></i></a>
  </li>


  <div class="nav-item dropdown text-light">
  <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      '.$username.'
  </a>
  <div class="dropdown-menu dropdown-menu-right dark-bg" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item text-light" href="/profile">Profilo <i class="fas fa-user"></i></a>
    <a class="dropdown-item text-light" href="/msg">Messaggi Privati <i class="fas fa-envelope"></i></a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-light" href="/inc/logout">Esci <i class="fas fa-sign-out-alt"></i></a>
  </div>
</div>
  
  </div>
    ';
  } else {
    echo '
    <div class="span ml-auto flex-nowrap">
    <a href="/signup"><button type="button" class="btn btn-sm align-baseline bg-light">Iscriviti <i class="fas fa-user-plus"></i></button></a>
    <a href="/login"><button type="button" class="btn btn-sm align-baseline third text-light">Accedi <i class="fas fa-sign-in-alt"></i></button></a>
    </div>

    ';
  }
  ?>
  </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>