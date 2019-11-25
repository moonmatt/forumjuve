<?php
include 'inc/header.php'; 

if(loginCheck()){
  $username = loginCheck()[1];
  $email = loginCheck()[2];
  
} else {
    header("Location: index");
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
        <script type="text/javascript" src="nicEdit.js"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        </script>
    <title>Scrivi un post | Forumjuve</title>


</head>

<body class="bg-secondary d-flex flex-column">

    <div class="container">

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Scrivi un post</h1>
                <p class="lead">Inizia una discussione pubblica nel forum. Mantieni un tono educato</p>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="jumbotron jumbotron-fluid pt-3">
                    <div class="container">
                        <?php sendMsgErrors(); ?>
                        <form action="inc/new-post.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Titolo</label>
                                <input type="text" class="form-control" id="title_post" name="title_post">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Contenuto</label>
                                <textarea class="form-control" id="msg_post" name="msg_post" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary" value="submit_post"
                                name="submit_post">Invia</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid pt-3 pb-3">
                    <div class="container">
                        <h1 class="display-4 text-break">Crea un post</h1>
                        <p class="lead">Qui puoi iniziare una discussione, ricordati che può essere eliminata/chiusa in qualsiasi momento dagli admin, mantieni un tono educato.</p>
                        <a href="my-posts">I tuoi post</a>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include 'inc/footer.php'; ?>

</html>