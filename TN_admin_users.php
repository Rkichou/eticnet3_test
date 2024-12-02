
<link rel="stylesheet" href="css/PS_dashboard_dup.css">
    <style>

	</style>
        <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
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
                <th>ID</span></th>
                <th>Login <i class="bi bi-arrow-down"></i></th>
                <th>Company<i class="bi bi-arrow-down"></i></th>
				<th>Rôle<i class="bi bi-arrow-down"></i></th>
				<th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php 
   include('config.inc.php');

   // Requête pour récupérer les informations de tous les utilisateurs
   $userQuery = "SELECT * FROM users";
   $userResult = mysqli_query($con, $userQuery);
   
   
   

   foreach ($userResult as $index => $row) {
       $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
       $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
       ?>
       <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
           <td>
               <button class="icon <?= $btnClass ?>"  >
                      <img src="Image/OfVert1.png" alt="Icon" style="width: 12px; height: 11px;">
                     </button>
                   <?= $row['id'] ?>
           </td>
           <td><?= $row['login'] ?></td>
           
           
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
                <button class="btn-edit-user" id="EditUser" onclick="event.stopPropagation();">
                    <i class="bi bi-pencil-square"></i>&nbsp;Edit
                </button>
                <button class="btn-delete-user" id="DeleteUser" onclick="event.stopPropagation();">
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
                <input type="text" class="address-input" placeholder="@Log-in" value="<?= htmlspecialchars($row['login'], ENT_QUOTES) ?>" readonly><br>
				<label for="pwd">Password</label>
                <input type="text" class="address-input" placeholder="*********************" value="*********************" readonly><br>
				<label for="email">Email</label>
                <input type="text" class="address-input" placeholder="adress@email.com" value="<?= htmlspecialchars($row['user_email'], ENT_QUOTES) ?>" readonly><br>
				<label for="username">Username</label>
                <input type="text" class="address-input" placeholder="USER_NAME" value="<?= htmlspecialchars($row['user_name'], ENT_QUOTES) ?>" readonly><br>
				
				
				
                <?php
//  rôle actuel de l'utilisateur
$currentRoleId = $row['role'];

// Requête pour récupérer le nom du rôle actuel à partir de son ID
$currentRoleQuery = "SELECT * FROM roles WHERE id = '$currentRoleId'"; // Vérifie que tu utilises la bonne variable dynamique
$currentRoleResult = mysqli_query($con, $currentRoleQuery);

// Utiliser mysqli_fetch_assoc() pour un seul résultat
$currentRole = mysqli_fetch_assoc($currentRoleResult);
$rolesQuery = "SELECT * FROM roles WHERE id != '$currentRoleId'";
$rolesResult = mysqli_query($con, $rolesQuery); // Exécution de la requête
echo($cuRoleId);



?>

<label for="username">Role</label>
<input type="text" class="address-input" placeholder="role" value="<?= htmlspecialchars($currentRole['name'], ENT_QUOTES); ?>" readonly><br>
<!--<select>
    <!-- Affiche le rôle actuel de l'utilisateur comme première option 
    <option value="Role <?#= htmlspecialchars($currentRoleId); ?>"><?#= $currentRole['name'] ?></option>
                      <!-- Affiche les autres rôles disponibles 
    <?php #while ($role = mysqli_fetch_assoc($rolesResult)): ?>
        <option value="<?#= htmlspecialchars($role['id']); ?>">
            <?#= htmlspecialchars($role['name']); ?>
        </option>
    <?php #endwhile; ?> 
    
   
                </select>-->

				
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
<input type="text" class="address-input" placeholder="role" value="<?= htmlspecialchars($currentRole['name'], ENT_QUOTES); ?>" readonly><br>

<!--<select>
     Affiche le rôle actuel de l'utilisateur comme première option 
    <option value="printshop <?#= htmlspecialchars($currentRoleId); ?>"><?#= $currentRole['name'] ?></option>
                      <!-- Affiche les autres rôles disponibles 
    <?php #while ($role = mysqli_fetch_assoc($rolesResult)): ?>
        <option value="<?#= htmlspecialchars($role['id']); ?>">
            <?#= htmlspecialchars($role['name']); ?>
        </option>
    <?php #endwhile; ?>
    
   
                </select>-->
				
	
				
				
				  
            </div>
			
        </div>

            </div>

           
            <div class="details-info details-info2">
			<!-- Contact part -->
			<div class="contractors-container">
                <h5 class="titreGI">Contact</h5>
				<button class="custom-button3" id="AddContact">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                 </button>
			</div>	
            <div class="address-section">
            <div class="address-block">

				<table class="styled-table">
      <thead>
        <tr>
            <th>Name</th>
            <th>1st name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
                        // Requête pour récupérer les contacts de l'utilisateur
                        $contactsQuery = "SELECT * FROM users_contacts WHERE id_user = " . $row['id'];
                        $contactsResult = mysqli_query($con, $contactsQuery);
                        while ($contact = mysqli_fetch_assoc($contactsResult)): ?>
                        <tr>
                            
                            <td><?php echo $contact['login']; ?></td>
                            <td><?php echo $contact['login']; ?></td>
                            <td><?php echo $contact['contact_name']; ?></td>
                            <td><?php echo $contact['contact_email']; ?></td>
                            <td>
                            <button class="btn-edit-user" id="EditContact">
                            <i class="bi bi-pencil-square"></i>
                            <button class="btn-delete-user" id="DeleteContact">
				            <i class="bi bi-trash3"></i>
				            </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
        <!-- Répéter les lignes si nécessaire -->
    </tbody>
</table>
				
				
				 
            </div>
			
        </div>
            </div>

            <!-- Right section (Address table) -->
            <div class="details-info details-info3">
			<!-- Contact part -->
			<div class="contractors-container">
                <h5 class="titreGI">Adress</h5>
				<button class="custom-button3" id="AddAdress">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                 </button>
			</div>	
            <div class="address-section">
            <div class="address-block">

				<table class="styled-table">
      <thead>
        <tr>
            <th>Adresss name</th>
            <th>Supp code</th>
			<th>Company</th>
            <th>Country</th>
            <th>Contact</th>
			<th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
                        // Requête pour récupérer les adresses de l'utilisateur
                        $adressesQuery = "SELECT * FROM users_adresses WHERE id_user = " . $row['id'];
                        $adressesResult = mysqli_query($con, $adressesQuery);
                        while ($adress = mysqli_fetch_assoc($adressesResult)): ?>
                        <tr>
                            <td><?php echo $adress['adresse_name']; ?></td>
                            <td><?php echo $adress['code_supplier']; ?></td>
                            <td><?php echo $adress['company_name']; ?></td>
                            <td><?php echo $adress['country']; ?></td>
                            <td><?php echo $adress['contact']; ?></td>
                            <td><?php echo $adress['telephone']; ?></td>
                            <td>
                            <button class="btn-edit-user" id="EditAdress">
                            <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn-delete-user" id="DeleteAdress">
				            <i class="bi bi-trash3"></i>
				            </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
		
        <!-- Répéter les lignes si nécessaire -->
    </tbody>
</table>
				
				
				 
            </div>
			
        </div>
            </div>
        </div>
		
		
		<div class="details-container2">
		     <div class="details-info details-info1" >
			    <div class="address-section">
                  <div class="address-block">
				   <!-- Contractors part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Contractors</h5>
                  <button class="custom-button2" id="add_contractor_1">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
                </div>
				<div class="button-group">
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
				   </div>
				</div>	
			 </div>
			 <div class="details-info details-info1">
			    <div class="address-section">
                  <div class="address-block">
				  <!-- Service part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Service</h5>
                  <button class="custom-button2" id="add_serv">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
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
				   </div>
				</div>				 
			 
			 </div>
			 <div class="details-info details-info1">
			    <div class="address-section">
                  <div class="address-block">
				   <!-- Currency part -->
				<div class="contractors-container">
                  <h5 class="titreContract" >Currency</h5>
                  <button class="custom-button2" id="add_currency">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
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
		
    </td>
</tr>

		
		
		
    <?php } ?>
           </table> 
        </div> 	
