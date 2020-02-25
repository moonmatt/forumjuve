<?php

// Requires database and functions 
require_once 'dbh.inc.php';
require 'functions.php';

// Creates the errors array
$errors = array(); 

// Starts the session
session_start();

$_SESSION["showErrors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectLogin = "../login"; // Path to redirect



if(isset($_POST['submit'])){ // If the login form is submitted
    $username = stringEscape($_POST['username'], $conn); // Escapes dangerous characters
    $password = stringEscape($_POST['password'], $conn); // Escapes dangerous characters

    if (empty($username)) { array_push($errors, "L'username è obbligatorio"); }
    if (empty($password)) { array_push($errors, "La password è obbligatoria"); }
    if(!valid_username($username)){
        array_push($errors, "L'username contiene caratteri non validi");
    }
    if (count($errors) == 0) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);

        if($resultcheck == 1){ // If there is 1 result
            while($row = mysqli_fetch_assoc($result)){
                $pwd = $row['pwd'];
                $username = $row['username'];
                $email = $row['email'];
                $id = $row['id'];
                $ban = $row['ban'];
                $isVerified = $row['isVerified'];
                if($isVerified == 0){
                   array_push($errors, "L'email non è stata confermata");
                   $_SESSION["showErrors"] = $errors;
                   header('location: ' . $redirectLogin);
                   die(); 
                }
                if(password_verify($password, $pwd)){ // If password is correct
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['pwd'] = $pwd;
                    $_SESSION['ban'] = $ban;
                    $_SESSION['success'] = "You are now logged in";
                    header('location: ' . $redirect);
                    die();
                } else { // If password is not correct
                    array_push($errors, "L'username o la password sono sbagliati");
                    $_SESSION["showErrors"] = $errors;
                    header('location: ' . $redirectLogin);
                    die();
                }
            }
        } else { // If there are no results
            array_push($errors, "L'username o la password sono sbagliati");
            $_SESSION["showErrors"] = $errors;
            header('location: ' . $redirectLogin);
            die();
        }
    } 
    $_SESSION["showErrors"] = $errors;
    header('location: ' . $redirectLogin);
    die();
}