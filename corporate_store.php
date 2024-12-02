
<?php
require_once("config.inc.php");
	require_once("languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("includes/is_session_active.php");

	$id_user=$_SESSION['id'];
	//Le nombre de commandes dans le cart
	$sqlG="select * from cart where id_user = '".$id_user."' and status = 0";
    $retourG=mysqli_query($con,$sqlG);
	$number=mysqli_num_rows($retourG);
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
$sql="select count(*) from articles where prefix_contractor='" . $_SESSION['prefix_contractor'] . "' and retails='O'; ";
	
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
<link rel="stylesheet" href="css/corporate_store.css">


		
        <div class="filter-section">
            <button class="filter-btn " data-status="all">
                <img src="images/icones/all.svg" alt="Dashboard" class="navbar-iconN">All
            </button>
            <button class="filter-btn" data-status="Woven label">
                <img src="images/icones/woven.svg" alt="Dashboard" class="navbar-iconN">Woven label
            </button>
            <button class="filter-btn" data-status="Hangtag">
                <img src="images/icones/tag.svg" alt="Dashboard" class="navbar-iconN">Hangtags
            </button>
            <button class="filter-btn" data-status="Sticker">
                <img src="images/icones/greetingcard.svg" alt="Dashboard" class="navbar-iconN">Stickers
            </button>
            <button class="filter-btn" data-status="Ropes">
                <img src="images/icones/lasso.svg" alt="Dashboard" class="navbar-iconN">Ropes
            </button>
            <button class="filter-btn" data-status="Packaging">
                <img src="images/icones/archivebox.svg" alt="Dashboard" class="navbar-iconN">Packaging
            </button>
            <button class="filter-btn" data-status="Ribbon">
                <img src="images/icones/bookmark.svg" alt="Dashboard" class="navbar-iconN">Ribbon
            </button>
			<button class="filter-btn" data-status="Ink">
                <img src="images/icones/drop.svg" alt="Dashboard" class="navbar-iconN">Ink
            </button>
            <div class="status-summary">
			<button class="OrderHis-btn">
                    Extract stock &nbsp <img src="images/icones/upload.svg" class="navbar-icon"></img>
                </button>
			    <button class="OrderHis-btn" onclick="corporate_orderhistory();">
                     Orders history &nbsp <img src="images/icones/orderhistory.svg" class="navbar-icon"></img>
                </button>
                <div class="cart-container">
                    <button class="cart-btn" onclick="corporate_cart();">
                        Cart &nbsp
                        <img src="images/icones/cart.svg" alt="Corporate cart" class="navbar-icon">
                        <sup id="number"><?= $number ?></sup>
                    </button>
                </div>
            </div>
        </div>
        <div class="order-summary">
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        &nbsp<img src="images/icones/search.svg" alt="Search" class="navbar-icon"> </i>
                    </button>
                </div>

        </div>
        <div class="table-responsive">
            <table class="table1">
                <thead class="entête">
                    <tr>
                        <th>Customer Ref <img src='/images/icones/arrow-down.svg' alt='Store'></th>
                        <th>Internal ref</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Sales unit</th>
                        <th>Price / unity</th>
                        <th>In stock</th>
                        <th>In progress</th>
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
//echo $devise;

    $sql="select * from articles where prefix_contractor='" . $_SESSION['prefix_contractor'] . "' and retails='O' limit ".$offset .",". $maxRecord ."; ";
	$retour=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($retour))
	{
switch ($devise){
    case "{1}": 
        $price=$row['price_eur'] . " &euro; ";
        break;
    case "{2}":
        $price= $row['price_usd'] . " $ ";
        break;
    case "{3}":
        $price= $row['price_cny'] . " &yen";
        break;
    }
$data[] = [
        $row['ref_contractor'],    // le numéro de commande      
        $row['ref_produit_fini'],   
        $row['libelle'],       
        $row['type'],  
        $tbl_unite[$row['unite_facturation']],     
        
        $price, 
                
        
        '50 000', //$row['in_stock'],
        '20 000',//'$row['in_progress'],
       
    ];
    }
                    

                    foreach ($data as $index => $row) {
                        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
                        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                        ?>
                        <tr class="main-row <?= $rowClass ?>" >
                            <td class="left">
                               <button class="icon <?= $btnClass ?>" onclick="toggleDetails(this)">
                                <img src="images/icones/open-green.svg" alt="Icon">
                               </button>
                              <?= ucfirst( strtolower($row[0])) ?>
                            </td>                          
						    <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td><?= $row[4] ?></td>
                            <td><?= $row[5] ?></td>
                            <td><?= $row[6] ?></td>
                            <td><?= $row[7] ?></td>
                            <td>
                            <button class="btn-QTY" onclick="openQTYPopup()">
                                <img src='/images/icones/checkmark-shield.svg' alt='Qty per site'> QTY per site
                            </button>   
                            <button class="btn-Place" id='orderButton' data-toggle='modal' data-target='#orderModal' data-gs-reference='<?= $row[1] ?>' onclick="place_order('<?= $row[1] ?>');">
                                <img src='/images/icones/add_to_cart.svg' alt='Place Order'>
                                   
							    Add to cart</button>
                            </td>
                        </tr>
                        <tr class="main-row2 <?= $rowClass ?>" style="display: none;">
                            <td colspan="9">
                                <div class="details-content">
                                    <img src="Image/Image1.png" alt="Image 1" class="Image">
                                    <img src="Image/Image2.png" alt="Image 2" class="Image">
                                    <div class="details-container" style="gap: 40px;">

                                        <div class="details-info details-info1">
                                            <h5>General informations:</h5>
                                            <div style="display: flex;gap: 0px;justify-content: space-between;">
                                                <div class="soustitre">
                                                    Unit's weight: <br>
                                                    Packaging size: <br>
                                                    Packaging weight:<br>
                                                    HS Code: <br>
                                                    date validation: <br>
                                                    version: <br>
                                                    Upload RTP: <br>
                                                    description:
                                                </div>
                                                <div class="details-info details-info3">
                                                    25gr<br>
                                                    15*25*25cm<br>
                                                    2kg<br>
                                                    477888315202<br>
                                                    XX/XX/XXXX<br>
                                                    Version <br>
                                                    <div class="btnUP">
                                                        <button class="btn-UP" onclick="openPopupUP()"><i class="bi bi-upload"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet consectetur. Turpis duis donec sed nulla pulvinar. Auctor nullam turpis pellentesque tortor feugiat. Sed tortor vitae purus sed cursus luctus egestas. </p>

                                        </div>
                                        
                                        <div class="details-info details-info2">
                                            <h5>RFID informations:</h5>
                                            <div style="display: flex;flex-direction: row;justify-content: space-between;margin-bottom: 10px;">
                                            <div class="soustitre">
                                            Chipset: <br>
                                            Frequency: <br>
                                            </div>
                                            <div class="details-info details-info4">
                                            N/A<br>
                                            N/A<br>
                                        </div></div>
                                            <h5>LCA (life cycle analysis):</h5>
                                            <div style="display: flex;flex-direction: row;justify-content: space-between;">
                                            <div class="soustitre">
                                            Your footprint: <br>
                                            Compensed by Etic: <br>
                                            </div>
                                            <div class="details-info details-info4">
                                            N/A<br>
                                            N/A<br>
                                        </div></div>
                                            <div class="btns2">
                                                
                                                <button class="btn-datasheet">
                                                    <img src='/images/icones/upload.svg' class='icone' alt='Datasheet'>Datasheet
                                                </button>
                                                <button class="btn-delete" >
                                                    <img src='/images/icones/trash-2.svg' class='icone' alt='Delete'>Ask to delete
                                                </button>
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
	
</body>
<!-- popup place OR-->
	 <div class="popup"  id='orderModal' tabindex='-1' role='dialog' aria-labelledby='orderModalLabel' aria-hidden='undefined'>
        <div class="popup-content" id='order-details'>
            
        </div>
    </div>
	<!-- popup UP RTP-->
	 <div id="popupUP" class="popupUP">
        <div class="popupUP-content">
            <span class="closeUP" onclick="closePopupUP()"><i class="bi bi-x-lg"></i></span>
            <h5 class="left-align">Upload RTP</h5>
            <div class="file-upload">
                <label for="file-input" class="file-label" >
                    <span class="file-text" >Choose file (.pdf)</span>
                    <i class="bi bi-upload"></i>
                </label>
                <input id="file-input" type="file" accept=".pdf" class="file-input">
            </div>
            <div class="font-file">
                <button class="add-font-btn"><i class="bi bi-plus-square"></i></button>
                <span class="file-text2">Add font file (recommended)</span>
            </div>
            <button class="validateUP-btn">Validate</button>
        </div>
    </div>
	<!-- popup QTY-->
	<div id="qtyPopup" class="popupQTY">
        <div class="popupQTY-content">
            <div class='modal-header'>             
                <h4 class="left-align">Quantity per site</h4>
                <button type='button' class='modal-close' data-dismiss='modal' aria-label='Close' onclick="close_order_modal('qtyPopup')">
                    <img src="images/icones/close.svg" alt="Delete order" class="delete">
                </button>
            </div>
            <table class = "tableQTY">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>In stock</th>
                        <th>In progress</th>
                        <th>Min stock qty</th>
                        <th class="new-min-qty-header">New min qty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bangladesh</td><td>10 000 000</td><td>-</td><td>10 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
                    <!-- Ajoutez ici les autres lignes de pays comme montré précédemment -->
                    <!-- Exemple pour un autre pays -->
                    <tr>
                        <td>China</td><td>10 000 000</td><td>5 000</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
					<tr>
                        <td>Egypt</td><td>10 000 000</td><td>43 000</td><td>5 000</td>
                        <td class="new-min-qty"><input type="text" value="5 000"></td>
                    </tr>
					<tr>
                        <td>Greece</td><td style="color: red;">5 000</td><td>-</td><td>26 000</td>
                        <td class="new-min-qty"><input type="text" value="26 000"></td>
                    </tr>
					<tr>
                        <td>Italy</td><td>10 000 000</td><td>32 134</td><td>20 000</td>
                        <td class="new-min-qty"><input type="text" value="20 000"></td>
                    </tr>
					<tr>
                        <td>India</td><td>10 000 000</td><td>10 000 000</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
					<tr>
                        <td>Morocco</td><td style="color: red;">8 000</td><td>10 432</td><td>50 000</td>
                        <td class="new-min-qty"><input type="text" value="50 000"></td>
                    </tr>
					<tr>
                        <td>Portugal</td><td>10 000 000</td><td>10 000 000</td><td>1 000 000</td>
                        <td class="new-min-qty"><input type="text" value="50 000"></td>
                    </tr>
					<tr>
                        <td>Tunisia</td><td>10 000 000</td><td>-</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
					<tr>
                        <td>Turkey</td><td>10 000 000</td><td>10 000 000</td><td>30 000</td>
                        <td class="new-min-qty"> <input type="text" value="30 000"></td>
                    </tr>
					<tr>
                        <td>Vietnam</td><td>10 000 000</td><td>10 000 000</td><td>10 000 000</td>
                        <td class="new-min-qty"><input type="text" value="10 000 000"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
	
	<!-- popup QTY-->
	<div id="qtyPopupEdit" class="popupEditQTY">
        <div class="popupEditQTY-content">
            <span class="closeEditQTY" onclick="closeQTYPopupEdit()"><i class="bi bi-x-lg"></i></span>
            <h5 class="left-align">Quantity per site (pcs)</h5>
            <table class = "tableEditQTY">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>In stock</th>
                        <th>In progress</th>
                        <th>Min stock qty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bangladesh</td><td><input type="text" value="10 000 000"></td>
						<td><input type="text" value="10 000 000"></td>
						<td>10 000 000</td>
                    </tr>
                </tbody>
            </table>
			<button class="cancelEdit-btn" ><i class="bi bi-x-lg"></i></i>&nbsp Cancel</button>
            <button class="submitEdit-btn"><i class="bi bi-floppy"></i>&nbsp Submit</button>
        </div>
    </div>
	
    
<div class="footer">
     <div class="pagination">
	 
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" onchange="set_rows('corporate_store')">
                    <option value="20" <?php echo ($maxRecord == 20) ? 'selected' : ''; ?>>20</option>
                    <option value="30" <?php echo ($maxRecord == 30) ? 'selected' : ''; ?>>30</option>
                    <option value="50" <?php echo ($maxRecord == 50) ? 'selected' : ''; ?>>50</option>
                </select>
                <span>rows</span>
            </div>
        <a href="#" class="page-link0"> < Previous</a>
        <?php 
 //echo $nbSheets;
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


	<script>
        // Sélectionnez tous les boutons avec la classe 'filter-btn'
const buttons = document.querySelectorAll('.filter-btn');

// Parcourez chaque bouton et ajoutez un événement de clic
buttons.forEach(button => {
    button.addEventListener('click', () => {
        // Supprimez la classe 'active' de tous les boutons
        buttons.forEach(btn => btn.classList.remove('active'));
        
        // Ajoutez la classe 'active' au bouton cliqué
        button.classList.add('active');
    });
});

	
</script>

