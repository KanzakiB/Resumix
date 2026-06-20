<?php
include('C:\xampp\htdocs\Resumix\Backend\signup_process.php');
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
    <link href="http://localhost/Resumix/Frontend/User/css/signup.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Component/css/header.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/sucess_modal.css" rel="stylesheet">
    
</head>
<body > 

    <?php
        include('../../Component/header.php');;
    ?>
    
    <section class="py-5 bg-light bodybg">
        <div class="container">
            <div class="row ">
                <div class="col-md-6 d-none d-md-block">
                    <div class="image-wrapper mt-5">
                        <img src="http://localhost/Resumix/Images/signup.png" alt="Registration Illustration" class="img-fluid move-down-img    ">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center mb-4 move-down-form">
                        <h2 class="title-start">Get Started</h2>
                        <p>Already have an account? <a href="login.php" class="signin-button">Sign In</a></p>
                    </div>
                    <div class="form-wrapper mx-auto">
                        <form id="signupForm" class="form-container" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required maxlength="7">
                                <div class="form-text text-danger error-message1">Username already exist</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="form-text text-danger error-message2">Email already exist</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="signup_password" name="signup_password" required>
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
                                        <input type="password" class="form-control" id="signup_confirmPassword" name="signup_confirmPassword" required>
                                        <i class="fa-solid fa-eye" id="toggleConfirmPassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
                                    </div>
                                </div>
                                <div class="form-text text-danger error-message3">Password do not match!</div>
                            </div>
                            <button type="submit" id="submitsignup" class="btn btn-primary w-100 registerbtn">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Success Modal -->
    <div id="successModal" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Signup successful!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>

    <?php
        include('../../Component/footer.php');
    ?>

 
    <script src="http://localhost/Resumix/Frontend/User/js/signup.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/header.js"></script>


</body>
</html>