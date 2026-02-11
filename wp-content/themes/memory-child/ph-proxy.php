<?php
header("Content-Type: application/json");

$allowed = ['regions','provinces','municipalities','cities','barangays','localities'];
$endpoint = $_GET['endpoint'] ?? '';

if (!in_array($endpoint, $allowed)) {
    echo json_encode(["error"=>"Invalid endpoint"]);
    exit;
}

$base = "https://philippine-datasets-api.nowcraft.ing/api/";
$url = $base . $endpoint;

$response = file_get_contents($url);
if ($response === FALSE) {
    echo json_encode(["error"=>"Failed to fetch"]);
    exit;
}

echo $response;
exit; // prevent WordPress HTML injection
