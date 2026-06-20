<?php
    session_start();
    include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
        exit();
    }

    $searchTemplate = isset($_GET['search']) ? trim($_GET['search']) : '';
    $templatesPerPage = 6;
    $templatePage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $templateOffset = ($templatePage - 1) * $templatesPerPage;

    $templateSearchCondition = "";
    if (!empty($searchTemplate)) {
        $safeSearch = $conn->real_escape_string($searchTemplate);
        $templateSearchCondition = "WHERE template_name LIKE '%$safeSearch%'";
    }

    $templateSort = $_GET['sort'] ?? '';
    $templateOrderBy = "";

    if ($templateSort === 'name_asc') {
        $templateOrderBy = "ORDER BY template_name ASC";
    } elseif ($templateSort === 'name_desc') {
        $templateOrderBy = "ORDER BY template_name DESC";
    } elseif ($templateSort === 'date_newest') {
        $templateOrderBy = "ORDER BY times_used DESC";
    } elseif ($templateSort === 'date_oldest') {
        $templateOrderBy = "ORDER BY downloads DESC";
    } else {
    $templateOrderBy = "ORDER BY id_template DESC";
}

    $totalTemplatesQuery = "SELECT COUNT(*) AS total FROM rm_templates $templateSearchCondition";
    $totalTemplatesResult = $conn->query($totalTemplatesQuery);
    $totalTemplatesRow = $totalTemplatesResult->fetch_assoc();
    $totalTemplates = $totalTemplatesRow['total'];
    $templateTotalPages = ceil($totalTemplates / $templatesPerPage);

    $templateQuery = "
        SELECT 
            rm_templates.id_template,
            rm_templates.template_name,
            rm_industry.industry_name AS category,
            rm_templates.times_used,
            rm_templates.downloads,
            rm_templates.image_template
        FROM rm_templates
        LEFT JOIN rm_industry ON rm_templates.id_industry = rm_industry.id_industry
        $templateSearchCondition
        $templateOrderBy
        LIMIT $templatesPerPage OFFSET $templateOffset
    ";
    $templateResult = $conn->query($templateQuery);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/admin_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Admin/css/admin_templates.css" rel="stylesheet">
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
                        <a class="nav-link active d-flex align-items-center" href="admin_templates.php">
                            <img src="http://localhost/Resumix/Images/template_b.png" alt="Templates" class="me-2" width="40" height="40">
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
                <h1 class="header-title d-none d-md-block titleheader">Resume Templates</h1>
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
                        <a href="admin_registered_users.php" style="padding-bottom: 8px; margin-right: 20px; text-decoration: none; color: #00085C; font-weight: bold; border-bottom: 2px solid #00085C;">Resume Templates</a>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <!-- Search box -->
                        <form method="get" class="search-box position-relative" style="width: 300px;">
                            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ps-3 text-muted"></i>
                            <input type="text" name="search" class="form-control ps-5" placeholder="Search..." value="<?= htmlspecialchars($search ?? '') ?>">
                        </form>

                        <div class="d-flex align-items-center gap-2">
                            <!-- Filter button -->
                            <div>
                                <button class="filterbtn btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#userFilterModal">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                            </div>
                            <!-- Add button -->
                            <div>
                                <button class="addbtn btn btn-outline-secondary" onclick="location.href='template_add.php'">
                                    <i class="fa-solid fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <div class="table-responsive">
                            <table class="user-list" cellpadding="8" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width: 350px;">Template Name</th>
                                        <th>Category</th>
                                        <th>Times Used</th>
                                        <th>Downloads</th>
                                        <th style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($templateResult && $templateResult->num_rows > 0): ?>
                                        <?php while ($template = $templateResult->fetch_assoc()): ?>
                                                <?php
                                                    $imageData = !empty($template['image_template']) 
                                                        ? 'data:image/jpeg;base64,' . base64_encode($template['image_template']) 
                                                        : 'https://via.placeholder.com/600x800?text=No+Image';
                                                ?>

                                            <tr>
                                                <td><?= htmlspecialchars($template['id_template']) ?></td>
                                                <td><?= htmlspecialchars($template['template_name']) ?></td>
                                                <td><?= htmlspecialchars($template['category']) ?></td>
                                                <td><?= htmlspecialchars($template['times_used']) ?></td>
                                                <td><?= htmlspecialchars($template['downloads']) ?></td>
                                                <td class="action-icons">
                                                    <a href="#" 
                                                        title="Preview" 
                                                        class="preview-user-btn" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#cvPreviewModal"
                                                        data-template-name="<?= htmlspecialchars($template['template_name']) ?>"
                                                        data-template-image="<?= htmlspecialchars($imageData) ?>"
                                                        style="text-decoration: none; color: inherit; background-color: transparent;">
                                                        <i class="fa-solid fa-magnifying-glass previewbtn" style="font-size: 18px;"></i>
                                                    </a>
                                                    <a href="template_edit.php?id=<?= $template['id_template'] ?>" title="Edit" class="edit-user-btn" style="text-decoration: none; color: inherit; background-color: transparent;"><i class="fa-regular fa-pen-to-square editbtn"></i></a>
                                                    <button title="Delete" class="text-danger deletebutton" data-template-id="<?= $template['id_template'] ?>"><i class="fa-regular fa-trash-can deletebtn"></i></button>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No templates found...</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                        $max_visible_pages = 3;
                        $half = floor($max_visible_pages / 2);
                        $start_page = max(1, $templatePage - $half);
                        $end_page = min($templateTotalPages, $start_page + $max_visible_pages - 1);
                        $start_page = max(1, min($start_page, $templateTotalPages - $max_visible_pages + 1));
                    ?>

                    <nav aria-label="templates-Pagination" class="custom-pagination d-flex justify-content-end mt-4">
                        <ul class="pagination d-flex mb-0">
                            <li class="page-item me-2 <?= ($templatePage <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= max($templatePage - 1, 1) ?>&search=<?= urlencode($searchTemplate) ?>&sort=<?= urlencode($templateSort) ?>" aria-label="Previous">
                                    <img src="https://img.icons8.com/material-rounded/28/sort-left.png" alt="Previous" width="20">
                                </a>
                            </li>

                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <li class="page-item numpage me-2 <?= ($i == $templatePage) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($searchTemplate) ?>&sort=<?= urlencode($templateSort) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= ($templatePage >= $templateTotalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= min($templatePage + 1, $templateTotalPages) ?>&search=<?= urlencode($searchTemplate) ?>&sort=<?= urlencode($templateSort) ?>" aria-label="Next">
                                    <img src="https://img.icons8.com/material-rounded/28/sort-right.png" alt="Next" width="20">
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </main>
    </div>  

    <?php
        include('../../Modal/template_filter.php');;
    ?>
    

    <script src="http://localhost/Resumix/Frontend/Admin/js/admin_templates.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
