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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="\forumjuve\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    
  </head>

  <!-- Image and text -->
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
  <div class="container">
  <a class="navbar-brand" href="/forumjuve">
    <img src="/forumjuve/img/logo.svg" class="d-inline-block align-top" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse flex-grow-1 text-left" id="navbarSupportedContent">
  <?php
  if(loginCheck()){
    echo '
    <ul class="nav navbar-nav navbar-right ml-auto flex-nowrap" >

    <li class="nav-item">
    <a class="nav-link" href="/forumjuve/new-post">Nuovo post</a>
  </li>


  <div class="nav-item dropdown">
  <a class="nav-link dropdown-toggle text-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      '.$username.'
  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="/forumjuve/profile">Profilo</a>
    <a class="dropdown-item" href="/forumjuve/msg">Messaggi Privati</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="/forumjuve/inc/logout">Esci</a>
  </div>
</div>
  
  </div>
    ';
  } else {
    echo '
    <div class="span ml-auto flex-nowrap">
    <a href="/forumjuve/signup" class="text-light align-baseline mr-2">Iscriviti</a>
    <a href="/forumjuve/login"><button type="button" class="btn btn-secondary btn-sm align-baseline">Accedi</button></a>
    </div>

    ';
  }
  ?>
  </div>
  </div>
</nav>