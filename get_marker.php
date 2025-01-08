<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the input
    error_log("Fetching marker with ID: " . $id); // Log the ID for debugging

    $stmt = $pdo->prepare("SELECT * FROM markers WHERE id = ?");
    $stmt->execute([$id]);
    $marker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($marker) {
        echo json_encode($marker);
    } else {
        echo json_encode(['error' => 'Marker not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
?>
