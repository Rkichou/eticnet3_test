<?php
   
    require_once("config.inc.php");
    require_once("includes/is_session_active.php");

$sql3="select name from contractors where prefix = '".$_SESSION['prefix_contractor']."';";
	$retour3=mysqli_query($con,$sql3); 

	// Parcourir les résultats de la base de données et stocker les options dans le tableau
	$row3 = mysqli_fetch_object($retour3);
$contractor=$row3->name;
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corporate view - MyEticNet</title>
    
    <link rel="icon" href="Image/LogoOnglet.png" type="image/png">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/all.min.css">
    <!-- bootstrap local-->	
    <link rel="stylesheet" href="css/bootstrap-icons.css"> 
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script> 
	<!-- MK <link rel="stylesheet" href="css/corporate_excelexport.css">

<link rel="stylesheet" href="CSS/clientview.css">-->	
	<link rel="stylesheet" href="css/clientview_dup.css?time=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/corporate_view.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
<style>
.loading-screen{
    position: fixed;
    top: 18%;
    background-color: #fafafa;
    background-position: center;
    background-size: cover;
    left: 0;
    width: 100%;
    z-index: 100;
    height: 100vh;
}
.loading-content {
        text-align: center;
        font-size: 26px;
display: block;
width: 500px;
    margin: 12% auto;
    }

    .logoLoad-img {
        width: 100%;
        height: auto;
        margin: 25px auto;
    }

    .spinner {
        width: 59px;
        height: 59px;
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-top-color: #FFA500;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 10px auto;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .loading-content p {
        color: #666;
        font-size: 16px;
        margin-top: 10px;
    }

    .loading-content h1 {
        font-weight: bold;
    }

</style>
<header class="header">
    <div class="logo d-flex align-items-center">
        <img src="images/myeticnet_blanc.svg" alt="MyEticNet Logo" class="logo-img me-2">
    </div>
    <div class="header-center flex-grow-1 text-center">
        <span class="site-title"><?= $contractor ?></span>
    </div>
	<!-- Select dropdown -->

    <div class="header-actions">
        
        <div class="btn-group">
			<button type="button" id="notifications-btn" class="admin-view-btn" style="padding-right: 30px;" >
				<img src="images/notifications.png" />
            </button>
            <button type="button" class="admin-view-btn " data-bs-toggle="dropdown" aria-expanded="false">
			Corporate view &nbsp 
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
			    <li><button class="dropdown-item d-flex align-items-center" onclick="" id="setting-link"><img src="images/icones/person-badge-key.svg" alt="Admin" class="navbar-icon"></img> Admin</button></li>
                <li><button class="dropdown-item d-flex align-items-center" onclick="" id="add-user-link"><img src="images/icones/book-and-wrench.svg" alt="User Manuel" class="navbar-icon"></img> User manual</button></li>
				<li><button class="dropdown-item d-flex align-items-center" onclick="" ><img src="images/icones/person-bubble.svg" alt="Contacts" class="navbar-icon"></img> Contacts</button></li>
				 <li><button class="dropdown-item d-flex align-items-center" onclick="" id="dayoff-link"><img src="images/icones/calendar-badge-plus.svg" alt="Days off" class="navbar-icon"></img> Days off</s></li>
				<li><button class="dropdown-item d-flex align-items-center" onclick="corporate_ticket()"><img src="images/icones/alert-triangle.svg" alt="Ticket" class="navbar-icon"></img> Ticket</button></li>
                <li><button class="dropdown-item d-flex align-items-center" onclick="disconnect()"><img src="images/icones/log-out.svg" alt="Log out" class="navbar-icon"></img> Log out</button></li>
            </ul>
        </div>
    </div>
</header>

<!-- JavaScript to handle hover effect on options -->

    <nav class="navbar">
    <button class="navbar-link active" style="margin-left: 25px;" onclick="corporate_dashboard();">
        <img src="images/icones/database.svg" alt="Dashboard" class="navbar-icon"></img>
        <span> Dashboard</span>
    </button>
    <button class="navbar-link" onclick="corporate_readytoprint();">
        <img src="images/icones/readytoprint.svg" alt="Ready to print" class="navbar-icon"></img>
        <span>Ready To Print</span>
    </button>
    <button class="navbar-link" onclick="corporate_store();">
        <img src="images/icones/store.svg" alt="Store" class="navbar-icon"></img>
        <span>Store</span>
    </button>
    <button class="navbar-link" onclick="corporate_suppliers();">
        <img src="images/icones/suppliers.svg" alt="Suppliers" class="navbar-icon"></img>
        <span>Suppliers</span>
    </button>
    <button class="navbar-link" onclick="corporate_dictionary();">
        <img src="images/icones/dictionary.svg" alt="Dictionary" class="navbar-icon"></img>
        <span>Dictionary</span>
    </button>
    <button class="navbar-link" onclick="corporate_importpo();">
        <img src="images/icones/upload.svg" alt="Import PO" class="navbar-icon"></img>
        <span>Import P.O.</span>
    </button>
    <button class="navbar-link" onclick="corporate_excelexport();">
        <img src="images/icones/download.svg" alt="Excel Export" class="navbar-icon"></img>
        <span>Excel export</span>
    </button>
    
</nav>
<!-- Écran de chargement -->
    <div id="loading-screen" class="loading-screen">
     <div class='loading-content'>
        <img src='images/logo_eticnet.svg' alt='MyEticNet Logo' class='logoLoad-img'>
        <div class='spinner'></div>
       <p>Loading...</p></div>
    </div>
<main class="main-content" id="main-content" style="visibility: hidden;">
    
    <div id="dashboard-content">

        <?php include 'corporate_dashboard.php'; ?>
    </div>
</main>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="js/corporate_view.js"></script>
<script src="js/corporate_store.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadingScreen = document.getElementById('loading-screen');
        const mainContent = document.getElementById('main-content');

        // Simule un délai pour cacher le loading screen et montrer le contenu
        setTimeout(() => {
            loadingScreen.style.display = 'none';  // Cache l'écran de chargement
            mainContent.style.visibility = 'visible';  // Affiche le contenu principal
        }, 1500); // Temps en millisecondes, ajustez au besoin
    });
</script>
</body>
</html>
