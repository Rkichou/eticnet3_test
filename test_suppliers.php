
<?php
   
    require_once("config.inc.php");
    require_once("includes/is_session_active.php");
if(isset($_POST['rows'])){
$maxRecord=$_POST['rows'];
}
else{
$maxRecord=20;
}
?>
<link rel="stylesheet" href="css/PS_dashboard.css">

<link rel="stylesheet" href="css/suppliers.css">

<style>body {
    font-family: Arial, sans-serif;
}
table {
    width: 95%;
    border-collapse: collapse;
    margin-left: 40px;
    margin-right: 40px;
}
th, td {
    padding: 12px;
    text-align: left;
    font-size: 12px;
}
th {
    background-color: white;
    cursor: pointer;
}
th:hover {
    background-color: #e9e9e9;
}
.even-row {
    background-color: white;
    cursor: pointer;
}
.odd-row {
    background-color: #EAEAEA;
    cursor: pointer;
}
.icon {
    display: inline-block;
    width: 20px;
    height: 20px;
}
.btn-green, .btn-orange, .btn-red {
border-radius: 50%;
padding: 2px;
text-align: center;
cursor: pointer;
font-size: 12px;
line-height: 9px;
margin-right: 4px;
border: none; /* Suppression des styles par défaut des boutons */
background-color: transparent; /* Suppression de la couleur de fond */
margin-top: 10px;
}

.details td {
    padding: 10px;
    border-top: none;
}
.details-content {
    padding: 10px;
    background-color: #444;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    border: 1.2px solid #e2e2e2;
    border-radius: 10px;
    text-align: left; 
    vertical-align: left;	 
}
.details-content span {
    flex-grow: 1;
}
.details-toggle {
    cursor: pointer;
    color: white;
}

/*/nouveau*/
.details {
    display: none;
    background-color: #EAEAEA; /*nouveau*/
    
}
.sub-table2 {
width: 99.7%;
background-color: white;
margin-bottom: 10px;
border-collapse: separate;
border-spacing: 0;
border: 1.5px solid #444;
border-radius: 10px;
margin-top: auto;
border-top: none;
margin-left: 0.2%;
position: relative;
/* Pour que les éléments enfants soient positionnés correctement */

} 
/* Appliquer l'arrondi aux coins des cellules */
.sub-table2 td:first-child {
border-top-left-radius: 10px;
border-bottom-left-radius: 10px;
}

.sub-table2 td:last-child {
border-top-right-radius: 10px;
border-bottom-right-radius: 10px;
}
.sub-table2 th, .sub-table2 td {
background-color: white;
padding: 8px;
font-size: 11px;
text-align: center;
vertical-align: middle;
border-bottom: 1px solid #ccc; /* Bordure en bas pour les lignes horizontales */
}

.sub-table2 th {
background-color: white;
color: #333;
border-bottom: 1px solid #ccc;
}
/*nouveau*/

.status-summary {
margin-left: auto;
display: flex;
align-items: center;
padding-right: 2%;
}

.status {
padding: 7px 19px;
border-radius: 5px;
color: #fff;
margin-left: 8px;
}

.in-time {
background-color: limegreen;
}





.table-controls label {

margin-right: 10px;
margin-left: 60px;
}

.table-controls select {
margin-right: 13px;
padding: 5px;
border-radius: 12px;
font-size: 14px

}
.order-summary {
display: flex;
align-items: center;
margin-bottom: 20px;


}


.order-summary-btn i {
margin-right: 10px;
}

.search-container {
display: flex;
align-items: center;
margin-left: 40px;
margin-right: auto;
}

.search-input {
padding: 12px 20px;
border: 1.5px solid #ddd;
border-radius: 12px 0 0 12px;
outline: none;
border-right: none;
font-size: 16px;
width: 70%;


}

.search-btn {
padding: 12px;
border: 1.5px solid #ddd; 
border-left: none;
background-color: white;
border-radius: 0 13px 13px 0;
cursor: pointer;

}

.add-order-btn {
padding: 7px;
background-color: white;
color: white;
border: 1.5px solid #ddd; 
border-radius: 13px;
cursor: pointer;
display: flex;
align-items: center;
justify-content: center;
font-size: 16px;
}




.add-order-btn i {
margin-right: 10px;
}

.entête th, .entête td {
border-bottom: 1px solid #333;

}
.table1{
border-collapse: collapse;



}
.table1 th, .table1 td {
text-align: center; 
    vertical-align: middle;	 
}


