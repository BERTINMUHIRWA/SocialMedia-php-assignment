<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #1a1a1a;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #fff;
        }

        .container {
            background-color: black;
            border-radius: 20px;
            padding: 40px;
            width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .close-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background: none;
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo img {
            width: 50px; /* Adjust as needed */
            filter: invert(1); /* Makes a black logo white for dark background */
        }
        .logo .x-text {
            font-size: 48px;
            font-weight: 700;
            line-height: 1;
        }

        .button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 20px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 15px;
            transition: background-color 0.2s ease;
            text-decoration: none;
            color: #fff;
        }

        .google-button {
            background-color: #fff;
            color: #000;
            border: 1px solid #ddd;
            display: flex; /* Ensure flex for content alignment */
            justify-content: space-between; /* Space out text and icon */
            align-items: center;
            padding-right: 15px; /* Adjust as needed */
            padding-left: 20px;
            width: 100%; /* Make button span full width */
            box-sizing: border-box; /* Include padding in width */
        }
        .google-button:hover {
            background-color: #f0f0f0;
        }

        .google-button .user-info {
            display: flex;
            align-items: center;
        }

        .google-button .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
            background-color: #ccc; /* Placeholder for avatar */
        }

        .google-button .email {
            font-size: 14px;
            color: #555;
            margin-left: -5px; /* Adjust to move email closer to name */
        }
        .google-button .name {
            font-weight: 500;
            color: #000;
        }
        .google-button .text-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }


        .apple-button {
            background-color: #fff;
            color: #000;
            border: none;
            display: flex;
            gap: 10px;
        }
        .apple-button:hover {
            background-color: #f0f0f0;
        }

        .apple-button .icon {
            font-size: 20px;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: #777;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #333;
        }

        .separator:not(:empty)::before {
            margin-right: .5em;
        }

        .separator:not(:empty)::after {
            margin-left: .5em;
        }

        .create-account-button {
            background-color: #1a8cd8; /* A shade of blue */
            color: #fff;
            border: none;
        }
        .create-account-button:hover {
            background-color: #167abd;
        }

        .terms-text {
            font-size: 13px;
            color: #777;
            text-align: center;
            margin-top: 30px;
            line-height: 1.5;
        }

        .terms-text a {
            color: #1a8cd8;
            text-decoration: none;
        }
        .terms-text a:hover {
            text-decoration: underline;
        }

        .login-text {
            text-align: center;
            margin-top: 40px;
            font-size: 15px;
            color: #777;
        }

        .login-text a {
            color: #1a8cd8;
            text-decoration: none;
        }
        .login-text a:hover {
            text-decoration: underline;
        }
                .logo {
        text-align: center; /* Keeps the container centered */
         margin-bottom: 20px;
        }

        .logo img {
        width: 50px; /* Your desired size */
        height: auto; 
        display: block;
        margin: 0 auto;
        filter: invert(0); 
        }
        .input-field::placeholder {
    color: #777; /* Set a visible gray color */
}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <div class="container">
        <button class="close-button">&times;</button>
        <div class="logo">
           <span class="x-text"><img src="Mockup/X.jpeg" alt=""></span>
            </div>

        <a href="#" class="button google-button">
            <div class="user-info">
                <div class="avatar" style="background-image: url('https://lh3.googleusercontent.com/a/ACg8ocJXn3R-Wv1zP-RzV6fF9E-p_k5_Y_0_Q=s96-c'); background-size: cover;"></div>
                <div class="text-content">
                    <span class="name">Sign in as Muhirwa</span>
                    <span class="email">bertinmuhi76@gmail.com</span>
                </div>
            </div>
            <span class="material-symbols-outlined">
                keyboard_arrow_down
            </span>
            <img src="https://www.gstatic.com/images/icons/material/product/1x/google_20dp.png" alt="Google icon" style="width: 20px; height: 20px; margin-left: auto;">
        </a>

        <a href="#" class="button apple-button">
            <i class="fab fa-apple icon"></i>
            <span>Sign up with Apple</span>
        </a>

        <div class="separator">or</div>

        <a href="signup2.php" class="button create-account-button">
            Create account
        </a>

        <p class="terms-text">
            By signing up, you agree to the <a href="#">Terms of Service</a>
            and <a href="#">Privacy Policy</a>, including <a href="#">Cookie Use</a>.
        </p>

        <p class="login-text">
            Have an account already? <a href="login.php">Log in</a>
        </p>
    </div>
</body>
</html>