<style>
    img {
        max-width: 100%;
        height: auto;
    }
</style>
<?php
include '../inc/header.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = basename($actual_link);
$permalink_url = stringEscape($actual_link, $conn);

$sql = "SELECT * FROM posts WHERE permalink = '$permalink_url' and ban != 1";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){ // If there is 1 result
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['title'];
            $id = $row['id'];
            $username = $row['username'];
            $msg = $row['msg'];
            $date = $row['date'];
            $date = date("d M Y - H:i", strtotime($date));
            $closed = $row['closed'];

            $sql_1 = "SELECT * FROM users WHERE id = '$username'";
            $result_1 = mysqli_query($conn, $sql_1);
            $resultcheck_1 = mysqli_num_rows($result_1);
            $row_1 = mysqli_fetch_assoc($result_1);
            $propic = $row_1['propic'];
            $role = $row_1['role'];
            $badges = $row_1['badges'];
            $username_post = $row_1['username'];
            $website = $row_1['website'];
            if($propic == ''){
             $propic = "/img/utente.jpg";
            }

        }
    } else {
        header("Location: ../404.php");
        die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
</html>
			
						
    <title><?php echo $title; ?> | ForumJuve</title>

</head>

<body class="dark-bg">

    <div class="container">
        <div class="jumbotron jumbotron-fluid mt-3 pb-3 mb-0 pt-3 dark-bg-1">
        <?php
        if($closed == 1){
        echo '<div class="alert third mx-3 rounded-lg text-light" role="alert">
        Questa discussione è stata chiusa da un amministratore
        </div>';
        }
        ?>
            <div class="row ml-3 mr-3 pt-3 pb-3 dark-bg-2 text-light pl-3 pr-3">
                <div class="col-sm-3 mr-0 pr-0 py-4 pl-0 dark-bg-1 text-light">
                    <img src="<?php echo $propic; ?>" class="rounded mx-auto d-block" alt="..."
                        style="object-fit: cover; width:200px; height:200px; ">
                    <div class="text-center text-break pr-3 pl-3 ">
                    <a href="../user/<?php echo $username_post; ?>" class="text-light"><h5 class="mt-2"><?php echo $username_post; ?></h5></a>
                        <?php echo badgeGroup($role, $username, $badges, $conn); ?>
                        <span class="mt-2"><?php echo website($website); ?></span>
                    </div>
                </div>

                <div class="col-sm-9 pl-0 ml-0">
                    <div class="text-left mx-4">
                        <h4 class="mb-0"><?php echo $title; ?></h4>
                        <p class="text-muted"><?php echo $date; ?></p>
                        <p class="mt-3 comment"><?php echo $msg; ?></p>
                    </div>
                </div>
            </div>
        
<?php
$sql_2 = "SELECT * FROM comments WHERE permalink_post = '$permalink_url'";
$result_2 = mysqli_query($conn, $sql_2);
$resultcheck_2 = mysqli_num_rows($result_2);

if($resultcheck_2 > 0){ // If there is 1 result
    while($row_2 = mysqli_fetch_assoc($result_2)){
        $id_user_comment = $row_2['username'];
        $id_comment = $row_2['id'];
        $msg_comment = $row_2['msg'];
        $ban_comment = $row_2['ban'];
        $date_comment = $row_2['date'];
        $date_comment = date("d M Y - H:i", strtotime($date_comment));
        if($ban_comment == 1){
            $msg_comment = "QUESTO MESSAGGIO E' STATO ELIMINATO DA UN MODERATORE";
        }

        $sql_3 = "SELECT * FROM users WHERE id = '$id_user_comment'";
        $result_3 = mysqli_query($conn, $sql_3);
        $resultcheck_3 = mysqli_num_rows($result_3);
        $row_3 = mysqli_fetch_assoc($result_3);

        $id_comment_username = $row_3['id'];
        $username_comment = $row_3['username'];
        $propic_comment = $row_3['propic'];
        $badges_comment = $row_3['badges'];
        $role_comment = $row_3['role'];
        $website_comment = $row_3['website'];
        if($propic_comment == ''){
         $propic_comment = "/img/utente.jpg";
        }
        echo '
        <div class="row ml-3 mr-3 pt-3 pb-3 dark-bg-2 text-light pl-3 mt-3 pr-3" id="'.$id_comment.'">
        <div class="col-sm-3 mr-0 pr-0 py-4 pl-0 dark-bg-1 text-light">
            <img src="'.$propic_comment.'" class=" mx-auto d-block" alt="..."
                style="object-fit: cover; width:200px; height:200px; ">
            <div class="text-center text-break pr-3 pl-3 ">
            <a href="../user/'.$username_comment.'" class="text-light"><h5 class="mt-2">'.$username_comment.'</h5></a>
                '.badgeGroup($role_comment, $id_comment_username, $badges_comment, $conn).'
                <span class="mt-2">'.website($website_comment).'</span>
            </div>
        </div>

        <div class="col-sm-9 pl-0 ml-0">
            <div class="text-left mx-4">
                <p class="text-muted">'.$date_comment.'</p>
                <p class="comment">'.$msg_comment.'</p>
            </div>
        </div>
    </div>
        
        ';
    }

    }
?>

        
            </div>
        </div>
    </div>

<?php

if($closed != 1){
    if(loginCheck()){
        $username = loginCheck()[1];
        $email = loginCheck()[2];
        $id = loginCheck()[3];

        if($ban == 1){
            echo '<div class="container mt-3">
            <div class="alert third rounded-lg text-light" role="alert">
            Non puoi commentare poichè sei stato bannato.
          </div>
          </div>';
        } else {

        $_SESSION["new-comment"] = array($permalink_url);; // Puts the Errors Array in the session, so it's visible from other pages
        echo '
        <div class="container">
        <div class="jumbotron jumbotron-fluid mt-3 pb-3 mb-0 pt-3 dark-bg-1">
            <div class="ml-3 mr-3 pt-3 pb-3 text-light dark-bg-2">
            <form action="../inc/new-comment.php" method="POST" enctype="multipart/form-data" class="pl-5 pr-5">
                            <div class="form-group">
                                <h3>Aggiungi una risposta pubblica</h3>
                                <div class="trumbowyg-dark">
                                <textarea class="form-control " id="my-editor" name="msg_comment" rows="5"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn third text-light" value="submit_comment"
                                name="submit_comment">Invia</button>
                        </form>
            </div>
        </div>
    </div>
        ';
    }
    } else {
        echo '
        <div class="container mt-2">
        <div class="alert third rounded-lg text-light" role="alert">
        Devi essere loggato per poter scrivere! <a href="../login" class="text-light"><button type="button" class="btn btn-sm align-baseline dark-bg-1 text-light">Login <ion-icon name="log-in"></ion-icon></button></a>
      </div>
      </div>';
    }
} else {
    echo '
    <div class="container mt-3">
    <div class="alert third rounded-lg text-light" role="alert">
    Questa discussione è stata chiusa da un amministratore.
  </div>
  </div>';
}
?>

    <?php include '../inc/footer.php'; ?>

</html>