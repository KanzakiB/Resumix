<?php
// industry_selection.php - Main page for industry selection

// --- Database Connection ---
// Replace with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resumixdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Fetch Industries ---
$industries = []; // Initialize an empty array to hold industry data

$sql = "SELECT id_industry, industry_name FROM rm_industry ORDER BY industry_name ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $industries[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumix - Select Industry</title>
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
        include 'indus_header.php'; // 
        ?>

        <div class="container my-auto py-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-6 d-flex justify-content-center mb-4 mb-md-0">
                    <div class="illustration-placeholder">
                        <img src="https://placehold.co/400x300/e0eaf7/6b8ed3?text=City+Illustration" alt="City Illustration" class="img-fluid rounded">
                    </div>
                </div>

                <div class="col-12 col-md-6 text-center text-md-start">
                    <h2 class="title-text mb-3">What industry are you trying to apply for?</h2>
                    <p class="description-text mb-4">Choose what type of industry are you trying to apply for so we could recommend the best template for you.</p>

                    <div class="form-group mb-4">
                        <label for="industrySelect" class="form-label visually-hidden">Select Industry</label>
                        <select class="form-select custom-select-field shadow-sm" id="industrySelect">
                            <option value="">Select Industry</option>
                            <?php
                            if (!empty($industries)) {
                                foreach ($industries as $industry) {
                                    echo '<option value="' . htmlspecialchars($industry['id_industry']) . '">' . htmlspecialchars($industry['industry_name']) . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No industries found</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary custom-next-btn w-100 w-md-auto">Next</button>
                </div>
            </div>
        </div>

        <?php
        include 'indus_footer.php'; 
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const industrySelect = document.getElementById('industrySelect');
            const nextButton = document.querySelector('.custom-next-btn');
            const skipLink = document.querySelector('.skip-link'); // Select the new skip link

            // Redirect "Next" button to worktype.php
            nextButton.addEventListener('click', function() {
                const selectedIndustryId = industrySelect.value;
                if (selectedIndustryId) {
                    // You might want to pass the selected industry ID to the next page
                    window.location.href = 'worktype.php?industry_id=' + selectedIndustryId;
                } else {
                    alert('Please select an industry before proceeding.');
                }
            });

            // Redirect "Skip" link to personal_info.php
            if (skipLink) {
                skipLink.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior
                    window.location.href = 'personal_info.php';
                });
            }
        });
    </script>
</body>
</html>