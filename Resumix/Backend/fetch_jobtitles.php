<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

include('C:\xampp\htdocs\Resumix\connect\connection.php');

if (!isset($_GET['industry_id']) || !is_numeric($_GET['industry_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid industry ID']);
    exit;
}

$industry_id = (int)$_GET['industry_id'];

$stmt = $conn->prepare("SELECT job_title FROM rm_jobtitles WHERE id_industry = ?");
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("i", $industry_id);
$stmt->execute();
$result = $stmt->get_result();

$jobTitles = [];
while ($row = $result->fetch_assoc()) {
    $jobTitles[] = $row['job_title'];
}

echo json_encode([
    'success' => true,
    'industry_id' => $industry_id,
    'job_titles' => $jobTitles
]);
exit;
