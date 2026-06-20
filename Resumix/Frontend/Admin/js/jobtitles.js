document.addEventListener('DOMContentLoaded', function () {
    let jobIdToDelete = null;
    const deleteButtons = document.querySelectorAll('.deletebutton');
    const deleteModal = document.getElementById('DeleteModal');
    const successModal = document.getElementById('successModalRole');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelBtn = document.getElementById('nobtn');
    const okBtn = document.getElementById('modalOkBtn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            jobIdToDelete = this.getAttribute('data-job-id');
            deleteModal.classList.remove('hidden');
            if (sidebar) sidebar.style.zIndex = "980";
        });
    });

    cancelBtn.addEventListener('click', function () {
        deleteModal.classList.add('hidden');
        jobIdToDelete = null;
    });

    confirmDeleteBtn.addEventListener('click', function () {
        if (!jobIdToDelete) return;

        fetch(`http://localhost/Resumix/Backend/job_delete_process.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${encodeURIComponent(jobIdToDelete)}`
        })
        .then(response => response.json())
        .then(data => {
            deleteModal.classList.add('hidden');
            if (data.success) {
                successModal.classList.remove('hidden');
                if (sidebar) sidebar.style.zIndex = "980";
            } else {
                alert(data.message || 'Failed to delete.');
            }
        })
        .catch(error => {
            console.error('Delete error:', error);
            alert('Error deleting job title.');
        });
    });

    okBtn.addEventListener('click', function () {
        successModal.classList.add('hidden');
        window.location.reload();
    });
});
