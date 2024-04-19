<?php

$api_key = "Xw8Y9UPSEz9fURhT0KiM9g==9fGe6d6ky2AnLE4O";
$url = "https://api.api-ninjas.com/v1/nutrition?query=";

$items = array();
foreach ($_GET as $key => $value){
    if (substr($key, 0, 4) == "item") {
        array_push($items, $value);
    }
}

$query = implode(" and ", $items);
$ch = curl_init($url . urlencode($query));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Api-Key : ' . $api_key]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
    echo "error: ". $e;
} else {
    $data_array = json_decode($resp, true);
    $calories = array();

    foreach ($data_array as $nutr_facts) {
        $name = $nutr_facts["name"];

}
}

echo $resp.json_encode();
curl_close();

