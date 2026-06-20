function addFileImage() {
    const input = document.getElementById('edittemplateImage');
    const preview = document.getElementById('Tempimage');
    const fileNameSpan = document.getElementById('fileName');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);

        fileNameSpan.textContent = input.files[0].name;
    }
}

function addTemplateFile() {
    const fileInput = document.getElementById('edittemplateFile');
    const fileNameSpan = document.getElementById('fileTypeName');

    if (fileInput.files.length > 0) {
        fileNameSpan.textContent = fileInput.files[0].name;
    }
}

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("edittemplateForm");
  const successModal = document.getElementById("successModalUpdate");
  const modalOkBtn = document.getElementById("modalOkBtn");

  form.addEventListener("submit", async (e) => {
    e.preventDefault(); 

    const formData = new FormData(form);

    const urlParams = new URLSearchParams(window.location.search);
    const templateId = urlParams.get("id");
    if (!templateId) {
      alert("Invalid template ID.");
      return;
    }
    formData.append("templateId", templateId);

    try {
      const response = await fetch("http://localhost/Resumix/Backend/edit_template_process.php?id=" + templateId, {
        method: "POST",
        body: formData
      });

      const text = await response.text();

      if (response.ok && text.trim() === "success") {
        successModal.classList.remove("hidden");
        if (sidebar) sidebar.style.zIndex = "980";
      } else {
        alert("Update failed: " + text);
      }
    } catch (error) {
      alert("Error submitting form: " + error.message);
      console.error(error);
    }
  });

  modalOkBtn.addEventListener("click", () => {
    successModal.classList.add("hidden");
    window.location.href = "http://localhost/Resumix/Frontend/Admin/pages/admin_templates.php?msg=updated";
  });
});
