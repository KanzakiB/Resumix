<?php
    session_start();
    include('C:\xampp\htdocs\Resumix\connect\connection.php');
    include('C:\xampp\htdocs\Resumix\Backend\profile_image.php');

    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'super_admin')) {
        header("Location: http://localhost/Resumix/Frontend/User/pages/login.php");
        exit();
    }

    $industries = [];
    $industryQuery = "SELECT id_industry, industry_name FROM rm_industry ORDER BY industry_name ASC";
    $industryResult = $conn->query($industryQuery);

    if ($industryResult && $industryResult->num_rows > 0) {
        while ($row = $industryResult->fetch_assoc()) {
            $industries[] = $row;
        }
    }


    $currentFormattedDate = date('F j, Y');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="http://localhost/Resumix/Frontend/Component/css/admin_header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Admin/css/job_add.css" rel="stylesheet">
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
                <h1 class="header-title d-none d-md-block titleupdate">Job Titles</h1>
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
                <h4 style="margin: 0;" class="titleupdate">Create New Job Title</h4>
                <button class="backbtn" onclick="location.href='admin_job.php'">
                    <img src="http://localhost/Resumix/Images/back.png" alt="Logo" height="15px"  > Back
                </button>
            </div>

            <div style="max-width: auto; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #FFFFFF;">
                <form class="form-container" method="post" id="addJobForm">
                    <div class="mb-3">
                        <label for="jobname" class="form-label">Job Name</label>
                        <input type="text" class="form-control" id="Addjobname" name="Addjobname">
                    </div>

                    <div class="mb-3">
                        <label for="industryCategory" class="form-label">Industry Category</label>
                        <div class="select-wrapper position-relative">
                            <select class="form-control" id="AddjobIndustryCategory" name="AddjobIndustryCategory">
                                <option value="">Please Select</option>
                                <?php foreach ($industries as $industry): ?>
                                    <option value="<?= $industry['id_industry'] ?>">
                                        <?= htmlspecialchars($industry['industry_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <i class="bi bi-chevron-down chevron-icon"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="createdBy" class="form-label">Created By</label>
                        <input type="text" class="form-control" id="addjobCreatedBy" name="addjobCreatedBy" value="<?= htmlspecialchars($username) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="dateCreated" class="form-label">Date Created</label>
                        <input type="text" class="form-control" id="addjobDateCreated" name="addjobDateCreated" value="<?= $currentFormattedDate ?>" readonly>
                    </div>

                    <div class="mb-4">
                        <label for="lastUpdated" class="form-label">Last Updated</label>
                        <input type="text" class="form-control" id="addjobLastUpdated" name="addjobLastUpdated" value="<?= $currentFormattedDate ?>" readonly>
                    </div>

                    <button type="submit"  id="triggerConfirmationModal" class="addbtn btn btn-primary"> Add Job Title </button>
                </form>
            </div>
        </main>
    </div>  
    
        <!-- Success Modal -->
    <div id="successModalUpdate" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Added Successfully!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="http://localhost/Resumix/Frontend/Admin/js/jobtitle_add.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>


</body>
</html>
