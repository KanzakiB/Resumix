<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
    header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
    exit();
}


$sqlUserCount = "SELECT COUNT(*) AS user_count FROM rm_user WHERE role = 'user'";
$resultUser = $conn->query($sqlUserCount);
$userCount = ($resultUser && $row = $resultUser->fetch_assoc()) ? $row['user_count'] : 0;

$sqlTemplateCount = "SELECT COUNT(*) AS template_count FROM rm_templates";
$resultTemplates = $conn->query($sqlTemplateCount);
$templateCount = ($resultTemplates && $row = $resultTemplates->fetch_assoc()) ? $row['template_count'] : 0;

$base64ImageProfile = '';

$GLOBALS['userCount'] = $userCount;
$GLOBALS['templateCount'] = $templateCount;
?>