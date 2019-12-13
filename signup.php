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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/stile.css" rel="stylesheet">
    <title>Signup Page | ForumJuve</title>


</head>

<body class="text-center dark-bg">
    <div class="container">
        <form action="inc/signup.php" method="POST" class="form-signin dark-bg-1 shadow rounded-lg">
            <a href="index"><img class="mb-4" src="/forumjuve/img/logo.png" alt="" width="auto" height="72"></a>
            <?php signupErrors(); ?>
            <input type="text" id="username" class="form-control mb-1 dark-bg" name="username" placeholder="Username" style="border: none" required>
            <input type="email" id="email" class="form-control mb-1 dark-bg" name="email" placeholder="Email" style="border: none" required>
            <input type="password" id="password" name="password" class="form-control mb-1 dark-bg" placeholder="Password"
            style="border: none" required>
            <input type="password" id="rpassword" name="rpassword" class="form-control dark-bg" placeholder="Repeat Password"
            style="border: none" required>

            <button class="btn btn-lg third btn-block text-light mt-2" type="submit" value="submit"
                name="submit">Iscriviti!</button>
            <p class="mt-3 mb-1 text-muted">© <?php echo date('Y');?> <a href="https://moonmatt.cf"
                    class="text-muted">moonmatt</a></p>
        </form>
    </div>
</body>

</html>