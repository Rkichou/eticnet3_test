<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot my password - MyEticNet</title>
    <link rel="stylesheet" href="css/loginstyles.css">
    <link rel="icon" href="Image/LogoOnglet.png" type="image/png">
</head>
<body>
<?php 

?>
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
    </header>
    <main2 id="forgot_password">
        <h1>Forgot my password</h1>
        <form class="forgot-password-form">
            <div class="input-group2">
                <label for="email"><h3>Email</h3> </label>
                <input type="email" id="email" name="email" placeholder="Write your email" >
            </div> 
            <div id="error-group" class="error-group"></div>
            <div class="buttons-group">
                <button type="button" class="back-btn" onclick="window.location.href='login.php'">Back</button>
                <button type="button" class="continue-btn" onclick="send_new_password()">Continue</button>
            </div>
        </form>
    </main2>
    <footer>
        <a href="FAQ.php">FAQ</a>
        <a href="https://www.eticeurope.com/">Etic Europe</a>
        <a href="#">Contacts</a>
        <div class="language-switch">
            <button class="lang-btn">Fr</button>
            <button class="lang-btn">En</button>
        </div>
    </footer>
	<script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadingScreen = document.getElementById('loading-screen');
            
            
            setTimeout(() => {
                loadingScreen.style.display = 'none';
                
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
