<?php
// worktype.php - Page for job title selection, now with hardcoded sample job titles.

// --- Database Connection (COMMENTED OUT FOR HARDCODED SAMPLES) ---
// If you switch back to database, uncomment this section and the prepared statement logic below.
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resumixdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/

// --- Get Industry ID from URL (still relevant for passing to next page) ---
$selected_industry_id = null;
if (isset($_GET['industry_id']) && is_numeric($_GET['industry_id'])) {
    $selected_industry_id = (int)$_GET['industry_id'];
}

// --- Sample Job Titles (HARDCODED) ---
// This replaces the database fetch for demonstration purposes.
$jobtitles = [
    ['id_jobtitles' => 1, 'job_title' => 'Software Engineer'],
    ['id_jobtitles' => 2, 'job_title' => 'Project Manager'],
    ['id_jobtitles' => 3, 'job_title' => 'Graphic Designer'],
    ['id_jobtitles' => 4, 'job_title' => 'Marketing Specialist'],
    ['id_jobtitles' => 5, 'job_title' => 'Accountant'],
    ['id_jobtitles' => 6, 'job_title' => 'Human Resources Manager'],
    ['id_jobtitles' => 7, 'job_title' => 'Data Analyst'],
    ['id_jobtitles' => 8, 'job_title' => 'Customer Service Representative'],
    ['id_jobtitles' => 9, 'job_title' => 'Registered Nurse'],
    ['id_jobtitles' => 10, 'job_title' => 'Financial Advisor'],
];

// Sort them alphabetically for better UX, similar to what ORDER BY would do
usort($jobtitles, function($a, $b) {
    return strcmp($a['job_title'], $b['job_title']);
});


// --- Database Connection Close (COMMENTED OUT) ---
// if (isset($conn) && $conn) {
//     $conn->close();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumix - Select Job Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="industry_selection.css">
    <link rel="stylesheet" href="indus_header.css">
    <link rel="stylesheet" href="indus_footer.css">
    <link href="http://localhost/Resumix/Frontend/User/css/user_dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="skip-link-container">
        <a href="personal_info.php" class="skip-link">Skip</a>
    </div>

    <div class="main-wrapper d-flex flex-column min-vh-100">
        <?php
        include 'header.php'; // Assuming header.php is in the same directory
        ?>

        <div class="container my-auto py-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-6 d-flex justify-content-center mb-4 mb-md-0">
                    <div class="illustration-placeholder">
                        <img src="https://placehold.co/400x300/e0eaf7/6b8ed3?text=Job+Title+Illustration" alt="Job Title Illustration" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 col-md-6 text-center text-md-start">
                    <h2 class="title-text mb-3">What job title are you trying to apply for?</h2>
                    <p class="description-text mb-4">Choose what type of job title are you trying to apply for so we could recommend the best template for you.</p>

                    <div class="form-group mb-4">
                        <label for="jobTitleSelect" class="form-label visually-hidden">Select Job Title</label>
                        <select class="form-select custom-select-field shadow-sm" id="jobTitleSelect">
                            <option value="">Select Job Title</option>
                            <?php
                            if (!empty($jobtitles)) {
                                foreach ($jobtitles as $jobtitle) {
                                    // Use 'id_jobtitles' and 'job_title' from the hardcoded array structure
                                    echo '<option value="' . htmlspecialchars($jobtitle['id_jobtitles']) . '">' . htmlspecialchars($jobtitle['job_title']) . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No job titles found</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary custom-next-btn w-100 w-md-auto">Next</button>
                </div>
            </div>
        </div>

        <?php
        include 'footer.php';
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jobTitleSelect = document.getElementById('jobTitleSelect');
            const nextButton = document.querySelector('.custom-next-btn');
            const skipLink = document.querySelector('.skip-link');

            // Get industry_id from the URL, if present
            const urlParams = new URLSearchParams(window.location.search);
            const industryId = urlParams.get('industry_id');

            // Redirect "Next" button to templatereco.php
            nextButton.addEventListener('click', function() {
                const selectedJobTitleId = jobTitleSelect.value;
                if (selectedJobTitleId) {
                    let redirectUrl = 'templatereco.php?jobtitle_id=' + selectedJobTitleId;
                    if (industryId) {
                        // Pass industry_id along with jobtitle_id
                        redirectUrl += '&industry_id=' + industryId;
                    }
                    window.location.href = redirectUrl;
                } else {
                    alert('Please select a job title before proceeding.');
                }
            });

            // Redirect "Skip" link to personal_info.php
            if (skipLink) {
                skipLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    window.location.href = 'personal_info.php';
                });
            }
        });
    </script>
</body>
</html>