<?php
// work_history.php
// PHP backend logic for handling work experience submission

// Database connection (replace with your actual credentials)
// For demonstration, we'll simulate database interaction.
// In a real application, you'd use PDO or mysqli to connect to your database.
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'your_database_name';

// --- Simulate fetching data for dropdowns ---
// In a real scenario, these would come from your 'rm_jobtitles' and 'rm_arrangement' tables.
$job_titles = [
    1 => 'Software Engineer',
    2 => 'Project Manager',
    3 => 'Marketing Specialist',
    4 => 'Graphic Designer',
    5 => 'Customer Service Representative'
];

$work_arrangements = [
    1 => 'Remote',
    2 => 'Hybrid',
    3 => 'On-site'
];

// Generate years for Start/End Date dropdowns
$current_year = date('Y');
$years = range($current_year, $current_year - 60); // Last 60 years

// --- Form Submission Handling ---
$message = '';
$message_type = ''; // 'success' or 'danger'

// Initialize form fields for sticky form behavior
// These variables will hold the values if the form was submitted and had errors,
// or if the user clicked 'Cancel' on the modal.
$wh_current = isset($_POST['wh_current']) ? 1 : 0;
$job_title_id = htmlspecialchars($_POST['job_title'] ?? '');
$company_name = htmlspecialchars(trim($_POST['company_name'] ?? ''));
$company_loc = htmlspecialchars(trim($_POST['company_loc'] ?? ''));
$work_arrangement_id = htmlspecialchars($_POST['work_arrangement'] ?? '');
$start_year = htmlspecialchars($_POST['start_year'] ?? '');
$end_year = htmlspecialchars($_POST['end_year'] ?? '');

