<?php 
session_start();
if(!isset($_SESSION['all'])){
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X Mockup Interface (Single File)</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* --- CSS VARIABLES & BASE STYLES --- */
        :root {
            --color-black: #000000;
            --color-light-gray: #202327; /* Background of modals/boxes */
            --color-text-white: #e7e9ea;
            --color-text-gray: #71767b;
            --color-blue: #1d9bf0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--color-black);
            color: var(--color-text-white);
            display: flex;
            justify-content: center;
            min-height: 100vh;
        }
        
        /* --- 1. MAIN TIMELINE LAYOUT --- */
        .page-container {
            display: grid;
            grid-template-columns: 275px 600px 350px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* --- 1.1 LEFT SIDEBAR (Navigation) --- */
        .sidebar-left {
            padding: 10px 10px 20px 0;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .x-logo {
            font-size: 30px;
            font-weight: 700;
            padding: 10px;
            color: var(--color-text-white);
            margin-right: 25px;
        }

        .main-nav {
            /* display: flex; */
            flex-direction: column;
            width: 100%;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            border-radius: 9999px;
            font-size: 20px;
            color: var(--color-text-white);
            text-decoration: none;
            margin-bottom: 5px;
            transition: background-color 0.2s;
            width: fit-content;
        }

        .nav-item i {
            font-size: 22px;
            width: 30px;
            margin-right: 20px;
        }

        .nav-item:hover {
            background-color: var(--color-light-gray);
        }
        
        .post-button {
            background-color: var(--color-blue);
            color: var(--color-text-white);
            font-size: 17px;
            font-weight: 700;
            border: none;
            border-radius: 9999px;
            padding: 16px 20px;
            width: 210px;
            cursor: pointer;
            margin-top: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 9999px;
            margin-top: auto;
            margin-right: 25px;
            width: 250px;
        }
        
        .user-info .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #555;
            margin-right: 10px;
        }

        .user-name {
            font-weight: 700;
        }

        .user-handle {
            color: var(--color-text-gray);
            font-size: 14px;
        }
        
        /* --- 1.2 MAIN CONTENT (Timeline) --- */
        .main-content {
            border-left: 1px solid #2f3336;
            border-right: 1px solid #2f3336;
        }

        .timeline-header {
            display: flex;
            position: sticky;
            top: 0;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 10;
            border-bottom: 1px solid #2f3336;
        }

        .tab {
            flex-grow: 1;
            text-align: center;
            padding: 15px 0;
            cursor: pointer;
            font-weight: 500;
            color: var(--color-text-gray);
        }

        .tab.active {
            color: var(--color-text-white);
            font-weight: 700;
            position: relative;
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            height: 4px;
            width: 50px;
            background-color: var(--color-blue);
            border-radius: 9999px;
        }

        .post-box {
            padding: 15px;
            border-bottom: 10px solid #2f3336;
        }

        .post-box-top {
            display: flex;
        }
        
        .post-box-top textarea {
            background: transparent;
            border: none;
            color: var(--color-text-white);
            font-size: 20px;
            width: 100%;
            resize: none;
            min-height: 40px;
            outline: none;
            padding-top: 5px;
        }

        .post-box-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 60px;
        }

        .post-box-bottom .icons i {
            color: var(--color-blue);
            margin-right: 15px;
            cursor: pointer;
        }

        .post-btn-small {
            background-color: var(--color-blue);
            color: var(--color-text-white);
            font-weight: 700;
            border: none;
            border-radius: 9999px;
            padding: 8px 16px;
            cursor: pointer;
            opacity: 0.5; /* Default disabled state */
        }
        
        .post-card {
             padding: 15px;
             border-bottom: 1px solid #2f3336;
        }
        
        /* --- 1.3 RIGHT SIDEBAR (Utility/Trends) --- */
        .sidebar-right {
            padding: 0 10px;
            padding-top: 10px;
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-gray);
        }

        .search-box input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border-radius: 9999px;
            border: none;
            background-color: var(--color-light-gray);
            color: var(--color-text-white);
            font-size: 15px;
            outline: none;
        }

        .premium-box, .trends-box {
            background-color: var(--color-light-gray);
            border-radius: 16px;
            padding: 15px;
            margin-top: 15px;
        }

        .box-title {
            font-size: 20px;
            font-weight: 700;
        }

        .subscribe-button {
            background-color: var(--color-blue);
            color: var(--color-text-white);
            font-weight: 700;
            border: none;
            border-radius: 9999px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .trend-category, .trend-count {
            font-size: 13px;
            color: var(--color-text-gray);
            display: block;
        }

        .trend-topic {
            font-size: 15px;
            font-weight: 700;
        }
        
        /* --- 2. MODAL BASE STYLING --- */
        .modal-backdrop {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(91, 112, 137, 0.4); /* Semi-transparent overlay */
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: var(--color-black);
            border-radius: 16px;
            padding: 40px;
            width: 400px;
            position: relative;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        
        .modal-close {
            position: absolute;
            top: 15px;
            left: 15px;
            background: none;
            border: none;
            color: var(--color-text-white);
            font-size: 24px;
            cursor: pointer;
        }

        .modal-logo {
            text-align: center;
            margin-bottom: 20px;
            font-size: 48px;
            font-weight: 700;
        }
        
        .modal-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }

        .modal-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px 20px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
            text-decoration: none;
            color: #000;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .modal-button i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        .modal-button.blue {
            background-color: var(--color-blue);
            color: #fff;
            border: none;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: var(--color-text-gray);
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
        
        .modal-input {
            background-color: #000;
            border: 1px solid #333;
            border-radius: 5px;
            padding: 15px 10px;
            font-size: 16px;
            color: #fff;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
            outline: none;
        }
        
        .modal-input:focus {
            border-color: var(--color-blue);
        }

        .forgot-link {
            background-color: transparent;
            color: #fff;
            border: 1px solid #333;
            margin-top: 10px;
        }
        
        .signup-text {
            text-align: center;
            margin-top: 40px;
            font-size: 15px;
            color: var(--color-text-gray);
        }
        .signup-text a {
            color: var(--color-blue);
            text-decoration: none;
        }
        
        /* Create Account Specific Styles */
        .dob-heading {
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 5px;
            margin-top: 20px;
        }

        .dob-info {
            font-size: 13px;
            color: var(--color-text-gray);
            margin-bottom: 20px;
        }

        .date-select-group {
            display: flex;
            gap: 10px;
        }

        .date-select {
            flex: 1;
            background-color: #000;
            border: 1px solid #333;
            border-radius: 5px;
            padding: 15px 10px;
            font-size: 16px;
            color: #fff;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            cursor: pointer;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="white" d="M4.5 6l3.5 4 3.5-4z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            padding-right: 30px;
        }
        .month-select {
            flex: 2;
        }
        
        /* Utility Classes */
        .hidden {
            display: none !important;
        }
        .text-left {
            text-align: left !important;
        }
    

    </style>
</head>
<body>

    <div class="page-container">
        
        <aside class="sidebar-left">
            <div class="x-logo">X</div>
            <nav class="main-nav">
                <a href="#" class="nav-item active"><i class="fas fa-home"></i> Home</a>
                <a href="select.php" class="nav-item"><i class="fas fa-hashtag"></i> Explore users</a>
                <a href="#" class="nav-item"><i class="fas fa-bell"></i> Notifications</a>
                <a href="#" class="nav-item"><i class="fas fa-envelope"></i> Messages</a>
                <a href="#" class="nav-item"><i class="fas fa-comment-dots"></i> Grok</a>
                <a href="#" class="nav-item"><i class="fas fa-users"></i> Communities</a>
                <a href="#" class="nav-item"><i class="fas fa-user"></i> Profile</a>
                <a href="#" class="nav-item"><i class="fas fa-ellipsis-h"></i> More</a>
            </nav>
            <button class="post-button"> <a href="logout.php"class="post-button">Logout</a></button>
            <div class="user-info">
                <div class="avatar"></div>
                <div class="user-details">
                    <span class="user-name">Muhirwa bertin</span>
                    <span class="user-handle">@Muhirwabertin</span>
                </div>
                <i class="fas fa-ellipsis-h menu-icon"></i>
            </div>
        </aside>

        <main class="main-content">
            <header class="timeline-header">
                <div class="tab active" data-modal-target="create-account-modal">For you</div>
                <div class="tab" data-modal-target="signin-modal">Following</div>
            </header>
            
            <div class="post-box">
                <div class="post-box-top">
                    <div class="avatar"></div>
                    <textarea id="post-textarea" placeholder="What's happening?"></textarea>
                </div>
                <div class="post-box-bottom">
                    <div class="icons">
                        <i class="far fa-image"></i>
                        <i class="fas fa-gift"></i>
                        <i class="fas fa-list-ul"></i>
                        <i class="far fa-smile"></i>
                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <button id="post-btn-small" class="post-btn-small" disabled>Post</button>
                </div>
            </div>
            
            <div class="post-card" onclick="document.getElementById('welcome-modal').style.display='flex'">
                <div style="display:flex; padding-bottom: 10px;">
                    <div class="post-avatar" style="background-color: var(--color-blue); width: 20px; height: 20px; border-radius: 50%; margin-right: 5px;"></div>
                    <span style="font-weight: 700;">Mini Social Network Login System </span>
                    <span style="color: var(--color-text-gray); margin-left: 5px;">@ CRUD · 1/h</span>
                </div>
                <p style="margin-left: 25px;">OFFICIAL: Welcome to Student management</p>
                <p style="margin-left: 25px; margin-bottom: 10px;">Yassine Bounou 🧤🏆</p>
                <div style="margin-left: 25px; height: 300px; border-radius: 16px;">
                    </div>
            </div>
        </main>

        <aside class="sidebar-right">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search">
            </div>

            <div class="premium-box">
                <h3 class="box-title">Subscribe to Premium</h3>
                <p class="box-text" style="color: var(--color-text-white); font-size: 15px;">Subscribe to unlock new features and if eligible, receive a share of revenue.</p>
                <button class="subscribe-button" onclick="document.getElementById('welcome-modal').style.display='flex'">Subscribe</button>
            </div>

            <div class="trends-box">
                <h3 class="box-title">What's happening</h3>
                <div class="trend-item">
                    <span class="trend-category">Politics · Trending</span>
                    <span class="trend-topic">Genocide</span>
                    <span class="trend-count">262K posts</span>
                </div>
                <div class="trend-item">
                    <span class="trend-category">Trending in Rwanda</span>
                    <span class="trend-topic">#informedgens</span>
                    <span class="trend-count">Dear God</span>
                </div>
                <a href="#" class="show-more">Show more</a>
            </div>
        </aside>

    </div>

    <div id="welcome-modal" class="modal-backdrop">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('welcome-modal')">×</button>
            <div class="modal-logo">X</div>
            
            <h2 class="modal-title">Sign in to X</h2> <a href="#" class="modal-button">
                <img src="https://www.gstatic.com/images/icons/material/product/1x/google_20dp.png" alt="G" style="width: 20px; height: 20px; margin-right: 10px;">
                Sign in as Muhirwa bertinmuhi76@gmail.com
            </a>

            <a href="#" class="modal-button">
                <i class="fab fa-apple"></i>
                Sign up with Apple
            </a>

            <div class="separator">or</div>

            <a href="#" class="modal-button blue" onclick="showModal('create-account-modal', 'welcome-modal')">
                Create account
            </a>

            <p class="signup-text" style="line-height: 1.5; margin-top: 30px; font-size: 13px; color: var(--color-text-gray);">
                By signing up, you agree to the <a href="#">Terms of Service</a>
                and <a href="#">Privacy Policy</a>, including <a href="#">Cookie Use</a>.
            </p>

            <p class="signup-text">
                Have an account already? <a href="#" onclick="showModal('signin-modal', 'welcome-modal')">Log in</a>
            </p>
        </div>
    </div>
    
    <div id="signin-modal" class="modal-backdrop hidden">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('signin-modal')">×</button>
            <div class="modal-logo">X</div>
            
            <h2 class="modal-title">Sign in to X</h2>

            <a href="#" class="modal-button">
                <img src="https://www.gstatic.com/images/icons/material/product/1x/google_20dp.png" alt="G" style="width: 20px; height: 20px; margin-right: 10px;">
                Sign in as Muhirwa bertinmuhi76@gmail.com
            </a>

            <a href="#" class="modal-button">
                <i class="fab fa-apple"></i>
                Sign in with Apple
            </a>

            <div class="separator">or</div>

            <input type="text" class="modal-input" placeholder="Phone, email, or username">

            <a href="#" class="modal-button" style="background-color: #fff; color: #000; font-weight: 700;">
                Next
            </a>

            <a href="#" class="modal-button forgot-link" style="font-weight: 700;">
                Forgot password?
            </a>

            <p class="signup-text">
                Don't have an account? <a href="#" onclick="showModal('create-account-modal', 'signin-modal')">Sign up</a>
            </p>
        </div>
    </div>
    
    <div id="create-account-modal" class="modal-backdrop hidden">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal('create-account-modal')">×</button>
            <div class="modal-logo">X</div>
            
            <h2 class="modal-title text-left">Create your account</h2>

            <input type="text" class="modal-input" placeholder="Name">
            
            <div style="position: relative;">
                <input type="text" class="modal-input" placeholder="Phone">
                <a href="#" style="position: absolute; right: 0; bottom: 30px; font-size: 14px; color: var(--color-blue); text-decoration: none;">Use phone instead</a>
            </div>
            
            <h3 class="dob-heading">Date of Birth</h3>
            <p class="dob-info">
                This will not be shown publicly. Confirm your own age, 
                even if this account is for a business, a pet, or something else.
            </p>
            <div class="date-select-group">
                <select class="date-select month-select">
                    <option value="" disabled selected>Month</option>
                </select>
                <select class="date-select">
                    <option value="" disabled selected>Day</option>
                </select>
                <select class="date-select">
                    <option value="" disabled selected>Year</option>
                </select>
            </div>
            
            <a href="#" class="modal-button" style="background-color: #fff; color: #000; font-weight: 700; margin-top: 40px;">
                Next
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // --- 1. Post Button Activation ---
            const textarea = document.getElementById('post-textarea');
            const postButton = document.getElementById('post-btn-small');

            const updatePostButtonState = () => {
                if (textarea.value.trim().length > 0) {
                    postButton.removeAttribute('disabled');
                    postButton.style.opacity = 1;
                } else {
                    postButton.setAttribute('disabled', 'disabled');
                    postButton.style.opacity = 0.5;
                }
                
                // Auto-adjust Textarea Height
                textarea.style.height = 'auto'; 
                textarea.style.height = textarea.scrollHeight + 'px';
            };

            textarea.addEventListener('input', updatePostButtonState);
            updatePostButtonState();

            // --- 2. Modal Switching Functions ---
            window.showModal = (modalId, currentModalId = null) => {
                if (currentModalId) {
                    document.getElementById(currentModalId).style.display = 'none';
                }
                document.getElementById(modalId).style.display = 'flex';
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            };

            window.closeModal = (modalId) => {
                document.getElementById(modalId).style.display = 'none';
                document.body.style.overflow = '';
            };
            
            // --- 3. Optional: Auto-populate Date Selects ---
            const monthSelect = document.querySelector('#create-account-modal .month-select');
            const daySelect = document.querySelector('#create-account-modal .date-select:nth-child(2)');
            const yearSelect = document.querySelector('#create-account-modal .date-select:nth-child(3)');

            // Populate Months
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            months.forEach((month, index) => {
                monthSelect.innerHTML += `<option value="${index + 1}">${month}</option>`;
            });

            // Populate Days
            for (let i = 1; i <= 31; i++) {
                daySelect.innerHTML += `<option value="${i}">${i}</option>`;
            }

            // Populate Years (last 100 years)
            const currentYear = new Date().getFullYear();
            for (let i = currentYear; i >= currentYear - 100; i--) {
                yearSelect.innerHTML += `<option value="${i}">${i}</option>`;
            }
        });
    </script>
</body>
</html>