<?php
require_once 'inc/dbh.inc.php';

function allBadges($badges, $conn){
	$badges = explode(",", $badges);
	$sql = "SELECT * FROM badges";
	$result = mysqli_query($conn, $sql);
	$resultcheck = mysqli_num_rows($result);
	$total = array(); 
	while($row = mysqli_fetch_assoc($result)){
    		foreach ($badges as $badge) {
			$badge = trim($badge);
			$name = $row['name'];
			if($badge == $name){
                $title = $row['title'];
                $image = $row['image'];
				$bad = array(True,$title,$image);
				array_push($total, $bad);
			}
		}
	}
	return $total;
}


foreach(allBadges("ciao,prova", $conn) as $lmao){
	echo json_encode($lmao);
	echo "<br>";
	echo $lmao[2];
}