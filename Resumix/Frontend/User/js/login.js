//sidebar
window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
        sidebar.classList.remove('active');
    }
});    

//password functions
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('login_password');

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }

});

// Login form submission with role-based redirection
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("login_email").value;
    const password = document.getElementById("login_password").value;

    // Clear previous error messages
    document.querySelector(".error-message1").style.display = "none";
    document.querySelector(".error-message2").style.display = "none";

    fetch("http://localhost/Resumix/Backend/login_process.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `login_email=${encodeURIComponent(email)}&login_password=${encodeURIComponent(password)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            // Redirect based on role
            window.location.href = data.redirect;
        } else if (data.field === "email") {
            document.querySelector(".error-message1").style.display = "block";
        } else if (data.field === "password") {
            document.querySelector(".error-message2").style.display = "block";
        }
    })
    .catch(error => {
        console.error("Login error:", error);
    });
});

