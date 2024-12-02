<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CSS/AddUser.css">
    <style>
	

	</style>
</head>
<body>
    <main class="main-content" id="main-content">
        
        <div class="order-summary">
            
             <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i  id="btn-open-popup" class="bi bi-sliders"></i>
                    </button>
            </div>
            <button class="add-user-btn">
                <i class="bi bi-plus"></i> Add User
            </button>
        </div>
        <div class="table-container">
            <table id="myTable" class="table1">
                <thead class="entête">
                    <tr>
                        <th>First name<i class="bi bi-arrow-down"></i></th>
                        <th>Last name <i class="bi bi-arrow-down"></i></th>
                        <th>Status<i class="bi bi-arrow-down"></i></th>
                        <th>Email<i class="bi bi-arrow-down"></i></th>
						<th>Username<i class="bi bi-arrow-down"></i></th>
						<th>Password<i class="bi bi-arrow-down"></i></th>
						<th>Action<i class="bi bi-arrow-down"></i></th>
                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [
                        ['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
                        ['Antoine', 'Dupont', 'Admin',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
						['Antoine', 'Dupont', 'User',"antoinedupont@entreprise.com", 'Login',"***********************"],
                    ];

                    foreach ($data as $index => $row) {
                        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                        ?>
                        <tr class="main-row <?= $rowClass ?>">
                            <td><?= $row[0] ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td><?= $row[4] ?></td>
                            <td><?= $row[5] ?></td>
                            <td>
                                <button class="btn-edit-user" onclick="openQTYPopup()">
                                   <i class="bi bi-pencil-square"></i>&nbsp;Edit
                                 </button>
                                <button class="btn-delete-user" onclick="openPopup()">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
			
			<div id="popup-create-user" class="popup">
    <div class="popup-content">
        <div class="popup-header">
		    <span class="close-btn" onclick="closePopup()"><i class="bi bi-x-lg"></i></span>
            <h3>Create user</h3>
            
        </div>
        <form>
            <h4>Informations</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email address">
            </div>
            <div class="form-group">
                <div class="phone-select-wrapper">
                    <select class="phone-select">
                        <option value="+XXX">+XXX</option>
                    </select>
                </div>
                <input type="text" placeholder="Phone number">
            </div>
            <h4>Log informations</h4>
            <div class="form-group">
                <input type="text" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Password: XXXXXXXXXXXXXXXXXXXXXXXX</label>
                <button type="button" class="copy-btn"><i class="bi bi-copy"></i></button>
            </div>
            <button type="submit" class="btn-create">Create</button>
        </form>
    </div>
</div>

			
			
			
			<div id="popup-edit-user" class="popup">
    <div class="popup-content">
        <div class="popup-header">
		<span class="close-btn" onclick="closePopup()"><i class="bi bi-x-lg"></i></span>
            <h3>Edit user</h3>
            
        </div>
        <form>
            <h4>Informations</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email adress">
            </div>
            <div class="form-group">
                <div class="phone-select-wrapper">
    <select class="phone-select">
        <option value="+XXX">+XXX</option>
    </select>
</div>
                <input type="text" placeholder="Phone number">
            </div>
            <h4>Log informations</h4>
            <div class="form-group">
                <input type="text" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Password: XXXXXXXXXXXXXXXXXXXXXXXX</label>
                <button type="button" class="copy-btn"><i class="bi bi-copy"></i></button>
            </div>
            <button type="submit" class="btn-create">Create</button>
        </form>
    </div>
</div>


        </div>
    </main>

	
    <script src="js/readytoprint_dup.js"></script>
	<script>


function openCreateUserPopup() {
    document.getElementById('popup-create-user').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup-create-user').style.display = 'none';
    document.getElementById('popup-edit-user').style.display = 'none';
}
document.querySelector('.add-user-btn').addEventListener('click', openCreateUserPopup);

	function openQTYPopup() {
    document.getElementById('popup-edit-user').style.display = 'block';
}



	</script>
    

	
</body>
    <link rel="stylesheet" href="CSS/footer.css">
<footer class="footer">
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
   
</footer>
</html>
