document.getElementById('templateImage').addEventListener('change', function() {
    const fileName = this.files.length ? this.files[0].name : 'No file chosen';
    document.getElementById('fileName').textContent = fileName;
});

function addTemplateFile() {
    const input = document.getElementById('templateFile');
    const fileNameDisplay = document.getElementById('fileTypeName');

    if (input.files && input.files[0]) {
        fileNameDisplay.textContent = input.files[0].name;
    } else {
        fileNameDisplay.textContent = 'No file chosen';
    }
}


function addFileImage() {
    const input = document.getElementById('templateImage');
    const preview = document.getElementById('Tempimage');
    const fileNameDisplay = document.getElementById('fileName');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        fileNameDisplay.textContent = input.files[0].name;
    } else {
        preview.src = "http://localhost/Resumix/Images/rm1.png"; e
        fileNameDisplay.textContent = "No file chosen";
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: '2-digit' };
    const formattedDate = today.toLocaleDateString('en-US', options); 

    document.getElementById("templateDateCreated").value = formattedDate;
    document.getElementById("templateLastUpdated").value = formattedDate;
});


document.getElementById('templateForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('http://localhost/Resumix/Backend/add_template_process.php', { 
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccessModal();
            form.reset(); 
            document.getElementById('fileName').textContent = 'No file chosen'; 
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(err => {
        alert('Request failed: ' + err);
    });
});

function showSuccessModal() {
    const modal = document.getElementById('successModalAdd');
    modal.classList.remove('hidden');
    if (sidebar) sidebar.style.zIndex = "980";
}

document.getElementById('modalOkBtn').addEventListener('click', () => {
    const modal = document.getElementById('successModalAdd');
    modal.classList.add('hidden');
    location.href = 'admin_templates.php';
});
