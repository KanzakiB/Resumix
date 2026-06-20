<?php
header('Content-Type: application/json');
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');

$user_id = $_SESSION['user_id']; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

$jobName = trim($_POST['Addjobname'] ?? '');
$industryId = $_POST['AddjobIndustryCategory'] ?? '';
$createdBy = $_POST['addjobCreatedBy'] ?? '';

if (!$jobName || !$industryId || !$createdBy) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit();
}

if (!is_numeric($industryId)) {
    echo json_encode(['success' => false, 'message' => 'Invalid Industry Category']);
    exit();
}

$currentTimestamp = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO rm_jobtitles (id_industry, job_title, created_by, date_created, last_updated) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit();
}
$stmt->bind_param("issss", $industryId, $jobName, $createdBy, $currentTimestamp, $currentTimestamp);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
    $activity = "New Job Title Added";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();

} else {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
}

$stmt->close();
$conn->close();

?>
