<?php include 'inc/header.php'; ?>


<?php
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_link = basename($actual_link);
    $linkNum = stringEscape($actual_link, $conn);
    $linkNum = substr($linkNum, 1);
    if(is_numeric($linkNum) and $linkNum != 1){
        $pzero = false;
        $offset = $linkNum * 5 - 5;

        $sql = "SELECT * FROM posts";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        $max = ceil($resultcheck / 5);

        $sql = "SELECT * FROM posts order by id DESC LIMIT 5 OFFSET $offset";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        if($linkNum > $max){
            header("location: /forumjuve");
        }
    } else {
        $max = 0;
        $linkNum = 1;
        $pzero = true;
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
    }

    $sql_2 = "SELECT * FROM comments ORDER BY date DESC LIMIT 5";
    $result_2 = mysqli_query($conn, $sql_2);
    $resultcheck_2 = mysqli_num_rows($result_2);
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

            <div class="jumbotron jumbotron-fluid px-3 py-1">
            <p class="h3 py-2">Post recenti</p>
                <?php
    if($resultcheck > 0){ // If there is 1 result
      while($row = mysqli_fetch_assoc($result)){
        $id_post = $row['username'];
        $title_post = $row['title'];
        $status = $row['closed'];
        $permalink_post = $row['permalink'];
        $date_post = $row['date'];
        $date_post = date("d/m/Y - H:i", strtotime($date_post));
        if($status == 1){
            $status = 'Chiuso <i class="fas fa-door-closed"></i>';
        } else {
            $status = 'Aperto <i class="fas fa-door-open"></i>';
        }

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

         $sql_4 = "SELECT * FROM comments WHERE permalink_post = '$permalink_post'";
         $result_4 = mysqli_query($conn, $sql_4);
         $resultcheck_4 = mysqli_num_rows($result_4);

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
        <span class="mb-0 pb-0 mb-0">'.$resultcheck_4.' <i class="fas fa-comment"></i></span> <br>
        <span class="mb-0 pt-0 mt-0">'.$status.'</span>
        </div>
        </div>
        </div>
        ';
      }
    }
    ?>
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if($pzero){ echo "disabled"; }?>">
      <a class="page-link" href="?<?php echo $linkNum - 1;?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link"><?php echo $linkNum;?></a></li>
    <li class="page-item <?php if($linkNum == $max) { echo "disabled";} ?>">
      <a class="page-link " href="?<?php if($linkNum != $max) { echo $linkNum + 1;} ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>
            </div>

            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid py-1">
                    <div class="container">
                    <p class="h3 py-2">Risposte recenti</p>
                        <?php
                         if($resultcheck_2 > 0){ // If there is 1 result
                           while($row_2 = mysqli_fetch_assoc($result_2)){
                             $id_comment = $row_2['username'];
                             $id_comment_1 = $row_2['id'];
                             $permalink_comment = $row_2['permalink_post'];
                             $date_comment = $row_2['date'];
                             $date_comment = date("d/m/Y - H:i", strtotime($date_comment));
                     
                             $sql_3 = "SELECT * FROM users WHERE id = '$id_comment'";
                             $result_3 = mysqli_query($conn, $sql_3);
                             $resultcheck_3 = mysqli_num_rows($result_3);
                             $row_3 = mysqli_fetch_assoc($result_3);
                             $propic_3 = $row_3['propic'];
                             $username_post = $row_3['username'];
                             $role = $row_3['role'];
                             if($propic_3 == ''){
                               $propic_3 = "/forumjuve/img/utente.jpg";
                              }

                              $sql_4 = "SELECT * FROM posts WHERE permalink = '$permalink_comment'";
                              $result_4 = mysqli_query($conn, $sql_4);
                              $resultcheck_4 = mysqli_num_rows($result_4);
                              $row_4 = mysqli_fetch_assoc($result_4);
                              $title_comment = $row_4['title'];
                     
                             echo '
                             <div class="jumbotron jumbotron-fluid bg-light p-0 mb-3">
                            <div class="row p-3 pt-2 mt-0 pb-0">
                            <div class="col-2">
                            <a href="user/'.$username_post.'">
                            <img title="'.$username_post.'" src="'.$propic_3.'" class="rounded mx-auto d-block" alt="..." style="object-fit: cover; width:45px; height:45px; ">
                            </a>
                            </div>
                            <div class="col-8 ml-2">
                            <h6 class="mb-0"><a href="p/'.$permalink_comment.'#'.$id_comment_1.'" class="text-dark">'.$title_comment.'</a></h6>
                            <p class="py-0 my-0">'.$date_post.'</p>
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
        </div>
    </div>





    <?php include 'inc/footer.php'; ?>

</html>