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
    <link href="http://localhost/Resumix/Frontend/User/css/forgotp.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Component/css/header.css" rel="stylesheet">
    
</head>
<body > 

    <?php
        include('../../Component/header.php');;
    ?>
    
    <section class="py-5 bg-light bodybg" >
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <img src="http://localhost/Resumix/Images/forgotp.png" alt="Forgot Password Illustration" class="img-fluid imgdisplay">
                </div>
                <div class="col-md-6 move-down-form">
                    <div class="text-center mb-4">
                        <h2 class="forgotp-Title">Forgot Password</h2>
                        <p class="forgotp-desc">Enter your email address and we will send a code to reset your password.</p>
                    </div>
                    <div class="form-wrapper mx-auto">
                        <form id="forgotpForm" class="form-container" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="forgotp_email" name="forgotp_email" required>
                                <div class="form-text text-danger error-message1">Email doesn't exist</div>
                            </div>
                            <div class="text-center mb-3">
                                <a href="login.php" class="backbtn">Back to Login</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 sendbtn">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
        include('../../Component/footer.php');
    ?>

    <script src="http://localhost/Resumix/Frontend/User/js/forgotp.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/header.js"></script>
</body>
</html>