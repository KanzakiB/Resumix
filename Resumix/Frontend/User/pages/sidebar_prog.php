<?php
// sidebar_prog.php
// This file contains the HTML structure for the responsive sidebar.
// It is designed to be included in other PHP pages.

// Define the current active page for highlighting in the sidebar.
// In a real application, you might determine this dynamically based on the URL or session.
$currentPage = 'personal_info'; // Example: 'personal_info', 'work_history', 'education', etc.
?>

<div class="sidebar-container d-flex flex-column flex-shrink-0 text-white bg-dark-blue">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none p-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-r-circle-fill me-2" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.5 4.002h3.118C10.745 4.002 12 5.12 12 6.556c0 1.442-1.254 2.56-3.382 2.56H7.5v1.894H5.5zM7.5 5.106v2.44h1.907c1.17 0 1.907-.655 1.907-1.227 0-.58-.737-1.213-1.907-1.213z"/>
        </svg>
        <span class="fs-4 fw-bold">RESUMIX</span>
    </a>
    <hr class="mx-3">
    <ul class="nav nav-pills flex-column mb-auto p-3">
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white <?php echo ($currentPage == 'personal_info') ? 'active-step' : ''; ?>" aria-current="page">
                <span class="step-indicator <?php echo ($currentPage == 'personal_info') ? 'active' : ''; ?>">
                    <?php echo ($currentPage == 'personal_info') ? '1' : ''; ?>
                </span>
                Personal Info
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white <?php echo ($currentPage == 'work_history') ? 'active-step' : ''; ?>">
                <span class="step-indicator <?php echo ($currentPage == 'work_history') ? 'active' : ''; ?>"></span>
                Work History
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white <?php echo ($currentPage == 'education') ? 'active-step' : ''; ?>">
                <span class="step-indicator <?php echo ($currentPage == 'education') ? 'active' : ''; ?>"></span>
                Education
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white <?php echo ($currentPage == 'skills') ? 'active-step' : ''; ?>">
                <span class="step-indicator <?php echo ($currentPage == 'skills') ? 'active' : ''; ?>"></span>
                Skills
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="#" class="nav-link text-white <?php echo ($currentPage == 'summary') ? 'active-step' : ''; ?>">
                <span class="step-indicator <?php echo ($currentPage == 'summary') ? 'active' : ''; ?>"></span>
                Summary
            </a>
        </li>
    </ul>
    <div class="mt-auto p-4">
        <p class="text-white mb-2">Progress</p>
        <div class="progress rounded-pill" style="height: 8px;">
            <div class="progress-bar bg-light-blue" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>