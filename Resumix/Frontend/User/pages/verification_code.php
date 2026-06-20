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
    <link href="http://localhost/Resumix/Frontend/User/css/verifycode.css" rel="stylesheet">
    <link href="http://localhost/Resumix/Frontend/Component/css/header.css" rel="stylesheet">
    
</head>
<body > 

    <?php
        include('../../Component/header.php');;
    ?>
    
    <section class="py-5 bg-light bodybg">
        <div class="container">
            <div class="row">
                 <div class="col-md-6 d-none d-md-block">
                    <img src="http://localhost/Resumix/Images/otp.png" alt="Check Your Email Illustration" class="img-fluid imgdisplay">
                </div>
                <div class="col-md-6 move-down-form">
                    <div class="text-center mb-4">
                        <h2 class="verify-title">Check your Email</h2>
                        <p class="verify-desc">Enter the verification code we sent to your email.</p>
                    </div>
                    <div class="form-wrapper mx-auto">
                        <form method="post" id="verifyForm" class="form-container">
                            <div class="mb-3">
                                <label for="code" class="form-label">Enter Code</label>
                                <input type="number" class="form-control" id="otpcode" name="otpcode" required  maxlength="6"  oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,6);">
                                <div class="form-text text-danger error-message1">Incorrect Code</div>
                            </div>
                            <div class="text-center mb-3 message">
                                Didn't get the email? <a href="#" class="resendbtn">Resend Code</a>
                                <div class="resend-message mt-2 text-success" style="display: none;"></div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 verifybtn">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
        include('../../Component/footer.php');
    ?>

    <script src="http://localhost/Resumix/Frontend/User/js/verifycode.js"></script>
    <script src="http://localhost/Resumix/Frontend/Component/js/header.js"></script>
</body>
</html>