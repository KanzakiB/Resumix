//password eye functions
document.addEventListener('DOMContentLoaded', function() {
    const toggleCurrentPassword = document.getElementById('toggleCurrentPassword');
    const currentPasswordInput = document.getElementById('currentPassword');
    const toggleNewPassword = document.getElementById('NewtogglePassword');
    const newPasswordInput = document.getElementById('newPassword');
    const toggleConfirmPassword = document.getElementById('ConfirmtogglePassword');
    const confirmPasswordInput = document.getElementById('confirmNewPassword');

    if (toggleCurrentPassword) {
        toggleCurrentPassword.addEventListener('click', function() {
            const type = currentPasswordInput.type === 'password' ? 'text' : 'password';
            currentPasswordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    }

    if (toggleNewPassword) {
        toggleNewPassword.addEventListener('click', function() {
            const type = newPasswordInput.type === 'password' ? 'text' : 'password';
            newPasswordInput.type = type;
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

//password change
document.addEventListener("DOMContentLoaded", function () {
    const currentPassword = document.getElementById("currentPassword");
    const newPassword = document.getElementById("newPassword");
    const confirmNewPassword = document.getElementById("confirmNewPassword");

    const errorMsg1 = document.querySelector(".error-message1");
    const errorMsg2 = document.querySelector(".error-message2");
    const errorMsg3 = document.querySelector(".error-message3");
    const errorMsg4 = document.querySelector(".error-message4"); // NEW

    const requirements = document.querySelectorAll(".listrequirements");
    const reqlist = document.querySelector(".reqlist");

    function validateNewPassword(password) {
        const rules = [
            /.{8,}/,
            /[A-Z]/,
            /[!@#$%^&*(),.?":{}|<>]/,
            /\d/
        ];
        return rules.map(rule => rule.test(password));
    }

    // Current Password Checker
    currentPassword.addEventListener("input", function () {
        const val = currentPassword.value;
        if (val.length === 0) {
            errorMsg1.style.display = "none";
            return;
        }

        fetch("http://localhost/Resumix/Backend/verify_password.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `currentPassword=${encodeURIComponent(val)}`
        })
        .then(res => res.json())
        .then(data => {
            errorMsg1.style.display = data.success ? "none" : "block";
        });
    });

    newPassword.addEventListener("focus", function () {
        if (reqlist) reqlist.style.display = "block";
    });

    //Requirements Checker
    newPassword.addEventListener("input", function () {
        if (reqlist) reqlist.style.display = "block";

        const val = newPassword.value;
        const results = validateNewPassword(val);

        errorMsg2.style.display = results.every(Boolean) ? "none" : "block";

        requirements.forEach((item, index) => {
            item.style.color = results[index] ? "green" : "#FF0000";
        });

        const isSameAsCurrent = val === currentPassword.value;
        errorMsg4.style.display = isSameAsCurrent ? "block" : "none";
    });

    // Confirm Password Match
    confirmNewPassword.addEventListener("input", function () {
        const match = confirmNewPassword.value === newPassword.value;
        errorMsg3.style.display = match ? "none" : "block";
    });

    document.getElementById("changePassForm").addEventListener("submit", function (e) {
        e.preventDefault();

        if (
            errorMsg1.style.display === "none" &&
            errorMsg2.style.display === "none" &&
            errorMsg3.style.display === "none" &&
            errorMsg4.style.display === "none" 
        ) {
            fetch("http://localhost/Resumix/Backend/update_password.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `newPassword=${encodeURIComponent(newPassword.value)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const sidebar = document.querySelector(".sidebar");
                    const modal = document.getElementById("successModal");
                    modal.classList.remove("hidden");
                    if (sidebar) sidebar.style.zIndex = "980";


                    const okButton = document.getElementById("modalOkBtn");
                    okButton.addEventListener("click", function () {
                        window.location.href = "admin_profile_settings.php";
                    });
                } else {
                    alert("Error updating password.");
                }
            });
        } else {
            alert("Fix errors before submitting.");
        }
    });
});