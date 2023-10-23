<?php
$host = 'feenix-mariadb.server';
$user = 's104656009';
$password = '160797';
$database = 's104656009_db';

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

