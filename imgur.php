<?php
    function valid_email($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,24}$/ix", $str)) ? FALSE : TRUE;
    }
    function valid_username($str) {
        return (!preg_match("/^[a-zA-Z0-9-_]*$/", $str)) ? FALSE : TRUE;
    }
if(isset($_POST['submit'])){
        if(!valid_email($_POST['text'])){
        echo "Invalid email address.";
        }else{
        echo "Valid email address.";
        }
}
?>

<form action="" method="POST">
<input type="text" name="text">
<input type="submit" value="submit" name="submit">
</form>