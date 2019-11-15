<?php

// Escapes dangerous strings 

function stringEscape($string, $conn){
    $string = mysqli_real_escape_string($conn, $string);
    $string = htmlspecialchars($string);
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
            echo '<div class="alert alert-warning" role="alert"> '.$error.' </div>'; 
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
        $pwd = $_SESSION["pwd"];
        return array(True, $username, $email, $id, $pwd);
      } else {
        return False;
      }
}

// Login

function loginProfile($id, $password, $conn){
    if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {

        $password = stringEscape($password, $conn);

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        echo $sql;
        if($resultcheck == 1){ // If there is 1 result
            while($row = mysqli_fetch_assoc($result)){
                $pwd = $row['pwd'];
                $username = $row['username'];
                $email = $row['email'];
                $id = $row['id'];
                if($password == $pwd){ // If password is correct
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['success'] = "You are now logged in";
                    header('Location: ../profile');
                    die();
                } else { // If password is not correct
                    echo "password non corretta <br>";
                    echo "PASSWORD 1 : ". $pwd . "<br>";
                    echo "PASSWORD 2 : ". $password . "<br>";
                    die();
                }
            }
        }
      } else {
        return False;
      }
}