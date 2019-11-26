<?php

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://sportsop-soccer-sports-open-data-v1.p.rapidapi.com/v1/leagues",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: sportsop-soccer-sports-open-data-v1.p.rapidapi.com",
		"x-rapidapi-key: 7b6f10ad4amsh385a40103be4cc9p15763bjsn25f984ba9626"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}