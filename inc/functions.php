<?php

// Escapes dangerous strings 

function stringEscape($string, $conn){
    $string = mysqli_real_escape_string($conn, $string);
    return $string;
}
 

// Password Hash

function hashPassword($password){  
    $password = password_hash($password, PASSWORD_BCRYPT);
    return $password;
}

// Signup Error messages

function signupErrors(){
    if(isset($_SESSION['signup_errors']) && !empty($_SESSION['signup_errors'])) {
        $error = $_SESSION["signup_errors"];

        foreach($error as $error){
            echo $error . "<br>";
        }
        unset($_SESSION["signup_errors"]);
    }
}

// Login Error messages
function loginErrors(){
    if(isset($_SESSION['login_errors']) && !empty($_SESSION['login_errors'])) {
        $error = $_SESSION["login_errors"];

        foreach($error as $error){
            echo $error . "<br>";
        }
        unset($_SESSION["login_errors"]);
    }
}

// Profile Error messages

function profileErrors(){
    if(isset($_SESSION['profile_errors']) && !empty($_SESSION['profile_errors'])) {
        $error = $_SESSION["profile_errors"];

        foreach($error as $error){
            echo $error . "<br>";
        }
        unset($_SESSION["profile_errors"]);
    }
}

// Login Check

function loginCheck(){
    if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
        $username = $_SESSION["username"];
        $email = $_SESSION["email"];
        $id = $_SESSION["id"];
        return array(True, $username, $email, $id);
      } else {
        return False;
      }
}
