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
    $pwd = loginCheck()[4];
  }

$_SESSION["showErrors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectProfile = "../profile"; // Path to redirect

if(isset($_POST['submit_profile'])){ // If the login form is submitted
    // // Escapes dangerous characters
    $username_form = stringEscape($_POST['username_form'], $conn);
    $name_form = stringEscape($_POST['name_form'], $conn);
    $website_form = stringEscape($_POST['website_form'], $conn);
    $sex_form = stringEscape($_POST['sex_form'], $conn);
    $city_form = stringEscape($_POST['city_form'], $conn);
    $dofbirth_form = stringEscape($_POST['dofbirth_form'], $conn);
    $bio_form = stringEscape($_POST['bio_form'], $conn);
    $img_form = stringEscape($_POST['img_form'], $conn);
    
    // Creates error messages
    if (empty($username)) { array_push($errors, "L'username è obbligatorio"); }
    if (empty($email)) { array_push($errors, "L'email è obbligatoria"); }
    if(strlen($bio_form) >= 700){array_push($errors, "La bio è troppo lunga! Supera i 700 caratteri");}
    if (!@GetImageSize($img_form) AND $img_form != "/img/utente.jpg" AND $img_form != "") {
        array_push($errors, "L'immagine non è valida");
    }
    if(!valid_email($email)){
        array_push($errors, "L'email contiene caratteri non validi");
    }
    if(!valid_username($username_form)){
        array_push($errors, "L'username contiene caratteri non validi");
    }
    if ($website_form != ""){
        if (!preg_match('/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)/', $website_form)){
            array_push($errors, "Il sito web contiene caratteri non validi");
        } 
    }
    if ($name_form != ""){
        if (!preg_match('/^[a-zA-Z\'èòàù]+(([",. -][a-zA-Z \'òàèù])?[a-zA-Z\'èòàù]*)*$/', $name_form)){
            array_push($errors, "Il nome contiene caratteri non validi");
        } 
    }
    if ($sex_form != 1 OR $sex_form != 2){
        array_push($errors, "Il sesso non è valido");
    }
    $sql = "SELECT * FROM users WHERE id != '$id' AND username = '$username_form'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck > 0){ // If the account already exists
        array_push($errors, "L'username non è disponibili");
        $_SESSION["showErrors"] = $errors;
    }

    if (count($errors) == 0) { // If there are no errors
        $sql = "UPDATE users SET username = '$username_form', name = '$name_form', bio = '$bio_form', sex = '$sex_form', website = '$website_form', city = '$city_form', propic = '$img_form' WHERE id = '$id';";
        mysqli_query($conn, $sql);
        loginProfile($id, $pwd, $conn);
    } else {
        $_SESSION["showErrors"] = $errors;
        header('location: ' . $redirectProfile);
         die();
    }
}