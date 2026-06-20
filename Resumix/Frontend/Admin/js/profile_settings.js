// Picture handler form
function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();
    const saveBtn = document.getElementById('savePhotoBtn');

    if (input.files && input.files[0]) {
        reader.onload = function () {
            const img = document.getElementById('profileImageDisplay');
            img.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);

        // Enable the Save Photo button
        saveBtn.disabled = false;
    } else {
        // Disable the Save Photo button if no file is selected
        saveBtn.disabled = true;
    }
}

// Modal
function handleModalClose(modalId) {
    const modal = document.getElementById(modalId);
    const sidebar = document.querySelector(".sidebar");
    const header = document.querySelector(".header-main");

    if (sidebar) sidebar.style.zIndex = "980";
    if (header) header.style.zIndex = "980";

    const okBtn = modal.querySelector('#modalOkBtn');
    if (okBtn) {
        okBtn.onclick = () => {
            modal.classList.add('hidden');

            if (sidebar) sidebar.style.zIndex = '';
            if (header) header.style.zIndex = '';

            const url = new URL(window.location.href);
            url.searchParams.delete("photo_updated");
            window.history.replaceState({}, document.title, url.pathname);
        };
    }

    modal.classList.remove("hidden");
}

document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("photo_updated")) {
        handleModalClose("successModalPicture");
    }
});

//  Form Handler
document.getElementById('infoForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    const username = formData.get('profile_username').trim();
    const email = formData.get('profile_email').trim();
    const usernameError = document.querySelector('.error-message1');
    const emailError = document.querySelector('.error-message2');

    usernameError.style.display = 'none';
    emailError.style.display = 'none';

    const unameCheck = await fetch(`http://localhost/Resumix/Backend/profile_info_handler.php?field=username&value=${encodeURIComponent(username)}`);
    const unameResult = await unameCheck.text();
    if (unameResult === 'exists') {
        usernameError.style.display = 'block';
        return;
    }

    const emailCheck = await fetch(`http://localhost/Resumix/Backend/profile_info_handler.php?field=email&value=${encodeURIComponent(email)}`);
    const emailResult = await emailCheck.text();
    if (emailResult === 'exists') {
        emailError.style.display = 'block';
        return;
    }

    const updateReq = await fetch(form.action, {
        method: 'POST',
        body: formData
    });

    const updateResult = await updateReq.text();

    if (updateResult === 'success') {
        handleModalClose('successModalInfo');
    } else if (updateResult === 'username_exists') {
        usernameError.style.display = 'block';
    } else if (updateResult === 'email_exists') {
        emailError.style.display = 'block';
    } else if (updateResult === 'required_missing') {
        alert("Username and Email are required!");
    } else {
        alert("Failed to update profile: " + updateResult);
    }
});
