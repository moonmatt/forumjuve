<?php
$message = array(); 
$_SESSION["showErrors"] = $message; // Puts the Errors Array in the session, so it's visible from other pages
include "header.php";
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = basename($actual_link);
$permalink_url = stringEscape($actual_link, $conn);
$permalink_url = substr($permalink_url, strpos($permalink_url, "?") + 1);    
$email = strtok($permalink_url, '?');
$permalink_url = explode('?token=', $permalink_url);
$token = $permalink_url[1];
$email =  stringEscape($email, $conn);
$token =  stringEscape($token, $conn);

$sql = "SELECT * FROM users WHERE email = '$email' AND token = '$token' AND isVerified != 1";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);
echo $resultcheck;
if($resultcheck == 1){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $pwd = $row['pwd'];
        }
        $sql = "UPDATE users SET isVerified = 1 WHERE email = '$email' AND token = '$token';";
        mysqli_query($conn, $sql);
        header("location: ../login");
        array_push($message, "L'email è stata confermata");
        $_SESSION["showErrors"] = $message;
} else {
    header("location: /index?non-trovato");
    die();
}

?>