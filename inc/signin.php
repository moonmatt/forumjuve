<?php

// Requires database and functions 
require_once 'dbh.inc.php';
require 'functions.php';

// Creates the errors array
$errors = array(); 

// Starts the session
session_start();

$_SESSION["login_errors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectLogin = "../login.php"; // Path to redirect



if(isset($_POST['submit'])){ // If the login form is submitted
    $username = stringEscape($_POST['username'], $conn); // Escapes dangerous characters
    $password = stringEscape($_POST['password'], $conn); // Escapes dangerous characters

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){ // If there is 1 result
        while($row = mysqli_fetch_assoc($result)){
            $pwd = $row['pwd'];
            $username = $row['username'];
            $email = $row['email'];
            $id = $row['id'];
            if(password_verify($password, $pwd)){ // If password is correct
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $id;
                $_SESSION['success'] = "You are now logged in";
                header('location: ' . $redirect);
                die();
            } else { // If password is not correct
                array_push($errors, "The password is not correct");
                $_SESSION["login_errors"] = $errors;
                header('location: ' . $redirectLogin);
                die();
            }
        }
    } else { // If there are no results
        array_push($errors, "The username does not exist");
        $_SESSION["login_errors"] = $errors;
        header('location: ' . $redirectLogin);
        die();
    }
 }