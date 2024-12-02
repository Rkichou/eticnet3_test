<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
// Récupère le code PRINTSHOP
$sql="select * from users where id='" . $_SESSION['id'] . "'";
$retour=mysqli_query($con,$sql);
$row=mysqli_fetch_object($retour);

// Récupère les codes suppliers dans les users_adress
// Expression régulière pour trouver les numéros entre accolades
$pattern = '/\{(\d+)\}/';
// Charge les codes services
// Rècupère les services en fonction du user
$services_user = $row->service;
$i = 0;
// Utilisation de preg_match_all pour rechercher tous les motifs dans la chaîne
if($_SESSION['prefix_contractor'] != "patou"){
if (preg_match_all($pattern, $services_user , $matches)) {
    // $matches[0] contient un tableau avec toutes les correspondances complètes
    // $matches[1] contient un tableau avec tous les numéros extraits
    $numeros = $matches[1];
    
    // Parcourir le tableau des numéros extraits et les afficher
    foreach ($numeros as $numero) {
        
        $sql2="select * from services where id='".$numero."' order by name";
        $retour2=mysqli_query($con,$sql2); 
        while($row2=mysqli_fetch_array($retour2))
        {
            // Attention ici on prends le code service comme clef et non pas l'id vue que la recherche se fait par le contractor et que le code service est injecté dans les fichiers d'échanges
            if($_SESSION['prefix_contractor'] == $row2['prefix_contractor']){
				$tbl2_service[$i] = $row2['name']; 
				$i++;
			}
        }	
    }
}
else 
{
    $tbl2_service[$i] = "Aucun service";
}
}
if ($_SESSION['prefix_contractor'] == "chloe")
{
?>      
        <h2>Upload files</h2>   
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <p>Drop your files here</p>
                    <p>or</p>
                    <p><input type="button" value="Select Files" onclick="csvfile_explorer();" /></p>
                    <input type="file" id="selectfile" />
                </div>
                
            </div>
            <div class="contenaire">
            <div class="bouton">
                <button onclick="uploadFileChloe()">INTEGRATE</button>
            </div>
        </div>
        </div>
        <div id="file_content" class="file-content"></div>    
<?php }

if ($_SESSION['prefix_contractor'] == "lem")
{
?>      
        <h2>Upload files</h2>   
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <p>Drop your files here</p>
                    <p>or</p>
                    <p><input type="button" value="Select Files" onclick="file_explorer();" /></p>
                    <input type="file" id="selectfile" />
                </div>
                
            </div>
            <div class="contenaire">
            <div class="services">
                <select id="services">
                    <?php for($j=0; $j<count($tbl2_service); $j++){ 
                        echo "<option value='".$tbl2_service[$j] ."'>". $tbl2_service[$j] ."</option>";
                        
                     }?>
                </select> 
                
            </div>
            <div class="bouton">
                <button onclick="uploadFileLemaire()">INTEGRATE</button>
            </div>
        </div>
        </div>
        <div id="file_content" class="file-content"></div>    
<?php }

