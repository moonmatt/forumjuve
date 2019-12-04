<?php include 'inc/header.php'; ?>


<?php
    $sql = "SELECT * FROM postbadges";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

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

    <title>ForumJuve | Il forum dedicato a tutti i tifosi bianconeri</title>


</head>

<body class="bg-secondary d-flex flex-column">

    <div class="container">


        <div class="row">
            <div class="col-sm-8">

            <div class="jumbotron jumbotron-fluid px-3 py-1">
            <p class="h3 pt-2">Badges</p>
            <p class="lead">Qui ci sono i badges che puoi ottenere aprendo discussioni e rispondendo ad altri thread.
            I badges sono visibili a tutti sotto il tuo nome.</p>
            <hr>
            <?php
            if($resultcheck > 0){ // If there is 1 result
                while($row = mysqli_fetch_assoc($result)){
                    $image = $row['image'];
                    $name = $row['name'];
                    $value = $row['value'];
                    echo '<p class="h5 pt-2">'.$name.'</p>';
                    echo '<p class="lead">Limite max di risposte e discussioni: '.$value.'</p>';
                    echo '<img src="'.$image.'" class=" d-block mb-1" width="132" height="auto" title="'.$name.'">';
                    echo "<hr>";

                }
            }
            ?>
</div>
            </div>

        </div>
    </div>





    <?php include 'inc/footer.php'; ?>

</html>