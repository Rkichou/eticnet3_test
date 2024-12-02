
        <link rel="stylesheet" href="CSS/AddUser.css">
        <div class="order-summary">
            
             <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i  id="btn-open-popup" class="bi bi-sliders"></i>
                    </button>
            </div>
            <button class="add-user-btn" onclick="openPopupAdRole();">
                <img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;" > &nbsp Add role
            </button>
        </div>
        <div class="table-container">
            <table id="myTable" class="table1">
                <thead class="entête">
                    <tr>
                        <th>ID</th>
                        <th>Role<i class="bi bi-arrow-down"></i></th>
                        <th style="width:200px;">Actions<i class="bi bi-arrow-down"></i></th>
                            
                    </tr>
                </thead>
                <tbody>
                <?php 
    include('config.inc.php');

   // Récupérer le nombre total de rôles pour la pagination
$totalRolesQuery = "SELECT COUNT(*) as total FROM roles";
$totalRolesResult = mysqli_query($con, $totalRolesQuery);
$totalRoles = mysqli_fetch_assoc($totalRolesResult)['total'];

// Calcul du nombre total de pages
$totalPages = ceil($totalRoles / $rowsPerPage);

// Limiter les résultats à afficher
$userQuery = "SELECT * FROM roles LIMIT $offset, $rowsPerPage";
$userResult = mysqli_query($con, $userQuery);

    
    
    

    foreach ($userResult as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" >
            <td>
                    <?= $row['id'] ?>
            </td>
            <td><?= $row['name'] ?></td>
          			<td>
                <button class="btn-edit-user" id="EditRole">
                    <i class="bi bi-pencil-square"></i>&nbsp;Edit
                </button>
                <button class="btn-delete-user" id="DeleteRole">
				   <i class="bi bi-trash3"></i>
				Delete</button>
            </td>
        </tr>
                    <?php } ?>
                </tbody>
            </table>
			
			


        </div>

<!-- popup Edit role-->
     <div id="editrole" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeER"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Edit role</h5>
         </div>
        <form>
		    <label for="first">role id</label>
            <input type="text" placeholder="Administrateur" >
			
			<label for="last">Name</label>
            <input type="text" placeholder="Admin">	
		
        <!-- Bouton Save -->
        <div class="popupAdUser-buttons">
            <button type="button" class="saveUser-btn" id="edit_role"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </div>        </form>
    </div>
</div>
<!-- popup Add role-->
<div id="addrole" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn"><i class="bi bi-x-lg" onclick="closePopupAdRole();"></i></span>
        
        <div class="headerEcont">
          <h5 class="titreGI">Add role</h5>
         </div>
        <form id="addRoleForm">
            <label for="message_id">ID message</label>
            <input type="text" id="message_id" placeholder="Administrateur">
            
            <label for="role_name">Name</label>
            <input type="text" id="role_name" placeholder="Admin">    
        
            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" id="add_role"><i class="bi bi-floppy"></i>&nbsp;Save</button>
            </div>
        </form>
    </div>
</div>

 <!-- popup delete role --> 
 <div id="deleterole" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once a role has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>
    <script src="JS/readytoprint.js"></script>
	<script>

document.querySelectorAll('#EditRole').forEach(button => {
    button.addEventListener('click', () => openPopup('editrole'));
});
document.querySelectorAll('#DeleteRole').forEach(button => {
    button.addEventListener('click', () => openPopup('deleterole'));
});
// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('.btn-cancel').forEach(button => {
    button.addEventListener('click', () => {
		document.getElementById('deleterole').style.display = 'none';
    });
});
document.querySelectorAll('#closeER').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('editrole').style.display = 'none';
    });
});



////ajout role 
// Ajouter un écouteur d'événements pour le bouton "Save" du popup Add role
document.querySelector('#add_role').addEventListener('click', function() {
    // Récupérer les valeurs des champs "ID message" et "Name"
    let message_id = document.querySelector('#message_id').value.trim();
    let roleName = document.querySelector('#role_name').value.trim();

    // Vérifier si les champs sont remplis
    if (message_id === '' || roleName === '') {
        alert('Please fill in all fields!');
        return;
    }

    // Envoie une requête AJAX pour ajouter le rôle
    $.ajax({
        type: 'POST',
        url: 'add_role.php',  // Le fichier PHP pour ajouter le rôle
        data: {
            messageid: message_id,
            name: roleName
        },
        success: function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                alert('Role added successfully');
                closePopupAdRole();  // Ferme la popup après ajout
                location.reload();  // Rafraîchit la page pour voir le nouveau rôle
            } else {
                alert('Error adding role: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", error);  // Affiche toute erreur AJAX dans la console
            alert('Error adding role: ' + error);
        }
    });
});


