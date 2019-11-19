<?php
include 'inc/header.php'; 

if(loginCheck()){
  $username = loginCheck()[1];
  $email = loginCheck()[2];

  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = basename($actual_link);
  if (strpos($actual_link, '?') !== false) {
    $to_username = substr($actual_link, strpos($actual_link, "?") + 1);  
    $to_username = stringEscape($to_username, $conn);  
  } else {
      $to_username = '';
  }
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
    <title>Scrivi un messaggio | Forumjuve</title>


</head>

<body class="bg-secondary d-flex flex-column">

    <div class="container">

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Scrivi un messaggio</h1>
                <p class="lead">Invia un messaggio privato ad un utente. Solo lui potrà vederlo</p>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="jumbotron jumbotron-fluid pt-3">
                    <div class="container">
                        <?php sendMsgErrors(); ?>
                        <form action="inc/write-msg.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Destinatario</label>
                                <input type="text" class="form-control" id="to_username_form" name="to_username_form"
                                    value="<?php echo $to_username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Titolo</label>
                                <input type="text" class="form-control" id="title_form" name="title_form">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Message</label>
                                <textarea class="form-control" id="msg_form" name="msg_form" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary" value="submit_msg"
                                name="submit_msg">Invia</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid pt-3 pb-3">
                    <div class="container">
                        <h1 class="display-4 text-break">Invia un messaggio</h1>
                        <p class="lead">Qui puoi scrivere messaggi privati ad altri utenti.</p>
                        <a href="msg">I tuoi messaggi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include 'inc/footer.php'; ?>

</html>