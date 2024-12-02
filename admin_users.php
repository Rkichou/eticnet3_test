
<link rel="stylesheet" href="css/PS_dashboard_dup.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
	.footer {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
}

.table-controls {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 10px;
}

.pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 5px;
}

.page-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 5px;
}

.page-link,
.page-link0 {
    padding: 8px 12px;
    text-decoration: none;
    color: #007bff;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 14px;
    background-color: #fff;
    transition: background-color 0.3s, color 0.3s;
}

.page-link0 {
    font-weight: bold;
}

.page-link.active {
    background-color: #FFA300;
    color: #fff;
    font-weight: bold;
    border-color: #FFA300;
}

.page-link:hover,
.page-link0:hover {
    background-color: #FFA300;
    color: #fff;
}

.dots {
    padding: 8px 12px;
    font-size: 14px;
    color: #777;
}

@media (max-width: 600px) {
    .table-controls {
        font-size: 12px;
    }

    .page-link,
    .page-link0 {
        font-size: 12px;
        padding: 6px 8px;
    }

    .pagination {
        flex-direction: column;
        gap: 10px;
    }
}
	 /* Popup Container */
.popupS-container {
    display: none; /* Hidden by default */
    position: fixed;
    top: 50%;
    left: 50%;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
	align-items: center; /* Centre verticalement */
    justify-content: center; /* Centre horizontalement */
	
}
/* PopupS Content */
.popupS-content {
    background-color: #fff;
    padding: 16px 24px;
    border: 1px solid #888;
    width: 34%;
    border-radius: 20px;
	
}

/* Close Button */
.closeS-btn {
    color: #aaa;
    float: right;
    font-size: 22px;
    font-weight: bold;
}

.closeS-btn:hover,
.closeS-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Form Styling */
.popupS-content h5 {
    margin-bottom: 20px;
	font-weight: bold;
	font-size: 18px;
}

