<?php
// callback.php
// Riceve il codice di autorizzazione e lo scambia con un access token

$client_id = 'D9SL3ztxScWLjlPeCBFzBA'; // Il tuo client ID
$client_secret = 'zSg8LFYiDSja5S3kK0fW3xZbY4B1dIhK'; // Il tuo client secret
$redirect_uri = 'https://zoomoodle-ut.herokuapp.com/callback.php'; // Deve combaciare con quanto impostato su Zoom

if (!isset($_GET['code'])) {
    echo "Codice di autorizzazione mancante.";
    exit;
}

$code = $_GET['code'];

$token_url = "https://zoom.us/oauth/token";
$data = [
    "grant_type" => "authorization_code",
    "code" => $code,
    "redirect_uri" => $redirect_uri
];

$headers = [
    "Authorization: Basic " . base64_encode("$client_id:$client_secret")
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

echo "<pre>";
print_r(json_decode($response, true));
echo "</pre>";
