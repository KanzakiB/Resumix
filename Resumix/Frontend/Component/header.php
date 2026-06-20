<header>
    <nav class="navbar navbar-expand-lg header-container">
        <div class="container">
            <a class="navbar-brand" href="UserLandingPage.php">
                <img src="http://localhost/Resumix/Images/logo-white.png" alt="RESUMIX Logo" style="height: 40px;">
            </a>
            <button id="openSidebar" class="burger-button d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 0-1h10a.5.5 0 0 1 0 1h-11zm0-4a.5.5 0 0 1 0-1h10a.5.5 0 0 1 0 1h-11zm0-4a.5.5 0 0 1 0-1h10a.5.5 0 0 1 0 1h-11z"/>
                </svg>
            </button>



            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="UserLandingPage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="UserLandingPage.php #features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="UserLandingPage.php #steps">How It Works</a>
                    </li>
                    <li class="nav-item">   
                        <a class="nav-link" href="UserLandingPage.php #templates">Templates</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-flex action-btn">
                <a class="nav-link me-3" id="loginbtn" href="login.php">Login</a>
                <a class="nav-link btn btn-primary" href="signup.php">Get Started</a>
            </div>

        </div>
    </nav>
</header>

<div id="sidebar" class="sidebar d-lg-none">
    <button onclick="location.href='UserLandingPage.php'" class="close-logo m-3" aria-label="Close">
        <img src="http://localhost/Resumix/Images/logo-white.png" alt="Close" />
    </button>
    <ul class="nav flex-column mt-5 ms-3">
        <li class="nav-item"><a class="nav-link " href="UserLandingPage.php">Home</a></li>
        <li class="nav-item"><a class="nav-link " href="#features">Features</a></li>
        <li class="nav-item"><a class="nav-link " href="#steps">How It Works</a></li>
        <li class="nav-item"><a class="nav-link " href="#templates">Templates</a></li>
        <li class="nav-item mt-3"><a class="nav-link loginbtn2" href="login.php">Login</a></li>
        <li class="nav-item"><a class="nav-link btn btn-primary  mt-2" id="signupbtn" href="signup.php">Get Started</a></li>
    </ul>
</div>


