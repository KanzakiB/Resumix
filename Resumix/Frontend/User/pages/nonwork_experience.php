<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Non-Work Experience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="nonwork_experience.css">
</head>
<body>

    <?php
    // PHP section to handle form submission
    $message = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the experience data was sent
        if (isset($_POST['experience'])) {
            $experience = htmlspecialchars($_POST['experience']); // Sanitize input
            $message = "<div class='alert alert-success mt-3' role='alert'>
                            Experience submitted successfully! <br> Your experience: <strong>" . $experience . "</strong>
                        </div>";
            // In a real application, you would save this to a database or file
            // For this example, we just display it.
        } else {
            $message = "<div class='alert alert-danger mt-3' role='alert'>
                            No experience data received.
                        </div>";
        }
    }
    ?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="#" class="text-dark fs-4" aria-label="Go back"><i class="fas fa-arrow-left"></i></a>
            <i class="fas fa-lightbulb text-warning fs-4" id="lightbulbTip"
               data-bs-toggle="popover"
               data-bs-placement="bottom"
               data-bs-trigger="hover focus"
               data-bs-content="Share your school projects or volunteer work—anything that shows your skills and growth."></i>
        </div>

        <h1 class="mb-3">Tell us about your non-work experience.</h1>
        <p class="text-muted mb-4">No work experience? No problem! Share your school projects or volunteer work—anything that shows your skills and growth.</p>

        <form method="POST" action="nonwork_experience.php">
            <div class="editor-wrapper">
                <textarea class="form-control" id="experienceText" name="experience" placeholder="Enter experience here" rows="10"></textarea>
                <div class="d-flex justify-content-between border border-3 align-items-center">
                    <div>
                        <button type="button" class="btn icon-button" data-command="bold" title="Bold"><i class="fas fa-bold"></i></button>
                        <button type="button" class="btn icon-button" data-command="italic" title="Italic"><i class="fas fa-italic"></i></button>
                        <button type="button" class="btn icon-button" data-command="underline" title="Underline"><i class="fas fa-underline"></i></button>
                        <button type="button" class="btn icon-button" data-command="insertUnorderedList" title="List"><i class="fas fa-list-ul"></i></button>
                    </div>
                    <div>
                        <button type="button" class="btn icon-button" data-command="undo" title="Undo"><i class="fas fa-undo"></i></button>
                        <button type="button" class="btn icon-button" data-command="redo" title="Redo"><i class="fas fa-redo"></i></button>
                    </div>
                </div>
            </div>

            <?php echo $message; ?>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-outline-primary px-4" id="previewBtn">Preview</button>
                <button type="submit" class="btn btn-primary px-4">Next: Education</button>
            </div>
        </form>

        <div class="preview-box" id="previewContent" style="display: none;">
            <h5>Preview:</h5>
            <div id="previewText"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript section
        document.addEventListener('DOMContentLoaded', function() {
            const experienceTextarea = document.getElementById('experienceText');
            const previewBtn = document.getElementById('previewBtn');
            const previewContent = document.getElementById('previewContent');
            const previewText = document.getElementById('previewText');
            const formattingButtons = document.querySelectorAll('.icon-button');

            // Initialize Bootstrap Popovers
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

            // Function to apply basic formatting (for demonstration)
            function applyFormatting(command) {
                // For a real rich text editor, you'd use document.execCommand() or a library
                // This is a simplified example.
                const start = experienceTextarea.selectionStart;
                const end = experienceTextarea.selectionEnd;
                const selectedText = experienceTextarea.value.substring(start, end);
                let newText = experienceTextarea.value;

                if (selectedText) {
                    switch (command) {
                        case 'bold':
                            newText = newText.substring(0, start) + '<b>' + selectedText + '</b>' + newText.substring(end);
                            break;
                        case 'italic':
                            newText = newText.substring(0, start) + '<i>' + selectedText + '</i>' + newText.substring(end);
                            break;
                        case 'underline':
                            newText = newText.substring(0, start) + '<u>' + selectedText + '</u>' + newText.substring(end);
                            break;
                        case 'insertUnorderedList':
                            // Simple list prepend
                            const lines = selectedText.split('\n');
                            const formattedLines = lines.map(line => `- ${line}`);
                            newText = newText.substring(0, start) + formattedLines.join('\n') + newText.substring(end);
                            break;
                        case 'undo':
                        case 'redo':
                            // These require tracking history, which is complex for a simple example.
                            // In a real scenario, you'd integrate with a rich text editor.
                            console.log(`Command '${command}' not fully implemented in this simple example.`);
                            break;
                    }
                    experienceTextarea.value = newText;
                }
            }

            // Event listener for formatting buttons
            formattingButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const command = this.dataset.command;
                    applyFormatting(command);
                });
            });

            // Event listener for the Preview button
            previewBtn.addEventListener('click', function() {
                const experienceContent = experienceTextarea.value;
                if (experienceContent.trim() !== '') {
                    // Display the content in the preview box
                    // Using innerHTML for basic HTML tags (like <b>, <i>, <u>)
                    previewText.innerHTML = experienceTextarea.value.replace(/\n/g, '<br>'); // Convert newlines to <br> for display
                    previewContent.style.display = 'block'; // Show the preview box
                } else {
                    previewText.innerHTML = 'No experience entered to preview.';
                    previewContent.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
