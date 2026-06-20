<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userOtp = trim($_POST['otp']);

    if (!isset($_SESSION['otp']) || (string)$userOtp !== (string)$_SESSION['otp']) {
        echo json_encode(["status" => "error"]);
        exit;
    }

    $_SESSION['otp_verified'] = true;

    if (isset($_SESSION['otp_email'])) {
        $_SESSION['reset_email'] = $_SESSION['otp_email'];
    }

    unset($_SESSION['otp']);

    echo json_encode(["status" => "success"]);
    exit;
}
