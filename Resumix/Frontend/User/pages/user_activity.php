<?php
    session_start();
    include('C:\xampp\htdocs\Resumix\connect\connection.php');
    include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'user' )) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
        exit();
    }

    $user_id = $_SESSION['user_id']; 

    // Pagination 
    $records_per_page = 6;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    // Count total sessions 
    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM rm_session WHERE id_user = ?");
    $stmt_count->bind_param("i", $user_id);
    $stmt_count->execute();
    $stmt_count->bind_result($total_records);
    $stmt_count->fetch();
    $stmt_count->close();

    $total_pages = ceil($total_records / $records_per_page);

    // Fetch activity records 
    $stmt = $conn->prepare("SELECT activity, date_time FROM rm_activity WHERE id_user = ? ORDER BY date_time DESC LIMIT ? OFFSET ?");
    $stmt->bind_param("iii", $user_id, $records_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();

    $activities = [];
    while ($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }


    $stmt->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/user_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/user_session.css" rel="stylesheet">
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
                                        <h5 class="card-title">Session Log</h5>
                                        <hr class="mb-1">
                                        <div class="table-responsive-wrapper">
                                            <table class="orders-list" cellpadding="8" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Session</th>
                                                        <th>Time</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (count($activities) > 0): ?>
                                                        <?php foreach ($activities as $activity): ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($activity['activity']) ?></td>
                                                                <td><?= date("g:i a", strtotime($activity['date_time'])) ?></td>
                                                                <td><?= date("F j, Y", strtotime($activity['date_time'])) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr><td colspan="3" class="text-center">No activity found.</td></tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        $max_visible_pages = 3;
                                        $half = floor($max_visible_pages / 2);

                                        $start_page = max(1, $page - $half);
                                        $end_page = min($total_pages, $start_page + $max_visible_pages - 1);

                                        $start_page = max(1, min($start_page, $total_pages - $max_visible_pages + 1));
                                        ?>

                                        <nav aria-label="Session Log Pagination" class="custom-pagination">
                                            <ul class="pagination justify-content-center mb-0">
                                                <li class="page-item me-2 <?= ($page <= 1) ? 'disabled' : '' ?>">
                                                    <a class="page-link" href="?page=<?= max($page - 1, 1) ?>" aria-label="Previous">
                                                        <img src="https://img.icons8.com/material-rounded/28/sort-left.png" alt="Previous" width="20">
                                                    </a>
                                                </li>

                                                <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                                    <li class="page-item numpage me-2 <?= ($i == $page) ? 'active' : '' ?>">
                                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                                    <a class="page-link" href="?page=<?= min($page + 1, $total_pages) ?>" aria-label="Next">
                                                        <img src="https://img.icons8.com/material-rounded/28/sort-right.png" alt="Next" width="20">
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 order-md-0 mt-4 mt-md-0">
                                <div class="card list-group custom-shadow tall-box nav-box">
                                    <a href="user_profile_settings.php" class="list-group-item list-group-item-action">Profile Settings</a>
                                    <a href="user_ChangePass_verification.php" class="list-group-item list-group-item-action">Change Password</a>
                                    <a href="user_session.php" class="list-group-item list-group-item-action">Session Log</a>
                                    <a href="user_activity.php" class="list-group-item list-group-item-action active">Activity Log</a>
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


    <script src="http://localhost/Resumix/Frontend/User/js/change_cover.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>


</body>
</html>
