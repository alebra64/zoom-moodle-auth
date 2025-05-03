<?php
// read_token.php
// Solo per sviluppo: mostra l'access token e gli altri dati ricevuti

$tokenFile = __DIR__ . '/token.json';

if (!file_exists($tokenFile)) {
    echo "Il file token.json non esiste. Autorizza prima l'app.";
    exit;
}

$data = json_decode(file_get_contents($tokenFile), true);

echo "<h2>Access Token</h2>";
echo "<pre>" . print_r($data['access_token'], true) . "</pre>";

echo "<h2>Refresh Token</h2>";
echo "<pre>" . print_r($data['refresh_token'], true) . "</pre>";

echo "<h2>Scadenza</h2>";
echo "<pre>" . print_r($data['expires_in'], true) . "</pre>";
