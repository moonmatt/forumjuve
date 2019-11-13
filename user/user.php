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
            $username = $row['username'];
            $email = $row['email'];
            $date = $row['date'];
            $date = date("d-M-Y", strtotime($date));
            $ban = $row['ban'];
            $name = $row['name'];
            $ban = $row['ban'];
            $bio = $row['bio'];
            $website = $row['website'];
            $sex = $row['sex'];
            $dofbirth = $row['dofbirth'];

            if($dofbirth != "0000-00-00"){ // If date of birth is not set
              $dofbirth = date("D-M-Y", strtotime($dofbirth));
            } else {
              $dofbirth = "";
            }

            if($sex == 1){ // Check the sex of user
              $sex = "Maschio";
            } elseif ($sex == 2) {
              $sex = "Femmina";
            }
            elseif ($sex == 0) {
              $sex = "";
            }

            $city = $row['city']; // Check if user is banned
            if($ban == 1){
              echo "L'utente è bannato";
              die();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?php echo $username; ?> | ForumJuve</title>


  </head>
  <body class="bg-secondary d-flex flex-column">

    <div class="container">

    <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4"><?php echo $username; ?></h1>
    <p class="lead">Utente dal <?php echo $date; ?></p>
  </div>

</div>

<div class="row">
    <div class="col-8">
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Juventus Forum</h1>
      <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
    </div>
  </div>
</div>
    <div class="col-4">
    <div class="jumbotron jumbotron-fluid p-2">
    <div class="container">
      <h4>Name</h4>
      <p class="lead"><?php echo $name; ?></p>
      <h4>Data di nascita</h4>
      <p class="lead"><?php echo $dofbirth; ?></p>
      <h4>Link</h4>
      <p class="lead"><?php echo $website; ?></p>
      <h4>Biografia</h4>
      <p class="lead"><?php echo $bio; ?></p>
      <h4>Sesso</h4>
      <p class="lead"><?php echo $sex; ?></p>
      <h4>Provenienza</h4>
      <p class="lead"><?php echo $city; ?></p>
    </div>
  </div>
    </div>
  </div>
    </div>





<?php include '../inc/footer.php'; ?>

</html>