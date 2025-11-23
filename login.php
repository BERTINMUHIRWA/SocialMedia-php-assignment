<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';

include "connection.php";
// ------------------------
if (isset($_POST['next'])) {
    $pue = $_POST['peu'] ?? '';     
    // Prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR phone=?");
    $stmt->bind_param("ss", $pue, $pue);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["all"] = $pue;
        echo "<script>
            alert('Login successfully');
            window.location.href = 'Dashboard.php';
        </script>";
        exit;
    } else {
        echo "<script>alert('Failed to login. User not found.');</script>";
    }
}

// ------------------------
// Google Sign-In
// ------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['google_token'])) {
    $token = $_POST['google_token'];

    // Initialize Google Client
    $client = new Google_Client(['client_id' => '422998815300-du6vqhrup8eu6nlu3817u7uq0amjus4j.apps.googleusercontent.com']);
    $payload = $client->verifyIdToken($token);

    if ($payload) {
        $email = $payload["email"];
        $name = $payload["name"] ?? 'Google User';

        // Check if user exists
        $stmt = $conn->prepare("SELECT userid FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // If not, insert user
        if ($stmt->num_rows == 0) {
            $insert = $conn->prepare("INSERT INTO users(username, email) VALUES (?, ?)");
            $insert->bind_param("ss", $name, $email);
            $insert->execute();
        }

        $_SESSION['all'] = $email; 
        echo json_encode(["success" => true, "email" => $email]);
        exit;
    } else {
        echo json_encode(["success" => false, "message" => "Invalid Google token"]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to X</title>
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
        h2 {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px; /* Space below the main heading */
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
            width: 100%; /* Make buttons full width */
            box-sizing: border-box; /* Include padding in width */
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

        .input-field {
            background-color: #000;
            border: 1px solid #333;
            border-radius: 5px;
            padding: 15px;
            font-size: 16px;
            color: #fff;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
            outline: none;
        }
        .input-field::placeholder {
            color: #777;
        }
        .input-field:focus {
            border-color: #1a8cd8;
        }

        .next-button {
            background-color: #fff; /* White background for Next button */
            color: #000;
            border: none;
        }
        .next-button:hover {
            background-color: #f0f0f0;
        }

        .forgot-password-button {
            background-color: transparent;
            color: #fff;
            border: 1px solid #333;
            margin-top: 20px;
        }
        .forgot-password-button:hover {
            background-color: #222;
        }

        .signup-text {
            text-align: center;
            margin-top: 40px;
            font-size: 15px;
            color: #777;
        }

        .signup-text a {
            color: #1a8cd8;
            text-decoration: none;
        }
        .signup-text a:hover {
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
    /* filter: invert(1);  */
}
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <form action="" method="POST">
         <div class="container">
        <button class="close-button">×</button>
        <div class="logo">
            <span class="x-text"><img src="Mockup/X.jpeg" alt=""></span>
        </div>

        <h2>Sign in to X</h2>

        <a href="#" class="button google-button">
            <div class="user-info">
                <div class="avatar" style="background-image: url('https://lh3.googleusercontent.com/a/ACg8ocJXn3R-Wv1zP-RzV6fF9E-p_k5_Y_0_Q=s96-c'); background-size: cover;"></div>
                <!-- <div class="text-content">
                    <span class="name">Sign in as Muhirwa</span>
                    <span class="email">bertinmuhi76@gmail.com</span>
                </div> -->
                <script src="https://accounts.google.com/gsi/client" async defer></script>

                <div 
                id="g_id_onload"
                data-client_id="422998815300-du6vqhrup8eu6nlu3817u7uq0amjus4j.apps.googleusercontent.com"
                data-context="signin"
                data-ux_mode="popup"
                data-callback="handleCredentialResponse">
                </div>

                <div 
                class="g_id_signin"
                data-type="standard"
                data-shape="pill"
                data-theme="outline"
                data-text="signin_with"
                data-size="large">
                </div>

                <script>
                function handleCredentialResponse(response) {
                    // the token from Google
                    fetch("server/verify_oauth.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({
                            credential: response.credential
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert("Logged in as " + data.email);
                        }
                    });
                }
                </script>

            </div>
            <span class="material-symbols-outlined">
                keyboard_arrow_down
            </span>
            <img src="https://www.gstatic.com/images/icons/material/product/1x/google_20dp.png" alt="Google icon" style="width: 20px; height: 20px; margin-left: auto;">
        </a>

        <a href="#" class="button apple-button">
            <i class="fab fa-apple icon"></i>
            <span>Sign in with Apple</span>
        </a>

        <div class="separator">or</div>

        <input type="text" class="input-field" placeholder="Phone, email, or username" name="peu" required>

    
        <button type="submit" class="button next-button" name="next">Next</button>


        <a href="#" class="button forgot-password-button">
            Forgot password?
        </a>

        <p class="signup-text">
            Don't have an account? <a href="signup1.php">Sign up</a>
        </p>
    </div>
    </form>
    <script>
    function handleCredentialResponse(response) {
    fetch('', { // same PHP file
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({ google_token: response.credential })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            // Redirect after successful login
            window.location.href = 'Dashboard.php'; // or home.php
        } else {
            alert("Google login failed: " + (data.message || ""));
        }
    });
}
</script>

</body>
</html>