<?php
$redirect = "/forumjuve"; // Path to redirect
session_start();
if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
    unset($_SESSION["success"]);
    header("Location: " . $redirect);
} else {
    header("Location: " . $redirect);
}