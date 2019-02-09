<?php
/**
 * Endpoint to save reservation requests (Format Form, Type POST)
 *
 * Example call:
 *  http --form POST localhost:8000/reserve.php name='John Smith' date='2018-10-10' uid='645146814354684684'
 *
 */
// Check composer autolader
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('Dependency error. Can\'t access vendor folder. Please run »composer install« first.');
} else {
    require __DIR__ . '/vendor/autoload.php';
}
// Get request data
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

//Database Connection
require_once 'db.php';

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . $link->connect_error);
}
/* insert data into DB */
foreach($reservations as $item) {
    mysqli_query($link,"INSERT INTO be_reservierung (id, name, datum, zeit, anzahl, email, status) 
       VALUES ('".$item['id']."', '".$item['name']."', '".$item['datum']."','".$item['zeit']."','".$item['anzahl']."', '".$item['email']."', '".$item['status']."')");
}

//database connection close
mysqli_close($link);

//}