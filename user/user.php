<?php
include '../inc/header.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = basename($actual_link);
$username = stringEscape($actual_link, $conn);

$sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){ // If there is 1 result
        while($row = mysqli_fetch_assoc($result)){
            $username_1 = $row['username'];
            $email_1 = $row['email'];
            $date = $row['date'];
            $date = date("d M Y", strtotime($date));
            $ban = $row['ban'];
            $name = $row['name'];
            $bio = $row['bio'];
            $website = $row['website'];
            $sex = $row['sex'];
            $dofbirth = $row['dofbirth'];
            $propic = $row['propic'];
            $city = $row['city']; 
            $role = $row['role'];
            if($name != ''){
                $name = '<h4>Nome</h4> <p class="lead">'.$name.'</p>';
            }

            if($website != ''){
                $website = '<h4>Link</h4> <p class="lead">'.$website.'</p>';
            }
            $role = '<h4>Ruolo</h4> <p class="lead d-inline-block m-0">'.roleBadge($role).'</p>';

            if($dofbirth != "0000-00-00"){ // If date of birth is not set
              $dofbirth = date("d M Y", strtotime($dofbirth));
              $dofbirth = '<h4>Data di nascita</h4> <p class="lead">'.$dofbirth.'</p>';
            } else {
                $dofbirth = "";
            }

            if($sex == 1){ // Check the sex of user
                $sex = '<h4>Sesso</h4> <p class="lead">Maschio</p>';
            } elseif ($sex == 2) {
                $sex = '<h4>Sesso</h4> <p class="lead">Femmina</p>';
            }
            elseif ($sex == 0) {
              $sex = "";
            }

            if($city != ''){
                $city = '<h4>Città</h4> <p class="lead">'.$city.'</p>';
            }

            if($bio != ''){
                $bio = '<h4>Biografia</h4> <p class="lead">'.$bio.'</p>';
            }

            if($ban == 1){
              echo "L'utente è bannato";
              die();
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

    <title><?php echo $username_1; ?> | ForumJuve</title>


</head>

<body class="bg-secondary d-flex flex-column">

    <div class="container">

        <div class="jumbotron jumbotron-fluid pt-3 pb-3">
            <div class="container">
                <div class="row">

                    <div class="col-sm-8 align-self-center">
                        <h1 class="display-4"><?php echo $username; ?></h1>
                        <p class="lead">Utente dal <?php echo $date; ?></p>
                    </div>

                    <div class="col-sm-4 align-right">
                        <img src="<?php echo $propic; ?>" alt="..."
                            style="object-fit: cover; width:200px; height:200px; " class="rounded">
                    </div>

                </div>
            </div>

        </div>



        <div class="row">

            <div class="col-sm-4 float-right">
                <div class="jumbotron jumbotron-fluid p-2">
                <p class="h3 py-2 px-2">Informazioni</p>
                    <div class="container">
                        <?php echo $name; ?>
                        <?php echo $role; ?>
                        <?php echo $dofbirth; ?>
                        <?php echo $website; ?>
                        <?php echo $sex; ?>
                        <?php echo $city; ?>
                        <?php echo $bio; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 float-left">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="h3 py-2">Post dell'utente</p>
                        <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include '../inc/footer.php'; ?>

</html>