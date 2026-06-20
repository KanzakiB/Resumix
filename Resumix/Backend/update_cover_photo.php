<?php
session_start();
include('C:/xampp/htdocs/Resumix/connect/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['cover_photo']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    if ($_FILES['cover_photo']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'Upload error']);
        exit();
    }

    $fileType = $_FILES['cover_photo']['type'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo json_encode(['success' => false, 'message' => 'Invalid file type']);
        exit();
    }

    $imageData = file_get_contents($_FILES['cover_photo']['tmp_name']);

    $stmt = $conn->prepare("UPDATE rm_user SET image_cover = ? WHERE id_user = ?");
    $stmt->bind_param("si", $imageData, $user_id);

    if ($stmt->execute()) {
        $activity = "Cover Photo Updated";
        $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
        $logStmt->bind_param("is", $user_id, $activity);
        $logStmt->execute();
        $logStmt->close();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized or invalid request']);
}
?>
