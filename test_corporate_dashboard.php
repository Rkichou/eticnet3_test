
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', '1G');
ini_set('max_execution_time', 300);
require_once("config.inc.php");
require_once("includes/is_session_active.php");

$serverRoot = $_SERVER['DOCUMENT_ROOT'];


// Reconstitution du nom de BAT
$initDirectory=$_SESSION['prefix_contractor'];
$batsDirectoryV = "bats/" . $initDirectory ."/validate/";
$batsDirectoryW = "bats/" . $initDirectory ."/waiting/";

$status[0]='Canceled';
	$status[1]='New orders';
	$status[2]='Wait for BAT validation';
	$status[3]='Wait for Manufacturer validation';
	$status[4]='Waiting production';
	$status[5]='In production';
	$status[6]='Quality control'; 
	$status[7]='Shipped';
	$status[8]='Product By Supplier';
    $status[9]='Ready for shipping';
// Rècupère les printshops
		$sql2="select * from printshop order by name";
		$retour2=mysqli_query($con,$sql2); 
		while($row2=mysqli_fetch_array($retour2))
		{
			$tbl_printshop[$row2['id']] = $row2['name'];
			
		}
if(isset($_POST['rows'])){
$maxRecord=$_POST['rows'];
}
else{
$maxRecord=20;
}
$prefix=$_SESSION['prefix_contractor'];
$selectedStatus = '0,1,2,3,4,5,6,7,8,9';
$active="";
// Vérifie les statuts productions et alimente la clause whereStateProduction
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
<link rel="stylesheet" href="css/PS_dashboard.css">
        <div class="filter-section">
          <button class="filter-btn active" data-status="all" onclick="set_status_state_dashboard('all',1);">All</button>
          <button class="filter-btn " data-status="Waiting confirmation" onclick="set_status_state_dashboard('Waiting confirmation','2');"><span class="notification-dot"></span> Waiting confirmation</button>
          <button class="filter-btn " data-status="Waiting production" onclick="set_status_state_dashboard('Waiting production','4');">Waiting production</button>
          <button class="filter-btn " data-status="In production" onclick="set_status_state_dashboard('In production','5');">In production</button>
          <button class="filter-btn " data-status="Quality control" onclick="set_status_state_dashboard('Quality control','6');">Quality control</button>
          <button class="filter-btn " data-status="Ready for shipping" onclick="set_status_state_dashboard('Ready for shipping','9');">Ready for shipping</button>
		  <button class="filter-btn" data-status="Shipped" onclick="set_status_state_dashboard('Shipped','7');">Shipped</button>
          <button class="filter-btn " data-status="Canceled" onclick="set_status_state_dashboard('Canceled','0');">Canceled</button>

        </div>
        <div class="order-summary">
        <form id="searchForm" method="POST" action="">
    <div class="search-container">
        <input type="text" name="search_query" id="search_query" class="search-input" placeholder="Search" value="<?= isset($_POST['search_query']) ? htmlspecialchars($_POST['search_query']) : '' ?>">
        <button class="search-btn">
                        <img src="images/icones/search.svg">&nbsp;
                    </button>
    </div>
</form>


<?php
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
?>

            <div class="status-summary">
                <span class="status waitingcheck">Waiting check: 2</span>
                <span class="status waitingryp">Waiting RTP: 2</span>
                <span class="status in-time">In time: 28</span>
                <span class="status priority">Priority: <?= $nbUrgent ?></span>
                <span class="status refused">Late: 2</span>
            </div>
            <div class="order-state-summary">
                <a href="includes/orders_state_summary.php?prefix=<?= $prefix ?>" target="_blank" class="order-summary-btn2">
                    <img src="images/icones/download.svg" class="navbar-icon"></img>
                    Orders state summary
                </a>
            </div>
        </div>
    <div >
    <table class="table1">
        <thead>
            <tr class='entete'>
                <th >P.O.</th>
                <th onclick="sortTable('reference')">ART COL <img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
                <th onclick="sortTable('made_in')">Made in <img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
                <th>Supplier</th>
                <th onclick="sortTable('product_name')">Product name <img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
                <?php if ($_SESSION['prefix_contractor'] == "lem") { ?>
                <th>Service </th>
                <th>Genre </th>
                <?php } ?>

				<th onclick="sortTable('date_integration')" class="DateOrderRow">Date order<img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
				<th class="DateCancelRow"style="display: none">Date cancel<img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
				<th class="ShippingDateRow" style="display: none">Shipping date<img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
				<th class="TrackNumRow" style="display: none">Tracking number<img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
				<th class="StateRow">State <img src='/images/icones/arrow-down.svg' alt='state'></th>
				<th onclick="sortTable('date_validation_supplier')" class="TimRemRow">Time remaining <img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
				<th class="AddRow">Delivery address </th>
				<th class="StatutRow">Statut </th>
