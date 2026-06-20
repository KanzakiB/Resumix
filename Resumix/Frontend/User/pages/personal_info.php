<?php
// PHP backend logic for form submission, updated to match database schema

// Initialize variables with database column names
$id_personal = ''; // PK, typically auto-incremented by DB
$id_resume = 1; // FK, placeholder value. In a real app, this would come from session or previous step.
$p_firstname = '';
$p_lastname = ''; // Corresponds to 'surname' in the form
$p_suffix = '';
$p_profession = '';
$p_cityr = ''; // Corresponds to 'city' in the form
$p_region = '';
$p_postalcode = '';
$p_pnum = ''; // Corresponds to 'phoneNumber' in the form
$p_emailadd = ''; // Corresponds to 'emailAddress' in the form

$errors = [];
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs, mapping form fields to database column names
    $p_firstname = htmlspecialchars(trim($_POST['p_firstname'] ?? ''));
    $p_lastname = htmlspecialchars(trim($_POST['p_lastname'] ?? ''));
    $p_suffix = htmlspecialchars(trim($_POST['p_suffix'] ?? ''));
    $p_profession = htmlspecialchars(trim($_POST['p_profession'] ?? ''));
    $p_cityr = htmlspecialchars(trim($_POST['p_cityr'] ?? ''));
    $p_region = htmlspecialchars(trim($_POST['p_region'] ?? ''));
    $p_postalcode = htmlspecialchars(trim($_POST['p_postalcode'] ?? ''));
    $p_pnum = htmlspecialchars(trim($_POST['p_pnum'] ?? ''));
    $p_emailadd = htmlspecialchars(trim($_POST['p_emailadd'] ?? ''));

    // Basic validation (more robust validation would be needed for a real application)
    if (empty($p_firstname)) {
        $errors['p_firstname'] = 'First Name is required.';
    }
    if (empty($p_lastname)) {
        $errors['p_lastname'] = 'Surname is required.';
    }
    if (empty($p_cityr)) {
        $errors['p_cityr'] = 'City is required.';
    }
    if (empty($p_region)) {
        $errors['p_region'] = 'Region is required.';
    }
    if (empty($p_postalcode)) {
        $errors['p_postalcode'] = 'Postal Code is required.';
    }
    if (empty($p_pnum)) {
        $errors['p_pnum'] = 'Phone Number is required.';
    }
    if (empty($p_emailadd)) {
        $errors['p_emailadd'] = 'Email Address is required.';
    } elseif (!filter_var($p_emailadd, FILTER_VALIDATE_EMAIL)) {
        $errors['p_emailadd'] = 'Invalid email format.';
    }

    if (empty($errors)) {
        // Process the data (e.g., save to a database, send email, etc.)
        // In a real application, you would connect to your database here
        // and insert this data into the 'rm_personal_info' table.

        // Example of how you might prepare data for insertion (pseudo-code):
        /*
        $stmt = $pdo->prepare("INSERT INTO rm_personal_info (
            id_resume, p_firstname, p_lastname, p_suffix, p_profession,
            p_cityr, p_region, p_postalcode, p_pnum, p_emailadd
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $id_resume, $p_firstname, $p_lastname, $p_suffix, $p_profession,
            $p_cityr, $p_region, $p_postalcode, $p_pnum, $p_emailadd
        ]);
        */

        $successMessage = 'Personal information submitted successfully!';

        // You would typically redirect here after a successful submission
        // header('Location: success_page.php');
        // exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="personal_info.css">
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

            <h2 class="mb-3 fw-bold text-dark">Tell us about your personal information</h2>
            <p class="text-muted mb-4">
                Providing personal information in a resume is important to help employers identify you and contact you for job opportunities.
            </p>
            <p class="text-muted small mb-4">
                <span class="text-danger">*</span> indicates a required field
            </p>

            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                    <?php echo $successMessage; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                    Please correct the following errors:
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form id="personalInfoForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="p_firstname" class="form-label fw-medium">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-2 p-3 <?php echo isset($errors['p_firstname']) ? 'is-invalid' : ''; ?>" id="p_firstname" name="p_firstname" value="<?php echo $p_firstname; ?>" required>
                        <div class="invalid-feedback">
                            Please provide your first name.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="p_lastname" class="form-label fw-medium">Surname <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-2 p-3 <?php echo isset($errors['p_lastname']) ? 'is-invalid' : ''; ?>" id="p_lastname" name="p_lastname" value="<?php echo $p_lastname; ?>" required>
                        <div class="invalid-feedback">
                            Please provide your surname.
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="p_suffix" class="form-label fw-medium">Suffix</label>
                        <input type="text" class="form-control rounded-2 p-3" id="p_suffix" name="p_suffix" value="<?php echo $p_suffix; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="p_profession" class="form-label fw-medium">Profession</label>
                        <select class="form-select rounded-2 p-3" id="p_profession" name="p_profession">
                            <option value="">Select Profession</option>
                            <option value="developer" <?php echo ($p_profession == 'developer') ? 'selected' : ''; ?>>Developer</option>
                            <option value="designer" <?php echo ($p_profession == 'designer') ? 'selected' : ''; ?>>Designer</option>
                            <option value="manager" <?php echo ($p_profession == 'manager') ? 'selected' : ''; ?>>Manager</option>
                            <option value="other" <?php echo ($p_profession == 'other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="p_cityr" class="form-label fw-medium">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-2 p-3 <?php echo isset($errors['p_cityr']) ? 'is-invalid' : ''; ?>" id="p_cityr" name="p_cityr" value="<?php echo $p_cityr; ?>" required>
                        <div class="invalid-feedback">
                            Please provide your city.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="p_region" class="form-label fw-medium">Region <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-2 p-3 <?php echo isset($errors['p_region']) ? 'is-invalid' : ''; ?>" id="p_region" name="p_region" value="<?php echo $p_region; ?>" required>
                        <div class="invalid-feedback">
                            Please provide your region.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="p_postalcode" class="form-label fw-medium">Postal Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-2 p-3 <?php echo isset($errors['p_postalcode']) ? 'is-invalid' : ''; ?>" id="p_postalcode" name="p_postalcode" value="<?php echo $p_postalcode; ?>" required>
                        <div class="invalid-feedback">
                            Please provide your postal code.
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <label for="p_pnum" class="form-label fw-medium">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control rounded-2 p-3 <?php echo isset($errors['p_pnum']) ? 'is-invalid' : ''; ?>" id="p_pnum" name="p_pnum" value="<?php echo $p_pnum; ?>" required>
                        <div class="invalid-feedback">
                            Please provide your phone number.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="p_emailadd" class="form-label fw-medium">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control rounded-2 p-3 <?php echo isset($errors['p_emailadd']) ? 'is-invalid' : ''; ?>" id="p_emailadd" name="p_emailadd" value="<?php echo $p_emailadd; ?>" required>
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3">
                    <button type="button" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium">Preview</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-medium">Next: Work History</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for client-side validation and icon rendering
        document.addEventListener('DOMContentLoaded', function() {
            // Render Lucide icons
            lucide.createIcons();

            // Client-side form validation
            const form = document.getElementById('personalInfoForm');

            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>
</body>
</html>