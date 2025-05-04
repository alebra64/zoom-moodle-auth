<?php

// Dati della tua app Zoom
$client_id = 'D9SL3ztxScWLjlPeCBFzBA';
$client_secret = 'zSg8LFYiDSja5S3kK0fW3xZbY4B1dIhK';
$redirect_uri = 'https://zomoodle-8977176c3197.herokuapp.com/callback.php';


// Verifica se è presente il codice di autorizzazione
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Prepara la richiesta per ottenere l'access token
    $url = 'https://zoom.us/oauth/token';
    $data = array(
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri,
    );

    // Inizializza cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret)
    ));

    // Esegui la richiesta
    $response = curl_exec($ch);
    curl_close($ch);

    // Elabora la risposta
    $responseData = json_decode($response, true);

    if (isset($responseData['access_token'])) {
        echo '<h2>Access Token ottenuto con successo:</h2>';
        echo '<pre>' . htmlspecialchars($response) . '</pre>';
    } else {
        echo '<h2>Errore nella richiesta:</h2>';
        echo '<pre>' . htmlspecialchars($response) . '</pre>';
    }
} else {
    echo '<h2>Authorization code non trovato nell\'URL.</h2>';
}
?>
