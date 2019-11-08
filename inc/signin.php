<?php
require_once 'dbh.inc.php';
require 'functions.php';
// Initialize the session
$errors = array(); 

session_start();
$_SESSION["login_errors"]=$errors;


if(isset($_POST['submit'])){
    $username = stringEscape($_POST['username'], $conn);
    $password = stringEscape($_POST['password'], $conn);
    //  $password = hashPassword($password);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){
        while($row = mysqli_fetch_assoc($result)){
            $pwd = $row['pwd'];
            echo "<br>PASSWORD 1 " . $password;
            echo "<br>PASSWORD 2 " . $pwd . "<br>";

            if(password_verify($password, $pwd)){
                // Password is correct, then login

                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: /login/');
                die();
            } else {
                array_push($errors, "The password is not correct");
                $_SESSION["login_errors"] = $errors;
                header('location: /login/');
                die();
            }
        }
    } else {
        array_push($errors, "The username does not exist");
        $_SESSION["login_errors"] = $errors;
        header('location: /login/');
        die();
    }
 }