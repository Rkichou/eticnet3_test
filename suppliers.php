<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/suppliers_dup.css">
</head>
<style>
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
    font-size: 28px;
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
    margin-bottom: 40px;
}

.popupS-content h4 {
    margin-top: 30px;
	font-weight: bold;
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
	margin-bottom: 7px;
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

.add-new-btn {
    background-color: transparent;
    border: none;
    color: #1D1D1B;
    cursor: pointer;
    padding: 8px 0;
    font-size: 14px;
    display: flex;
    align-items: center;
}

.createS-btn {
    background-color: #81C441;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    width: 75px;
	margin-left: 40%;
	
}
.Save-btn {
    background-color: #59A735;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    margin-top: 20px;
	margin-left: 80%;
	
}
.popupp {
    display: none;
    position: absolute;
    top: 8px; 
    left: 0; /* Align the popup to the right */
    background-color: #aaaaaa; 
    color: white; 
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    width: 255px; 
    font-family: Arial, sans-serif;
    font-size: 12px;
    text-align: left; 
    z-index: 1000;
    line-height: 1.2; /* Reduce the space between lines */
}

.info-button {
    border: none;
    background: none;
    padding: 0;
    position: relative;
}

.info-button:hover .popupp {
    display: block;
}

.popupp p {
    margin: 0; /* Remove margin to decrease space between lines */
}
.bi bi-copy {
    display: inline-block; /* Pour s'assurer que l'icône soit traitée comme un élément inline */
    text-align: right; /* Aligne le contenu à gauche */
    width: 100%; /* Prend toute la largeur disponible pour aligner à gauche */
}
.popupp p i {
    float: right; /* Aligne l'icône à gauche dans son conteneur */
    margin-right: 1px; /* Ajoute un petit espace après l'icône */
}


.deletePopup {
    display: none;
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

.deletePopup-content {
    background-color: #fff;
    padding: 16px 24px;
    border: 1px solid #888;
    width: 25%;
    border-radius: 20px;
	
}
.deletePopup-content h5 {
    margin-top: 0;
    font-size: 1.1em;
    font-weight: bold;
}

.deletePopup-content p {
    font-size: 0.9em;
    color: #666;
}

.deletePopup-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn-cancel {
    background-color: #AAAAAA;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
	font-size: 14px;
}

.btn-confirm-delete {
    background-color: #E31313;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
	font-size: 14px;
}

.deletePopup .btn-cancel:hover,
.deletePopup .btn-confirm-delete:hover {
    opacity: 0.8;
}

</style>
<body>
    <main class="main-content" id="main-content">
        
        <div class="order-summary">
            <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows">
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
                <span>rows</span>
            </div>
           
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button class="add-user-btn">
                <i class="bi bi-plus"></i> Add Supplier
            </button>
        </div>
        <div id="dashboard-content">
            <table class="table1">
        <thead>
            <tr class='entête'>
                <th>Code<i class="bi bi-arrow-down"></th>
				<th>Company<i class="bi bi-arrow-down"></th>
				<th>Adress<i class="bi bi-arrow-down"></th>
				<th>Country<i class="bi bi-arrow-down"></th>
				<th>Phone<i class="bi bi-arrow-down"></th>
				<th>Actions<i class="bi bi-arrow-down"></th>
            </tr>
        </thead>
        <tbody>
    <?php
    $data = [
        ['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
        ['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
    ];

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" >
            <td><span class="icon <?= $btnClass ?>" onclick="toggleDetails(this)">+</span> <?= $row[0] ?></td>
            <td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
            <td>
			     <button class="btn-fact-user">
                     <i class="bi bi-plus"></i>&nbsp Add factory
                 </button>
                 <button class="btn-edit-user">
                  <i class="bi bi-pencil-square"></i>&nbsp
				  Edit</button>
                  <button class="btn-delete-user">
				  <i class="bi bi-trash3"></i>
				  Delete</button>               
            </td>  
        </tr>
        <tr class="details">
            <td colspan="11">
                <div class="details-content">
                    <span>Adresses</span>
                    
                </div>
                <table class="sub-table2 details-table">
                    <thead>
                        <tr class="entête">
                            <th>Default</th>
                            <th>Contact</th>
                            <th>Company name</th>
                            <th>Adress</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="default" ></td>
                            <td>
							     <button class="info-button">
                                 <i class="bi bi-person"></i>
					             <div class="popupp">
                                 <p>Nom du contact</p>
                                 <p>+00 0000 0000 000 <i class="bi bi-copy"></i></p>
                                 <p>theo.dupont@emailfaçonnier.com <i class="bi bi-copy"></i></p>
                                 </div>
                                </button>
						    </td>	
                            <td>Company name</td>
                            <td>LEVELOOP GLOVES & CAPS (HAIFENG) LIMITED Gongdishan Industrial Estate, Chengdong Town, Haifeng County, Shanwei City, Guangdong, P.R. of China</td>
                            <td>
                                <button class="btn-edit-contact">
                                  <i class="bi bi-pencil-square"></i>&nbsp
								Edit</button>
                                <button class="btn-delete-contact">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td>      
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="default" ></td>
                            <td>
							     <button class="info-button">
                                 <i class="bi bi-person"></i>
					             <div class="popupp">
                                 <p>Nom du contact</p>
                                 <p>+00 0000 0000 000 <i class="bi bi-copy"></i></p>
                                 <p>theo.dupont@emailfaçonnier.com <i class="bi bi-copy"></i></p>
                                 </div>
                                </button></td>
                            <td>Company name</td>
                            <td>LEVELOOP GLOVES & CAPS (HAIFENG) LIMITED Gongdishan Industrial Estate, Chengdong Town, Haifeng County, Shanwei City, Guangdong, P.R. of China</td>
                            <td>
                                <button class="btn-edit-contact">
                                  <i class="bi bi-pencil-square"></i>&nbsp
								Edit</button>
                                <button class="btn-delete-contact">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td> 
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="default" ></td>
                            <td>
							     <button class="info-button">
                                 <i class="bi bi-person"></i>
					             <div class="popupp">
                                 <p>Nom du contact</p>
                                 <p>+00 0000 0000 000 <i class="bi bi-copy"></i></p>
                                 <p>theo.dupont@emailfaçonnier.com <i class="bi bi-copy"></i></p>
                                 </div>
                                </button></td>
                            <td>Company name</td>
                            <td>LEVELOOP GLOVES & CAPS (HAIFENG) LIMITED Gongdishan Industrial Estate, Chengdong Town, Haifeng County, Shanwei City, Guangdong, P.R. of China</td>
                            <td>
                                <button class="btn-edit-contact">
                                  <i class="bi bi-pencil-square"></i>&nbsp
								Edit</button>
                                <button class="btn-delete-contact">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td> 
                        </tr>
                    </tbody>
                </table>
               


   
            </td>
        </tr>
    <?php } ?>

</tbody>

    </table>
	<!-- popup create user-->
     <div id="createUserPopupS" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Create supplier</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">
            <button type="button" class="add-new-btn">+ Add new address</button>

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            <button type="button" class="add-new-btn">+ Add new contact</button>
            
            <button type="submit" class="createS-btn">Create</button>
        </form>
    </div>
</div>  

<!-- popup Add fact-->
     <div id="Addfact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Add factory</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            
            
            <button type="submit" class="Save-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </form>
    </div>
</div> 
<!-- popup Edit fact-->
     <div id="Editfact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Edit factory</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            
            
            <button type="submit" class="Save-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </form>
    </div>
</div>

<!-- popup Edit contact-->
     <div id="Editcontact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Edit contact</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            
            
            <button type="submit" class="Save-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </form>
    </div>
</div>
 
 <!-- popup delete supp --> 
 <div id="deletePopup" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Êtes-vous sûr de vouloir supprimer ce façonnier ?</h5>
        <p>Vous ne pourrez pas récupérer un façonnier supprimé.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" >Ne pas supprimer</button>
            <button class="btn-confirm-delete" >Supprimer</button>
        </div>
    </div>
</div>

 <!-- popup delete contact --> 
 <div id="deletePopup2" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Êtes-vous sûr de vouloir supprimer ce contact ?</h5>
        <p>Vous ne pourrez pas récupérer un contact supprimé.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" >Ne pas supprimer</button>
            <button class="btn-confirm-delete" >Supprimer</button>
        </div>
    </div>
</div>
        </div>
    </main> 
     	
<script src="js/dashboard_dup.js"></script>
<script>
// Fonction pour ouvrir un popup en fonction de l'id
function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex'; // Utiliser 'flex' pour centrer
}

// Fonction pour fermer tous les popups
function closeAllPopups() {
    const popups = document.querySelectorAll('.popupS-container');
    popups.forEach(popup => popup.style.display = 'none');
}

// Ajouter des écouteurs d'événements aux boutons
document.querySelectorAll('.add-user-btn').forEach(button => {
    button.addEventListener('click', () => openPopup('createUserPopupS'));
});

document.querySelectorAll('.btn-fact-user').forEach(button => {
    button.addEventListener('click', () => openPopup('Addfact'));
});

document.querySelectorAll('.btn-edit-user').forEach(button => {
    button.addEventListener('click', () => openPopup('Editfact'));
});

document.querySelectorAll('.btn-edit-contact').forEach(button => {
    button.addEventListener('click', () => openPopup('Editcontact'));
});
document.querySelectorAll('.btn-delete-user').forEach(button => {
    button.addEventListener('click', () => openPopup('deletePopup'));
});
document.querySelectorAll('.btn-delete-contact').forEach(button => {
    button.addEventListener('click', () => openPopup('deletePopup2'));
});
// Fonction pour fermer les popups
function closePopup33() {
    closeAllPopups();
}

// Ajouter l'écouteur d'événement pour les boutons de fermeture
document.querySelectorAll('.closeS-btn').forEach(button => {
    button.addEventListener('click', closePopup33);
});
// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('.btn-cancel').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('deletePopup').style.display = 'none';
		document.getElementById('deletePopup2').style.display = 'none';
    });
});

</script>
</body>
</html>
