<?php
require 'inc/functions.php';
session_start();

if(loginCheck()){
  header('Location: index');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='icon' href='/img/favicon.png' type='image/x-icon' sizes="16x16" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/stile.css" rel="stylesheet">
    <title>Login Page | ForumJuve</title>


  </head>
  <body class="text-center dark-bg">
<div class="container">
  <form action="inc/signin.php" method="POST" class="form-signin dark-bg-1 shadow rounded-lg">
      <a href="index"><img class="mb-4" src="/img/logo.png" alt="" width="auto" height="72"></a>
      <?php showErrors(); ?>
      <input type="text" id="username" class="form-control mb-1 dark-bg" name="username" placeholder="Username" style="border: none" required autofocus>
      <input type="password" id="password" name="password" class="form-control dark-bg" placeholder="Password" style="border: none" required>
      <button class="btn btn-lg third text-light btn-block" type="submit" value="submit" name="submit">Login!</button>
    <p class="mt-3 mb-1 text-muted">© <?php echo date('Y');?> <a href="https://moonmatt.cf" class="text-muted">moonmatt</a></p>
    </form>
    </div>
  </body>
</html>
