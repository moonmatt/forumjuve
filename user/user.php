<?php
include '../inc/header.php'; 

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = basename($actual_link);
$actual_link = stringEscape($actual_link, $conn);
echo $actual_link;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>


  </head>
  <body class="bg-secondary d-flex flex-column">

    <div class="container">

    <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Juventus Forum</h1>
    <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
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
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">Juventus Forum</h1>
      <p class="lead">Il forum dedicato a tutti i tifosi bianconeri.</p>
    </div>
  </div>
    </div>
  </div>
    </div>





<?php include '../inc/footer.php'; ?>

</html>