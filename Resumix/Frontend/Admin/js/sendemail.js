document.addEventListener('DOMContentLoaded', function () {
    const sendBtn = document.querySelector('.sendbtn');

    sendBtn.addEventListener('click', function () {
        sendBtn.disabled = true;
        sendBtn.textContent = 'Sending...';

        fetch('http://localhost/Resumix/Backend/send_verification.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: '' 
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                sendBtn.textContent = 'Sent';
            } else {
                sendBtn.textContent = 'Failed';
                alert(data.message || 'Email sending failed.');
                sendBtn.disabled = false;
            }
        })
        .catch(err => {
            sendBtn.textContent = 'Failed';
            sendBtn.disabled = false;
            console.error(err);
        });
    });
});
