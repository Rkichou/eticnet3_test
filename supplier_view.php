<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier view - MyEticNet</title>
    
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
        <option value="All" disabled selected>All</option>
        <option value="All customers">All customers</option>
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
                       Supplier view &nbsp <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center" href="#" id="add-user-link"><i class="bi bi-book"></i> &nbsp User manual</a></li>
				<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-person-vcard"></i>&nbsp Contacts</a></li>
				<li><a class="dropdown-item d-flex align-items-center" href="#" id="setting-link"><i class="bi bi-gear-fill"></i>&nbsp Settings</a></li>
				 <li><a class="dropdown-item d-flex align-items-center" href="#" id="dayoff-link"><i class="bi bi-gear me-2"></i> Days off</a></li>
				<li><a class="dropdown-item d-flex align-items-center" href="#" id="Ticket-link"><i class="bi bi-exclamation-triangle"></i>&nbsp Ticket</a></li>
                <li><a class="dropdown-item d-flex align-items-center" href="login.php"><i class="bi bi-box-arrow-right me-2"></i> Log out</a></li>
            </ul>
        </div>
    </div>
</header>

<!-- JavaScript to handle hover effect on options -->

    <nav class="navbar">
    <a href="#" class="navbar-link active" style="margin-left: 25px;" id="dashboard-link" data-page="supplier_dashboard.php" data-js="supplier_dashboard.js">
        <i class="bi bi-database"></i>
        <span> Dashboard</span>
    </a>
    <a href="#" class="navbar-link" data-page="supplier_store.php">
        <i class="bi bi-bag-plus"></i>
        <span>Store</span>
    </a>
	   <a href="#" class="navbar-link" data-page="supplier_invoiced_orders.php">
        <i class="bi bi-currency-euro"></i>
        <span>Invoiced orders</span>
    </a>

</nav>

<main class="main-content" id="main-content">
    <div id="dashboard-content">
        <?php include 'supplier_dashboard.php'; ?>
    </div>
</main>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="js/supplier_view_dup.js"></script>
    
</body>
</html>
