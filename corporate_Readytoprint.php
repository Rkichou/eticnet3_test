
	<link rel="stylesheet" href="CSS/PS_dashboard.css">
        <div class="filter-section">
          <button class="filter-btn active" data-status="all">All</button>
          <button class="filter-btn" data-status="Waiting confirmation"><span class="notification-dot"></span>&nbsp &nbsp Waiting confirmation</button>
          <button class="filter-btn" data-status="Waiting production">Waiting production</button>
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
                        <i class="fas fa-search"></i>&nbsp &nbsp <i class="bi bi-sliders" onclick="openPopupAdSh();"></i>
                    </button>
            </div>		   
			<button class="order-summary-btn2">
                <i class="bi bi-download"></i>
                Order state summary
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
				<th class="DateOrderRow" style="display: none">Date order<i class="bi bi-arrow-down"></i></th>
				<th class="DateCancelRow"style="display: none">Date cancel<i class="bi bi-arrow-down"></i></th>
				<th class="ShippingDateRow" style="display: none">Shipping date<i class="bi bi-arrow-down"></i></th>
				<th class="TrackNumRow" style="display: none">Tracking number<i class="bi bi-arrow-down"></i></th>
				<th class="DateRow">Date <i class="bi bi-arrow-down"></i></th>
				<th class="StateRow">State <i class="bi bi-arrow-down"></i></th>
				<th class="TimRemRow">Time remaining <i class="bi bi-arrow-down"></i></th>
				<th class="AddRow">Delivery address <i class="bi bi-arrow-down"></i></th>
				<th class="StatutRow">Statut </th>	
				<th class="PrintshopRow">Printshop<i class="bi bi-arrow-down"></i></th>
				<th class="PriorityRow" style="display: none">Priority</th>
				<th class="ActionsRow" style="display: none">Actions</th>
				<th>Comments <i class="bi bi-arrow-down"></i></th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $data = [
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Waiting confirmation','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Waiting production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Waiting confirmation','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','In production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Waiting production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting check','4 days','Quality control','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Quality control','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting RTP','4 days','Waiting production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Ready for shipping','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting RTP','4 days','Quality control','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Shipped','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting RTP','4 days','Waiting production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','In production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','In production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting check','4 days','Ready for shipping','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting RTP','4 days','Quality control','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Waiting confirmation','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting check','4 days','Ready for shipping','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting RTP','4 days','In production','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Canceled','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Canceled','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Shipped','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Canceled','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Shipped','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','In time','4 days','Canceled','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Shipped','Bengladesh'],		
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Waiting check','4 days','Waiting confirmation','Bengladesh'],
        ['0133206','ART COL', 'Portugal','Supplier', 'Buyer', 'date_order','date_cancel','shipping_date','1234567890','date','Late','4 days','Ready for shipping','Bengladesh'],

    ];

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
            <td>
                <button class="icon <?= $btnClass ?>"  >
                       <img src="Image/OfVert1.png" alt="Icon" style="width: 12px; height: 11px;">
                      </button>
                    <?= $row[0] ?>
            </td>
            <td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
            <td class="DateOrderRow" style="display: none"><?= $row[5] ?></td>
			<td class="DateCancelRow"style="display: none"><?= $row[6] ?></td>
			<td class="ShippingDateRow" style="display: none"><?= $row[7] ?></td>
			<td class="TrackNumRow" style="display: none"><?= $row[8] ?> &nbsp &nbsp<i class="bi bi-copy"></i></td>
			<td class="DateRow"><?= $row[9] ?></td>
			<td class="StateRow"><span class="state <?= strtolower(str_replace(' ', '-', $row[10])) ?>"><?= $row[10] ?></span></td>
			<td class="TimRemRow"><?= $row[11] ?></td>
			<td class="AddRow">
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
			<td class="StatutRow"><?= $row[12] ?></td>	
			<td class="PrintshopRow"><?= $row[13] ?></td>	
			<td class="PriorityRow" style="display: none" onclick="event.stopPropagation();"><input type="checkbox" name="default" ></td>	
			<td class="ActionsRow" style="display: none">
									<button class="btn-ConfOr" onclick="changeBackgroundColor(this); event.stopPropagation();">
                                        <i class="bi bi-check2"></i>&nbsp
                                        Confirm order
                                    </button>
									<button class="btn-rtpValid" onclick="event.stopPropagation(); openPopupRtpValid();">
                                        <i class="bi bi-check2"></i>&nbsp
                                        RTP validation
                                    </button>
									<button class="btn-delete"><i class="bi bi-trash3"></i>&nbsp
								   Cancel</button>
            </td>			
			<td>
                                <button class="btn-comment" onclick="openPopupCM(); changeBackgroundColor(this); event.stopPropagation();">
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                 </button>
            </td>

			
			
			
        </tr>
        <tr class="main-row2 <?= $rowClass ?>" style="display: none;">
            <td colspan="13">
                <div class="details-content">
                    <span> Care labels - Total qty: 14</span>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td> 2952</td>
                            <td>0133206</td>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td>4637829753268</td>
                            <td>1</td>
                            <td>1</td>
                            <td>Waiting for validation</td>
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
                            <td><span class="stateRTP1"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
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
           </table> 
        </div> 	
<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <span class="popup-close"><i class="bi bi-x-lg" onclick="closePopupAdSh();"></i></span>
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

<!-- Popup RTP validation -->	
<div id="popup-overlay" style="display: none;">
    <div id="popup-RTP-Valid">
        <span class="popup-close2" onclick="closePopupRtpValid();"><i class="bi bi-x-lg"></i></span>
        <h2 class="popup-title">OF: 1332006</h2>
        <table class="table1">
            <thead>
                <tr class='entête'>
                    <th>Type</th>
                    <th>Size</th>
                    <th>RTP visualisation</th>
                    <th>Action</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $data = [
                    ['Stickers','M'],
                    ['Stickers','L'],
                    ['Carelabl','XS'],
                    ['Carelabel Bister','S'],
                    ['Qr cotton carelabel','XL'],
                    ['Stickers','XXL'],
                ];

                foreach ($data as $index => $row) {
                    $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                    ?>
                    <tr class="<?= $rowClass ?>">
                        <td><?= $row[0] ?></td>
                        <td><?= $row[1] ?></td>
                        <td><span class="stateRTP2"><img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">RTP</span></td>
                        <td class="ActionsRow" style="display: none">
                            <button class="btn-validat" onclick="changeBackgroundColor(this); event.stopPropagation();">
                                <i class="bi bi-check2"></i>&nbsp Validate
                            </button>
                            <button class="btn-refuse">
                                <i class="bi bi-x-lg"></i>&nbsp Refuse
                            </button>
                            <button class="btn-devalidate2">
                                <i class="bi bi-trash3"></i>&nbsp Devalidate
                            </button>
                        </td>
                        <td>
                            <button class="btn-comment" onclick="openPopupCM(); changeBackgroundColor(this); event.stopPropagation();">
                                <i class="bi bi-chat-right-text"></i>&nbsp Comment
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
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

    

     	
<script src="JS/corporate_dashboard.js"></script>

<script>

function changeBackgroundColor(button) {
    button.style.backgroundColor = "gray";
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

