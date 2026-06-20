<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit();
}

$user_id = $_SESSION['user_id']; 

$templateName = $_POST['templateName'] ?? '';
$description = $_POST['templateDescription'] ?? null;
$category = $_POST['templateIndustryCategory'] ?? null;
$timesUsed = intval($_POST['templateTimesUsed'] ?? 0);
$downloads = intval($_POST['templateDownloads'] ?? 0);
$createdBy = $_POST['templateCreatedBy'] ?? 'Unknown';
$dateCreated = date('Y-m-d H:i:s');
$lastUpdated = date('Y-m-d H:i:s');

$imageData = $fileData = null;
$fileType = null;

if (isset($_FILES['templateImage']) && $_FILES['templateImage']['error'] === UPLOAD_ERR_OK) {
    $imageData = file_get_contents($_FILES['templateImage']['tmp_name']);
}

if (isset($_FILES['templateFile']) && $_FILES['templateFile']['error'] === UPLOAD_ERR_OK) {
    $fileData = file_get_contents($_FILES['templateFile']['tmp_name']);
    $fileType = $_FILES['templateFile']['type'];
}

$sql = "INSERT INTO rm_templates (
    image_template, template_name, description, id_industry, times_used, downloads,
    file_template, file_type, created_by, date_created, last_updated
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => $conn->error]);
    exit();
}

$imageBlob = '';
$fileBlob = '';

$stmt->bind_param(
    "bssiiibssss", 
    $imageBlob, $templateName, $description, $category, $timesUsed, $downloads,
    $fileBlob, $fileType, $createdBy, $dateCreated, $lastUpdated
);

if ($imageData !== null) {
    $stmt->send_long_data(0, $imageData);
}
if ($fileData !== null) {
    $stmt->send_long_data(6, $fileData);
}

// Execute
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
    $activity = "New Template Created";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
?>
