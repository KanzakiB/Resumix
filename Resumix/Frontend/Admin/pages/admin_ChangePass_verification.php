    <?php
        session_start();
        include('C:\xampp\htdocs\Resumix\connect\connection.php');
        include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
            header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
            exit();
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Change Password</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        
        <link href="http://localhost/Resumix/Frontend/Component/css/admin_header.css" rel="stylesheet">
        <link href="http://localhost/Resumix/Frontend/Admin/css/admin_passverification.css" rel="stylesheet">


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
                            <a class="nav-link active d-flex align-items-center" href="admin_profile_settings.php">
                                <img src="<?= $base64ImageProfile ?>" alt="Admin" class="me-2 adminimage" width="45" height="45">
                                <?= htmlspecialchars($username) ?>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="admin_dashboard.php">
                                <img src="http://localhost/Resumix/Images/dashboard_w.png" alt="Dashboard" class="me-2" width="40" height="40">
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
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-9 order-md-1">
                            <div class="card custom-shadow tall-box">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <hr class="mb-3">
                                    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
                                        <div class="text-center px-3">
                                            <img src="http://localhost/Resumix/Images/sendemail.png" alt="Change Password Illustration" class="img-fluid mb-3" style="max-width: 200px;">
                                            <p class="text-muted mb-4 emailtext">
                                            Please verify your email address first to ensure account security before you can change your password.
                                            </p>
                                            <button class="sendbtn btn btn-primary">Send Email</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 order-md-0 mt-4 mt-md-0">
                            <div class="card list-group custom-shadow tall-box nav-box">
                                <a href="admin_profile_settings.php" class="list-group-item list-group-item-action">Profile Settings</a>
                                <a href="admin_ChangePass_verification.php" class="list-group-item list-group-item-action active">Change Password</a>
                                <a href="admin_session.php" class="list-group-item list-group-item-action">Session Log</a>
                                <a href="admin_activity.php" class="list-group-item list-group-item-action">Activity Log</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>  



        <script src="http://localhost/Resumix/Frontend/Admin/js/sendemail.js"></script>
        <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>

    </body>
    </html>
