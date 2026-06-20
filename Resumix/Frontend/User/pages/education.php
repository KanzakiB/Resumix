<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Education Section</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="education.css">
</head>
<body>

<div class="container text-center py-5">
    <!-- Back Arrow -->
    <div class="text-start mb-3">
        <button onclick="goBack()" class="btn btn-link back-arrow">&#8592;</button>
    </div>

    <!-- Heading and Description -->
<div class="text-start mx-auto" style="max-width: 700px;">
    <h2 class="fw-bold">Tell us about your education.</h2>
    <p class="text-muted">
        Adding education to your resume involves listing your academic qualifications and achievements.
    </p>
</div>


    <!-- Image -->
    <div class="my-4">
        <img src="your_image_path.png" alt="Graduation Cap" class="img-fluid" style="max-width: 250px;">
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-end gap-3 mx-auto" style="max-width: 700px;">
        <button class="btn btn-outline-dark px-4">Preview</button>
        <button class="btn btn-primary px-4" onclick="goToSummary()">Next: Summary</button>
    </div>
</div>

<!-- JavaScript -->
<script>
    function goBack() {
        window.history.back();
    }

    function goToSummary() {
        window.location.href = 'summary.php'; // Update this to your actual summary page
    }
</script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
