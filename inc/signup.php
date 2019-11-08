<?php

// Requires database and functions 
require_once 'dbh.inc.php';
require 'functions.php';

// Creates the errors array
$errors = array(); 

// Starts the session
session_start();

$_SESSION["signup_errors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectSignUp = "../signup.php"; // Path to redirect

if(isset($_POST['submit'])){ // If the login form is submitted

    // Escapes dangerous characters
    $username = stringEscape($_POST['username'], $conn);
    $email = stringEscape($_POST['email'], $conn);
    $password = stringEscape($_POST['password'], $conn);
    $rpassword = stringEscape($_POST['rpassword'], $conn);

    // Creates error messages
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    if ($password != $rpassword) {
      array_push($errors, "The two passwords do not match");
      $_SESSION["signup_errors"] = $errors;
    }

    $sql = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){ // If the account already exists
        while($user = mysqli_fetch_assoc($result)){
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
                $_SESSION["signup_errors"] = $errors;
                header('location: ' . $redirectSignUp);
                die();
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
                $_SESSION["signup_errors"] = $errors;
                header('location: ' . $redirectSignUp);
                die();
            }
        }
    }

    if (count($errors) == 0) { // If there are no errors
        $password = hashPassword($password);
        $sql = "INSERT INTO users (username, email, pwd) VALUES ('$username', '$email', '$password');";
        mysqli_query($conn, $sql);
        header('location: ' . $redirect);
    }
}