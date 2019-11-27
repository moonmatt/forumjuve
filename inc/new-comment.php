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
  } else {
    header('location: ../index');
    die();
  }

$_SESSION["newComment_errors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectProfile = "../new-post"; // Path to redirect

if(isset($_POST['submit_comment'])){ // If the login form is submitted

    // Escapes dangerous characters
    $permalink = $_SESSION["new-comment"][0];
    $msg_post = stringEscape($_POST['msg_comment'], $conn);
    $date = date("Y-m-d H:i:s");

    // Creates error messages
    if (empty($msg_post)) { array_push($errors, "Il messaggio è obbligatorio"); }

    if (count($errors) == 0) { // If there are no errors
        $sql = "INSERT INTO comments (username, msg, permalink_post, date) VALUES ('$id', '$msg_post', '$permalink', '$date');";
        mysqli_query($conn, $sql);
        header("location: ../p/".$permalink);
        die();
    } else {
        $_SESSION["sendMsg_errors"] = $errors;
        header('location: ' . $redirect);
        die();
    }
}