<?php if($_SESSION['prefix_contractor']!="lem"){ ?>	
				<th class="PrintshopRow">Printshop<img src='/images/icones/arrow-down.svg' alt='Dashboard'></th>
<?php } ?>
				<th class="PriorityRow" style="display: none">Priority</th>
				<th class="ActionsRow" style="display: none">Actions</th>
				<th>Comments</th>
            </tr>
        </thead>
        <tbody id="dashboard-table-content">
    <?php 
    $whereStateProduction="";
    // Calcul la pagination
	if ($selectedStatus !== 'all') {
        $whereStateProduction = "WHERE status in (" . mysqli_real_escape_string($con, $selectedStatus) . ")";
    }
	if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan"){
		$sql="select count(*) from " . $_SESSION['prefix_contractor'] . "_orders $whereStateProduction group by num_of, reference ";
	}
    else{
		$sql="select count(*) from " . $_SESSION['prefix_contractor'] . "_orders $whereStateProduction group by num_of ";
	}
	//echo $whereStateProduction;
	$retour=mysqli_query($con,$sql);
	// Group retourne un tableau il faut l'additionner
	$nbRows = mysqli_num_rows($retour);
	$nbSheets=ceil($maxRecord/$maxRecord);
    $table="ORDERS";
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

  
// Définir la colonne de tri et l'ordre par défaut
$sortColumn = 'date_integration';
$sortOrder = 'desc';
$searchQuery = isset($_POST['search_query']) ? mysqli_real_escape_string($con, $_POST['search_query']) : '';
$whereStateProduction = "WHERE 1=1"; // Assure une condition initiale toujours vraie

if ($selectedStatus !== 'all') {
    $whereStateProduction .= " AND status IN (" . mysqli_real_escape_string($con, $selectedStatus) . ")";
}



// Vérifier si une colonne de tri a été sélectionnée
if (isset($_POST['sort_column'])) {
    $validColumns = ['num_of', 'reference', 'made_in', 'product_name', 'date_integration'];
    if (in_array($_POST['sort_column'], $validColumns)) {
        $sortColumn = $_POST['sort_column'];
    }
}

// Vérifier l'ordre de tri
if (isset($_POST['sort_order']) && in_array(strtolower($_POST['sort_order']), ['asc', 'desc'])) {
    $sortOrder = $_POST['sort_order'];
}

$whereStateProduction = "";
if ($selectedStatus !== 'all') {
    $whereStateProduction = "WHERE status in (" . mysqli_real_escape_string($con, $selectedStatus) . ")";
}
if (!empty($searchQuery)) {
    $whereStateProduction .= " AND (num_of LIKE '%$searchQuery%' 
                                   OR reference LIKE '%$searchQuery%' 
                                   OR made_in LIKE '%$searchQuery%' 
                                   OR code_supplier LIKE '%$searchQuery%' 
                                   )";
}


