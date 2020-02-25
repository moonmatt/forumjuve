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
$redirectProfile = "../write-msg"; // Path to redirect

if(isset($_POST['submit_msg'])){ // If the login form is submitted

    // // Escapes dangerous characters
    $to_username_form = stringEscape($_POST['to_username_form'], $conn);
    $msg_form = textareaEscape($_POST['msg_form'], $conn);
    $title_form = stringEscape($_POST['title_form'], $conn);
    $date = date("Y-m-d H:i:s");
    $username = stringEscape($username, $conn);

    // Creates error messages
    if (empty($to_username_form)) { array_push($errors, "L'username è obbligatorio"); }
    if (empty($msg_form)) { array_push($errors, "Il messaggio è obbligatorio"); }
    if (empty($title_form)) { array_push($errors, "Il titolo è obbligatorio"); }
    if(!valid_username($to_username_form)){
        array_push($errors, "L'username contiene caratteri non validi");
    }

    if(count($errors) == 0){
        $sql = "SELECT * FROM users WHERE username = '$to_username_form'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        

        if($resultcheck != 1){ // If there is not 1 result
            array_push($errors, "Il destinatario non esiste"); 
        }

    }

    if (count($errors) == 0) { // If there are no errors
        $row = mysqli_fetch_assoc($result);
        $to_id = $row['id'];
        $sql = "INSERT INTO msg (from_username, to_username, msg, title, date) VALUES ('$id', '$to_id', '$msg_form', '$title_form', '$date');";
        mysqli_query($conn, $sql);
        header('location: ../index?message-sent');
        die();
    } else {
        $_SESSION["showErrors"] = $errors;
        header('location: ' . $redirectProfile);
         die();
    }
}