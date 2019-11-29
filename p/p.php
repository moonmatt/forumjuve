<?php
include '../inc/header.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = basename($actual_link);
$permalink_url = stringEscape($actual_link, $conn);

$sql = "SELECT * FROM posts WHERE permalink = '$permalink_url'";
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
            $username_post = $row_1['username'];
            $website = $row_1['website'];
            if($website != ''){
                $website = "<a href='".$website."' target='_blank' class='mt-2'><i class='material-icons'>
                link
                </i></a>";
            } else {
                $website = "";
            }
            if($propic == ''){
             $propic = "/forumjuve/img/utente.jpg";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						
    <title><?php echo $title; ?> | ForumJuve</title>

</head>

<body class="bg-secondary d-flex flex-column">

    <div class="container">
        <div class="jumbotron jumbotron-fluid mt-3 pb-3 mb-0 pt-3">
            <div class="row ml-3 mr-3 pt-3 pb-3 bg-light">
                <div class="col-sm-3 mr-0 pr-0">
                    <img src="<?php echo $propic; ?>" class="rounded mx-auto d-block" alt="..."
                        style="object-fit: cover; width:200px; height:200px; ">
                    <div class="text-center text-break pr-3 pl-3">
                        <h5 class="mt-2"><?php echo $username_post; ?></h5>
                        <?php echo rolebadge($role); ?>
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
        $date_comment = $row_2['date'];
        $date_comment = date("d/m/Y - H:i", strtotime($date_comment));

        $sql_3 = "SELECT * FROM users WHERE id = '$id_user_comment'";
        $result_3 = mysqli_query($conn, $sql_3);
        $resultcheck_3 = mysqli_num_rows($result_3);
        $row_3 = mysqli_fetch_assoc($result_3);

        $username_comment = $row_3['username'];
        $propic_comment = $row_3['propic'];
        $role_comment = $row_3['role'];
        $website_comment = $row_3['website'];

        if($website_comment != ''){
            $website_comment = "<a href='".$website_comment."' target='_blank' class='mt-2'><i class='material-icons'>
            link
            </i></a>";
        } else {
            $website_comment = "";
        }
        if($propic_comment == ''){
         $propic_comment = "/forumjuve/img/utente.jpg";
        }

        echo '
        <div class="jumbotron jumbotron-fluid mt-1 pb-1 mb-0 pt-3" id="'.$id_comment.'">
            <div class="row ml-3 mr-3 pt-3 pb-3 bg-light">
                <div class="col-sm-3 mr-0 pr-0">
                    <img src="'.$propic_comment.'" class="rounded mx-auto d-block" alt="..."
                        style="object-fit: cover; width:200px; height:200px; ">
                    <div class="text-center text-break pr-3 pl-3">
                        <h5 class="mt-2">'.$username_comment.'</h5>
                        '.rolebadge($role_comment).'
                    </div>
                </div>

                <div class="col-sm-9 pl-0 ml-0">
                    <div class="text-left mx-4">
                        <p class="text-muted">'.$date_comment.'</p>
                        <p class="mt-3 comment">'.$msg_comment.'</p>
                    </div>
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
if($closed != '1'){
    if(loginCheck()){
        $username = loginCheck()[1];
        $email = loginCheck()[2];
        $id = loginCheck()[3];

        $_SESSION["new-comment"] = array($permalink_url);; // Puts the Errors Array in the session, so it's visible from other pages
        echo '
        <div class="container">
        <div class="jumbotron jumbotron-fluid mt-3 pb-3 mb-0 pt-3">
            <div class="ml-3 mr-3 pt-3 pb-3 bg-light">
            <form action="../inc/new-comment.php" method="POST" enctype="multipart/form-data" class="pl-5 pr-5">
                            <div class="form-group">
                                <h3>Aggiungi una risposta pubblica</h3>
                                <textarea class="form-control" id="msg_comment" name="msg_comment" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary" value="submit_comment"
                                name="submit_comment">Invia</button>
                        </form>
            </div>
        </div>
    </div>
        ';
    } else {
        echo "devi essere loggato ignorante!";
    }
} else {
    echo "è chiuso";
}
?>



    <?php include '../inc/footer.php'; ?>

</html>