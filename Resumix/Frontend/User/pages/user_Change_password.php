<?php
session_start();
include('C:\xampp\htdocs\Resumix\connect\connection.php');
include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'user')) {
    header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Optional: Check if already verified in DB
$checkVerified = $conn->prepare("SELECT verification_token FROM rm_user WHERE id_user = ?");
$checkVerified->bind_param("i", $userId);
$checkVerified->execute();
$checkVerified->bind_result($verification_token);
$checkVerified->fetch();
$checkVerified->close();

// If not verified and token exists in URL, verify
if ($verification_token !== null) {
    $token = $_GET['token'] ?? null;

    if (!$token) {
        die("Verification token is required.");
    }

    if ($token !== $verification_token) {
        die("Invalid or expired verification token.");
    }

    // Token is valid, mark user as verified
    $clear = $conn->prepare("UPDATE rm_user SET verification_token = NULL WHERE id_user = ?");
    $clear->bind_param("i", $userId);
    $clear->execute();

    // Optionally set a session flag if you want
    $_SESSION['email_verified'] = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/user_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/user_changepass.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/sucess_modal.css" rel="stylesheet">


</head>
<body>
   
    <nav id="sidebar" class="sidebar">
        <div class="d-flex flex-column flex-grow-1">
            <button onclick="location.href='user_dashboard.php'" class="close-logo m-3" aria-label="Close sidebar">
                <img src="http://localhost/Resumix/Images/logo-white.png" alt="Close" />
            </button>

            <div class="p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center" href="user_profile_settings.php">
                            <img src="<?= $base64ImageProfile ?>" alt="User" class="me-2 userimage" width="45" height="45">
                            <?= htmlspecialchars($username) ?>
                        </a>
                    </li>
                </ul>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="user_dashboard.php">
                            <img src="http://localhost/Resumix/Images/myresume_w.png" alt="My Resume" class="me-2" width="40" height="40">
                            My Resume
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="user_template_list.php">
                            <img src="http://localhost/Resumix/Images/usertemplate_w.png" alt="Templates" class="me-2" width="40" height="40">
                            Templates
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="user_archive.php">
                            <img src="http://localhost/Resumix/Images/archive_w.png" alt="Archive" class="me-2" width="40" height="40">
                            Archive
                        </a>
                    </li>
                </ul>
            </div>

            <div class="flex-grow-1"></div>
        </div>

        <div class="logout-section p-3">
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="http://localhost/Resumix/Backend/logout_process.php">
                        <img src="http://localhost/Resumix/Images/logout_w.png" alt="Logout" class="me-2"  height="39">
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main-wrapper">
        <header class="header-main">
            <div class="d-flex align-items-center gap-3">
                <img src="http://localhost/Resumix/Images/logo-white.png" alt="Logo" height="40px" class="d-lg-none">
                <h1 class="header-title d-none d-md-block">Profile</h1>
            </div>
            <button id="openSidebar" class="burger-button d-lg-none" type="button" aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>
        </header>

        <div class="profile-wrapper">
            <section class="cover-image-section">
                <img src="<?= $base64ImageCover ?>" alt="Cover Image" class="cover-img" id="coverImageDisplay">
                
                <form id="coverForm" enctype="multipart/form-data" method="POST" action="http://localhost/Resumix/Backend/update_cover_photo.php">
                    <input type="file" id="coverInput" name="cover_photo" accept="image/*" style="display: none;" />
                    
                    <button type="button" class="btn change-cover-btn" onclick="document.getElementById('coverInput').click();">
                        <img src="http://localhost/Resumix/Images/coverphoto.png" alt="Edit Icon" width="20" height="20" class="me-2"> Change Cover
                    </button>
                </form>
            </section>

            <main class="main-content bodybg ">
                    <div class="container mt-4">
                        <div class="row mb-4">

                        <div class="row">
                            <div class="col-md-9 order-md-1">                                
                                <div class="card custom-shadow tall-box contentbox">
                                    <div class="card-body">
                                        <h5 class="card-title">Change Password</h5>
                                        <hr class="mb-3">
                                        <!-- Change Password Form -->
                                        <form class="form-container" method="post" id="changePassForm">
                                            <div class="mb-3">
                                                <label for="currentPassword" class="form-label">Current Password</label>
                                                    <div class="input-wrapper" style="position: relative; max-width: 400px;">
                                                        <input type="password" class="form-control pe-5" id="currentPassword" name="currentPassword">
                                                        <i class="fa-solid fa-eye" id="toggleCurrentPassword"
                                                        style="cursor: pointer; position: absolute; right: 20px; top: 50%; transform: translateY(-50%);"></i>
                                                    </div>
                                                <div class="form-text error-message1 text-danger mt-2">Incorrect current password</div>
                                            </div>

                                        <div class="mb-3">
                                                <label for="newPassword" class="form-label">New Password</label>
                                                <div class="row">
                                                    <!-- Input Section -->
                                                    <div class="col-md-6">
                                                        <div class="input-wrapper" style="position: relative; max-width: 400px;">
                                                            <input type="password" class="form-control pe-5" id="newPassword" name="newPassword">
                                                            <i class="fa-solid fa-eye" id="NewtogglePassword" style="cursor: pointer; position: absolute; right: 20px; top: 50%; transform: translateY(-50%);"></i>
                                                        </div>
                                                        <div class="form-text error-message2 text-danger mt-2">Requirements not met</div>
                                                        <div class="form-text error-message4 text-danger" style="display: none;">New password must not match current.</div>
                                                    </div>

                                                    <!-- Requirements Section -->
                                                    <div class="reqlist col-md-6 mt-3 mt-md-0">
                                                        <div class="form-text">Password must contain:</div>
                                                        <ul class="list-unstyled requirements">
                                                            <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 8 characters</li>
                                                            <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 1 uppercase letter (A-Z)</li>
                                                            <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 1 special character (!, @, #, $, %)</li>
                                                            <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 1 number</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                                                <div class="input-wrapper" style="position: relative; max-width: 400px;">
                                                    <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword">
                                                    <i class="fa-solid fa-eye" id="ConfirmtogglePassword" style="cursor: pointer; position: absolute; right: 20px; top: 50%; transform: translateY(-50%);"></i>
                                                </div>
                                                <div class="form-text error-message3 text-danger mt-2">Password do not match!</div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="savebtn btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 order-md-0 mt-4 mt-md-0">
                                <div class="card list-group custom-shadow tall-box nav-box">
                                    <a href="user_profile_settings.php" class="list-group-item list-group-item-action">Profile Settings</a>
                                    <a href="user_ChangePass_verification.php" class="list-group-item list-group-item-action active">Change Password</a>
                                    <a href="user_session.php" class="list-group-item list-group-item-action">Session Log</a>
                                    <a href="user_activity.php" class="list-group-item list-group-item-action">Activity Log</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>  

    <!-- Success Modal Cover -->
    <div id="successModalCover" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Cover Photo Updated!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>

    <!-- Success Modal ChangePass -->
    <div id="successModal" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Password Updated!</p>
            <button id="modalOkBtnPass" class="btn btn-primary">OK</button>
        </div>
    </div>


    <script src="http://localhost/Resumix/Frontend/User/js/change_cover.js"></script>
    <script src="http://localhost/Resumix/Frontend/User/js/user_changepass.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>


</body>
</html>
