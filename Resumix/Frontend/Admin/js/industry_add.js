document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addIndustryForm");
    const successModal = document.getElementById("successModalUpdate");
    const modalOkBtn = document.getElementById("modalOkBtn");

    const now = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = now.toLocaleDateString('en-US', options);

    document.getElementById("IndaddDateCreated").value = formattedDate;
    document.getElementById("IndaddLastUpdated").value = formattedDate;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("http://localhost/Resumix/Backend/industry_add_process.php", {
            method: "POST",
            body: formData,
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                successModal.classList.remove("hidden");
                if (sidebar) sidebar.style.zIndex = "980";
            } else {
                alert("Failed: " + data.message);
            }
        })
        .catch(err => {
            console.error("Error:", err);
        });
    });

    modalOkBtn.addEventListener("click", function () {
        successModal.classList.add("hidden");
        location.href = "http://localhost/Resumix/Frontend/Admin/pages/admin_categories.php";
    });
});
