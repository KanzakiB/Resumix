<?php
session_start();

include('C:\xampp\htdocs\Resumix\connect\connection.php');
$user_id = $_POST['user_id'];

$stmt = $conn->prepare("DELETE FROM rm_user WHERE id_user = ?");
if (!$stmt) {
    http_response_code(500);
    echo "Server error.";
    exit();
}

$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    echo "User deleted successfully.";
} else {
    http_response_code(500);
    echo "Error deleting user.";
}

$stmt->close();
$conn->close();
?>