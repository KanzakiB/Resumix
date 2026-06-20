document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addJobForm');
    const successModal = document.getElementById('successModalUpdate');
    const modalOkBtn = document.getElementById('modalOkBtn');
    const sidebar = document.getElementById('sidebar'); 

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('http://localhost/Resumix/Backend/job_add_process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log('Raw response:', text);
            try {
                const data = JSON.parse(text);
                if (data.success) {
                    successModal.classList.remove('hidden');
                    if (sidebar) sidebar.style.zIndex = "980";
                    form.reset();
                } else {
                    alert(data.message || 'An error occurred.');
                }
            } catch (e) {
                alert('Invalid JSON response, check console.');
                console.error('JSON parse error:', e);
            }
        })
        .catch(error => {
            alert('Fetch error: ' + error);
            console.error('Fetch error:', error);
        });

    });

    modalOkBtn.addEventListener('click', function () {
        successModal.classList.add('hidden');
        window.location.href = "admin_job.php";
    });
});
