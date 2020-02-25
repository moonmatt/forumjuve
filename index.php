<?php include 'inc/header.php'; ?>
<script src="https://kit.fontawesome.com/d2ce008e27.js" crossorigin="anonymous"></script>
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
        $sql = "SELECT * FROM posts WHERE ban != 1 ORDER BY id DESC LIMIT 5";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
    }
    $sql_2 = "SELECT * FROM comments WHERE ban != 1 ORDER BY date DESC LIMIT 5";
    $result_2 = mysqli_query($conn, $sql_2);
    $resultcheck_2 = mysqli_num_rows($result_2);
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <title>ForumJuve | Il forum dedicato a tutti i tifosi bianconeri</title>


</head>


<body class="dark-bg">
<div class="jumbotron jumbotron-fluid text-light dark-bg-1 shadow">
            <div class="container">
                <h1 class="display-4">Juventus Forum</h1>
                <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
            </div>

        </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-8">

            <div class="jumbotron jumbotron-fluid px-3 pt-3 pb-1 dark-bg-1">
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
            $status = '<span class="badge badge-danger shadow">Chiuso <i class="fas fa-door-closed"></i></span>';
        } else {
            $status = '<span class="badge third text-light shadow">Aperto <i class="fas fa-globe-europe"></i></span>';
        }
        $sql_1 = "SELECT * FROM users WHERE id = '$id_post'";
        $result_1 = mysqli_query($conn, $sql_1);
        $resultcheck_1 = mysqli_num_rows($result_1);
        $row_1 = mysqli_fetch_assoc($result_1);
        $propic = $row_1['propic'];
        $username_post = $row_1['username'];
        $role = $row_1['role'];
        if($propic == ''){
          $propic = "/img/utente.jpg";
         }
         $sql_4 = "SELECT * FROM comments WHERE permalink_post = '$permalink_post'";
         $result_4 = mysqli_query($conn, $sql_4);
         $resultcheck_4 = mysqli_num_rows($result_4);
        echo '

        <div class="jumbotron jumbotron-fluid p-2 mb-2 dark-bg-2 text-light">
        <div class="row p-1 py-0 my-0">
        <div class="col-2 d-none d-sm-block">
        <img src="'.$propic.'" class="mx-auto d-block" alt="..." style="object-fit: cover; width:50px; height:50px; ">
        </div>
        <div class="col-7">
        <h6 class="mb-0"><a href="p/'.$permalink_post.'" class="text-light">'.$title_post.'</a></h6>
        <p class="pt-0"><a href="user/'.$username_post.'" class="text-light">'.$username_post.'</a> - '.$date_post.'</p>
        </div>
        <div class="col text-right pl-0 ml-0">
        <span class="mb-0 pb-0 mb-0"><span class="badge third shadow">'.$resultcheck_4.' <i class="fas fa-comment"></i> </span></span> <br>
        <span class="mb-0 pt-0 mt-0">'.$status.'</span>
        </div>
        </div>
        </div>
        ';
      }
    }
    ?>
    <nav>
  <ul class="pagination">
  <div style="display: inherit;">
    <li class="page-item <?php if($pzero){ echo "disabled"; }?> dark-bg-2">
      <a class="page-link dark-bg-2 text-light border-0" href="?<?php echo $linkNum - 1;?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link dark-bg-2 text-light border-0"><?php echo $linkNum;?></a></li>
    <li class="page-item <?php if($linkNum == $max) { echo "disabled";} ?>">
      <a class="page-link dark-bg-2 text-light border-0" href="?<?php if($linkNum != $max) { echo $linkNum + 1;} ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    </div>
  </ul>
</nav>
</div>
            </div>

            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid dark-bg-1 pt-0 pb-2">
                    <div class="container ">
                    <p class="h3 py-2 text-light">Risposte recenti</p>
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
                               $propic_3 = "/img/utente.jpg";
                              }
                              $sql_4 = "SELECT * FROM posts WHERE permalink = '$permalink_comment'";
                              $result_4 = mysqli_query($conn, $sql_4);
                              $resultcheck_4 = mysqli_num_rows($result_4);
                              $row_4 = mysqli_fetch_assoc($result_4);
                              $title_comment = $row_4['title'];
                             echo '
                             <div class="jumbotron jumbotron-fluid p-0 mt-0 mb-2 dark-bg-2 text-light">
                            <div class="row p-3 pt-2 mt-0 pb-0">
                            <div class="col-2">
                            <a href="user/'.$username_post.'">
                            <img title="'.$username_post.'" src="'.$propic_3.'" class="mx-auto d-block " alt="..." style="object-fit: cover; width:45px; height:45px; ">
                            </a>
                            </div>
                            <div class="col-8 ml-2">
                            <h6 class="mb-0"><a href="p/'.$permalink_comment.'#'.$id_comment_1.'" class="text-light">'.$title_comment.'</a></h6>
                            <p class="py-0 my-0">'.$date_comment.'</p>
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

<script src="https://kit.fontawesome.com/d2ce008e27.js" crossorigin="anonymous"></script>
    <?php include 'inc/footer.php'; ?>
</html>