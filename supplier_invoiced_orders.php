
	<link rel="stylesheet" href="css/PS_dashboard_dup.css">
        <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i  id="btn-open-popup" class="bi bi-sliders"></i>
                    </button>
            </div>		   
			<button class="selectdate-btn">
                <i class="bi bi-calendar3"></i>&nbsp
                Select Date
            </button>
			 Multiple &nbsp <input type="checkbox" name="default">  
			<button class="invoicing-btn">               
                Invoicing 
            </button>
			<button class="commission-btn">
                Commission 
            </button>
             <button class="orderview-btn active">
                 Orders view
                  </button>
                 <button class="supplierview-btn">
                   Suppliers view
                </button>

        </div>
        <div id="dashboard-content">
            <table class="table1">
        <thead>
            <tr class='entête'>
                <th>OF</span></th>
                <th>ART COL</th>
                <th>Country</th>
				<th>Price</th>
				<th>Date finish <i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $data = [
        ['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
        ['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
		['0133206','ART COL', 'Portugal','100 000 000€', '09/01/2023'],
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
     
			
        </tr>
        <tr class="details">
            <td colspan="13">
                <div class="details-content">
                    <span><input type="checkbox" name="default"> &nbsp Care labels - Total qty: 14</span>
                    <i class="fas fa-angle-up details-toggle"></i>
                </div>
                <table class="sub-table2 details-table" style="display: none;">
                    <thead>
                        <tr class="entête">
                            <th>Type label</th>
                            <th>Quantity</th>
                            <th>Label length</th>
                            <th>Total length</th>
                            <th>Unit price</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
						<tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
						<tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
						<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Modelling</strong></td>
                            <td><strong>75,000€</strong></td>
                        </tr>
						<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total price</strong></td>
                            <td><strong>75,000€</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="details-content">
                    <span><input type="checkbox" name="default"> &nbsp Hangtags - Total qty: 3</span>
                    <i class="fas fa-angle-up details-toggle"></i>
                </div>
                <table class="sub-table2 details-table" style="display: none;">
                    <thead>
                        <tr class="entête">
                            <th>Type label</th>
                            <th>Quantity</th>
                            <th>Label length</th>
                            <th>Total length</th>
                            <th>Unit price</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
						<tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Modelling</strong></td>
                            <td><strong>75,000€</strong></td>
                        </tr>
						<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total price</strong></td>
                            <td><strong>75,000€</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="details-content">
                    <span><input type="checkbox" name="default"> &nbsp Stickers - Total qty: 3</span>
                    <i class="fas fa-angle-up details-toggle"></i>
                </div>
                <table class="sub-table2 details-table" style="display: none;">
                    <thead>
                        <tr class="entête">
                            <th>Type label</th>
                            <th>Quantity</th>
                            <th>Label length</th>
                            <th>Total length</th>
                            <th>Unit price</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
						<tr>
                            <td>51438</td>
                            <td>202m</td>
                            <td>9.8€/1000pcs</td>
                            <td>62.8€</td>
                            <td>7€</td>
                            <td>75,000€</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Modelling</strong></td>
                            <td><strong>75,000€</strong></td>
                        </tr>
						<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total price</strong></td>
                            <td><strong>75,000€</strong></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php } ?>
<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <span class="popup-close"><i id="btn-close-popup" class="bi bi-x-lg"></i></span>
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
                        <option>Color</option>
                    </select>
                    <select class="input-select">
                        <option>Label type</option>
                    </select>
				    <input type="text" placeholder="Size" class="input-field2">
                </div>
            </div>

            <div class="popup-section">
                <h3 class="section-title">Production states</h3>
                <div class="button-group">
                    <button class="state-button">In production</button>
                    <button class="state-button">Pending</button>
                    <button class="state-button">Finished</button>
                    <button class="state-button">Canceled</button>
                    <button class="state-button">Refused</button>
                    <button class="state-button">In time</button>
                    <button class="state-button">Late</button>
                    <button class="state-button">Priority</button>
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
	
	<!-- Popup Container Production order-->
<div id="productionPopup" class="popupProd-container" style="display: none;">
    <div class="popupProd-content">
        <div class="popupProd-header">
            <h6><strong>Production order</strong></h6>
            <button class="close-popupProd-btn" onclick="closePopupBP()"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="popupProd-body">
            <ul class="order-list">
                <li><i class="bi bi-check-lg"></i> Hangtag P.O.</li>
                <li><i class="bi bi-check-lg"></i> Care label P.O.</li>
                <li><i class="bi bi-check-lg"></i> Stickers P.O.</li>
            </ul>
        </div>
        <div class="popupProd-footer">
            <button class="popupProd-btn1" onclick="ProdOrd()"><i class="bi bi-download"></i> Production order(s)</button>
            <button class="popupProd-btn2"><i class="bi bi-printer"></i> ID sticker(s)</button>
			<button class="popupProd-btn3" style="display: none;"><i class="bi bi-check-lg"></i> Apply</button>
        </div>
    </div>
</div>
	<!-- Popup Container -->
<div id="PackingPopup" class="popupList-container" style="display: none;">
    <div class="popupProd-content">
        <div class="popupProd-header">
            <h6><strong>Packing list</strong></h6>
            <button class="close-popupPacking-btn" onclick="closePopupPL()"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="popupProd-body">
            <ul class="order-list">
                <li><i class="bi bi-check-lg"></i> Hangtag P.L.</li>
                <li><i class="bi bi-check-lg"></i> Care label P.L.</li>
                <li><i class="bi bi-check-lg"></i> Stickers P.L.</li>
            </ul>
        </div>
        <div class="popupProd-footer">
            <button class="popupProd-btn4" onclick="PackList()" ><i class="bi bi-download"></i> Packing list(s)</button>
            <button class="popupProd-btn5"><i class="bi bi-printer"></i> ID sticker(s)</button>
			<button class="popupProd-btn6" style="display: none;"><i class="bi bi-check-lg"></i> Apply</button>
        </div>
    </div>
</div>


<!-- Popup de Commentaires -->
<div id="commentPopup" class="popupComment">
    <div class="popupComment-content">
        <span class="close-popupComment-btn" onclick="closePopupCM()"><i class="bi bi-x-lg"></i></span>
        <h5>Comments</h5>
		
         <div class="customer-comment">
             <div class="header-row">
                <h5>Customer</h5>
                <p>11/03/2024, 10h52</p>
             </div>
            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque id turpis faucibus ornare sit faucibus. Cursus in porttitor tristique faucibus enim mi. Commodo sit nisl vitae in felis quam in blandit. Purus sed tristique penatibus accumsan laoreet sollicitudin vivamus tincidunt amet. Malesuada auctor congue non viverra laoreet consectetur amet. Blandit aliquam lacinia tempus massa blandit vitae convallis proin est. Id.</p>
            
        </div>
        <div class="comment-input-section">
            <h5>Customer</h5>
            <textarea placeholder="Write here..." class="comment-input"></textarea>
            <button class="add-comment-btn">Add <i class="bi bi-send"></i></button>
        </div>
    </div>
</div>

</tbody>

    </table>
            
        </div>
 
     	
<script src="js/supplier_dashboard_dup.js"></script>

<script>


</script>
</body>

   
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
