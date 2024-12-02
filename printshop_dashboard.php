<?php 

	require_once("config.inc.php");
	require_once("includes/is_session_active.php");
$status[0]='Canceled';
	$status[1]='New orders';
	$status[2]='Wait for BAT validation';
	$status[3]='Wait for Manufacturer validation';
	$status[4]='Waiting for production';
	$status[5]='In production';
	$status[6]='Quality control'; 
	$status[7]='Shipped';
	$status[8]='Product By Supplier';
$status[9]='Ready for shipping';
if(isset($_POST['rows'])){
$maxRecord=$_POST['rows'];
}
else{
$maxRecord=20;
}
$prefix=$_SESSION['prefix_contractor'];
$selectedStatus = '0,1,2,3,4,5,6,7,8,9';
if (isset($_POST['criteria_value'])) {

    if ($_POST['criteria_value'] == "Waiting confirmation") {
        $selectedStatus= '1,2,3';
        
    } elseif ($_POST['criteria_value'] == "all") {
        $selectedStatus = '0,1,2,3,4,5,6,7,8,9';
        
    } else {
        $selectedStatus = $_POST['criteria_id'];
        
    }
}

?>
    <link rel="stylesheet" href="css/PS_dashboard_dup.css">

        <div class="filter-section">
          <button class="filter-btn active" data-status="all">All</button>
          <button class="filter-btn" data-status="New orders">New orders</button>
          <button class="filter-btn" data-status="In production">In production</button>
          <button class="filter-btn" data-status="Quality control">Quality control</button>
          <button class="filter-btn" data-status="Ready for shipping">Ready for shipping</button>
          <button class="filter-btn" data-status="Shipped">Shipped</button>
          <button class="filter-btn" data-status="Canceled">Canceled</button>
          <div class="status-summary">
             <span class="status in-time">In time: 28</span>
              <span class="status priority">Priority: 2</span>
           </div>
        </div>
        <div class="order-summary">
            

            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i  id="btn-open-popup" class="bi bi-sliders"></i>
                    </button>
            </div>
			<button class="btn-InProd">
                Move selected orders to quality control 
            </button>
			<button class="btn-QuaCont">
                Move selected orders for shipping 
            </button>
			<button class="btn-Shipp">
                Move to Shipped
            </button>
          <select class="sites-select">
             <option value="1d">Total time production : <span>999 hrs &nbsp &nbsp  1d </span></option>
             <option value="2d">Total time production: <span>999 hrs</span>&nbsp &nbsp  2d</option>
             <option value="3d">Total time production: <span>999 hrs</span>&nbsp &nbsp 3d</option>
             <!-- Ajoutez d'autres options si nécessaire -->
           </select>
		   
			<button class="order-summary-btn">
                <i class="bi bi-download"></i>
                Order state summary
            </button>
        </div>
        <div id="printshop-dashboard-content">
            <table class="table1">
            <thead>
            <tr class='entête'>
                <th>OF</th>
				<th>Brand <i class="bi bi-arrow-down"></i></th>
                <th>ART COL <i class="bi bi-arrow-down"></i></th>
                <th>Made in <i class="bi bi-arrow-down"></i></th>
                <th>Supplier <i class="bi bi-arrow-down"></i></th>
				<th>Date order <i class="bi bi-arrow-down"></i></th>
				<th class="DatFiniRow" style="display: none">Date finish <i class="bi bi-arrow-down"></i></th>
				<th class="TrakNumRow" style="display: none">Tracking number <i class="bi bi-arrow-down"></i></th>
				<th>State <i class="bi bi-arrow-down"></i></th>
				<th class="TimRemRow">Time remaining <i class="bi bi-arrow-down"></i></th>
				<th>Delivery address <i class="bi bi-arrow-down"></i></th>
				<th class="ProdRow">Production time <i class="bi bi-arrow-down"></i></th>
				<th class="StatutRow">Statut <i class="bi bi-arrow-down"></i></th>
                <th>Actions <i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
    <?php 