//edit role 
document.querySelectorAll('.btn-edit-user').forEach(button => {
    button.addEventListener('click', function() {
        let row = this.closest('tr'); // Trouve la ligne parente (tr)
        let roleId = row.querySelector('td:first-child').innerText; // Récupère l'ID du rôle
        let roleName = row.querySelector('td:nth-child(2)').innerText; // Récupère le nom du rôle

        // Remplir les champs de la popup avec les valeurs existantes
        document.querySelector('input[placeholder="Administrateur"]').value = roleId;
        document.querySelector('input[placeholder="Admin"]').value = roleName;
        document.querySelector('input[placeholder="Administrateur"]').setAttribute('readonly', true);

        // Ajouter un écouteur pour sauvegarder les modifications
        document.querySelector('#edit_role').addEventListener('click', function() {
            let newRoleName = document.querySelector('input[placeholder="Admin"]').value;

            $.ajax({
                type: 'POST',
                url: 'edit_role.php',  // Fichier PHP pour gérer l'édition
                data: { id: roleId, name: newRoleName },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('Role updated successfully');
                        location.reload();  // Rafraîchir la page
                    } else {
                        alert('Error updating role: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating role: ' + error);
                }
            });
        });
        
        openPopup('editrole');  // Ouvre le popup d'édition
    });
});

///supprimer un role 
document.querySelectorAll('.btn-delete-user').forEach(button => {
    button.addEventListener('click', function() {
        let row = this.closest('tr');
        let roleId = row.querySelector('td:first-child').innerText; // ID du rôle

        // Afficher la popup de confirmation
        openPopup('deleterole');

        // Ajouter un écouteur pour confirmer la suppression
        document.querySelector('.btn-confirm-delete').addEventListener('click', function() {
            $.ajax({
                type: 'POST',
                url: 'delete_role.php',  // Fichier PHP pour gérer la suppression
                data: { id: roleId },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('Role deleted successfully');
                        location.reload();  // Rafraîchir la page
                    } else {
                        alert('Error deleting role: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting role: ' + error);
                }
            });

            // Fermer la popup après suppression
            document.getElementById('deleterole').style.display = 'none';
        });
    });
});
// Fonction pour changer le nombre de lignes affichées et rafraîchir la page
function changeRowsPerPage() {
    const rows = document.getElementById('rows').value;
    const search = document.querySelector('input[name="search"]').value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('rows', rows);
    urlParams.set('page', 1); // Retour à la première page lors du changement
    if (search) {
        urlParams.set('search', search);
    }
    window.location.search = urlParams.toString();
}

	</script>
    <style>@media (max-width: 600px) {
    .search-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .search-input {
        width: 100%;
        margin-bottom: 10px;
    }

    .table1 th, .table1 td {
        font-size: 12px;
    }

    .pagination {
        flex-direction: column;
        align-items: center;
    }

    .page-link, .page-link0 {
        font-size: 12px;
        padding: 6px 8px;
    }
}
</style>

	

    <link rel="stylesheet" href="CSS/footer.css">
    <!--pagination -->
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

        <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&rows=<?= $rowsPerPage ?>&search=<?= htmlspecialchars($search) ?>" class="page-link0"> < Previous</a>
        <?php endif; ?>

        <?php for ($page = 1; $page <= $totalPages; $page++): ?>
            <a href="?page=<?= $page ?>&rows=<?= $rowsPerPage ?>&search=<?= htmlspecialchars($search) ?>" class="page-link <?= ($page == $currentPage) ? 'active' : '' ?>"><?= $page ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&rows=<?= $rowsPerPage ?>&search=<?= htmlspecialchars($search) ?>" class="page-link0">Next ></a>
        <?php endif; ?>
    </div>
</div>