if ($_SESSION['prefix_contractor'] == "loe")
{
    /*function getPDFPages($document)
    {
    //$cmd = "/path/to/pdfinfo";           // Linux
    $cmd = '"./pdfinfo.exe"';  // Windows
    
    exec("$cmd \"$document\"", $output);
    $pagecount = 0;
    foreach($output as $op)
    {
        // Extract the number
        if(preg_match("/Pages:\s*(\d+)/i", $op, $matches) === 1)
        {
            $pagecount = intval($matches[1]);
            break;
        }
    }

    return $pagecount;
    }*/
?>      
        <h2>Upload files</h2>   
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <p>Drop your files here</p>
                    <p>or</p>
                    <p><input type="button" value="Select Files" onclick="xlsfile_explorer();" /></p>
                    <input type="file" name="selectfile" id="selectfile" />
                </div>
                
            </div>
            
            <div class="contenaire">
                <div class="services">
                    <select id="services">
                    <?php for($j=0; $j<count($tbl2_service); $j++){ 
                        echo "<option value='".$tbl2_service[$j] ."'>". $tbl2_service[$j] ."</option>";
                        
                    }?>
                    </select> 
                
                </div>
                <div class="bouton">
                    <button onclick="uploadFileLoe()">INTEGRATE</button>
                </div>
            </div>
        </div>
        <!--<div id="drop_file_pdf" >   
            <div id="drag_pdf_file">
                <form method="post" enctype="multipart/form-data">
                    <label for="pdfFile">Select PDF file:</label>
                    
                    <p><input type="button" value="Select PDF File" onclick="pdffile_explorer();" /></p>
                    <input type="file" name="pdffile" id="pdffile" accept="application/pdf" />
                </form>
            </div>
        </div>-->
            <?php
           /*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_FILES['pdfFile']) && $_FILES['pdfFile']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['pdfFile']['tmp_name'];

                    // Vérifiez si le fichier est un PDF
                    $mimeType = mime_content_type($fileTmpPath);
                    if ($mimeType === 'application/pdf') {
                    $pageCount = getPDFPages(escapeshellarg($fileTmpPath));
                    echo "Le fichier PDF contient $pageCount page(s).";
                    } else {
                        echo "Le fichier sélectionné n'est pas un fichier PDF valide.";
                    }
                } else {
                    echo "Une erreur s'est produite lors du téléchargement du fichier.";
                }
            }*/
            ?>
        <div id="file_content" class="file-content"></div>    
<?php } 
if ($_SESSION['prefix_contractor'] == "lan")
{
?>      
        <h2>Upload files</h2>   
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <p>Drop your files here</p>
                    <p>or</p>
                    <p><input type="button" value="Select Files" onclick="xlsfile_explorer();" /></p>
                    <input type="file" id="selectfile" />
                </div>
                
            </div>
            <div class="contenaire">
                <div class="services">
                    <select id="services">
                    <?php for($j=0; $j<count($tbl2_service); $j++){ 
                        echo "<option value='".$tbl2_service[$j] ."'>". $tbl2_service[$j] ."</option>";
                        
                    }?>
                    </select> 
                
                </div>
                <div class="bouton">
                    <button onclick="uploadFileLanvin()">INTEGRATE</button>
                </div>
        </div>
        </div>
        <div id="file_content" class="file-content"></div>    
<?php } 
if ($_SESSION['prefix_contractor'] == "ala")
{
?>      
        <h2>Upload files</h2>   
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <p>Drop your files here</p>
                    <p>or</p>
                    <p><input type="button" value="Select Files" onclick="xlsfile_explorer();" /></p>
                    <input type="file" id="selectfile" />
                </div>
                
            </div>
            <div class="contenaire">
                <div class="services">

                    <select id="services">
                    <?php for($j=0; $j<count($tbl2_service); $j++){ 
                        echo "<option value='".$tbl2_service[$j] ."'>". $tbl2_service[$j] ."</option>";
                        
                    }?>
                    </select> 
                
                </div>
                <div class="labels">
                    <label><input type="radio" name="label" id="careLabel" value="carelabel" required>CARE LABEL</label>
                    <label><input type="radio" name="label" id="sticker" value="sticker" required>STICKER</label>
                </div>
                <div class="bouton">
                    <button onclick="uploadFileAlaia()">INTEGRATE</button>
                </div>
        </div>
        </div>
        <div id="file_content" class="file-content"></div>    
<?php }
if ($_SESSION['prefix_contractor'] == "patou")
{
?>      
        <h2>Upload files</h2>   
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <p>Drop your files here</p>
                    <p>or</p>
                    <p><input type="button" value="Select Files" onclick="xlsfile_explorer();" /></p>
                    <input type="file" id="selectfile" />
                </div>
                
            </div>
            <div class="contenaire">
                
                <div class="labels">
                    <label><input type="radio" name="label" id="careLabel" value="carelabel" required>CARE LABEL</label>
                    <label><input type="radio" name="label" id="sticker" value="sticker" required>STICKER</label>
                </div>
                <div class="bouton">
                    <button onclick="uploadFilePatou()">INTEGRATE</button>
                </div>
        </div>
        </div>
        <div id="file_content" class="file-content"></div>    
<?php }
?>
