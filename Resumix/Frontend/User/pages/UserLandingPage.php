<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumix</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/landingpage.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Component/css/header.css" rel="stylesheet">
    
</head>
<body  class="landing-page">

    <?php
        include('../../Component/header.php');;
    ?>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h1 id="herotitle">Your Future Starts with a Resume.</h1>
                    <p class="lead">Unlock your potential and take the first step towards your dream career. Craft a professional resume that showcases your skills and opens doors to exciting opportunities.</p>
                    <a href="login.html" class="btn btn-primary btn-lg btn-createRm">Create Your Resume</a>
                </div>
                <div class="col-md-6">
                    <img src="http://localhost/Resumix/Images/heroimg.gif" alt="Resume Creation Illustration" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="features py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 title-section">Key Features</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col ft-card">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-start  mb-3">
                                <img src="http://localhost/Resumix/Images/ft1.png" alt="Feature 1" class="feature-image">
                            </div>
                            <h5 class="card-title">Intuitive Resume Builder</h5>
                            <p class="card-text">Easily create professional resumes with structured templates and easy editing tools.</p>
                        </div>
                    </div>
                </div>
                <div class="col ft-card">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-start  mb-3">
                                <img src="http://localhost/Resumix/Images/ft2.png" alt="Feature 2" class="feature-image">
                            </div>
                            <h5 class="card-title">Drag-and-Drop Editing</h5>
                            <p class="card-text">Move sections around and personalize your resume layout just the way you like it.</p>
                        </div>
                    </div>
                </div>
                <div class="col ft-card">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-start  mb-3">
                                <img src="http://localhost/Resumix/Images/ft3.png" alt="Feature 3" class="feature-image">
                            </div>
                            <h5 class="card-title">QR Code Sharing</h5>
                            <p class="card-text">Generate a QR code to instantly share your digital resume with employers.</p>
                        </div>
                    </div>
                </div>
                <div class="col ft-card">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-start  mb-3">
                                <img src="http://localhost/Resumix/Images/ft4.png" alt="Feature 4" class="feature-image">
                            </div>
                            <h5 class="card-title">Multimedia Integration</h5>
                            <p class="card-text">Add profile pictures, portfolio links, and digital work samples to enhance your resume.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="steps" class="Steps py-5">
        <div class="container">
            <h2 class="text-center mb-5 steps-title">Build Your Resume with Expert Guidance</h2>
            <div class="row align-items-center ">
                <div class="col-md-6">
                    <div id="steps-image-container">
                        <img id="step-image" src="http://localhost/Resumix/Images/step1.gif" alt="Step 1 Illustration" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list-group">
                        <div class="step-wrapper mb-3">
                            <button type="button" class="list-group-item list-group-item-action" data-step="1">
                                <span class="badge bg-primary rounded-pill">1</span> Choose a Template
                            </button>
                            <div id="step-content-1" class="collapse mt-3 stepcontent">
                                <p>Pick a template that aligns with your career objectives.</p>
                            </div>
                        </div>

                        <div class="step-wrapper mb-3">
                            <button type="button" class="list-group-item list-group-item-action" data-step="2">
                                <span class="badge bg-primary rounded-pill">2</span> Enter your resume details
                            </button>
                            <div id="step-content-2" class="collapse mt-3 stepcontent">
                                <p>Fill in your personal details, work experience, education, and skills to customize your resume.</p>
                            </div>
                        </div>

                        <div class="step-wrapper mb-3">
                            <button type="button" class="list-group-item list-group-item-action" data-step="3">
                                <span class="badge bg-primary rounded-pill">3</span> Customize the design
                            </button>
                            <div id="step-content-3" class="collapse mt-3 stepcontent">
                                <p>Easily rearrange sections with drag-and-drop tool.</p>
                            </div>
                        </div>

                        <div class="step-wrapper mb-3">
                            <button type="button" class="list-group-item list-group-item-action" data-step="4">
                                <span class="badge bg-primary rounded-pill">4</span> Personalize with media
                            </button>
                            <div id="step-content-4" class="collapse mt-3 stepcontent">
                                <p>Add your photo, links, and work samples to highlight your skills and achievements.</p>
                            </div>
                        </div>

                        <div class="step-wrapper mb-3">
                            <button type="button" class="list-group-item list-group-item-action" data-step="5">
                                <span class="badge bg-primary rounded-pill">5</span> Save, Download, or Share
                            </button>
                            <div id="step-content-5" class="collapse mt-3 stepcontent">
                                <p>Once you're satisfied, save, download, or generate a QR code to easily share your resume.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="login.php" class="btn btn-primary btn-lg btn-createsteprm">Create Your Resume</a>
            </div>
        </div>
    </section>

    <section id="templates" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4 templates-title">Resume Templates</h2>
                <div class="d-flex justify-content-center">
                    <p class="text-center mb-4 message-temp">
                        Explore customizable resume templates designed to highlight your skills, experience, and strengths, so you can make a powerful first impression.
                    </p>
                </div>
                <div id="template-list" class="row row-cols-1 row-cols-md-2 g-4 align-items-center">
                    <!-- Templates will be dynamically added here -->
                </div>

                <div class="template-pagination">
                    <div id="bullets" class=" align-items-center">
                        <!-- Bullets will be dynamically added here -->
                    </div>
                    <div class="d-flex align-items-center">
                        <button id="prev-btn" class="btn btn-sm" disabled><img width="24" height="28" src="https://img.icons8.com/material-rounded/28/sort-left.png" alt="sort-left"/></button>
                        <button id="next-btn" class="btn btn-sm"><img width="24" height="28" src="https://img.icons8.com/material-rounded/28/sort-right.png" alt="sort-right"/></button>
                    </div>
                </div>
        </div>
    </section>

    <?php
        include('../../Component/footer.php');
    ?>

    <script src="http://localhost/Resumix/Frontend/User/js/landingpage.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/header.js"></script>
    <script>
        if (window.location.pathname.includes('UserLandingPage.php')) {
            document.querySelector('nav.header-container').classList.add('fixed-header');
        }

        document.querySelectorAll('.list-group-item').forEach(button => {
            button.addEventListener('click', () => {
                const wrapper = button.closest('.step-wrapper');

                document.querySelectorAll('.step-wrapper').forEach(w => w.classList.remove('active'));

                wrapper.classList.add('active');
            });
        });

        const templates = [
        { image: 'http://localhost/Resumix/Images/rm1.png', title: 'Simple Elegance', description: 'Simple, clean layout suitable for all professions' },
        { image: 'http://localhost/Resumix/Images/rm2.png', title: 'Bold Vision', description: 'Bold headings and modern design elements.' },
        { image: 'http://localhost/Resumix/Images/rm1.png', title: 'Professional Minimalist', description: 'Professional layout with a minimalist approach.' },
        { image: 'http://localhost/Resumix/Images/rm1.png', title: 'Executive Look', description: 'Elegant and sophisticated design for executives.' },
        { image: 'http://localhost/Resumix/Images/rm2.png', title: 'Modern Creatives', description: 'Modern layout with creative sections.' },
        { image: 'http://localhost/Resumix/Images/rm2.png', title: 'Clean & Professional', description: 'Clean and professional with easy-to-read fonts.' },
        { image: 'http://localhost/Resumix/Images/rm2.png', title: 'Fresh Design', description: 'Fresh design with a pop of color.' },
        { image: 'http://localhost/Resumix/Images/rm1.png', title: 'Sleek Simplicity', description: 'Sleek and simple layout ideal for any job application.' },
        { image: 'http://localhost/Resumix/Images/rm1.png', title: ' Design', description: 'Fresh design with a pop of color.' },
        { image: 'http://localhost/Resumix/Images/rm1.png', title: ' Simplicity', description: 'Sleek and simple layout ideal for any job application.' }
    ];

    let currentPage = 0;
    const templatesPerPage = 2;

    function renderTemplates() {
        const startIndex = currentPage * templatesPerPage;
        const endIndex = startIndex + templatesPerPage;
        const currentTemplates = templates.slice(startIndex, endIndex);

        const templateList = document.getElementById('template-list');
        templateList.innerHTML = ''; 

        currentTemplates.forEach(template => {
            const templateCard = document.createElement('div');
            templateCard.classList.add('col');
            templateCard.innerHTML = `
                <div class="card temp-card">
                    <img src="${template.image}" class="card-img-top" alt="${template.title}">
                    <div class="card-body text-start">
                        <h5 class="card-title">${template.title}</h5>
                        <p class="card-text">${template.description}</p>
                    </div>
                     <div class="use-template-overlay">
                        <button class="btn btn-primary usebtn" onclick="window.location.href='login.php'" >Use This Template</button>
                    </div>
                </div>
            `;
            templateList.appendChild(templateCard);
        });
    }

    function renderBullets() {
        const bulletsContainer = document.getElementById('bullets');
        bulletsContainer.innerHTML = '';

        const totalPages = Math.ceil(templates.length / templatesPerPage);

        for (let i = 0; i < totalPages; i++) {
            const bullet = document.createElement('button');
            bullet.classList.add('bullet');
            if (i === currentPage) bullet.classList.add('active');
            bullet.addEventListener('click', () => {
                currentPage = i;
                renderTemplates();
                renderBullets();
                updateButtons();
            });
            bulletsContainer.appendChild(bullet);
        }
    }

    function updateButtons() {
        const prevButton = document.getElementById('prev-btn');
        const nextButton = document.getElementById('next-btn');

        const totalPages = Math.ceil(templates.length / templatesPerPage);

        prevButton.disabled = currentPage === 0;
        nextButton.disabled = currentPage === totalPages - 1;
    }

    document.getElementById('prev-btn').addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            renderTemplates();
            renderBullets();
            updateButtons();
        }
    });

    document.getElementById('next-btn').addEventListener('click', () => {
        const totalPages = Math.ceil(templates.length / templatesPerPage);
        if (currentPage < totalPages - 1) {
            currentPage++;
            renderTemplates();
            renderBullets();
            updateButtons();
        }
    });

    renderTemplates();
    renderBullets();
    updateButtons();

    //bullets active
    function renderBullets() {
        const bulletsContainer = document.getElementById('bullets');
        bulletsContainer.innerHTML = ''; 

        const totalPages = Math.ceil(templates.length / templatesPerPage);

        for (let i = 0; i < totalPages; i++) {
            const bullet = document.createElement('div');
            bullet.classList.add('bullet');

            if (i === currentPage) {
                bullet.classList.add('active');
            }

            bulletsContainer.appendChild(bullet);
        }
    }

    let lastScroll = 0;
    const header = document.querySelector('nav.header-container');

    window.addEventListener('scroll', function () {
        const currentScroll = window.pageYOffset;

        if (currentScroll <= 0) {
            header.classList.remove('scroll-up');
            return;
        }

        if (currentScroll > lastScroll && !header.classList.contains('scroll-down')) {
            // Scroll down
            header.classList.remove('scroll-up');
            header.classList.add('scroll-down');
        } else if (currentScroll < lastScroll && header.classList.contains('scroll-down')) {
            // Scroll up
            header.classList.remove('scroll-down');
            header.classList.add('scroll-up');
        }

        lastScroll = currentScroll;
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </body>
    </html>