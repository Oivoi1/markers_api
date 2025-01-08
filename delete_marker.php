<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

include 'db.php';

// Decode JSON input
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = intval($data['id']); // Sanitize the input
    $stmt = $pdo->prepare("DELETE FROM markers WHERE id = ?");
    $success = $stmt->execute([$id]);

    if ($success) {
        echo json_encode(['status' => 'success', 'message' => 'Marker deleted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete marker.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input!']);
}
?>

