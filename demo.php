<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Demo - MyEticNet</title>
    <link rel="stylesheet" href="css/loginstyles_dup.css">
    <link rel="icon" href="Image/LogoOnglet.png" type="image/png">
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
        <button class="demo-btn" onclick="window.location.href='login.php'">Log In</button>
    </header>
    <main4>
        <div class="demo-left">
            <h1>Need a demo?</h1>
            <p1>Fill in the form and we'll get back to you within 48 hours.</p1>
        </div>
        <div class="demo-right">
            <form id="demoForm" method="post">
                <label for="name">Last name - First name</label>
                <input type="text" id="name" name="name" placeholder="Write your full name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Write your email" required>

                <label for="phone">Phone number</label>
                 <div class="phone-container">
                    <select id="country-code" name="country-code">
                        <option value="+33">🇫🇷 +33</option>
						<option value="+216">🇹🇳 +216</option>
						<option value="+1">🇺🇸 +1</option>
                        <!-- Add other country codes as needed -->
                    </select>
                    <input type="tel" id="phone" name="phone" placeholder="Write your phone number" required>
                </div>

                <label for="company">Company</label>
                <input type="text" id="company" name="company" placeholder="Write your company name" required>

                <label for="message">Your message</label>
                <textarea id="message" name="message" placeholder="Write your message" required></textarea>

                <div class="terms">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I have read and accept the terms of use</label>
                </div>

                <button type="submit" class="send-btn">Send</button>
            </form>
            <div id="error-message" style="color: red;"></div>
            <div id="success-message" style="color: green;"></div>
        </div>
    </main4>
    <footer>
        <a href="FAQ.php">FAQ</a>
        <a href="#">Etic Europe</a>
        <a href="#">Contacts</a>
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
<script>
document.getElementById("demoForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    // Récupérer les valeurs des champs
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const countryCode = document.getElementById("country-code").value;
    const phone = document.getElementById("phone").value.trim();
    const company = document.getElementById("company").value.trim();
    const message = document.getElementById("message").value.trim();
    const terms = document.getElementById("terms").checked;

    const errorMessage = document.getElementById("error-message");
    const successMessage = document.getElementById("success-message");

    // Validation des données
    if (!name || !email || !phone || !company || !message || !terms) {
        errorMessage.textContent = "please enter all required fields and accept the terms.";
        successMessage.textContent = "";
        return;
    }

    if (!validateEmail(email)) {
        errorMessage.textContent = "Please enter a valid e-mail adress.";
        successMessage.textContent = "";
        return;
    }

    if (!/^\d+$/.test(phone)) {
        errorMessage.textContent = "Please enter a valid phone number.";
        successMessage.textContent = "";
        return;
    }

    // Préparation des données pour l'envoi
    const formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("country-code", countryCode);
    formData.append("phone", phone);
    formData.append("company", company);
    formData.append("message", message);

    // Envoi via XMLHttpRequest
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/get_demo.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            successMessage.textContent = "Your message has been succesfully sent. !";
            errorMessage.textContent = "";
            document.getElementById("demoForm").reset();
        } else {
            errorMessage.textContent = "Error while sending.";
            successMessage.textContent = "";
        }
    };
    xhr.onerror = function() {
        errorMessage.textContent = "Server connexion error.";
        successMessage.textContent = "";
    };
    xhr.send(formData);
});

// Fonction de validation de l'email
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
</script>
</body>
</html>
