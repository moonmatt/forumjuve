<?php

require_once 'dbh.inc.php';
require 'functions.php';
session_start();

if(loginCheck()){
  $username = loginCheck()[1];
  $email = loginCheck()[2];
  $id = loginCheck()[3];
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="\forumjuve\css\style.css">
    
  </head>

  <!-- Image and text -->
  <nav class="navbar navbar-dark bg-dark">
  <div class="container">
  <a class="navbar-brand" href="/forumjuve">
    <img src="/forumjuve/img/logo.png" width="auto" height="40" class="d-inline-block align-top" alt="">
  </a>
  <?php
  if(loginCheck()){
    echo '
    <div class="dropdown">
    <a class="dropdown-toggle text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        '.$username.'
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="/forumjuve/profile">Profilo</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="/forumjuve/inc/logout">Esci</a>
    </div>
  </div>
    ';
  } else {
    echo '
    <div class="span">
    <a href="/forumjuve/signup" class="text-light align-baseline mr-2">Iscriviti</a>
    <a href="/forumjuve/login"><button type="button" class="btn btn-secondary btn-sm align-baseline">Accedi</button></a>
    </div>
    ';
  }
  ?>
  </div>
</nav>