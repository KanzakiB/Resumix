<?php
    session_start();
    include('C:\xampp\htdocs\Resumix\connect\connection.php');
    include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
        exit();
    }

    if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM rm_user WHERE id_user = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();

    if (!$userData) {
        die("User not found.");
    }

    $joinedDate = isset($userData['date_joined']) ? new DateTime($userData['date_joined']) : null;
    $now = new DateTime();
    $status = 'Unknown';

    if ($joinedDate) {
        $interval = $joinedDate->diff($now);
        $daysSinceJoined = $interval->days;
        $status = $daysSinceJoined >= 30 ? 'Old' : 'New';
    }

    $base64ImageProfile = !empty($userData['image_profile'])
        ? 'data:image/jpeg;base64,' . base64_encode($userData['image_profile'])
        : 'http://localhost/Resumix/Images/default-profile.png';
} else {
    die("No user ID provided.");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/admin_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Admin/css/users_update.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/sucess_modal.css" rel="stylesheet">

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
                        <a class="nav-link d-flex align-items-center" href="admin_dashboard.php">
                            <img src="http://localhost/Resumix/Images/dashboard_w.png" alt="Dashboard" class="me-2" width="40" height="40">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center" href="admin_registered_users.php">
                            <img src="http://localhost/Resumix/Images/user_b.png" alt="Users" class="me-2" width="40" height="40">
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
                <h1 class="header-title d-none d-md-block titleupdate">Registered Users</h1>
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
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h4 style="margin: 0;" class="titleupdate">User Update</h4>
                <button class="backbtn" onclick="location.href='admin_registered_users.php'">
                    <img src="http://localhost/Resumix/Images/back.png" alt="Logo" height="15px"  > Back
                </button>
            </div>

            <div style="max-width: auto; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #FFFFFF;">
                <form class="form-container" method="post" id="updateUserForm">
                    <div style="display: flex; gap: 20px; margin-bottom: 20px; justify-content: center; align-items: center;">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($userData['id_user']) ?>">

                        <div style="height: 170px; width: 170px; border-radius: 50%;">
                            <img src="<?= $base64ImageProfile ?>" alt="Logo" height="170px" width="auto" style="border-radius: 50%;">
                        </div>
                        <div style="flex-grow: 1;">
                            <label for="role" style="display: block; margin-bottom: 5px; font-weight: bold;">Role</label>
                            <div class="select-wrapper position-relative">
                                <select class="form-control custom-select" id="role" name="role">
                                    <option value="User" <?= ($userData['Role'] === 'user') ? 'selected' : '' ?>>User</option>
                                    <option value="Admin" <?= ($userData['Role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                    <option value="Super Admin" <?= ($userData['Role'] === 'super_admin') ? 'selected' : '' ?>>Super Admin</option>
                                </select>
                                <i class="bi bi-chevron-down chevron-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="username" style="display: block; margin-bottom: 5px; font-weight: bold;">Username</label>
                        <input type="text" class="form-control" id="update_username" name="update_username" value="<?= htmlspecialchars($userData['username']) ?>" readonly>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="firstname" style="display: block; margin-bottom: 5px; font-weight: bold;">Firstname</label>
                        <input type="text" class="form-control" id="update_firstname" name="update_firstname" value="<?= htmlspecialchars($userData['firstname']) ?>" readonly>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="lastname" style="display: block; margin-bottom: 5px; font-weight: bold;">Lastname</label>
                        <input type="text" class="form-control" id="update_lastname" name="update_lastname" value="<?= htmlspecialchars($userData['lastname']) ?>" readonly>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email</label>
                        <input type="email" class="form-control" id="update_email" name="update_email" value="<?= htmlspecialchars($userData['email']) ?>" readonly>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="date_joined" style="display: block; margin-bottom: 5px; font-weight: bold;">Date Joined</label>
                        <input type="text" class="form-control" id="update_date_joined" name="update_date_joined" value="<?= htmlspecialchars(date('F j, Y', strtotime($userData['date_joined']))) ?>" readonly>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label for="status" style="display: block; margin-bottom: 5px; font-weight: bold;">Status</label>
                        <input type="text" class="form-control" id="update_status" name="update_status" value="<?= $status ?>" readonly>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="completed_resume" style="display: block; margin-bottom: 5px; font-weight: bold;">Completed Resume</label>
                        <input type="number" class="form-control" id="update_completed_resume" name="update_completed_resume" value="<?= htmlspecialchars($userData['completed_resume']) ?>" readonly>
                    </div>

                    <button type="submit"  id="triggerConfirmationModal" class="savebtn btn btn-primary"> Save Changes </button>
                </form>
            </div>
        </main>
    </div>      

    <?php
        include('../../Modal/role_filter.php');;
    ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="http://localhost/Resumix/Frontend/Admin/js/users_update.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>


</body>
</html>
