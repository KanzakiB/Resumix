document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("forgotpForm");
    const emailInput = document.getElementById("forgotp_email");
    const errorMessage1 = document.querySelector(".error-message1");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // Reset error visibility
        errorMessage1.style.display = "none";

        const email = emailInput.value;

        fetch("http://localhost/Resumix/Backend/forgotp_process.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `forgotp_email=${encodeURIComponent(email)}`
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "error") {
                if (data.field === "email") {
                    errorMessage1.style.display = "block";
                }
            } else if (data.status === "success") {
                window.location.href = `verification_code.php?email=${encodeURIComponent(email)}`;
            }
        })
        .catch(err => console.error("Request failed", err));
    });
});
