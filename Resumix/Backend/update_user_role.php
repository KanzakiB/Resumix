<?php
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? null;
    $role = $_POST['role'] ?? null;

    if ($userId && $role) {
        $allowedRoles = ['User', 'Admin', 'Super Admin'];
        $roleMap = ['User' => 'user', 'Admin' => 'admin', 'Super Admin' => 'super_admin'];

        if (!in_array($role, $allowedRoles)) {
            http_response_code(400);
            echo "Invalid role.";
            exit;
        }

        $mappedRole = $roleMap[$role];
        $stmt = $conn->prepare("UPDATE rm_user SET Role = ? WHERE id_user = ?");
        $stmt->bind_param("si", $mappedRole, $userId);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            http_response_code(500);
            echo "Database error.";
        }
    } else {
        http_response_code(400);
        echo "Missing parameters.";
    }
} else {
    http_response_code(405);
    echo "Invalid request method.";
}
?>
