<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin view - MyEticNet</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="icon" href="Image/LogoOnglet.png" type="image/png">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Intégration du JS de Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
<!-- Intégration du JS de Bootstrap     
<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<script src="https://cdn.bootcdn.net/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
-->

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
            <button type="button" class="admin-view-btn " data-bs-toggle="dropdown" aria-expanded="false">
                Admin view &nbsp <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center" href="#" id="add-user-link"> 
				<img src="Image/swap.png" alt="Icon" style="width: 24px; height: 26px;"> 
				&nbsp Swap view</a>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="#">
				<img src="Image/user_manuel.png" alt="Icon" style="width: 24px; height: 21px;">
				&nbsp User manual</a>
				</li>
				<li><a class="dropdown-item d-flex align-items-center" href="#">
				<i class="bi bi-person-vcard"></i>&nbsp Contacts</a></li>
				<li><a class="dropdown-item d-flex align-items-center" href="#">
				<i class="bi bi-inbox" ></i>&nbsp Print driver</a></li>
				<li><a class="dropdown-item d-flex align-items-center" href="#" id="setting-link">
				<img src="Image/setting.png" alt="Icon" style="width: 24px; height: 26px;">
				&nbsp Settings</a>
				</li>
				 <li><a class="dropdown-item d-flex align-items-center" href="#" id="dayoff-link">
                 <img src="Image/dayoff.png" alt="Icon" style="width: 24px; height: 20px;">
				  &nbsp Days off</a>
				 </li>
				 <li><a class="dropdown-item d-flex align-items-center" href="#" id="Ticket-link">
				 <img src="Image/ticket.png" alt="Icon" style="width: 24px; height: 23px;">
				 &nbsp Ticket</a>
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
    <a href="#" class="navbar-link active" id="dashboard-link" data-page="test_AU.php">
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

<main class="main-content" id="main-content">
    <div id="dashboard-content">
        <?php include 'test_AU.php'; ?>
    </div>
</main>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="js/admin_view_dup.js"></script>
    
</body>
</html>
