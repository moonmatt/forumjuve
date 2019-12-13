<?php
include 'inc/header.php'; 

if(loginCheck()){
  $username = loginCheck()[1];
  $email = loginCheck()[2];

  $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck == 1){ // If there is 1 result
        while($row = mysqli_fetch_assoc($result)){
            $username = $row['username'];
            $email = $row['email'];
            $name = $row['name'];
            $bio = $row['bio'];
            $website = $row['website'];
            $sex = $row['sex'];
            $dofbirth = $row['dofbirth'];
            $city = $row['city'];
            $propic = $row['propic'];
            if($propic == ''){
              $propic = "/forumjuve/img/utente.jpg";
            }

        }
    } else {
      header("Location: index");
      die();
    }
} else {
  header("Location: login");
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
    <style>
    .form-control {
        border: none;
    }
    </style>
    <title><?php echo $username . " - Il tuo profilo | ForumJuve"?></title>


</head>

<body class="dark-bg d-flex flex-column">

<div class="jumbotron jumbotron-fluid text-light dark-bg-1 shadow">
            <div class="container">
                <h1 class="display-4">Modifica il tuo profilo</h1>
                <p class="lead">Effettua cambiamenti al tuo account.</p>
            </div>

        </div>

    <div class="container">

        <div class="row">
            <div class="col-sm-8">
                <div class="jumbotron jumbotron-fluid pt-3 dark-bg-1 text-light shadow rounded-lg">
                    <div class="container">

                        <form action="inc/profile.php" method="POST" enctype="multipart/form-data">
                            <?php profileErrors(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" class="form-control dark-bg text-light" id="username_form" name="username_form"
                                    value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control dark-bg text-light" id="email_form" name="email_form"
                                    value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <label for="exampleInputEmail1">Profile Image</label><br>
                                    <input name="img_form" name="img_form" size="35" type="file" />
                                    <input name="img_user" id="img_user" value="<?php echo $propic; ?>" type="hidden" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" class="form-control dark-bg text-light" id="name_form" name="name_form"
                                    value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sito Web</label>
                                <input type="url" class="form-control dark-bg text-light" id="website_form" name="website_form"
                                    value="<?php echo $website; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Sesso</label>
                                <select class="form-control dark-bg text-light" id="sex_form" name="sex_form">
                                    <?php
      if($sex == 1 or $sex == 0){
        echo '
        <option value="1" selected>Maschio</option>
        <option value="2">Femmina</option>
        ';
      }
      if($sex == 2){
        echo '
        <option value="2" selected>Femmina</option>
        <option value="1">Maschio</option>
        ';
      }
      ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Città</label>
                                <input type="text" class="form-control dark-bg text-light" id="city_form" name="city_form"
                                    value="<?php echo $city; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Data di nascita</label>
                                <input type="date" class="form-control dark-bg text-light" id="dofbirth_form" name="dofbirth_form"
                                    value="<?php echo $dofbirth; ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Bio</label>
                                <textarea class="form-control dark-bg text-light" id="bio_form" name="bio_form"
                                    rows="5"><?php echo $bio; ?></textarea>
                            </div>
                            <button type="submit" class="btn third third text-light" value="submit_profile"
                                name="submit_profile">Invia</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="jumbotron jumbotron-fluid pt-3 pb-3 dark-bg-1 text-light shadow rounded-lg">
                    <div class="container">
                        <h1 class="text-break">Immagine Profilo</h1>
                        <img src="<?php echo $propic; ?>" alt="..."
                            style="object-fit: cover; width:200px; height:200px;" class="rounded center">
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php include 'inc/footer.php'; ?>

</html>