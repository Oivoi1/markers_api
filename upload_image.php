<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$uploadDir = "uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create the uploads directory if it doesn't exist
}

if (isset($_FILES['image'])) {
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
        echo json_encode(['status' => 'success', 'filePath' => $targetFilePath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No image file provided.']);
}
?>
