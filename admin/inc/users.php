<?php
// Requires database and functions 
require_once '../../inc/dbh.inc.php';
require '../../inc/functions.php';
if(isset($_POST['submit_form_admin'])){
    $username = stringEscape($_POST['username_form'], $conn);
    $email = stringEscape($_POST['email_form'], $conn);
    $propic = stringEscape($_POST['propic_form'], $conn);
    $website = stringEscape($_POST['website_form'], $conn);
    $role = stringEscape($_POST['role_form'], $conn);
    $badges = stringEscape($_POST['badges_form'], $conn);
    $ban = stringEscape($_POST['ban_form'], $conn);
    $id = stringEscape($_POST['id_form'], $conn);

    // Creates error messages
    if (empty($username)) { array_push($errors, "L'username è obbligatorio"); }
    if (empty($email)) { array_push($errors, "L'email è obbligatoria"); }
    if(!valid_email($email)){
        array_push($errors, "L'email contiene caratteri non validi");
    }
    if(!valid_username($username)){
        array_push($errors, "L'username contiene caratteri non validi");
    }

    $sql = "SELECT * FROM users WHERE id != '$id' AND (username = '$username' OR email = '$email')";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck > 0){ // If the account already exists
        array_push($errors, "L'username o l'email non sono disponibili");
        echo "username già preso";
        die();
        $_SESSION["profile_errors"] = $errors;
    }
    echo "ciao";
    die();
}