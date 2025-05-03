<?php
// index.php
// Redireziona l’utente all’endpoint di autorizzazione di Zoom

$client_id = 'D9SL3ztxScWLjlPeCBFzBA'; // Il tuo Client ID
$redirect_uri = 'https://zoomoodle-ut.herokuapp.com/callback.php'; // Questo è l’URL registrato su Zoom
$scope = 'meeting:read:admin webinar:read:admin user:read:admin user:write:admin';

$authorize_url = "https://zoom.us/oauth/authorize?response_type=code"
    . "&client_id=" . urlencode($client_id)
    . "&redirect_uri=" . urlencode($redirect_uri)
    . "&scope=" . urlencode($scope);

header("HTTP/1.1 302 Found");
header("Location: $authorize_url");
exit;
