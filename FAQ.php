<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - MyEticNet</title>
	<link rel="stylesheet" href="css/loginstyles_dup.css">
    <link rel="icon" href="Image/LogoOnglet.png" type="image/png">
   
</head>
<body>
    <div id="loading-screen" class="loading-screen">
        <div class="loading-content">
            <img src="Image/Logo.png" alt="MyEticNet Logo" class="logoLoad-img">
            <h1>MyEticNet</h1>
            <div class="spinner"></div>
            <p>Loading...</p>
        </div>
    </div>
    
   
    <header>
        <div class="logo">
            <img src="Image/Logo.png" alt="MyEticNet Logo" class="logo-img">
            MyEticNet
        </div>
        <button class="demo-btn" onclick="window.location.href='login.php'">Log In</button>
    </header>
    <main5>
        <h1>Frequently asked questions</h1>
        <div class="faq">
            <div class="faq-item">
                <div class="faq-question">Lorem ipsum dolor sit amet ?</div>
                <div class="faq-answer">Lorem ipsum dolor sit amet consectetur. Laoreet viverra vel et maecenas egestas est. Volutpat in vulputate ac sit sit justo. Pellentesque mauris diam sedales nibh accumsan tincidunt tincidunt volutpat vulputate. Pretium dolor tellus porttitor volutpat. Mattis molestie vestibulum sem fringilla. Tellus ipsum vel semper volutpat duis quisque. Duis dignissim dignissim nam tristique et sapien. Netus scelerisque vitae eu tortor vulputate massa non id morbi.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Lorem ipsum dolor sit amet ?</div>
                <div class="faq-answer">Lorem ipsum dolor sit amet consectetur. Laoreet viverra vel et maecenas egestas est. Volutpat in vulputate ac sit sit justo. Pellentesque mauris diam sedales nibh accumsan tincidunt tincidunt volutpat vulputate. Pretium dolor tellus porttitor volutpat. Mattis molestie vestibulum sem fringilla. Tellus ipsum vel semper volutpat duis quisque. Duis dignissim dignissim nam tristique et sapien. Netus scelerisque vitae eu tortor vulputate massa non id morbi.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Lorem ipsum dolor sit amet ?</div>
                <div class="faq-answer">Lorem ipsum dolor sit amet consectetur. Laoreet viverra vel et maecenas egestas est. Volutpat in vulputate ac sit sit justo. Pellentesque mauris diam sedales nibh accumsan tincidunt tincidunt volutpat vulputate. Pretium dolor tellus porttitor volutpat. Mattis molestie vestibulum sem fringilla. Tellus ipsum vel semper volutpat duis quisque. Duis dignissim dignissim nam tristique et sapien. Netus scelerisque vitae eu tortor vulputate massa non id morbi.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Lorem ipsum dolor sit amet ?</div>
                <div class="faq-answer">Lorem ipsum dolor sit amet consectetur. Laoreet viverra vel et maecenas egestas est. Volutpat in vulputate ac sit sit justo. Pellentesque mauris diam sedales nibh accumsan tincidunt tincidunt volutpat vulputate. Pretium dolor tellus porttitor volutpat. Mattis molestie vestibulum sem fringilla. Tellus ipsum vel semper volutpat duis quisque. Duis dignissim dignissim nam tristique et sapien. Netus scelerisque vitae eu tortor vulputate massa non id morbi.</div>
            </div>
        </div>
    </main5>
	
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
</body>
</html>
