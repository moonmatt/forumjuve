<?php
include 'inc/header.php'; 
$sql_1 = "SELECT * FROM users WHERE username = 'moonmatt'";
$result_1 = mysqli_query($conn, $sql_1);
$resultcheck_1 = mysqli_num_rows($result_1);
$row = mysqli_fetch_assoc($result_1);
$date = $row['date'];
echo $date;
?>