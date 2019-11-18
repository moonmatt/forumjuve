<?php
include 'inc/header.php'; 

if(loginCheck()){
  $username = loginCheck()[1];
  $email = loginCheck()[2];

   $sql = "SELECT * FROM msg WHERE to_username = '$username'";
     $result = mysqli_query($conn, $sql);
     $resultcheck = mysqli_num_rows($result);
}
else {
    header('location: ../index');
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
                        <?php
        if($resultcheck > 0){ // If there is 1 result
            while($row = mysqli_fetch_assoc($result)){
               $from_username = $row['from_username'];
               $title = $row['title'];
               $date = $row['date'];
               $msg = $row['msg'];
               echo $from_username;
               echo $msg;
            }
       } else {
         echo "niente";
       }
    ?>
                    </div>

                    
                </div>

                <div class="jumbotron jumbotron-fluid pt-3" style="padding-bottom:0px;">
                    <div class="row mb-3 mt-3">
                        <div class="col-sm-4">
                        <img src="https://avatars0.githubusercontent.com/u/43266667" class="rounded mx-auto d-block" alt="..." width="80%" height="auto">
                        <div class="text-center text-break pr-3 pl-3">
                        <h5 class="mt-2">moonmatt</h5>
                        <span class="badge badge-secondary pt-2 pb-2 pr-4 pl-4">Utente</span>
                        </div>
                        </div>
                        <div class="col-sm-8 pl-0">
                            <div class="text-left">
                                <h5 class="mb-0">moonmatt</h5>
                                <p class="text-muted">25/11/2019</p>
                                <p class="mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit a nisi iste minima fugit, repudiandae dolore similique atque doloremque, placeat blanditiis recusandae perferendis quidem quibusdam amet? Molestias ratione repellat quos.</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-right pr-3 pb-2">
                    <a href="#">Rispondi</a>
                    </p>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid pt-3 pb-3">
                    <div class="container">
                        <h1 class="display-4 text-break">Immagine Profilo</h1>
                        <img src="<?php echo $propic; ?>" alt="..."
                            style="object-fit: cover; width:200px; height:200px; " class="rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>






    <?php include 'inc/footer.php'; ?>

</html>