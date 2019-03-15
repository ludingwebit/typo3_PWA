<?php

//ENTER YOUR DATABASE CONNECTION INFO BELOW:
$hostname="84.129.192.102:3307";
$database="typo3_db";
$username="root";
$password="xDxXDbK9UhYl8scD";
//DO NOT EDIT BELOW THIS LINE
$link = new mysqli($hostname, $username, $password, $database);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
echo "Connected successfully";
?>