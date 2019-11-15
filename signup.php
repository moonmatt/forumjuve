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
    <link rel='icon' href='/forumjuve/img/favicon.png' type='image/x-icon' sizes="16x16" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/signin.css" rel="stylesheet">
    <title>Signup Page | ForumJuve</title>


  </head>
  <body class="text-center bg-secondary">
<div class="container">
  <form action="inc/signup.php" method="POST" class="form-signin bg-light">
  <a href="index"><img class="mb-4" src="/forumjuve/img/logo-black.png" alt="" width="auto" height="72"></a>
      <?php loginErrors(); ?>
      <input type="text" id="username" class="form-control mb-1" name="username" placeholder="Username" required>
      <input type="email" id="email" class="form-control mb-1" name="email" placeholder="Email" required>
      <input type="password" id="password" name="password" class="form-control mb-1" placeholder="Password" required>
      <input type="password" id="rpassword" name="rpassword" class="form-control" placeholder="Repeat Password" required>

      <button class="btn btn-lg btn-secondary btn-block" type="submit" value="submit" name="submit">Iscriviti!</button>
    <p class="mt-5 mb-3 text-muted">© <?php echo date('Y');?> <a href="https://moonmatt.cf" class="text-muted">moonmatt</a></p>
    </form>
    </div>
  </body>
</html>
