<?php

$token = 'Masukan Token Disini';
$url = 'http://localhost:8000/api/rate-limit';

$totalRequests = 110;

for ($i = 1; $i <= $totalRequests; $i++) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Accept: application/json"
    ]);

    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        echo "Error: " . curl_error($ch) . "\n";
    } else {
        echo "Request #$i: $status\n";
        echo "Response: $response\n";
    }

    curl_close($ch);

    usleep(500000);
}
