<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin view - MyEticNet</title>
    
    
    <link rel="icon" href="Image/LogoOnglet.png" type="image/png">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="CSS/all.min.css">
    <!-- bootstrap local-->	
    <link rel="stylesheet" href="CSS/bootstrap-icons.css"> 
	<link href="CSS/bootstrap.min.css" rel="stylesheet">
    <script src="JS/bootstrap.bundle.min.js"></script> 
	
	<link rel="stylesheet" href="css/clientview_dup.css">
</head>
<!-- CSS Styles -->
<style>

</style>
<body>
<header class="header d-flex justify-content-between align-items-center">
    <div class="logo d-flex align-items-center">
        <img src="Image/Logo.png" alt="MyEticNet Logo" class="logo-img me-2">
        <h3 class="mb-0">MyEticNet</h3>
    </div>
    <div class="header-center flex-grow-1 text-center">
        <span class="site-title2">EMPREINTE</span>
    </div>
	<!-- Select dropdown -->
    <div class="dropdown custom-select-container">
    <select class="custom-select">
        <option value="All">All</option>
        <option value="Customer 1">Customer 1</option>
        <option value="Customer 2">Customer 2</option>
        <option value="Customer 3">Customer 3</option>
        <!-- Other options here -->
    </select>
    <div class="custom-arrow">&#9662;</div> <!-- Unicode character for down arrow -->
</div>
    <div class="header-actions">
        
        <div class="btn-group">
            <button type="button" class="admin-view-btn" data-bs-toggle="dropdown" aria-expanded="false">
                Admin view &nbsp <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center" href="#" id="swapview"> 
				<img src="Image/swap.png" alt="Icon" style="width: 24px; height: 26px;"> 
				&nbsp Swap view</a>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="#">
				<img src="Image/user_manuel.png" alt="Icon" style="width: 24px; height: 21px;">
				&nbsp User manual</a>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="#">
				<i class="bi bi-inbox" ></i>&nbsp Print driver</a></li>
				 <li><a class="dropdown-item d-flex align-items-center" href="#" id="dayoff-link">
                 <img src="Image/dayoff.png" alt="Icon" style="width: 24px; height: 20px;">
				  &nbsp Days off</a>
				 </li>
                <li><a class="dropdown-item d-flex align-items-center" href="login.php">
				<img src="Image/logout.png" alt="Icon" style="width: 24px; height: 27px;">
				 &nbsp Log out</a></li>
            </ul>
        </div>
    </div>
</header>

<!-- JavaScript to handle hover effect on options -->

    <nav class="navbar">
    <a href="#" class="navbar-link active" id="dashboard-link" data-page="admin_users.php" style="margin-left: 25px;">
       <img src="Image/person3.png" alt="Icon" style="width: 28px; height: 14px;"> &nbsp
        <span> Users</span>
    </a>
    <a href="#" class="navbar-link" data-page="admin_roles.php">
       <img src="Image/roles.png" alt="Icon" style="width: 17px; height: 19px;"> &nbsp
        <span>Roles</span>
    </a>
	<a href="#" class="navbar-link" data-page="admin_brand.php">
       <img src="Image/brand.png" alt="Icon" style="width: 21px; height: 17px;"> &nbsp
        <span>Brand</span>
    </a>
	<!--<a href="#" class="navbar-link" data-page="admin_user_rigthts.php">
       <img src="Image/user_right.png" alt="Icon" style="width: 25px; height: 23px;"> &nbsp
        <span>User rights</span>
    </a>-->
	<a href="#" class="navbar-link" data-page="admin_currencies.php">
        <i class="bi bi-currency-euro"></i>
        <span>Currencies</span>
    </a>
	<!--<a href="#" class="navbar-link" data-page="admin_prices_list.php">
        <i class="bi bi-list-ul"></i>
        <span>Prices list</span>
    </a>-->
	<a href="#" class="navbar-link" data-page="admin_printshop.php">
        <i class="bi bi-printer"></i>
        <span>Printshop</span>
    </a>
	<a href="#" class="navbar-link" data-page="admin_articles.php">
        <img src="Image/articles.png" alt="Icon" style="width: 19px; height: 19px;"> &nbsp
        <span>Articles</span>
    </a>
	<a href="#" class="navbar-link" data-page="admin_services.php">
        <i class="bi bi-printer"></i>
        <span>Services</span>
    </a>
	<a href="#" class="navbar-link" data-page="admin_ticket.php">
        <img src="Image/ticket.png" alt="Icon" style="width: 19px; height: 19px;"> &nbsp
        <span>Ticket</span>
    </a>

</nav>
<!-- popup Swap view-->
<div id="popupSwapView" class="popupSelect" style="display: none;">
    <div class="popupSelect3-content" style="height: 165px;">
        <div class="popupSelect-header">
            <h5 class="left-align2">Swap view</h5>	
            <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
        </div>	

        <div class="company-section">
            <!-- Select 1 -->
            <select id="select1"> 
                <option value="Customer" disabled selected>Customer</option>
                <option value="patou">Patou</option>
                <option value="Dior">Dior</option>
            </select>

            <!-- Select 2 - Hidden initially -->
            <select id="select2" style="display: none;">
                <option value="role" disabled selected>Role</option>
                <option value="supplier 1">Supplier 1</option>
                <option value="supplier 2">Supplier 2</option>
            </select>

            <!-- Select 3 - Hidden initially -->
            <select id="select3" style="display: none;">
                <option value="user" disabled selected>User (optional)</option>
                <option value="user 1">User 1</option>
                <option value="user 2">User 2</option>
            </select>
        </div>

        <div class="popupSelect-footer">
            <button class="popupApp-admin"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
        </div>
    </div>
</div>

<main class="main-content" id="main-content">
    <div id="dashboard-content">
        <?php include 'admin_users.php'; ?>
    </div>
</main>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="js/admin_view_dup.js"></script>
 
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ciblons les éléments du DOM
    const select1 = document.getElementById('select1');
    const select2 = document.getElementById('select2');
    const select3 = document.getElementById('select3');
    const popupContent = document.querySelector('.popupSelect3-content');

    // Fonction pour ajuster la hauteur de la popup
    function adjustPopupHeight(height) {
        popupContent.style.height = height + 'px';
    }

    // Événement pour le premier select
    select1.addEventListener('change', function () {
        if (select1.value !== "") {
            // Affiche le deuxième select et ajuste la hauteur
            select2.style.display = 'block';
            adjustPopupHeight(205);
        }
    });

    // Événement pour le deuxième select
    select2.addEventListener('change', function () {
        if (select2.value !== "") {
            // Affiche le troisième select et ajuste la hauteur
            select3.style.display = 'block';
            adjustPopupHeight(255);
        }
    });
});
</script>   
</body>
</html>
