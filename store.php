<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/store_dup.css">

</head>
<body>
    <main class="main-content" id="main-content">
        <div class="filter-section">
            <button class="filter-btn active" data-status="all">
                <img src="Image/all.png" alt="Dashboard" class="navbar-iconN">All
            </button>
            <button class="filter-btn" data-status="Woven label">
                <img src="Image/woven.png" alt="Dashboard" class="navbar-iconN">Woven label
            </button>
            <button class="filter-btn" data-status="Hangtag">
                <img src="Image/hangtags.png" alt="Dashboard" class="navbar-iconN">Hangtags
            </button>
            <button class="filter-btn" data-status="Sticker">
                <img src="Image/stickers.png" alt="Dashboard" class="navbar-iconN">Stickers
            </button>
            <button class="filter-btn" data-status="Ropes">
                <img src="Image/ropes.png" alt="Dashboard" class="navbar-iconN">Ropes
            </button>
            <button class="filter-btn" data-status="Packaging">
                <img src="Image/packaging.png" alt="Dashboard" class="navbar-iconN">Packaging
            </button>
            <button class="filter-btn" data-status="Ribbon">
                <img src="Image/ribbon.png" alt="Dashboard" class="navbar-iconN">Ribbon
            </button>
            <button class="filter-btn" data-status="Ink">
                <img src="Image/ink.png" alt="Dashboard" class="navbar-iconN">Ink
            </button>
            <div class="status-summary">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Rechercher">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="cart-container">
                    <button class="cart-btn">
                        Cart
                        <img src="Image/cart.png" alt="Dashboard" class="navbar-iconCart">
                    </button>
                </div>
            </div>
        </div>
        <div class="order-summary">
            <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select">
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
                <span>rows</span>
                <select id="sites" name="sites" class="sites-select">
                    <option value="all">All sites</option>
                </select>
            </div>
            <button class="extract-stock-btn">
                <img src="Image/imprtPO.png" alt="Dashboard" class="navbar-iconOrderSum">Extract stock
            </button>
            <select id="unwrap" name="unwrap" class="unwrap-select">
                <option value="all">Unwrap</option>
            </select>
        </div>
        <div class="table-responsive">
            <table class="table1">
                <thead class="entête">
                    <tr>
                        <th>Customer Ref <i class="bi bi-arrow-down"></i></th>
                        <th>Internal ref</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Sales unit</th>
                        <th>Price / unity</th>
                        <th>In stock</th>
                        <th>In progress</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [
                        ['CD201', 'Internal ref', 'Carte information', 'Hangtag', '150pcs', '15€', '50 000', '100 000'],
                        ['CD202', 'Internal ref', 'Carte information', 'Sticker', '150pcs', '15€', '50 000', '100 000'],
						['CD206', 'Internal ref', 'Carte information', 'Ink', '150pcs', '15€', '50 000', '100 000'],
						['CD202', 'Internal ref', 'Carte information', 'Sticker', '150pcs', '15€', '50 000', '100 000'],
                        ['CD203', 'Internal ref', 'Carte information', 'Hangtag', '150pcs', '15€', '50 000', '100 000'],
                        ['CD204', 'Internal ref', 'Carte information', 'Sticker', '150pcs', '15€', '50 000', '100 000'],
                        ['CD205', 'Internal ref', 'Carte information', 'Hangtag', '150pcs', '15€', '50 000', '100 000'],
                        ['CD206', 'Internal ref', 'Carte information', 'Ink', '150pcs', '15€', '50 000', '100 000'],
						['CD206', 'Internal ref', 'Carte information', 'Ribbon', '150pcs', '15€', '50 000', '100 000'],
						['CD206', 'Internal ref', 'Carte information', 'Ribbon', '150pcs', '15€', '50 000', '100 000'],
						['CD206', 'Internal ref', 'Carte information', 'Ink', '150pcs', '15€', '50 000', '100 000'],
						['CD202', 'Internal ref', 'Carte information', 'Sticker', '150pcs', '15€', '50 000', '100 000'],
                        ['CD207', 'Internal ref', 'Carte information', 'Hangtag', '150pcs', '15€', '50 000', '100 000'],
						['CD206', 'Internal ref', 'Carte information', 'Ribbon', '150pcs', '15€', '50 000', '100 000'],
                    ];

                    foreach ($data as $index => $row) {
                        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
                        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                        ?>
                        <tr class="main-row <?= $rowClass ?>">
                            <td><span class="icon <?= $btnClass ?>" onclick="toggleDetails(this)">+</span> <?= $row[0] ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td><?= $row[4] ?></td>
                            <td><?= $row[5] ?></td>
                            <td><?= $row[6] ?></td>
                            <td><?= $row[7] ?></td>
                            <td>
                                <button class="btn-QTY" onclick="openQTYPopup()">
                                  <i class="bi bi-shield-check"></i>&nbsp
								QTY per site</button>
                                <button class="btn-Place" onclick="openPopup()">
								<img src="Image/placeOr.png" alt="Dashboard" class="navbar-iconPlace">
								Place order</button>
                            </td>
                        </tr>
                        <tr class="details-row">
                            <td colspan="9">
                                <div class="details-content">
                                    <img src="Image/Image1.png" alt="Image 1" class="Image">
                                    <img src="Image/Image2.png" alt="Image 2" class="Image">
                                    <div class="details-container">

    <div class="details-info details-info1">
        <h5>General informations:</h5>
		<div class="soustitre">
        Unit's weight: <br>
        Packaging size: <br>
        Packaging weight:<br>
        HS Code: <br>
        Upload RTP: <br>
		Designation:
		</div>
	    
		<p>Lorem ipsum dolor sit amet consectetur.<br> Turpis duis donec sed nulla pulvinar. <br> Auctor nullam turpis pellentesque tortor feugiat.<br> Sed tortor vitae purus sed cursus luctus egestas.<p>

    </div>
	<div class="details-info details-info3">
       <strong></strong><br><br>
        25gr<br>
        15*25*25cm<br>
        2kg<br>
        477888315202<br>
		<div class="btnUP">
        <button class="btn-UP" onclick="openPopupUP()"><i class="bi bi-upload"></i></button>
		</div>
    </div>
    <div class="details-info details-info2">
        <h5>RFID informations:</h5>
		<div class="soustitre">
        Chipset: <br><br>
        Frequency: <br><br><br><br><br>
		</div>
        <div class="btns">
            <button class="btn-datasheet"><i class="bi bi-download"></i></i>&nbsp; Datasheet</button>
            <button class="btn-delete"><i class="bi bi-trash3"></i> &nbsp; Ask to delete</button>
        </div>
    </div>
	<div class="details-info details-info4">
        <strong></strong><br>
        N/A<br><br>
        N/A<br><br><br><br>
        
    </div>
</div>

									
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
	<!-- popup place OR-->
	 <div id="popup" class="popup">
        <div class="popup-content">
            
            <div class="popup-header">
                <h4 class="left-align2">CD201</h4>				
                <button class="popup-delete"><img src="Image/deletepopup.png" alt="Delete" class="popup-delete-icon"></button>
				<span class="close" onclick="closePopup()"><i class="bi bi-x-lg"></i></span>
            </div>
            <div class="popup-body">
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="popup-footer">
                <button class="popup-add-site">+ Add site</button>
                <button class="popup-validate">Validate</button>
            </div>
        </div>
    </div>
	<!-- popup UP RTP-->
	 <div id="popupUP" class="popupUP">
        <div class="popupUP-content">
            <span class="closeUP" onclick="closePopupUP()"><i class="bi bi-x-lg"></i></span>
            <h5 class="left-align">Upload RTP</h5>
            <div class="file-upload">
                <label for="file-input" class="file-label" >
                    <span class="file-text" >Choose file (.pdf)</span>
                    <i class="bi bi-upload"></i>
                </label>
                <input id="file-input" type="file" accept=".pdf" class="file-input">
            </div>
            <div class="font-file">
                <button class="add-font-btn"><i class="bi bi-plus-square"></i></button>
                <span class="file-text2">Add font file (recommended)</span>
            </div>
            <button class="validateUP-btn">Validate</button>
        </div>
    </div>
	<!-- popup QTY-->
	<div id="qtyPopup" class="popupQTY">
        <div class="popupQTY-content">
            <span class="closeQTY" onclick="closeQTYPopup()"><i class="bi bi-x-lg"></i></span>
            <h4 class="left-align">Quantity per site</h4>
            <table class = "tableQTY">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>In stock</th>
                        <th>In progress</th>
                        <th>Min stock qty</th>
                        <th class="new-min-qty-header">New min qty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bangladesh</td><td>10 000 000</td><td>-</td><td>10 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
                    <!-- Ajoutez ici les autres lignes de pays comme montré précédemment -->
                    <!-- Exemple pour un autre pays -->
                    <tr>
                        <td>China</td><td>10 000 000</td><td>5 000</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
					<tr>
                        <td>Egypt</td><td>10 000 000</td><td>43 000</td><td>5 000</td>
                        <td class="new-min-qty"><input type="text" value="5 000"></td>
                    </tr>
					<tr>
                        <td>Greece</td><td style="color: red;">5 000</td><td>-</td><td>26 000</td>
                        <td class="new-min-qty"><input type="text" value="26 000"></td>
                    </tr>
					<tr>
                        <td>Italy</td><td>10 000 000</td><td>32 134</td><td>20 000</td>
                        <td class="new-min-qty"><input type="text" value="20 000"></td>
                    </tr>
					<tr>
                        <td>India</td><td>10 000 000</td><td>10 000 000</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
					<tr>
                        <td>Morocco</td><td style="color: red;">8 000</td><td>10 432</td><td>50 000</td>
                        <td class="new-min-qty"><input type="text" value="50 000"></td>
                    </tr>
					<tr>
                        <td>Portugal</td><td>10 000 000</td><td>10 000 000</td><td>1 000 000</td>
                        <td class="new-min-qty"><input type="text" value="50 000"></td>
                    </tr>
					<tr>
                        <td>Tunisia</td><td>10 000 000</td><td>-</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
					<tr>
                        <td>Turkey</td><td>10 000 000</td><td>10 000 000</td><td>30 000</td>
                        <td class="new-min-qty"> <input type="text" value="30 000"></td>
                    </tr>
					<tr>
                        <td>Vietnam</td><td>10 000 000</td><td>10 000 000</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
                </tbody>
            </table>
            <button class="edit-btn" onclick="enterEditMode()"><i class="fas fa-edit"></i> Edit</button>
			<button class="cancel-btn" onclick="cancelChanges()" style="display:none;">&times; Cancel</button>
            <button class="submit-btn" onclick="submitChanges()" style="display:none;"><img src="Image/submit.png" alt="Upload Icon" class="submit-icon">Submit</button>
        </div>
    </div>
    <script src="js/store_dup.js"></script>
</body>
    <link rel="stylesheet" href="css/footer_dup.css">
<footer class="footer">
     <div class="pagination">
        <a href="#" class="page-link0"> < Previous</a>
        <a href="#" class="page-link">1</a>
        <a href="#" class="page-link">2</a>
        <a href="#" class="page-link">3</a>
        <a href="#" class="page-link">4</a>
        <a href="#" class="page-link0">Next ></a>
    </div>
   
</footer>
</html>
