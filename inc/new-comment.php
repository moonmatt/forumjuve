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
$redirectProfile = "../new-post"; // Path to redirect

if(isset($_POST['submit_comment'])){ // If the login form is submitted

    // Escapes dangerous characters
    $permalink = $_SESSION["new-comment"][0];
    $msg_post = textareaEscape($_POST['msg_comment'], $conn);
    $date = date("Y-m-d H:i:s");

    // Creates error messages
    if (empty($msg_post)) { array_push($errors, "Il messaggio è obbligatorio"); }

    if (count($errors) == 0) { // If there are no errors
        $sql = "INSERT INTO comments (username, msg, permalink_post, date, ban) VALUES ('$id', '$msg_post', '$permalink', '$date', 0);";
        mysqli_query($conn, $sql);
        $sql_2 = "SELECT * FROM comments WHERE permalink_post = '$permalink' ORDER BY id DESC";
        $result_2 = mysqli_query($conn, $sql_2);
        $resultcheck_2 = mysqli_num_rows($result_2);
        $row_2 = mysqli_fetch_assoc($result_2);
        $id = $row_2['id'];
        header("location: ../p/".$permalink."#".$id);
        die();
    } else {
        $_SESSION["showErrors"] = $errors;
        header('location: ' . $redirect);
        die();
    }
}