// Modifier la requête SQL pour inclure le tri dynamique
if ($_SESSION['prefix_contractor'] == "mmg" || $_SESSION['prefix_contractor'] == "lan") {
    $ordersQuery = "SELECT * FROM " . $_SESSION['prefix_contractor'] . "_orders 
                    $whereStateProduction 
                    GROUP BY num_of, reference 
                    ORDER BY $sortColumn $sortOrder 
                    LIMIT $offset, $maxRecord;";
} else {
    $ordersQuery = "SELECT * FROM " . $_SESSION['prefix_contractor'] . "_orders 
                    $whereStateProduction 
                    GROUP BY num_of 
                    ORDER BY $sortColumn $sortOrder 
                    LIMIT $offset, $maxRecord;";
}

// Exécuter la requête
$ordersResult = mysqli_query($con, $ordersQuery);


$data = [];

while ($ordersRow = mysqli_fetch_assoc($ordersResult)) {

    $date_integration = new DateTime($ordersRow['date_integration']);
    $date_delivery = new DateTime();
    if($ordersRow['date_delivery']){
        $date_delivery = new DateTime($ordersRow['date_delivery']);
    }
    $horodatage_customer_cancel = new DateTime();
    if($ordersRow['horodatage_customer_cancel']){
        $horodatage_customer_cancel = new DateTime($ordersRow['horodatage_customer_cancel']);
    }
    $etat=$ordersRow['status'];
    // Construire chaque ligne du tableau à partir des colonnes de la table `lem_orders`.
    $data[] = [
        $ordersRow['num_of'],    // le numéro de commande      
        $ordersRow['reference'],   
        $ordersRow['made_in'],       
        $ordersRow['code_supplier'],  
        $ordersRow['product_name'],     
        date_format($date_integration,"d/m/Y"),
        date_format($horodatage_customer_cancel,"d/m/Y"),     
        date_format($date_delivery,"d/m/Y"),   
        $ordersRow['tracking'], 
        'In time', // Par exemple, le statut de la commande (ex. "Priority", "In time", etc.)
        '4 days', //$ordersRow['delay'],                  
        $status[$ordersRow['status']],
        $ordersRow['id_printshop'],
        $ordersRow['other_delivery_adress'],
        $ordersRow['urgent_mode'],
        $ordersRow['comment_contractor'],
        $ordersRow['status'],
        $ordersRow['genre'],
        $ordersRow['code_service'],
$ordersRow['comment_supplier'],
$ordersRow['comment_production'],
$ordersRow['comment_kac'],
    ];
}
    

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
            <td class="left">
                <button class="icon <?= $btnClass ?>"  >
                    <img src="images/icones/open-green.svg" alt="Icon">
                </button>
                <?= $row[0] ?>
            </td>
            <td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
<?php 
    $resultArray[]=array();
    $sqlS="select * from  users_adresses  where `contractor`='" . $_SESSION['prefix_contractor_id'] . "' and  code_supplier='" . $row[3]. "' and default_adress=1 limit 1";
	$retourS=mysqli_query($con,$sqlS);
	// Vérifie si on a bien une adresse de retour
	if(mysqli_num_rows($retourS)<1)
	{
		$sqlS="select * from  users_adresses  where `contractor`='" . $_SESSION['prefix_contractor_id'] . "' and  code_supplier='" . $row[3]. "'  limit 1";
		$retourS=mysqli_query($con,$sqlS);
	}
    $rowS = mysqli_fetch_object($retourS);		 
