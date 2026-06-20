<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');
include('C:/xampp/htdocs/Resumix/Backend/profile_image.php');
include('C:/xampp/htdocs/Resumix/Frontend/Admin/xml/generate_industries.xml.php'); 

header('Content-Type: application/json');

$user_id = $_SESSION['user_id']; 


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['industry_name']) || empty(trim($_POST['industry_name']))) {
        echo json_encode(['status' => 'error', 'message' => 'Industry name is required.']);
        exit;
    }

    $industryName = trim($_POST['industry_name']);
    $createdBy = $username ?? 'Unknown';
    $dateCreated = date('Y-m-d H:i:s');
    $lastUpdated = $dateCreated;

    try {
        $stmt = $conn->prepare("INSERT INTO rm_industry (industry_name, created_by, date_created, last_updated) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $industryName, $createdBy, $dateCreated, $lastUpdated);

        if ($stmt->execute()) {
            regenerateIndustriesXML($conn);
            echo json_encode(['status' => 'success']);
            
            $activity = "New Industry Added";
            $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
            $logStmt->bind_param("is", $user_id, $activity);
            $logStmt->execute();
            $logStmt->close();
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database insert failed.']);
            exit;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        exit;
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}
?>
