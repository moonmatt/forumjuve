<?php
require_once 'dbh.inc.php';
require 'functions.php';

$errors = array(); 

session_start();
$_SESSION["signup_errors"] = $errors;

if(isset($_POST['submit'])){  
    $username = stringEscape($_POST['username'], $conn);
    $email = stringEscape($_POST['email'], $conn);
    $password = stringEscape($_POST['password'], $conn);
    $rpassword = stringEscape($_POST['rpassword'], $conn);

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if ($password != $rpassword) {
      array_push($errors, "The two passwords do not match");
      $_SESSION["signup_errors"]=$errors;
    }

    $sql = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
    echo $sql;
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){
        while($user = mysqli_fetch_assoc($result)){
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
                $_SESSION["signup_errors"] = $errors;
                header("location: /login/");
                die();
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
                header("location: /login/");
                $_SESSION["signup_errors"] = $errors;
                die();
            }
        }
    }

    if (count($errors) == 0) {
        $password = hashPassword($password);
        $sql = "INSERT INTO users (username, email, pwd) VALUES ('$username', '$email', '$password');";
        mysqli_query($conn, $sql);
        header("location: /login/");
    }
}