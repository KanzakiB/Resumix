document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("updateUserForm");
    const confirmationModalEl = document.getElementById("saveRoleModal");
    const successModalEl = document.getElementById("successModalRole");
    const modalOkBtn = document.getElementById("modalOkBtn");
    const yesBtn = document.getElementById("confirmSaveBtn");
    const closeBtn = document.getElementById("cancelbtn");

    let selectedRole = "";

    form.addEventListener("submit", function (e) {
        e.preventDefault(); 
        selectedRole = document.getElementById("role").value;
        confirmationModalEl.classList.remove("hidden"); 
        if (sidebar) sidebar.style.zIndex = "980";

    });

    yesBtn.addEventListener("click", function () {
        const userId = form.querySelector('input[name="user_id"]').value;

        fetch("http://localhost/Resumix/Backend/update_user_role.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `user_id=${encodeURIComponent(userId)}&role=${encodeURIComponent(selectedRole)}`
        })
        .then(response => response.text())
        .then(data => {
            confirmationModalEl.classList.add("hidden");
            successModalEl.classList.remove("hidden");
                if (sidebar) sidebar.style.zIndex = "980";

        })
        .catch(error => {
            alert("Error updating role. Please try again.");
            console.error(error);
        });
    });

    modalOkBtn.addEventListener("click", function () {
        successModalEl.classList.add("hidden");
        if (sidebar) sidebar.style.zIndex = "980";
        const userId = form.querySelector('input[name="user_id"]').value;
        window.location.href = `admin_users.php?id=${encodeURIComponent(userId)}`;
    });


    closeBtn.addEventListener("click", function () {
        confirmationModalEl.classList.add("hidden");
    });
});
