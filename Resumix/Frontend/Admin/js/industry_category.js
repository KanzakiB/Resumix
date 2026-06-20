document.addEventListener('DOMContentLoaded', () => {
  const deleteButtons = document.querySelectorAll('.deletebutton');
  const deleteModal = document.getElementById('DeleteModal');
  const noBtn = document.getElementById('nobtn');
  const confirmDeleteBtn = document.getElementById('confirmDelete');
  const successModal = document.getElementById('successModalRole');
  const modalOkBtn = document.getElementById('modalOkBtn');

  let selectedIndustryId = null;

  deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
      selectedIndustryId = button.getAttribute('data-industry-id');
      deleteModal.classList.remove('hidden');
      if (sidebar) sidebar.style.zIndex = "980";
    });
  });

  noBtn.addEventListener('click', () => {
    deleteModal.classList.add('hidden');
    selectedIndustryId = null;
  });

  confirmDeleteBtn.addEventListener('click', () => {
    if (!selectedIndustryId) return;

    fetch('http://localhost/Resumix/Backend/industry_delete_process.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'id=' + encodeURIComponent(selectedIndustryId)
    })
    .then(response => response.json())
    .then(data => {
      deleteModal.classList.add('hidden');
      if (data.success) {
        successModal.classList.remove('hidden');
        if (sidebar) sidebar.style.zIndex = "980";
      } else {
        alert('Delete failed: ' + data.message);
      }
    })
    .catch(() => alert('An error occurred'));

    selectedIndustryId = null;
  });

  modalOkBtn.addEventListener('click', () => {
    successModal.classList.add('hidden');
    location.reload();  
  });
});


document.addEventListener("DOMContentLoaded", function () {
    const jobTitlesModal = new bootstrap.Modal(document.getElementById('jobTitlesModal'));
    const jobTitlesList = document.getElementById('jobTitlesList');
    const jobTitlesModalLabel = document.getElementById('jobTitlesModalLabel');

    document.querySelectorAll('.list').forEach(btn => {
        btn.addEventListener('click', function () {
            const industryId = this.getAttribute('data-industry-id');
            const industryName = this.getAttribute('data-industry-name'); 

            fetch(`http://localhost/Resumix/Backend/fetch_jobtitles.php?industry_id=${industryId}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        jobTitlesList.innerHTML = `<li class="text-danger">Failed to load job titles</li>`;
                        jobTitlesModalLabel.textContent = "Error";
                    } else {
                        jobTitlesModalLabel.textContent = `${industryName}`;
                        jobTitlesList.innerHTML = '';

                        if (data.job_titles.length > 0) {
                            data.job_titles.forEach(title => {
                                const li = document.createElement('li');
                                li.textContent = title;
                                jobTitlesList.appendChild(li);
                            });
                        } else {
                            jobTitlesList.innerHTML = `<li class="text-muted">No job titles found.</li>`;
                        }
                    }

                    jobTitlesModal.show();
                })
                .catch(error => {
                    console.error('Error fetching job titles:', error);
                    jobTitlesList.innerHTML = `<li class="text-danger">Error loading job titles</li>`;
                    jobTitlesModalLabel.textContent = "Error";
                    jobTitlesModal.show();
                });
        });
    });
});
