<?php 
include 'connection.php';

$errors = [];

if (isset($_POST['next'])) {

    $username = $_POST['uname'];
    $phonenumber = $_POST['phone'];
    $month = $_POST['dob'] ?? '';
    $day = $_POST['day'] ?? '';
    $year = $_POST['year'] ?? '';

    $dateofbirth = "$year-$month-$day";

    // VALIDATION FIXED
    if (empty($username) || empty($phonenumber) || empty($month) || empty($day) || empty($year)) {
        $errors[] = "All fields are required.";
    }


    if (empty($errors)) {
        $insertquery = "INSERT INTO users (username, phone, dob)
                        VALUES ('$username', '$phonenumber', '$dateofbirth')";

        mysqli_query($conn, $insertquery);

        echo "<script>
        alert('Account created successfully');
        window.location.href = 'login.php';
      </script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your account</title>
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

    /* --- LOGO STYLING --- */
    .logo {
        text-align: center;
        margin-bottom: 30px; 
    }

    .logo .x-text {
        font-size: 48px;
        font-weight: 700;
        line-height: 1;
        /* If using a text logo, this is the size */
    }

    /* APPLIED CHANGE: CSS to resize the X image if you replace the text with an <img> */
    .logo img {
        width: 50px; /* Adjust this value to resize your uploaded logo */
        height: auto; 
        display: block;
        margin: 0 auto;
        filter: invert(1); /* Keeps the logo white on a dark background */
    }
    /* -------------------- */
    
    .main-heading {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        text-align: left; /* Heading is left-aligned in the image */
    }

    /* --- INPUT FIELDS --- */
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .input-field {
        background-color: #000;
        border: 1px solid #333;
        border-radius: 5px;
        padding: 20px 10px 8px 10px; /* Adjusted padding to simulate floating label */
        font-size: 16px;
        color: #fff;
        width: 100%;
        box-sizing: border-box;
        outline: none;
        transition: border-color 0.2s;
    }

    .input-field::placeholder {
        color: transparent; /* Hide placeholder if using a floating label effect */
    }

    .input-field:focus {
        border-color: #1a8cd8;
    }
    
    /* Simulate a basic floating label (Placeholder text is used as label in the image) */
    .input-field:not(:placeholder-shown) + .floating-label,
    .input-field:focus + .floating-label {
        /* You would typically use a label here, but for simplicity, we focus on the input style */
    }
    
    .phone-link {
        position: absolute;
        right: 0;
        bottom: -20px;
        font-size: 14px;
        color: #1a8cd8;
        text-decoration: none;
    }

    /* --- DATE OF BIRTH --- */
    .date-of-birth-section {
        margin-top: 20px;
        margin-bottom: 40px;
    }

    .dob-heading {
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .dob-info {
        font-size: 13px;
        color: #777;
        margin-bottom: 20px;
        line-height: 1.4;
    }

    .date-select-group {
        display: flex;
        gap: 10px;
    }

    .date-select {
        flex: 1; /* Distribute space evenly among select boxes */
        background-color: #000;
        border: 1px solid #333;
        border-radius: 5px;
        padding: 15px 10px;
        font-size: 16px;
        color: #fff;
        -webkit-appearance: none; /* Remove default browser styling for dropdown */
        -moz-appearance: none;
        appearance: none;
        cursor: pointer;
        /* Custom dropdown arrow for better dark mode look */
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="white" d="M4.5 6l3.5 4 3.5-4z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 10px center;
        padding-right: 30px; /* Space for the custom arrow */
    }
    .date-select:focus {
        border-color: #1a8cd8;
        outline: none;
    }

    .month-select {
        flex: 2; /* Month select is wider */
    }

    /* --- NEXT BUTTON --- */
    .button {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px 20px;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.2s ease;
        text-decoration: none;
        width: 100%; 
        box-sizing: border-box;
    }

    .next-button {
        background-color: #fff; /* White background for Next button */
        color: #000;
        border: none;
        margin-top: 30px; /* Space above the button */
    }
    .next-button:hover {
        background-color: #f0f0f0;
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
</head>
<body>
    <form action="" method="POST">
        <div class="container">
        <button class="close-button">×</button>
        <div class="logo">
            <span class="x-text"><img src="Mockup/X.jpeg" alt=""></span>
        </div>

        <h2 class="main-heading">Create your account</h2>
        <?php 
    if (!empty($errors)) {
        echo "<div style='color:red; margin-bottom:10px;'>";
        foreach ($errors as $e) {
            echo ". $e <br>";
        }
        echo "</div>";
    }

    // if (!empty($success)) {
    //     echo "<div style='color:green; margin-bottom:10px;'>$success</div>";
    // }
    ?>

        <div class="form-group">
            <input type="text" class="input-field" placeholder="Name" name="uname">
        </div>

        <div class="form-group">
            <input type="text" class="input-field" placeholder="Phone" name="phone">
            <a href="#" class="phone-link">Use phone instead</a>
        </div>
        
        <div class="date-of-birth-section">
            <h3 class="dob-heading">Date of Birth</h3>
            <p class="dob-info">
                This will not be shown publicly. Confirm your own age, 
                even if this account is for a business, a pet, or something else.
            </p>
            <div class="date-select-group">
                    <select class="date-select month-select" name="dob">
                        <option value="" disabled selected>Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <select class="date-select day-select" name="day">
                        <option value="" disabled selected>Day</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>

                    </select>
                    <select class="date-select year-select" name="year">
                        <option value="" disabled selected>Year</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                    </select>
                </div>
            </div>
    <button class="button next-button" name="next">Next</button>
    </div>
    </form>
    
</body>
</html>