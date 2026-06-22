<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');
require 'C:\xampp\htdocs\spendipro\Mail\phpmailer\class.phpmailer.php';
require 'C:\xampp\htdocs\spendipro\Mail\phpmailer\class.smtp.php';

header('Content-Type: application/json');

function sendOtp($email, $otp) {
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
    $mail->Subject = 'Your New OTP Code';
    $mail->Body = '
        <div style="background-color: #00085C; padding: 20px; text-align: center; border-radius: 10px; width: 400px; margin: auto; font-family: Arial, sans-serif;">
            <div style="background-color: #fff; padding: 30px; border-radius: 10px;">
                <img src="https://i.pinimg.com/736x/24/86/37/248637f89b2e42d0f69cb878d1503ad6.jpg" alt="Logo Icon" width="150px" style="margin-bottom: 0px;">
                <h2 style="color: #333;">New verification code:</h2>
                <h1 style="font-size: 40px; margin: 10px 0; color: #000;">' . $otp . '</h1>
            </div>
        </div>';

    return $mail->send();
}


if (isset($_SESSION['otp_email'])) {
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    if (sendOtp($_SESSION['otp_email'], $otp)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
} else {
    echo json_encode(["status" => "error"]);
}
?>