// Only process form submission if 'next_job_description' was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['next_job_description'])) {
    // Sanitize and validate inputs (expand as needed for production)
    $resume_id = 1; // Placeholder: In a real app, get this from session or previous step

    // Re-assign values from POST for validation, as they might have been cleared client-side if 'Add another' was pressed
    $wh_current = isset($_POST['wh_current']) ? 1 : 0;
    $job_title_id = filter_var($_POST['job_title'] ?? '', FILTER_VALIDATE_INT);
    $company_name = htmlspecialchars(trim($_POST['company_name'] ?? ''));
    $company_loc = htmlspecialchars(trim($_POST['company_loc'] ?? ''));
    $work_arrangement_id = filter_var($_POST['work_arrangement'] ?? '', FILTER_VALIDATE_INT);
    $start_year = filter_var($_POST['start_year'] ?? '', FILTER_VALIDATE_INT);
    $end_year = $wh_current ? null : filter_var($_POST['end_year'] ?? '', FILTER_VALIDATE_INT); // Null if currently working

    // Validate required fields (basic check)
    $errors = [];
    if (empty($job_title_id)) $errors[] = 'Job Title is required.';
    if (empty($company_name)) $errors[] = 'Company Name is required.';
    if (empty($company_loc)) $errors[] = 'Location is required.';
    if (empty($work_arrangement_id)) $errors[] = 'Work Arrangement is required.';
    if (empty($start_year)) $errors[] = 'Start Year is required.';
    if (!$wh_current && empty($end_year)) $errors[] = 'End Year is required if not currently working here.';

    if (empty($errors)) {
        // --- Simulate database insert ---
        // In a real application, you would prepare and execute an SQL INSERT statement.
        /*
        try {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO rm_work_history (FKrm_resumeid_resume, wh_current, FKrm_jobtitlesid_jobtitle, company_name, company_loc, FKrm_arrangementid_workArr) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$resume_id, $wh_current, $job_title_id, $company_name, $company_loc, $work_arrangement_id]);

            $message = 'Work experience added successfully!';
            $message_type = 'success';

        } catch (PDOException $e) {
            $message = 'Database error: ' . $e->getMessage();
            $message_type = 'danger';
        }
        */

        // For demonstration purposes:
        $message = 'Work experience submission simulated successfully! (Job: ' . ($job_titles[$job_title_id] ?? 'N/A') . ', Company: ' . $company_name . ')';
        $message_type = 'success';

        // Redirect to the next page
        header('Location: nonwork_experience.php'); // Redirect to nonwork_experience.php
        exit();

    } else {
        $message = 'Please correct the following: ' . implode(', ', $errors);
        $message_type = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/lucide.min.js"></script>
    <link href="work_history.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="card shadow-sm rounded-3 p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="#" class="text-dark">
                    <i data-lucide="arrow-left" class="icon-lg"></i>
                </a>
                <i data-lucide="lightbulb" class="icon-lg"></i>
            </div>

            <h2 class="mb-3 fw-bold text-dark">Tell us about your work experience.</h2>
            <p class="mb-4"><a href="#" class="text-decoration-none resume-link">See work history summary</a></p>

            <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show rounded-3" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form id="workHistoryForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" value="1" id="whCurrent" name="wh_current" <?php echo ($wh_current == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="whCurrent">
                        I currently work here.
                    </label>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="startYear" class="form-label fw-medium">Start *</label>
                        <select class="form-select" id="startYear" name="start_year" required>
                            <option value="">Year</option>
                            <?php foreach ($years as $year): ?>
                                <option value="<?php echo $year; ?>" <?php echo ($start_year == $year) ? 'selected' : ''; ?>>
                                    <?php echo $year; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="endYear" class="form-label fw-medium">End *</label>
                        <select class="form-select" id="endYear" name="end_year" <?php echo ($wh_current == 1) ? 'disabled' : ''; ?> required>
                            <option value="">Year</option>
                            <?php foreach ($years as $year): ?>
                                <option value="<?php echo $year; ?>" <?php echo ($end_year == $year) ? 'selected' : ''; ?>>
                                    <?php echo $year; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="jobTitle" class="form-label fw-medium">Job Title *</label>
                        <select class="form-select" id="jobTitle" name="job_title" required>
                            <option value="">Select Job Title</option>
                            <?php foreach ($job_titles as $id => $title): ?>
                                <option value="<?php echo $id; ?>" <?php echo ($job_title_id == $id) ? 'selected' : ''; ?>>
                                    <?php echo $title; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="companyName" class="form-label fw-medium">Company Name</label>
                        <input type="text" class="form-control" id="companyName" name="company_name" value="<?php echo htmlspecialchars($company_name); ?>" placeholder="Company Name">
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="location" class="form-label fw-medium">Location *</label>
                        <input type="text" class="form-control" id="location" name="company_loc" value="<?php echo htmlspecialchars($company_loc); ?>" required placeholder="e.g., Taguig, Metro Manila">
                    </div>
                    <div class="col-md-6">
                        <label for="workArrangement" class="form-label fw-medium">Work Arrangement *</label>
                        <select class="form-select" id="workArrangement" name="work_arrangement" required>
                            <option value="">ex:: Remote, Hybrid, etc.</option>
                            <?php foreach ($work_arrangements as $id => $arrangement): ?>
                                <option value="<?php echo $id; ?>" <?php echo ($work_arrangement_id == $id) ? 'selected' : ''; ?>>
                                    <?php echo $arrangement; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-5">
                    <button type="button" class="btn btn-outline-dark rounded-3 px-4 py-2 fw-medium" data-bs-toggle="modal" data-bs-target="#addAnotherModal">Add another</button>
                    <button type="submit" name="next_job_description" class="btn btn-primary rounded-3 px-4 py-2 fw-medium">Next: Job Description</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="addAnotherModal" tabindex="-1" aria-labelledby="addAnotherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg p-4">
                <div class="modal-body text-center">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGQ9Ik01MCA4My4zMzMzQzc1Ljc0NzYgODMuMzMzMyA5Ni42NjY3IDYyLjQxNDIgOTYuNjY2NyAzNi42NjY3Qzk2LjY2NjcgMTAuOTE5MSA3NS43NDc2IC0xMC4yMzgxIDUwIC0xMC4yMzgxQzI0LjI1MjQgLTEwLjIzODEgMy4zMzMzMyAxMC45MTkxIDMuMzMzMzMgMzYuNjY2N0wzLjMzMzMzIDM2LjY2NjdDMy4zMzMzMyA2Mi40MTQyIDI0LjI1MjQgODMuMzMzMyA1MCA4My4zMzMzWk0zMy4zMzMzIDM2LjY2NjdDMzMuMzMzMyAyMi41NDQyIDQ0LjU0NDIgMTEuMzMzMyA1MCAxMS4zMzMzQzU1LjQ1NTggMTEuMzMzMyA2Ni42NjY3IDIyLjU0NDIgNjYuNjY2NyAzNi42NjY3QzY2LjY2NjcgNTAuNzg5MSA1NS40NTU4IDYxLjk5OTkgNTAgNjEuOTk5OUM0NC41NDQyIDYxLjk5OTkgMzMuMzMzMyA1MC43ODkxIDMzLjMzMzMgMzYuNjY2N1oiIGZpbGw9IiMwMDdCRkYiLz4KPHBhdGggZD0iTTUwIDAuMDAwMDQ1NzU2NUM3Ny42MTQyIDAuMDAwMDQ1NzU2NSAxMDAgMjIuMzg1OSAxMDAgNTBDMTAwIDc3LjYxNDIgNzcuNjE0MiAxMDAgNTAgMTAwQzIyLjM4NTggMTAwIDAgNzcuNjE0MiAwIDUwQzAgMjIuMzg1OSAyMi4zODU4IDAuMDAwMDQ1NzU2NSA1MCAwLjAwMDA0NTc1NjVaTTUwIDguMzMzMzRDNDQuNTQ0MiA4LjMzMzM0IDMzLjMzMzMgMTkuNTQ0MiAzMy4zMzMzIDMzLjMzMzNDMzMuMzMzMyA0Ny4xNTU4IDQ0LjU0NDIgNTguMzY2NyA1MCA1OC4zNjY3QzU1LjQ1NTggNTguMzY2NyA2Ni42NjY3IDQ3LjE1NTggNjYuNjY2NyAzMy4zMzMzQzY2LjY2NjcgMTkuNTQ0MiA1NS40NTU4IDguMzMzMzQgNTAgOC4zMzMzNFoiIGZpbGw9IiNGRkZGRkYiLz4KPC9zdmc+Cg==" alt="Info Icon" class="mb-4">
                    <h5 class="fw-bold mb-3">Add another work experience?</h5>
                    <p class="text-muted mb-4">
                        If you have more work experience to add, click "Add another" to clear the form and add a new entry.
                        Otherwise, click "Next" to proceed to job description.
                    </p>
                </div>
                <div class="modal-footer d-flex justify-content-center border-0 pt-0">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAddAnother">Add another</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            const whCurrentCheckbox = document.getElementById('whCurrent');
            const endYearSelect = document.getElementById('endYear');
            const workHistoryForm = document.getElementById('workHistoryForm');
            const confirmAddAnotherButton = document.getElementById('confirmAddAnother');
            const addAnotherModal = new bootstrap.Modal(document.getElementById('addAnotherModal'));

            // Function to toggle end year field
            function toggleEndYear() {
                if (whCurrentCheckbox.checked) {
                    endYearSelect.value = ''; // Clear value when disabled
                    endYearSelect.setAttribute('disabled', 'disabled');
                    endYearSelect.removeAttribute('required'); // Remove required attribute
                } else {
                    endYearSelect.removeAttribute('disabled');
                    endYearSelect.setAttribute('required', 'required'); // Add required attribute back
                }
            }

            // Initial call to set state based on PHP's pre-filled value
            toggleEndYear();

            // Event listener for checkbox change
            whCurrentCheckbox.addEventListener('change', toggleEndYear);

            // Handle "Add another" button click in the modal
            confirmAddAnotherButton.addEventListener('click', function() {
                // Clear the form fields
                workHistoryForm.reset();
                // Uncheck "I currently work here" and re-enable end year
                whCurrentCheckbox.checked = false;
                toggleEndYear();
                // Hide the modal
                addAnotherModal.hide();
                // Optionally, display a success message or clear previous messages
                const alertDiv = document.querySelector('.alert');
                if (alertDiv) {
                    alertDiv.remove();
                }
            });

            // Handle modal close (e.g., by clicking outside or 'Cancel' button)
            addAnotherModal._element.addEventListener('hidden.bs.modal', function () {
                // If the form was submitted with errors and then the modal was dismissed,
                // the PHP variables will still hold the old values.
                // To prevent re-populating the form with old data if the user just closed the modal,
                // we might need to reset the form if it wasn't a successful "Add another".
                // For this simple example, we'll rely on the PHP re-rendering logic.
            });
        });
    </script>
</body>
</html>
