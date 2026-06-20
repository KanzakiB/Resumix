document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("editIndustryForm");
    const successModal = document.getElementById("successModalUpdate");
    const modalOkBtn = document.getElementById("modalOkBtn");

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("http://localhost/Resumix/Backend/industry_edit_process.php", {
            method: "POST",
            body: formData,
        })
        .then(async res => {
            const text = await res.text(); 
            try {
                const data = JSON.parse(text);
                return data;
            } catch (err) {
                console.error("Response is not valid JSON:", text);
                throw new Error("Invalid JSON response from server.");
            }
        })
        .then(data => {
            if (data.status === "success") {
                successModal.classList.remove("hidden");
                if (sidebar) sidebar.style.zIndex = "980";
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(err => {
            console.error("Fetch error:", err);
            alert("An unexpected error occurred. Check console for details.");
        });
    });

    modalOkBtn.addEventListener("click", () => {
        successModal.classList.add("hidden");
        window.location.href = "admin_categories.php";
    });
});
