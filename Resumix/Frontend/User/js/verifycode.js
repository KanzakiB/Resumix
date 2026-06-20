// verifycode.js
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("verifyForm");
  const otpInput = document.getElementById("otpcode");
  const errorMessage = document.querySelector(".error-message1");
  const resendBtn = document.querySelector(".resendbtn");
  const messageDiv = document.querySelector(".resend-message");

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    errorMessage.style.display = "none";

    const otp = otpInput.value.trim();

    fetch("/Resumix/Backend/verify_otp.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `otp=${encodeURIComponent(otp)}`
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        window.location.href = "http://localhost/Resumix/Frontend/User/pages/reset_password.php";
      } else {
        errorMessage.style.display = "block";
      }
    })
    .catch(() => {
      errorMessage.style.display = "block";
    });
  });

  resendBtn.addEventListener("click", function (e) {
    e.preventDefault();
    messageDiv.style.display = "none";

    fetch("/Resumix/Backend/resend_otp.php", {
      method: "POST"
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        messageDiv.textContent = "A new code has been sent to your email.";
        messageDiv.classList.replace("text-danger", "text-success");
      } else {
        messageDiv.textContent = "Failed to resend code. Try again later.";
        messageDiv.classList.replace("text-success", "text-danger");
      }
      messageDiv.style.display = "block";
    })
    .catch(() => {
      messageDiv.textContent = "Something went wrong.";
      messageDiv.classList.replace("text-success", "text-danger");
      messageDiv.style.display = "block";
    });
  });
});
