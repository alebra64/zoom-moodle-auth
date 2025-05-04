<?php
// Aggiorna il token Zoom usando il refresh_token

$client_id = 'D9SL3ztxScWLjlPeCBFzBA'; // <-- Sostituisci con il tuo Client ID
$client_secret = 'u2eGeh1RRZpLqA4EpG9ruZzIYTJDJNnA'; // <-- Sostituisci con il tuo Client Secret

$token_file = __DIR__ . '/token.json';
$tokens = json_decode(file_get_contents($token_file), true);

$refresh_token = $tokens['refresh_token'];

$url = 'https://zoom.us/oauth/token';
$params = http_build_query([
    'grant_type' => 'refresh_token',
    'refresh_token' => $refresh_token
]);

$headers = [
    'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
    'Content-Type: application/x-www-form-urlencoded'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if (isset($data['access_token'])) {
    // Aggiorna token.json con i nuovi token
    $tokens['access_token'] = $data['access_token'];
    $tokens['refresh_token'] = $data['refresh_token'];
    $tokens['api_url'] = 'https://api.zoom.us/v2/';
    file_put_contents($token_file, json_encode($tokens, JSON_PRETTY_PRINT));
    echo "✅ Token aggiornato con successo.";
} else {
    echo "❌ Errore nell'aggiornamento del token.\n";
    echo "Risposta Zoom: " . $response;
}
