<?php
    session_start();
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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/user_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/user_dashboard.css" rel="stylesheet">
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
                        <a class="nav-link d-flex align-items-center" href="user_profile_settings.php">
                            <img src="<?= $base64ImageProfile ?>" alt="User" class="me-2 userimage" width="45" height="45">
                            <?= htmlspecialchars($username) ?>
                        </a>
                    </li>
                </ul>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center" href="user_dashboard.php">
                            <img src="http://localhost/Resumix/Images/myresume_b.png" alt="My Resume" class="me-2" width="40" height="40">
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
                
                <form class="d-none d-md-flex align-items-center" style="width: 100%; max-width: 600px;">
                    <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white border-end-0" style="border-top-left-radius: 25px; border-bottom-left-radius: 25px;">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="search" class="form-control border-start-0" placeholder="Search..." aria-label="Search" style="width: 400px; border-top-right-radius: 25px; border-bottom-right-radius: 25px;" >
                </div>
                </form>
            </div>
            <button id="openSidebar" class="burger-button d-lg-none" type="button" aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>
        </header>

        <main class="main-content bodybg">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div class="d-flex align-items-center">
                    <img src="http://localhost/Resumix/Images/myresume_b.png" alt="myresume" class="me-2" width="40" height="40">
                    <h4 class="mb-0 Title-page">My Resume</h4>
                </div>

                <div>
                    <button class="create-button">
                        <img src="http://localhost/Resumix/Images/plus_w.png" alt="myresume" class="me-2" width="20" height="20" onclick="location.href='industry_selection.php'">
                        Create
                    </button>
                </div>
            </div>

            <!--CARDS -->
            <div class="row g-4">
                <!-- Create New Resume Card -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="create-new-resume">
                        <div class="d-flex align-items-center justify-content-center">
                            <div style="background-color: #e0ffff; border: 2px dashed #008080; border-radius: 5px; width: 150px; height: 200px; display: flex; justify-content: center; align-items: center;">
                                <img src="http://localhost/Resumix/Images/plus_b.png" alt="myresume" class="me-2" width="40" height="40">
                            </div>
                        </div>
                        <div class="ms-4 mt-3">
                            <p class="card-title mb-1">Create New Resume</p>
                            <p class="text-muted small">Start a new resume quickly and easily.</p>    
                        </div>
                    </div>
                </div>

                <!-- Resume Card 1 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card resume-card p-3">
                        <div class="d-flex align-items-start">
                            <img src="http://localhost/Resumix/Images/rm1.png" alt="Resume Preview" class="resume-preview-img me-3" style="width: auto; height: 200px;">
                            <div>
                                <h6 class="card-title mb-1">New Resume</h6>
                                <p class="text-muted small mb-0">Created on May 17, 2025</p>
                                <hr style="margin-top: 4px; margin-bottom: 6px;">
                                <ul class="resume-actions mt-2">
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/rename_b.png" alt="rename" class="me-1" width="20"> Rename</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/edit_b.png" alt="rename" class="me-1" width="20"> Edit</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/share_b.png" alt="rename" class="me-1" width="20"> Share</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/download_b.png" alt="rename" class="me-1" width="20"> Download</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/archive_b.png" alt="rename" class="me-1" width="20"> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

               <!-- Resume Card 2 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card resume-card p-3">
                        <div class="d-flex align-items-start">
                            <img src="http://localhost/Resumix/Images/rm1.png" alt="Resume Preview" class="resume-preview-img me-3" style="width: auto; height: 200px;">
                            <div>
                                <h6 class="card-title mb-1">New Resume</h6>
                                <p class="text-muted small mb-0">Created on May 17, 2025</p>
                                <hr style="margin-top: 4px; margin-bottom: 6px;">
                                <ul class="resume-actions mt-2">
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/rename_b.png" alt="rename" class="me-1" width="20"> Rename</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/edit_b.png" alt="edit" class="me-1" width="20"> Edit</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/share_b.png" alt="share" class="me-1" width="20"> Share</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/download_b.png" alt="download" class="me-1" width="20"> Download</a></li>
                                    <li><a href="#"><img src="http://localhost/Resumix/Images/archive_b.png" alt="archive" class="me-1" width="20"> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

        </main>
    </div>  

    <script src="http://localhost/Resumix/Frontend/User/js/user_dashboard.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>

</body>
</html>
