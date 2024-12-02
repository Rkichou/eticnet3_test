<?php
	
	require_once("config.inc.php");
	require_once("includes/is_session_active.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printshop view - MyEticNet</title>
    
    <link rel="icon" href="Image/LogoOnglet.png" type="image/png">
    <link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/all.min.css">
    <!-- bootstrap local-->	
    <link rel="stylesheet" href="CSS/bootstrap-icons.css"> 
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script> 
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/clientview.css">
<link rel="stylesheet" href="css/printshop_view.css">
</head>
<?php 
$options = array(); // Initialiser un tableau pour stocker les options
//CHERCHER TOUS LES CONTRACTORS
	$sql3="select * from contractors order by name";
	$retour3=mysqli_query($con,$sql3); 

	// Parcourir les résultats de la base de données et stocker les options dans le tableau
$option = "<option value='All'>All</option>";
$options[] = $option;	
if (isset($_POST['refix_contractor'])){
    $prefix=$_POST['prefix_contractor'];

    while ($row3 = mysqli_fetch_array($retour3)) 
	{
    	$option = "<option value=\"" . $row3['prefix'] . "\">" . $row3['name'] . "</option>";
    	if ($prefix== $row3['prefix']) {
       		array_unshift($options, $option); // Insérer l'option au début du tableau si c'est le contractor de la session
			$_SESSION['prefix_contractor_id']=$row3['id'];
            $contractor=$row3['name'];
    	} else {
        	$options[] = $option; // Ajouter l'option à la fin du tableau pour les autres contractors
    	}   	
	}    
}
else{
$prefix='all';
while ($row3 = mysqli_fetch_array($retour3)) 
{
    $option = "<option value=\"" . $row3['prefix'] . "\">" . $row3['name'] . "</option>";    	
    $options[] = $option; 
}
$contractor='EMPREINTE';
}?>
<body>
<header class="header d-flex justify-content-between align-items-center">
    <div class="logo d-flex align-items-center">
        <img src="Image/Logo.png" alt="MyEticNet Logo" class="logo-img me-2">
        <h3 class="mb-0">MyEticNet</h3>
    </div>
    <div class="header-center flex-grow-1 text-center">

        <span class="site-title2"><?= $contractor ?></span>
    </div>
	<!-- Select dropdown -->
    <div class="dropdown custom-select-container">
    <select id="contractors" name="contractors" title="contractors" class="contractors custom-select" onchange="set_contractor_printshop();" >       
        <?php   
        foreach ($options as $option) {
			echo $option;
		}?>
    </select>
    <div class="custom-arrow">&#9662;</div> <!-- Unicode character for down arrow -->
</div>
    <div class="header-actions">
        <div class="btn-group">
            <button type="button" class="admin-view-btn " data-bs-toggle="dropdown" aria-expanded="false">
                Printshop view &nbsp <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center" href="#" id="add-user-link"><img src="images/icones/book-and-wrench.svg" alt="User Manuel" class="navbar-icon"> &nbsp User manual</a></li>
				<li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-inbox" ></i>&nbsp Print driver</a></li>
                <li><a class="dropdown-item d-flex align-items-center" href="#" id="dayoff-link"><img src="images/icones/calendar-badge-plus.svg" alt="Days off" class="navbar-icon"> Days off</a></li>
				<li><button class="dropdown-item d-flex align-items-center" onclick="printshop_ticket()" id="Ticket-link"><img src="images/icones/alert-triangle.svg" alt="Ticket" class="navbar-icon"> Ticket</button></li>
                <li><button class="dropdown-item d-flex align-items-center" onclick="disconnect()"><img src="images/icones/log-out.svg" alt="Log out" class="navbar-icon"> Log out</button></li>
            </ul>
        </div>
    </div>
</header>

<!-- JavaScript to handle hover effect on options -->

    <nav class="navbar">
    <button class="navbar-link active" style="margin-left: 25px;" onclick="printshop_dashboard();">
        <img src="images/icones/database.svg" alt="Dashboard" class="navbar-icon"></img>
        <span> Dashboard</span>
    </button>
    <button class="navbar-link" onclick="printshop_upload_rtp()">
        <img src="images/icones/download.svg" alt="Upload rtp" class="navbar-icon"></img>
        <span>Upload RTP</span>
    </button>
    <button class="navbar-link" onclick="printshop_store();">
        <img src="images/icones/store.svg" alt="Store" class="navbar-icon"></img>
        <span>Store</span>
    </button>
	   <button class="navbar-link" onclick="printshop_dictionnary();">
        <img src="images/icones/dictionary.svg" alt="Dictionary" class="navbar-icon"></img>
        <span>Dictionary</span>
    </button>
    <button class="navbar-link" onclick="printshop_excelexport();">
        <img src="images/icones/download.svg" alt="Excel Export" class="navbar-icon"></img>
        <span>Excel export</span>
    </button>    
    

</nav>

<main class="main-content" id="main-content">
    <div id="dashboard-content">
        <?php include 'printshop_dashboard.php'; ?>
    </div>
</main>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="js/printshop_view.js"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Initialisation de Flatpickr sur les champs de date
    flatpickr("#from-date", {
        dateFormat: "Y-m-d",
        defaultDate: "aaaa-mm-jj",
        minDate: "2023-01-01",
        maxDate: "2024-12-31",
        locale: {
            firstDayOfWeek: 1  // La semaine commence par lundi
        }
    });

    flatpickr("#to-date", {
        dateFormat: "Y-m-d",
        defaultDate: "aaaa-mm-jj",
        minDate: "2023-01-01",
        maxDate: "2024-12-31",
        locale: {
            firstDayOfWeek: 1  // La semaine commence par lundi
        }
    });
</script>    
</body>
</html>
