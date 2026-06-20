<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$userId = $_SESSION['user_id'];
$newPassword = $_POST['newPassword'] ?? '';

if (strlen($newPassword) < 8) {
    echo json_encode(['success' => false, 'message' => 'Invalid password']);
    exit();
}


//add activity
$activity = "Password Updated";
$logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
$logStmt->bind_param("is", $userId, $activity);
$logStmt->execute();
$logStmt->close();

$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

$stmt = $conn->prepare("UPDATE rm_user SET password = ?, last_updated = NOW() WHERE id_user = ?");
$stmt->bind_param("si", $hashedPassword, $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'DB error']);
}
?>