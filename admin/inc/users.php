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
    echo $username;
    die();
}