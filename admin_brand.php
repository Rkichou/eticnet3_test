
<link rel="stylesheet" href="CSS/AddUser.css">
<div class="order-summary">
    
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search">
        <button class="search-btn">
            <i class="fas fa-search"></i>&nbsp &nbsp <i id="btn-open-popup" class="bi bi-sliders"></i>
        </button>
    </div>
    <button class="add-user-btn" onclick="openPopupAdBrand();">
        <img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;"> &nbsp Add Brand
    </button>
</div>
<div class="table-container">
    <table id="myTable" class="table1">
        <thead class="entête">
            <tr>
                <th>ID</th>
                <th>Brand<i class="bi bi-arrow-down"></i></th>
                <th>Prefix<i class="bi bi-arrow-down"></i></th>
                <th style="width:200px;">Actions<i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include('config.inc.php');

                // Requête pour récupérer les informations de tous les Brands
                $brandQuery = "SELECT * FROM contractors";
                $brandResult = mysqli_query($con, $brandQuery);

                foreach ($brandResult as $index => $row) {
                    $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
                    $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
            ?>
            <tr class="main-row <?= $rowClass ?>" >
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['prefix'] ?></td> 
                <td>
                    <button class="btn-edit-user" id="EditBrand">
                        <i class="bi bi-pencil-square"></i>&nbsp;Edit
                    </button>
                    <button class="btn-delete-user" id="DeleteBrand">
                        <i class="bi bi-trash3"></i>&nbsp;Delete
                    </button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- popup Edit Brand -->
<div id="editbrand" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" id="closeEB"><i class="bi bi-x-lg"></i></span>
        
        <div class="headerEcont">
            <h5 class="titreGI">Edit brand</h5>
            <p class="user-id">ID brand: 123</p>
        </div>
        <form>
            <label for="first">Brand name</label>
            <input type="text" placeholder="Brand Name">
            
            <label for="last">Prefix</label>
            <input type="text" placeholder="Prefix">
        
            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" id="edit_brand"><i class="bi bi-floppy"></i>&nbsp;Save</button>
            </div>
        </form>
    </div>
</div>

<!-- popup Add Brand -->
<div id="addbrand" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn"><i class="bi bi-x-lg" onclick="closePopupAdBrand();"></i></span>
        
        <div class="headerEcont">
            <h5 class="titreGI">Add brand</h5>
        </div>
        <form id="addBrandForm">
            <label for="brand_name">Brand name</label>
            <input type="text" id="brand_name" placeholder="Brand Name">
            
            <label for="prefix">Prefix</label>
            <input type="text" id="brand_prefix" placeholder="Prefix">
        
            <!-- Bouton Save -->
            <div class="popupAdUser-buttons">
                <button type="button" class="saveUser-btn" id="add_brand"><i class="bi bi-floppy"></i>&nbsp;Save</button>
            </div>
        </form>
    </div>
</div>

<!-- popup delete Brand -->
<div id="deletebrand" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure?</h5>
        <p>Once a brand has been deleted, you will not be able to recover its data.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel"><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete"><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>

<script src="js/readytoprint_dup.js"></script>
<script>

// Handle Edit Brand button click
document.querySelectorAll('#EditBrand').forEach(button => {
    button.addEventListener('click', function() {
        let row = this.closest('tr');
        let brandId = row.querySelector('td:first-child').innerText;
        let brandName = row.querySelector('td:nth-child(2)').innerText;
        let brandPrefix = row.querySelector('td:nth-child(3)').innerText;

        document.querySelector('input[placeholder="Brand Name"]').value = brandName;
        document.querySelector('input[placeholder="Prefix"]').value = brandPrefix;
        
        document.querySelector('#edit_brand').addEventListener('click', function() {
            let newBrandName = document.querySelector('input[placeholder="Brand Name"]').value;
            let newBrandPrefix = document.querySelector('input[placeholder="Prefix"]').value;

            $.ajax({
                type: 'POST',
                url: 'edit_brand.php',
                data: { id: brandId, name: newBrandName, prefix: newBrandPrefix },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('Brand updated successfully');
                        location.reload();
                    } else {
                        alert('Error updating brand: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error updating brand: ' + error);
                }
            });
        });

        openPopup('editbrand');
    });
});

// Handle Add Brand button click
document.querySelector('#add_brand').addEventListener('click', function() {
    let brandName = document.querySelector('#brand_name').value.trim();
    let brandPrefix = document.querySelector('#brand_prefix').value.trim();

    if (brandName === '' || brandPrefix === '') {
        alert('Please fill in all fields!');
        return;
    }

    $.ajax({
        type: 'POST',
        url: 'add_brand.php',
        data: { name: brandName, prefix: brandPrefix },
        success: function(response) {
            let data = JSON.parse(response);
            if (data.status === 'success') {
                alert('Brand added successfully');
                closePopupAdBrand();
                location.reload();
            } else {
                alert('Error adding brand: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            alert('Error adding brand: ' + error);
        }
    });
});

// Handle Delete Brand button click
document.querySelectorAll('#DeleteBrand').forEach(button => {
    button.addEventListener('click', function() {
        let row = this.closest('tr');
        let brandId = row.querySelector('td:first-child').innerText;

        openPopup('deletebrand');

        document.querySelector('.btn-confirm-delete').addEventListener('click', function() {
            $.ajax({
                type: 'POST',
                url: 'delete_brand.php',
                data: { id: brandId },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        alert('Brand deleted successfully');
                        location.reload();
                    } else {
                        alert('Error deleting brand: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting brand: ' + error);
                }
            });

            document.getElementById('deletebrand').style.display = 'none';
        });
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

