<?php

require_once '../inc/dbh.inc.php';
require '../inc/functions.php';
session_start();

if(loginCheck()){
  $username = loginCheck()[1];
  $email = loginCheck()[2];
  $id = loginCheck()[3];

  $adminSql = "SELECT * FROM users WHERE id = '$id'";
  $adminResult = mysqli_query($conn, $adminSql);
  $adminRow = mysqli_fetch_assoc($adminResult);
  $adminRole = $adminRow['role'];
  // IF IS NOT AN ADMIN
  if($adminRole != "admin"){
    header("location: ../index?permission-denied");
    die();
  }

  $adminImg = $adminRow['propic'];

  // TOTAL USERS
  $totalSql = "SELECT * FROM users";
  $totalResult = mysqli_query($conn, $totalSql);
  $totalResultCheck = mysqli_num_rows($totalResult);

  // IF NOT LOGGED IN
} else {
  header("location: ../login");
  die();
}
?>
<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tabelle - ForumJuve</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Admin</strong><strong>Panel</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">F</strong><strong>J</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
            <!-- Log out               -->
            <div class="list-inline-item logout">                   <a id="logout" href="login.html" class="nav-link"> <span class="d-none d-sm-inline">Logout </span><i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
        <div class="mr-2"><img src="<?php echo $adminImg; ?>" alt="..." class="rounded mx-auto d-block" alt="..." style="object-fit: cover; width:50px; height:50px; "></div>
          <div class="title">
            <h1 class="h5"><?php echo $username; ?></h1>
            <p><?php echo $adminRole; ?></p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li><a href="index.html"> <i class="icon-home"></i>Home </a></li>
          <li class="active"><a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>
          <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
          <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>
          <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
              <li><a href="#">Page</a></li>
              <li><a href="#">Page</a></li>
              <li><a href="#">Page</a></li>
            </ul>
          </li>
          <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
        </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <!-- Page Header-->
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Tables</h2>
          </div>
        </div>
        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Tables        </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="block margin-bottom-sm">
                  <div class="title"><strong>Utenti</strong></div>
                  <div class="table-responsive"> 
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Propic</th>
                          <th>Sito Web</th>
                          <th>Ruolo</th>
                          <th>Badges</th>
                          <th>Ban</th>
                          <th>Invio</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if($totalResultCheck > 0){ // If there is 1 result
                          while($totalRow = mysqli_fetch_assoc($totalResult)){
                            $totalId = $totalRow['id'];
                            $totalUsername = $totalRow['username'];
                            $totalEmail = $totalRow['email'];
                            $totalPropic = $totalRow['propic'];
                            $totalWebsite = $totalRow['website'];
                            $totalRole = $totalRow['role'];
                            $totalBadges = $totalRow['badges'];
                            
                            echo "<form method='POST' action='inc/users.php'><tr>";
                            echo "<td>".$totalId."</td>";
                            echo "<td><input type='text' value='".$totalUsername."' class='form-control dark-bg text-light border-0 ' id='username_form' name='username_form'></input></td>";
                            echo "<td><input type='email' value='".$totalEmail."' class='form-control dark-bg text-light border-0 ' id='email_form' name='email_form'></input></td>";
                            echo "<td><input type='url' value='".$totalPropic."' class='form-control dark-bg text-light border-0 ' id='propic_form' name='propic_form'></input></td>";
                            echo "<td><input type='url' value='".$totalWebsite."' class='form-control dark-bg text-light border-0 ' id='website_form' name='website_form'></input></td>";
                            echo "<td><input type='text' value='".$totalRole."' class='form-control dark-bg text-light border-0 ' id='role_form' name='role_form'></input></td>";
                            echo "<td><input type='text' value='".$totalBadges."' class='form-control dark-bg text-light border-0 ' id='badges_form' name='badges_form'></input></td>";
                            echo "<td>
                            <select class='form-control border-0' id='exampleFormControlSelect1'>
                            <option value='0'>No</option>
                            <option value='1'>Si</option>
                            </select>
                            </td>";
                            echo "<td><input type='submit' name='submit_form_admin' class='btn btn-dark'></td>";
                            echo "</tr></form>";
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </section>
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2019 &copy; Your company. Design by <a href="https://bootstrapious.com/p/bootstrap-4-dark-admin">Bootstrapious</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>