<?php
	session_start();
	require_once("config.inc.php");
	require_once("languages.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEticNet Login</title>
    <link rel="stylesheet" href="css/loginstyles.css"> 
	<link rel="icon" href="Image/LogoOnglet.png"type="image/png">
</head>
<body>
    <div id="loading-screen" class="loading-screen">
        <div class="loading-content">
            <div><img src="images/logo_eticnet.svg" alt="MyEticNet Logo" class="logoLoad-img"></div>
            <div>
                <div class="spinner"></div>
                <p>Loading...</p>
            </div>
        </div>
    </div>
    <header>
         <div class="logo">
            <img src="images/myeticnet_black.svg" alt="MyEticNet Logo" class="logo-img">
        </div>
        <button class="demo-btn" onclick="window.location.href='demo.php'">Demo</button>
    </header>
    <main id="main-content">
        <div class="content">
            <h1>Welcome back !</h1>
            <form class="login-form" method="POST">
                <div class="input-group">
                    <label for="email"><h3>Email</h3> </label>
                    <input type="text" id="email" name="email" placeholder="Write your email" >
                </div> 
                <div class="input-group password-group">
                    <label for="email"><h3>Password</h3> </label>
                    <input type="password" id="password" name="password" placeholder="Write your password" >
                    <span class="error">X</span>
                </div>
                
                <div class="options">	
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember-me" name="remember-me">
                        <label for="remember-me"></h1> Always remind me</h1> </label>
                    </div>			
                    <a href="forget_password.php" class="forgot-password"></h6>Forgot your password ?</h6> </a>
                </div>
                <div id="error-group" class="error-group"></div>
                <input type="button" onclick="check_access()" class="login-btn" value="Log in">
            </form>
        </div>
    </main>
    <footer>
    <div class="urls">
        <a href="FAQ.php">FAQ</a>
        <a href="https://www.eticeurope.com/">Etic Europe</a>
        <a href="#">Contacts</a>
</div>
        <div class="language-switch">
            <button class="lang-btn">Fr</button>
            <button class="lang-btn">En</button>
        </div>
    </footer>
	<script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadingScreen = document.getElementById('loading-screen');
            const mainContent = document.getElementById('main-content');
            
            setTimeout(() => {
                loadingScreen.style.display = 'none';
                mainContent.style.display = 'block';
            }, 1500); 

            const faqQuestions = document.querySelectorAll(".faq-question");

            faqQuestions.forEach(question => {
                question.addEventListener("click", () => {
                    const answer = question.nextElementSibling;
                    answer.style.display = answer.style.display === "block" ? "none" : "block";
                });
            });
        });
    </script>
<script src="js/login.js"></script>
</body>
</html>
