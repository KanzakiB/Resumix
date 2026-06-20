
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('openSidebar');
    const navLinks = document.querySelectorAll('#sidebar .nav-link');   

    toggleButton.addEventListener('click', function () {
        sidebar.classList.toggle('active');
    });

    closeButton.addEventListener('click', function () {
        sidebar.classList.remove('active');
    });

    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            sidebar.classList.remove('active'); 
        });
    });   