<?php 
require_once("config.inc.php");
	require_once("includes/is_session_active.php");
    $status[1]='Awaiting';
	$status[2]='Stand by';
	$status[3]='In progress';
	$status[4]='Resolved';
if(isset($_POST['rows'])){
$maxRecord=$_POST['rows'];
}
else{
$maxRecord=20;
}
$prefix=$_SESSION['prefix_contractor'];

$sql="select count(*) from ticketing where prefix_contractor='" . $prefix . "'";
$retour=mysqli_query($con,$sql);
	// Group retourne un tableau il faut l'additionner
	$nbRows = mysqli_num_rows($retour);
	$nbSheets=ceil($maxRecord/$maxRecord);
    $table="ticketing";
	$nomParametre="actual_sheet_" . $table;	// Récupère la pagination actuel
	if(!isset($_SESSION[$nomParametre]))
	{
		$actualSheet=1;
	}
	else
	{
	$actualSheet=$_SESSION[$nomParametre];
	}
	// Vérifie si la feuille actuelle n'est pas supérieur au nombre de feuilles max suite à une nouvelle recherche
	if ($actualSheet>$nbSheets)
	{
		$actualSheet=1;
	}
	if($actualSheet==1)
	{
		$offset=0;
	}
	else
	{
		$offset=$actualSheet*$maxRecord;
		$offset=$offset-$maxRecord; 
	}
?>
<style>
.SelectAssign{
	        padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            float: right;			
	        margin-top: -9%;
			box-sizing: border-box;
	        font-size: 14px;
	        color: #555555;
}
	
</style>

<link rel="stylesheet" href="css/ticketing.css">

        <div class="filter-section"> 
    <button class="filter-btn active" data-status="all" onclick="filterRowsByStatus('all')">
        All
    </button>
    <button class="filter-btn" data-status="Awaiting" onclick="filterRowsByStatus('Awaiting')">
        Awaiting
    </button>
    <button class="filter-btn" data-status="In progress" onclick="filterRowsByStatus('In progress')">
        In progress
    </button>
    <button class="filter-btn" data-status="Resolved" onclick="filterRowsByStatus('Resolved')">
        Resolved
    </button>
    <button class="filter-btn" data-status="Stand by" onclick="filterRowsByStatus('Stand by')">
        Stand by
    </button>
</div>
        <div class="order-summary">
            <div class="status-summary">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <img src='/images/icones/search.svg' alt='Ticket'> <i class="bi bi-sliders"></i>
                    </button>
                </div>
                
            </div>
            <button class="NewTick-btn" onclick="openPopup('NewTick')">
                <img src='/images/icones/plus.svg' alt='Ticket'> Create new ticket
            </button>
            
        </div>
        <div class="table-tickets">
            <table class="table1">
                <thead class="entête">
                    <tr>
                        <th>Ticket n° <img src='/images/icones/arrow-down.svg' alt='Ticket'></th>
                        <th>Submit date <img src='/images/icones/arrow-down.svg' alt='Ticket'></th>
						
						<th>Name - 1st name </th>
						<th>Service</th>
						<th>Email </th>
						<th>Phone </th>
						<th>Statut <img src='/images/icones/arrow-down.svg' alt='Ticket'></th>
						<th>Informations</th>
                    </tr>
                </thead>
                <tbody>
