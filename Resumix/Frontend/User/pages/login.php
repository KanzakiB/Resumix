

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/User/css/login.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Component/css/header.css" rel="stylesheet">
    
</head>
<body> 

    <?php
        include('../../Component/header.php');;
    ?>
    
    <section class="py-5 bg-light bodybg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <img src="http://localhost/Resumix/Images/loginimg.png" alt="Registration Illustration" class="img-fluid move-down-img">
                </div>
                <div class="col-md-6">
                    <div class="text-center mb-4 move-down-form">
                        <h2 class="title-start">Welcome Back</h2>
                        <p>Don't have an account? <a href="signup.php" class="signup-button">Sign Up</a></p>
                    </div>
                    <div class="form-wrapper mx-auto">
                        <form id="loginForm" class="form-container" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="login_email" name="login_email" required>
                                <div class="form-text text-danger error-message1">Email doesn't exist</div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="login_password" name="login_password" required>
                                        <i class="fa-solid fa-eye" id="togglePassword" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);"></i>
                                    </div>
                                </div>
                                <div class="form-text text-danger error-message2">Wrong Password</div>
                            </div>
                            <div class="text-end">
                                <p class="mb-2"><a href="forgot_password.php" class="forgotpass">Forgot Password?</a></p>
                            </div>
                            <button type="submit" id="submitsignup" class="btn btn-primary w-100 loginbtn">Log In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        include('../../Component/footer.php');
    ?>

 
    <script src="http://localhost/Resumix/Frontend/User/js/login.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/header.js"></script>
</body>
</html>