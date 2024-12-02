<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ready to Print - MyEticNet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/readytoprint_dup.css">

</head>
<body>
    <main class="main-content" id="main-content">
        <div class="filter-section">
            <button class="filter-btn active" data-status="all">All</button>
            <button class="filter-btn" data-status="Waiting validation">Waiting validation</button>
            <button class="filter-btn" data-status="Validated">Validated</button>
            <button class="filter-btn" data-status="Refused">Refused</button>
            <button class="filter-btn" data-status="Devalidated">Devalidated</button>
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
        <div class="table-container">
            <table id="myTable" class="table1">
                <thead class="entête">
                    <tr>
                        <th>OF</th>
                        <th>State <i class="bi bi-arrow-down"></i></span></th>                
                        <th>RTP visualisation <i class="bi bi-arrow-down"></i></th>
                        <th>Action <i class="bi bi-arrow-down"></i></th>               
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [
                        ['0133206', 'Validated', ['RTP1', 'RTP2', 'RTP3'], 'Action'],
                        ['0133206', 'Validated', ['RTP1', 'RTP2'], 'Action'],
						['0133206', 'Waiting validation', ['RTP1', 'RTP2', 'RTP3', 'RTP4','RTP5'], 'Action'],
                        ['0133206', 'Refused', ['RTP1'], 'Action'],
                        ['0133206', 'Devalidated', ['RTP1', 'RTP2'], 'Action'],
						['0133206', 'Waiting validation', ['RTP1', 'RTP2', 'RTP3', 'RTP4','RTP5'], 'Action'],
                        ['0133206', 'Validated', ['RTP1', 'RTP2'], 'Action'],
						['0133206', 'Refused', ['RTP1', 'RTP2', 'RTP3'], 'Action'],
                        ['0133206', 'Waiting validation', ['RTP1', 'RTP2', 'RTP3', 'RTP4'], 'Action'],
                        ['0133206', 'Refused', ['RTP1','RTP2'], 'Action'],
                        ['0133206', 'Refused', ['RTP1'], 'Action'],
                        ['0133206', 'Waiting validation', ['RTP1', 'RTP2', 'RTP3', 'RTP4','RTP5'], 'Action'],
						['0133206', 'Validated', ['RTP1', 'RTP2', 'RTP3'], 'Action'],
						['0133206', 'Waiting validation', ['RTP1', 'RTP2', 'RTP3', 'RTP4','RTP5'], 'Action'],
                    ];

                    foreach ($data as $index => $row) {
                        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                        ?>
                        <tr class="main-row <?= $rowClass ?>">
                            <td><?= $row[0] ?></td>
                            <td><span class="state <?= strtolower($row[1]) ?>"><?= $row[1] ?></span></td>
                            <td>
                                <div class="rtp-container">
                                    <?php foreach ($row[2] as $rtp) { ?>
                                        <span class="rtp-item btn-rtp" data-img="Image/gevenchy.png">
                                            <img src="Image/vue.png" alt="RTP Icon" class="rtp-icon">
                                            <?= $rtp ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($row[1] == 'Waiting validation') { ?>
                                    <button class="btn-validat">
                                        <i class="bi bi-check2"></i>&nbsp
                                        Validate
                                    </button>
                                    <button class="btn-refuse">
                                        <i class="bi bi-x-lg"></i>&nbsp
                                        Refuse
                                    </button>
                                <?php } elseif ($row[1] == 'Validated') { ?>
                                    <button class="btn-devalidate">
                                     <i class="bi bi-trash3"></i>  &nbsp
									 Devalidate
                                    </button>
                                <?php } elseif ($row[1] == 'Devalidated' || $row[1] == 'Refused') { ?>
                                    <button class="btn-comment">
                                    <i class="bi bi-chat-right-dots"></i> &nbsp Comment
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <!-- Comment Modal -->
    <div id="commentModal" class="modal">
        <div class="modal-content">
            
            <div class="comment-title">Comment:</div>
			<span class="close-btn">&#215;</span>
            <div class="comment-box">
                <textarea placeholder="Write" class="comment-input"></textarea>
                <button class="send-btn">Send <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <div class="modal-content">            
            <div class="comment-title">Preview</div>
			<span class="close-btn">&times;</span>
            <img id="modalImage" class="modal-img" src="" alt="Image Preview">
            <button class="download-btn" id="downloadBtn">
            <i class="bi bi-download"></i>
			Download</button>
        </div>
    </div>
	
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
	
    <script src="js/readytoprint_dup.js"></script>

	
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
