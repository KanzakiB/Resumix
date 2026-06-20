<?php
    session_start();
    include('C:\xampp\htdocs\Resumix\connect\connection.php');
    include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'user' )) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/user_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/user_profile.css" rel="stylesheet">
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
                                        <h5 class="card-title">Profile Settings</h5>
                                        <hr class="mb-3">
                                        <div class="mb-3 text-center d-flex flex-column flex-md-row align-items-center px-3">
                                            <!-- Profile Image -->
                                            <div class="mb-3 mb-md-0 me-md-4 imgprofile">
                                                <img id="profileImageDisplay" src="<?= $base64ImageProfile ?>" alt="Profile Image" style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover;">
                                            </div>

                                            <!-- Username and Buttons -->
                                            <div class="d-flex flex-column align-items-md-start align-items-center text-md-start text-center mt-md-0 mt-2 imgfunction">
                                                <div class="mb-2">
                                                    <strong class="adminName"><?= htmlspecialchars($username) ?></strong>
                                                </div>
                                                <form class="form-container" method="post" id="photoForm" enctype="multipart/form-data" action="http://localhost/Resumix/Backend/update_profile_photo.php">
                                                    <div class="d-flex flex-md-row flex-column justify-content-md-start justify-content-center align-items-center w-100 gap-2">
                                                        <!-- Hidden File Input -->
                                                        <input type="file" id="profilePhotoInput" name="profile_photo" accept="image/*" style="display: none;" onchange="previewImage(event)">

                                                        <!-- Preview Image -->
                                                        <a href="#" onclick="document.getElementById('profilePhotoInput').click(); return false;" class="editbtn btn btn-sm btn-primary d-inline-flex align-items-center">
                                                            <img src="http://localhost/Resumix/Images/editphoto.png" alt="Edit Icon" width="30" height="30" class="me-2">
                                                            Edit Photo
                                                        </a>

                                                        <!-- Save Button -->
                                                        <button type="submit" class="savebtn btn btn-sm btn-secondary" id="savePhotoBtn" disabled>Save Photo</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="infocont">
                                            <form class="form-container" method="post" id="infoForm" action="http://localhost/Resumix/Backend/user_profile_info_handler.php">
                                                <div class="row mb-3">
                                                    <!-- Username -->
                                                    <div class="col-md-6 mb-3 mb-md-0">
                                                        <label for="username" class="form-label">Username</label>
                                                        <input type="text" class="form-control" id="profile_username" name="profile_username" value="<?= htmlspecialchars($username) ?>"  maxlength="7">
                                                        <div class="form-text text-danger error-message1">Username already exists</div>
                                                    </div>

                                                    <!-- Firstname -->
                                                    <div class="col-md-6">
                                                        <label for="firstname" class="form-label">Firstname</label>
                                                        <input type="text" class="form-control" id="profile_firstname" name="profile_firstname" value="<?= htmlspecialchars($firstname) ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3 infodisplay">
                                                    <!-- Lastname -->
                                                    <div class="col-md-6 mb-3 mb-md-0">
                                                        <label for="lastname" class="form-label">Lastname</label>
                                                        <input type="text" class="form-control" id="profile_lastname" name="profile_lastname" value="<?= htmlspecialchars($lastname) ?>">
                                                    </div>

                                                    <!-- Email -->
                                                    <div class="col-md-6">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="profile_email" name="profile_email" value="<?= htmlspecialchars($email) ?>">
                                                        <div class="form-text text-danger error-message2">Email already exists</div>
                                                    </div>
                                                </div>

                                                <!-- Save Button -->
                                                <div class="row">
                                                    <div class="col-12 d-flex justify-content-md-end justify-content-center">
                                                        <button type="submit" class="savebtn2 btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 order-md-0 mt-4 mt-md-0">
                                <div class="card list-group custom-shadow tall-box nav-box">
                                    <a href="user_profile_settings.php" class="list-group-item list-group-item-action active">Profile Settings</a>
                                    <a href="user_ChangePass_verification.php" class="list-group-item list-group-item-action">Change Password</a>
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

    <!-- Success Modal Picture -->
    <div id="successModalPicture" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Profile Picture Updated!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>
    

    <!-- Success Modal Information -->
    <div id="successModalInfo" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Information Updated!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>    

    <script src="http://localhost/Resumix/Frontend/User/js/user_profile.js"></script>
    <script src="http://localhost/Resumix/Frontend/User/js/change_cover.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>

</body>
</html>
