const sidebar = document.getElementById('sidebar');
const burgerButton = document.getElementById('openSidebar');
const navLinks = document.querySelectorAll('.sidebar .nav-link');

burgerButton.addEventListener('click', () => {
    sidebar.classList.toggle('open');
});

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 991) {
            sidebar.classList.remove('open');
        }
    });
});