</tbody>
<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <span class="popup-close"><i class="bi bi-x-lg" onclick="closePopupAdSh();"></i></span>
            <h2 class="popup-title">Advanced research</h2>

            <div class="popup-section">
                <h3 class="section-title">User informations</h3>
                <div class="input-group2">
                    <input type="text" placeholder="ID" class="input-field1">
                    <input type="text" placeholder="First name" class="input-field1">
					<input type="text" placeholder="Name" class="input-field1">
                    <div class="company-section" style="width: 223px; height: 32px">
				      <select>
                         <option value="company" disabled selected>Company</option>
                         <option value="company 1">Company 1</option>
                         <option value="company 1">Company 2</option>
                    <!-- Other options here -->
                       </select>
				    </div>
				    <div class="company-section" style="width: 223px; height: 32px">
				      <select>
                         <option value="company" disabled selected>Service</option>
                         <option value="company 1">Service 1</option>
                         <option value="company 1">Service 2</option>
                    <!-- Other options here -->
                       </select>
				    </div>
				
                </div>

            </div>

        

            <div class="Recher-button-container">
                <button class="btn-Recher"><i class="bi bi-search"></i> Search</button>
            </div>
        </div>
    </div> 
 <!-- popup delete user --> 
 <div id="deleteuser" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once a user has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
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
            <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
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
            <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>
 <!-- popup delete user --> 
 <div id="deleteuser" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once a user has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>
  <!-- popup Select Add service-->
	<div id="popupSelectServ" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add service</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search service</label>	
                <div class="company-section">
				<select>
                    <option value="service 1" >China</option>
                    <option value="service 2">Tunisie</option>
                   <option value="service 3">Portugal</option>
                    <!-- Other options here -->
                </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
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
				<select>
                    <option value="contractor 1" >China</option>
                    <option value="contractor 2">Tunisie</option>
                   <option value="contractor 3">Portugal</option>
                    <!-- Other options here -->
                </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div> 

 <!-- popup Select Add Service-->
	<div id="popupSelectCurr" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add currency</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search currency</label>	
                <div class="company-section">
				<select>
                    <option value="currency 1" >China</option>
                    <option value="currency 2">Tunisie</option>
                   <option value="currency 3">Portugal</option>
                    <!-- Other options here -->
                </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div> 

 <!-- popup Select Add Currency-->
	<div id="popupSelect" class="popupSelect2" style="display: none;">
        <div class="popupSelect2-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Add currency</h5>	
               <span class="popup-close2"><i class="bi bi-x-lg"></i></span>				
              
            </div>
                <label for="username">Search currency</label>	
                <div class="company-section">
				<select>
                    <option value="currency 1" >China</option>
                    <option value="currency 2">Tunisie</option>
                   <option value="currency 3">Portugal</option>
                    <!-- Other options here -->
                </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-admin"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>   


