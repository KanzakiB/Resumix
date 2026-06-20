document.addEventListener("DOMContentLoaded", function () {
    
    const deleteButtons = document.querySelectorAll(".deletebutton:not([disabled])");
    const deleteModal = document.getElementById("DeleteModal");
    const successModal = document.getElementById("successModalRole");
    const cancelBtn = document.getElementById("nobtn");
    const confirmDeleteBtn = document.getElementById("confirmDelete");
    const modalOkBtn = document.getElementById("modalOkBtn");

    let selectedUserId = null;

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", function () {
            selectedUserId = this.getAttribute("data-user-id");
            console.log("Delete clicked for user:", selectedUserId);
            deleteModal.classList.remove("hidden");
            if (sidebar) sidebar.style.zIndex = "980";
        });
    });

    cancelBtn.addEventListener("click", function () {
        console.log("Cancel clicked");
        deleteModal.classList.add("hidden");
        selectedUserId = null;
    });

    confirmDeleteBtn.addEventListener("click", function () {
        console.log("Yes clicked, selectedUserId:", selectedUserId);
        if (!selectedUserId) {
            console.warn("No user selected!");
            return;
        }

        fetch("http://localhost/Resumix/Backend/delete_user.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `user_id=${encodeURIComponent(selectedUserId)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log("Delete response:", data);
            deleteModal.classList.add("hidden");
            successModal.classList.remove("hidden");
            if (sidebar) sidebar.style.zIndex = "980";

        })
        .catch(error => {
            alert("Error deleting user.");
            console.error(error);
        });
    });

    modalOkBtn.addEventListener("click", function () {
        successModal.classList.add("hidden");
        window.location.href = "admin_registered_users.php";
    });
});
