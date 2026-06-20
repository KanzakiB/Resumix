<?php
session_start();
include('C:/xampp/htdocs/Resumix/connect/connection.php');

header('Content-Type: application/json');
$user_id = $_SESSION['user_id']; 


// Check user session and role
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'super_admin'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// Validate POST id_template parameter
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid Template ID']);
    exit;
}

$templateId = (int)$_POST['id'];

// Prepare DELETE statement
$stmt = $conn->prepare("DELETE FROM rm_jobtitles WHERE id_jobtitles = ?");
$stmt->bind_param("i", $templateId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
    $activity = "Deleted a Job Title";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Deletion failed']);
}

$stmt->close();
$conn->close();
?>
