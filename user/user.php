<?php
include '../inc/header.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = basename($actual_link);
$username = stringEscape($actual_link, $conn);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);



    if($resultcheck == 1){ // If there is 1 result
        while($row = mysqli_fetch_assoc($result)){
            $username_id = $row['id'];
            $username_1 = $row['username'];
            $email_1 = $row['email'];
            $date = $row['date'];
            $date = date("d M Y", strtotime($date));
            $ban = $row['ban'];
            $badges = $row['badges'];
            $name = $row['name'];
            $bio = $row['bio'];
            $website = $row['website'];
            $sex = $row['sex'];
            $dofbirth = $row['dofbirth'];
            $propic = $row['propic'];
            $city = $row['city']; 
            $role = $row['role'];

            if($ban == 1){
                $ban = ' <span class="badge third">Bannato</span>';
            } else {
                  $ban = "";
            }

            if($name != ''){
                $name = '<h4>Nome</h4> <p class="lead">'.$name.'</p>';
            }

            if($website != ''){
                $website = '<h4>Link</h4> <p class="lead">'.website($website).'</p>';
            }

            if($dofbirth != "0000-00-00"){ // If date of birth is not set
              $dofbirth = date("d M Y", strtotime($dofbirth));
              $dofbirth = '<h4>Data di nascita</h4> <p class="lead">'.$dofbirth.'</p>';
            } else {
                $dofbirth = "";
            }

            if($sex == 1){ // Check the sex of user
                $sex = '<h4>Sesso</h4> <p class="lead">Maschio</p>';
            } elseif ($sex == 2) {
                $sex = '<h4>Sesso</h4> <p class="lead">Femmina</p>';
            }
            elseif ($sex == 0) {
              $sex = "";
            }

            if($city != ''){
                $city = '<h4>Città</h4> <p class="lead">'.$city.'</p>';
            }

            if($bio != ''){
                $bio = '<h4>Biografia</h4> <p class="lead">'.$bio.'</p>';
            }

            if($propic == ''){
              $propic = "/forumjuve/img/utente.jpg";
            }


            $postsListSql = "SELECT * FROM posts WHERE username = '$username_id' and ban != 1 ORDER BY id DESC";
            $postsNumResult = mysqli_query($conn, $postsListSql);
            $postNumResultCount = mysqli_num_rows($postsNumResult);

            $commentsListSql = "SELECT * FROM comments WHERE username = '$username_id' and ban != 1 ORDER BY id DESC";
            $commentsNumResult = mysqli_query($conn, $commentsListSql);
            $commentsNumResultCount = mysqli_num_rows($commentsNumResult);

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?php echo $username_1; ?> | ForumJuve</title>


</head>

<body class="dark-bg d-flex flex-column">

<div class="jumbotron jumbotron-fluid pt-3 pb-3 dark-bg-1 text-light">
            <div class="container">
                <div class="row">

                    <div class="col-sm-8 align-self-center">
                        <h1 class="display-4"><?php echo $username . $ban?></h1>
                        <p class="lead">Utente dal <?php echo $date; ?></p>
                    </div>

                    <div class="col-sm-4 align-right text-right">
                        <img src="<?php echo $propic; ?>" alt="..."
                            style="object-fit: cover; width:200px; height:200px; " class="rounded">
                    </div>

                </div>
            </div>

        </div>

    <div class="container">




        <div class="row">

            <div class="col-sm-4 float-right">
                <div class="jumbotron jumbotron-fluid p-2 dark-bg-1 text-light">
                <p class="h3 py-2 px-2">Informazioni</p>
                    <div class="container">
                        <?php echo $name; ?>
                        <?php echo $dofbirth; ?>
                        <?php echo $website; ?>
                        <?php echo $sex; ?>
                        <?php echo $city; ?>
                        <?php echo $bio; ?>
                        <h4>Targhette</h4> <p class="lead d-inline-block m-0">
                        <?php 
                        echo badgeGroup($role, $username_id, $badges, $conn);
                        ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 float-left">
                <div class="jumbotron jumbotron-fluid dark-bg-1 text-light py-3">
                    <div class="container">
                        <p class="h3 py-2">Post dell'utente</p>
                        <p class="lead">Ecco le attività di <?php echo $username; ?> su ForumJuve</p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active text-secondary" id="home-tab" data-toggle="tab" href="#post" role="tab" aria-controls="post" aria-selected="true">Post (<?php echo $postNumResultCount;?>)</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text-secondary" id="profile-tab" data-toggle="tab" href="#risposte" role="tab" aria-controls="risposte" aria-selected="false">Risposte (<?php echo $commentsNumResultCount;?>)</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active pt-3" id="post" role="tabpanel" aria-labelledby="home-tab">
  <!-- POSTS -->
    <?php
        if($postNumResultCount > 0){ // If there is 1 result
            while($row_2 = mysqli_fetch_assoc($postsNumResult)){
                $title = $row_2['title'];
                $date = $row_2['date'];
                $id_post = $row_2['username'];
                $status = $row_2['closed'];
                $permalink_post = $row_2['permalink'];

                $sql_5 = "SELECT * FROM users WHERE id = '$id_post'";
                $result_5 = mysqli_query($conn, $sql_5);
                $resultcheck_5 = mysqli_num_rows($result_5);
                $row_5 = mysqli_fetch_assoc($result_5);
                $propic = $row_5['propic'];
                $username_post = $row_5['username'];
                $role = $row_5['role'];
                if($propic == ''){
                  $propic = "/forumjuve/img/utente.jpg";
                 }
                 if($status == 1){
                    $status = '<span class="badge badge-danger shadow">Chiuso <ion-icon name="close"></ion-icon></span>';
                } else {
                    $status = '<span class="badge third text-light shadow">Aperto <ion-icon name="globe"></ion-icon></span>';
                }

                $sql_6 = "SELECT * FROM comments WHERE permalink_post = '$permalink_post'";
                $result_6 = mysqli_query($conn, $sql_6);
                $resultcheck_6 = mysqli_num_rows($result_6);

                echo '
                <div class="jumbotron jumbotron-fluid p-2 mb-3 dark-bg-2 text-light">
                <div class="row p-1 pt-0 mt-0 pb-0">
                <div class="col-2 ">
                <img src="'.$propic.'" class="rounded mx-auto d-block" alt="..." style="object-fit: cover; width:50px; height:50px; ">
                </div>
                <div class="col-7">
                <h6 class="mb-0"><a href="../p/'.$permalink_post.'" class="text-light">'.$title.'</a></h6>
                <p class="pt-0"><a href="../user/'.$username_post.'" class="text-light">'.$username_post.'</a> - '.$date.'</p>
                </div>
                <div class="col-3 text-right pl-0 ml-0">
                <span class="mb-0 pb-0 mb-0"><span class="badge third shadow">'.$resultcheck_6.' <ion-icon name="chatboxes"></ion-icon> </span></span> <br>
                <span class="mb-0 pt-0 mt-0">'.$status.'</span>
                </div>
                </div>
                </div>
                ';
            }
        }
    ?>
  <!-- /POSTS -->
  </div>
  <div class="tab-pane fade pt-3" id="risposte" role="tabpanel" aria-labelledby="profile-tab">
    <!-- COMMENTS -->
    <?php
        if($commentsNumResultCount > 0){ // If there is 1 result
            while($row_7 = mysqli_fetch_assoc($commentsNumResult)){
                $id_comment = $row_7['username'];
                $id_comment_1 = $row_7['id'];
                $permalink_comment = $row_7['permalink_post'];
                $date_comment = $row_7['date'];
                $date_comment = date("d/m/Y - H:i", strtotime($date_comment));
                     
                $sql_8 = "SELECT * FROM users WHERE id = '$id_comment'";
                $result_8 = mysqli_query($conn, $sql_8);
                $resultcheck_8 = mysqli_num_rows($result_8);
                $row_8 = mysqli_fetch_assoc($result_8);
                $propic_8 = $row_8['propic'];
                $username_post = $row_8['username'];
                $role = $row_8['role'];
                if($propic_8 == ''){
                    $propic_8 = "/forumjuve/img/utente.jpg";
                }

                $sql_4 = "SELECT * FROM posts WHERE permalink = '$permalink_comment'";
                $result_4 = mysqli_query($conn, $sql_4);
                $resultcheck_4 = mysqli_num_rows($result_4);
                $row_4 = mysqli_fetch_assoc($result_4);
                $title_comment = $row_4['title'];
                $status = $row_4['closed'];
                if($status == 1){
                    $status = '<span class="badge badge-danger shadow">Chiuso <ion-icon name="close"></ion-icon></span>';
                } else {
                    $status = '<span class="badge third text-light shadow">Aperto <ion-icon name="globe"></ion-icon></span>';
                }

                $sql_9 = "SELECT * FROM comments WHERE permalink_post = '$permalink_comment'";
                $result_9 = mysqli_query($conn, $sql_9);
                $resultcheck_9 = mysqli_num_rows($result_9);
                     
                             echo '
                            <div class="jumbotron jumbotron-fluid p-2 mb-3 dark-bg-2 text-light">
                            <div class="row p-1 pt-0 mt-0 pb-0">
                            <div class="col-2">
                            <a href="user/'.$username_post.'">
                            <img title="'.$username_post.'" src="'.$propic_8.'" class="rounded mx-auto d-block " alt="..." style="object-fit: cover; width:50px; height:50px; ">
                            </a>
                            </div>
                            <div class="col-7">
                            <h6 class="mb-0"><a href="../p/'.$permalink_comment.'#'.$id_comment_1.'" class="text-light">'.$title_comment.'</a></h6>
                            <p class="pt-0">'.$date_comment.'</p>
                            </div>
                            <div class="col-3 text-right pl-0 ml-0">
                            <span class="mb-0 pb-0 mb-0"><span class="badge third shadow">'.$resultcheck_9.' <ion-icon name="chatboxes"></ion-icon> </span></span> <br>
                            <span class="mb-0 pt-0 mt-0">'.$status.'</span>
                            </div>
                            </div>
                            </div>
                             ';
                            }
                        }
                        ?>
  <!-- /COMMENTS -->
  </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include '../inc/footer.php'; ?>

</html>