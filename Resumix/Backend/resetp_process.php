<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $password = $_POST['reset_password'];
    $confirm = $_POST['reset_confirmPassword'];

    if ($password !== $confirm) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/reset_password.php?error=match");
        exit;
    }

    if (!isset($_SESSION['reset_email'])) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/reset_password.php?error=session");
        exit;
    }

    $email = $_SESSION['reset_email'];
    $hashed = password_hash($password, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("UPDATE rm_user SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed, $email);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    unset($_SESSION['reset_email']);
    header("Location: http://localhost/Resumix/Frontend/User/pages/reset_password.php");
    exit;
}
?>
