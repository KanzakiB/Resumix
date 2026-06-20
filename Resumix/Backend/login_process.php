<?php
include('C:\xampp\htdocs\Resumix\connect\connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['login_email']);
    $password = $_POST['login_password'];

    $stmt = $conn->prepare("SELECT id_user, password, role FROM rm_user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo json_encode(["status" => "error", "field" => "email"]);
        exit;
    }

    $stmt->bind_result($user_id, $hashedPassword, $role);
    $stmt->fetch();

    if (!password_verify($password, $hashedPassword)) {
        echo json_encode(["status" => "error", "field" => "password"]);
        exit;
    }

    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;

    $session = "Logged In";
    $logStmt = $conn->prepare("INSERT INTO rm_session (id_user, session) VALUES (?, ?)");
    $logStmt->bind_param("is", $user_id, $session);
    $logStmt->execute();
    $logStmt->close();

    if ($role === 'admin' || $role === 'super_admin') {
        $redirect = 'http://localhost/Resumix/Frontend/Admin/pages/admin_dashboard.php';
    } else {
        $redirect = 'user_dashboard.php';
    }

    echo json_encode(["status" => "success", "redirect" => $redirect]);
}
?>