<!-- Popup Add User -->
<div id="userPopup" class="popupAdUser">
    <div class="popupAdUser-content">
        <span class="closeAdUser-btn" onclick="closePopupAdUser()">&times;</span>

        <!-- Titre et ID User -->
        <div class="headerPUser">
          <h5 class="titreGI">Add user</h5>
          <p class="user-id">ID user: 123</p>
         </div>

        <div class="popupAdUser-grid">
            <!-- Partie gauche - Informations générales -->
            <div class="left-section">
                <h5 class="titreGI">General informations</h5>
                
                    <label for="login">Login</label>
                <input type="text" class="address-input" placeholder="@Log-in"><br>
				<label for="pwd">Password</label>
                <input type="text" class="address-input" placeholder="*********************"><br>
				<label for="email">Email</label>
                <input type="text" class="address-input" placeholder="adress@email.com"><br>
				<label for="username">Username</label>
                <input type="text" class="address-input" placeholder="USER_NAME"><br>
				
				<div class="company-section">
				<label for="username">Role</label>				
				<select>
                    <option value="Role 1">Key Account Manager</option>
                    <option value="Role 2">Corporate</option>
					<option value="Role 3">Supplier</option>
                   <option value="Role 4">Printshop</option>
                    <!-- Other options here -->
                </select>
				</div>
				<label for="username">printshop</label>				
				<div class="company-section">
				<select>
                    <option value="printshop 1">China</option>
                    <option value="printshop 2">Tunisie</option>
					<option value="printshop 3">Egypt</option>
                   <option value="printshop 4">Portugal</option>
                    <!-- Other options here -->
                </select>
				</div>
            </div>

            <!-- Partie droite - Contractors, Service, Currency -->
            <div class="right-section">
                 <!-- Contractors part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Contractors</h5>
                  <button class="custom-button2" id="add_contractor_2">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
                </div>
				<div class="button-group">
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                         LEMAIRE
                     </button>
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                              DAMART
                     </button>
                      <button class="custom-button">
                         <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                          DIOR
                     </button>
                </div>

                <!-- Service part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Service</h5>
                  <button class="custom-button2" id="add_serv">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
                </div>
				<div class="button-group">
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                         Customer
                     </button>
                </div>

                <!-- Currency part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Currency</h5>
                  <button class="custom-button2" id="add_currency">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
                </div>
				<div class="button-group">
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                         CNT
                     </button>
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                              EURO
                     </button>
                      <button class="custom-button">
                         <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                          DOLLAR
                     </button>
                </div>
            </div>
        </div>

        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="button" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>
    </div>
