<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');
include('C:/xampp/htdocs/Resumix/Frontend/Admin/xml/generate_industries.xml.php'); 

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'super_admin'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$id = (int)$_POST['id'];    
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM rm_industry WHERE id_industry = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    regenerateIndustriesXML($conn);

    $activity = "Deleted an Industry";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database delete failed']);
}

$stmt->close();
?>
