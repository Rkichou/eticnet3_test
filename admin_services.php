<link rel="stylesheet" href="CSS/AddUser.css">
<link rel="stylesheet" href="CSS/PS_dashboard.css">
<style>/* Style pour le conteneur du pop-up */
.popupS-container {
    position: fixed; /* Positionnement fixe pour rester en place */
    top: 0; /* En haut */
    left: 0; /* À gauche */
    width: 100%; /* Prend toute la largeur de l'écran */
    height: 100%; /* Prend toute la hauteur de l'écran */
    background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
    display: flex; /* Utiliser flexbox */
    justify-content: center; /* Centrer horizontalement */
    align-items: center; /* Centrer verticalement */
    z-index: 1000; /* S'assurer que le pop-up est au-dessus des autres éléments */
    display: none; /* Masquer par défaut */
}

/* Style pour le contenu du pop-up */
.popupS-content {
    background-color: white; /* Couleur de fond */
    border-radius: 8px; /* Coins arrondis */
    padding: 20px; /* Espacement interne */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre pour donner un effet de profondeur */
    max-width: 500px; /* Largeur maximale */
    width: 90%; /* Largeur par défaut */
}

/* Style pour le pop-up de suppression */
.deletePopup {
    position: fixed; /* Même positionnement fixe */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    display: none; /* Masquer par défaut */
}

/* Style pour le contenu du pop-up de suppression */
.deletePopup-content {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    max-width: 400px; /* Largeur maximale pour le pop-up de suppression */
    width: 80%; /* Largeur par défaut pour le pop-up de suppression */
}
</style>
<div class="order-summary">
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search">
        <button class="search-btn">
            <i class="fas fa-search"></i>&nbsp;&nbsp;<i id="btn-open-popup" class="bi bi-sliders"></i>
        </button>
    </div>
    <button class="add-user-btn" onclick="openPopup('addservice');">
        <img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;"> &nbsp; Add service
    </button>
