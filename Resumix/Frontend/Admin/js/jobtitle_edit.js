document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editJobForm');
    const successModal = document.getElementById('successModalUpdate');
    const modalOkBtn = document.getElementById('modalOkBtn');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const jobId = formData.get('jobId');
        if (!jobId) {
            alert('Missing job ID.');
            return;
        }

        fetch('http://localhost/Resumix/Backend/job_edit_process.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                successModal.classList.remove('hidden');
                if (sidebar) sidebar.style.zIndex = "980";
            } else {
                alert(data.message || 'An error occurred.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Network error.');
        });
    });

    modalOkBtn.addEventListener('click', function () {
        successModal.classList.add('hidden');
        window.location.href = "admin_job.php";
    });
});
