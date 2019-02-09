<?php
/**
 * Created by IntelliJ IDEA.
 * User: Luding
 * Date: 23.11.2018
 * Time: 09:55
 */
$method = $_SERVER['REQUEST_METHOD'];
$fetchRes = json_decode(file_get_contents('php://input'));
$id = $_POST['id'] ?? 0;
$reservation = [
    'id' => $id,
    'name' => $_POST['name'] ?? '',
    'datum' => $_POST['datum'] ?? '',
    'zeit' => $_POST['zeit'] ?? '',
    'email' => $_POST['email'] ?? '',
    'anzahl' => $_POST['anzahl'] ?? '',
    'status' => 'Angekommen'
];

$reservations = json_decode(file_get_contents('php://input'), true);
$reservations[$id] = $reservation;
if (isset($fetchRes->endpoint)) {
saveResSubtoDB($fetchRes);
} else {

saveRestoDB($fetchRes);
}


function saveResSubtoDB($fetchRes)
{

    $endpoint = $fetchRes->endpoint;
    $key = $fetchRes->publicKey;
    $auth = $fetchRes->authToken;
    $contentEncoding = $fetchRes->contentEncoding;
}

function saveRestoDB($fetchRes)
{

}