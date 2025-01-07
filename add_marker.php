<?php
header("Access-Control-Allow-Origin: http://localhost:5173"); // Allow requests from any origin
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow headers
header("Content-Type: application/json"); // Ensure response is JSON
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $lat = $data['lat'];
    $lng = $data['lng'];
    $header = $data['header'];
    $date = $data['date'];
    $location = $data['location'];
    $paragraph = $data['paragraph'];
    $image = $data['image'] ?? null; // Optional

    $stmt = $pdo->prepare("INSERT INTO markers (lat, lng, header, date, location, paragraph, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$lat, $lng, $header, $date, $location, $paragraph, $image])) {
        echo json_encode(['status' => 'success', 'message' => 'Marker added successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add marker.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input!']);
}
?>
