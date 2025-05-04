<?php
// index.php
// Redireziona l’utente all’endpoint di autorizzazione di Zoom

$client_id = 'D9SL3ztxScWLjlPeCBFzBA'; // Il tuo Client ID
$redirect_uri = 'https://zomoodle-8977176c3197.herokuapp.com/callback.php'; // Redirect URI corretto
$scope = 'meeting:read webinar:read user:read:admin user:write:admin';

$authorize_url = "https://zoom.us/oauth/authorize?response_type=code"
    . "&client_id=" . urlencode($client_id)
    . "&redirect_uri=" . urlencode($redirect_uri)
    . "&scope=" . urlencode($scope);

header("Location: $authorize_url");
exit;
