<?php
require_once("config.inc.php");
	require_once("languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("includes/is_session_active.php");

	$id_user=$_SESSION['id'];
	$sql3="select * from contractors where prefix = '".$_SESSION['prefix_contractor']."';";
	$retour3=mysqli_query($con,$sql3); 

	$row3 = mysqli_fetch_object($retour3);
    $contractor= $row3->name;
	// Rècupère les unités de facturations
	$sql2="select * from unite_facturation ";
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		if($row2['name']=="AU MILLE"){
			$row2['name']="1000 pcs";
		}
		else if($row2['name']=="U"){
			$row2['name']="1 pc";
		}
		
		$tbl_unite[$row2['id']] =  $row2['name'];
	}
if(isset($_POST['rows'])){
$maxRecord=$_POST['rows'];
}
else{
$maxRecord=20;
}
$sql="select count(*) from cart where id_user = '".$id_user."' and status = 1; ";
	
			// echo $sql;
	$retour=mysqli_query($con,$sql);
	// Group retourne un tableau il faut l'additionner
	$nbRows = mysqli_num_rows($retour);
	$nbSheets=ceil($maxRecord/$maxRecord);
if($nbRows<$maxRecord){
    $nbSheets=1;
}
$table="ARTICLES";
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
<link rel="stylesheet" href="css/orderhistory_dup.css"> 

	    <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn" onclick="openPopupAVS()">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i  id="btn-open-popup" class="bi bi-sliders"></i>
                    </button>
                </div>
          </div>
          
        
        <div class="table-responsive">
            <table class="table1">
                <thead class="entête">
                    <tr>
                        <th>Order’s number <i class="bi bi-arrow-down"></i></th>
                        <th>Date <i class="bi bi-arrow-down"></i></th>
						<th>Price <i class="bi bi-arrow-down"></i></th>
						<th>Ordered by</th>
						<th>Tracking number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

