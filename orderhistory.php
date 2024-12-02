<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
	<link rel="stylesheet" href="css/orderhistory_dup.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<style>
/* Style pour la popup Place Order */
.popup {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

.popup-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 30px;
    border: 1px solid #888;
    width: 40%;
    border-radius: 25px;
    display: flex;
    flex-direction: column;
    align-items: center;

}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
	margin-left : -7%;
	margin-top: -7%;

}

.close:hover, .popup-cancel:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.popup-header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}


.popup-delete {
    background: none;
    border: none;
    cursor: pointer;
	margin-left: 79%;
	margin-top : 10%;
	
}

.popup-delete-icon {
    width: 35px;
    height: 35px;
	
}

.popup-body {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0;
}


.popup-select {
    width: 65%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
	margin-right : 10px;
}
.popup-input{
    width: 35%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
}
.popup-cancel {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #aaa;
	margin-left: 10px;
}

.popup-footer {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.popup-add-site,
.popup-validate {
    background-color: #59A735;
    color: white;
    padding: 7px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.popup-validate {
    background-color: #59A735;
}

.popup-add-site {
    background-color: transparent;
    color: #000;
    display: flex;
    align-items: center;
    cursor: pointer;
}

.popup-add-site::before {
    margin-right: 5px;
}
.left-align2 {
    text-align: left;
	font-weight: bold;
    margin-top: -5%;
}
</style>
<body>
    <main class="main-content" id="main-content">
	    <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i  id="btn-open-popup" class="bi bi-sliders"></i>
                    </button>
                </div>
          </div>
          
        
        <div class="table-responsive">
            <table class="table1">
                <thead class="entête">
                    <tr>
                        <th>Order’s number <i class="bi bi-arrow-down"></i></th>
                        <th>Date <i class="bi bi-arrow-down"></i></th>
						<th>Price <i class="bi bi-arrow-down"></i></th>
						<th>Ordered by</th>
						<th>Tracking number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [
                        ['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
                        ['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
						['num commande', 'XX/XX/XXXX', '100 000,00 €', 'Nom Prénom - Company', 'Tracking number'],
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

                            <td>
                                <button class="btn-Bill" onclick="openQTYPopup()">
								<i class="bi bi-download"></i>&nbsp; 
								Bill</button>
                                <button class="btn-Place" onclick="openPopup()">
								<img src="Image/placeOr.png" alt="Dashboard" class="navbar-iconPlace"> 
								Re-order</button>
                            </td>
                        </tr>
                        <tr class="details-row">
    <td colspan="9">
        <div class="details-content">
            <div class="details-container">
                <div class="details-info details-info1">
                    <strong style="font-size: 18px; font-weight: bold; padding-right: 170px;">Order summary :</strong><br>
					
                    <table class="order-summary1">
	<thead class="entête1">				
    <tr>
        <th>Reference</th>
        <th>Designation</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
	</thead>
    <tr>
        <td>CD296</td>
        <td>Dior pouches</td>
        <td>10 000</td>
        <td>100 000,00 €</td>
    </tr>
    <tr>
        <td>CD232</td>
        <td>Swing tag</td>
        <td>10 000</td>
        <td>100 000,00 €</td>
    </tr>
    <tr>
        <td>CD285</td>
        <td>Sticker</td>
        <td>10 000</td>
        <td>100 000,00 €</td>
    </tr>
    <tr>
        <td>CD298</td>
        <td>Woven label</td>
        <td>10 000</td>
        <td>100 000,00 €</td>
    </tr>
    <tr class="total-row">
        <td colspan="3" style="padding-right: 80px;">Total :</td>
        <td>400 000,00 €</td>
    </tr>
</table>

                </div>
                <div class="details-info details-info2">
                    <strong style="font-size: 18px; font-weight: bold; padding-right: 110px;">Orders informations :</strong><br>
                    <div class="details-info3">
                        <strong style="font-size: 14px; font-weight: bold;">Shipping address</strong><br>
                        Orient international holding home textile<br>
                        No. 76, opposite Yangkengtang Park<br>
                        18020990745 Dongguan City<br>
                        Yuan Meizhen<br>
                        China
                    </div>
                    <div class="details-info4">
                        <strong style="font-size: 14px; font-weight: bold;">Billing address</strong><br>
                        Nom du client<br>
                        X rue de Blablabla<br>
                        Lieu dit<br>
                        ZIP CODE City<br>
                        Province / Region<br>
                        Country
                    </div>
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
	
    <script src="js/store_dup.js"></script>
	<script>
	function openPopup() {
    document.getElementById("popup").style.display = "block";
}

   function closePopup() {
    document.getElementById("popup").style.display = "none";
   }
	</script>
</body>
    <link rel="stylesheet" href="css/footer_dup.css">
<footer class="footer">
     <div class="pagination">
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select">
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
