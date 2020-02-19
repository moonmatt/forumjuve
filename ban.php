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
<div class="container">
    <div class="ban">
        <div class="row">
            <div class="col-8 text-light"><h1>Woooops, sei Bannato</h1> Pensi di essere stato incarcerato ingiustamente come Ciro? <br> <a href="https://t.me/moonmatt" target="_blank"><div class="btn mt-1 third text-light">Contattami!</div></a></div>
            <div class="col-4">ciao</div>
        </div>
    </div>
</div>
</body>


<script src="https://kit.fontawesome.com/d2ce008e27.js" crossorigin="anonymous"></script>
    <?php include 'inc/footer.php'; ?>
</html>