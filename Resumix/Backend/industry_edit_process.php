<?php
session_start();

include('C:/xampp/htdocs/Resumix/connect/connection.php');
include('C:/xampp/htdocs/Resumix/Backend/profile_image.php');
include('C:/xampp/htdocs/Resumix/Frontend/Admin/xml/generate_industries.xml.php');

header('Content-Type: application/json');
$user_id = $_SESSION['user_id']; 


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['industry_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Industry ID is required.']);
        exit;
    }

    $industryId = intval($_POST['industry_id']);
    $industryName = isset($_POST['IneditName']) ? trim($_POST['IneditName']) : '';
    $lastUpdated = date('Y-m-d H:i:s');

    try {
        $stmt = $conn->prepare("UPDATE rm_industry SET industry_name = ?, last_updated = ? WHERE id_industry = ?");
        $stmt->bind_param("ssi", $industryName, $lastUpdated, $industryId);

        if ($stmt->execute()) {
            regenerateIndustriesXML($conn);  

            echo json_encode(['status' => 'success']);
            $activity = "Updated an Industry";
            $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
            $logStmt->bind_param("is", $user_id, $activity);
            $logStmt->execute();
            $logStmt->close();
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update industry.']);
            exit;
        }

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