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

$_SESSION["showErrors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectPage = "../new-post"; // Path to redirect

if(isset($_POST['submit_post'])){ // If the login form is submitted

    // Escapes dangerous characters
    $msg_post = textareaEscape($_POST['msg_post'], $conn);
    $title_post = stringEscape($_POST['title_post'], $conn);
    $date = date("Y-m-d H:i:s");

    // Creates error messages
    if (empty($msg_post)) { array_push($errors, "Il messaggio è obbligatorio"); }
    if (empty($title_post)) { array_push($errors, "Il titolo è obbligatorio"); }


    if (count($errors) == 0) { // If there are no errors
        $permalink = permalink($title_post);
        $permalink =  checkPermalink($permalink, $conn);
        
        $sql = "INSERT INTO posts (username, title, msg, permalink, date, ban, closed) VALUES ('$id', '$title_post', '$msg_post', '$permalink', '$date', 0, 0);";
        mysqli_query($conn, $sql);
        header('location: /p/'.$permalink);
        die();
    } else {
        echo var_dump($errors);
        $_SESSION["showErrors"] = $errors;
        header('location: '.$redirectPage);
        die();
    }
}