?>
            <td><button class="info-btn" data-popup="popup-<?= $index ?>">
                    <img src="images/icones/infos.svg" alt="Info">
					<div class="popup" id="popup-<?= $index ?>">
                        <?php if(mysqli_num_rows($retourS) != 0){ 
                        echo  "<b>Code supplier: </b>". $row[3] . "</br>";
                        echo  "<b>Company: </b>". $rowS->company_name; }?> 
                    </div>
                </button>
            </td>
            <td><?= strtolower($row[4]) ?></td>
            <?php if($_SESSION['prefix_contractor']=="lem"){ ?>
                <td><?= $row[18] ?></td>
                <td><?= $row[17] ?></td>
            <?php } ?>
            <td class="DateOrderRow"><?= $row[5] ?></td>
			<td class="DateCancelRow"style="display: none"><?= $row[6] ?></td>
			<td class="ShippingDateRow" style="display: none"><?= $row[7] ?></td>
			<td class="TrackNumRow" style="display: none"><?= $row[8] ?> <img src="images/icones/copy.svg" alt="copy" onclick="event.stopPropagation();"></td>	
			<td class="StateRow"><span class="state stateRTP1"><?= $row[9] ?></span></td>
            <td class="TimRemRow"><?= $row[10] ?></td>
			<td class="AddRow">
                    <button class="info-btn" data-popup="popup-<?= $index ?>">
                        <img src="images/icones/map-pin-black.svg" alt="Info">
						<div class="popup" id="popup-<?= $index ?>">
                        <strong>Livraison</strong>
                        <?php 
                            if($row[13]=="")
		                    {                              
								echo $rowS->company_name . "<br>"  ;
                                echo $rowS->country . "<br>"  ;
								echo $rowS->adresse_1 . "<br>"  ;
								if($rowS->adresse_2 !="") { echo $rowS->adresse_2 . "<br>"; } 
                                if($rowS->adresse_3 !="") { echo $rowS->adresse_3 . "<br>"; } 
								echo $rowS->zip . "\r\n"  ;
								if($rowS->state !="") { echo $rowS->state . "\r\n"; } 
								echo $rowS->city . "<br> <br>" ;								
                                echo "<strong>Contact:</strong>";
								echo $rowS->contact . "<br>" ;										
								echo $rowS->email . "<br>" ;
                                echo $rowS->telephone . "<br>" ;
                               
							}
							else
							{
								echo $row[13]; // Affiche l'adresse sélectionnée pour cet O.F.
							}
						
                    ?>					
                    </div>
                    </button>
                    
            </td>
			<td class="StatutRow"><?= $row[11] ?></td>
<?php if($_SESSION['prefix_contractor']!="lem"){ ?>
			<td class="PrintshopRow"><?= $tbl_printshop[$row[12]] ?></td>
<?php } ?>
			<td class="PriorityRow" style="display: none" onclick="event.stopPropagation();">
                <?php  if($row[14]==0 )
				{
					echo "<input type='checkbox' name='default' onclick=\"set_orders_urgent('" . $row[0] . "','" . $row[1] . "');\">";
				}
				else
				{
					echo "<input type='checkbox' name='default' checked>";
				}?>
            </td>	
			<td class="ActionsRow" style="display: none">
				<?php  if(intval($row[16])>=1 && intval($row[16])<=3) { ?>
                    <button class="btn-rtpValid" onclick="event.stopPropagation(); openPopupRtpValid();">
                        <img src="images/icones/check.svg" alt="RTP validation">
                        Validate Order
                    </button>
                <?php } if(intval($row[16])>=1 && intval($row[16])<=4){ ?>
                    <button class="btn-rtpValid" onclick="event.stopPropagation();corporate_readytoprint('<?= $row[0]?>', '<?= $row[1] ?>')">
                        <img src="images/icones/check.svg" alt="RTP validation">
                        RTP validation
                    </button>
                <?php } ?>
                <?php 
                if(intval($row[16]) > 0 && intval($row[16]) < 5){
					// Exception mmg

					if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
					{
						echo "<button class='btn-delete' onclick=\"set_orders_cancel_mmg('" . $row[0] . "','" . $row[1] . "');event.stopPropagation();\"><img src='images/icones/trash-2.svg' alt='Cancel'> Cancel</button>";
					}
					else
					{
						echo "<button class='btn-delete' onclick=\"set_orders_cancel('" . addslashes($row[0]) . "');event.stopPropagation();\"><img src='images/icones/trash-2.svg' alt='Cancel'> Cancel</button>";
					}
				}
                echo "<button class='btn-duplicate' onclick=\"duplique_order('" . $row[0] . "','" . $row[1] . "');event.stopPropagation();\"><img src='images/icones/copy.svg' alt='Duplicate'> Duplicate</button>";	
                ?>				
            </td>			
			<td>
