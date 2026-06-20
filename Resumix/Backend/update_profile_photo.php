<?php
session_start();
include('C:/xampp/htdocs/Resumix/connect/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $imageData = file_get_contents($_FILES['profile_photo']['tmp_name']);

    $activity = "Profile Picture Updated";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $activity);
    $logStmt->execute();
    $logStmt->close();

    $stmt = $conn->prepare("UPDATE rm_user SET image_profile = ? WHERE id_user = ?");
    $stmt->bind_param("si", $imageData, $user_id);

     if ($stmt->execute()) {
        $role = $_SESSION['role'] ?? null;
        // Role-based redirection
        if ($role === 'admin' || $role === 'super_admin') {
            header("Location: http://localhost/Resumix/Frontend/Admin/pages/admin_profile_settings.php?photo_updated=1");
        } else {
            header("Location: http://localhost/Resumix/Frontend/User/pages/user_profile_settings.php?photo_updated=1");
        }
        exit();
    } else {
        echo "Error updating image.";
    }
}
?>