</div>

<!-- Popup Edit User -->
<div id="userEditPopup" class="popupAdUser">
    <div class="popupAdUser-content">
        <span class="closeAdUser-btn">&times;</span>

        <!-- Titre et ID User -->
        <div class="headerPUser">
          <h5 class="titreGI">Edit user</h5>
          <p class="user-id">ID user: 123</p>
         </div>

        <div class="popupAdUser-grid">
            <!-- Partie gauche - Informations générales -->
            <div class="left-section">
                <h5 class="titreGI">General informations</h5>
                
                    <label for="login">Login</label>
                <input type="text" class="address-input" placeholder="@Log-in"><br>
				<label for="pwd">Password</label>
                <input type="text" class="address-input" placeholder="*********************"><br>
				<label for="email">Email</label>
                <input type="text" class="address-input" placeholder="adress@email.com"><br>
				<label for="username">Username</label>
                <input type="text" class="address-input" placeholder="USER_NAME"><br>
				
				<div class="company-section">
				<label for="username">Role</label>				
				<select>
                    <option value="Role 1">Key Account Manager</option>
                    <option value="Role 2">Corporate</option>
					<option value="Role 3">Supplier</option>
                   <option value="Role 4">Printshop</option>
                    <!-- Other options here -->
                </select>
				</div>
				<label for="username">printshop</label>				
				<div class="company-section">
				<select>
                    <option value="printshop 1">China</option>
                    <option value="printshop 2">Tunisie</option>
					<option value="printshop 3">Egypt</option>
                   <option value="printshop 4">Portugal</option>
                    <!-- Other options here -->
                </select>
				</div>
            </div>

            <!-- Partie droite - Contractors, Service, Currency -->
            <div class="right-section">
                 <!-- Contractors part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Contractors</h5>
                  <button class="custom-button2" id="add_contractor_3">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
                </div>
				<div class="button-group">
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                         LEMAIRE
                     </button>
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                              DAMART
                     </button>
                      <button class="custom-button">
                         <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                          DIOR
                     </button>
                </div>

                <!-- Service part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Service</h5>
                  <button class="custom-button2" id="add_serv">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
                </div>
				<div class="button-group">
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                         Customer
                     </button>
                </div>

                <!-- Currency part -->
				<div class="contractors-container">
                  <h5 class="titreContract">Currency</h5>
                  <button class="custom-button2" id="add_currency">
                    <img src="Image/cercCroixadd.png" alt="Icon" style="width: 15px; height: 14px;">&nbsp;Add
                   </button>
                </div>
				<div class="button-group">
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                         CNT
                     </button>
                     <button class="custom-button">
                        <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                              EURO
                     </button>
                      <button class="custom-button">
                         <img src="Image/cercCroix.png" alt="Icon" style="width: 15px; height: 14px;"> &nbsp
                          DOLLAR
                     </button>
                </div>
            </div>
        </div>

        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="button" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>
    </div>
</div>


