<?php
    session_start();
    include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
        exit();
    }

    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $usersPerPage = 6;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $usersPerPage;

    $searchCondition = "";

    $searchCondition = "";
    if (!empty($search)) {
        $searchSafe = $conn->real_escape_string($search);
        $searchCondition = "WHERE job_title LIKE '%$searchSafe%'";
    }

    $totalQuery = "SELECT COUNT(*) as total FROM rm_jobtitles $searchCondition";
    $totalResult = $conn->query($totalQuery);
    $totalRow = $totalResult->fetch_assoc();
    $total_jobs = $totalRow['total'];
    $total_pages = ceil($total_jobs / $usersPerPage);

    $jobtitles = [];


    $sql = "
        SELECT 
            jt.id_jobtitles, 
            jt.job_title, 
            ind.industry_name 
        FROM rm_jobtitles jt
        LEFT JOIN rm_industry ind ON jt.id_industry = ind.id_industry
        $searchCondition
        ORDER BY jt.id_jobtitles ASC 
        LIMIT $offset, $usersPerPage
    ";    
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jobtitles[] = $row;
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Titles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/admin_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Admin/css/admin_jobtitles.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Modal/css/user_filter.css" rel="stylesheet">
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
                        <a class="nav-link active d-flex align-items-center" href="admin_categories.php">
                            <img src="http://localhost/Resumix/Images/categories_b.png" alt="Categories" class="me-2" width="40" height="40">
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
                <h1 class="header-title d-none d-md-block titleheader">Job Titles</h1>
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
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div style="display: flex; border-bottom: 2px solid #e0e0e0; margin-bottom: 15px; width: 100%;">
                        <a href="admin_categories.php" style="padding-bottom: 8px; text-decoration: none; color: #333;">Industry Categories</a>
                        <a href="admin_job.php" style="padding-bottom: 8px; margin-left: 20px; text-decoration: none; color: #00085C; font-weight: bold; border-bottom: 2px solid #00085C;">Job Titles</a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <!-- Search box -->
                        <form method="get" class="search-box position-relative" style="width: 300px;">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ps-3 text-muted"></i>
                            <input type="text" name="search" class="form-control ps-5" placeholder="Search..." value="<?= htmlspecialchars($search ?? '') ?>">
                        </form>

                        <!-- Add button -->
                        <div>
                            <button class="addbtn btn btn-outline-secondary" onclick="location.href='jobtitle_add.php'">
                                <i class="fa-solid fa-plus"></i> Add
                            </button>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <div class="table-responsive">
                            <table class="user-list" cellpadding="8" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 500x;">ID</th>
                                        <th style="width: 500x;">Job Title</th>
                                        <th >Industry</th>
                                        <th style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($jobtitles)): ?>
                                        <?php foreach ($jobtitles as $job): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($job['id_jobtitles']) ?></td>
                                                <td><?= htmlspecialchars($job['job_title']) ?></td>
                                                <td><?= htmlspecialchars($job['industry_name'] ?? 'N/A') ?></td>
                                                <td class="action-icons">
                                                    <a href="jobtitle_edit.php?id=<?= $job['id_jobtitles'] ?>" title="Edit"  style="text-decoration: none; color: inherit; background-color: transparent;">
                                                        <i class="fa-regular fa-pen-to-square editbtn"></i>
                                                    </a>
                                                    <button class="deletebutton text-danger" data-job-id="<?= $job['id_jobtitles'] ?>" title="Delete">
                                                        <i class="fa-regular fa-trash-can deletebtn"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No Job Titles found...</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                        $max_visible_pages = 3;
                        $half = floor($max_visible_pages / 2);

                        $start_page = max(1, $page - $half);
                        $end_page = min($total_pages, $start_page + $max_visible_pages - 1);
                        $start_page = max(1, min($start_page, $total_pages - $max_visible_pages + 1));
                    ?>
                    <nav aria-label="users-Pagination" class="custom-pagination d-flex justify-content-end mt-4">
                        <ul class="pagination d-flex mb-0">
                            <li class="page-item me-2 <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= max($page - 1, 1) ?>&search=<?= urlencode($search ?? '') ?>" aria-label="Previous">
                                    <img src="https://img.icons8.com/material-rounded/28/sort-left.png" alt="Previous" width="20">
                                </a>
                            </li>

                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <li class="page-item numpage me-2 <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search ?? '') ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= min($page + 1, $total_pages) ?>&search=<?= urlencode($search ?? '') ?>"  aria-label="Next">
                                    <img src="https://img.icons8.com/material-rounded/28/sort-right.png" alt="Next" width="20">
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </main>
    </div>  

    <!-- Delete Confirmation Modal -->
    <div id="DeleteModal" class="custom-modal-backdrop hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="custom-modal">
            <div class="custom-modal-content">
                <div class="custom-modal-header">
                    <h5 class="custom-modal-title" id="modalTitle">Delete</h5>
                </div>
                <div class="custom-modal-body">
                    <p>Are you sure you want to delete this Job Title?</p>
                </div>
                <div class="custom-modal-footer justify-content-center">
                    <button type="button" id="nobtn" class="nobtn custom-btn secondary">No</button>
                    <button type="button" class="custom-btn primary" id="confirmDelete">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal Delete -->
    <div id="successModalRole" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Deleted Successfully!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>
    

    <script src="http://localhost/Resumix/Frontend/Admin/js/jobtitles.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
