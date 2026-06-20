<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="education_form.css">
</head>
<body>

    <?php
    // PHP section to handle form submission for all education entries
    // This part would typically process data when the 'Next: Education Description' button is clicked.
    // The 'Add another' functionality is now handled primarily by JavaScript with a modal.
    $message = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // In a real application, you would iterate through all submitted education entries
        // (e.g., $_POST['edu_institution_0'], $_POST['edu_institution_1'], etc.)
        // and save them to the database.
        // For this example, we'll just show a generic success message for the form submission.
        $message = "<div class='alert alert-success mt-3' role='alert'>
                        All education details submitted successfully!
                    </div>";
        // You could also add logic here to display individual entries if needed for debugging
        // For example: print_r($_POST);
    }
    ?>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="#" class="text-dark fs-4" aria-label="Go back"><i class="fas fa-arrow-left"></i></a>
            <i class="fas fa-lightbulb text-warning fs-4"></i>
        </div>

        <h1 class="mb-3">Tell us about your education.</h1>
        <p class="text-muted mb-2">Enter your education experience so far, even if you are a current student or did not graduate.</p>
        <p class="text-muted mb-4"><span class="required-field-indicator">*</span> indicates a required field</p>

        <form method="POST" action="education_form.php" id="educationForm">
            <div class="education-entry" id="educationEntry_0">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="edu_level_0" class="form-label">EDUCATION LEVEL</label>
                        <select class="form-select" id="edu_level_0" name="edu_level_0">
                            <option value="">Choose education level</option>
                            <option value="High School">High School</option>
                            <option value="Associate's Degree">Associate's Degree</option>
                            <option value="Bachelor's Degree">Bachelor's Degree</option>
                            <option value="Master's Degree">Master's Degree</option>
                            <option value="Doctorate">Doctorate</option>
                            <option value="Vocational">Vocational</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="edu_institution_0" class="form-label">INSTITUTION/SCHOOL <span class="required-field-indicator">*</span></label>
                        <input type="text" class="form-control" id="edu_institution_0" name="edu_institution_0" placeholder="e.g., University of San Carlos" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="edu_loc_0" class="form-label">INSTITUTION LOCATION</label>
                        <input type="text" class="form-control" id="edu_loc_0" name="edu_loc_0" placeholder="e.g., Manila">
                    </div>
                    <div class="col-md-6">
                        <label for="id_degree_0" class="form-label">DEGREE (if applicable)</label>
                        <select class="form-select" id="id_degree_0" name="id_degree_0">
                            <option value="">Choose degree</option>
                            <option value="BS Computer Science">BS Computer Science</option>
                            <option value="BA English">BA English</option>
                            <option value="MBA">MBA</option>
                            <option value="PhD Physics">PhD Physics</option>
                            <option value="Associate of Arts">Associate of Arts</option>
                            <option value="High School Diploma">High School Diploma</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="id_fldStudy_0" class="form-label">FIELD OF STUDY (if applicable)</label>
                        <select class="form-select" id="id_fldStudy_0" name="id_fldStudy_0">
                            <option value="">Choose field of study</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Engineering">Engineering</option>
                            <option value="Literature">Literature</option>
                            <option value="Medicine">Medicine</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="start_year_0" class="form-label">START</label>
                        <select class="form-select" id="start_year_0" name="start_year_0">
                            <option value="">Year</option>
                            <?php for ($i = date("Y"); $i >= 1950; $i--) { echo "<option value='$i'>$i</option>"; } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="end_year_0" class="form-label">END</label>
                        <select class="form-select" id="end_year_0" name="end_year_0">
                            <option value="">Year</option>
                            <option value="Present">Present</option>
                            <?php for ($i = date("Y") + 5; $i >= 1950; $i--) { echo "<option value='$i'>$i</option>"; } ?>
                        </select>
                    </div>
                </div>
            </div> <div id="educationEntriesContainer"></div>

            <?php echo $message; ?>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-toggle="modal" data-bs-target="#addEducationModal">Add another</button>
                <button type="submit" class="btn btn-primary px-4">Next: Education Description</button>
            </div>
        </form>
    </div>

    <div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-0">
                    <img src="https://placehold.co/150x100/ADD8E6/000000?text=Confirmation" alt="Confirmation Icon" class="img-fluid mb-3">
                    <h5 class="modal-title mb-3" id="addEducationModalLabel">Do you want to add another for your educational background?</h5>
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary px-4" id="confirmAddEducation">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="savedToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Education entry saved!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript section
        document.addEventListener('DOMContentLoaded', function() {
            const addAnotherBtn = document.getElementById('addAnotherBtn');
            const confirmAddEducationBtn = document.getElementById('confirmAddEducation');
            const educationEntryTemplate = document.getElementById('educationEntry_0'); // Use the first entry as template
            const educationEntriesContainer = document.getElementById('educationEntriesContainer');
            const addEducationModal = new bootstrap.Modal(document.getElementById('addEducationModal'));
            const savedToast = new bootstrap.Toast(document.getElementById('savedToast'));

            let entryCount = 0; // The initial entry is 0. New entries will start from 1.

            // Function to clear form fields of a given entry
            function clearFormFields(entryElement) {
                entryElement.querySelectorAll('input, select').forEach(field => {
                    if (field.type === 'text' || field.tagName === 'SELECT') {
                        field.value = '';
                    }
                    if (field.tagName === 'SELECT') {
                        field.selectedIndex = 0; // Reset dropdowns
                    }
                });
            }

            // Handle "Yes" button click in the modal
            confirmAddEducationBtn.addEventListener('click', function() {
                // 1. Simulate saving the current form data (display toast)
                savedToast.show();

                // 2. Clear the current form fields
                // This will clear the fields of the last active entry (which is the one the user was just filling)
                clearFormFields(document.getElementById(`educationEntry_${entryCount}`));


                // 3. Add a new, blank set of education form fields (cloned from the template)
                // We need to ensure the template is not hidden, or clone a hidden one and show it.
                // Since `educationEntry_0` is the first visible entry, we clone it.
                entryCount++; // Increment for the new entry
                const newEntry = educationEntryTemplate.cloneNode(true);
                newEntry.id = `educationEntry_${entryCount}`; // Give a unique ID

                // Update IDs and names of form elements within the cloned entry
                newEntry.querySelectorAll('[id$="_0"]').forEach(element => {
                    const oldId = element.id;
                    const newId = oldId.replace('_0', `_${entryCount}`);
                    element.id = newId;
                    element.name = newId; // Update name attribute for PHP processing
                    element.value = ''; // Ensure cloned fields are blank
                    if (element.tagName === 'SELECT') {
                        element.selectedIndex = 0; // Reset dropdowns
                    }
                    // Update label 'for' attribute
                    const label = document.querySelector(`label[for="${oldId}"]`);
                    if (label) {
                        // This part is tricky. Labels are outside the cloned node.
                        // For dynamically added labels, they should be part of the cloned node.
                        // Let's assume labels are inside the cloned `education-entry` div.
                        // If not, this selector needs to be adjusted.
                        const newLabel = newEntry.querySelector(`label[for="${oldId}"]`);
                        if (newLabel) {
                            newLabel.setAttribute('for', newId);
                        }
                    }
                });

                educationEntriesContainer.appendChild(newEntry);

                // 4. Close the modal
                addEducationModal.hide();
            });

            // Initial setup to ensure the first entry is correctly named (already done in PHP, but good practice)
            // The template itself is the first entry (index 0)
            // No changes needed here as default names are _0
        });
    </script>
</body>
</html>
