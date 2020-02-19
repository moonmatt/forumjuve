<?php
foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
    $temp = $_FILES["files"]["tmp_name"][$key];
    $name = $_FILES["files"]["name"][$key];
      
    if(empty($temp))
    {
        break;
    }
      
    move_uploaded_file($temp,"UploadFolder/".$name);
}

?>