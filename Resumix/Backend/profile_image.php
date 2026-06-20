<?php

include('C:\xampp\htdocs\Resumix\connect\connection.php'); 
//all user info actually

$base64ImageProfile = '';
$base64ImageCover = '';
$username = '';
$role = '';
$firstname = '';
$lastname = '';
$email = '';
$completedResume = 0;
$dateJoined = '';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Select the additional user information (role, firstname, lastname, email, completed_resume, date_joined)
    $stmt = $conn->prepare("SELECT image_profile, image_cover, username, role, firstname, lastname, email, completed_resume, date_joined 
                            FROM rm_user WHERE id_user = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($imageProfileData, $imageCoverData, $fetchedUsername, $fetchedRole, $fetchedFirstname, $fetchedLastname, $fetchedEmail, $fetchedCompletedResume, $fetchedDateJoined);
    $stmt->fetch();
    
    if ($imageProfileData) {
        $base64ImageProfile = 'data:image/jpeg;base64,' . base64_encode($imageProfileData);
    } else {
        $base64ImageProfile = 'http://localhost/Resumix/Images/default_profile.png';
    }

    if ($imageCoverData) {
        $base64ImageCover = 'data:image/jpeg;base64,' . base64_encode($imageCoverData);
    } else {
        $base64ImageCover = 'http://localhost/Resumix/Images/default_cover.png';
    }

    // Store fetched information in variables
    $username = $fetchedUsername;
    $role = $fetchedRole;
    $firstname = $fetchedFirstname;
    $lastname = $fetchedLastname;
    $email = $fetchedEmail;
    $completedResume = $fetchedCompletedResume;
    $dateJoined = $fetchedDateJoined;
}


?>