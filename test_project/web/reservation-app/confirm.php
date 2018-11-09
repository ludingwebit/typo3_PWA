<?php

/**
 * Endpoint to return reservation confirmations (Format JSON, Type GET)
 *
 * Example call:
 *  http localhost:8000/confirm.php userid='645146814354684684'
 *  http localhost:8000/confirm.php userid='0815'
 *
 */

// Check composer autolader
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('Dependency error. Can\'t access vendor folder. Please run »composer install« first.');
} else {
    require __DIR__ . '/vendor/autoload.php';
}

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$confirmation = [
    'message' => 'Success',
];

if($data['userid'] === '0815') {
    $confirmation['message'] = 'Error';
}

echo json_encode($confirmation);
