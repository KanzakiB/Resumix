//sidebar
window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
        sidebar.classList.remove('active');
    }
});    

//password functions
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('signup_password');

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('signup_confirmPassword');

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }

    if (toggleConfirmPassword) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
            confirmPasswordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }
});


document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".form-container");
    const usernameInput = document.querySelector("#username");
    const emailInput = document.querySelector("#email");
    const passwordInput = document.querySelector("#signup_password");
    const confirmInput = document.querySelector("#signup_confirmPassword");

    const errorUsername = document.querySelector(".error-message1");
    const errorEmail = document.querySelector(".error-message2");
    const errorMatch = document.querySelector(".error-message3");

    const reqItems = document.querySelectorAll(".listrequirements");

    function validatePasswordRequirements(value) {
        const requirements = [
            /.{8,}/,
            /[A-Z]/,
            /[!@#$%^&*(),.?":{}|<>]/,
            /[0-9]/
        ];
        requirements.forEach((regex, index) => {
            if (regex.test(value)) {
                reqItems[index].classList.add("text-success");
            } else {
                reqItems[index].classList.remove("text-success");
            }
        });
    }

    passwordInput.addEventListener("focus", () => {
        document.querySelector(".req-list").style.display = "block";
    });

    passwordInput.addEventListener("input", (e) => {
        validatePasswordRequirements(e.target.value);
    });

    confirmInput.addEventListener("input", () => {
        if (confirmInput.value !== passwordInput.value) {
            errorMatch.style.display = "block";
        } else {
            errorMatch.style.display = "none";
        }
    });

    form.addEventListener("submit", (e) => {
        e.preventDefault();

        const data = {
            username: usernameInput.value,
            email: emailInput.value,
            signup_password: passwordInput.value,
            signup_confirmPassword: confirmInput.value
        };

        fetch("http://localhost/Resumix/Backend/signup_process.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: new URLSearchParams(data).toString()
        })
        .then(res => res.json())
        .then(response => {
            errorUsername.style.display = "none";
            errorEmail.style.display = "none";
            errorMatch.style.display = "none";

            if (response.status === "success") {
                const modal = document.getElementById("successModal");
                const modalMessage = document.getElementById("modalMessage");
                const modalOkBtn = document.getElementById("modalOkBtn");
            
                modalMessage.textContent = "Signup successful!";
                modal.classList.remove("hidden");
                document.body.style.overflow = "hidden";

                modalOkBtn.onclick = function () {
                    document.body.style.overflow = "auto";
                    window.location.href = "login.php";
                };
            } else if (response.field === "username") {
                errorUsername.style.display = "block";
            } else if (response.field === "email") {
                errorEmail.style.display = "block";
            } else if (response.field === "password_mismatch") {
                errorMatch.style.display = "block";
            } else {
                alert("Something went wrong. Try again.");
            }
        });
    });
});
