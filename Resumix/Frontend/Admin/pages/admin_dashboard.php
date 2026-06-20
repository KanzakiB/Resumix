<?php
    include('C:\xampp\htdocs\Resumix\Backend\admin_dashboard_process.php');
    include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/admin_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Admin/css/admin_dashboard.css" rel="stylesheet">
</head>
<body>
   
    <nav id="sidebar" class="sidebar">
        <div class="d-flex flex-column flex-grow-1">
            <button onclick="location.href='admin_dashboard.php'" class="close-logo m-3" aria-label="Close sidebar">
                <img src="http://localhost/Resumix/Images/logo-white.png" alt="Close" />
            </button>

            <div class="p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="admin_profile_settings.php">
                            <img src="<?= $base64ImageProfile ?>" alt="Admin" class="me-2 adminimage" width="45" height="45">
                            <?= htmlspecialchars($username) ?>
                        </a>
                    </li>
                </ul>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center" href="admin_dashboard.php">
                            <img src="http://localhost/Resumix/Images/dashboard_b.png" alt="Dashboard" class="me-2" width="40" height="40">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="admin_registered_users.php">
                            <img src="http://localhost/Resumix/Images/user_w.png" alt="Users" class="me-2" width="40" height="40">
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="admin_templates.php">
                            <img src="http://localhost/Resumix/Images/template_w.png" alt="Templates" class="me-2" width="40" height="40">
                            Templates
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="admin_categories.php">
                            <img src="http://localhost/Resumix/Images/categories_w.png" alt="Categories" class="me-2" width="40" height="40">
                            Categories
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
            <div class="d-flex align-items-center">
                <img src="http://localhost/Resumix/Images/logo-white.png" alt="Logo" height="40px" class="me-2 d-lg-none">
                <h1 class="header-title d-none d-md-block"></h1>
            </div>
            <ul class="nav flex-column d-none d-md-block">
                <li class="nav-item adminhead">
                    <a class=" d-flex align-items-center" href="admin_profile_settings.php">
                        <img src="<?= $base64ImageProfile ?>" alt="Admin" class="me-2 adminimage" width="45" height="45">
                        <?= htmlspecialchars($username) ?>
                    </a>
                </li>
            </ul>
            <button id="openSidebar" class="burger-button d-lg-none" type="button" aria-label="Toggle sidebar">
                <i class="bi bi-list"></i>
            </button>
        </header>

        <main class="main-content bodybg ">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div class="d-flex align-items-center">
                    <img src="http://localhost/Resumix/Images/dashboard_b.png" alt="Dashboard" class="me-2" width="40" height="40">
                    <h4  class="mb-0 Title-page">Dashboard</h4>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-left four-cards">
                            <div class="card-icon d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0"><?= htmlspecialchars($userCount) ?></h5>
                                <img src="http://localhost/Resumix/Images/user_bl.png" alt="Users" width="40" height="40">
                            </div>
                            <p class="card-text text-muted">Total Users</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-left four-cards">
                            <div class="card-icon d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">0</h5>
                                <img src="http://localhost/Resumix/Images/completed_bl.png" alt="Users" width="40" height="40">
                            </div>
                            <p class="card-text text-muted">Completed Resumes</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-left four-cards">
                            <div class="card-icon d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">0</h5>
                                <img src="http://localhost/Resumix/Images/downloaded_bl.png" alt="Users" width="40" height="40">
                            </div>
                            <p class="card-text text-muted">Resume Downloads</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-left four-cards admin-card">
                            <div class="card-icon d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0 "><?= htmlspecialchars($templateCount) ?></h5>
                                <img src="http://localhost/Resumix/Images/templates_bl.png" alt="Users" width="40" height="40">
                            </div>
                            <p class="card-text text-muted">Templates Available</p>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="title2">Most Used Templates</h4>
            <div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
                <div class="col">
                    <div class="card shadow-sm template-card">
                        <div class="d-flex justify-content-center">
                            <img src="http://localhost/Resumix/Images/rm1.png" class="card-img-top imgdisplay" alt="Template Preview">
                        </div>
                        <div class="card-body text-start">
                            <h6 class="card-title">Resume Name</h6>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>  

    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>
    <script src="http://localhost/Resumix/Frontend/Admin/js/admin_dashboard.js"></script>

</body>
</html>