if($prefix=='All'){
$ordersQuery = "SELECT id,num_of, reference,made_in, code_supplier,date_integration, date_delivery, status, tracking,urgent_mode,type_label, 'Dior' as contractor
FROM dior_orders
WHERE status in (0,4,5,6,7,8,9)
GROUP BY type_label
UNION
SELECT id,num_of, reference,made_in, code_supplier,date_integration, date_delivery, status, tracking,urgent_mode,type_label, 'Dior HC' as contractor
FROM diorhc_orders
WHERE status in (0,4,5,6,7,8,9)
GROUP BY type_label
UNION
SELECT id,num_of, reference,made_in, code_supplier,date_integration, date_delivery, status, tracking,urgent_mode,type_label, 'Lemaire' as contractor
FROM lem_orders
WHERE status in (0,4,5,6,7,8,9)
GROUP BY type_label
ORDER BY num_of ASC, type_label DESC, id DESC;";
}
else{
    if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan"){
		$sqlUrgent="select count(*) from " . $_SESSION['prefix_contractor'] . "_orders where urgent_mode = 1 and status in (1,2,3,4,5,6,8,9) group by num_of, reference ";
	}
    else{
		$sqlUrgent="select count(*) from " . $_SESSION['prefix_contractor'] . "_orders where urgent_mode = 1 and status in (1,2,3,4,5,6,8,9) group by num_of ";
	}
			// echo $sql;
	$retourUrgent=mysqli_query($con,$sqlUrgent);
	// Group retourne un tableau il faut l'additionner
	$nbUrgent = mysqli_num_rows($retourUrgent);
$ordersQuery = "SELECT * FROM ".$prefix."_orders where status in (0,4,5,6,7,8,9) limit 1,20";
}

$ordersResult = mysqli_query($con, $ordersQuery);

$data = [];

