<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$userId = $_SESSION['user_id'];
$inputPassword = $_POST['currentPassword'] ?? '';

$stmt = $conn->prepare("SELECT password FROM rm_user WHERE id_user = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $hashedPassword = $row['password'];
    if (password_verify($inputPassword, $hashedPassword)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