<?php $style =""; $btn_rouge="";
if ($row[15] == "" && $row[19] == "" && $row[20] == "" && $row[21] == ""){ 
    $style = "style=\"background-color:#AAAAAA\"";
}
else {
$btn_rouge = "<span class='comment-dot'></span>";
} ?>
                <button class="btn-comment" <?= $style ?> id='commentButton' data-toggle='modal' data-target='#commentPopup' onclick="event.stopPropagation();openPopupComment('<?= addslashes($row[0])  ?>', '<?= addslashes($row[1])  ?>');">
                    <img src='/images/icones/comment.svg' class='icone' alt='Comment'> Comment <?= $btn_rouge ?>
                </button>

            </td>

        </tr>
        <tr class="main-row2 <?= $rowClass ?>" style="display:none">
            <td colspan="13">
        <?php

        if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
        {
            $ordersType = "SELECT num_of,reference,type_label, SUM(qty_to_produce) as qty_to_produce_total FROM ".$_SESSION['prefix_contractor']."_orders Where num_of='".$row[0]."' and reference='".$row[1]."' group by type_label  order by type_label asc, id desc;";
        }
        else{
            $ordersType = "SELECT num_of,type_label, SUM(qty_to_produce) as qty_to_produce_total FROM ".$_SESSION['prefix_contractor']."_orders Where num_of='".$row[0]."' group by type_label order by type_label asc, id desc;";				
        }
        
        $resultType = mysqli_query($con, $ordersType);
        //echo $ordersType;
        while($rowType=mysqli_fetch_array($resultType))
        {
        ?>
            <div class="details-content">
                <span> <?php echo $rowType['type_label'] ." -  Total qty: ". $rowType['qty_to_produce_total'] ; ?></span>
                <img src='/images/icones/chevron-down.svg' class='icone' alt='Details'>
            </div>
            <table class="sub-table2 details-table">
                <thead>
                
                    <tr class="entete">
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
                    <?php 
                        if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
                        {
                            $sqlLigne = "SELECT * FROM ".$_SESSION['prefix_contractor']."_orders Where num_of='".$rowType['num_of']."' and reference='".$rowType['reference']."' and type_label='".$rowType['type_label']."' order by type_label asc, id desc;";
                        }
                        else{
                            $sqlLigne = "SELECT * FROM ".$_SESSION['prefix_contractor']."_orders Where num_of='".$rowType['num_of']."' and type_label='".$rowType['type_label']."' order by type_label asc, id desc;";				
                        }
                        $resultLigne = mysqli_query($con, $sqlLigne);
                        
                        while($rowLigne=mysqli_fetch_array($resultLigne))
                        {
                            $date_validation_bat="";
                        ?>
                        <tr>
                            <td> <?= $rowLigne['id'] ?></td>
                            <td><?= $rowLigne['num_of'] ?></td>
                            <td><?= $rowLigne['reference'] ?></td>
                            <td><?= $rowLigne['coloris'] ?></td>
                            <td><?= $rowLigne['size'] ?></td>
                            <td><?= $rowLigne['code_ean'] ?></td>
                            <td><?= $rowLigne['qty_init'] ?></td>
                            <td><?= $rowLigne['qty_to_produce'] ?></td>
                            <td><?= $status[$rowLigne['status']] ?></td>
                            <td>
                    
        <?php 
          $fullLinkImage="";  

        // Exception Lemaire
            if($_SESSION['prefix_contractor']=="lem")
            {
                if($rowLigne['type_ordre']=="COMPO")
                {
                    $num_of=explode('_', $rowLigne['num_of'], 2);
                    if($num_of[0]=="DUP"){																												
                        $fullNameBAT= $rowLigne['num_of']. "_" . $rowLigne['prefix_bat']  ;
                    }
                    else{
                    // Eliminer le _1 ou _2 en cas de commande introduite plusieurs fois
                        $fullNameBAT=$num_of[0] . "_" . $rowLigne['prefix_bat']  ;
                    }											
                    // ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
                    $fullNameBAT=str_replace("DUP_","",$fullNameBAT);
                    //echo $num_of[0];
                    // Recherche la dernière version validées
                    $sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by horodatage desc limit 1";
                    $retourB=mysqli_query($con,$sqlB);
                    // echo $sqlB; 	
                    while($rowB=mysqli_fetch_array($retourB))
                    {
                        $fullLinkImage=$rowB['bat_name'];
                        $date_validation_bat = $rowB['horodatage'];
                    }
                }
                else{
                $fullLinkImage="";
                $fullNameBAT="";
                }
            } // Fin Lemaire

        if(trim($fullLinkImage)>"")
        {
        //echo $batsDirectoryV;
            $tbl_name_image=explode("/",$fullLinkImage);
            if(isset($tbl_name_image))
            {
                //echo "<a href='../includes/visu_bat.php?source=" . $batsDirectoryV . $tbl_name_image[count($tbl_name_image)-1] . "' class='stateRTP1' target='_blank'><img src='images/icones/eye.svg' alt='RTP'>RTP</a>";

                $countBAT=0;// Affiche le nb de BAT à visualiser
                for ($n=1;$n<20;$n++)
                { 
                    $fileImageValidate=str_replace("_1.","_$n.",$tbl_name_image[count($tbl_name_image)-1]);										
                    //echo $batsDirectoryV . $fileImageValidate;
                    if(file_exists($batsDirectoryV . $fileImageValidate))
                    {
                        $countBAT++;
                    }
                    else
                    {
                        break;
                    }
                }
                if($countBAT>0)
				{
                    echo "<a href='includes/visu_bat.php?source=" . $batsDirectoryV . $tbl_name_image[count($tbl_name_image)-1] . "' class='stateRTP1'  onclick=\"window.open(this.href, 'newwindow', 'width=800,height=600'); return false;\"><img src='images/icones/eye.svg' alt='RTP'>RTP (" . $countBAT . ")</a>";
					//echo "(" . $countBAT . ")";
				}
            }

        }
        else // Bat en attente de validation
        {
            if($fullNameBAT!=""){

                unset($tbl_name_image);
                $countBAT=0;// Affiche le nb de BAT à visualiser
                for ($n=1;$n<20;$n++)
                {
                    if(file_exists($batsDirectoryW . $fullNameBAT . "$n.png"))
                    {
                        $countBAT++;
                        $extension='png';
                        //echo "<a href='" . $batsDirectoryW . $fullNameBAT . "$n.png' class='stateRTPWaiting' onclick=\"window.open(this.href, 'newwindow', 'width=800,height=600'); return false;\"><img src='images/icones/eye.svg' alt='RTP'>RTP</a>";
                    }
                    if(file_exists($batsDirectoryW . $fullNameBAT . "$n.bmp"))
                    {
                        $countBAT++;
                        $extension='bmp';
                        //echo "<a href='" . $batsDirectoryW . $fullNameBAT . "$n.bmp' class='stateRTPWaiting' onclick=\"window.open(this.href, 'newwindow', 'width=800,height=600'); return false;\"><img src='images/icones/eye.svg' alt='RTP'>RTP</a>";
                    }
                }
                if($countBAT>0){
                    echo "<a href='" . $batsDirectoryW . $fullNameBAT . "_$n.$extension' class='stateRTPWaiting' onclick=\"window.open(this.href, 'newwindow', 'width=800,height=600'); return false;\"><img src='images/icones/eye.svg' alt='RTP'>RTP (" . $countBAT . ")</a>";
                }
            }
        }
        ?>
            </td>
            <td>
                <button class="info-button">
                    <img src="images/icones/infos.svg" alt="Info">
                    <div class="popupp">
                        <p>Orders informations </p>
                        <p>Date upload BAT: </p>
 <?php
$customer_validate = $date_production = $date_valid_bat = new DateTime();
    if($date_validation_bat || $rowLigne['horodatage_customer_validate'] || $rowLigne['date_production']){
        $customer_validate = new DateTime($rowLigne['horodatage_customer_validate']);
        $date_production = new DateTime($rowLigne['date_production']);
        $date_valid_bat = new DateTime($date_validation_bat);
    }    
?>
                        <p>Date validation BAT: <?php if($date_validation_bat!=""){ echo date_format($date_valid_bat,"d/m/Y");} ?></p>
                        <p>Date confirm production : <?php if($rowLigne['horodatage_customer_validate']!=""){ echo  date_format($customer_validate,"d/m/Y"); } ?></p>                        
                        <p>Date begin production : <?php if($rowLigne['date_production']!=""){ echo date_format($date_production,"d/m/Y"); }  ?></p>
                    </div>
                </button>                
            </td>
        </tr>   
        <?php } ?>
 
    </tbody>
    </table>
                
    <?php } ?>
    </td>
