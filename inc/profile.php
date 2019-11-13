<?php

// Requires database and functions 
require_once 'dbh.inc.php';
require 'functions.php';

// Creates the errors array
$errors = array(); 

// Starts the session
session_start();

if(loginCheck()){
    $username = loginCheck()[1];
    $email = loginCheck()[2];
    $id = loginCheck()[3];
  }

$_SESSION["profile_errors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectSignUp = "../profile"; // Path to redirect

if(isset($_POST['submit_profile'])){ // If the login form is submitted

    // // Escapes dangerous characters
    $username_form = stringEscape($_POST['username_form'], $conn);
    $email_form = stringEscape($_POST['email_form'], $conn);
    $name_form = stringEscape($_POST['name_form'], $conn);
    $website_form = stringEscape($_POST['website_form'], $conn);
    $sex_form = stringEscape($_POST['sex_form'], $conn);
    $city_form = stringEscape($_POST['city_form'], $conn);
    $dofbirth_form = stringEscape($_POST['dofbirth_form'], $conn);
    $bio_form = stringEscape($_POST['bio_form'], $conn);

    // Creates error messages
    if (empty($username)) { array_push($errors, "L'username è obbligatorio"); }
    if (empty($email)) { array_push($errors, "L'email è obbligatoria"); }
    if (preg_match('[^A-Za-z0-9-_]', $username)){
        array_push($errors, "L'username contiene caratteri non validi");
    }
    if (preg_match('[^A-Za-z0-9-_.@+]', $email)){
        array_push($errors, "L'email contiene caratteri non validi");
    }
    echo $id;
    $sql = "SELECT * FROM users WHERE id = '$id' AND username = '$username' AND email = '$email'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    // if($resultcheck == 1){ // If the account already exists
    //     while($user = mysqli_fetch_assoc($result)){
    //         if ($user['username'] === $username) {
    //             array_push($errors, "Username already exists");
    //             $_SESSION["signup_errors"] = $errors;
    //             header('location: ' . $redirectSignUp);
    //             die();
    //         }

    //         if ($user['email'] === $email) {
    //             array_push($errors, "email already exists");
    //             $_SESSION["signup_errors"] = $errors;
    //             header('location: ' . $redirectSignUp);
    //             die();
    //         }
    //     }
    // }

    // if (count($errors) == 0) { // If there are no errors
    //     $password = hashPassword($password);
    //     $sql = "INSERT INTO users (username, email, pwd, date) VALUES ('$username', '$email', '$password', '$date');";
    //     mysqli_query($conn, $sql);
    //     header('location: ' . $redirect);
    // } else {
    //     $_SESSION["signup_errors"] = $errors;
    //     header('location: ' . $redirectSignUp);
    //     die();
    // }
}  else {
    echo "non inviato";
}