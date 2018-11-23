<?php
/**
 * Created by IntelliJ IDEA.
 * User: Luding
 * Date: 13.11.2018
 * Time: 14:01
 */
$method = $_SERVER['REQUEST_METHOD'];
$fetchRes = json_decode(file_get_contents('php://input'));
$endpoint = $fetchRes->endpoint;
$key = $fetchRes->publicKey;
$auth = $fetchRes->authToken;
$contentEncoding = $fetchRes->contentEncoding;

if (!isset($fetchRes->endpoint)) {
    echo "NO SUBSCRIPTION";
    return;
}

switch ($method) {
    case 'POST':
        // create a new subscription entry in your database (endpoint is unique)
        require_once 'db.php';

        $sql_query = "INSERT INTO be_subscription (endpoint, publicKey, authToken, contentEncoding) VALUES ('$endpoint', '$key', '$auth', '$contentEncoding')";
        $mysqli_insert = mysqli_query($link, $sql_query);
        break;
    case 'PUT':
        // update the key and token of subscription corresponding to the endpoint

        break;
    case 'DELETE':
        // delete the subscription corresponding to the endpoint
        break;
    default:
        echo "Error: method not handled";
        return;
}
