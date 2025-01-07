<?php
header("Access-Control-Allow-Origin: http://localhost:5173"); // Allow requests from any origin
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow headers
include 'db.php';

$stmt = $pdo->query("SELECT * FROM markers");
$markers = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($markers);
?>