</tr>
    <?php } ?>
</table> 
</div> 	
<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <div class="serach-modal-header">
                <button class="popup-close closeTick-btn" onclick="close_order_modal('popup-advanced-search')"><img src="images/icones/close.svg" alt="close" class="bi"></button>
                <h2 class="popup-title">Advanced research</h2>
            </div>
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

<!-- Popup de Commentaires -->
<div id="commentPopup" class="popupComment">
    <div class="popup-comment" id='order-details'>
            
    </div>
</div>

</tbody>

    

     	
<script src="js/corporate_dashboard.js"></script>

<script>

function changeBackgroundColor(button) {
    button.style.backgroundColor = "gray";
}
document.getElementById('searchButton').addEventListener('click', function() {
    const searchQuery = document.getElementById('search_query').value;

    // Envoi de la requête AJAX
    fetch('', { // URL vide pour envoyer la requête au même fichier PHP
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `search_query=${encodeURIComponent(searchQuery)}`,
    })
    .then(response => response.text())
    .then(data => {
        // Remplacez le contenu du tableau avec les nouveaux résultats
        document.getElementById('dashboard-table-content').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
    });
});


</script>

<script>
function sortTable(column) {
    // Déterminer l'ordre actuel de tri et alterner
    let sortOrder = (sessionStorage.getItem("sortOrder") === "asc") ? "desc" : "asc";

    // Créer un formulaire pour soumettre la colonne de tri via POST
    var form = document.createElement("form");
    form.method = "POST";
    form.action = ""; // La même page

    // Ajouter l'information sur la colonne de tri au formulaire
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "sort_column";
    input.value = column;
    form.appendChild(input);

    // Ajouter un champ pour l'ordre de tri (asc/desc)
    var orderInput = document.createElement("input");
    orderInput.type = "hidden";
    orderInput.name = "sort_order";
    orderInput.value = sortOrder; // Alternance de tri
    form.appendChild(orderInput);

    // Stocker l'ordre de tri et la colonne dans le sessionStorage
    sessionStorage.setItem("sortColumn", column);
    sessionStorage.setItem("sortOrder", sortOrder);

    // Soumettre le formulaire
    document.body.appendChild(form);
    form.submit();
}

// Fonction pour mettre à jour les icônes de tri
function updateSortIcons() {
    // Réinitialiser les icônes sur toutes les colonnes
    var thElements = document.querySelectorAll(".table1 th");
    thElements.forEach(function (th) {
        th.classList.remove("sort-asc", "sort-desc");
    });

    // Récupérer les valeurs de tri du sessionStorage
    var column = sessionStorage.getItem("sortColumn");
    var sortOrder = sessionStorage.getItem("sortOrder");

    if (column && sortOrder) {
        // Appliquer la classe de tri à la colonne triée
        var columnTh = document.querySelector("th[onclick=\"sortTable('" + column + "')\"]");
        if (columnTh) {
            if (sortOrder === "asc") {
                columnTh.classList.add("sort-asc");
            } else {
                columnTh.classList.add("sort-desc");
            }
        }
    }
}

// Mettre à jour les icônes une fois le chargement de la page terminé
document.addEventListener("DOMContentLoaded", function() {
    updateSortIcons();
});

</script>
<style>.sort-asc img {
    transform: rotate(180deg);
}

.sort-desc img {
    transform: rotate(0deg);
}
</style>


   
<div class="footer">

     <div class="pagination">
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" onchange="set_rows('corporate_dashboard');">
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

