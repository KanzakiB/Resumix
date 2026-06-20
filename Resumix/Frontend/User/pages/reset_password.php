<?php
include('C:\xampp\htdocs\Resumix\Backend\resetp_process.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumix</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/resetp.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Component/css/header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/sucess_modal.css" rel="stylesheet">
    
</head>
<body > 

    <?php
        include('../../Component/header.php');;
    ?>
    
    <section class="py-5 bg-light bodybg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <img src="http://localhost/Resumix/Images/resetp.png" alt="Reset Password Illustration" class="img-fluid imgdisplay">
                </div>
                <div class="col-md-6 move-down-form">
                    <div class="text-center mb-4">
                        <h2 class="resetp-title">Reset Password</h2>
                    </div>
                    <div class="form-wrapper mx-auto">
                        <form id="resetForm" method="POST" class="form-container">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="reset_password" name="reset_password" required>
                                        <i class="fa-solid fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
                                    </div>
                                </div>
                                <div class="req-list">
                                    <div class="form-text">Password must contain:</div>
                                    <ul class="list-unstyled requirements">
                                        <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 8 characters</li>
                                        <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 1 uppercase letter (A-Z)</li>
                                        <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 1 special character (!, @, #, $, %)</li>
                                        <li class="listrequirements"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-1" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-.05z"/></svg>At least 1 number</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="reset_confirmPassword" name="reset_confirmPassword" required>
                                        <i class="fa-solid fa-eye" id="toggleConfirmPassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
                                    </div>
                                </div>
                                <div class="form-text text-danger error-message1">Password do not match!</div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 resetbtn">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Modal -->
    <div id="successModal" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Password Reset Successfully!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>

    <?php
        include('../../Component/footer.php');
    ?>
    <script src="http://localhost/Resumix/Frontend/User/js/resetp.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/header.js"></script>
</body>
</html>