</div>
<div class="table-container">
    <table id="myTable" class="table1">
        <thead class="entête">
            <tr>
                <th>ID</th>
                <th>Prefix contractor<i class="bi bi-arrow-down"></i></th>
                <th>Code service<i class="bi bi-arrow-down"></i></th>
                <th>Name<i class="bi bi-arrow-down"></i></th>
                <th style="width:200px;">Actions<i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        include('config.inc.php');

        // Requête pour récupérer les informations de tous les services
        $userQuery = "SELECT * FROM services";
        $userResult = mysqli_query($con, $userQuery);
        
        foreach ($userResult as $index => $row) {
            $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
            <tr class="main-row <?= $rowClass ?>">
                <td><?= $row['id'] ?></td>
                <td><?= $row['prefix_contractor'] ?></td>
                <td><?= $row['code_service'] ?></td>
                <td><?= $row['name'] ?></td>
                <td>
                    <button class="btn-edit-user" data-id="<?= $row['id'] ?>">
                        <i class="bi bi-pencil-square"></i>&nbsp;Edit
                    </button>
                    <button class="btn-delete-user" data-id="<?= $row['id'] ?>">
                        <i class="bi bi-trash3"></i> Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- popup Edit service -->
<div id="editservice" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeES"><i class="bi bi-x-lg"></i></span>
        <div class="headerEcont">
            <h5 class="titreGI">Edit service</h5>
        </div>
        <form>
            <label for="edit_prefix">Prefix contractor</label>
            <input type="text" id="edit_prefix" placeholder="Prefix Contractor">
            
            <label for="edit_code">Code service</label>
            <input type="text" id="edit_code" placeholder="Code Service">
            
            <label for="edit_name">Name</label>
            <input type="text" id="edit_name" placeholder="Service Name">
            
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" id="edit_service"><i class="bi bi-floppy"></i>&nbsp; Save</button>
            </div>
        </form>
    </div>
</div>

<!-- popup Add service -->
<div id="addservice" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup('addservice');"><i class="bi bi-x-lg"></i></span>
        <div class="headerEcont">
            <h5 class="titreGI">Add service</h5>
        </div>
        <form id="addServiceForm">
            <label for="add_prefix">Prefix contractor</label>
            <input type="text" id="add_prefix" placeholder="Prefix Contractor">
            
            <label for="add_code">Code service</label>
            <input type="text" id="add_code" placeholder="Code Service">
            
            <label for="add_name">Name</label>
            <input type="text" id="add_name" placeholder="Service Name">
            
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" id="add_service"><i class="bi bi-floppy"></i>&nbsp; Save</button>
            </div>
        </form>
    </div>
</div>

<!-- popup delete service -->
<div id="deleteservice" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure?</h5>
        <p>Once a service has been deleted, you will not be able to recover its data.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel"><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete"><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>

<script src="js/readytoprint_dup.js"></script>
<script>
    // Open popup function
    function openPopup(popupId) {
        document.getElementById(popupId).style.display = 'flex';
    }

    // Close popup function
    function closePopup(popupId) {
        document.getElementById(popupId).style.display = 'none';
    }

    // Add service
    document.querySelector('#add_service').addEventListener('click', function() {
        let prefix = document.querySelector('#add_prefix').value.trim();
        let code = document.querySelector('#add_code').value.trim();
        let name = document.querySelector('#add_name').value.trim();

        if (prefix === '' || code === '' || name === '') {
            alert('Please fill in all fields!');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'add_service.php',
            data: {
                prefix: prefix,
                code: code,
                name: name
            },
            success: function(response) {
                let data = JSON.parse(response);
                
                    alert('Service added successfully');
                    closePopup('addservice');
                    location.reload();
                
            },
            error: function(xhr, status, error) {
                alert('Error adding service: ' + error);
            }
        });
    });

    // Edit service
    document.querySelectorAll('.btn-edit-user').forEach(button => {
        button.addEventListener('click', function() {
            let row = this.closest('tr');
            let serviceId = this.getAttribute('data-id');
            let prefix = row.cells[1].innerText;
            let code = row.cells[2].innerText;
            let name = row.cells[3].innerText;

            document.querySelector('#edit_prefix').value = prefix;
            document.querySelector('#edit_code').value = code;
            document.querySelector('#edit_name').value = name;

            document.querySelector('#edit_service').onclick = function() {
                $.ajax({
                    type: 'POST',
                    url: 'edit_service.php',
                    data: {
                        id: serviceId,
                        prefix: document.querySelector('#edit_prefix').value.trim(),
                        code: document.querySelector('#edit_code').value.trim(),
                        name: document.querySelector('#edit_name').value.trim()
                    },
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.status === 'success') {
                            alert('Service updated successfully');
                            location.reload();
                        } else {
                            alert('Error updating service: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error updating service: ' + error);
                    }
                });
            };

            openPopup('editservice');
        });
    });

    // Delete service
    document.querySelectorAll('.btn-delete-user').forEach(button => {
        button.addEventListener('click', function() {
            let serviceId = this.getAttribute('data-id');
            openPopup('deleteservice');

            document.querySelector('.btn-confirm-delete').onclick = function() {
                $.ajax({
                    type: 'POST',
                    url: 'delete_service.php',
                    data: { id: serviceId },
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.status === 'success') {
                            alert('Service deleted successfully');
                            location.reload();
                        } else {
                            alert('Error deleting service: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting service: ' + error);
                    }
                });
                closePopup('deleteservice');
            };
        });
    });

    // Close popup cancel buttons
    document.querySelectorAll('.btn-cancel').forEach(button => {
        button.addEventListener('click', function() {
            closePopup('deleteservice');
        });
    });
    
    document.querySelector('#closeES').addEventListener('click', function() {
        closePopup('editservice');
    });
</script>

<link rel="stylesheet" href="CSS/footer.css">
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
