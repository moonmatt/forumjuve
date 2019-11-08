<?php
session_start();
if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
    unset($_SESSION["success"]);
    header("Location: /login/");
} else {
  header("Location: /login/");
}