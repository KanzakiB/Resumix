<?php
// templatereco.php - Template Recommendation Page

// --- Database Connection (Example - not strictly needed for this page without dynamic templates) ---
// If you plan to fetch actual templates from a database, uncomment and configure this.
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "resumixdb";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// --- Get Industry ID from URL ---
$selected_industry_id = null;
$industry_name = "your selected industry"; // Placeholder if name isn't fetched
if (isset($_GET['industry_id']) && is_numeric($_GET['industry_id'])) {
    $selected_industry_id = (int)$_GET['industry_id'];

    // Optional: Fetch industry name from DB if you need to display it
    // if ($conn) {
    //     $stmt = $conn->prepare("SELECT industry_name FROM rm_industry WHERE id_industry = ?");
    //     if ($stmt) {
    //         $stmt->bind_param("i", $selected_industry_id);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($row = $result->fetch_assoc()) {
    //             $industry_name = htmlspecialchars($row['industry_name']);
    //         }
    //         $stmt->close();
    //     }
    // }
}

// Check if an industry was selected. If not, redirect back.
if ($selected_industry_id === null) {
    header("Location: industry_selection.php");
    exit();
}

// --- Get Job Title ID from URL (optional, if you want to pass it along) ---
$selected_jobtitle_id = null;
if (isset($_GET['jobtitle_id']) && is_numeric($_GET['jobtitle_id'])) {
    $selected_jobtitle_id = (int)$_GET['jobtitle_id'];
}


// --- Placeholder Template Data ---
$templates = [
    [
        'id' => 1,
        'image' => 'https://placehold.co/200x280/e0eaf7/6b8ed3?text=Template+1', // Replace with actual template images
        'style_name' => 'Classic Modern' // This is the "Name" that goes below the button
    ],
    [
        'id' => 2,
        'image' => 'https://placehold.co/200x280/e0eaf7/6b8ed3?text=Template+2',
        'style_name' => 'Professional Edge'
    ],
    [
        'id' => 3,
        'image' => 'https://placehold.co/200x280/e0eaf7/6b8ed3?text=Template+3',
        'style_name' => 'Minimalist Charm'
    ],
];

// If using database connection, close it here
// if ($conn) {
//     $conn->close();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumix - Recommended Templates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="templatereco.css">
    <link rel="stylesheet" href="indus_header.css">
    <link rel="stylesheet" href="indus_footer.css">
    <link href="http://localhost/Resumix/Frontend/User/css/user_dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="skip-link-container">
        <a href="personal_info.php" class="skip-link-button">Skip for now</a>
    </div>

    <div class="main-wrapper d-flex flex-column min-vh-100">
        <?php
        include 'header.php'; // Includes the header component
        ?>

        <div class="container my-auto py-5 templatereco-content">
            <div class="row justify-content-center">
                <div class="col-12 text-center text-md-start mb-4">
                    <h2 class="title-text">These are the recommended templates based on the industry and work you are applying for.</h2>
                </div>

                <div class="col-12">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                        <?php if (!empty($templates)): ?>
                            <?php foreach ($templates as $template): ?>
                                <div class="col">
                                    <div class="template-card card h-100 shadow-sm border-0">
                                        <div class="card-img-top-wrapper">
                                            <img src="<?php echo htmlspecialchars($template['image']); ?>" class="card-img-top" alt="Template <?php echo htmlspecialchars($template['id']); ?>">
                                            <div class="template-content-overlay">
                                                <button class="btn btn-primary use-template-btn" data-template-id="<?php echo htmlspecialchars($template['id']); ?>">Use This Template</button>
                                                <div class="template-style-name mt-2">
                                                    <small><?php echo htmlspecialchars($template['style_name']); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center">
                                <p class="description-text">No templates found for your selection. Please try again or skip.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include 'footer.php'; // Includes the footer component
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const useTemplateButtons = document.querySelectorAll('.use-template-btn');
            const skipButton = document.querySelector('.skip-link-button');

            // Get the industry_id and jobtitle_id from the current URL
            const urlParams = new URLSearchParams(window.location.search);
            const industryId = urlParams.get('industry_id');
            const jobtitleId = urlParams.get('jobtitle_id'); // This might be null if not passed

            useTemplateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const templateId = this.dataset.templateId;
                    let redirectUrl = 'start_resume_building.php?template_id=' + templateId;
                    if (industryId) {
                        redirectUrl += '&industry_id=' + industryId;
                    }
                    if (jobtitleId) {
                        redirectUrl += '&jobtitle_id=' + jobtitleId;
                    }
                    window.location.href = redirectUrl;
                });
            });

            // Redirect "Skip for now" button to personal_info.php
            if (skipButton) {
                skipButton.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior
                    window.location.href = 'personal_info.php';
                });
            }
        });
    </script>
</body>
</html>