<?php include 'inc/header.php'; ?>


<?php
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);
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

    <title>ForumJuve | Il forum dedicato a tutti i tifosi bianconeri</title>


</head>

<body class="bg-secondary d-flex flex-column">

    <div class="container">

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Juventus Forum</h1>
                <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-8">

            <div class="jumbotron jumbotron-fluid p-3">
                <?php
    if($resultcheck > 0){ // If there is 1 result
      while($row = mysqli_fetch_assoc($result)){
        $id_post = $row['username'];
        $title_post = $row['title'];
        $permalink_post = $row['permalink'];
        $date_post = $row['date'];
        $date_post = date("d/m/Y - H:i", strtotime($date_post));

        $sql_1 = "SELECT * FROM users WHERE id = '$id_post'";
        $result_1 = mysqli_query($conn, $sql_1);
        $resultcheck_1 = mysqli_num_rows($result_1);
        $row_1 = mysqli_fetch_assoc($result_1);
        $propic = $row_1['propic'];
        $username_post = $row_1['username'];
        $role = $row_1['role'];
        if($propic == ''){
          $propic = "/forumjuve/img/utente.jpg";
         }

        echo '

        <div class="jumbotron jumbotron-fluid bg-light p-0 mb-3">
        <div class="row p-3 pt-2 mt-0 pb-0">
        <div class="col-2">
        <img src="'.$propic.'" class="rounded mx-auto d-block" alt="..." style="object-fit: cover; width:50px; height:50px; ">
        </div>
        <div class="col-8">
        <h6 class="mb-0"><a href="p/'.$permalink_post.'" class="text-dark">'.$title_post.'</a></h6>
        <p class="pt-0"><a href="user/'.$username_post.'" class="text-dark">'.$username_post.'</a> - '.$date_post.'</p>
        </div>
        <div class="col-2 text-right">
        <span class="mb-0 pb-0 mb-0">10 <i class="fas fa-comment"></i></span> <br>
        <span class="mb-0 pt-0 mt-0">Segnala <i class="fas fa-flag"></i></span>
        </div>
        </div>
        </div>
        ';
      }
    }
    ?>
</div>
            </div>

            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Juventus Forum</h1>
                        <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include 'inc/footer.php'; ?>

</html>