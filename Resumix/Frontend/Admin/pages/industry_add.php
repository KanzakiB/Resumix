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
    <title>Add Industry</title>
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
                        <a class="nav-link d-flex align-items-center" href="admin_registered_users.php">
                            <img src="http://localhost/Resumix/Images/user_w.png" alt="Users" class="me-2" width="40" height="40">
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="admin_templates.php">
                            <img src="http://localhost/Resumix/Images/template_w.png" alt="template" class="me-2" width="40" height="40">
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
                <h1 class="header-title d-none d-md-block titleupdate">Industry Categories</h1>
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
                <h4 style="margin: 0;" class="titleupdate">Create New Industry</h4>
                <button class="backbtn" onclick="location.href='admin_categories.php'">
                    <img src="http://localhost/Resumix/Images/back.png" alt="Logo" height="15px"  > Back
                </button>
            </div>
                                                                                                                                                                        
            <div style="max-width: auto; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #FFFFFF;">
                <?php
                    $xmlPath = 'C:/xampp/htdocs/Resumix/Frontend/Admin/xml/industry_Form.xml';
                    $xml = simplexml_load_file($xmlPath) or die("Error: Cannot load XML");

                    $formTitle = (string) $xml->FormTitle;
                    $fields = $xml->Fields->Field;
                    $submitButton = $xml->SubmitButton;
                ?>

                <h4 style="margin: 0;" class="titleupdate"><?= htmlspecialchars($formTitle) ?></h4>

                <form class="form-container" method="post" id="addIndustryForm">
                    <?php foreach ($fields as $field): 
                        $label = htmlspecialchars($field->Label);
                        $name = htmlspecialchars($field->Name);
                        $type = htmlspecialchars($field->Type);
                        $readonly = isset($field->Readonly) ? 'readonly' : '';
                        $required = (isset($field->Required) && $field->Required == 'true') ? 'required' : '';
                        $value = '';
                        if ($name == 'IndaddCreatedBy') {
                            $value = htmlspecialchars($username);
                        } elseif ($name == 'IndaddDateCreated' || $name == 'IndaddLastUpdated') {
                            $value = date('Y-m-d');
                        }
                    ?>
                    <div class="mb-3">
                        <label for="<?= $name ?>" class="form-label"><?= $label ?></label>
                        <input 
                            type="<?= $type ?>" 
                            class="form-control" 
                            id="<?= $name ?>" 
                            name="<?= $name ?>" 
                            value="<?= $value ?>" 
                            <?= $readonly ?> <?= $required ?>
                        >
                    </div>
                    <?php endforeach; ?>

                    <button type="submit" id="<?= $submitButton->Id ?>" class="savebtn btn btn-primary">
                        <?= htmlspecialchars($submitButton->Label) ?>
                    </button>
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
    <script src="http://localhost/Resumix/Frontend/Admin/js/industry_add.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/admin_header.js"></script>


</body>
</html>
