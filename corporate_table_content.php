<?php ini_set('memory_limit', '1G');
ini_set('max_execution_time', 300);
require_once("config.inc.php");
require_once("includes/is_session_active.php");
// Reconstitution du nom de BAT
$initDirectory=$_SESSION['prefix_contractor'];
$batsDirectoryV = "bats/" . $initDirectory ."/validate/";
$batsDirectoryW = "bats/" . $initDirectory ."/waiting/";

$valueStatus = $_GET['statusCode'];

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

    if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
	{
		$ordersQuery = "SELECT * FROM ".$_SESSION['prefix_contractor']."_orders $whereStateProduction group by num_of,reference limit " . $offset . "," . $maxRecord . ";";
	}
	else{
		$ordersQuery = "SELECT * FROM ".$_SESSION['prefix_contractor']."_orders $whereStateProduction group by num_of order by date_integration desc limit " . $offset . "," . $maxRecord . ";";				
	}
	//echo $ordersQuery; 
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
            <td><?php if($row[4]){ echo strtolower($row[4]); } else echo $row[4] ?></td>
            <?php if($_SESSION['prefix_contractor']=="lem"){ ?>
                <td><?= $row[18] ?></td>
                <td><?= $row[17] ?></td>
            <?php } ?>
            <td class="DateOrderRow"><?= $row[5] ?></td>
			<td class="DateCancelRow"style="display: none"><?= $row[6] ?></td>
			<td class="ShippingDateRow" style="display: none"><?= $row[7] ?></td>
			<td class="TrackNumRow" style="display: none"><?= $row[8] ?> <i class="bi bi-copy copy-btn" onclick='event.stopPropagation();navigator.clipboard.writeText("<?= $row[8] ?>");'></i></td>	
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
                        Validate RTP
                    </button>
				    <!-- <button class="btn-orderValid" onclick="event.stopPropagation(); openPopupRtpValid();">
                        <img src="images/icones/check.svg" alt="Order validation">
                        Validate order
                    </button>
					<button class="btn-waitingRtp" onclick="event.stopPropagation(); openPopupRtpValid();">
                        <img src="images/icones/wait.svg" alt="Waiting RTP">
                        Waiting RTP
                    </button> -->
                <?php } if(intval($row[16])>=1 && intval($row[16])<=4){ ?>
                    <!-- <button class="btn-rtpValid" onclick="event.stopPropagation();corporate_readytoprint('<?= $row[0]?>', '<?= $row[1] ?>')">
                        <img src="images/icones/check.svg" alt="RTP validation">
                        RTP validation
                    </button> -->
                <?php } ?>
                <?php 
				
				//affichage de duplicate selon le menu
				if($valueStatus == 1 || $valueStatus == 2){
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
				}
				else{
					echo "<button class='btn-duplicate' onclick=\"duplique_order('" . $row[0] . "','" . $row[1] . "');event.stopPropagation();\"><img src='images/icones/plus-square.svg' alt='Duplicate'> Duplicate</button>";	
				}
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
                        <th style="width: 132px;">RTP</th>
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
                            $customer_validate = $date_production = $date_valid_bat = "";
                            if($rowLigne['date_production']){ $date_production = new DateTime($rowLigne['date_production']);}
                            if($rowLigne['horodatage_customer_validate']){ $customer_validate = new DateTime($rowLigne['horodatage_customer_validate']);}
                                
                            if($date_validation_bat){ $date_valid_bat = new DateTime($date_validation_bat);}
                            
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
