<?php
include('C:\xampp\htdocs\Resumix\connect\connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['signup_password'];
    $confirmPassword = $_POST['signup_confirmPassword'];

    // Check if username exists
    $checkUsername = $conn->prepare("SELECT id_user FROM rm_user WHERE username = ?");
    $checkUsername->bind_param("s", $username);
    $checkUsername->execute();
    $checkUsername->store_result();

    if ($checkUsername->num_rows > 0) {
        echo json_encode(["status" => "error", "field" => "username"]);
        exit;
    }

    // Check if email exists
    $checkEmail = $conn->prepare("SELECT id_user FROM rm_user WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        echo json_encode(["status" => "error", "field" => "email"]);
        exit;
    }

    // Validate password
    if ($password !== $confirmPassword) {
        echo json_encode(["status" => "error", "field" => "password_mismatch"]);
        exit;
    }

    // Read default image files as binary
    $profileImage = file_get_contents('C:\xampp\htdocs\Resumix\Images\default_profile.png');
    $coverImage = file_get_contents('C:\xampp\htdocs\Resumix\Images\default_cover.jpg');


    // Hash and insert
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Insert with profile and cover images
    $stmt = $conn->prepare("INSERT INTO rm_user (Role, username, email, password, image_profile, image_cover) VALUES ('user', ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $hashedPassword, $profileImage, $coverImage);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "field" => "server"]);
    }
}
?>
