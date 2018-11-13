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
/*error_reporting(E_ALL);


// Escape user inputs for security
$id = $mysqli->real_escape_string($_REQUEST)['id'];
$name = $mysqli->real_escape_string($_REQUEST['name']);
$datum = $mysqli->real_escape_string($_REQUEST['datum']);
$zeit = $mysqli->real_escape_string($_REQUEST['zeit']);
$anzahl = $mysqli->real_escape_string($_REQUEST['anzahl']);
$email = $mysqli->real_escape_string($_REQUEST['email']);

// Attempt insert query execution
$sql = "INSERT INTO be_reservierung (id, name, datum, zeit, anzahl, email) VALUES ('$id', '$name','$datum','$zeit','$anzahl', '$email')";
if($mysqli->query($sql) === true){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}

// Close connection
$mysqli->close();*/

// Get request data
$id = $_POST['id'] ?? 0;
$reservation = [
    'crdate' => date('Y-m-d H:i:s'),
    'id' => $id,
    'name' => $_POST['name'] ?? '',
    'datum' => $_POST['datum'] ?? '',
    'zeit' => $_POST['zeit'] ?? '',
    'email' => $_POST['email'] ?? '',
    'anzahl' => $_POST['anzahl'] ?? '',
    'status' => 'Angekommen'
];
echo json_encode($reservation);

// Save data into a simple file
$reservations = json_decode(file_get_contents('data/reservations.json'), true);
$reservations[$id] = $reservation;
file_put_contents('data/reservations.json', json_encode($reservations), LOCK_EX);

// Demo: Always return success as response
$response = [
    // Status:
    //   0 = Error - Could not save reservation
    //   1 = Success - Reservation transmitted successfully
    'status' => 1
];
echo json_encode($response);



//Database Connection
/*$mysqli = new mysqli("localhost", "root", "", "typo3_db");*/
require_once 'db.php';

// Check connection
/*if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}*/
/* insert data into DB */
foreach($reservations as $item) {
    mysqli_query($link,"INSERT INTO be_reservierung (id, name, datum, zeit, anzahl, email, status) 
       VALUES ('".$item['id']."', '".$item['name']."', '".$item['datum']."','".$item['zeit']."','".$item['anzahl']."', '".$item['email']."', '".$item['status']."')");
}

//database connection close
mysqli_close($link);

//}