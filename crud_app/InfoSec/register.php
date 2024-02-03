<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Add Font Awesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Register</title>
    <style>
        .field {
        position: relative;
    }

    .field input[type="password"] {
        padding-right: 30px; /* Ensure space for the eye icon */
    }

    .fa-eye, .fa-eye-slash {
        position: absolute;
        right: 10px;
        top: 70%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="" method="post"> 
                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" autocomplete="off" placeholder="Enter your first name here" required>
                </div>
                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" autocomplete="off" placeholder="Enter your last name here" required>
                </div>
                <div class="field input">
                    <label for="emailAdd">Email Address</label>
                    <input type="text" name="emailAdd" id="emailAdd" autocomplete="off" placeholder="Enter your email address here" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter your password here" required>
                    <!-- Add eye icon for password toggle -->
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <div class="field input">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" autocomplete="off" placeholder="Confirm your password" required>
                    <!-- Add eye icon for confirm password toggle -->
                    <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                </div>
                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Sign Up" required>
                </div>
                <div class="links">
                    Already have an account? <a href="login.php">Login Now</a>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to toggle password visibility -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#confirmPassword');

        toggleConfirmPassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
