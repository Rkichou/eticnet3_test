<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="css/ticketing_dup.css">

</head>
<body>
    <main class="main-content" id="main-content">
        <div class="filter-section">
            <button class="filter-btn active" data-status="all">
                All
            </button>
            <button class="filter-btn" data-status="Awaiting">
                Awaiting
            </button>
            <button class="filter-btn" data-status="In progress">
                In progress
            </button>
			<button class="filter-btn" data-status="Resolved">
                Resolved
            </button>
            
            
        </div>
        <div class="order-summary">
            <div class="status-summary">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i class="bi bi-sliders"></i>
                    </button>
                </div>
                
            </div>
            <button class="NewTick-btn">
                <i class="bi bi-plus-lg"></i>&nbsp Create new ticket
            </button>
            
        </div>
        <div class="table-responsive">
            <table class="table1">
                <thead class="entête">
                    <tr>
                        <th>Ticket n° <i class="bi bi-arrow-down"></i></th>
                        <th>Submit date <i class="bi bi-arrow-down"></i></th>
						<th>Customer <i class="bi bi-arrow-down"></i></th>
						<th>Name - 1st name </th>
						<th>Email  <i class="bi bi-arrow-down"></i></th>
						<th>Phone <i class="bi bi-arrow-down"></i></th>
						<th>Statut <i class="bi bi-arrow-down"></i></th>
						<th>Informations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [
                        ['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'In progress'],
                        ['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Awaiting'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'In progress'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Awaiting'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Resolved'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Resolved'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Stand by'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'In progress'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Awaiting'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'In progress'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Awaiting'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Resolved'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'In progress'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Resolved'],
						['0133206', 'XX/XX/XXXX', 'Customer', 'Nom Prénom', 'Email', 'Phone', 'Resolved'],
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
							<td>
                               <button class="info-button" onclick="event.stopPropagation();">
                                 <img src="Image/Information.png" alt="Info" style="width: 18px; height: 18px;">
                                </button>                
                            </td> 
                        </tr>
                        <tr class="main-row <?= $rowClass ?>" style="display: none;">
    <td colspan="9">
        <div class="details-content">
            <div class="details-container">
                <div class="details-info details-info1">
                    <h4>Titre de la demande</h4>
                    <p>Lorem ipsum dolor sit amet consectetur. Semper et ut bibendum in dictumst fermentum velit sit. Vestibulum et etiam malesuada gravida egestas ut netus nibh eget. At ac vel dui purus nisl dui. Metus mauris sed lacus in eget facilisis. Ac eget mattis lacus vestibulum lorem lorem. Vitae velit sed vulputate purus sodales tincidunt porta.</p>
                    <button class="file-button"><i class="bi bi-download"></i> tableur.xls</button>
                    <button class="file-button"><i class="bi bi-download"></i> feuille.pdf</button>
                </div>
                
                
                <div class="details-info details-info4">
                    <textarea placeholder="Answer" class="Answer-input"></textarea>
                    <button class="attach-button"><i class="bi bi-paperclip"></i>Attached file</button>
                    <button class="send-button">Send &nbsp <i class="bi bi-send"></i></button>
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
	<!-- Comment Modal -->
    <div id="NewTick" class="modal">
    <div class="modal-content">
        <span class="closeTick-btn"><i class="bi bi-x-lg"></i></span>
        <h5>Create new ticket</h5><br>
		<h4 class="comment-title">Message</h4>
        <div class="comment-box">
            <textarea placeholder="Write here..." class="comment-input"></textarea>
            <div class="file-buttons">
                <button class="download-btn"><i class="bi bi-download"></i>&nbsp tableur.xls</button>
                <button class="download-btn"><i class="bi bi-download"></i>&nbsp feuille.pdf</button>
            </div>
			<div>
            <button class="attach-btn"><i class="bi bi-paperclip"></i>Attached file</button>
            <button class="sendTick-btn">Send &nbsp <i class="bi bi-send"></i></button>
			</div>
        </div>
    </div>
</div>

    <script src="js/ticketing_dup.js"></script>
<script>
	//pour popup comment
// Fonction pour ouvrir la popup "Add Word"

	function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}

// Fonction pour fermer la popup
function closePopup(popupId) {
    document.getElementById(popupId).style.display = 'none';
}

// Ajouter des écouteurs d'événements aux boutons
document.querySelector('.NewTick-btn').addEventListener('click', () => openPopup('NewTick'));

document.querySelector('.closeTick-btn').addEventListener('click', () => closePopup('NewTick'));
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
