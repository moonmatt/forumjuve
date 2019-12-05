<?php

// Escapes dangerous strings 

function stringEscape($string, $conn){
    $string = mysqli_real_escape_string($conn, $string);
    // $string = htmlspecialchars($string);
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
            echo '<div class="alert alert-warning" role="alert"> '.$error.' </div>'; 
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
            echo '<div class="alert alert-warning" role="alert"> '.$error.' </div>'; 
        }
        unset($_SESSION["profile_errors"]);
    }
}

// Profile Error messages

function newPostErrors(){
    if(isset($_SESSION['newPost_errors']) && !empty($_SESSION['newPost_errors'])) {
        $error = $_SESSION["newPost_errors"];

        foreach($error as $error){
            echo '<div class="alert alert-warning" role="alert"> '.$error.' </div>'; 
        }
        unset($_SESSION["newPost_errors"]);
    }
}

// Profile Error messages

function newComment(){
    if(isset($_SESSION['newComment_errors']) && !empty($_SESSION['newComment_errors'])) {
        $error = $_SESSION["newComment_errors"];

        foreach($error as $error){
            echo '<div class="alert alert-warning" role="alert"> '.$error.' </div>'; 
        }
        unset($_SESSION["newComment_errors"]);
    }
}

// Send Msg Error messages

function sendMsgErrors(){
    if(isset($_SESSION['sendMsg_errors']) && !empty($_SESSION['sendMsg_errors'])) {
        $error = $_SESSION["sendMsg_errors"];

        foreach($error as $error){
            echo '<div class="alert alert-warning" role="alert"> '.$error.' </div>'; 
        }
        unset($_SESSION["sendMsg_errors"]);
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

// Valid email RegEx

function valid_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,24}$/ix", $str)) ? FALSE : TRUE;
}

// Valid username RegEx

function valid_username($str) {
    return (!preg_match("/^[a-zA-Z0-9-_]*$/", $str)) ? FALSE : TRUE;
}

// Auto Login

function autoLogin($username, $password, $conn){
    $username = stringEscape($_POST['username'], $conn); // Escapes dangerous characters
    $password = stringEscape($_POST['password'], $conn); // Escapes dangerous characters

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){ // If there is 1 result
        while($row = mysqli_fetch_assoc($result)){
            $pwd = $row['pwd'];
            $username = $row['username'];
            $email = $row['email'];
            $id = $row['id'];
            if(password_verify($password, $pwd)){ // If password is correct
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $id;
                $_SESSION['pwd'] = $pwd;
                $_SESSION['success'] = "You are now logged in";
                header('location: ../index');
                die();
            } else { // If password is not correct
                header('location: ../index');
                die();
            }
        }
    }
}


function roleBadge($role, $conn){
	$sql = "SELECT * FROM roles";
	$result = mysqli_query($conn, $sql);
	$resultcheck = mysqli_num_rows($result);
	while($row = mysqli_fetch_assoc($result)){
			$name = $row['name'];
			if($role == $name){
                $image = $row['image'];
				return('<img src="'.$image.'" class="mx-auto d-block mb-1" width="132" height="auto" title="'.$name.'">');
			}
	}
}

function postBadge($usernameId, $conn) {
    include 'dbh.inc.php';
    $numberOfPostsSql = "SELECT * FROM comments, posts WHERE comments.username = '$usernameId' AND posts.username = '$usernameId'";
    $numberOfPostsResult = mysqli_query($conn, $numberOfPostsSql);
    $numberOfPostResultCount = mysqli_num_rows($numberOfPostsResult);

    $sql = "SELECT * FROM postbadges";
	$result = mysqli_query($conn, $sql);
	$resultcheck = mysqli_num_rows($result);
	while($row = mysqli_fetch_assoc($result)){
            $value = $row['value'];
			if($numberOfPostResultCount < $value){
                $name = $row['name'];
                $image = $row['image'];
				return('<img src="'.$image.'" class="mx-auto d-block mb-1" width="132" height="auto" title="'.$name.' - '.$numberOfPostResultCount.'">');
			}
	}
}

function allBadges($badges, $conn){
	$badges = explode(",", $badges);
	$sql = "SELECT * FROM badges";
	$result = mysqli_query($conn, $sql);
	$resultcheck = mysqli_num_rows($result);
	$total = array(); 
	while($row = mysqli_fetch_assoc($result)){
    		foreach ($badges as $badge) {
			$badge = trim($badge);
			$name = $row['name'];
			if($badge == $name){
                $title = $row['title'];
                $image = $row['image'];
				$badge_arr = array(True,$title,$image);
				array_push($total, $badge_arr);
			}
		}
	}
	return $total;
}

function badgeGroup($role, $usernameId, $badges, $conn){
    $role = roleBadge($role, $conn);
    $postBadge = postBadge($usernameId, $conn);
    $allBadges = "";
    foreach(allBadges($badges, $conn) as $badge){
        $allBadges = "<img class='mx-auto d-block my-1' width='132' height='auto' title='".$badge[1]."' src='/forumjuve/".$badge[2]."'>";
    } 
    return $role . $postBadge . $allBadges;
}

function website($website){
    if($website != ''){
        $website = "<a href='".$website."' target='_blank' class='mt-2'>Sito web <i class='fas fa-link'></i></a>";
    } else {
        $website = "";
    }
    return $website;
}

// Permalink

function permalink($string) {
    $string = strtolower($string);
    $string = preg_replace("/[^0-9A-Za-z ]/", "", $string);
    $string = str_replace(" ", "-", $string);
    while (strstr($string, "--")) {
    $string = preg_replace("/--/", "-", $string);
            }
    return($string);
    }