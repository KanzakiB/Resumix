<?php
// header.php
// This file contains the HTML structure for the application's header.
// It is designed to be included at the beginning of your main HTML pages.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumix Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="indus_header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg custom-header-bg">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a href="#" class="text-dark-link d-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i>
            </a>

            <a class="navbar-brand header-logo-center d-flex align-items-center" href="#">
                <img src="http://localhost/Resumix/Images/logo-white.png" alt="Resumix Logo" class="me-2 header-logo-img">
                <span class="header-logo-text">RESUMIX</span>
            </a>

        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>