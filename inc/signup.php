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
    $date = date('Y-m-d');

    // Creates error messages
    if (empty($username)) { array_push($errors, "L'username è obbligatorio"); }
    if (empty($email)) { array_push($errors, "L'email è obbligatoria"); }
    if (empty($password)) { array_push($errors, "La password è obbligatoria"); }
    if(!valid_email($email)){
        array_push($errors, "L'email contiene caratteri non validi");
    }
    if(!valid_username($username)){
        array_push($errors, "L'username contiene caratteri non validi");
    }
    if ($password != $rpassword) {
      array_push($errors, "Le password non coincidono");
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
        $sql = "INSERT INTO users (username, email, pwd, date) VALUES ('$username', '$email', '$password', '$date');";
        mysqli_query($conn, $sql);
        autoLogin($username, $password, $conn);
    } else {
        $_SESSION["signup_errors"] = $errors;
        header('location: ' . $redirectSignUp);
        die();
    }
}