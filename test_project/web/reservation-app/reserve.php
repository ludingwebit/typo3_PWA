<?php

/**
 * Endpoint to save reservation requests (Format Form, Type POST)
 *
 * Example call:
 *  http --form POST localhost:8000/reserve.php name='John Smith' date='2018-10-10' userid='645146814354684684'
 *
 */

// Check composer autolader
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('Dependency error. Can\'t access vendor folder. Please run »composer install« first.');
} else {
    require __DIR__ . '/vendor/autoload.php';
}

header('Content-Type: application/json');
parse_str($_SERVER['QUERY_STRING'], $output);
echo print_r($output, TRUE);
$reservation = $output;
file_put_contents('data/reserve.txt', print_r($reservation, true), FILE_APPEND);
