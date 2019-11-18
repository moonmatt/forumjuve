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
//   $sql = "SELECT * FROM users WHERE username = '$username'";
//     $result = mysqli_query($conn, $sql);
//     $resultcheck = mysqli_num_rows($result);

//     if($resultcheck == 1){ // If there is 1 result
//         while($row = mysqli_fetch_assoc($result)){
//             $username = $row['username'];
//             $email = $row['email'];
//             $name = $row['name'];
//             $bio = $row['bio'];
//             $website = $row['website'];
//             $sex = $row['sex'];
//             $dofbirth = $row['dofbirth'];
//             $city = $row['city'];
//             $propic = $row['propic'];
//             if($propic == ''){
//               $propic = "/forumjuve/img/utente.jpg";
//             }

//         }
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

    <title>Scrivi un messaggio | Forumjuve</title>


</head>

<body class="bg-secondary d-flex flex-column">

    <div class="container">

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Scrivi un messaggio</h1>
                <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
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
                        <h1 class="display-4 text-break">Immagine Profilo</h1>
                        <img src="<?php echo $propic; ?>" alt="..."
                            style="object-fit: cover; width:200px; height:200px;" class="rounded center">
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include 'inc/footer.php'; ?>

</html>