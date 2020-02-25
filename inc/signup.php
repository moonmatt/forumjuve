<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Requires database and functions 
require_once 'dbh.inc.php';
require 'functions.php';

// Creates the errors array
$errors = array(); 

// Starts the session
session_start();

$_SESSION["showErrors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectSignUp = "../signup"; // Path to redirect

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
      $_SESSION["showErrors"] = $errors;
    }

    if (count($errors) == 0) {
        $sql = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);

        if($resultcheck == 1){ // If the account already exists
            while($user = mysqli_fetch_assoc($result)){
                if ($user['username'] === $username) {
                    array_push($errors, "L'username è già stato usato");
                    $_SESSION["showErrors"] = $errors;
                    header('location: ' . $redirectSignUp);
                    die();
                }

                if ($user['email'] === $email) {
                    array_push($errors, "L'email è già stata usata");
                    $_SESSION["showErrors"] = $errors;
                    header('location: ' . $redirectSignUp);
                    die();
                }
            }
        }
    }

    if (count($errors) == 0) { // If there are no errors
        $token = "fiuehfiwhfjikhweifgwefbjvodivuiuupsoaioasusoDUIOVHSDUIVGYUSDVHJDGVBDCHHDUIC16782932372920237539429823675372378978925";
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);
        verificationEmail($email, $token);
        $password = hashPassword($password);
        $sql = "INSERT INTO users (username, email, pwd, date, token, isVerified) VALUES ('$username', '$email', '$password', '$date', '$token', 0);";
        mysqli_query($conn, $sql);
        header("location: /email");
        die();
    } else {
        $_SESSION["showErrors"] = $errors;
        header('location: ' . $redirectSignUp);
        die();
    }
}