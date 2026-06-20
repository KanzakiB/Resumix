<?php
session_start();
include('C:/xampp/htdocs/Resumix/connect/connection.php');

$id_template = isset($_POST['id_template']) ? intval($_POST['id_template']) : 0;

$user_id = $_SESSION['user_id']; 


if ($id_template <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid template ID"
    ]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM rm_templates WHERE id_template = ?");
if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Prepare failed: " . $conn->error
    ]);
    exit;
}

$stmt->bind_param("i", $id_template);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
    $activity = "Deleted a Template";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();
} else {
    echo json_encode([
        "success" => false,
        "message" => "Execution failed: " . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>