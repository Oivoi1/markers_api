<?php
$host = 'localhost';
$dbname = 'markers_db';
$username = 'root';
$password = '';
$conn="";
$port = 3307;

// Establish a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
