<?php
include 'inc/header.php'; 

if(loginCheck()){
    $username = loginCheck()[1];
    $email = loginCheck()[2];
    $id = loginCheck()[3];

    $sql = "SELECT * FROM msg WHERE from_username = '$id' ORDER BY id DESC";
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

    <title>I messaggi inviati | Forumjuve</title>


</head>

<body class="dark-bg d-flex flex-column">

<div class="jumbotron jumbotron-fluid dark-bg-1 text-light">
            <div class="container">
                <h1 class="display-4">I messaggi inviati</h1>
                <p class="lead">Ecco i messaggi da te inviati, per un totale di <?php echo $resultcheck; ?> Messaggi.</p>
            </div>

        </div>

    <div class="container">

        <div class="row">
            <div class="col-sm-8">
            <div class="py-1 dark-bg-1">
                        <?php
        if($resultcheck > 0){ // If there is 1 result
            while($row = mysqli_fetch_assoc($result)){
               $to_username = $row['to_username'];
               $to_username_id = $to_username;
               $title = $row['title'];
               $date = $row['date'];
               $date = date("d M Y - H:i", strtotime($date));
               $msg = $row['msg'];

               $sql_1 = "SELECT * FROM users WHERE id = '$to_username'";
               $result_1 = mysqli_query($conn, $sql_1);
               $resultcheck_1 = mysqli_num_rows($result_1);
               $row_1 = mysqli_fetch_assoc($result_1);
               $to_username = $row_1['username'];
               $propic = $row_1['propic'];
               $badges = $row_1['badges'];
               $role = $row_1['role'];
               $website = $row_1['website'];
               if($propic == ''){
                $propic = "/img/utente.jpg";
               }

               echo '
               <div class="jumbotron jumbotron-fluid dark-bg-2 text-light py-2 mb-1 m-3">
               <div class="row mb-3 mt-3 mx-0">
                   <div class="col-sm-4">
                   <img src="'.$propic.'" class="mx-auto d-block" alt="..." style="object-fit: cover; width:200px; height:200px; ">
                   <div class="text-center text-break pr-3 pl-3">
                   <h5 class="mt-2"><small>a </small><a href="user/'.$to_username.'" class="text-light">'.$to_username.'</a></h5>
                   '.badgeGroup($role, $to_username_id, $badges, $conn).'
                    '.website($website).'
                   </div>
                   </div>
                   <div class="col-sm-8 pl-0 message">
                       <div class="text-left mx-4">
                           <h5 class="mb-0">'.$title.'</h5>
                           <p class="text-muted">'.$date.'</p>
                           <p class="mt-3">'.$msg.'</p>
                       </div>
                   </div>
               </div>
               <p class="text-right pr-3 pb-0 mb-0">
               <a href="write-msg?'.$to_username.'" class="text-light">Rispondi</a>
               </p>
           </div>
               ';
            }
       }
    ?>
                    </div>
                    </div>

                    

            
            
            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid pt-3 pb-3 dark-bg-1 text-light">
                    <div class="container">
                        <h1 class="text-break">Messaggi privati</h1>
                        <p class="lead">Qui puoi vedere i messaggi che hai inviato.</p>
                        <a href="write-msg" class="text-light">Scrivi un messaggio</a> <br>
                        <a href="msg" class="text-light">Tutti i messaggi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <?php include 'inc/footer.php'; ?>

</html>