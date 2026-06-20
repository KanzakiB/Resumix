<?php
include('C:\xampp\htdocs\Resumix\connect\connection.php');
session_start();

-$id_user = $_SESSION['user_id'] ?? null;

if (!$id_user || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
    header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['profile_username']);
    $firstname = trim($_POST['profile_firstname']);
    $lastname = trim($_POST['profile_lastname']);
    $email = trim($_POST['profile_email']);

    if ($username === '' || $email === '') {
        echo 'required_missing';
        exit;
    }

    $stmt1 = $conn->prepare("SELECT COUNT(*) FROM rm_user WHERE username = ? AND id_user != ?");
    $stmt1->bind_param('si', $username, $id_user);
    $stmt1->execute();
    $stmt1->bind_result($userExists);
    $stmt1->fetch();
    $stmt1->close();

    if ($userExists > 0) {
        echo 'username_exists';
        exit;
    }

    $stmt2 = $conn->prepare("SELECT COUNT(*) FROM rm_user WHERE email = ? AND id_user != ?");
    $stmt2->bind_param('si', $email, $id_user);
    $stmt2->execute();
    $stmt2->bind_result($emailExists);
    $stmt2->fetch();
    $stmt2->close();

    if ($emailExists > 0) {
        echo 'email_exists';
        exit;
    }

    $activity = "Information Updated";
    $logStmt = $conn->prepare("INSERT INTO rm_activity (id_user, activity) VALUES (?, ?)");
    $logStmt->bind_param("is", $id_user, $activity);
    $logStmt->execute();
    $logStmt->close();

    $stmt = $conn->prepare("UPDATE rm_user SET username = ?, firstname = ?, lastname = ?, email = ?, last_updated = NOW() WHERE id_user = ?");
    $stmt->bind_param('ssssi', $username, $firstname, $lastname, $email, $id_user);


    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'fail: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