.btn-edit-user, .btn-delete-user, .btn-fact-user, .btn-edit-contact, .btn-delete-contact{
    padding: 3px 6px;
    margin: 2px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-edit-user,.btn-edit-contact {
    background-color: #555555;
    color: #fff;
}
.btn-delete-user, .btn-delete-contact {
    background-color: #e31313;
    color: white;
}
.btn-fact-user {
    background-color: #59A735;
    color: white;
}
.btn-edit-user:hover, .btn-edit-contact:hover{
    background-color: #353333;	
}
.btn-delete-user:hover ,.btn-delete-contact:hover {
    background-color: #9b1515;	
}
.add-user-btn {
background-color: #59A735; 
color: white; 
padding: 8px 16px; 
border: none; 
border-radius: 12px; 
font-size: 14px; 
display: flex; 
align-items: center; 
cursor: pointer; 
margin-right: 40px;

}

.add-user-btn i {
margin-right: 8px;
font-size: 20px; 
}

.add-user-btn:hover, .btn-fact-user:hover{
background-color: #45a049; 
}


/* Close Button */
.closeS-btn {
    background: none;
    border: none;
    font-size: 24px; /* Taille agrandie pour correspondre à Figma */
    cursor: pointer;
    color: #333;
    padding: 0; /* Supprimer les marges */
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

.popup-input:focus {
    border-color: #007BFF; /* Couleur de bordure lors du focus */
    outline: none; /* Supprimer le contour par défaut */
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
margin-bottom: 15px;
}

.popupS-content input::placeholder {
color: #999999; /* Ajustez selon Figma */
font-size: 14px;
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
background-color: #59A735;
color: white;
padding: 10px 16px;
border: none;
border-radius: 8px;
font-size: 14px;
cursor: pointer;
display: flex;
align-items: center;
gap: 8px;
margin-top: 24px;
}

.createS-btn:hover {
background-color: #45a049;
}

.createF-btn {
background-color: #81C441;
color: white;
padding: 6px 12px;
border: none;
border-radius: 8px;
font-size: 16px;
cursor: pointer;
margin-top: 20px;
margin-left: 77%;
gap: 5px;

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
top: 15px; 
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


/* Popup Container */
.popupS-container {
    display: none; /* Masquer par défaut */
    position: fixed;
    justify-content: center;
    align-items: center;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
    z-index: 1000;
}

/* PopupS Content */
.popupS-content {
    background-color: white; /* Fond blanc pour le popup */
    border-radius: 12px; /* Coins arrondis */
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* Ombre douce */
    width: 400px; /* Largeur fixe */
    padding: 24px; /* Espacement interne */
    text-align: left; /* Alignement du texte */
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

.popupS-content h2 {
    font-size: 18px; /* Taille de police */
    font-weight: bold;
    margin-bottom: 16px;
    color: #333; /* Couleur du texte */
}

/* Titre du popup */
.popup-title {
    font-size: 18px;
    font-weight: 600;
    color: #333333;
    margin-bottom: 16px;
}

/* Close Button */
.closeS-btn {
    position: absolute;
    top: 16px;
    right: 16px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #999999;
}

.closeS-btn:hover,
.closeS-btn:focus {
    color: #333333;
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


.popupS-content label {
    font-size: 14px; /* Taille de la police des labels */
    font-weight: 600;
    color: #555; /* Couleur légèrement grise */
    margin-bottom: 8px;
    display: block;
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
width: 100px;
margin-left: 80%;
display: flex; 
align-items: center;
gap: 2px;

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
background-color: #59A735;
color: #fff;
padding: 6px 12px;
border: none;
border-radius: 6px;
cursor: pointer;
font-size: 12px;
}

.btn-confirm-delete {
background-color: #E31313;
color: #fff;
padding: 6px 12px;
border: none;
border-radius: 6px;
cursor: pointer;
font-size: 12px;
}

.deletePopup .btn-cancel:hover,
.deletePopup .btn-confirm-delete:hover {
opacity: 0.8;
}
/*/nouveau*/
.details {
    display: none;
    background-color: #EAEAEA; /*nouveau*/
    
}

/*nouveau*/

.DownUp-btn {
padding: 12px 20px;
background-color: #59A735;
color: #fff;
border: none;
border-radius: 12px;
cursor: pointer;
display: flex;
align-items: center; 
margin-right: 15px;
font-size : 16px;
gap: 8px;


}
.DownUp-btn:hover {
opacity: 0.8;

}

/* popup adv cheche */


.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    padding-top: 100px; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4); 
}
.modal-content {
    background-color: #fafafa;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    border-radius: 10px;
}


.popup-advanced-search {
display: none;
position: fixed;
top: 60%;
left: 50%;
transform: translate(-50%, -50%);
background-color: white;
border-radius: 15px;
box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
width: 500px;
height: 600px;
max-width: 80%;
padding: 15px;
z-index: 1000;
box-sizing: border-box;


}

.popup-content {
margin-top: 16px;
display: flex;
flex-direction: column;
gap: 16px;
}

.popup-content label {
font-size: 14px;
font-weight: bold;
color: #333;
margin-bottom: 8px; /* Ajoute de l'espacement */
}

.popup-content select {
width: 100%; /* Assure que le champ prend toute la largeur disponible */
padding: 8px;
border: 1px solid #ddd;
border-radius: 8px;
box-sizing: border-box;
font-size: 14px;
text-align: left; /* Alignement du texte dans le champ */
}

.popup-title {
margin: 0;
margin-bottom: 20px;
font-size: 1.2em;
font-weight: bold;
color: #333;
}

.popup-section {
margin-bottom: 15px;
}

.popup-input {
    width: 100%; /* Prendre toute la largeur */
    height: 40px; /* Hauteur du champ */
    border: 1px solid #ccc; /* Bordure grise */
    border-radius: 6px; /* Coins arrondis */
    padding: 8px; /* Espacement interne */
    margin-top: 16px; /* Espacement entre le label et le select */
    font-size: 16px; /* Taille de police */
    font-weight: 500; /* Police plus épaisse pour correspondre à Figma */
    color: #333; /* Couleur du texte */
}
.popup-input::placeholder {
    color: #aaa; /* Placeholder légèrement grisé */
}

.popup-footer {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.section-title {
margin-bottom: 10px;
font-size: 1em;
font-weight: bold;
color: #444;
}

.button-group, .input-group2, input-group3 {
display: flex;
flex-wrap: wrap;
justify-content: space-between;
gap: 8px;
margin-bottom: 8px;
}


.input-field1 {
flex: 1 1 calc(50% - 8px);
border: 1px solid #ccc;
border-radius: 8px;
font-size: 0.85em;
box-sizing: border-box;	
width: 220px; 
height: 32px; 
padding: 0 15px;
font-size: 14px;
color: #999;

}





.Recher-button-container {
text-align: right;
margin-top: 15px;
}

.btn-Recher {
padding: 6px 16px;
background-color: #81C441;
color: white;
border: none;
border-radius: 8px;
cursor: pointer;
font-size: 0.9em;
}

.btn-Recher:hover {
background-color: #218838;
}

.popup-close {
position: absolute;
top: 10px;
right: 10px;
font-size: 20px;
cursor: pointer;
color: #999;
}

.popup-close:hover {
color: #555;
}

.popup-header {
    display: flex; /* Mettre le titre et la croix sur une seule ligne */
    justify-content: space-between; /* Espace entre le titre et la croix */
    align-items: center; /* Centrer verticalement */
    margin-bottom: 24px; /* Espacement avec le champ select */
}

.popup-header h2 {
    font-size: 18px; /* Taille de police */
    font-weight: bold;
    color: #333; /* Couleur du texte */
}

.popup-input option {
font-size: 14px;
color: #555;
}



/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.popupApp-admin {
    background-color: #4caf50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.popupApp-admin:hover {
    background-color: #45a049;
}

/* Label */
.popup-label {
    font-size: 14px;
    font-weight: 500;
    color: #666666;
    margin-bottom: 8px;
    display: block;
    text-align: left;
}

/* Input (menu déroulant) */
.popup-input {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border: 1px solid #cccccc;
    border-radius: 8px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    color: #333333;
}


.next-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 15px;
    display: block;
    width: 100%;
}


.create-btn {
    background-color: #ccc; /* Désactivé */
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: not-allowed;
    font-size: 14px;
}

.create-btn.enabled {
    background-color: #4caf50; /* Activé */
    cursor: pointer;
}

.create-btn.enabled:hover {
    background-color: #45a049;
}

.suggestions-list {
    display: none; /* Masqué par défaut */
    list-style: none;
    margin: 0;
    padding: 0;
    border: 0px solid #ccc;
    max-height: 150px;
    overflow-y: auto;
    background-color: #fff;
    position: absolute;
    width: 90%;
    z-index: 1000;
    border-radius: 5px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
}

.suggestions-list li {
    padding: 10px;
    cursor: pointer;
}

.suggestions-list li:hover {
    background-color: #f0f0f0;
}

.tooltip {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    font-size: 14px;
    color: #333;
    position: absolute;
}


.input-container {
    position: relative;
    display: flex;
    align-items: center;
}

.input-container input {
    width: 100%;
    padding-right: 30px; /* Pour laisser de l'espace pour la flèche */
}

.arrow {
    position: absolute;
    right: 10px;
    width: 10px;
    height: 10px;
    border-left: 2px solid #333;
    border-bottom: 2px solid #333;
    transform: rotate(45deg);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.arrow.down {
    transform: rotate(-45deg); /* Flèche vers le bas */
}

.arrow.up {
    transform: rotate(-225deg); /* Flèche vers le haut */
}
</style>
        
        <div class="order-summary">
            
           
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i class="bi bi-sliders" onclick="openPopupAdSupp()"></i>
                    </button>
            </div>
			<button class="DownUp-btn">
                <i class="bi bi-download"></i>
                Download template
            </button>
            
			<button class="DownUp-btn">
                <i class="bi bi-upload"></i>
                Upload contacts 
            </button>			
            
            <button id="addSupplierBtn" class="add-user-btn">
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
                <!--    <?php

                        
                        //echo($_SESSION['id']);
                        //echo("SELECT * FROM users_adresses WHERE id_user=".$_SESSION['id']);

                        // Requête pour récupérer les informations de tous les utilisateurs
                        $userQuery = "SELECT * FROM users_adresses WHERE contractor=".$_SESSION['prefix_contractor_id'].";";
                        $userResult = mysqli_query($con, $userQuery);

                            foreach ($userResult as $index => $row) {
                            // var_dump($row);
                                $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
                                $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                                ?>
                                <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
                                    <td>
                                        <button class="icon <?= $btnClass ?>" >
                                            <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                                            </button>
                                            <?= 	$row['code_supplier'] ?>
                                    </td>            <td><?= $row['company_name'] ?></td>
                                    <td class="AddRow">
                                            <button class="info-btn" data-popup="popup-<?= $index ?>">
                                                <img src="Image/address.png" alt="Info" style="width: 20px; height: 20px;">
                                                <div class="popup" id="popup-<?= $index ?>">
                                                <strong>Livraison</strong>
                                                <?= $row['adresse_1'] ?><br>
                                            
                                                
                                            </div>
                                            </button>
                                            
                                    </td>
                                    <td><?= $row['country'] ?></td>
                                    <td><?= $row['telephone'] ?></td>
                                    <td>
                                        <button class="btn-fact-user" data-supplier-id="<?= $row['id']; ?>" onclick="openAddFactoryPopup(this); event.stopPropagation();">
                                            <i class="bi bi-plus"></i>&nbsp; Add factory
                                        </button>
                                        <button class="btn-delete-user" onclick="openDeletePopup(); event.stopPropagation();">
                                            <i class="bi bi-trash3"></i> Remove
                                        </button>               
                                    </td>  
                                </tr>
                                <tr class="main-row <?= $rowClass ?>" style="display: none;">
                                    <td colspan="6">
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
                                            <?php
                        // Requête pour récupérer les informations de toutes les usines associées à un fournisseur
                        $factoryQuery = "SELECT * FROM factory WHERE supplier_id=".$row['id'];
                        $factoryResult = mysqli_query($con, $factoryQuery);

                        foreach ($factoryResult as $index => $fac) {
                        // Requête pour récupérer tous les contacts associés à chaque usine
                        $contactQuery = "SELECT * FROM users_contacts WHERE factory_id=".$fac['id'];
                        $contactResult = mysqli_query($con, $contactQuery);
                        
                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="default" ></td>
                                            <td>
                                                <button class="info-button">
                                                <i class="bi bi-person"></i>
                                                <div class="popupp">
                                                <?php while ($contact = mysqli_fetch_assoc($contactResult)) { ?>
                                        <p><?= $contact['contact_name'] ?></p>
                                        <p><?= $contact['phone'] ?></p>
                                        <p><?= $contact['contact_email'] ?> <i class="bi bi-copy"></i></p>
                                    <?php } ?>
                                                </div>
                                                </button>
                                            </td>	
                                            <td><?= $fac['name'] ?></td>
                                            <td><?= $fac['address_1'] ?></td>
                                            <td>
                                                <button class="btn-edit-contact">
                                                <i class="bi bi-pencil-square"></i>&nbsp
                                                Edit</button>
                                                <button class="btn-delete-contact">
                                                <i class="bi bi-trash3"></i>
                                                Delete</button>
                                            </td>      
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            


                
                            </td>
                        </tr>
                    <?php } ?>
                
                                                -->
                    <!-- Données statiques -->
                    <tr class="even-row">
                        <td>
                            <button class="icon btn-green">
                                <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                            </button>
                            SUP001
                        </td>
                        <td>Supplier A</td>
                        <td>
                            <button class="info-btn">
                                <img src="Image/address.png" alt="Info" style="width: 20px; height: 20px;">
                                <div class="popup">
                                    <strong>Livraison</strong>
                                    123 Main St<br>New York, NY 10001
                                </div>
                            </button>
                        </td>
                        <td>USA</td>
                        <td>+1 555-1234</td>
                        <td>
                            <button class="btn-fact-user" onclick="openAddFactoryPopup(); event.stopPropagation();">
                                <i class="bi bi-plus"></i>&nbsp; Add factory
                            </button>
                            <button class="btn-delete-user" onclick="openDeletePopup(); event.stopPropagation();">
                                <i class="bi bi-trash3"></i> Remove
                            </button>
                        </td>
                    </tr>
                    <tr class="odd-row">
                        <td>
                            <button class="icon btn-green">
                                <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                            </button>
                            SUP002
                        </td>
                        <td>Supplier B</td>
                        <td>
                            <button class="info-btn">
                                <img src="Image/address.png" alt="Info" style="width: 20px; height: 20px;">
                                <div class="popup">
                                    <strong>Livraison</strong>
                                    456 Elm St<br>Los Angeles, CA 90001
                                </div>
                            </button>
                        </td>
                        <td>USA</td>
                        <td>+1 555-5678</td>
                        <td>
                            <button class="btn-fact-user" onclick="openAddFactoryPopup(); event.stopPropagation();">
                                <i class="bi bi-plus"></i>&nbsp; Add factory
                            </button>
                            <button class="btn-delete-user" onclick="openDeletePopup(); event.stopPropagation();">
                                <i class="bi bi-trash3"></i> Remove
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
       
            <!-- Tooltip -->
            <div id="addressTooltip" class="tooltip" style="display: none;"></div>

            <!-- Popup "Add Supplier" -->
            <div id="popupAddSupplier" class="popupS-container" style="display: none;">
                <div class="popupS-content">
                    <div class="popup-header">
                        <h3>Add Supplier</h3>
                        <button class="close-btn" onclick="closePopup('popupAddSupplier')">&times;</button>
                    </div>
                    <form>
                        <label for="supplierInput1">Supplier</label>
                        <div class="input-container">
                            <input
                                id="supplierInput1"
                                class="popup-input"
                                placeholder="Type to search or select"
                                oninput="filterSupplierList()"
                                onclick="openSupplierList()"
                            >
                            <span id="dropdownArrow1" class="arrow down" onclick="toggleSupplierList()"></span>
                        </div>
                        <ul id="supplierSuggestions1" class="suggestions-list" style="display: none;"></ul>
                    </form>
                </div>
            </div>

            <!-- Popup "Add Supplier Details" -->
            <div id="popupAddSupplierDetails" class="popupS-container" style="display: none;">
                <div class="popupS-content">
                    <div class="popup-header">
                        <h3>Add Supplier Details</h3>
                        <button class="close-btn" onclick="resetAndClosePopup('popupAddSupplierDetails')">&times;</button>
                    </div>
                    <form>
                        <label for="supplierInputDetails1">Supplier</label>
                        <div class="input-container">
                            <input id="supplierInputDetails1" class="popup-input" readonly>
                        </div>

                        <label for="supplierCodeInput1">Supplier Code</label>
                        <input id="supplierCodeInput1" class="popup-input" placeholder="Enter supplier code">

                        <label for="factoryInput1">Factory</label>
                        <div class="input-container">
                            <input
                                id="factoryInput1"
                                class="popup-input"
                                placeholder="Type to search or select"
                                oninput="filterFactoryList()"
                                onclick="openFactoryList()"
                            >
                            <span id="factoryDropdownArrow1" class="arrow down" onclick="toggleFactoryList()"></span>
                        </div>
                        <ul id="factorySuggestions1" class="suggestions-list" style="display: none;"></ul>
                    </form>
                </div>
            </div>

            <!-- Popup "Add Factory Details" -->
            <div id="popupAddFactoryDetails" class="popupS-container" style="display: none;">
                <div class="popupS-content">
                    <div class="popup-header">
                        <h3>Add Supplier</h3>
                        <button class="close-btn" onclick="resetAndClosePopup('popupAddFactoryDetails')">&times;</button>
                    </div>
                    <form>
                        <label for="supplierInputDetails2">Supplier</label>
                        <div class="input-container">
                            <input id="supplierInputDetails2" class="popup-input" readonly>
                        </div>

                        <label for="supplierCodeInput2">Supplier Code</label>
                        <input id="supplierCodeInput2" class="popup-input" readonly>

                        <label for="factoryInput2">Factory</label>
                        <div class="input-container">
                            <input id="factoryInput2" class="popup-input" readonly>
                        </div>

                        <label for="factoryCodeInput2">Factory Code</label>
                        <input id="factoryCodeInput2" class="popup-input" placeholder="Enter factory code">

                        <label for="contactInput1">Contact</label>
                        <div class="input-container">
                            <input
                                id="contactInput1"
                                class="popup-input"
                                placeholder="Type to search or select"
                                oninput="filterContactList()"
                                onclick="openContactList()"
                            >
                            <span id="contactDropdownArrow1" class="arrow down" onclick="toggleContactList()"></span>
                        </div>
                        <ul id="contactSuggestions1" class="suggestions-list" style="display: none;"></ul>
                    </form>
                </div>
            </div>

            <!-- Popup "Add Supplier Services" -->
            <div id="popupAddSupplierServices" class="popupS-container" style="display: none;">
                <div class="popupS-content">
                    <div class="popup-header">
                        <h3>Add Supplier</h3>
                        <button class="close-btn" onclick="resetAndClosePopup('popupAddSupplierServices')">&times;</button>
                    </div>
                    <form>
                        <label for="supplierInputServices1">Supplier</label>
                        <input id="supplierInputServices1" class="popup-input" readonly>

                        <label for="supplierCodeInputServices1">Supplier Code</label>
                        <input id="supplierCodeInputServices1" class="popup-input" readonly>

                        <label for="factoryInputServices1">Factory</label>
                        <input id="factoryInputServices1" class="popup-input" readonly>

                        <label for="factoryCodeInputServices1">Factory Code</label>
                        <input id="factoryCodeInputServices1" class="popup-input" readonly>

                        <label for="contactInputServices1">Contact</label>
                        <input id="contactInputServices1" class="popup-input" readonly>

                        <label>Service</label>
                        <div class="service-container">
                            <div>
                                <input type="checkbox" id="allServices1" onclick="toggleAllServices()"> All services
                            </div>
                            <div id="serviceList1">
                                <input type="checkbox" id="service1" class="service-checkbox"> Service 1
                                <input type="checkbox" id="service2" class="service-checkbox"> Service 2
                                <input type="checkbox" id="service3" class="service-checkbox"> Service 3
                            </div>
                        </div>

                        <button type="button" class="validate-btn" onclick="validateSupplier()">Validate</button>
                    </form>
                </div>
            </div>

            <!-- Popup "Add Contact" -->
            <div id="popupAddContact" class="popupS-container" style="display: none;">
                <div class="popupS-content">
                    <div class="popup-header">
                        <h3>Add Contact</h3>
                        <button class="close-btn" onclick="resetAndClosePopup('popupAddContact')">&times;</button>
                    </div>
                    <form>
                        <label>Contact</label>
                        <input id="firstNameInput1" class="popup-input" placeholder="First name">
                        <input id="lastNameInput1" class="popup-input" placeholder="Last name">
                        <input id="emailInput1" class="popup-input" placeholder="Email address">
                        <input id="passwordInput1" class="popup-input" placeholder="Password" type="password">

                        <div class="input-container">
                            <input id="phoneCountryCodeInput1" class="popup-input-short" placeholder="+XXX">
                            <input id="phoneNumberInput1" class="popup-input" placeholder="Phone number">
                        </div>

                        <label>Service</label>
                        <div class="service-container">
                            <div>
                                <input type="checkbox" id="allServicesContact1" onclick="toggleAllServicesContact()"> All services
                            </div>
                            <div id="serviceListContact1">
                                <input type="checkbox" id="service1Contact" class="service-checkbox-contact"> Service 1
                                <input type="checkbox" id="service2Contact" class="service-checkbox-contact"> Service 2
                                <input type="checkbox" id="service3Contact" class="service-checkbox-contact"> Service 3
                            </div>
                        </div>

                        <button type="button" class="validate-btn" onclick="validateContact()">Validate</button>
                    </form>
                </div>
            </div>

            <!-- Popup "Add Factory" -->
            <div id="popupAddFactory" class="popupS-container" style="display: none;">
                <div class="popupS-content">
                    <div class="popup-header">
                        <h3>Add Factory</h3>
                        <span id="factoryIdDisplay" class="factory-id">ID:1</span>
                        <button class="close-btn" onclick="resetAndClosePopup('popupAddFactory')">&times;</button>
                    </div>
                    <form>
                        <!-- Factory Fields -->
                        <label for="factoryNameInput">Name</label>
                        <input id="factoryNameInput" class="popup-input" placeholder="Enter factory name">

                        <label for="factoryCodeInput">Factory code</label>
                        <input id="factoryCodeInput" class="popup-input" placeholder="Enter factory code">

                        <label for="factoryAddress1Input">Address 1</label>
                        <input id="factoryAddress1Input" class="popup-input" placeholder="Enter address 1">

                        <label for="factoryAddress2Input">Additional address</label>
                        <input id="factoryAddress2Input" class="popup-input" placeholder="Enter additional address">

                        <label for="factoryZipInput">ZIP code</label>
                        <input id="factoryZipInput" class="popup-input" placeholder="Enter ZIP code">

                        <label for="factoryCityInput">City</label>
                        <input id="factoryCityInput" class="popup-input" placeholder="Enter city">

                        <label for="factoryCountryInput">Country</label>
                        <input id="factoryCountryInput" class="popup-input" placeholder="Enter country">

                        <!-- Printshop Dropdown -->
                        <label for="factoryPrintshopInput">Printshop</label>
                        <div class="input-container">
                            <input
                                id="factoryPrintshopInput"
                                class="popup-input"
                                placeholder="Type to search or select"
                                oninput="filterPrintshopList()"
                                onclick="openPrintshopList()"
                            >
                            <span id="printshopDropdownArrow" class="arrow down" onclick="togglePrintshopList()"></span>
                        </div>
                        <ul id="printshopSuggestions" class="suggestions-list" style="display: none;"></ul>

                        <!-- Navigation Buttons -->
                        <button class="next-btn" onclick="redirectToAddContact()">Next</button>
                    </form>
                </div>
            </div>

            <!-- Popup Add Supplier -->
            <div id="popupAddNewSupplier" class="popupS-container" style="display: none;">
                <div class="popupS-content">
                    <div class="popup-header">
                        <h3>Add Supplier</h3>
                        <button class="close-btn" onclick="resetAndClosePopup('popupAddNewSupplier')">&times;</button>
                    </div>
                    <form>
                        <!-- Company Name Field -->
                        <label for="companyNameInput">Company Name</label>
                        <input
                            id="companyNameInput"
                            class="popup-input"
                            placeholder="Enter company name"
                        >

                        <!-- Supplier Code Field -->
                        <label for="supplierCodeInput">Supplier Code</label>
                        <input
                            id="supplierCodeInput"
                            class="popup-input"
                            placeholder="Enter supplier code"
                        >

                        <!-- Next Button -->
                        <div class="popup-footer">
                            <button class="next-btn" onclick="redirectToAddFactory()">Next</button>
                        </div>
                    </form>
                </div>
            </div>






                                           




                                                                                                    








            <!-- popup Add fact-->
            <div id="Addfact" class="popupS-container">
                <div class="popupS-content">
                    <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
                    <h5>Add factory</h5>

                    <h4>General informations</h4>
                    <form id="addFactoryForm">
                    <input type="hidden" id="supplierIdInput" name="supplierId">

                        <input type="text" id="factoryCompanyName" placeholder="Company name" value="Example Factory Company">
                        <input type="text" placeholder="FFactory code" value="FAC6789">

                        <input type="text" id="factoryAddress1" placeholder="Address 1" value="123 Factory St">
                        <input type="text" id="factoryAdditionalAddress" placeholder="Additional address" value="Building B">
                        <div class="form-group">
                            <input type="text" id="factoryZipCode" placeholder="ZIP code" value="10002">
                            <input type="text" id="factoryCity" placeholder="City" value="San Francisco">
                        </div>
                        <input type="text" id="factoryCountry" placeholder="Country" value="USA">

                        <h4>Contact</h4>
                        <div class="form-group">
                            <input type="text" id="contactFirstName" placeholder="1st name" value="Jane">
                            <input type="text" id="contactLastName" placeholder="Last name" value="Smith">
                        </div>
                        <input type="email" id="contactEmail" placeholder="Email address" value="jane.smith@example.com">
                        <div class="form-group2">
                            <select id="contactPhonePrefix">
                                <option value="+XXX" disabled>+XXX</option>
                                <option value="+123" selected>+123</option>
                                <option value="+456">+456</option>
                                <!-- Other options here -->
                            </select>
                            <input type="text" id="contactPhoneNumber" placeholder="Phone number" value="987-6543">
                        </div>

                        <button type="button" class="createF-btn" id="createFactoryBtn">
                            <img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;"> Create
                        </button>
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
    
            <!-- popup delete supp --> 
            <div id="deletePopup" class="deletePopup">
                <div class="deletePopup-content">
                    <h5>Are you sure ?</h5>
                    <p>Once a supplier has been deleted, you will not be able to recover his datas.</p>
                    <div class="deletePopup-buttons">
                        <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
                        <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
                    </div>
                </div>
            </div>

            <!-- popup delete contact --> 
            <div id="deletePopup2" class="deletePopup">
                <div class="deletePopup-content">
                    <h5>Are you sure ?</h5>
                    <p>Once a factory has been deleted, you will not be able to recover his datas.</p>
                    <div class="deletePopup-buttons">
                        <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
                        <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>



<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <span class="popup-close"><i class="bi bi-x-lg"  onclick="closePopupAdSupp()"></i></span>
            <h2 class="popup-title">Advanced research</h2>

            <div class="popup-section">
                <h3 class="section-title">General informations</h3>
                <div class="input-group2">
                    <input type="text" placeholder="Company" class="input-field1">
                    <input type="text" placeholder="Type" class="input-field1">
					<input type="text" placeholder="Country" class="input-field1">
                    <input type="text" placeholder="Reference" class="input-field1">
					<input type="text" placeholder="Phone" class="input-field1">
                </div>

            </div>

            <div class="popup-section">
                <h3 class="section-title">Adress</h3>
                <div class="input-group2">
                    <input type="text" placeholder="Country" class="input-field1">
                    <input type="text" placeholder="Province" class="input-field1">
					<input type="text" placeholder="City" class="input-field1">
                    <input type="text" placeholder="Zip code" class="input-field1">
					<input type="text" placeholder="Street" class="input-field1">
					<input type="text" placeholder="N°" class="input-field1">
					<input type="text" placeholder="Adress 2" class="input-field1">
                </div>

            </div>

            

            <div class="Recher-button-container">
                <button class="btn-Recher"><i class="bi bi-search"></i>&nbsp Search</button>
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
                $target_id = $_SESSION['prefix_contractor_id']; // L'identifiant que vous recherchez
                $servicesQuery = "SELECT * FROM users_adresses WHERE FIND_IN_SET('$target_id', contractor) > 0";
                $servicesResult = mysqli_query($con, $servicesQuery);
                while ($service = mysqli_fetch_assoc($servicesResult)): ?>
                     <option id="sele_service" value="<?= htmlspecialchars($service['id']); ?>">
                        <?= htmlspecialchars($service['code_supplier']); ?>
                    </option> 
                <?php endwhile; ?></select>
				</div>
         
            <div class="popupSelect-footer">
            <button class="popupApp-admin" onclick="addServiceToList()"><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>  
     	
<script src="JS/dashboard.js"></script>
<script>
        
    // Fonction générique pour ouvrir un popup
    function openPopup(popupId) {
        // Ferme tous les popups ouverts
        document.querySelectorAll('.popup-container, .popupS-container').forEach(popup => {
            popup.style.display = 'none'; // Assurez-vous qu'aucun autre popup n'est visible
        });

        // Ouvre le popup spécifié
        const popup = document.getElementById(popupId);
        if (popup) {
            popup.style.display = 'flex'; // Utilise 'flex' pour centrer le popup
        }
    }
    // Fonction générique pour fermer un popup
    function closePopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup) {
            popup.style.display = 'none'; // Masque le popup spécifié
        }
    }

    function resetAndClosePopup(popupId) {
    if (popupId === 'popupAddSupplier') {
        document.getElementById('supplierInput1').value = '';
    }
    if (popupId === 'popupAddSupplierDetails') {
        document.getElementById('supplierInputDetails1').value = '';
        document.getElementById('supplierCodeInput1').value = '';
        document.getElementById('factoryInput1').value = '';
        
    }
    if (popupId === 'popupAddFactoryDetails') {
        document.getElementById('factoryCodeInput2').value = '';
        document.getElementById('contactInput1').value = '';
        document.getElementById('contactSuggestions1').innerHTML = '';
    }
    closePopup(popupId);
    }

    // Ferme les popups avec les boutons de fermeture
    document.querySelectorAll('.close-btn').forEach(button => {
        button.addEventListener('click', function () {
            const popupId = this.closest('.popup-container, .popupS-container').id;
            closePopup(popupId);
        });
    });

    // Ajouter des écouteurs d'événements aux boutons
    document.querySelectorAll('.add-user-btn').forEach(button => {
        button.addEventListener('click', () => openPopup('popupAddSupplier'));
    });

    const suppliers = [
        { name: 'Supplier 1, Pays - Ville', address: 'Address 1\nCity 1\nCountry 1' },
        { name: 'Supplier 2, Pays - Ville', address: 'Address 2\nCity 2\nCountry 2' },
        { name: 'Supplier 3, Pays - Ville', address: 'Address 3\nCity 3\nCountry 3' }
    ];

    const factories = [
        { name: 'Factory 1, City - Country', address: 'Factory Address 1\nCity 1\nCountry 1' },
        { name: 'Factory 2, City - Country', address: 'Factory Address 2\nCity 2\nCountry 2' },
        { name: 'Factory 3, City - Country', address: 'Factory Address 3\nCity 3\nCountry 3' }
    ];

    const contacts = [
        { name: 'Contact 1, Position', address: 'Email: contact1@example.com\nPhone: +123456789' },
        { name: 'Contact 2, Position', address: 'Email: contact2@example.com\nPhone: +987654321' },
        { name: 'Contact 3, Position', address: 'Email: contact3@example.com\nPhone: +192837465' }
    ];

    const printshops = [
        { name: "Printshop 1" },
        { name: "Printshop 2" },
        { name: "Printshop 3" },
        { name: "Printshop 4" },
    ];



    // DOM elements
    const dropdownArrow = document.getElementById('dropdownArrow1');
    const supplierInput = document.getElementById('supplierInput1');
    const supplierSuggestions = document.getElementById('supplierSuggestions1');
    const addressTooltip = document.getElementById('addressTooltip');

    // Fonction pour afficher toutes les suggestions avec "Create" toujours en bas
    function showAllSuppliers() {
        supplierSuggestions.innerHTML = '';
        suppliers.forEach(supplier => {
            const li = document.createElement('li');
            li.textContent = supplier.name;
            li.dataset.address = supplier.address;

            li.addEventListener('mouseover', (event) => showTooltip(event, supplier.address));
            li.addEventListener('mouseout', hideTooltip);
            li.addEventListener('click', () => {
                supplierInput.value = supplier.name;
                closeSupplierList();

                // Ouvrir le second popup
                openPopup("popupAddSupplierDetails");
                document.getElementById("supplierInputDetails1").value = supplier.name; // Pré-remplit
            });

            supplierSuggestions.appendChild(li);
        });

        // Ajouter "Create" en bas de la liste
        const createOption = document.createElement('li');
        createOption.textContent = 'Create';
        createOption.classList.add('create-option'); // Classe spéciale pour le styling
        createOption.addEventListener('click', () => {
            supplierInput.value = '';
            closeSupplierList();
            openPopup('popupAddNewSupplier'); // Remplacez par la logique pour ouvrir le popup
        });
        supplierSuggestions.appendChild(createOption);
    }

    // Fonction pour filtrer les suggestions en fonction de l'entrée utilisateur
    function filterSupplierList() {
        const input = supplierInput.value.toLowerCase();
        supplierSuggestions.innerHTML = '';

        const filteredSuppliers = suppliers.filter(supplier =>
            supplier.name.toLowerCase().includes(input)
        );

        // Ajouter les suppliers filtrés
        filteredSuppliers.forEach(supplier => {
            const li = document.createElement('li');
            li.textContent = supplier.name;
            li.dataset.address = supplier.address;

            li.addEventListener('mouseover', (event) => showTooltip(event, supplier.address));
            li.addEventListener('mouseout', hideTooltip);
            li.addEventListener('click', () => {
                supplierInput.value = supplier.name;
                closeSupplierList();
            });

            supplierSuggestions.appendChild(li);
        });

        // Ajouter "Create" en bas
        const createOption = document.createElement('li');
        createOption.textContent = 'Create';
        createOption.classList.add('create-option');
        createOption.addEventListener('click', () => {
            supplierInput.value = '';
            closeSupplierList();
            alert('Open create supplier popup'); // Remplacez par la logique pour ouvrir le popup
        });
        supplierSuggestions.appendChild(createOption);

        // Ouvrir la liste automatiquement si l'utilisateur tape quelque chose
        supplierSuggestions.style.display = 'block';
        dropdownArrow.classList.remove('down');
        dropdownArrow.classList.add('up');
    }

    // Fonction pour ouvrir la liste des suggestions
    function openSupplierList() {
        supplierSuggestions.style.display = 'block';
        dropdownArrow.classList.remove('down');
        dropdownArrow.classList.add('up');
        showAllSuppliers();
    }

    // Fonction pour fermer la liste des suggestions
    function closeSupplierList() {
        supplierSuggestions.style.display = 'none';
        dropdownArrow.classList.remove('up');
        dropdownArrow.classList.add('down');
    }

    // Fonction pour basculer la liste avec la flèche
    function toggleSupplierList() {
        if (supplierSuggestions.style.display === 'block') {
            closeSupplierList();
        } else {
            openSupplierList();
        }
    }

    // Fonction pour afficher un tooltip avec l'adresse
    function showTooltip(event, address) {
        if (address) {
            addressTooltip.textContent = address;
            addressTooltip.style.display = 'block';
            addressTooltip.style.top = `${event.clientY + 10}px`;
            addressTooltip.style.left = `${event.clientX + 10}px`;
        }
    }

    // Fonction pour masquer le tooltip
    function hideTooltip() {
        addressTooltip.style.display = 'none';
    }


    // DOM elements for Factory
    const factoryInput = document.getElementById('factoryInput1');
    const factorySuggestions = document.getElementById('factorySuggestions1');
    const factoryDropdownArrow = document.getElementById('factoryDropdownArrow1');

    function openFactoryDetailsPopup(factoryName, supplierName, supplierCode) {     
        // Remplir les champs avec les valeurs passées en paramètre
        const supplierInputDetails = document.getElementById("supplierInputDetails1");
        const supplierCodeInput = document.getElementById("supplierCodeInput1");
        const factoryInput = document.getElementById("factoryInput1");
        if (supplierName) {
            supplierInputDetails.value = supplierName;
            supplierInputDetails.readOnly = true; // Bloquer la modification
        }

        if (supplierCode) {
            supplierCodeInput.value = supplierCode;
            supplierCodeInput.readOnly = true; // Bloquer la modification
        }

        if (factoryName) {
            factoryInput.value = factoryName;
            factoryInput.readOnly = true; // Bloquer la modification
        }

        // Ouvrir le popup
        openPopup("popupAddFactoryDetails");
    }



    // Fonction pour afficher toutes les factories avec "Create" en bas
    function showAllFactories() {
   
        factorySuggestions.innerHTML = '';
        factories.forEach(factory => {
            const li = document.createElement('li');
            li.textContent = factory.name;
            li.dataset.address = factory.address;

            li.addEventListener('mouseover', (event) => showTooltip(event, factory.address));
            li.addEventListener('mouseout', hideTooltip);
            li.addEventListener('click', () => {
                factoryInput.value = factory.name;
                closeFactoryList();

                // Ouvrir le troisième popup pour les détails de la factory
                openFactoryDetailsPopup(factory.name, document.getElementById("supplierInputDetails2").value, document.getElementById("supplierCodeInput2").value);
            });

            factorySuggestions.appendChild(li);
        });

        // Ajouter "Create" en bas
        const createOption = document.createElement('li');
        createOption.textContent = 'Create';
        createOption.classList.add('create-option');
        createOption.addEventListener('click', () => {
            factoryInput.value = '';
            closeFactoryList();
            openPopup('popupAddFactory'); // Ajoutez la logique pour ouvrir un popup de création de factory
        });
        factorySuggestions.appendChild(createOption);
    }


    // Fonction pour filtrer les factories en fonction de l'entrée utilisateur
    function filterFactoryList() {
        const input = factoryInput.value.toLowerCase();
        factorySuggestions.innerHTML = '';

        const filteredFactories = factories.filter(factory =>
            factory.name.toLowerCase().includes(input)
        );

        filteredFactories.forEach(factory => {
            const li = document.createElement('li');
            li.textContent = factory.name;
            li.dataset.address = factory.address;

            li.addEventListener('mouseover', (event) => showTooltip(event, factory.address));
            li.addEventListener('mouseout', hideTooltip);
            li.addEventListener('click', () => {
                factoryInput.value = factory.name;
                closeFactoryList();
            });

            factorySuggestions.appendChild(li);
        });

        // Ajouter "Create" en bas
        const createOption = document.createElement('li');
        createOption.textContent = 'Create';
        createOption.classList.add('create-option');
        createOption.addEventListener('click', () => {
            factoryInput.value = '';
            closeFactoryList();
            alert('Open create factory popup'); // Ajoutez la logique pour ouvrir un popup de création de factory
        });
        factorySuggestions.appendChild(createOption);

        // Ouvrir la liste automatiquement si l'utilisateur tape quelque chose
        factorySuggestions.style.display = 'block';
        factoryDropdownArrow.classList.remove('down');
        factoryDropdownArrow.classList.add('up');
    }

    // Fonction pour ouvrir la liste des factories
    function openFactoryList() {
        factorySuggestions.style.display = 'block';
        factoryDropdownArrow.classList.remove('down');
        factoryDropdownArrow.classList.add('up');
        showAllFactories();
    }

    // Fonction pour fermer la liste des factories
    function closeFactoryList() {
        factorySuggestions.style.display = 'none';
        factoryDropdownArrow.classList.remove('up');
        factoryDropdownArrow.classList.add('down');
    }

    // Fonction pour basculer la liste des factories
    function toggleFactoryList() {
        if (factorySuggestions.style.display === 'block') {
            closeFactoryList();
        } else {
            openFactoryList();
        }
    }

    // DOM elements for Contact
    const contactInput = document.getElementById('contactInput1');
    const contactSuggestions = document.getElementById('contactSuggestions1');
    const contactDropdownArrow = document.getElementById('contactDropdownArrow1');

    // Fonction pour afficher tous les contacts avec "Create" en bas
    function showAllContacts() {
        contactSuggestions.innerHTML = '';
        contacts.forEach(contact => {
            const li = document.createElement('li');
            li.textContent = contact.name;
            li.dataset.address = contact.address;

            li.addEventListener('mouseover', (event) => showTooltip(event, contact.address));
            li.addEventListener('mouseout', hideTooltip);
            li.addEventListener('click', () => {
                contactInput.value = contact.name;
                closeContactList();

                openSupplierServicesPopup();
            });

            contactSuggestions.appendChild(li);
        });

        // Ajouter "Create" en bas
        const createOption = document.createElement('li');
        createOption.textContent = 'Create';
        createOption.classList.add('create-option');
        createOption.addEventListener('click', () => {
            contactInput.value = '';
            closeContactList();
            
            openAddContactPopup();// Logique pour ouvrir le popup de création de contact
        });
        contactSuggestions.appendChild(createOption);
    }

    // Fonction pour filtrer les contacts en fonction de l'entrée utilisateur
    function filterContactList() {
        const input = contactInput.value.toLowerCase();
        contactSuggestions.innerHTML = '';

        const filteredContacts = contacts.filter(contact =>
            contact.name.toLowerCase().includes(input)
        );

        filteredContacts.forEach(contact => {
            const li = document.createElement('li');
            li.textContent = contact.name;
            li.dataset.address = contact.address;

            li.addEventListener('mouseover', (event) => showTooltip(event, contact.address));
            li.addEventListener('mouseout', hideTooltip);
            li.addEventListener('click', () => {
                contactInput.value = contact.name;
                closeContactList();
            });

            contactSuggestions.appendChild(li);
        });

        // Ajouter "Create" en bas
        const createOption = document.createElement('li');
        createOption.textContent = 'Create';
        createOption.classList.add('create-option');
        createOption.addEventListener('click', () => {
            contactInput.value = '';
            closeContactList();
            alert('Open create contact popup'); // Logique pour ouvrir le popup de création de contact
        });
        contactSuggestions.appendChild(createOption);

        // Ouvrir la liste automatiquement si l'utilisateur tape quelque chose
        contactSuggestions.style.display = 'block';
        contactDropdownArrow.classList.remove('down');
        contactDropdownArrow.classList.add('up');
    }

    // Fonction pour ouvrir la liste des contacts
    function openContactList() {
        contactSuggestions.style.display = 'block';
        contactDropdownArrow.classList.remove('down');
        contactDropdownArrow.classList.add('up');
        showAllContacts();
    }

    // Fonction pour fermer la liste des contacts
    function closeContactList() {
        contactSuggestions.style.display = 'none';
        contactDropdownArrow.classList.remove('up');
        contactDropdownArrow.classList.add('down');
    }

    // Fonction pour basculer la liste des contacts
    function toggleContactList() {
        if (contactSuggestions.style.display === 'block') {
            closeContactList();
        } else {
            openContactList();
        }
    }

    // Fonction pour ouvrir le popup "Add Supplier Services"
    function openSupplierServicesPopup(supplier, supplierCode, factory, factoryCode, contact) {
        // Pré-remplir les champs avec les valeurs passées
        document.getElementById("supplierInputServices1").value = supplier;
        document.getElementById("supplierCodeInputServices1").value = supplierCode;
        document.getElementById("factoryInputServices1").value = factory;
        document.getElementById("factoryCodeInputServices1").value = factoryCode;
        document.getElementById("contactInputServices1").value = contact;

        // Ouvrir le popup
        openPopup("popupAddSupplierServices");
    }

    // Fonction pour cocher/décocher tous les services
    function toggleAllServices() {
        const allServicesCheckbox = document.getElementById("allServices");
        const serviceCheckboxes = document.querySelectorAll(".service-checkbox");

        serviceCheckboxes.forEach(checkbox => {
            checkbox.checked = allServicesCheckbox.checked;
        });
    }

    // Fonction pour valider l'ajout du fournisseur
    function validateSupplier() {
        // Récupérer les données pour validation
        const selectedServices = [];
        const serviceCheckboxes = document.querySelectorAll(".service-checkbox");

        serviceCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedServices.push(checkbox.id); // Ajouter les services cochés
            }
        });

        // Afficher un message de confirmation (ou envoyer les données au backend)
        alert(`
            Supplier: ${document.getElementById("supplierInputServices1").value}
            Supplier Code: ${document.getElementById("supplierCodeInputServices1").value}
            Factory: ${document.getElementById("factoryInputServices1").value}
            Factory Code: ${document.getElementById("factoryCodeInputServices1").value}
            Contact: ${document.getElementById("contactInputServices1").value}
            Selected Services: ${selectedServices.join(", ")}
        `);

        // Réinitialiser le popup et le fermer
        resetAndClosePopup("popupAddSupplierServices");
    }


    // Fonction pour ouvrir le popup "Add Contact"
    function openAddContactPopup() {
        resetAndClosePopup("popupAddContact"); // Réinitialise les champs avant d'ouvrir
        openPopup("popupAddContact");
    }

    // Fonction pour cocher/décocher tous les services dans le popup "Add Contact"
    function toggleAllServicesContact() {
        const allServicesCheckbox = document.getElementById("allServicesContact");
        const serviceCheckboxes = document.querySelectorAll(".service-checkbox-contact");

        serviceCheckboxes.forEach(checkbox => {
            checkbox.checked = allServicesCheckbox.checked;
        });
    }

    // Fonction pour valider les informations du contact
    function validateContact() {
        // Récupérer les valeurs des champs
        const firstName = document.getElementById("firstNameInput1").value.trim();
        const lastName = document.getElementById("lastNameInput1").value.trim();
        const email = document.getElementById("emailInput1").value.trim();
        const password = document.getElementById("passwordInput1").value.trim();
        const phoneCountryCode = document.getElementById("phoneCountryCodeInput1").value.trim();
        const phoneNumber = document.getElementById("phoneNumberInput1").value.trim();

        // Récupérer les services sélectionnés
        const selectedServices = [];
        const serviceCheckboxes = document.querySelectorAll(".service-checkbox-contact");
        serviceCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedServices.push(checkbox.id); // Ajoute l'ID des services sélectionnés
            }
        });

        // Valider les champs (optionnel, ajouter des règles spécifiques si nécessaire)
        if (!firstName || !lastName || !email || !password || !phoneNumber) {
            alert("Please fill in all required fields.");
            return;
        }

        // Afficher un message de confirmation ou envoyer les données au backend
        alert(`
            Contact Information:
            First Name: ${firstName}
            Last Name: ${lastName}
            Email: ${email}
            Phone: ${phoneCountryCode} ${phoneNumber}
            Selected Services: ${selectedServices.join(", ")}
        `);

        // Réinitialiser les champs et fermer le popup
        resetAndClosePopupContact("popupAddContact");
    }

    // Fonction pour réinitialiser et fermer un popup
    function resetAndClosePopupContact(popupId) {
        if (popupId === "popupAddContact") {
            document.getElementById("firstNameInput").value = "";
            document.getElementById("lastNameInput").value = "";
            document.getElementById("emailInput").value = "";
            document.getElementById("passwordInput").value = "";
            document.getElementById("phoneCountryCodeInput").value = "";
            document.getElementById("phoneNumberInput").value = "";

            const serviceCheckboxes = document.querySelectorAll(".service-checkbox-contact");
            serviceCheckboxes.forEach(checkbox => {
                checkbox.checked = false; // Décocher toutes les cases
            });

            document.getElementById("allServicesContact").checked = false; // Décocher "All services"
        }

        closePopup(popupId);
    }

    // Fonction pour afficher la liste filtrée des printshops
    function showAllPrintshops() {
        const printshopSuggestions = document.getElementById("printshopSuggestions");
        printshopSuggestions.innerHTML = '';
        printshops.forEach(printshop => {
            const li = document.createElement('li');
            li.textContent = printshop.name;

            li.addEventListener('click', () => {
                document.getElementById("factoryPrintshopInput").value = printshop.name;
                closePrintshopList();
            });

            printshopSuggestions.appendChild(li);
        });
    }

    // Fonction pour filtrer la liste des printshops
    function filterPrintshopList() {
        const input = document.getElementById("factoryPrintshopInput").value.toLowerCase();
        const printshopSuggestions = document.getElementById("printshopSuggestions");
        printshopSuggestions.innerHTML = '';

        const filteredPrintshops = printshops.filter(printshop =>
            printshop.name.toLowerCase().includes(input)
        );

        filteredPrintshops.forEach(printshop => {
            const li = document.createElement('li');
            li.textContent = printshop.name;

            li.addEventListener('click', () => {
                document.getElementById("factoryPrintshopInput").value = printshop.name;
                closePrintshopList();
            });

            printshopSuggestions.appendChild(li);
        });

        if (filteredPrintshops.length === 0) {
            const noResults = document.createElement('li');
            noResults.textContent = "No results found";
            printshopSuggestions.appendChild(noResults);
        }
    }

    // Fonction pour ouvrir la liste des printshops
    function openPrintshopList() {
        const printshopSuggestions = document.getElementById("printshopSuggestions");
        printshopSuggestions.style.display = 'block';
        document.getElementById("printshopDropdownArrow").classList.remove('down');
        document.getElementById("printshopDropdownArrow").classList.add('up');
        showAllPrintshops();
    }

    // Fonction pour fermer la liste des printshops
    function closePrintshopList() {
        const printshopSuggestions = document.getElementById("printshopSuggestions");
        printshopSuggestions.style.display = 'none';
        document.getElementById("printshopDropdownArrow").classList.remove('up');
        document.getElementById("printshopDropdownArrow").classList.add('down');
    }

    // Fonction pour basculer la liste des printshops
    function togglePrintshopList() {
        const printshopSuggestions = document.getElementById("printshopSuggestions");
        if (printshopSuggestions.style.display === 'block') {
            closePrintshopList();
        } else {
            openPrintshopList();
        }
    }

    // Fonction pour valider et passer au popup suivant ("Add Contact")
    function redirectToAddContact()  {
        // Récupérer les valeurs des champs
        const factoryName = document.getElementById("factoryNameInput").value.trim();
        const factoryCode = document.getElementById("factoryCodeInput").value.trim();
        const factoryAddress1 = document.getElementById("factoryAddress1Input").value.trim();
        const factoryAddress2 = document.getElementById("factoryAddress2Input").value.trim();
        const factoryZip = document.getElementById("factoryZipInput").value.trim();
        const factoryCity = document.getElementById("factoryCityInput").value.trim();
        const factoryCountry = document.getElementById("factoryCountryInput").value.trim();
        const factoryPrintshop = document.getElementById("factoryPrintshopInput").value.trim();

        // Fermer ce popup et ouvrir le popup suivant
        closePopup("popupAddFactory");
        openPopup("popupAddContact");
    }

    // Fonction pour réinitialiser et fermer le popup "Add Factory"
    function resetAndClosePopupFactory(popupId) {
        if (popupId === "popupAddFactory") {
            document.getElementById("factoryNameInput").value = '';
            document.getElementById("factoryCodeInput").value = '';
            document.getElementById("factoryAddress1Input").value = '';
            document.getElementById("factoryAddress2Input").value = '';
            document.getElementById("factoryZipInput").value = '';
            document.getElementById("factoryCityInput").value = '';
            document.getElementById("factoryCountryInput").value = '';
            document.getElementById("factoryPrintshopInput").value = '';
            document.getElementById("printshopSuggestions").innerHTML = '';
        }

        closePopup(popupId);
    }

    function redirectToAddFactory() {
        // Récupérer les données saisies par l'utilisateur
        const companyName = document.getElementById('companyNameInput').value.trim();
        const supplierCode = document.getElementById('supplierCodeInput').value.trim();

        // Stocker les données saisies (si besoin pour utilisation ultérieure)
        console.log('Company Name:', companyName);
        console.log('Supplier Code:', supplierCode);

        // Fermer le popup actuel
        closePopup('popupAddNewSupplier');

        // Ouvrir le popup suivant (Add Factory)
        openPopup('popupAddFactory');
    }







</script>
<div class="footer">

        <div class="pagination">
	        <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" onchange="set_rows('corporate_suppliers');>
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