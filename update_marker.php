<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

include 'db.php';

// Decode JSON input
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $id = $data['id'];
    $lat = $data['lat'];
    $lng = $data['lng'];
    $header = $data['header'];
    $date = $data['date'];
    $location = $data['location'];
    $paragraph = $data['paragraph'];
    $image = $data['image'] ?? null;

    // Ensure the ID is valid
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid marker ID.']);
        exit;
    }

    // Update the marker in the database
    $stmt = $pdo->prepare("
        UPDATE markers 
        SET lat = ?, lng = ?, header = ?, date = ?, location = ?, paragraph = ?, image = ? 
        WHERE id = ?
    ");
    $success = $stmt->execute([$lat, $lng, $header, $date, $location, $paragraph, $image, $id]);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Marker updated successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update marker.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
}
?>
