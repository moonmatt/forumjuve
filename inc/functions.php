<?php

// Escapes dangerous strings 

function stringEscape($string, $conn){
    $string = mysqli_real_escape_string($conn, $string);
    $string =  str_replace("<","&lt;", $string);
    $string =  str_replace(">","&gt;", $string);
    return $string;
}
function textareaEscape($string, $conn){
    $string = mysqli_real_escape_string($conn, $string);
    return $string;
}
 
// Password Hash

function hashPassword($password){  
    $password = password_hash($password, PASSWORD_BCRYPT);
    return $password;
}

// Show Errors

function showErrors(){
    if(isset($_SESSION['showErrors']) && !empty($_SESSION['showErrors'])) {
        $error = $_SESSION["showErrors"];

        foreach($error as $error){
            echo '<div class="alert third rounded-lg text-light" role="alert"> '.$error.' </div>'; 
        }
        unset($_SESSION["showErrors"]);
    }
}

// Login Check

function loginCheck(){
    if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
        $username = $_SESSION["username"];
        $email = $_SESSION["email"];
        $id = $_SESSION["id"];
        $pwd = $_SESSION["pwd"];
        $ban = $_SESSION["ban"];
        return array(True, $username, $email, $id, $pwd, $ban);
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
    if (preg_match('/^[a-zA-Z0-9_]{1,16}$/', $str)){
        return true;
    } else {
        return false;
    }
}

// Send verification email

function verificationEmail($email, $token) {
    
    $to = $email;

    $subject = 'Email di conferma ForumJuve';

    $headers = "From: ForumJuve \r\n";
    $headers .= "Reply-To: Te \r\n";
    $headers .= "CC: ".$email."\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = '<html><body>Ciao, benvenuto su ForumJuve!<br>Conferma il tuo indirizzo email e inizia subito a partecipare al Forum!<br><br>';
    $message .= 'Link conferma <br> <a href="https://forumjuve.cf/inc/email-verify?'.$email.'?token='.$token.'">https://forumjuve.cf/inc/email-verify?email?token=token</a><br><br>Se non hai fatto nessuna iscrizione cestina questa mail.<br><br>';
    $message .= '</body>Matteo Galavotti (moonmatt) | Founder e developer di ForumJuve</html>';
    mail($to, $subject, $message, $headers);
    return $token;
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
    $numberOfPostsSql_1 = "SELECT * FROM comments WHERE username = '$usernameId' AND ban != 1";
    $numberOfPostsSql_2 = "SELECT * FROM posts WHERE username = '$usernameId' AND ban != 1";
    $numberOfPostsResult_1 = mysqli_query($conn, $numberOfPostsSql_1);
    $numberOfPostsResult_2 = mysqli_query($conn, $numberOfPostsSql_2);
    $numberOfPostResultCount_1 = mysqli_num_rows($numberOfPostsResult_1);
    $numberOfPostResultCount_2 = mysqli_num_rows($numberOfPostsResult_2);
    
    $numberOfPostResultCount = $numberOfPostResultCount_1 + $numberOfPostResultCount_2;
    
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
        $allBadges = "<img class='mx-auto d-block my-1' width='132' height='auto' title='".$badge[1]."' src='".$badge[2]."'>";
    } 
    return $role . $postBadge . $allBadges;
}

function website($website){
    if($website != ''){
        $website = "<a href='".$website."' target='_blank' class='mt-2 text-light'>Sito web <ion-icon name='link'></ion-icon></a>";
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

// Check post permalink

function checkPermalink($permalink, $conn) {
    $sql = "SELECT * FROM posts WHERE permalink = '$permalink'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
    if($resultcheck >= 1) {
        $permalink = $permalink ."-". rand(9,999);
        return($permalink);
    } else {
        return($permalink);
    }
}

// Ban redirect

function banRedirect(){ 
    header("location: /forumjuve/ban");
}