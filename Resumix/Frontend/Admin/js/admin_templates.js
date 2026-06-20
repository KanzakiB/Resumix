 document.addEventListener("DOMContentLoaded", function () {
    const previewButtons = document.querySelectorAll(".preview-user-btn");

    previewButtons.forEach(button => {
      button.addEventListener("click", function () {
        const image = this.getAttribute("data-template-image");
        const name = this.getAttribute("data-template-name");

        const modalImage = document.getElementById("previewImage");
        const modalTitle = document.getElementById("cvPreviewModalLabel");

        if (image && modalImage) {
          modalImage.src = image;
        }

        if (name && modalTitle) {
          modalTitle.textContent = name;
        }
      });
    });
  });


document.addEventListener("DOMContentLoaded", () => {
  const deleteModal = document.getElementById("DeleteModal");
  const successModal = document.getElementById("successModalRole");
  const confirmDeleteBtn = document.getElementById("confirmDelete");
  const noBtn = document.getElementById("nobtn");
  const modalOkBtn = document.getElementById("modalOkBtn");

  let deleteTemplateId = null;

  const showModal = modal => modal.classList.remove("hidden");
  const hideModal = modal => modal.classList.add("hidden");

  document.querySelectorAll(".deletebutton").forEach(button => {
    button.addEventListener("click", () => {
      deleteTemplateId = button.getAttribute("data-template-id");
      showModal(deleteModal);
      if (sidebar) sidebar.style.zIndex = "980";
    });
  });

  noBtn.addEventListener("click", () => {
    deleteTemplateId = null;
    hideModal(deleteModal);
  });

  confirmDeleteBtn.addEventListener("click", () => {
    if (!deleteTemplateId) return;

    fetch("http://localhost/Resumix/Backend/delete_template_process.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      },
      body: `id_template=${encodeURIComponent(deleteTemplateId)}`
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          hideModal(deleteModal);
          showModal(successModal);
          if (sidebar) sidebar.style.zIndex = "980";
        } else {
          alert("Delete failed: " + (data.message || "Unknown error"));
        }
      })
      .catch(err => {
        console.error("Network or server error:", err);
        alert("An error occurred during deletion.");
      });
  });

  modalOkBtn.addEventListener("click", () => {
    hideModal(successModal);
    window.location.reload();
  });
});


