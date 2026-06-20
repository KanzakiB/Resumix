//Cover Photo 
document.getElementById('coverInput').addEventListener('change', function(event) {
    const fileInput = event.target;
    const formData = new FormData();
    formData.append('cover_photo', fileInput.files[0]);

    fetch('http://localhost/Resumix/Backend/update_cover_photo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.newCoverImage) {
                document.getElementById('coverImageDisplay').src = data.newCoverImage;
            }

            const modal = document.getElementById('successModalCover');
            modal.classList.remove('hidden');
            if (sidebar) sidebar.style.zIndex = "980";

            const okButton = modal.querySelector('#modalOkBtn');
            okButton.onclick = () => {
                modal.classList.add('hidden');
                location.reload(); 
            };
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(() => {
        alert('Error uploading cover photo.');
    });
});
