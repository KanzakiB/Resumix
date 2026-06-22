<?php
include('C:\xampp\htdocs\Resumix\connect\connection.php');
require 'C:\xampp\htdocs\spendipro\Mail\phpmailer\class.phpmailer.php';
require 'C:\xampp\htdocs\spendipro\Mail\phpmailer\class.smtp.php';


session_start();
header('Content-Type: application/json');

function sendVerification($email, $token, $username) {
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = ''; // email to use
    $mail->Password = ''; // App password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('email@gmail.com', 'RESUMIX');
    $mail->addAddress($email);
    $mail->isHTML(true);

    $link = 'http://localhost/Resumix/Frontend/User/pages/user_Change_password.php?token=' . urlencode($token);

    $mail->Subject = 'Resumix Password Change Verification';
    $mail->Body = '
        <div style="background-color: #00085C; padding: 20px; border-radius: 10px; width: 490px; margin: auto; font-family: Arial, sans-serif;">
            <div style="background-color: #fff; padding: 30px; border-radius: 10px;">
                <img src="https://i.pinimg.com/736x/24/86/37/248637f89b2e42d0f69cb878d1503ad6.jpg" alt="Logo Icon" width="150px" style="margin: 0 auto 10px auto; display: block;">
                <h3 style="color: #333; text-align: left;">Hi, ' . htmlspecialchars($username) . '</h3>
                <p style="text-align: left; font-size: 14px; color: #000000;">We received a request to change the password for your account. To proceed, please verify this action by clicking the button below:</p>
                <div style="text-align: center; margin: 20px 0;">
                    <a href="' . $link . '" style="padding: 10px 20px; background: #00085C; color: #fff; text-decoration: none; border-radius: 5px; font-weight: bold;">Verify Email</a>
                </div>
                <p style="text-align: left; font-size: 14px; color: #000000;">If you didn’t request this, you can safely ignore this email. Your current password will remain unchanged.</p>
            </div>
        </div>';

    return $mail->send();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        echo json_encode(["status" => "error", "message" => "User not logged in"]);
        exit;
    }

    // Get user email and username
    $stmt = $conn->prepare("SELECT email, username FROM rm_user WHERE id_user = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($email, $username);
    $stmt->fetch();
    $stmt->close();

    if (!$email) {
        echo json_encode(["status" => "error", "message" => "Email not found"]);
        exit;
    }

    $token = bin2hex(random_bytes(16)); // Secure token

    // Save token in DB
    $update = $conn->prepare("UPDATE rm_user SET verification_token = ? WHERE id_user = ?");
    $update->bind_param("si", $token, $user_id);
    if ($update->execute() && sendVerification($email, $token, $username)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send email"]);
    }
}
?>
