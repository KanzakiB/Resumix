//sidebar
window.addEventListener('resize', function () {
    if (window.innerWidth >= 992) {
        sidebar.classList.remove('active');
    }
});    


//password functions
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('reset_password');

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('reset_confirmPassword');

    

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


//only change this 
document.addEventListener("DOMContentLoaded", () => {
  const passwordInput = document.getElementById("reset_password");
  const confirmInput = document.getElementById("reset_confirmPassword");
  const form = document.getElementById("resetForm");
  const modal = document.getElementById("successModal");
  const modalBtn = document.getElementById("modalOkBtn");
  const errorMatch = document.querySelector(".error-message1");
  const requirementsBox = document.querySelector(".req-list");
  const requirementElements = document.querySelectorAll(".listrequirements");

  const requirements = {
    length: /.{8,}/,
    uppercase: /[A-Z]/,
    special: /[!@#$%^&*(),.?":{}|<>]/,
    number: /[0-9]/,
  };

  function checkRequirements(password) {
    return [
      requirements.length.test(password),
      requirements.uppercase.test(password),
      requirements.special.test(password),
      requirements.number.test(password),
    ];
  }

  passwordInput.addEventListener("focus", () => {
    requirementsBox.style.display = "block";
  });

  passwordInput.addEventListener("blur", () => {
    if (passwordInput.value === "") {
      requirementsBox.style.display = "none";
    }
  });

  passwordInput.addEventListener("input", () => {
    const values = checkRequirements(passwordInput.value);
    requirementElements.forEach((el, idx) => {
      el.classList.toggle("text-success", values[idx]);
      el.classList.toggle("text-danger", !values[idx]);
    });
    errorMatch.style.display = passwordInput.value === confirmInput.value ? "none" : "block";
  });

  confirmInput.addEventListener("input", () => {
    errorMatch.style.display = passwordInput.value === confirmInput.value ? "none" : "block";
  });

  form.addEventListener("submit", (e) => {
    const isValid = checkRequirements(passwordInput.value).every(v => v);
    if (!isValid || passwordInput.value !== confirmInput.value) {
      e.preventDefault();
      errorMatch.style.display = "block";
    } else {
      sessionStorage.setItem("resetSuccess", "true");
    }
  });

  if (sessionStorage.getItem("resetSuccess") === "true") {
    sessionStorage.removeItem("resetSuccess");
    modal.classList.remove("hidden");
  }

  modalBtn.addEventListener("click", () => {
    window.location.href = "login.php";
  });
});
