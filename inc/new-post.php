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
  } else {
      header('location: ../index');
      die();
  }

$_SESSION["sendMsg_errors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectProfile = "../new-post"; // Path to redirect

if(isset($_POST['submit_post'])){ // If the login form is submitted

    // Escapes dangerous characters
    $msg_post = stringEscape($_POST['msg_post'], $conn);
    $title_post = stringEscape($_POST['title_post'], $conn);
    $date = date("Y-m-d H:i:s");

    // Creates error messages
    if (empty($msg_post)) { array_push($errors, "Il messaggio è obbligatorio"); }
    if (empty($title_post)) { array_push($errors, "Il titolo è obbligatorio"); }


    if (count($errors) == 0) { // If there are no errors
        $permalink = permalink($title_post);
        $sql = "INSERT INTO posts (username, title, msg, permalink, date) VALUES ('$username', '$title_post', '$msg_post', '$permalink', '$date');";
        mysqli_query($conn, $sql);
        // header('location: index?post-sent');
        echo "va";
        die();
    } else {
        $_SESSION["sendMsg_errors"] = $errors;
        // header('location: ' . $redirectProfile);
        echo "errore";
        die();
    }
}