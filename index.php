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
                <?php
    if($resultcheck > 0){ // If there is 1 result
      while($row = mysqli_fetch_assoc($result)){
        $username_post = $row['username'];
        $title_post = $row['title'];
        $date_post = $row['date'];
        $msg_post = $row['msg'];
        $date_post = date("d M Y - H:i", strtotime($date_post));
        

        $sql_1 = "SELECT * FROM users WHERE username = '$username_post'";
        $result_1 = mysqli_query($conn, $sql_1);
        $resultcheck_1 = mysqli_num_rows($result_1);
        $row_1 = mysqli_fetch_assoc($result_1);
        $propic = $row_1['propic'];
        $role = $row_1['role'];
        if($propic == ''){
          $propic = "/forumjuve/img/utente.jpg";
         }

        echo '
        <div class="jumbotron jumbotron-fluid pt-3 pb-0 mb-0">
               <div class="row mb-3 mt-3">

                   <div class="col-sm-3">
                   <img src="'.$propic.'" class="rounded mx-auto d-block" alt="..." style="object-fit: cover; width:50px; height:50px; ">
                   <div class="text-center text-break pr-3 pl-3">
                   <h5 class="mt-2">'.$username_post.'</h5>
                   '.roleBadge($role).'
                   </div>
                   </div>

                   <div class="col-sm-9 pl-0 message">
                       <div class="text-left mx-4">
                           <h5 class="mb-0">'.$title_post.'</h5>
                           <p class="text-muted">'.$date_post.'</p>
                           <p class="mt-3">'.$msg_post.'</p>
                       </div>
                   </div>
               </div>
               <p class="text-right pr-3 pb-1">
               10 <i class="fas fa-comment"></i>
               </p>

           </div>
        ';
      }
    }
    ?>
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