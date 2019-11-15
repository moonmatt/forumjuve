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

$_SESSION["profile_errors"] = $errors; // Puts the Errors Array in the session, so it's visible from other pages

$redirect = "../"; // Path to redirect
$redirectProfile = "../profile"; // Path to redirect

if(isset($_POST['submit_profile'])){ // If the login form is submitted

    // // Escapes dangerous characters
    $username_form = stringEscape($_POST['username_form'], $conn);
    $email_form = stringEscape($_POST['email_form'], $conn);
    $name_form = stringEscape($_POST['name_form'], $conn);
    $website_form = stringEscape($_POST['website_form'], $conn);
    $sex_form = stringEscape($_POST['sex_form'], $conn);
    $city_form = stringEscape($_POST['city_form'], $conn);
    $dofbirth_form = stringEscape($_POST['dofbirth_form'], $conn);
    $bio_form = stringEscape($_POST['bio_form'], $conn);
    $img_user = stringEscape($_POST['img_user'], $conn);
    $img = $_FILES['img_form'];

    // Creates error messages
    if (empty($username)) { array_push($errors, "L'username è obbligatorio"); }
    if (empty($email)) { array_push($errors, "L'email è obbligatoria"); }
    if (preg_match('[^A-Za-z0-9-_]', $username_form)){
        array_push($errors, "L'username contiene caratteri non validi");
    }
    if (preg_match('[^A-Za-z0-9-_.@+]', $email_form)){
        array_push($errors, "L'email contiene caratteri non validi");
    }



    $sql = "SELECT * FROM users WHERE id != '$id' AND (username = '$username_form' OR email = '$email_form')";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck > 0){ // If the account already exists
        array_push($errors, "L'username è l'email non sono disponibili");
        $_SESSION["profile_errors"] = $errors;
    }

    if($img['name']==''){  
        $url_image = $img_user;
    } else {
        $filename = $img['tmp_name'];
        $client_id="2b7e06d3cb8a203";
        $handle = fopen($filename, "r");
        $data = fread($handle, filesize($filename));
        $pvars   = array('image' => base64_encode($data));
        $timeout = 30;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close ($curl);
        $pms = json_decode($out,true);
        $url=$pms['data']['link'];
        if($url!=""){
         $url_image = $url;
        }else{
         echo "<h2>There's a Problem</h2>";
         echo $pms['data']['error'];  
         die();
        } 
    }

    if (count($errors) == 0) { // If there are no errors
        $sql = "UPDATE users SET username = '$username_form', email = '$email_form', name = '$name_form', bio = '$bio_form', sex = '$sex_form', website = '$website_form', dofbirth = '$dofbirth_form', city = '$city_form', propic = '$url_image' WHERE id = '$id';";
        mysqli_query($conn, $sql);
        loginProfile($id, $pwd, $conn);
    } else {
        $_SESSION["signup_errors"] = $errors;
        header('location: ' . $redirectProfile);
         die();
    }
}