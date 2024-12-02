<?php
require_once("config.inc.php");
	require_once("includes/is_session_active.php");
$prefix=$_SESSION['prefix_contractor'];
if(isset($_POST['rows'])){
$maxRecord=$_POST['rows'];
}
else{
$maxRecord=20;
}
?>
      <link rel="stylesheet" href="css/AddUser_dup.css">
        <div class="order-summary">
            
             <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <img src='/images/icones/search.svg' alt='Search'>
                    </button>
            </div>
            <button class="Down-dict-btn1" onclick="download_dictionnary_template();">
                <img src='/images/icones/download.svg' alt='Dictionary'> Download template
            </button>
			<button class="Down-dict-btn">
                <img src='/images/icones/upload.svg' alt='Dictionary'> Upload dictionary
            </button>
        </div>
        <div class="table-container">
            <table id="myTable" class="table1">
                <thead class="entête">
                    <tr>
                        <th>English<img src='/images/icones/arrow-down.svg' alt='Dictionary'></th>
                                                
                        <th>Korean <img src='/images/icones/arrow-down.svg' alt='Dictionary'></th>
                        <th>Chinese<img src='/images/icones/arrow-down.svg' alt='Dictionary'></th>
                        <th>French<img src='/images/icones/arrow-down.svg' alt='Dictionary'></th>
						<th>Japanese<img src='/images/icones/arrow-down.svg' alt='Dictionary'></th>
						<th>Russian<img src='/images/icones/arrow-down.svg' alt='Dictionary'></th>
					
                            
                    </tr>
                </thead>
                <tbody>
                    <?php
        // Calcul la pagination

        $tableName = $prefix.'_dictionnary';
        $sqlD="select count(*) from " . $tableName . " where type= 'fibre';";
        $retourD=mysqli_query($con,$sqlD);
            // Group retourne un tableau il faut l'additionner
            $nbRows = mysqli_num_rows($retourD);
            $nbSheets=ceil($maxRecord/$maxRecord);
        $table="dictionnary";
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
    // Vérifier si la table existe
    $sql = "SHOW TABLES LIKE '$tableName'";
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        
        $dictionary = "SELECT * FROM ".$prefix."_dictionnary where type= 'fibre' limit ".$offset.",". $maxRecord .";";
        $dictionaryResult = mysqli_query($con, $dictionary);

        $data = [];
        if (mysqli_num_rows($dictionaryResult) > 0) {
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
        else {
            echo "<tr><td colspan=5 class='no-translation'>No translation available. Please upload dictionnary.</td></tr>";
        }
    } else {
        echo "No translation available. Please upload dictionnary.";
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

	
    <script src="js/corporate_dictionnary.js"></script>
    

    <link rel="stylesheet" href="css/footer_dup.css">
<div class="footer">
     <div class="pagination">
	 
	    <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select" onchange="set_rows('corporate_dictionary')">
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

