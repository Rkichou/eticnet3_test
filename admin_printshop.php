<link rel="stylesheet" href="CSS/AddUser.css">
<div class="order-summary">
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search">
        <button class="search-btn">
            <i class="fas fa-search"></i>&nbsp &nbsp 
            <i id="btn-open-popup" class="bi bi-sliders"></i>
        </button>
    </div>
    <button class="add-user-btn" onclick="openPopupAddPrintshop();">
        <img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;"> &nbsp Add Printshop
    </button>
</div>

<div class="table-container">
    <table id="myTable" class="table1">
        <thead class="entête">
            <tr>
                <th>ID</th>
                <th>Country <i class="bi bi-arrow-down"></i></th>
                <th>Contact <i class="bi bi-arrow-down"></i></th>
                <th style="width:200px;">Actions <i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
        <?php 
        include('config.inc.php');

        // Requête pour récupérer les informations des Printshops
        $printshopQuery = "SELECT * FROM printshop";
        $printshopResult = mysqli_query($con, $printshopQuery);

        foreach ($printshopResult as $index => $row) {
            $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
            ?>
            <tr class="main-row <?= $rowClass ?>">
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['contact'] ?></td>
                <td>
                    <button class="btn-edit-user" id="EditPrintshop" data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>" data-contact="<?= $row['contact'] ?>">
                        <i class="bi bi-pencil-square"></i>&nbsp;Edit
                    </button>
                    <button class="btn-delete-user" id="DeletePrintshop" data-id="<?= $row['id'] ?>">
                        <i class="bi bi-trash3"></i>&nbsp;Delete
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Popup Add Printshop -->
<div id="addprintshop" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopupAddPrintshop();"><i class="bi bi-x-lg"></i></span>
        <div class="headerEcont">
            <h5 class="titreGI">Add Printshop</h5>
        </div>
        <form id="addPrintshopForm">
            <label for="newPrintshopName">Printshop Name</label>
            <input type="text" id="newPrintshopName" required>
            <label for="newPrintshopContact">Contact</label>
            <input type="text" id="newPrintshopContact" required>
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" onclick="addNewPrintshop()">
                    <i class="bi bi-floppy"></i>&nbsp Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Popup Edit Printshop -->
<div id="editprintshop" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeEps"><i class="bi bi-x-lg"></i></span>
        <div class="headerEcont">
            <h5 class="titreGI">Edit Printshop</h5>
            <p class="user-id" id="editPrintshopID"></p>
        </div>
        <form id="editPrintshopForm">
            <label for="editPrintshopName">Printshop Name</label>
            <input type="text" id="editPrintshopName" required>
            <label for="editPrintshopContact">Contact</label>
            <input type="text" id="editPrintshopContact" required>
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" onclick="saveEditedPrintshop()">
                    <i class="bi bi-floppy"></i>&nbsp Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Popup Delete Printshop -->
<div id="deleteprintshop" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure?</h5>
        <p>Once a Printshop has been deleted, it cannot be recovered.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel"><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" onclick="deletePrintshopConfirmed()">
                <i class="bi bi-trash3"></i>&nbsp;Delete
            </button>
        </div>
    </div>
</div>

<script src="js/readytoprint_dup.js"></script>
<script>
    let deletePrintshopId;

    document.querySelectorAll('#EditPrintshop').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const name = button.dataset.name;
            const contact = button.dataset.contact;
            document.getElementById('editPrintshopID').innerText = "ID Printshop: " + id;
            document.getElementById('editPrintshopName').value = name;
            document.getElementById('editPrintshopContact').value = contact;
            openPopup('editprintshop');
        });
    });

    document.querySelectorAll('#DeletePrintshop').forEach(button => {
        button.addEventListener('click', () => {
            deletePrintshopId = button.dataset.id;
            openPopup('deleteprintshop');
        });
    });
// Fonction pour ouvrir le popup "Add Printshop"
function openPopupAddPrintshop() {
    document.getElementById('addprintshop').style.display = 'block';
}

// Fonction pour fermer le popup "Add Printshop"
function closePopupAddPrintshop() {
    document.getElementById('addprintshop').style.display = 'none';
}

    function saveEditedPrintshop() {
        const id = document.getElementById('editPrintshopID').innerText.replace('ID Printshop: ', '');
        const name = document.getElementById('editPrintshopName').value;
        const contact = document.getElementById('editPrintshopContact').value;

        // AJAX request to update the Printshop
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'edit_printshop.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status === 200) {
                alert('Printshop updated successfully!');
                location.reload();
            }
        };
        xhr.send(`id=${id}&name=${name}&contact=${contact}`);
    }

    function addNewPrintshop() {
        const name = document.getElementById('newPrintshopName').value;
        const contact = document.getElementById('newPrintshopContact').value;

        // AJAX request to add a new Printshop
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_printshop.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status === 200) {
                alert('New Printshop added successfully!');
                location.reload();
            }
        };
        xhr.send(`name=${name}&contact=${contact}`);
    }

    function deletePrintshopConfirmed() {
        // AJAX request to delete the Printshop
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_printshop.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status === 200) {
                alert('Printshop deleted successfully!');
                location.reload();
            }
        };
        xhr.send(`id=${deletePrintshopId}`);
    }

    document.querySelectorAll('.btn-cancel').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('deleteprintshop').style.display = 'none';
        });
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