$sqlD="select * FROM users where id='" . $_SESSION['id'] . "'";
$price="";
$retourD=mysqli_query($con,$sqlD); 
$rowD=mysqli_fetch_object($retourD);
$devise= $rowD->devise;
$user_name=$rowD->user_name;
$sqlCompany="Select * from users_adresses where id_user = '".$id_user."' ;";
$retourCompany=mysqli_query($con,$sqlCompany);

 $sql="select * from cart where id_user = '".$id_user."' and status = 1 limit ".$offset .",". $maxRecord ."; ";
	$retour=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($retour))
	{
        $sql2="select * from articles where prefix_contractor='" . $_SESSION['prefix_contractor'] . "' and ref_produit_fini= '".$row['reference_article'] ."'; ";
	    $retour2=mysqli_query($con,$sql2);
        $row2=mysqli_fetch_object($retour2);
        
        switch ($devise){
            case "{1}": 
                $price=$row2->price_eur * $row['qty'] . " &euro; ";
                break;
            case "{2}":
                $price= $row2->price_usd * $row['qty'] . " $ ";
                break;
            case "{3}":
                $price= $row2->price_cny * $row['qty'] . " &yen";
                break;
        }
        $date_validation = new DateTime($row['date_validation']);

        $sqlCommande="select * from ".$_SESSION['prefix_contractor']."_orders where num_of = '".$row['num_commande']."' ; ";
        $retourCommande=mysqli_query($con,$sqlCommande);
        $rowCommande=mysqli_fetch_object($retourCommande);
        $tracking=$rowCommande->tracking;

        $data[] = [
                $row['num_commande'],    // le numéro de commande      
                date_format($date_validation,"d/m/Y"), 
                $price, 
                $user_name. " - ". $contractor, 
                $tracking,
            
            ];
            }
                    foreach ($data as $index => $row) {
                        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
                        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                        ?>
                        <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
                            <td class="left">
                                <button class="icon <?= $btnClass ?>" >
                                   <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                                </button>
                                <?= $row[0] ?>
                            </td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td><?= $row[4] ?></td>

                            <td>
                                <button class="btn-Bill" onclick="openQTYPopup(); event.stopPropagation();">
								<i class="bi bi-download"></i>&nbsp; 
								Summary</button>
                                <button class="btn-Place" onclick="openPopup(); event.stopPropagation();">
								<img src="Image/placeOr.png" alt="Dashboard" class="navbar-iconPlace"> 
								Re-order</button>
                            </td>
                        </tr>
<tr class="details-row">
    <td colspan="9">
        <div class="details-content">
            <div class="details-container">
                <div class="details-info details-info1">
                    <strong style="font-size: 18px; font-weight: bold; padding-right: 170px;">Order summary :</strong><br>
					
                    <table class="order-summary1">
            <thead class="entête1">				
                <tr>
                    <th>Reference</th>
                    <th>Designation</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
    <?php 
    /*$sqlReference="select * from cart where num_commande = '".$row[0]."' and status = 1";
        $retourReference=mysqli_query($con,$sqlReference);
        while($rowReference=mysqli_fetch_array($retourReference))
        {*/
    ?>
    <tr>
        <td><?php //$rowReference['reference_article'] ?></td>
        <?php 
            /*$sql2="select * from articles where prefix_contractor='" . $_SESSION['prefix_contractor'] . "' and ref_produit_fini= '".$row['reference_article'] ."'; ";
                $retour2=mysqli_query($con,$sql2);
                $row2=mysqli_fetch_object($retour2);
            $designation= $row2->libelle;*/
        ?>
        <td><?php //$designation ?></td>
        <td><?php //$rowReference['qty'] ?></td>
        <td>100 000,00 €</td>
    </tr>
    <?php //} ?>
    <tr class="total-row">
        <td colspan="3" style="padding-right: 80px;">Total :</td>
        <td>400 000,00 €</td>
    </tr>
</table>

                </div>
                <div class="details-info details-info2">
                    <strong style="font-size: 18px; font-weight: bold; ">Orders informations :</strong><br>
                    <div class="details-info3">
                        <strong style="font-size: 14px; font-weight: bold;">Shipping address</strong><br>
                        Orient international holding home textile<br>
                        No. 76, opposite Yangkengtang Park<br>
                        18020990745 Dongguan City<br>
                        Yuan Meizhen<br>
                        China
                    </div>
                    <div class="details-info4">
                        <strong style="font-size: 14px; font-weight: bold;">Billing address</strong><br>
                        Nom du client<br>
                        X rue de Blablabla<br>
                        Lieu dit<br>
                        ZIP CODE City<br>
                        Province / Region<br>
                        Country
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    <!-- popup place OR-->
	 <div id="popup" class="popup">
        <div class="popup-content">
            
            <div class="popup-header">
                <h3 class="left-align2">Reorder</h3>				
                <button class="popup-delete"><img src="Image/deletepopup.png" alt="Delete" class="popup-delete-icon"></button>
				<span class="close" onclick="closePopup()"><i class="bi bi-x-lg"></i></span>
            </div>
            <div class="popup-body">
			    <h6 class="left-align0">CD296</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
			<div class="popup-body">
			    <h6 class="left-align0">CD232</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
			<div class="popup-body">
			    <h6 class="left-align0">CD285</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
			<div class="popup-body">
			    <h6 class="left-align0">CD298</h6>
                <select class="popup-select">
                    <option>Etic Europe Portugal</option>
                </select>
                <input type="text" class="popup-input" placeholder="Quantity">
                <button class="popup-cancel" onclick="closePopup()"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="popup-footer">
                <button class="popup-add-site">+ Add site</button>
                <button class="popup-validate">Place order</button>
            </div>
        </div>
    </div>
	
	<!-- recheche rapide  -->
 <div id="popup-advanced-search" class="modal">
        <div class="modal-content">
            <span class="popup-close" onclick="closePopupAVS()"><i id="btn-close-popup" class="bi bi-x-lg"></i></span>
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
                        <option>Label type</option>
                    </select>
				    <input type="text" placeholder="Size" class="input-field2">
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
	
	

    <!-- <script src="JS/printshop_store.js"></script> -->
	<script>

	</script>
</body>
    <link rel="stylesheet" href="css/footer_dup.css">
<div class="footer">
     <div class="pagination">
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select" onchange="set_rows('corporate_orderhistory');">
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

