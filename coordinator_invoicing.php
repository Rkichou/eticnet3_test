
<link rel="stylesheet" href="css/PS_dashboard_dup.css">
<style>

</style>
<body>
    <main class="main-content" id="main-content">
	 <div class="filter-section">
          <button class="filter-btn active" data-status="uninvoiced">Uninvoiced</button>
          <button class="filter-btn" data-status="invoiced">Invoiced</button>
          <button class="filter-btn" data-status="paid">Paid</button>
          <button class="filter-btn" data-status="commission">Commission</button>
          <button class="filter-btn" data-status="informations">Informations</button>
          <div class="status-summary">
             <button class="summary-btn">
                   <i class="bi bi-download"></i> Summary
                </button>
           </div>
        </div>
        <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
            </div>		   
			<button class="selectdate-btn" id="btns_invoice">
                <i class="bi bi-calendar3"></i>&nbsp
                Select Date
            </button id="btns_invoice">
			 <p id="btns_invoice">Multiple <input type="checkbox" name="default" ></p>    
			<button class="invoicing-btn" id="btns_invoice">               
                Invoicing 
            </button>
			<button class="commission-btn" id="btns_invoice">
                Commission 
            </button>
             <button class="orderview2-btn active" id="btns_invoice">
                 Orders view
                  </button>
                 <button class="supplierview-btn" id="btns_invoice">
                   Suppliers view
                </button>

        </div>
        <div id="dashboard-content">
		
		<!-- tableau de "Uninvoiced" -->
            <table class="table1" id="uninvoiced_tab" >
        <thead>
            <tr class='entête'>
                <th>OF</th>
				<th>ART COL</th>
				<th>Made in</th>
                <th>Supplier</th>
                <th>Supplier type</th>
				<th>Country</th>
				<th>Printshop</th>
				<th>Date finish <i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $data = [
        ['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
        ['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
		['0133206','ART COL', 'Portugal','Supplier','09/01/2023','23 days','Shipping', '09/01/2023'],
    ];

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
            <td>
                <button class="icon <?= $btnClass ?>" >
            <!-- Utilisez une image par défaut (par exemple, vert) -->
                       <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                </button>
                    <?= $row[0] ?>
            </td>            
			<td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
			<td><?= $row[5] ?></td>
			<td><?= $row[6] ?></td>
			<td><?= $row[7] ?></td>
     
			
        </tr>
        <tr class="main-row <?= $rowClass ?>" style="display: none;">
            <td colspan="13">
                <div class="details-content">
                    <span><input type="checkbox" name="default"> &nbsp Care labels - Total qty: 14</span>
                    <i class="fas fa-angle-down details-toggle"></i>
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
                    <i class="fas fa-angle-down details-toggle"></i>
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
                    <i class="fas fa-angle-down details-toggle"></i>
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

</tbody>

    </table>
        
<!-- tableau de "Invoiced" -->
            <table class="table1" id="invoiced_tab" style="display: none;">
        <thead>
            <tr class='entête'>
                <th>OF</th>
				<th>ERP invoice n°</th>
				<th>Supplier code</th>
                <th>Supplier</th>
				<th>Country</th>
				<th>Date invoice</th>
				<th>Amount</th>
				<th>Payment due</th>
				<th>Time remaining</th>
				<th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $data = [
        ['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
        ['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
		['0133206','ERP invoice n°', 'Supp code','Supplier','Country','09/01/2023','1 000 000€', '23/07/2024', '-10d'],
    ];

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" >
            <td>
                <button class="icon <?= $btnClass ?>" onclick="toggleDetails(this)">
            <!-- Utilisez une image par défaut (par exemple, vert) -->
                       <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                </button>
                    <?= $row[0] ?>
            </td>            
			<td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
			<td><?= $row[5] ?></td>
			<td><?= $row[6] ?></td>
			<td><?= $row[7] ?></td>
			<td><?= $row[8] ?></td>
			<td>
			   <button class="btn-paidS">
			        <img src="Image/paidS.png" alt="Icon" style="width: 19px; height: 16px;">
                    Paid status
                </button>
				<button class="btn-EditIn">
				    <i class="bi bi-pencil-square"></i>
                    Edit invoice
                </button>
			
			</td>
     
			
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

</tbody>

    </table>

<!-- tableau de "Paid" -->
            <table class="table1" id="paid_tab" style="display: none;" >
        <thead>
            <tr class='entête'>
                <th>Invoice n°</th>
				<th>ERP invoice number</th>
				<th>Supplier code</th>
                <th>Supplier name</th>
				<th>Country</th>
				<th>Date invoice</th>
				<th>Amount</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $data = [
        ['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
        ['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
		['0133206','BAIG', 'Supp code','Supp name','country','09/01/2023','1 000 000'],
    ];

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" >
            <td>
                <button class="icon <?= $btnClass ?>" onclick="toggleDetails(this)">
            <!-- Utilisez une image par défaut (par exemple, vert) -->
                       <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                </button>
                    <?= $row[0] ?>
            </td>            
			<td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
			<td><?= $row[5] ?></td>
			<td><?= $row[6] ?></td>
     
			
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

</tbody>

    </table>

<!-- tableau de "commission" -->
            <table class="table1" id="commission_tab" style="display: none;" >
        <thead>
            <tr class='entête'>
                <th>Invoice n°</th>
				<th>Company</th>
				<th>Date commission</th>
				<th>Commission period</th>
				<th>Compo label fee</th>
				<th>Black satin label fee</th>
                <th>White satin label fee</th>
				<th>Sticker fee</th>
				<th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $data = [
        ['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
        ['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
		['0133206','company','BAIG','09/01/2023 - 30/06/2024','Compo','black satin','White satin','sticker'],
    ];

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" >
            <td>
                <button class="icon <?= $btnClass ?>" onclick="toggleDetails(this)">
            <!-- Utilisez une image par défaut (par exemple, vert) -->
                       <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                </button>
                    <?= $row[0] ?>
            </td>            
			<td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
			<td><?= $row[5] ?></td>
			<td><?= $row[6] ?></td>
			<td><?= $row[7] ?></td>
			<td>
			     <button class="btn-EditCom">
				    <i class="bi bi-pencil-square"></i>
                    Edit commission
                </button>
			</td>
			
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

</tbody>

    </table>

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
 </div>
     	
<script src="js/supplier_dashboard_dup.js"></script>

<script>

  //popup Select Customer Dictionary
  function closepopupSelect() {
    document.getElementById("popupSelect").style.display = "none";
}

</script>


   
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