<!-- popup Edit contact-->
     <div id="Editcontact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeEC"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Edit contact</h5>
          <p class="user-id">ID contact: 123</p>
         </div>
        <form>
		    <label for="first">1st Name</label>
            <input type="text" placeholder="first">
			
			<label for="last">Last name</label>
            <input type="text" placeholder="last">
			
			<label for="email">Email</label>
            <input type="text" placeholder="name@email.com">
			
			<label for="phone">Phone (optional)</label>
			<div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+216">+216</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
			
			<label for="pwd">Password</label>
            <input type="text" placeholder="******">
		
        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="button" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>        </form>
    </div>
</div>
  

<!-- popup Add contact-->
     <div id="Addcontact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeAC"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Add contact</h5>
          <p class="user-id">ID contact: 123</p>
         </div>
        <form>
		    <label for="first">1st Name</label>
            <input type="text" placeholder="first">
			
			<label for="last">Last name</label>
            <input type="text" placeholder="last">
			
			<label for="email">Email</label>
            <input type="text" placeholder="name@email.com">
			
			<label for="phone">Phone (optional)</label>
			<div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+216">+216</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
			
			<label for="pwd">Password</label>
            <input type="text" placeholder="******">
		
        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="button" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>        </form>
    </div>
</div>

<!-- popup Edit adress-->
     <div id="Editadress" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeEA"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Edit adress</h5>
          <p class="user-id">ID Adress: 123</p>
         </div>
        <form>
		    <label for="contact">Contact</label>
            <input type="text" placeholder="contact">
			
			<label for="supp_code">Supplier code</label>
            <input type="text" placeholder="supp_code">
			
			<label for="add_name">Adress name</label>
            <input type="text" placeholder="add_name">
			
			<label for="add_1">Adress 1</label>
            <input type="text" placeholder="add_1">
			
			<label for="add_2">Adress 2(optional)</label>
            <input type="text" placeholder="add_2">
			
			<div class="form-group">
                <label for="zip">ZIP code</label>
				
                <label for="city" style="margin-left: 21%;">City</label>
            </div>
			<div class="form-group">
                <input type="text" id="zip" placeholder="ZIP code">
				
                <input type="text" id="city" placeholder="City">
            </div>
		
			<label for="region">Region / Province (optional)</label>
            <input type="text" placeholder="tunisie">
		
		    <label for="country">Country</label>
            <input type="text" placeholder="country">
        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="button" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>        </form>
    </div>
</div>
<!-- popup Add adress-->
     <div id="Addadress" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeAA"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Add adress</h5>
          <p class="user-id">ID Adress: 123</p>
         </div>
        <form>
		    <label for="contact">Contact</label>
            <input type="text" placeholder="contact">
			
			<label for="supp_code">Supplier code</label>
            <input type="text" placeholder="supp_code">
			
			<label for="add_name">Adress name</label>
            <input type="text" placeholder="add_name">
			
			<label for="add_1">Adress 1</label>
            <input type="text" placeholder="add_1">
			
			<label for="add_2">Adress 2(optional)</label>
            <input type="text" placeholder="add_2">
			
			<div class="form-group">
                <label for="zip">ZIP code</label>
				
                <label for="city" style="margin-left: 21%;">City</label>
            </div>
			<div class="form-group">
                <input type="text" id="zip" placeholder="ZIP code">
				
                <input type="text" id="city" placeholder="City">
            </div>
		
			<label for="region">Region / Province (optional)</label>
            <input type="text" placeholder="tunisie">
		
		    <label for="country">Country</label>
            <input type="text" placeholder="country">
        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="button" class="saveUser-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>        </form>
    </div>
</div>


<script src="js/admin_users_dup.js"></script>

<script>


</script>


   
<div class="footer">

     <div class="pagination">
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows">
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
                <span>rows</span>
            </div>
        <a href="#" class="page-link0"> < Previous</a>
        <a href="#" class="page-link">1</a>
        <a href="#" class="page-link">2</a>
        <a href="#" class="page-link">3</a>
        <a href="#" class="page-link">4</a>
        <a href="#" class="page-link0">Next ></a>
    </div>
   
</div>

