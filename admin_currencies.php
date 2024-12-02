<link rel="stylesheet" href="CSS/AddUser.css">

<!-- Section de recherche et ajout de devises -->
<div class="order-summary">
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search">
        <button class="search-btn">
            <i class="fas fa-search"></i>&nbsp &nbsp 
            <i id="btn-open-popup" class="bi bi-sliders"></i>
        </button>
    </div>
    <button class="add-user-btn" onclick="openPopupAdCurrency();">
        <img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;"> &nbsp Add Currency
    </button>
</div>

<!-- Table des devises -->
<div class="table-container">
    <table id="myTable" class="table1">
        <thead class="entête">
            <tr>
                <th>ID</th>
                <th>Name <i class="bi bi-arrow-down"></i></th>
                <th>Parity to Euro <i class="bi bi-arrow-down"></i></th>
                <th style="width:200px;">Actions <i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('config.inc.php');
            
            // Récupération des devises de la BDD
            $currencyQuery = "SELECT * FROM devises";
            $currencyResult = mysqli_query($con, $currencyQuery);
            
            foreach ($currencyResult as $index => $row) {
                $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                ?>
                <tr class="main-row <?= $rowClass ?>">
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['parity_euro'] ?></td>
                    <td>
                        <button class="btn-edit-user" id="EditCurrency" data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>" data-parity="<?= $row['parity_euro'] ?>">
                            <i class="bi bi-pencil-square"></i>&nbsp;Edit
                        </button>
                        <button class="btn-delete-user" id="DeleteCurrency" data-id="<?= $row['id'] ?>">
                            <i class="bi bi-trash3"></i>&nbsp;Delete
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Popup Edit currency -->
<div id="editcurrency" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeECu"><i class="bi bi-x-lg"></i></span>
        <div class="headerEcont">
            <h5 class="titreGI">Edit currency</h5>
            <p class="user-id" id="editCurrencyID"></p>
        </div>
        <form id="editCurrencyForm">
            <label for="currencyName">Currency name</label>
            <input type="text" id="editCurrencyName">
            <label for="currencyParity">Parity to Euro</label>
            <input type="text" id="editCurrencyParity">
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" onclick="saveEditedCurrency()">
                    <i class="bi bi-floppy"></i>&nbsp Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Popup Add currency -->
<div id="addcurrency" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopupAdCurrency();">
            <i class="bi bi-x-lg"></i>
        </span>
        <div class="headerEcont">
            <h5 class="titreGI">Add currency</h5>
        </div>
        <form id="addCurrencyForm">
            <label for="newCurrencyName">Currency name</label>
            <input type="text" id="newCurrencyName">
            <label for="newCurrencyParity">Parity to Euro</label>
            <input type="text" id="newCurrencyParity">
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" onclick="addNewCurrency()">
                    <i class="bi bi-floppy"></i>&nbsp Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Popup delete currency -->
<div id="deletecurrency" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure?</h5>
        <p>Once a currency has been deleted, you will not be able to recover its data.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel"><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" onclick="deleteCurrencyConfirmed()">
                <i class="bi bi-trash3"></i>&nbsp;Delete
            </button>
        </div>
    </div>
</div>

<!-- JavaScript pour gérer les actions sur les devises -->
<script src="js/readytoprint_dup.js"></script>
<script>
    let deleteCurrencyId;

    document.querySelectorAll('#EditCurrency').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const name = button.dataset.name;
            const parity = button.dataset.parity;
            document.getElementById('editCurrencyID').innerText = "ID currency: " + id;
            document.getElementById('editCurrencyName').value = name;
            document.getElementById('editCurrencyParity').value = parity;
            openPopup('editcurrency');
        });
    });

    document.querySelectorAll('#DeleteCurrency').forEach(button => {
        button.addEventListener('click', () => {
            deleteCurrencyId = button.dataset.id;
            openPopup('deletecurrency');
        });
    });

    function saveEditedCurrency() {
        const id = document.getElementById('editCurrencyID').innerText.replace('ID currency: ', '');
        const name = document.getElementById('editCurrencyName').value;
        const parity = document.getElementById('editCurrencyParity').value;

        // Appel AJAX pour mettre à jour la devise
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'edit_currencies.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status === 200) {
                alert('Currency updated successfully!');
                location.reload();
            }
        };
        xhr.send(`id=${id}&name=${name}&parity_euro=${parity}`);
    }

    function addNewCurrency() {
        const name = document.getElementById('newCurrencyName').value;
        const parity = document.getElementById('newCurrencyParity').value;

        // Appel AJAX pour ajouter une nouvelle devise
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_currencies.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status === 200) {
                alert('New currency added successfully!');
                location.reload();
            }
        };
        xhr.send(`name=${name}&parity_euro=${parity}`);
    }

    function deleteCurrencyConfirmed() {
        // Appel AJAX pour supprimer la devise
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_currencies.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (this.status === 200) {
                alert('Currency deleted successfully!');
                location.reload();
            }
        };
        xhr.send(`id=${deleteCurrencyId}`);
    }

    document.querySelectorAll('.btn-cancel').forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('deletecurrency').style.display = 'none';
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