.popupS-content input[type="text"],
.popupS-content input[type="email"],
.popupS-content select {
    width: 100%;
	height: 35px;
    padding: 8px 12px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
	font-size: 14px;
	margin-bottom: 0px;
}
.input-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.input-label {
    font-size: 14px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

/* Styling for the select dropdown */
.styled-select {
    padding: 5px;
    padding-left: 17px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='24' height='24'%3E%3Cpath fill='none' stroke='%23666' stroke-width='2' d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
    font-size: 14px;
    background-repeat: no-repeat;
    background-position: right 10px center;
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 96%;
    height: 50%;
    background-color: #f9f9f9;  /* Light background for contrast */
    appearance: none;  /* Hides the default browser dropdown icon */
}

/* Optional: Style for custom dropdown icon */
.styled-select:after {
    content: "";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    border: 6px solid transparent;
    border-top-color: #333;  /* Arrow color */
    pointer-events: none;
}

/* Hover and focus states for better UX */
.styled-select:hover,
.styled-select:focus {
    outline: none;
}
.modal-content {
    background-color: #fafafa;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 275px;
    border-radius: 10px;
}

/* Responsive layout adjustments */
@media (max-width: 768px) {
    .styled-select {
        font-size: 13px;
        padding: 8px;
    }
}
 .input-group2 {
    display: flex;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 8px;
    flex-wrap: wrap;
    flex-direction: column;
}
.popupS-content .form-group input[type="text"]{
    width: 49.5%;
	
}
.popupS-content .form-group2 input[type="text"]{
    width: 77%;
	
}
.popupS-content .form-group2 select {
    width: 22%;
}
.popupSelect2 {
    z-index: 1200; /* S'assure que le popup Add Service est au-dessus du popup Add User */
}

.entête th i {s
}

.entête th.asc i {
    transform: rotate(180deg); /* Flèche vers le haut quand tri croissant */
}

	</style>
        <div class="order-summary">
     
            <div class="search-container">
                    <input type="text" id="search-query" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i class="bi bi-sliders" onclick="openPopupAdSh();"></i>
                    </button>
            </div>		   
            <button class="add-user-btn" onclick="openPopupAdUser()">
                    <img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;"> &nbsp Add user
            </button>
        </div>
        <div id="dashboard-content">
            <table class="table1">
        <thead>
            <tr class='entête'>
                <th style="text-align: left;">ID</span></th>
                <th>Login </th>
                <th>Password</th>
                <th id="sortCompany">Company<i class="bi bi-arrow-down"></i></th>
				<th id="sortRole">Rôle<i class="bi bi-arrow-down"></i></th>
				<th style="width:200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php 
   include('config.inc.php');
// Step 2: Calculate total rows and total pages
$totalRowsQuery = "SELECT COUNT(*) as total FROM users";
$totalRowsResult = mysqli_query($con, $totalRowsQuery);
//var_dump($rowsPerPage);
if ($totalRowsResult) {
    $totalRows = mysqli_fetch_assoc($totalRowsResult)['total'];
    $totalPages = ceil($totalRows / $rowsPerPage);
} else {
    die("Error calculating total rows: " . mysqli_error($con));
}
   // Requête pour récupérer les informations de tous les utilisateurs
   $userQuery = "SELECT * FROM users LIMIT $rowsPerPage OFFSET $offset";
   $userResult = mysqli_query($con, $userQuery);

   
   
   

   foreach ($userResult as $index => $row) {
       $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
       $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
       ?>
       <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
           <td style="text-align: left;">
               <button class="icon <?= $btnClass ?>"  >
                      <img src="Image/OfVert1.png" alt="Icon" style="width: 12px; height: 11px;">
                     </button>
                   <?= $row['id'] ?>
           </td>
           <td><?= $row['login'] ?></td>
           <td>*********************</td>
           
           
           <?php
//  Les IDs des contractors sont sous forme de chaîne, ex: '{1}{2}{3}'
if (isset($row['contractors']) && !empty($row['contractors'])) {
    $contractorsString = $row['contractors'];
    
    // Supprimer les accolades et diviser en un tableau d'IDs de contractors
    $contractorsIds = explode('}{', trim($contractorsString, '{}'));
    
    // Vérifier si des IDs ont été extraits
    if (!empty($contractorsIds)) {
        // Créer une liste d'IDs séparés par des virgules pour la requête SQL
        $contractorsIdsList = implode(',', array_map('intval', $contractorsIds)); // Sécuriser les IDs avec intval
        
        // Requête SQL pour récupérer les contractors par leurs IDs
        $contractorsQuery = "SELECT * FROM contractors WHERE id IN ($contractorsIdsList) LIMIT 1"; // Limite à 1 résultat
        $contractorsResult = mysqli_query($con, $contractorsQuery);
        
        if ($contractorsResult) {
            $contractor = mysqli_fetch_assoc($contractorsResult); // Récupérer le premier contractant
            if ($contractor) {
                ?>
                <td><?= htmlspecialchars($contractor['name']) ?></td>
                <?php
            } else {
                // Si aucun contractor n'a été trouvé
                echo "<td>Aucun contractor trouvé.</td>";
            }
        } else {
            // Si erreur lors de la requête SQL
            echo "<td>Erreur lors de la récupération des contractors: " . mysqli_error($con) . "</td>";
        }
    } else {
        // Si aucun ID n'a été extrait
        echo "<td>Aucune company trouvée.</td>";
    }
} else {
    // Si aucun contractor n'est spécifié
    echo "<td>Aucune company spécifiée.</td>";
}
?>


<?php
//  rôle actuel de l'utilisateur
$currentRoleId = $row['role'];

// Requête pour récupérer le nom du rôle actuel à partir de son ID
$currentRoleQuery = "SELECT * FROM roles WHERE id = '$currentRoleId'"; // Vérifie que tu utilises la bonne variable dynamique
$currentRoleResult = mysqli_query($con, $currentRoleQuery);

// Utiliser mysqli_fetch_assoc() pour un seul résultat
$currentRole = mysqli_fetch_assoc($currentRoleResult);




?>

           <td><span class="state2 <?= strtolower(str_replace(' ', '-', strtolower($currentRole['name']))) ?>"><?= strtolower($currentRole['name']) ?></span></td>			
           <td>
                <button class="btn-edit-user" id="EditUser" onclick="event.stopPropagation();openEditUserPopup(this);"
                data-id="<?= $row['id']; ?>"
        data-login="<?= $row['login']; ?>"
        data-email="<?= $row['user_email']; ?>"
        data-username="<?= $row['user_name']; ?>"
        data-role="<?= $row['role']; ?>"
        data-printshop="<?= $row['printshop']; ?>"
        data-contractors="<?= htmlspecialchars($row['contractors']); ?>"
        data-services="<?= htmlspecialchars($row['service']); ?>"
        data-currencies="<?= htmlspecialchars($row['devise']); ?>">
                    <i class="bi bi-pencil-square"></i>&nbsp;Edit
                </button>
                <button class="btn-delete-user" id="DeleteUser"  data-id="<?= $row['id']; ?>" onclick="event.stopPropagation();">
				   <i class="bi bi-trash3"></i>
				Delete</button>
            </td>
        </tr>
        <tr class="main-row2 <?= $rowClass ?>" style="display: none;">
        <td colspan="9">
        <div class="details-container">

           <!-- General informations part -->
            <div class="details-info details-info1">
			<h5 class="titreGI">General informations</h5>
            <div class="address-section">
            <div class="address-block">

				
                <label for="login">Login</label>
                <input type="text" class="address-input" placeholder="@Log-in" value="<?= htmlspecialchars($row['login'], ENT_QUOTES) ?>"><br>
				<label for="pwd">Password</label>
                <input type="text" class="address-input" placeholder="*********************" value="*********************"><br>
				<label for="email">Email</label>
                <input type="text" class="address-input" placeholder="adress@email.com" value="<?= htmlspecialchars($row['user_email'], ENT_QUOTES) ?>"><br>
				<label for="username">Username</label>
                <input type="text" class="address-input" placeholder="USER_NAME" value="<?= htmlspecialchars($row['user_name'], ENT_QUOTES) ?>"><br>
				
				
				<div class="company-section">
                <?php
//  rôle actuel de l'utilisateur
$currentRoleId = $row['role'];

// Requête pour récupérer le nom du rôle actuel à partir de son ID
$currentRoleQuery = "SELECT * FROM roles WHERE id = '$currentRoleId'"; // Vérifie que tu utilises la bonne variable dynamique
$currentRoleResult = mysqli_query($con, $currentRoleQuery);

// Utiliser mysqli_fetch_assoc() pour un seul résultat
$currentRole = mysqli_fetch_assoc($currentRoleResult);




?>

<label for="username">Role</label>
<select>
    <!-- Affiche le rôle actuel de l'utilisateur comme première option -->
    <option value="Role <?= htmlspecialchars($currentRoleId); ?>"><?= $currentRole['name'] ?></option>
    
            </select>
				</div>


				<div class="company-section">
				<?php
//  rôle actuel de l'utilisateur
$currentRoleId = $row['printshop'];

// Requête pour récupérer le nom du rôle actuel à partir de son ID
$currentRoleQuery = "SELECT * FROM printshop WHERE id = '$currentRoleId'"; // Vérifie que tu utilises la bonne variable dynamique
$currentRoleResult = mysqli_query($con, $currentRoleQuery);

// Utiliser mysqli_fetch_assoc() pour un seul résultat
$currentRole = mysqli_fetch_assoc($currentRoleResult);
$rolesQuery = "SELECT * FROM printshop WHERE id != '$currentRoleId'";
$rolesResult = mysqli_query($con, $rolesQuery); // Exécution de la requête
echo($cuRoleId);



?>

<label for="username">printshop</label>
<select>
    <!-- Affiche le rôle actuel de l'utilisateur comme première option -->
    <option value="printshop <?= htmlspecialchars($currentRoleId); ?>"><?= $currentRole['name'] ?></option>
                      <!-- Affiche les autres rôles disponibles -->
    <?php while ($role = mysqli_fetch_assoc($rolesResult)): ?>
        <option value="<?= htmlspecialchars($role['id']); ?>">
            <?= htmlspecialchars($role['name']); ?>
        </option>
    <?php endwhile; ?>
    
   
                </select>
				</div>
	
				
				
            </div>
			
        </div>

            </div>

           
            <div class="details-info details-info2">
			
            <div class="contractors-container">
                  <h5 class="titreContract" style="margin-left: 13%;">Contractors</h5>
                  
                </div>
				<div class="button-group3">
                <?php
                                                    //  les IDs des contractors sont  sous forme de chaîne, ex: '{1}{2}{3}'
                                                    if (isset($row['contractors']) && !empty($row['contractors'])) {
                                                        $contractorsString = $row['contractors'];
                                                        
                                                        // Supprimer les accolades et diviser en un tableau d'IDs de contractors
                                                        $contractorsIds = explode('}{', trim($contractorsString, '{}'));
                                                        
                                                        // Vérifier si des IDs ont été extraits
                                                        if (!empty($contractorsIds)) {
                                                            // Créer une liste d'IDs séparés par des virgules pour la requête SQL
                                                            $contractorsIdsList = implode(',', array_map('intval', $contractorsIds)); // Sécuriser les IDs avec intval
                                                            
                                                            // Requête SQL pour récupérer les contractors par leurs IDs
                                                            $contractorsQuery = "SELECT * FROM contractors WHERE id IN ($contractorsIdsList)";
                                                            $contractorsResult = mysqli_query($con, $contractorsQuery);
                                                            
                                                            if ($contractorsResult) {
                                                                while ($contractor = mysqli_fetch_assoc($contractorsResult)) {
                                                                    ?>
                                                                    <button class="custom-button">
                                                                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;
                                                                        <?= htmlspecialchars($contractor['name']) ?>
                                                                    </button>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo "<p>Erreur lors de la récupération des devises: " . mysqli_error($con) . "</p>";
                                                            }
                                                        } else {
                                                            echo "<p>Aucune contractor trouvée.</p>";
                                                        }
                                                    } else {
                                                        echo "<p>Aucune contractors spécifiée.</p>";
                                                    }
                                                    ?>
                
                </div>
				
				 <!-- Service part -->
				<div class="contractors-container">
                  <h5 class="titreContract" style="margin-left: 13%;">Service</h5>
                  
                </div>
                
				<div class="button-group3">
                <?php
                                                    // Supposons que $row['devise'] contient les IDs des devises sous forme de chaîne, ex: '{1}{2}{3}'
                                                    if (isset($row['service']) && !empty($row['service'])) {
                                                        $contractorsString = $row['service'];
                                                        
                                                        // Supprimer les accolades et diviser en un tableau d'IDs de devises
                                                        $contractorsIds = explode('}{', trim($contractorsString, '{}'));
                                                        
                                                        // Vérifier si des IDs ont été extraits
                                                        if (!empty($contractorsIds)) {
                                                            // Créer une liste d'IDs séparés par des virgules pour la requête SQL
                                                            $contractorsIdsList = implode(',', array_map('intval', $contractorsIds)); // Sécuriser les IDs avec intval
                                                            
                                                            // Requête SQL pour récupérer les devises par leurs IDs
                                                            $contractorsQuery = "SELECT * FROM services WHERE id IN ($contractorsIdsList)";
                                                            $contractorsResult = mysqli_query($con, $contractorsQuery);
                                                            
                                                            if ($contractorsResult) {
                                                                while ($contractor = mysqli_fetch_assoc($contractorsResult)) {
                                                                    ?>
                                                                    <button class="custom-button">
                                                                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;
                                                                        <?= htmlspecialchars($contractor['name']) ?>
                                                                    </button>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo "<p>Erreur lors de la récupération des devises: " . mysqli_error($con) . "</p>";
                                                            }
                                                        } else {
                                                            echo "<p>Aucune service trouvée.</p>";
                                                        }
                                                    } else {
                                                        echo "<p>Aucune service spécifiée.</p>";
                                                    }
                                                    ?>
                </div>
                
                 <!-- Currency part -->
				<div class="contractors-container">
                  <h5 class="titreContract" style="margin-left: 13%;">Currency</h5>
       
                </div>
				<div class="button-group3">
                <?php
                                                    // Supposons que $row['devise'] contient les IDs des devises sous forme de chaîne, ex: '{1}{2}{3}'
                                                    if (isset($row['devise']) && !empty($row['devise'])) {
                                                        $deviseString = $row['devise'];
                                                        
                                                        // Supprimer les accolades et diviser en un tableau d'IDs de devises
                                                        $deviseIds = explode('}{', trim($deviseString, '{}'));
                                                        
                                                        // Vérifier si des IDs ont été extraits
                                                        if (!empty($deviseIds)) {
                                                            // Créer une liste d'IDs séparés par des virgules pour la requête SQL
                                                            $deviseIdsList = implode(',', array_map('intval', $deviseIds)); // Sécuriser les IDs avec intval
                                                            
                                                            // Requête SQL pour récupérer les devises par leurs IDs
                                                            $currencyQuery = "SELECT * FROM devises WHERE id IN ($deviseIdsList)";
                                                            $currencyResult = mysqli_query($con, $currencyQuery);
                                                            
                                                            if ($currencyResult) {
                                                                while ($currency = mysqli_fetch_assoc($currencyResult)) {
                                                                    ?>
                                                                    <button class="custom-button">
                                                                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;
                                                                        <?= htmlspecialchars($currency['name']) ?>
                                                                    </button>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo "<p>Erreur lors de la récupération des devises: " . mysqli_error($con) . "</p>";
                                                            }
                                                        } else {
                                                            echo "<p>Aucune devise trouvée.</p>";
                                                        }
                                                    } else {
                                                        echo "<p>Aucune devise spécifiée.</p>";
                                                    }
                                                    ?>
                </div>

            </div>
			
        </div>
            </div>

			
        </div>
            </div>
        </div>
    </td>
</tr>

		
		
		
    <?php } ?>
           </table> 
        </div> 	
        <?php
require_once("config.inc.php");

// Query to fetch all contractors
$contractorsQuery = "SELECT * FROM contractors";
$contractorsResult = mysqli_query($con, $contractorsQuery);
?>

<!-- Popup HTML Structure -->
<div id="popup-advanced-search" class="modal">
    <div class="modal-content">
        <span class="popup-close"><i class="bi bi-x-lg" onclick="closePopupAdSh();"></i></span>
        <h2 class="popup-title">Advanced research</h2>

        <div class="popup-section">
            <h3 class="section-title">User informations</h3>
            <div class="input-group2">
                <input type="text" placeholder="ID" class="input-field" style="background-image: none;">
                <input type="text" placeholder="login" class="input-field" style="background-image: none;">
                <input type="text" placeholder="user name" class="input-field" style="background-image: none;">

                <!-- Company Select Dropdown with Label -->
                <label for="contractors" class="input-label">Company</label>
                <select name="contractors" id="contractors" class="styled-select" onchange="fetchServices(this.value);">
                    <option value="" disabled selected>Select a company</option>
                    <?php while ($contractor = mysqli_fetch_assoc($contractorsResult)): ?>
                        <option value="<?= htmlspecialchars($contractor['prefix']); ?>">
                            <?= htmlspecialchars($contractor['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <!-- Services Dropdown -->
                <label for="services" class="input-label">Services</label>
                <select name="services" id="services" class="styled-select">
                    <option value="" disabled selected>Select a service</option>
                </select>

            </div>
        </div>

        <div class="Recher-button-container">
            <button class="btn-Recher">Search</button>
        </div>
    </div>
</div>




</tbody>

 <!-- popup delete user --> 
 <div id="deleteuser" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once a user has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" id="delete_user" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>
 <!-- popup delete contact --> 
 <div id="deletecontact" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once a contact has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" id="delete_con" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>
 <!-- popup delete adress --> 
 <div id="deleteadress" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once an adress has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" id="delete_add" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>
  <!-- popup Select Add service --> 
	<div id="popupSelectServ" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add service</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search service</label>	
                <div class="company-section">
                <select id="service_select" value="<?= htmlspecialchars($service['id']); ?>" name="service">
                <?php
                $servicesQuery = "SELECT * FROM services";
                $servicesResult = mysqli_query($con, $servicesQuery);
                while ($service = mysqli_fetch_assoc($servicesResult)): ?>
                     <option id="sele_service" value="<?= htmlspecialchars($service['id']); ?>">
                        <?= htmlspecialchars($service['name']); ?>
                    </option> 
                <?php endwhile; ?></select>
				</div>
         
            <div class="popupSelect-footer">
            <button class="popupApp-admin" onclick="addServiceToList()"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>  
	
 <!-- popup Select Add Contractors-->
	<div id="popupSelectCon" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add Contractor</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search contractor</label>	
                <div class="company-section">
				<select id="contractor_select" name="role">
                            <?php
                            $rolesQuery = "SELECT * FROM contractors";
                            $rolesResult = mysqli_query($con, $rolesQuery);
                            while ($role = mysqli_fetch_assoc($rolesResult)): ?>
                                <option value="<?= htmlspecialchars($role['id']); ?>">
                                    <?= htmlspecialchars($role['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin" onclick="addContractorToList()"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div> 





 <!-- popup Select Add Currency-->
	<div id="popupSelectCurr" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add currency</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search currency</label>	
                <div class="company-section">
				<select name="role" id="currency_select" >
                            <?php
                            $rolesQuery = "SELECT * FROM devises";
                            $rolesResult = mysqli_query($con, $rolesQuery);
                            while ($role = mysqli_fetch_assoc($rolesResult)): ?>
                                <option value="<?= htmlspecialchars($role['id']); ?>">
                                    <?= htmlspecialchars($role['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin" onclick="addCurrencyToList()"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>   

    
<!-- Popup Edit User -->
<div id="userEditPopup" class="popupAdUser">
    <div class="popupAdUser-content">
        <span class="closeAdUser-btn" onclick="closePopupEditUser()">&times;</span>

        <!-- Formulaire pour éditer un utilisateur -->
        <form action="update_user.php" method="POST" id="editUserForm">
            <!-- Titre et ID User -->
            <div class="headerPUser">
                <h5 class="titreGI">Edit user</h5>
                <input type="hidden" name="user_id" id="userId" value=''>
                </div>

            <div class="popupAdUser-grid">
                <!-- Partie gauche - Informations générales -->
                <div class="left-section">
                    <h5 class="titreGI">General informations</h5>
                    
                    <label for="login">Login</label>
                    <input type="text" class="address-input" name="login" id="editLogin" placeholder="@Log-in" required><br>

                    <label for="pwd">Password</label>
                    <input type="password" class="address-input" name="password" id="editPassword" placeholder="*********************" required><br>

                    <label for="email">Email</label>
                    <input type="email" class="address-input" name="email" id="editEmail" placeholder="adress@email.com" required><br>

                    <label for="username">Username</label>
                    <input type="text" class="address-input" name="username" id="editUsername" placeholder="USER_NAME" required><br>

                    <div class="company-section">
                        <!-- Requête pour récupérer les rôles -->
                        <label for="role">Role</label>
                        <select name="role" id="editRole">
                            <?php
                            $rolesQuery = "SELECT * FROM roles";
                            $rolesResult = mysqli_query($con, $rolesQuery);
                            while ($role = mysqli_fetch_assoc($rolesResult)): ?>
                                <option value="<?= htmlspecialchars($role['id']); ?>">
                                    <?= htmlspecialchars($role['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <label for="printshop">Printshop</label>
                    <div class="company-section">
                        <select name="printshop" id="editPrintshop">
                            <?php
                            $printshopQuery = "SELECT * FROM printshop";
                            $printshopResult = mysqli_query($con, $printshopQuery);
                            while ($printshop = mysqli_fetch_assoc($printshopResult)): ?>
                                <option value="<?= htmlspecialchars($printshop['id']); ?>">
                                    <?= htmlspecialchars($printshop['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <!-- Partie droite - Contractors, Service, Currency -->
                <div class="right-section">
                    <!-- Contractors part -->
                    <div style="margin-top: 30px" class="contractors-container">
                        <h5 class="titreContract">Contractors</h5>
                        <button class="custom-button2" id="add_contractor_2" type="button">
                            <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                        </button>
                    </div>
                    <div class="button-group" id="CTR">
                        <!-- Les contractors sélectionnés apparaîtront ici -->
                        

                    </div>

                    <!-- Service part -->
                    <div class="contractors-container">
                        <h5 class="titreContract">Service</h5>
                        <button class="custom-button2" id="add_serv_2" type="button">
                            <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                        </button>
                    </div>
                    <div class="button-group" id="srv">
                        <!-- Les services sélectionnés apparaîtront ici -->
                    </div>

                    <!-- Currency part -->
                    <div class="contractors-container">
                        <h5 class="titreContract">Currency</h5>
                        <button class="custom-button2" id="add_currency_2" type="button">
                            <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                        </button>
                    </div>
                    <div class="button-group" id="CRN">
                        <!-- Les devises sélectionnées apparaîtront ici -->
                    </div>
                </div>
            </div>
            <input type="hidden" id="selected_services" name="selected_services" value="">
            <input type="hidden" id="selected_contractors" name="selected_contractors" value="">
            <input type="hidden" id="selected_currency" name="selected_currency" value="">

            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="submit" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp; Save</button>
            </div>
        </form>
    </div>
</div>

  <!-- popup Select Add service --> 
  <div id="popupSelectServ_add" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add service</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search service</label>	
                <div class="company-section">
                <select id="service_select_add" value="<?= htmlspecialchars($service['id']); ?>" name="service">
                <?php
                $servicesQuery = "SELECT * FROM services";
                $servicesResult = mysqli_query($con, $servicesQuery);
                while ($service = mysqli_fetch_assoc($servicesResult)): ?>
                     <option id="sele_service" value="<?= htmlspecialchars($service['id']); ?>">
                        <?= htmlspecialchars($service['name']); ?>
                    </option> 
                <?php endwhile; ?></select>
				</div>
         
            <div class="popupSelect-footer">
            <button class="popupApp-admin" onclick="addServiceToList_add()"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>  
	
 <!-- popup Select Add Contractors-->
	<div id="popupSelectCon_add" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add Contractor</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search contractor</label>	
                <div class="company-section">
				<select id="contractor_select_add" name="role">
                            <?php
                            $rolesQuery = "SELECT * FROM contractors";
                            $rolesResult = mysqli_query($con, $rolesQuery);
                            while ($role = mysqli_fetch_assoc($rolesResult)): ?>
                                <option value="<?= htmlspecialchars($role['id']); ?>">
                                    <?= htmlspecialchars($role['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin" onclick="addContractorToList_add()"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div> 





 <!-- popup Select Add Currency-->
	<div id="popupSelectCurr_add" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add currency</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search currency</label>	
                <div class="company-section">
				<select name="role" id="currency_select_add" >
                            <?php
                            $rolesQuery = "SELECT * FROM devises";
                            $rolesResult = mysqli_query($con, $rolesQuery);
                            while ($role = mysqli_fetch_assoc($rolesResult)): ?>
                                <option value="<?= htmlspecialchars($role['id']); ?>">
                                    <?= htmlspecialchars($role['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin" onclick="addCurrencyToList_add()"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>   


<!-- Popup Add User -->
<div id="userPopup" class="popupAdUser">
    <div class="popupAdUser-content">
        <span class="closeAdUser-btn" onclick="closePopupAdUser()">&times;</span>

        <!-- Formulaire pour ajouter un utilisateur -->
        <form action="add_user.php" method="POST" id="userForm">
            <!-- Titre et ID User -->
            <div class="headerPUser">
                <h5 class="titreGI">Add user</h5>
            </div>

            <div class="popupAdUser-grid">
                <!-- Partie gauche - Informations générales -->
                <div class="left-section">
                    <h5 class="titreGI">General informations</h5>
                    
                    <label for="login">Login</label>
                    <input type="text" class="address-input" name="login" placeholder="@Log-in" required><br>

                    <label for="pwd">Password</label>
                    <input type="password" class="address-input" name="password" placeholder="*********************" required><br>

                    <label for="email">Email</label>
                    <input type="email" class="address-input" name="email" placeholder="adress@email.com" required><br>

                    <label for="username">Username</label>
                    <input type="text" class="address-input" name="username" placeholder="USER_NAME" required><br>

                    <div class="company-section">
                        <!-- Requête pour récupérer les rôles -->
                        <label for="role">Role</label>
                        <select name="role">
                            <?php
                            $rolesQuery = "SELECT * FROM roles";
                            $rolesResult = mysqli_query($con, $rolesQuery);
                            while ($role = mysqli_fetch_assoc($rolesResult)): ?>
                                <option value="<?= htmlspecialchars($role['id']); ?>">
                                    <?= htmlspecialchars($role['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <label for="printshop">Printshop</label>
                    <div class="company-section">
                        <select name="printshop">
                            <?php
                            $printshopQuery = "SELECT * FROM printshop";
                            $printshopResult = mysqli_query($con, $printshopQuery);
                            while ($printshop = mysqli_fetch_assoc($printshopResult)): ?>
                                <option value="<?= htmlspecialchars($printshop['id']); ?>">
                                    <?= htmlspecialchars($printshop['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <!-- Partie droite - Contractors, Service, Currency -->
                <div class="right-section">
                    <!-- Contractors part -->
                    <div class="contractors-container">
                        <h5 class="titreContract">Contractors</h5>
                        <button class="custom-button2" id="add_contractor_1" type="button">
                            <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                        </button>
                    </div>
                    <div class="button-group" id="CTR_add">
                        
                    </div>

                  <!-- Service part -->
<div class="contractors-container">
    <h5 class="titreContract">Service</h5>
    <button class="custom-button2" id="add_serv_1" type="button" >
        <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
    </button>
</div>
<div class="button-group" id="srv_add">
    <!-- Les services sélectionnés apparaîtront ici -->

</div>

                    <!-- Currency part -->
                    <div class="contractors-container">
                        <h5 class="titreContract">Currency</h5>
                        <button class="custom-button2" id="add_currency_1" type="button">
                            <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                        </button>
                    </div>
                    <div class="button-group" id="CRN_add">
                        
                    </div>
                </div>
            </div>
            <input type="hidden" id="selected_services_add" name="selected_services" value="">
    <input type="hidden" id="selected_contractors_add" name="selected_contractors" value="">
    <input type="hidden" id="selected_currency_add" name="selected_currency" value="">
            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="submit" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp; Save</button>
            </div>
        </form>
    </div>
</div>

<!-- popup Edit contact-->
     <div id="Editcontact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeEC"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Edit contact</h5>
         </div>
        <form>
		    <label for="first">name</label>
            <input type="text" placeholder="first" name="contact_name">
			
			<label for="email">Email</label>
            <input type="text" placeholder="name@email.com" name="contact_email">

			<label for="login">login</label>
            <input type="text" placeholder="login" name="login">
			<label for="pwd">Password</label>
            <input type="text" placeholder="******" name="role">
		
        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="submit" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>        </form>
    </div>
</div>
  
<!-- popup Add contact -->
<div id="Addcontact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeAC"><i class="bi bi-x-lg"></i></span>

        <div class="headerEcont">
            <h5 class="titreGI">Add contact</h5>
        </div>

        <!-- Formulaire pour ajouter un contact -->
        <form action="add_contact.php" method="POST">
            <!-- ID User caché -->
            <input type="hidden" id="id_user" name="id_user" value="">

            <label for="login">Login</label>
            <input type="text" name="login" placeholder="Login" required><br>

            <label for="pwd">Password</label>
            <input type="text" name="pwd" placeholder="******" required><br>

            <label for="first">First Name</label>
            <input type="text" name="contact_name" placeholder="First Name" required><br>

            <label for="last">Last Name</label>
            <input type="text" name="last_name" placeholder="Last Name"><br>

            <label for="email">Email</label>
            <input type="email" name="contact_email" placeholder="name@email.com" required><br>

            <label for="phone">Phone (optional)</label>
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+216">+216</option>
                    <option value="+456">+456</option>
                </select>
                <input type="text" placeholder="Phone number">
            </div>

            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="submit" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp; Save</button>
            </div>
        </form>
    </div>
</div>


<!-- popup edit address -->
<div id="Editadress" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeEA"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Edit address</h5>
          <p class="user-id">ID Address: <span id="addressIdDisplay"></span></p>
        </div>
        <form id="editAddressForm">
            <input type="hidden" name="address_id" id="addressId"> <!-- Champ caché pour l'ID -->

            <label for="first">Contact</label>
            <input type="text" name="contact" placeholder="First name"  id="contact">

            <label for="supplier_code">Supplier code</label>
            <input type="text" name="supplier_code" placeholder="Supplier code" id="supplier_code">

            <label for="address_name">Address name</label>
            <input type="text" name="address_name" placeholder="Address name" id="address_name">

            <label for="address_1">Address 1</label>
            <input type="text" name="address_1" placeholder="Address 1" id="address_1">

            <label for="address_2">Address 2 (optional)</label>
            <input type="text" name="address_2" placeholder="Address 2" id="address_2">

            <div class="form-group">
                <label for="zip">ZIP code</label>
                <input type="text" name="zip" placeholder="ZIP code" id="zip">

                <label for="city">City</label>
                <input type="text" name="city" placeholder="City" id="city">
            </div>

            <label for="region">Region / Province (optional)</label>
            <input type="text" name="region" placeholder="Region" id="region">

            <label for="country">Country</label>
            <input type="text" name="country" placeholder="Country" id="country">

            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="submit" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp; Save</button>
            </div>
        </form>
    </div>
</div>

<!-- popup Add adress -->
<div id="Addadress" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeAA"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
            <h5 class="titreGI">Add adress</h5>
        </div>
        
        <form id="addressForm">
            <!-- ID User caché -->
            <input type="hidden" id="id_user_address" name="id_user" value="">
            
            <label for="first">Contact</label>
            <input type="text" name="contact" placeholder="Contact">
			
            <label for="last">Supplier code</label>
            <input type="text" name="supplier_code" placeholder="Supplier code">
			
            <label for="address_name">Address name</label>
            <input type="text" name="address_name" placeholder="Address name">
			
            <label for="address_1">Address 1</label>
            <input type="text" name="address_1" placeholder="Address 1">
			
            <label for="address_2">Address 2 (optional)</label>
            <input type="text" name="address_2" placeholder="Address 2">
			
            <div class="form-group">
                <label for="zip">ZIP code</label>
                <label for="city">City</label>
            </div>
			
            <div class="form-group">
                <input type="text" name="zip" placeholder="ZIP code">
                <input type="text" name="city" placeholder="City">
            </div>
		
            <label for="state">Region / Province (optional)</label>
            <input type="text" name="state" placeholder="State / Province">
		
            <label for="country">Country</label>
            <input type="text" name="country" placeholder="Country">

            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="submit" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp;Save</button>
            </div>
        </form>
    </div>
</div>

<script src="js/admin_dashboard_dup.js"></script>
<script src="js/admin_users_dup.js"></script>


<script>
$(document).ready(function() {
    var userIdToDelete; // Variable pour stocker l'ID de l'utilisateur à supprimer

    // Lorsque l'utilisateur clique sur le bouton de suppression d'utilisateur
    $('#dashboard-content').on('click', '.btn-delete-user', function(event) {
        event.stopPropagation();  // Empêche la propagation de l'événement
        userIdToDelete = $(this).data('id'); // Récupérer l'ID de l'utilisateur à supprimer
        openPopup('deleteuser'); // Ouvre le pop-up de confirmation pour supprimer l'utilisateur
    });

    // Confirmer et envoyer la requête AJAX pour supprimer l'utilisateur
    $('#delete_user').on('click', function() {
        if (userIdToDelete) {
            $.ajax({
                type: 'POST',
                url: 'delete_user.php', // Script PHP pour gérer la suppression d'utilisateur
                data: { id: userIdToDelete }, // Envoyer l'ID de l'utilisateur à supprimer
                success: function(response) {
                    // Vérifie si la suppression a réussi
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('User deleted successfully!');
                        location.reload(); // Rafraîchir la page pour voir les changements
                    } else {
                        alert('Error deleting user: ' + data.message); // Afficher le message d'erreur
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting user: ' + error); // Afficher l'erreur AJAX
                }
            });
        }
        $('#deleteuser').hide(); // Cacher la popup après la suppression
    });

    $('#dashboard-content').on('click', '.btn-edit-user', function(event) {
  event.stopPropagation();  // Stoppe la propagation de l'événement au parent
  
  var userId = $(this).data('id');
  
  // Remplacez cette fonction par celle qui ouvre votre pop-up d'édition
  openPopup('userEditPopup'); 
  openEditUserPopup(this); 
});


$('#search-query').on('keyup', function() {
    var query = $(this).val(); // Récupère la valeur de la barre de recherche
   // alert("coucou");

    // Déclencher la recherche dès que l'utilisateur tape une lettre
    if (query.length >= 1) { // Cette condition vérifie si la longueur de la chaîne est supérieure à zéro

        $.ajax({
            type: 'POST',
            url: 'search_users.php', // Fichier PHP pour traiter la recherche
            data: { query: query },
            dataType: 'json',
            success: function(data) {

                $('#dashboard-content tbody').html(''); // Efface le contenu actuel du tableau

                // Génère les lignes pour chaque utilisateur trouvé
                $.each(data.results, function(index, user) {
                    var rowHtml = `
                        <tr class="main-row ${index % 2 === 0 ? 'even-row' : 'odd-row'}" onclick="toggleDetails(this)">
                            <td style="text-align: left;">
                                <button class="icon <?= $btnClass ?>">
                                    <img src="Image/OfVert1.png" alt="Icon" style="width: 12px; height: 11px;">
                                </button>
                                ${user.id}
                            </td>
                            <td>${user.login}</td>
                            <td>*********************</td>
                            <td>${user.company}</td>
                            <td>
                                <span class="state2 ${user.role.toLowerCase().replace(/\s+/g, '-')}">
                                    ${user.role.toLowerCase()}
                                </span>
                            </td>
                            <td>
                                <button class="btn-edit-user" 
                                    data-id="${user.id}"
                                    data-login="${user.login}"
                                    data-email="${user.email}"
                                    data-username="${user.username}"
                                    data-role="${user.roleid}"
                                    data-printshop="${user.printshopid}"
                                    data-contractors="${user.contractorsid}"
                                    data-services="${user.servicesid}"
                                    data-currencies="${user.currenciesid}">
                                    <i class="bi bi-pencil-square"></i>&nbsp;Edit
                                </button>
                                <button class="btn-delete-user" data-id="${user.id}">
                                    <i class="bi bi-trash3"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <tr class="main-row2 ${index % 2 === 0 ? 'even-row' : 'odd-row'}" style="display: none;">
                            <td colspan="6">
                                <div class="details-container">
                                    <div class="details-info details-info1">
                                        <h5 class="titreGI">General informations</h5>
                                        <div class="address-section">
                                            <div class="address-block">
                                                <label for="login">Login</label>
                                                <input type="text" class="address-input" value="${user.login}"><br>
                                                <label for="email">Email</label>
                                                <input type="text" class="address-input" value="${user.email}"><br>
                                                <label for="username">Username</label>
                                                <input type="text" class="address-input" value="${user.username}"><br>
                                                <label for="role">Role</label>
                                                <input type="text" class="address-input" value="${user.role}" disabled><br>
                                                <label for="Printshop">Printshop</label>
                                                <input type="text" class="address-input" value="${user.printshop}" disabled><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details-info details-info2">
                                        <div class="contractors-container">
                                            <h5 class="titreContract" style="margin-left: 13%;">Contractors</h5>
                                        </div>
                                        <div class="button-group3">
                                            ${user.contractors.map(contractor => `<button class="custom-button">
                                                <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">
                                                &nbsp;${contractor}
                                            </button>`).join('')}
                                        </div>
                                        <div class="contractors-container">
                                            <h5 class="titreContract" style="margin-left: 13%;">Service</h5>
                                        </div>
                                        <div class="button-group3" style="flex-wrap: wrap;">
                                            ${user.services.map(service => `<button class="custom-button">
                                                <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">
                                                &nbsp;${service}
                                            </button>`).join('')}
                                        </div>
                                        <div class="contractors-container">
                                            <h5 class="titreContract" style="margin-left: 13%;">Currency</h5>
                                        </div>
                                        <div class="button-group3">
                                            ${user.currencies.map(currency => `<button class="custom-button">
                                                <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">
                                                &nbsp;${currency}
                                            </button>`).join('')}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `;
                    $('#dashboard-content tbody').append(rowHtml);
                });
            }
        });
    }
});

});

$(document).ready(function() {
    // Trigger advanced search when clicking the search button
    $('.btn-Recher').on('click', function() {
        // Collect input values from the advanced search fields
        var id = $('input[placeholder="ID"]').val();
        var login = $('input[placeholder="login"]').val();
        var userName = $('input[placeholder="user name"]').val();
        var contractorId = $('#contractors').val();
        var serviceId = $('#services').val();

        // Send AJAX request to perform the advanced search
        $.ajax({
            type: 'POST',
            url: 'search_users_advanced.php',  // PHP file that handles the search
            data: {
                id: id,
                login: login,
                user_name: userName,
                contractor_id: contractorId,
                service_id: serviceId
            },
            dataType: 'json',
            success: function(data) {
                $('#dashboard-content tbody').html('');  // Clear current table content

                // Check for any errors in the response
                if (data.error) {
                    alert('Erreur: ' + data.error);
                    return;
                }

                // Populate table with search results
                $.each(data.results, function(index, user) {
                    var rowHtml = `
                        <tr class="main-row ${index % 2 === 0 ? 'even-row' : 'odd-row'}" onclick="toggleDetails(this)">
                            <td style="text-align: left;">
                                <button class="icon <?= $btnClass ?>">
                                    <img src="Image/OfVert1.png" alt="Icon" style="width: 12px; height: 11px;">
                                </button>
                                ${user.id}
                            </td>
                            <td>${user.login}</td>
                            <td>*********************</td>
                            <td>${user.company}</td>
                            <td>
                                <span class="state2 ${user.role.toLowerCase().replace(/\s+/g, '-')}">${user.role.toLowerCase()}</span>
                            </td>
                            <td>
                                <button class="btn-edit-user" 
                                    data-id="${user.id}"
                                    data-login="${user.login}"
                                    data-email="${user.email}"
                                    data-username="${user.username}"
                                    data-role="${user.roleid}"
                                    data-printshop="${user.printshopid}"
                                    data-contractors="${user.contractorsid}"
                                    data-services="${user.servicesid}"
                                    data-currencies="${user.currenciesid}">
                                    <i class="bi bi-pencil-square"></i>&nbsp;Edit
                                </button>
                                <button class="btn-delete-user" data-id="${user.id}">
                                    <i class="bi bi-trash3"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <tr class="main-row2 ${index % 2 === 0 ? 'even-row' : 'odd-row'}" style="display: none;">
                            <td colspan="6">
                                <div class="details-container">
                                    <div class="details-info details-info1">
                                        <h5 class="titreGI">General informations</h5>
                                        <div class="address-section">
                                            <div class="address-block">
                                                <label for="login">Login</label>
                                                <input type="text" class="address-input" value="${user.login}"><br>
                                                <label for="email">Email</label>
                                                <input type="text" class="address-input" value="${user.email}"><br>
                                                <label for="username">Username</label>
                                                <input type="text" class="address-input" value="${user.username}"><br>
                                                <label for="role">Role</label>
                                                <input type="text" class="address-input" value="${user.role}" disabled><br>
                                                <label for="Printshop">Printshop</label>
                                                <input type="text" class="address-input" value="${user.printshop}" disabled><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="details-info details-info2">
                                        <div class="contractors-container">
                                            <h5 class="titreContract" style="margin-left: 13%;">Contractors</h5>
                                        </div>
                                        <div class="button-group3">
                                            ${user.contractors.map(contractor => `<button class="custom-button">
                                                <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">
                                                &nbsp;${contractor}
                                            </button>`).join('')}
                                        </div>
                                        <div class="contractors-container">
                                            <h5 class="titreContract" style="margin-left: 13%;">Service</h5>
                                        </div>
                                        <div class="button-group3" style="flex-wrap: wrap;">
                                            ${user.services.map(service => `<button class="custom-button">
                                                <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">
                                                &nbsp;${service}
                                            </button>`).join('')}
                                        </div>
                                        <div class="contractors-container">
                                            <h5 class="titreContract" style="margin-left: 13%;">Currency</h5>
                                        </div>
                                        <div class="button-group3">
                                            ${user.currencies.map(currency => `<button class="custom-button">
                                                <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">
                                                &nbsp;${currency}
                                            </button>`).join('')}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    `;
                    $('#dashboard-content tbody').append(rowHtml);
                    
                });

                $('input[placeholder="ID"]').val('');
$('input[placeholder="login"]').val('');
$('input[placeholder="user name"]').val('');
$('#contractors').val('');
$('#services').val('');

                // Close the popup after the search completes
                closePopupAdSh();
            },
            error: function(xhr, status, error) {
                alert('Error fetching search results: ' + xhr.responseText + status + error);
            }
        });
    });
});


// Fonction pour trier les tableaux
function sortTableByColumn(table, columnIndex, ascending = true) {
    const tbody = table.tBodies[0]; // Obtenir le corps du tableau
    const rows = Array.from(tbody.querySelectorAll('tr')); // Obtenir toutes les lignes du tableau

    // Trier les lignes en fonction de la colonne sélectionnée
    const sortedRows = rows.sort((a, b) => {
        // Vérifier si la cellule existe et contient du texte
        const aCell = a.cells[columnIndex] ? a.cells[columnIndex].textContent.trim().toLowerCase() : "";
        const bCell = b.cells[columnIndex] ? b.cells[columnIndex].textContent.trim().toLowerCase() : "";

        // Comparer les valeurs, vides ou non
        return ascending ? aCell.localeCompare(bCell) : bCell.localeCompare(aCell);
    });

    // Remettre les lignes triées dans le tableau
    tbody.innerHTML = '';
    sortedRows.forEach(row => tbody.appendChild(row));
}

// Gestionnaire de clic pour le tri par colonne
function setupSorting() {
    const table = document.querySelector('.table1');
    
    // Tri de la colonne "Company"
    document.querySelector('#sortCompany').addEventListener('click', function() {
        const columnIndex = 3; // Index de la colonne "Company"
        const ascending = !this.classList.contains('asc'); // Inverser l'ordre de tri

        sortTableByColumn(table, columnIndex, ascending);

        // Mettre à jour les classes pour indiquer le sens du tri
        updateSortingIcons(this, ascending);
    });

    // Tri de la colonne "Role"
    document.querySelector('#sortRole').addEventListener('click', function() {
        const columnIndex = 4; // Index de la colonne "Role"
        const ascending = !this.classList.contains('asc'); // Inverser l'ordre de tri

        sortTableByColumn(table, columnIndex, ascending);

        // Mettre à jour les classes pour indiquer le sens du tri
        updateSortingIcons(this, ascending);
    });
}

// Mettre à jour l'icône de tri
function updateSortingIcons(headerElement, ascending) {
    const icon = headerElement.querySelector('i'); // Sélectionner l'icône dans l'en-tête
    if (ascending) {
        icon.classList.remove('bi-arrow-down');
        icon.classList.add('bi-arrow-up');
    } else {
        icon.classList.remove('bi-arrow-up');
        icon.classList.add('bi-arrow-down');
    }
    
    // Retirer la classe 'asc' de tous les autres en-têtes
    document.querySelectorAll('.entête th').forEach(th => th.classList.remove('asc'));
    
    // Ajouter la classe 'asc' à l'en-tête actuel
    headerElement.classList.add('asc');
}

// Initialiser le tri quand la page est prête
document.addEventListener('DOMContentLoaded', setupSorting);

function changeBackgroundColor(button) {
    button.style.backgroundColor = "gray";
}
// Fonction pour ouvrir la popup
function openPopupAdUser() {
    document.getElementById("userPopup").style.display = "flex";
}

// Fonction pour fermer la popup
function closePopupAdUser() {
    document.getElementById("userPopup").style.display = "none";
}
// Fonction pour ajouter le service sélectionné à la liste des services
function addServiceToList_add() {
    const serviceSelect = document.getElementById('service_select_add');
    const selectedServiceId = serviceSelect.options[serviceSelect.selectedIndex].value;
    const selectedServiceName = serviceSelect.options[serviceSelect.selectedIndex].text;
    const selectedServicesInput = document.getElementById('selected_services_add');

    // Crée un tableau avec les IDs sélectionnés en retirant les `{}` et les éléments vides
    let selectedServiceIds = selectedServicesInput.value.match(/\{(\d+)\}/g)?.map(id => id.replace(/[{}]/g, '')) || [];

    if (selectedServiceIds.includes(selectedServiceId)) {
        alert('Service already selected!');
        return;
    }

    // Ajouter l'ID avec les `{}` et mettre à jour le champ caché
    selectedServiceIds.push(selectedServiceId);
    selectedServicesInput.value = selectedServiceIds.map(id => `{${id}}`).join('');

    const servicesListDiv = document.getElementById('srv_add');
    const serviceButton = document.createElement('button');
    serviceButton.type = "button";
    serviceButton.className = 'custom-button';
    serviceButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp; ${selectedServiceName}`;

    // Gestionnaire de suppression pour le bouton de service
    serviceButton.addEventListener('click', () => {
        selectedServiceIds = selectedServiceIds.filter(id => id !== selectedServiceId);
        selectedServicesInput.value = selectedServiceIds.map(id => `{${id}}`).join('');
        servicesListDiv.removeChild(serviceButton);
    });

    servicesListDiv.appendChild(serviceButton);
    document.getElementById('popupSelectServ_add').style.display = 'none';
}

function addContractorToList_add() {
    const contractorSelect = document.getElementById('contractor_select_add');
    const selectedContractorId = contractorSelect.options[contractorSelect.selectedIndex].value;
    const selectedContractorName = contractorSelect.options[contractorSelect.selectedIndex].text;
    const selectedContractorsInput = document.getElementById('selected_contractors_add');

    let selectedContractorIds = selectedContractorsInput.value.match(/\{(\d+)\}/g)?.map(id => id.replace(/[{}]/g, '')) || [];

    if (selectedContractorIds.includes(selectedContractorId)) {
        alert('Contractor already selected!');
        return;
    }

    selectedContractorIds.push(selectedContractorId);
    selectedContractorsInput.value = selectedContractorIds.map(id => `{${id}}`).join('');

    const contractorsListDiv = document.getElementById('CTR_add');
    const contractorButton = document.createElement('button');
    contractorButton.type = "button";
    contractorButton.className = 'custom-button';
    contractorButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp; ${selectedContractorName}`;

    contractorButton.addEventListener('click', () => {
        selectedContractorIds = selectedContractorIds.filter(id => id !== selectedContractorId);
        selectedContractorsInput.value = selectedContractorIds.map(id => `{${id}}`).join('');
        contractorsListDiv.removeChild(contractorButton);
    });

    contractorsListDiv.appendChild(contractorButton);
    document.getElementById('popupSelectCon_add').style.display = 'none';
}

function addCurrencyToList_add() {
    const currencySelect = document.getElementById('currency_select_add');
    const selectedCurrencyId = currencySelect.options[currencySelect.selectedIndex].value;
    const selectedCurrencyName = currencySelect.options[currencySelect.selectedIndex].text;
    const selectedCurrencyInput = document.getElementById('selected_currency_add');

    let selectedCurrencyIds = selectedCurrencyInput.value.match(/\{(\d+)\}/g)?.map(id => id.replace(/[{}]/g, '')) || [];

    if (selectedCurrencyIds.includes(selectedCurrencyId)) {
        alert('Currency already selected!');
        return;
    }

    selectedCurrencyIds.push(selectedCurrencyId);
    selectedCurrencyInput.value = selectedCurrencyIds.map(id => `{${id}}`).join('');

    const currencyListDiv = document.getElementById('CRN_add');
    const currencyButton = document.createElement('button');
    currencyButton.type = "button";
    currencyButton.className = 'custom-button';
    currencyButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp; ${selectedCurrencyName}`;

    currencyButton.addEventListener('click', () => {
        selectedCurrencyIds = selectedCurrencyIds.filter(id => id !== selectedCurrencyId);
        selectedCurrencyInput.value = selectedCurrencyIds.map(id => `{${id}}`).join('');
        currencyListDiv.removeChild(currencyButton);
    });

    currencyListDiv.appendChild(currencyButton);
    document.getElementById('popupSelectCurr_add').style.display = 'none';
}
function fetchServices(prefix) {
    const servicesDropdown = document.getElementById('services');
    
    // Clear previous options
    servicesDropdown.innerHTML = '<option value="" disabled selected>Loading...</option>';

    // Fetch services via AJAX
    fetch(`fetch_services.php?prefix_contractor=${prefix}`)
        .then(response => response.json())
        .then(data => {
            // Clear and populate the dropdown with new options
            servicesDropdown.innerHTML = '<option value="" disabled selected>Select a service</option>';
            data.forEach(service => {
                const option = document.createElement('option');
                option.value = service.id;
                option.textContent = service.name;
                servicesDropdown.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching services:', error);
            servicesDropdown.innerHTML = '<option value="" disabled selected>Error loading services</option>';
        });
}

function formatString(input) {
    // Utiliser une expression régulière pour extraire les nombres entre les accolades
    const matches = input.match(/\{(\d+)\}/g);

    if (!matches) {
        return ''; // Retourner une chaîne vide si aucun nombre n'est trouvé
    }

    // Extraire les nombres, les trier, et les joindre avec des virgules
    const numbers = matches.map(match => match.replace(/\{|\}/g, '')); // Retirer les accolades
    return numbers.sort((a, b) => a - b).join(',');
}
function addServiceToList() {
    const serviceSelect = document.getElementById('service_select');
    const selectedServiceId = serviceSelect.options[serviceSelect.selectedIndex].value;
    const selectedServiceName = serviceSelect.options[serviceSelect.selectedIndex].text;
    const selectedServicesInput = document.getElementById('selected_services');
    const servicesListDiv = document.getElementById('srv');

    const regex = new RegExp(`\\{${selectedServiceId}\\}`);
    if (regex.test(selectedServicesInput.value)) {
        alert('Service already selected!');
        return;
    }

    selectedServicesInput.value += "{" + selectedServiceId + "}";
    const serviceButton = document.createElement('button');
    serviceButton.type = "button";
    serviceButton.className = 'custom-button';
    serviceButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp; ${selectedServiceName}`;

    // Gestionnaire de suppression pour le bouton de service
    serviceButton.addEventListener('click', () => {
        const updatedServices = selectedServicesInput.value.replace(`{${selectedServiceId}}`, '').replace(/}{+/g, '}{').replace(/^\{\}|\{\}$/g, '');
        selectedServicesInput.value = updatedServices;
        servicesListDiv.removeChild(serviceButton);
    });

    servicesListDiv.appendChild(serviceButton);
    document.getElementById('popupSelectServ').style.display = 'none';
}

function addContractorToList() {
    const contractorSelect = document.getElementById('contractor_select');
    const selectedContractorId = contractorSelect.options[contractorSelect.selectedIndex].value;
    const selectedContractorName = contractorSelect.options[contractorSelect.selectedIndex].text;
    const selectedContractorsInput = document.getElementById('selected_contractors');
    const contractorsListDiv = document.getElementById('CTR');

    const regex = new RegExp(`\\{${selectedContractorId}\\}`);
    if (regex.test(selectedContractorsInput.value)) {
        alert('Contractor already selected!');
        return;
    }

    selectedContractorsInput.value += "{" + selectedContractorId + "}";
    const contractorButton = document.createElement('button');
    contractorButton.type = "button";
    contractorButton.className = 'custom-button';
    contractorButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp; ${selectedContractorName}`;

    // Gestionnaire de suppression pour le bouton de contractor
    contractorButton.addEventListener('click', () => {
        const updatedContractors = selectedContractorsInput.value.replace(`{${selectedContractorId}}`, '').replace(/}{+/g, '}{').replace(/^\{\}|\{\}$/g, '');
        selectedContractorsInput.value = updatedContractors;
        contractorsListDiv.removeChild(contractorButton);
    });

    contractorsListDiv.appendChild(contractorButton);
    document.getElementById('popupSelectCon').style.display = 'none';
}


function addCurrencyToList() {
    const currencySelect = document.getElementById('currency_select');
    const selectedCurrencyId = currencySelect.options[currencySelect.selectedIndex].value;
    const selectedCurrencyName = currencySelect.options[currencySelect.selectedIndex].text;
    const selectedCurrencyInput = document.getElementById('selected_currency');
    const currencyListDiv = document.getElementById('CRN');

    const regex = new RegExp(`\\{${selectedCurrencyId}\\}`);
    if (regex.test(selectedCurrencyInput.value)) {
        alert('Currency already selected!');
        return;
    }

    selectedCurrencyInput.value += "{" + selectedCurrencyId + "}";
    const currencyButton = document.createElement('button');
    currencyButton.type = "button";
    currencyButton.className = 'custom-button';
    currencyButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp; ${selectedCurrencyName}`;

    // Gestionnaire de suppression pour le bouton de currency
    currencyButton.addEventListener('click', () => {
        const updatedCurrencies = selectedCurrencyInput.value.replace(`{${selectedCurrencyId}}`, '').replace(/}{+/g, '}{').replace(/^\{\}|\{\}$/g, '');
        selectedCurrencyInput.value = updatedCurrencies;
        currencyListDiv.removeChild(currencyButton);
    });

    currencyListDiv.appendChild(currencyButton);
    document.getElementById('popupSelectCurr').style.display = 'none';
}


$(document).ready(function() {
   // Ouvrir le popup et insérer l'ID utilisateur dans le champ caché
   $('[id="AddContact"]').on('click', function() {
        var userId = $(this).data('id');  // Récupérer l'ID utilisateur depuis l'attribut data-id
        $('#id_user').val(userId);  // Insérer l'ID dans le champ caché du formulaire
        
        
    });

});

$(document).ready(function() {
    // Ouvrir le popup pour ajouter une adresse et insérer l'ID utilisateur dans le champ caché
    $('[id="AddAdress"]').on('click', function() {
        var userId = $(this).data('id');  // Récupérer l'ID utilisateur
        $('#id_user_address').val(userId);  // Insérer l'ID dans le champ caché

      
    });

    // Fermer le popup (optionnel)
   
});


// vider les input cacher qui stock les id selectionner apres la creation 
/*   
ne pas uliser 
faut voir avec henda et karim si on  peut utiliser AJAX pour gérer la soumission du formulaire et vider les champs une fois terminé.
// vider les input cacher qui stock les id selectionner apres la creation 
document.getElementById('userForm').addEventListener('submit', function(event) {
        // Après la soumission, on vide les champs cachés
        document.getElementById('selected_services').value = '';
        document.getElementById('selected_contractors').value = '';
        document.getElementById('selected_currency').value = '';

        // faut voir avec henda et karim si on  peut utiliser AJAX pour gérer la soumission du formulaire et vider les champs une fois terminé.
    });*/
    $(document).ready(function() {
    // Intercepter la soumission du formulaire d'adresse
    $('#addressForm').on('submit', function(e) {
        e.preventDefault();  // Empêcher la soumission normale

        // Récupérer les données du formulaire
        var formData = $(this).serialize();

        // Envoyer les données via AJAX
        $.ajax({
            type: 'POST',
            url: 'add_address.php',
            data: formData,
            success: function(response) {
                alert('Adresse ajoutée avec succès !');
                $('#addressForm')[0].reset();  // Réinitialiser le formulaire
                $('#Addadress').hide();  // Fermer le popup
            },
            error: function(xhr, status, error) {
                alert('Erreur lors de l\'ajout de l\'adresse : ' + error);
            }
        });
    });
});

    $(document).ready(function() {
    // Intercepter la soumission du formulaire
    $('#userForm').on('submit', function(e) {
        e.preventDefault(); // Empêcher la soumission normale

        // Récupérer les données du formulaire
        var formData = $(this).serialize();

        // Envoyer les données via AJAX
        $.ajax({
            type: 'POST',
            url: 'add_user.php',
            data: formData,
            success: function(response) {
                // Afficher le message de succès
                alert('Utilisateur ajouté avec succès !');

                // Vider les champs cachés
                $('#selected_services_add').val('');
                $('#selected_contractors_add').val('');
                $('#selected_currency_add').val('');

                // Facultatif : Réinitialiser d'autres champs du formulaire
                $('#userForm')[0].reset();
                $('#srv_add').empty();  // Vider la div des services
                    $('#CTR_add').empty();  // Vider la div des contractors
                    $('#CRN_add').empty();  // Vider la div des currencies

                // Fermer la popup (optionnel)
                closePopupAdUser();
            },
            error: function(xhr, status, error) {
                // Afficher le message d'erreur
                alert('Erreur lors de l\'ajout de l\'utilisateur : ' + error);
            }
        });
    });


    //Ouvrir le popup et pré-remplir les champs avec les informations du contact
});$(document).ready(function() {
    // Lorsque le bouton Edit est cliqué
    $(document).on('click', '.btn-edit-user', function() {
        // Récupérer les informations du contact depuis les attributs data
        var contactId = $(this).data('id');
        var login = $(this).data('login');
        var firstName = $(this).data('firstname');
        var email = $(this).data('email');
        var role = $(this).data('role');
        
        // Remplir les champs du formulaire avec les données récupérées
        $('#Editcontact input[name="login"]').val(login);
        $('#Editcontact input[name="contact_name"]').val(firstName);
        $('#Editcontact input[name="contact_email"]').val(email);
        $('#Editcontact input[name="role"]').val(role);
        
        // Associer l'ID du contact au formulaire pour la mise à jour
        $('#Editcontact').data('contact-id', contactId);
        
      
    });
    
  
});

//Mettre à jour les informations du contact via AJAX
$(document).ready(function() {
    // Intercepter la soumission du formulaire d'édition de contact
    $('#Editcontact form').on('submit', function(e) {
        e.preventDefault();  // Empêche la soumission normale

        // Récupérer les données du formulaire
        var formData = $(this).serialize();
        var contactId = $('#Editcontact').data('contact-id');  // Récupérer l'ID du contact

        // Ajouter l'ID du contact aux données du formulaire
        formData += '&id=' + contactId;

        // Envoyer les données via AJAX
        $.ajax({
            type: 'POST',
            url: 'update_contact.php',  // Le script PHP pour la mise à jour
            data: formData,
            success: function(response) {
                alert('Contact mis à jour avec succès !');
                location.reload();  // Rafraîchir la page pour voir les modifications
            },
            error: function(xhr, status, error) {
                alert('Erreur lors de la mise à jour du contact : ' + error);
            }
        });
    });
});

//pour pré-remplir le edit user 
// Fonction pour ouvrir la popup et pré-remplir le formulaire
function openEditUserPopup(button) {
    const userId = button.getAttribute('data-id');
    const login = button.getAttribute('data-login');
    const email = button.getAttribute('data-email');
    const username = button.getAttribute('data-username');
    const role = button.getAttribute('data-role');
    const printshop = button.getAttribute('data-printshop');

    const contractors = button.getAttribute('data-contractors') || "{99}"; // Ajout d'une valeur par défaut vide
    const services = button.getAttribute('data-services') || "{99}";       // Ajout d'une valeur par défaut vide
    const currencies = button.getAttribute('data-currencies') || "{99}";   // Ajout d'une valeur par défaut vide

    document.getElementById('userId').value = userId;
    document.getElementById('editLogin').value = login;
    document.getElementById('editEmail').value = email;
    document.getElementById('editUsername').value = username;
    document.getElementById('editRole').value = role;
    document.getElementById('editPrintshop').value = printshop;

    document.getElementById('selected_contractors').value = contractors;
    document.getElementById('selected_currency').value = currencies;
    document.getElementById('selected_services').value = services;

    // Vérifie que `contractors` n'est pas vide avant de lancer la requête AJAX
    if (contractors) {
        const contractorsIds = contractors.replace(/}{/g, ',').replace(/[{}]/g, '').split(',').map(id => id.trim());
        const contractorsContainer = document.getElementById('CTR');
        contractorsContainer.innerHTML = '';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_contractors.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                
                let updatedContractorsIds = contractorsIds.slice();
                updatedContractorsIds.forEach(id => {
                    const contractorName = response[id] || "Unknown";
                    const contractorButton = document.createElement('button');
                    contractorButton.classList.add('custom-button');
                    contractorButton.type = "button";
                    contractorButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;${contractorName}`;
                    
                    contractorButton.addEventListener('click', () => {
                        updatedContractorsIds = updatedContractorsIds.filter(itemId => itemId !== id);
                        document.getElementById('selected_contractors').value = updatedContractorsIds.length > 0
                            ? `{${updatedContractorsIds.join('}{')}}`
                            : "";
                        contractorsContainer.removeChild(contractorButton);
                    });

                    contractorsContainer.appendChild(contractorButton);
                });
            }
        };
        xhr.send('contractorsIds=' + contractors);
    }

    // Vérifie que `services` n'est pas vide avant de lancer la requête AJAX
    if (services) {
        const servicesIds = services.replace(/}{/g, ',').replace(/[{}]/g, '').split(',').map(id => id.trim());
        const servicesContainer = document.getElementById('srv');
        servicesContainer.innerHTML = '';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_services.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                let updatedServicesIds = servicesIds.slice();
                updatedServicesIds.forEach(id => {
                    const serviceName = response[id] || "Unknown";
                    const serviceButton = document.createElement('button');
                    serviceButton.classList.add('custom-button');
                    serviceButton.type = "button";
                    serviceButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;${serviceName}`;

                    serviceButton.addEventListener('click', () => {
                        updatedServicesIds = updatedServicesIds.filter(itemId => itemId !== id);
                        document.getElementById('selected_services').value = updatedServicesIds.length > 0
                            ? `{${updatedServicesIds.join('}{')}}`
                            : "";
                        servicesContainer.removeChild(serviceButton);
                    });

                    servicesContainer.appendChild(serviceButton);
                });
            }
        };
        xhr.send('servicesIds=' + services);
    }

    // Vérifie que `currencies` n'est pas vide avant de lancer la requête AJAX
    if (currencies) {
        const currenciesIds = currencies.replace(/}{/g, ',').replace(/[{}]/g, '').split(',').map(id => id.trim());
        const currenciesContainer = document.getElementById('CRN');
        currenciesContainer.innerHTML = '';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_currencies.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                let updatedCurrenciesIds = currenciesIds.slice();
                updatedCurrenciesIds.forEach(id => {
                    const currencyName = response[id] || "Unknown";
                    const currencyButton = document.createElement('button');
                    currencyButton.classList.add('custom-button');
                    currencyButton.type = "button";
                    currencyButton.innerHTML = `<img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;${currencyName}`;

                    currencyButton.addEventListener('click', () => {
                        updatedCurrenciesIds = updatedCurrenciesIds.filter(itemId => itemId !== id);
                        document.getElementById('selected_currency').value = updatedCurrenciesIds.length > 0
                            ? `{${updatedCurrenciesIds.join('}{')}}`
                            : "";
                        currenciesContainer.removeChild(currencyButton);
                    });

                    currenciesContainer.appendChild(currencyButton);
                });
            }
        };
        xhr.send('currenciesIds=' + currencies);
    }
}

$(document).ready(function() {
    // Ouvrir la popup d'édition avec les données de l'adresse
    $('.btn-edit-user').on('click', function() {
        var button = $(this);

        // Récupérer les données depuis les attributs data-*
        var addressId = button.data('address-id');
        var addressName = button.data('address-name');
        var codeSupplier = button.data('code-supplier');
        var companyName = button.data('company-name');
        var country = button.data('country');
        var contact = button.data('contact');
        var telephone = button.data('telephone');
        var address1 = button.data('address1');
        var address2 = button.data('address2');
        var zip = button.data('zip');
        var city = button.data('city');
        var region = button.data('devise');

        // Remplir les champs du formulaire avec ces valeurs
        $('#addressId').val(addressId);
        $('#address_name').val(addressName);
        $('#supplier_code').val(codeSupplier);
        $('#company_name').val(companyName);
        $('#country').val(country);
        $('#contact').val(contact);
        $('#telephone').val(telephone);
        $('#address_1').val(address1);
        $('#address_2').val(address2);
        $('#zip').val(zip);
        $('#city').val(city);
        $('#region').val(region);
    });

  // Envoi du formulaire d'édition via AJAX
  $('#editAddressForm').on('submit', function(e) {
        e.preventDefault();

        // Récupérer les données du formulaire
        var formData = $(this).serialize();

        // Afficher les données envoyées pour le débogage
        console.log("Données envoyées : " + formData);

        
        // Envoyer les données via AJAX
        $.ajax({
            type: 'POST',
            url: 'update_adress.php',  // Le script PHP pour la mise à jour
            data: formData,
            success: function(response) {
                console.log("Réponse du serveur : " + response);
                // Traiter la réponse JSON
                var data = JSON.parse(response);
                if (data.status === 'success') {
                    alert('Address updated successfully!');
                    location.reload();  // Rafraîchir la page pour voir les modifications
                } else {
                    alert('Error updating address: ' + data.message);  // Afficher l'erreur
                }
            },
            error: function(xhr, status, error) {
                // Afficher l'erreur AJAX (problème avec la requête elle-même)
                console.error("Erreur AJAX : " + error + ' (' + status + ')');
                alert('Error updating address: ' + error + ' (' + status + ')');
            }
        });
    });

   
});

//delete user 
$(document).ready(function() {
    var addressIdToDelete; // Variable pour stocker l'ID de l'adresse à supprimer

    // Lorsque l'utilisateur clique sur le bouton de suppression
    $('.btn-delete-user').on('click', function() {
        addressIdToDelete = $(this).data('address-id'); // Récupérer l'ID de l'adresse
    });

    // Confirmer et envoyer la requête AJAX pour supprimer l'adresse
    $('#delete_add').on('click', function() {
        if (addressIdToDelete) {
            $.ajax({
                type: 'POST',
                url: 'delete_adress.php', // Script PHP pour gérer la suppression
                data: { id: addressIdToDelete }, // Envoyer l'ID de l'adresse à supprimer
                success: function(response) {
                    // Vérifiez si la suppression a réussi
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('Address deleted successfully!');
                        location.reload(); // Rafraîchir la page pour voir les changements
                    } else {
                        alert('Error deleting address: ' + data.message); // Afficher le message d'erreur
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting address: ' + error); // Afficher l'erreur AJAX
                }
            });
        }
    });
});

//delete contact 
$(document).ready(function() {
    var contactIdToDelete; // Variable pour stocker l'ID du contact à supprimer

    // Lorsque l'utilisateur clique sur le bouton de suppression de contact
    $('.btn-delete-user').on('click', function() {
        contactIdToDelete = $(this).data('id'); // Récupérer l'ID du contact
    });

    // Confirmer et envoyer la requête AJAX pour supprimer le contact
    $('#delete_con').on('click', function() {
        if (contactIdToDelete) {
            $.ajax({
                type: 'POST',
                url: 'delete_contact.php', // Script PHP pour gérer la suppression de contact
                data: { id: contactIdToDelete }, // Envoyer l'ID du contact à supprimer
                success: function(response) {
                    // Vérifiez si la suppression a réussi
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('Contact deleted successfully!');
                        location.reload(); // Rafraîchir la page pour voir les changements
                    } else {
                        alert('Error deleting contact: ' + data.message); // Afficher le message d'erreur
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting contact: ' + error); // Afficher l'erreur AJAX
                }
            });
        }
    });
});

//
///
////delete user
$(document).ready(function() {
    var userIdToDelete; // Variable pour stocker l'ID de l'utilisateur à supprimer

    // Lorsque l'utilisateur clique sur le bouton de suppression d'utilisateur
    $('.btn-delete-user').on('click', function() {
        userIdToDelete = $(this).data('id'); // Récupérer l'ID de l'utilisateur
    });



    // Confirmer et envoyer la requête AJAX pour supprimer l'utilisateur
    $('#delete_user').on('click', function() {
        if (userIdToDelete) {
            $.ajax({
                type: 'POST',
                url: 'delete_user.php', // Script PHP pour gérer la suppression d'utilisateur
                data: { id: userIdToDelete }, // Envoyer l'ID de l'utilisateur à supprimer
                success: function(response) {
                    // Vérifiez si la suppression a réussi
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('User deleted successfully!');
                        location.reload(); // Rafraîchir la page pour voir les changements
                    } else {
                        alert('Error deleting user: ' + data.message); // Afficher le message d'erreur
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting user: ' + error); // Afficher l'erreur AJAX
                }
            });
        }
        $('#deleteuser').hide(); // Cacher la popup après la suppression
    });
});

function changeRowsPerPage() {
    const rows = document.getElementById('rows').value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('rows', rows);
    urlParams.set('page', 1); // Retourner à la première page lors du changement
    window.location.search = urlParams.toString();
}
</script>


<div class="footer">
    <div class="pagination">
        <div class="table-controls">
            <label for="rows">Show</label>
            <select id="rows" name="rows" onchange="changeRowsPerPage()">
                <option value="15" <?= ($rowsPerPage == 15) ? 'selected' : '' ?>>15</option>
                <option value="30" <?= ($rowsPerPage == 30) ? 'selected' : '' ?>>30</option>
                <option value="50" <?= ($rowsPerPage == 50) ? 'selected' : '' ?>>50</option>
            </select>
            <span>rows</span>
        </div>

        <div class="page-links">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>&rows=<?= $rowsPerPage ?>" class="page-link0"> < Previous</a>
            <?php endif; ?>

            <?php
            // Limiter l'affichage des pages
            $maxVisibleLinks = 5;
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);

            if ($startPage > 1) {
                echo '<a href="?page=1&rows=' . $rowsPerPage . '" class="page-link">1</a>';
                if ($startPage > 2) {
                    echo '<span class="dots">...</span>';
                }
            }

            for ($page = $startPage; $page <= $endPage; $page++): ?>
                <a href="?page=<?= $page ?>&rows=<?= $rowsPerPage ?>" class="page-link <?= ($page == $currentPage) ? 'active' : '' ?>"><?= $page ?></a>
            <?php endfor;

            if ($endPage < $totalPages) {
                if ($endPage < $totalPages - 1) {
                    echo '<span class="dots">...</span>';
                }
                echo '<a href="?page=' . $totalPages . '&rows=' . $rowsPerPage . '" class="page-link">' . $totalPages . '</a>';
            }
            ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>&rows=<?= $rowsPerPage ?>" class="page-link0">
    Next <img src="images/icones/arrow-forward.svg" alt="Next" style=" width: 16px; height: 16px; vertical-align: middle;">
</a>            <?php endif; ?>
        </div>
    </div>
</div>
