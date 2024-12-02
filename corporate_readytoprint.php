
	<link rel="stylesheet" href="css/PS_dashboard_dup.css">
        <div class="filter-section">
          <button class="filter-btn active" data-status="all">All</button>
          <button class="filter-btn" data-status="Waiting validation"><span class="notification-dot"></span>&nbsp &nbsp Waiting for validation</button>
          <button class="filter-btn" data-status="Validated">Validated</button>
          <button class="filter-btn" data-status="Refused">Refused</button>
          <button class="filter-btn" data-status="Devalidated">Devalidated</button>
        </div>
        <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i class="bi bi-sliders" onclick="openPopupAdSh();"></i>
                    </button>
            </div>		   
        </div>
        <div id="dashboard-content">
            <table class="table1">
        <thead>
            <tr class='entete'>
                <th>OF</span></th>
                <th>Type <i class="bi bi-arrow-down"></i></th>
                <th>Reference <i class="bi bi-arrow-down"></i></th>
                <th>Statut <i class="bi bi-arrow-down"></i></th>
				<th style="width:8%;">Comments</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $data = [
        ['0133206','Carelabels', 'MIV3001','Waiting', 'Comment'],
        ['0133206','Carelabels', 'MIV3002','Waiting', 'Comment'],
        ['0133206','Carelabels', 'MIV3003','Waiting', 'Comment']
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
            <td><span class="state stateRTPwaiting"><?= $row[3] ?> <img src="images/exclam_icons.png" /></td>			
			<td>
                                <button class="btn-comment" onclick="event.stopPropagation();openPopupCM(); changeBackgroundColor(this); event.stopPropagation();">
                                    <i class="bi bi-chat-right-text"></i></i> &nbsp Comment
                                 </button>
            </td>

			
			
			
        </tr>
        <tr class="main-row2 <?= $rowClass ?>" style="display: none;">
            <td colspan="13">
                <div class="details-content">
                    <span> Care labels - Total qty: 14</span>
					<span class="flexfiller"></span>
					<span class="buttonValidateAll"><i class="bi bi-check"></i>&nbsp Validate all</span>
					<span class="buttonValidateAll" onclick="event.stopPropagation();openPopupRefuse(); event.stopPropagation();"><i class="bi bi-x"></i>&nbsp Refuse all</span>
                    <i class="fas fa-angle-down details-toggle"></i>
                </div>
                <table class="sub-table2 details-table" style="display: none;">
                    <thead>
                        <tr class="entete">
                            <th>Reference</th>
                            <th>ART COL</th>
                            <th>Size</th>
                            <th>RTP</th>
                            <th style="width:20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>MIC1159</td>
                            <td>N3175</td>
                            <td>U</td>
                            <td><span class="stateRTP2"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
                            <td>
                               <button class="info-button">
									<span class="buttonDevalidate"><i class="bi bi-arrow-counterclockwise"></i>&nbsp Devalidate</span>
                                </button>  
							    <button class="info-button">
									<span class="buttonRefuse" onclick="event.stopPropagation();openPopupRefuse(); event.stopPropagation();"><i class="bi bi-x"></i>&nbsp Refuse</span>
								</button>  
                            </td>
                        </tr>
                        <tr>
                            <td>MIC1159</td>
                            <td>N3176</td>
                            <td>U</td>
                            <td><span class="stateRTP2"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
                            <td>
                               <button class="info-button">
									<span class="buttonValidate"><i class="bi bi-check"></i>&nbsp Validate</span>
						         </button>  
							    <button class="info-button">
									<span class="buttonRefuse" onclick="event.stopPropagation();openPopupRefuse(); event.stopPropagation();"><i class="bi bi-x"></i>&nbsp Refuse</span>
								</button>             
                            </td>
                        </tr>
                        <tr>
                            <td>MIC1159</td>
                            <td>N3177</td>
                            <td>U</td>
                            <td><span class="stateRTP2"><i class="bi bi-eye"></i>&nbsp RTP</span></td>
                            <td>
                               <button class="info-button">
									<span class="buttonValidate"><i class="bi bi-check"></i>&nbsp Validate</span>
						         </button>  
							    <button class="info-button">
									<span class="buttonRefuse" onclick="event.stopPropagation();openPopupRefuse(); event.stopPropagation();"><i class="bi bi-x"></i>&nbsp Refuse</span>
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
                <tr class='entete'>
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
                            <button class="btn-comment" onclick=" event.stopPropagation();openPopupCM(); changeBackgroundColor(this); event.stopPropagation();">
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
        <h5 id="titlePopup">Comment</h5>
		
         <!-- <div class="customer-comment">
             <div class="header-row">
                <h5>Customer</h5>
                <p>11/03/2024, 10h52</p>
             </div>
            <p>Lorem ipsum dolor sit amet consectetur. Pellentesque id turpis faucibus ornare sit faucibus. Cursus in porttitor tristique faucibus enim mi. Commodo sit nisl vitae in felis quam in blandit. Purus sed tristique penatibus accumsan laoreet sollicitudin vivamus tincidunt amet. Malesuada auctor congue non viverra laoreet consectetur amet. Blandit aliquam lacinia tempus massa blandit vitae convallis proin est. Id.</p>
            
        </div> -->
        <div class="comment-input-section">
            <h5>Message</h5>
            <textarea placeholder="Write here..." class="comment-input"></textarea>
            <button id="sendCommentBtn" class="add-comment-btn">Send <i class="bi bi-send"></i></button>
			<button id="refuseRTPBtn" class="refuse-btn"> <i class="bi bi-x"></i> Refuse</button>
        </div>
    </div>
</div>

</tbody>

    

     	
<script src="js/corporate_dashboard.js"></script>

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

