<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/AddUser_dup.css">
    <style>
	
       .btn-edit-word, .btn-delete-word {
            padding: 3px 6px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-edit-word {
            background-color: #555555;
            color: #fff;
        }
        .btn-delete-word {
            background-color: #e31313;
            color: white;
        }
        .btn-edit-word:hover {
			background-color: #353333;	
		}
        .btn-delete-word:hover {
			background-color: #9b1515;	
		}
      .add-word-btn {
    background-color: #59A735; 
    color: white; 
    padding: 8px 16px; 
    border: none; 
    border-radius: 12px; 
    font-size: 14px; 
    display: flex; 
    align-items: center; 
    cursor: pointer; 
	margin-left: 1%;
	
   }

   .add-word-btn i {
    margin-right: 8px;
    font-size: 20px; 
   }

   .add-word-btn:hover {
    background-color: #45a049; 
   }
   
   
   .popup-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 33%;
    height: 467px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
}

.popup-content h3 {
    margin-top: 0;
    margin-bottom: 20px;
}

.form-group {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.form-group label {
  margin-right: 10px;
  text-align: left;
  width: 20%;
}

.form-group input {
  width: 61%;
  height: 30px;
  padding: 8px 12px;
  margin-top: 0;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
}

		
.btn-create {
    background-color: #81C441;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: -1%;;
    float: right;

	font-size: 14px;
}
.btn-create:hover {
	background-color: #4CAF50;
}
.closeWord-btn, .closeWord2-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
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
            <button class="add-word-btn">
                <i class="bi bi-plus"></i> Add Words
            </button>
        </div>
        <div class="table-container">
            <table id="myTable" class="table1">
                <thead class="entête">
                    <tr>
                        <th>English<i class="bi bi-arrow-down"></i></th>
                        <th>Korean <i class="bi bi-arrow-down"></i></th>
                        <th>Chinese<i class="bi bi-arrow-down"></i></th>
                        <th>French<i class="bi bi-arrow-down"></i></th>
						<th>Japanese<i class="bi bi-arrow-down"></i></th>
						<th>Russian<i class="bi bi-arrow-down"></i></th>
						<th>Action<i class="bi bi-arrow-down"></i></th>
                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [
                        ['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
						['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
						['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
						['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
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
                                <button class="btn-edit-word">
                                  <i class="bi bi-pencil-square"></i>&nbsp
								Edit</button>
                                <button class="btn-delete-word">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

	
    <script src="js/readytoprint_dup.js"></script>
    
<!-- piopup add word -->
<div id="addWordPopup" class="popup-container" style="display: none;">
    <div class="popup-content">
        <h3>Add word</h3>
        <form>
            <div class="form-group">
                <label for="english">English</label>
                <input type="text" id="english" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="korean">Korean</label>
                <input type="text" id="korean" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="chinese">Chinese</label>
                <input type="text" id="chinese" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="french">French</label>
                <input type="text" id="french" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="japanese">Japanese</label>
                <input type="text" id="japanese" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="russian">Russian</label>
                <input type="text" id="russian" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="arabic">Arabic</label>
                <input type="text" id="arabic" placeholder="Translation">
            </div>
            <button type="button" class="btn-create">Create</button>
        </form>
        <button class="closeWord-btn"><i class="bi bi-x-lg"></i></button>
    </div>
</div>

<!-- piopup Edit word -->
<div id="editWordPopup" class="popup-container" style="display: none;">
    <div class="popup-content">
        <h3>Edit word</h3>
        <form>
            <div class="form-group">
                <label for="english">English</label>
                <input type="text" id="english" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="korean">Korean</label>
                <input type="text" id="korean" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="chinese">Chinese</label>
                <input type="text" id="chinese" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="french">French</label>
                <input type="text" id="french" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="japanese">Japanese</label>
                <input type="text" id="japanese" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="russian">Russian</label>
                <input type="text" id="russian" placeholder="Translation">
            </div>
            <div class="form-group">
                <label for="arabic">Arabic</label>
                <input type="text" id="arabic" placeholder="Translation">
            </div>
            <button type="button" class="btn-create">Save</button>
        </form>
        <button class="closeWord2-btn"><i class="bi bi-x-lg"></i></button>
    </div>
</div>	


 <!-- popup delete supp --> 
 <div id="deletePopup" class="deletePopup">
    <div class="deletePopup-content">
        <h5> Are you sure to remove this word ?</h5>
        
        <div class="deletePopup-buttons">
            <button class="btn-cancel" >Ne pas supprimer</button>
            <button class="btn-confirm-delete" >Supprimer</button>
        </div>
    </div>
</div>
</body>
<script>
// Fonction pour ouvrir la popup "Add Word"
function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}

// Fonction pour fermer la popup
function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}

// Ajouter des écouteurs d'événements aux boutons
document.querySelector('.add-word-btn').addEventListener('click', () => openPopup('addWordPopup'));
document.querySelector('.btn-edit-word').addEventListener('click', () => openPopup('editWordPopup'));
document.querySelector('.btn-delete-word').addEventListener('click', () => openPopup('deletePopup'));

document.querySelector('.closeWord-btn').addEventListener('click', () => closePopup('addWordPopup'));
document.querySelector('.closeWord2-btn').addEventListener('click', () => closePopup('editWordPopup'));
document.querySelector('.btn-cancel').addEventListener('click', () => closePopup('deletePopup'));

</script>

    <link rel="stylesheet" href="css/footer_dup.css">
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
