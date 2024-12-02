
<link rel="stylesheet" href="css/orderhistory_dup.css"> 
<style>


</style>
	    <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn" onclick="openPopupAVS()">
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
                        <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
                            <td>
                                <button class="icon <?= $btnClass ?>" >
                                   <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                                </button>
                                <?= $row[0] ?>
                            </td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td><?= $row[4] ?></td>

                            <td>
                                <button class="btn-Bill" onclick="openQTYPopup(); event.stopPropagation();">
								<i class="bi bi-download"></i>&nbsp; 
								Summary</button>
                                <button class="btn-Place" onclick="openPopup(); event.stopPropagation();">
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
    <!-- popup place OR-->
	 <div id="popup" class="popup">
        <div class="popup-content">
            
            <div class="popup-header">
                <h3 class="left-align2">Reorder</h3>				
                <button class="popup-delete"><img src="Image/deletepopup.png" alt="Delete" class="popup-delete-icon"></button>
				<span class="close" onclick="closePopup()"><i class="bi bi-x-lg"></i></span>
            </div>
            <div class="popup-body">
			    <h6 class="left-align0">CD296</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
			<div class="popup-body">
			    <h6 class="left-align0">CD232</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
			<div class="popup-body">
			    <h6 class="left-align0">CD285</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
			<div class="popup-body">
			    <h6 class="left-align0">CD298</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="popup-footer">
                <button class="popup-add-site">+ Add site</button>
                <button class="popup-validate">Place order</button>
            </div>
        </div>
    </div>
	
	<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <span class="popup-close" onclick="closePopupAVS()"><i id="btn-close-popup" class="bi bi-x-lg"></i></span>
            <h2 class="popup-title">Advanced research</h2>

            <div class="popup-section">
                <h3 class="section-title">General informations</h3>
                <div class="input-group2">
                    <input type="text" placeholder="O.F" class="input-field1">
                    <input type="text" placeholder="Article code" class="input-field1">
					<input type="text" placeholder="ID" class="input-field1">
                    <input type="text" placeholder="Reference" class="input-field1">
					<input type="text" placeholder="Supplier" class="input-field1">
                    <input type="text" placeholder="Made in" class="input-field1">
                </div>

            </div>

            <div class="popup-section">
                <h3 class="section-title">Label informations</h3>
                <div class="input-group2">
                    <select class="input-select">
                        <option>Label type</option>
                    </select>
				    <input type="text" placeholder="Size" class="input-field2">
                </div>
            </div>

            <div class="popup-section">
                <h3 class="section-title">Date</h3>
                <div class="input-group2">
                    <label class="date-label">Du:</label>
                    <select class="date-select"><option>Jour</option></select>
                    <select class="date-select"><option>Mois</option></select>
                    <select class="date-select"><option>Année</option></select>
                </div>
                <div class="input-group2">
                    <label class="date-label">Au:</label>
                    <select class="date-select"><option>Jour</option></select>
                    <select class="date-select"><option>Mois</option></select>
                    <select class="date-select"><option>Année</option></select>
                </div>
            </div>

            <div class="Recher-button-container">
                <button class="btn-Recher">Search</button>
            </div>
        </div>
    </div>
	
	
	<!-- popup Select Costomer-->
	<div id="popupSelect" class="popupSelect">
        <div class="popupSelect-content">
            
            <div class="popupSelect-header"> 
                <h5 class="left-align2">Select customer</h5>				
              
            </div>
 
                <div class="company-section">
				<select>
                    <option value="Company name" disabled selected>Customer name</option>
                    <option value="Company 1">Customer 1</option>
                   <option value="Company 2">Customer 2</option>
                    <!-- Other options here -->
                </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-validate" onclick="closepopupSelect()";><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>
    <script src="js/PS_store_dup.js"></script>
	<script>

	</script>
</body>
    <link rel="stylesheet" href="css/footer_dup.css">
<div class="footer">
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
   
</div>

