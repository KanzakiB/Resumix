<?php
session_start();
header('Content-Type: application/json');

include('C:/xampp/htdocs/Resumix/connect/connection.php');

$user_id = $_SESSION['user_id']; 


if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'super_admin'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$jobId = $_POST['jobId'] ?? null;
$jobName = $_POST['editjobname'] ?? '';
$industryCategory = $_POST['editjobIndustryCategory'] ?? null;

if (!$jobId || !is_numeric($jobId)) {
    echo json_encode(['success' => false, 'message' => 'Invalid job ID']);
    exit();
}

if (empty($jobName)) {
    echo json_encode(['success' => false, 'message' => 'Job name is required']);
    exit();
}

$stmt = $conn->prepare("UPDATE rm_jobtitles SET job_title = ?, id_industry = ?, last_updated = NOW() WHERE id_jobtitles = ?");
$stmt->bind_param("sii", $jobName, $industryCategory, $jobId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
    $activity = "Updated a Job Title";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Database update failed']);
}
?>