while ($ordersRow = mysqli_fetch_assoc($ordersResult)) {

    $date_integration = new DateTime($ordersRow['date_integration']);
    $date_delivery = new DateTime();
    if($ordersRow['date_delivery']){
        $date_delivery = new DateTime($ordersRow['date_delivery']);
    }
    if($prefix=='All'){ $contractor= $ordersRow['contractor']; } else { $contractor = $prefix; } 
    // Construire chaque ligne du tableau à partir des colonnes de la table `lem_orders`.
    $data[] = [
        $ordersRow['num_of'],    // le numéro de commande 
        $contractor,     // Contractor $ordersRow['contractor'],
        $ordersRow['reference'],   
        $ordersRow['made_in'],       
        $ordersRow['code_supplier'],       
        date_format($date_integration,"d/m/Y"),     
        date_format($date_delivery,"d/m/Y"),   
        $ordersRow['tracking'], 
        $ordersRow['urgent_mode'],          // Par exemple, le statut de la commande (ex. "Priority", "In time", etc.)
        '4 days', //$ordersRow['delay'],          
        '2h00', //$ordersRow['production_time'], 
        $status[$ordersRow['status']],     
    ];
}
//print_r($data);
    

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this);" >
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
			<td class="DatFiniRow" style="display: none"><?= $row[6] ?></td>
			<td class="TrakNumRow" style="display: none"><?= $row[7] ?></td>
            <td><span class="state <?= strtolower(str_replace(' ', '-', $row[8])) ?>"><?= $row[8] ?></span></td>
            <td class="TimRemRow"><?= $row[9] ?></td>
            <td>
                    <button class="info-btn" data-popup="popup-<?= $index ?>">
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
			<td class="ProdRow"><?= $row[10] ?></td>
            <td class="StatutRow"><?= $row[11] ?></td>
			<td>
								<?php if ($row[11] == 'New order') { ?>	
									<button class="btn-begin2" onclick="openPopupBP(); changeBackgroundColor(this); event.stopPropagation();">
                                        <i class="bi bi-send"></i>&nbsp
                                        Begin production
                                    </button>
									<button class="btn-comment" onclick="openPopupCM(); event.stopPropagation();" >
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                    </button>
                                    <button class="btn-down" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>
                                    </button>
                                <?php } else if ($row[11] == 'In production') { ?>
								    <button class="btn-InProd2" onclick="changeBackgroundColor(this); event.stopPropagation();">
                                        <i class="bi bi-send"></i>&nbsp
                                        Quality control
                                    </button>
                                    <button class="btn-IdSt" style="display: none;" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>&nbsp
                                        ID sticker
                                    </button>
									<button class="btn-comment" onclick="openPopupCM(); event.stopPropagation();">
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                    </button>
                                    <button class="btn-down" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>
                                    </button>
								<?php } elseif ($row[11] == 'Quality control') { ?>
								    <button class="btn-QuaCont2" onclick="event.stopPropagation();">
                                        <i class="bi bi-send"></i>&nbsp
                                        Ready for shipping
                                    </button>
									<button class="btn-comment" onclick="openPopupCM(); changeBackgroundColor(this); event.stopPropagation();">
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                    </button>
                                    <button class="btn-down" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>
                                    </button>
								<?php } elseif ($row[11] == 'Ready for shipping') { ?>
								   <button class="btn-Shipp2" onclick="openPopupPL(); changeBackgroundColor(this); event.stopPropagation();">
                                        <i class="bi bi-send"></i>&nbsp
                                        To shipped
                                    </button>
                                    <button class="btn-IdSt2" style="display: none;" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>&nbsp
                                        Packing list
                                    </button>
									<button class="btn-comment" onclick="openPopupCM(); event.stopPropagation();">
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                    </button>
                                    <button class="btn-down" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>
                                    </button>	
								<?php } elseif ($row[11] == 'Shipped') { ?>
								    <button class="btn-Shipped" onclick="event.stopPropagation();">
                                        <i class="bi bi-send"></i>&nbsp
                                        Shipped
                                    </button>
									<button class="btn-comment" onclick="openPopupCM(); event.stopPropagation();">
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                    </button>
                                    <button class="btn-down" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>
                                    </button>	
                                <?php } elseif ($row[11] == 'Canceled') { ?>
								    <button class="btn-comment" onclick="openPopupCM(); event.stopPropagation();">
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                    </button>
                                    <button class="btn-down" onclick="event.stopPropagation();">
                                        <i class="bi bi-download"></i>
                                    </button>
                                <?php } ?>
            </td>
        </tr>
        <tr class="main-row2 <?= $rowClass ?>" style="display: none;" >
            <td colspan="14">
                <div class="details-content" >
                    <span>Care labels - Total qty: 14</span>
                    <i class="fas fa-angle-down details-toggle"></i>
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
							<th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>Waiting for validation</td>
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
                                </button>
							</td>
                        </tr>
                    </tbody>
                </table>
                <div class="details-content">
                    <span>Hangtags - Total qty: 3</span>
                    <i class="fas fa-angle-down details-toggle"></i>
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
							<th>Action</th>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
                                </button>
							</td>
                        </tr>
                    </tbody>
                </table>
                <div class="details-content">
                    <span>Stickers - Total qty: 3</span>
                    <i class="fas fa-angle-down details-toggle"></i>
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
							<th>Action</th>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
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
                            <td><span class="stateRTP1"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
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
							<td><button class="btn-down">
                                    <i class="bi bi-download"></i>
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

     	



<div class="footer">

     <div class="pagination">
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select" onchange="set_rows('printshop_dashboard');">
                    <option value="20" <?php echo ($maxRecord == 20) ? 'selected' : ''; ?>>20</option>
                    <option value="30" <?php echo ($maxRecord == 30) ? 'selected' : ''; ?>>30</option>
                    <option value="50" <?php echo ($maxRecord == 50) ? 'selected' : ''; ?>>50</option>
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
<script src="js/PS_dashboard_dup.js"></script>

<script>


function changeBackgroundColor(button) {
    button.style.backgroundColor = "gray";
}

 </script>  
