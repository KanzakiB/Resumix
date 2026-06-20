<?php
// workhistory_qa.php
// PHP backend logic for handling work experience choice

$hasWorkExperience = null; // null, true, or false
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['work_experience_choice'])) {
        $choice = $_POST['work_experience_choice'];
        if ($choice === 'yes') {
            $hasWorkExperience = true;
            $message = 'Great! You chose to add work experience. (Further steps would follow here)';
            // In a real application, you might redirect to a form to add work experience details.
            // header('Location: add_work_experience.php');
            // exit();
        } elseif ($choice === 'no') {
            $hasWorkExperience = false;
            $message = 'Okay, you chose not to add work experience. (Proceeding to next section)';
            // In a real application, you might redirect to the next section (e.g., Education).
            // header('Location: education.php');
            // exit();
        }
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
    <link rel="stylesheet" href="workhistory_qa.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/lucide.min.js"></script>
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
            <p class="fs-5 fw-medium text-dark mb-4">Do you have any work experience?</p>

            <?php if (!empty($message)): ?>
                <div class="alert alert-info alert-dismissible fade show rounded-3" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="mb-5">
                <p class="text-muted small mb-3">
                    Here's what you need to know: You can include any work experience,
                    internships, scholarships, relevant coursework and academic achievements.
                </p>
                <div class="row g-4">
                    <div class="col-md-6 d-flex flex-column"> <div class="info-box border rounded-3 p-4 h-100 mb-4"> <h5 class="fw-bold text-dark mb-3">What Counts as Work Experience:</h5>
                            <ul class="list-unstyled flex-grow-1">
                                <li class="mb-2"><i data-lucide="check-circle" class="text-success me-2 icon-sm"></i>Full-time or part-time jobs (e.g., Cashier at Jollibee, IT Support in a company)</li>
                                <li class="mb-2"><i data-lucide="check-circle" class="text-success me-2 icon-sm"></i>Freelance projects (e.g., Built a website for a local business)</li>
                                <li class="mb-2"><i data-lucide="check-circle" class="text-success me-2 icon-sm"></i>Paid internships or apprenticeships</li>
                                <li class="mb-2"><i data-lucide="check-circle" class="text-success me-2 icon-sm"></i>Home-based or online jobs (e.g., Virtual assistant, Online tutor)</li>
                                <li class="mb-2"><i data-lucide="check-circle" class="text-success me-2 icon-sm"></i>Business or side hustle experience (e.g., Selling items online, Managing a small shop)</li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-center">
                            <form id="workExperienceFormYes" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="w-100">
                                <button type="submit" name="work_experience_choice" value="yes" class="btn btn-primary w-75 py-3 fw-medium rounded-3">Yes, I do</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex flex-column"> <div class="info-box border rounded-3 p-4 h-100 mb-4"> <h5 class="fw-bold text-dark mb-3">What Are Not Considered as Work Experience:</h5>
                            <ul class="list-unstyled flex-grow-1">
                                <li class="mb-2"><i data-lucide="x-circle" class="text-danger me-2 icon-sm"></i>OJT / Internship as part of school requirements</li>
                                <li class="mb-2"><i data-lucide="x-circle" class="text-danger me-2 icon-sm"></i>Capstone or thesis projects</li>
                                <li class="mb-2"><i data-lucide="x-circle" class="text-danger me-2 icon-sm"></i>School group or individual projects</li>
                                <li class="mb-2"><i data-lucide="x-circle" class="text-danger me-2 icon-sm"></i>Volunteer work (e.g., helping during barangay activities)</li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-center">
                            <form id="workExperienceFormNo" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="w-100">
                                <button type="submit" name="work_experience_choice" value="no" class="btn btn-primary w-75 py-3 fw-medium rounded-3">No, I do not have</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium">Preview</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for icon rendering
        document.addEventListener('DOMContentLoaded', function() {
            // Render Lucide icons
            lucide.createIcons();
        });
    </script>
</body>
</html>
