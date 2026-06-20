<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $session = "Logged Out";
    $stmt = $conn->prepare("INSERT INTO rm_session (id_user, session) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $session);
    $stmt->execute();
    $stmt->close();
}

session_unset();
session_destroy();
header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
exit;
?>
