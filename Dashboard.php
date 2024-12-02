<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="CSS/dashboard.css">
</head>

<body>
    <main class="main-content" id="main-content">
        <div class="filter-section">
          <button class="filter-btn active" data-status="all">All</button>
          <button class="filter-btn" data-status="Waiting validation">Waiting validation</button>
          <button class="filter-btn" data-status="Waiting production">Waiting production</button>
          <button class="filter-btn" data-status="In production">In production</button>
          <button class="filter-btn" data-status="Quality control">Quality control</button>
          <button class="filter-btn" data-status="Ready for shipping">Ready for shipping</button>
          <button class="filter-btn" data-status="Shipped">Shipped</button>
          <button class="filter-btn" data-status="Refused">Refused</button>
          <div class="status-summary">
             <span class="status in-time">In time: 28</span>
              <span class="status priority">Priority: 2</span>
           </div>
        </div>
        <div class="order-summary">
            <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows">
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
                <span>rows</span>
            </div>
            <button class="order-summary-btn">
                <img src="Image/imprtPO.png" alt="Dashboard" class="navbar-iconOrderSum"> 
                Order state summary
            </button>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Search">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button id="btn-open-popup"  class="add-order-btn">
                <img src="Image/buton+.png" alt="Dashboard" class="navbar-iconPlus"> 
            </button>
        </div>
        <div id="dashboard-content">
            <table class="table1">
        <thead>
            <tr class='entête'>
                <th>OF</span></th>
                <th>ART COL <i class="bi bi-arrow-down"></i></th>
                <th>Made in <i class="bi bi-arrow-down"></i></th>
                <th>Supplier <i class="bi bi-arrow-down"></i></th>
                <th>Buyer <i class="bi bi-arrow-down"></i></th>
                <th>Date <i class="bi bi-arrow-down"></i></th>
                <th>BAT <i class="bi bi-arrow-down"></i></th>
                <th>State <i class="bi bi-arrow-down"></i></th>
                <th>Time remaining <i class="bi bi-arrow-down"></i></th>
                <th>Delivery address <i class="bi bi-arrow-down"></i></th>
                <th>Statut <i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
    <?php
    $data = [
        ['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Validated', 'In time', '4 days', 'Ready for shipping'],
        ['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Validated', 'Late', '-3 days', 'In production'],
        ['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Waiting', '_', '_', 'Refused'],
        ['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Validated', 'Shipped', '_', 'Shipped'],
        ['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Validated', 'Shipped', '_', 'Shipped'],
		['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Validated', 'Priority', '_', 'Waiting production'],
        ['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Waiting', 'In time', '2 days', 'Waiting validation'],
        ['0133206', 'ART COL', 'Portugal', 'Supplier', 'Buyer', '09/01/2023', 'Validated', 'Canceled', '2 days', 'Waiting validation'],
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
            <td><?= $row[5] ?></td>
            <td><span class="state <?= strtolower($row[6]) ?>"><?= $row[6] ?></span></td>
            <td><span class="state <?= strtolower(str_replace(' ', '-', $row[7])) ?>"><?= $row[7] ?></span></td>
            <td><?= $row[8] ?></td>
            <td>
                    <button class="info-btn" data-popup="popup-<?= $index ?>" onclick="event.stopPropagation();">
                        <img src="Image/address.png" alt="Info" style="width: 20px; height: 20px;">
						<div class="popup" id="popup-<?= $index ?>">
                        <strong>Livraison</strong>
                        Société<br>
                        Country<br>
                        Adresse<br>
                        Adresse 2<br>
                        ZIP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ville<br><br>
                        <strong>Contact:</strong>
                        Nom<br>
                        Prénom<br>
                        Société<br>
                        théodupont@client.com<br>
                        +XXX&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;XXX XXX XXX<br>
						
                    </div>
                    </button>
                    
            </td>
            <td><?= $row[9] ?></td>
        </tr>
        <tr class="details">
            <td colspan="11">
                <div class="details-content">
                    <span>Care labels - Total qty: 14</span>
                    <i class="fas fa-angle-up details-toggle"></i>
                </div>
                <table class="sub-table2 details-table" style="display: none;">
                    <thead>
                        <tr class="entête">
                            <th># Internal</th>
                            <th>P.O.</th>
                            <th>Reference</th>
                            <th>Coloris</th>
                            <th>Size</th>
                            <th>Code EAN</th>
                            <th>Quantity</th>
                            <th>QTY to produce</th>
                            <th>Status</th>
                            <th>RTP</th>
                            <th>Informations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>Waiting for validation</td>
                            <td><span class="stateRTP1">RTP1</span> <span class="stateRTP1">RTP2</span> <span class="stateRTP1">RTP3</span> 
							 <span class="stateRTP1">RTP4</span> <span class="stateRTP1">RTP5</span></td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations </p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td>              
                        </tr>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>Waiting for validation</td>
                            <td><span class="stateRTP1">RTP1</span> <span class="stateRTP1">RTP2</span> <span class="stateRTP1">RTP3</span> 
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>Waiting for validation</td>
                            <td><span class="stateRTP1">RTP1</span> <span class="stateRTP1">RTP2</span> </td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                    </tbody>
                </table>
                <div class="details-content">
                    <span>Hangtags - Total qty: 3</span>
                    <i class="fas fa-angle-up details-toggle"></i>
                </div>
                <table class="sub-table2 details-table" style="display: none;">
                    <thead>
                        <tr class="entête">
                            <th># Internal</th>
                            <th>P.O.</th>
                            <th>Reference</th>
                            <th>Coloris</th>
                            <th>Size</th>
                            <th>Code EAN</th>
                            <th>Quantity</th>
                            <th>QTY to produce</th>
                            <th>Status</th>
                            <td>RTP</span></td>
                            <th>Informations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>In production</td>
                            <td><span class="stateRTP1">RTP1</span></td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>In production</td>
                            <td><span class="stateRTP1">RTP1</span></td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>In production</td>
                            <td><span class="stateRTP1">RTP1</span></td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                    </tbody>
                </table>
                <div class="details-content">
                    <span>Stickers - Total qty: 3</span>
                    <i class="fas fa-angle-up details-toggle"></i>
                </div>
                <table class="sub-table2 details-table" style="display: none;">
                    <thead>
                        <tr class="entête">
                            <th># Internal</th>
                            <th>P.O.</th>
                            <th>Reference</th>
                            <th>Coloris</th>
                            <th>Size</th>
                            <th>Code EAN</th>
                            <th>Quantity</th>
                            <th>QTY to produce</th>
                            <th>Status</th>
                            <th>RTP</th>
                            <th>Informations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>In production</td>
                            <td><span class="stateRTP1">RTP1</span></td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>In production</td>
                            <td><span class="stateRTP1">RTP1</span></td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                        <tr>
                            <td>2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>In production</td>
                            <td><span class="stateRTP1">RTP1</span></td>
                            <td>
                               <button class="info-button">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
					             <div class="popupp">
                                 <p>Orders informations</p>
                                 <p>Date upload BAT 1 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 1 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 2 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 2 : 17/04/2024 17:25</p>
                                 <p>Date upload BAT 3 : 17/04/2024 16:00</p>
                                 <p>Date validation BAT 3 : 17/04/2024 17:25</p>
                                 <p>Date confirm production : 17/04/2024 17:25</p>
                                 <p>Date begin production : 18/04/2024 11:18</p>
                                 </div>
                                </button>                
                            </td> 
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    <?php } ?>
<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <span class="popup-close"><i class="bi bi-x-lg"></i></span>
            <h2 class="popup-title">Recherche avancée</h2>

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
                    <label class="date-label">From:</label>
                    <select class="date-select"><option>Jour</option></select>
                    <select class="date-select"><option>Mois</option></select>
                    <select class="date-select"><option>Année</option></select>
                </div>
                <div class="input-group2">
                    <label class="date-label">&nbsp &nbsp To:</label>
                    <select class="date-select"><option>Jour</option></select>
                    <select class="date-select"><option>Mois</option></select>
                    <select class="date-select"><option>Année</option></select>
                </div>
            </div>

            <div class="Recher-button-container">
                <button class="btn-Recher">Rechercher</button>
            </div>
        </div>
    </div>
</tbody>

    </table>
            
        </div>
    </main> 
     	
<script src="js/dashboard_dup.js"></script>
<script>
  // JavaScript pour gérer l'affichage de la popup
        const btnOpenPopup = document.getElementById('btn-open-popup');
        const btnClosePopup = document.getElementById('btn-close-popup');
        const popup = document.getElementById('popup-advanced-search');

        btnOpenPopup.addEventListener('click', () => {
            popup.style.display = 'block';
        });

        btnClosePopup.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        // Fermer la popup si l'utilisateur clique en dehors de celle-ci
        window.addEventListener('click', (event) => {
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        });      
</script>
</body>

   
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
