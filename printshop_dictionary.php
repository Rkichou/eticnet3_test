
<?php 

	require_once("config.inc.php");
	require_once("includes/is_session_active.php");
$options = array(); // Initialiser un tableau pour stocker les options
//CHERCHER TOUS LES CONTRACTORS
	$sql3="select * from contractors order by name";
	$retour3=mysqli_query($con,$sql3); 
$options[]="<option value=\"Company name\" disabled selected>Company name</option>";
	// Parcourir les résultats de la base de données et stocker les options dans le tableau
	while ($row3 = mysqli_fetch_array($retour3)) 
	{
    	$option = "<option value=\"" . $row3['prefix'] . "\">" . $row3['name'] . "</option>";    	
        $options[] = $option; // Ajouter l'option à la fin du tableau pour les autres contractors
    	
	}

if (isset($_POST['prefix_contractor'])){
$prefix=$_POST['prefix_contractor'];
}
else{
$prefix="";
}
if(isset($_POST['rows'])){
$maxRecord=$_POST['rows'];
}
else{
$maxRecord=20;
}
?>  
<div id="printshop-dashboard-content">
 <link rel="stylesheet" href="css/AddUser_dup.css">




        
        <div class="order-summary">
            
             <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i  id="btn-open-popup" class="bi bi-sliders"></i>
                    </button>
            </div>
            <button class="Down-dict-btn" onclick="download_dictionnary('<?php echo $prefix ?>');">
                <i class="bi bi-download"></i> Download dictionary
            </button>
        </div>
        <div class="table-container">
            <table id="myTable" class="table1">
                <thead class="entête">
                    <tr>
                        <th>English<i class="bi bi-arrow-down"></i></th>
                        <th>Korean <i class="bi bi-arrow-down"></i></th>
                        <th>Chinese<i class="bi bi-arrow-down"></i></th>
                        <th>French<i class="bi bi-arrow-down"></i></th>
						<th>Japanese<i class="bi bi-arrow-down"></i></th>
						<th>Russian<i class="bi bi-arrow-down"></i></th>
					
                            
                    </tr>
                </thead>
                <tbody>
                    <?php
    if (isset($_POST['prefix_contractor'])){
        // Nom de la table à vérifier
        $tableName = $prefix.'_dictionnary';

        // Vérifier si la table existe
        $sql = "SHOW TABLES LIKE '$tableName'";
        $result = $con->query($sql);

        if ($result && $result->num_rows > 0) {
            
            $dictionary = "SELECT * FROM ".$prefix."_dictionnary where type= 'fibre' limit 1,40";
            $dictionaryResult = mysqli_query($con, $dictionary);

            $data = [];

            while ($dictionaryRow = mysqli_fetch_assoc($dictionaryResult)) {
                // Construire chaque ligne du tableau à partir des colonnes de la table `lem_orders`.
                $data[] = [
                    $dictionaryRow['ANGLAIS'],   
                    
                    $dictionaryRow['ITALIEN'],   
                    'chinois',   //$dictionaryRow['CHINOIS'],       
                    $dictionaryRow['FRANCAIS'],       
                
                    $dictionaryRow['JAPONAIS'], 
                    $dictionaryRow['RUSSE'],         
                    
                ];
            }

        } 
    }
    else {
    // La table n'existe pas
    //Affichage par défaut

        $data = [
            ['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
            ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
			['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
            ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
			['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
            ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
			['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
            
        ];
}
                    foreach ($data as $index => $row) {
                        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                        ?>
                        <tr class="main-row <?= $rowClass ?>">
                            <td><?= $row[0] ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td><?= $row[4] ?></td>
                            <td><?= $row[5] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
<?php if ($prefix!=$_SESSION['prefix_contractor']){ ?>
	<!-- popup Select Costomer-->
	<div id="popupSelect" class="popupSelect">
        <div class="popupSelect-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Select customer</h5>				
              
            </div>
 
                <div class="company-section">
				<select id="contractors" name="contractors" title="contractors" class="contractors" onchange="enable_button()">
                <?php   
                foreach ($options as $option) {
			        echo $option;
		        }?>
                </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-validate" id="btn_dictionary" disabled onclick="set_contractor_dictionnary();"><i class="bi bi-check-lg"></i>Apply</button>
            </div>
        </div>
    </div>
<?php } ?>	
    <script src="js/printshop_dictionnary.js"></script>
    




<link rel="stylesheet" href="css/footer_dup.css">
<div class="footer">
     <div class="pagination">
	 
	    <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select" onchange="set_rows('printshop_dictionary');">
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
</div>
