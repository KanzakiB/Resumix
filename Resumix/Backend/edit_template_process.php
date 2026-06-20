<?php
session_start();
include('C:/xampp/htdocs/Resumix/connect/connection.php');

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'super_admin'])) {
    header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 


$templateId = 0;

if (isset($_POST['templateId'])) {
    $templateId = (int) $_POST['templateId'];
} elseif (isset($_GET['id'])) {
    $templateId = (int) $_GET['id'];
}

if ($templateId === 0) {
    http_response_code(400);
    die("Invalid Template ID.");
}

$templateName = trim($_POST['edittemplateName'] ?? '');
$description = trim($_POST['edittemplateDescription'] ?? '');
$industryId = isset($_POST['edittemplateIndustryCategory']) && $_POST['edittemplateIndustryCategory'] !== ''
    ? (int)$_POST['edittemplateIndustryCategory']
    : null;

if (empty($templateName)) {
    die("Template name is required.");
}

// Fetch existing data
$stmt = $conn->prepare("SELECT image_template, file_template, file_type FROM rm_templates WHERE id_template = ?");
$stmt->bind_param("i", $templateId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Template not found.");
}

$template = $result->fetch_assoc();
$imageData = $template['image_template'];
$fileData = $template['file_template'];
$fileType = $template['file_type'];

// Handle image upload
if (!empty($_FILES['edittemplateImage']['tmp_name']) && $_FILES['edittemplateImage']['error'] === UPLOAD_ERR_OK) {
    $imageData = file_get_contents($_FILES['edittemplateImage']['tmp_name']);
}

// Handle file upload
if (!empty($_FILES['edittemplateFile']['tmp_name']) && $_FILES['edittemplateFile']['error'] === UPLOAD_ERR_OK) {
    $fileData = file_get_contents($_FILES['edittemplateFile']['tmp_name']);
    $fileType = mime_content_type($_FILES['edittemplateFile']['tmp_name']);
}

$update = $conn->prepare("
    UPDATE rm_templates 
    SET template_name = ?, description = ?, id_industry = ?, image_template = ?, file_template = ?, file_type = ?, last_updated = NOW()
    WHERE id_template = ?
");

$imageBlob = '';
$fileBlob = '';

$update->bind_param("ssibssi", $templateName, $description, $industryId, $imageBlob, $fileBlob, $fileType, $templateId);

if ($imageData !== null) {
    $update->send_long_data(3, $imageData);
}
if ($fileData !== null) {
    $update->send_long_data(4, $fileData); 
}

if ($update->execute()) {
    echo "success";
    $activity = "Updated a Template";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();
} else {
    http_response_code(500);
    echo "Failed to update template.";
}

?>