<?php 
    $sql="select * from ticketing where prefix_contractor='" . $prefix . "' order by date_soumission desc limit ".$offset .",". $maxRecord ."; ";
	$retour=mysqli_query($con,$sql);
    $data = [];
    while($row=mysqli_fetch_array($retour))
	{
        $sqlD="select * FROM users where id='" . $row['user_id'] . "'";
        $retourD=mysqli_query($con,$sqlD); 
        $rowD=mysqli_fetch_object($retourD);
            $user_name=$rowD->user_name;
            $email=$rowD->user_email;
            //$phone=$rowD->phone;
    // Dates
    $date_soumission = new DateTime($row['date_soumission']);
    $date_traitement = new DateTime();
    if($row['date_traitement']){
        $date_traitement = new DateTime($row['date_traitement']);
    }
    $date_resolution = new DateTime();
    if($row['date_resolution']){
        $date_resolution = new DateTime($row['date_resolution']);
    }

        $data[] = [
            $row['id'],    // le numéro de commande      
            date_format($date_soumission,"d/m/Y"),   
                   
            $user_name,  
            $row['service'],     
            
            $email,         
            'phone', 
            $status[$row['status']],
            $row['title'],  
            $row['message'],
            $row['reponse'],
            $row['files_attached'],
            date_format($date_traitement,"d/m/Y"), //$row['date_traitement']
            date_format($date_resolution,"d/m/Y"), //$row['date_resolution'] 
        
        ];
    }
    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
    ?>
        <tr class="ticket-main-row main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
            <td class="left">
                <button class="icon <?= $btnClass ?>" >
                    <img src="images/icones/open-green.svg" alt="Icon">
                </button>
                <?= $row[0] ?>
            </td>                 
			<td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
			<td><?= $row[5] ?></td>
            <td class="statusRow"><?= $row[6] ?></td>
            
			<td>
                <button class="info-button" onclick="show_infos();">
                    <img src="images/icones/infos.svg" alt="Info">
                </button>
                <div id="infos_ticket" class="modal-infos" style="display: none;">
                    <div class="infos-content">    
                        <p>Submit date: <?= $row[1] ?></p>
                        <p>Treatement Date: <?= $row[10] ?></p>
                        <p>Resolution Date: <?= $row[11] ?></p>			  
                    </div>
                </div>
            </td> 
        </tr>
        <tr class="main-row2 <?= $rowClass ?>" style="display: none;">
            <td colspan="9">
                <div class="details-content">
                    <div class="details-container">
                        <div class="details-info details-info1">
                            <h4><?= $row[7] ?></h4>
                            <p><?= $row[8] ?></p>
                            <button class="file-button"><img src="images/icones/download.svg" class="bi"> tableur.xls</button>                   
                        </div>                              
                        <div class="details-info details-info4">
                            <h4>Response</h4>
                            <p class="Answer-input"><?= $row[9] ?></p>                   					
                        </div>
                    </div>
                </div>
            </td>
        </tr>

       <?php } ?>
        </tbody>
    </table>
</div>

	<!-- Comment Modal -->
    <div id="NewTick" class="modal">
        <div class="modal-content">
            <div class="ticket-modal-header">               
                <h4>Create new ticket</h4>
                <span class="closeTick-btn" onclick="close_order_modal('NewTick')">
                    <img src="images/icones/close.svg" class="bi">
                </span>
            </div>
            <div>
                <h5 class="title">Message</h5>
                <select id="service" class="SelectAssign">
                    <option value="assign" disabled selected>Assign ticket to</option>
                    <option value="it">IT assistance</option>
                    <option value="order">Order assitance</option>                      
                </select>
            </div>			 
            <div class="comment-box">
                <input type="text" id="title" class="comment-title" placeholder="Message Tile">
                <textarea placeholder="Write here..." id="message" class="comment-input"></textarea>
                <div class="file-buttons">
                    <a href="#" class="download-btn"><img src="images/icones/send.svg" class="bi"></a>
                    
                </div>
                <div>
                    <button type="file" class="attach-btn"><img src="images/icones/send.svg" class="bi">Add file</button>
                    <button class="sendTick-btn" onclick="addTicket();">Send <img src="images/icones/send.svg" class="bi"></button>
                </div>
            </div>
            <div id="error-box" class="error-box"></div>
        </div>
    </div>
    


<link rel="stylesheet" href="css/footer_dup.css">
<div class="footer">
     <div class="pagination">
	 
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select" onchange="set_rows('corporate_ticket');">
                    <option value="20" <?php echo ($maxRecord == 20) ? 'selected' : ''; ?>>20</option>
                    <option value="30" <?php echo ($maxRecord == 30) ? 'selected' : ''; ?>>30</option>
                    <option value="50" <?php echo ($maxRecord == 50) ? 'selected' : ''; ?>>50</option>
                </select>
                <span>rows</span>
            </div>
        <a href="#" class="page-link0"> < Previous</a>
        <?php 
        if ($nbSheets<3){

            for ($i=1; $i<=$nbSheets;$i++){ ?>
                <a href="#" class="page-link"><?= $i ?></a>
            <?php 
            }
        }
        else {
            for ($i=1; $i<3;$i++){ ?>
                <a href="#" class="page-link"><?= $i ?></a>
            <?php 
            } ?>
            <span class="page-link">..</span>
            <a href="#" class="page-link"><?= $nbSheets ?></a>
        <?php } ?>
        <a href="#" class="page-link0">Next ></a>
    </div>
    
</div>
<script src="js/ticketing.js"></script>
