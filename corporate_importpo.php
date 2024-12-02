<?php 
require_once("config.inc.php");
	require_once("languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("includes/is_session_active.php");
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
?>
    
    <style>
 #drag_upload_file {
    background-color: #EAEAEA;
    border: 2px dashed #AAAAAA;    
    min-height: 200px;
    box-sizing: border-box;
    width: 500px;
    height: 250px;
    padding: 15%;
    text-align: center;
    border-radius: 15px;
    font-size: 1em;

}
#drop_file_zone {
    
    display: flex;
    align-items: center;
    flex-direction: column;
    margin-right: 30px;
}
.services select{
    min-width: 200px;
}
.upload {
    display: flex;
    flex-direction: row;
    padding-top: 20px;
    justify-content: center;
    gap: 5%;
}
.button{
cursor: pointer;
margin-bottom: 10px;
}
#drag_upload_file #selectfile {
    display: none;
}
.contenaire {
    display: flex;
    flex-direction: column;
}
        .container {
            text-align: center;	
            margin : 4%;
        }
        h1 {
			
			font-weight: bold;
            font-size: 26px;
            color: #333;
margin-bottom: 25px;
        }
        .buttonUpload {
            display: inline-block;
            padding: 12px 20px;
            background-color: #FFA300;
            color: #fff;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
			margin-top : 15px;
			margin-down : 10%;
			width : 200px;
        }
        .buttonUpload:hover {
            background-color: #e69500;
        }
.file-content {
    margin-top: 15px;
}

    </style>


<div class="container">
    <h1>Upload P.O</h1>
    
<?php if ($_SESSION['prefix_contractor'] == "lem")
{
?>      
         
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                                   
                    <input type="file" id="selectfile" />
                    <img src="images/upload.svg" onclick="file_explorer();" class="button" alt="Upload button">
                    <p>Drop file</p>
                    

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
                <button onclick="uploadFileLemaire()" class="buttonUpload">Upload</button>
            </div>
        </div>
        </div>
           
<?php } 
if ($_SESSION['prefix_contractor'] == "loe")
{
   
?>      
         
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <input type="file" id="selectfile" />
                    <img src="images/upload.svg" onclick="xlsfile_explorer();" class="button" alt="Upload button">
                    <p>Drop file</p>
                    
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
                    <button onclick="uploadFileLoe()" class="buttonUpload">Upload</button>
                </div>
            </div>
        </div>
        
            
            
<?php } 
if ($_SESSION['prefix_contractor'] == "chloe")
{
?>      
        
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <input type="file" id="selectfile" />
                    <img src="images/upload.svg" onclick="csvfile_explorer();" class="button" alt="Upload button">
                    <p>Drop file</p>
                    
                </div>
                
            </div>
            <div class="contenaire">
            <div class="bouton">
                <button onclick="uploadFileChloe()" class="buttonUpload">INTEGRATE</button>
            </div>
        </div>
        </div>
          
<?php }
if ($_SESSION['prefix_contractor'] == "lan")
{
?>      
          
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <input type="file" id="selectfile" />
                    <img src="images/upload.svg" onclick="xlsfile_explorer();" class="button" alt="Upload button">
                    <p>Drop file</p>
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
                    <button onclick="uploadFileLanvin()" class="buttonUpload">Upload</button>
                </div>
        </div>
        </div>
          
<?php } 
if ($_SESSION['prefix_contractor'] == "ala")
{
?>      
         
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <input type="file" id="selectfile" />
                    <img src="images/upload.svg" onclick="xlsfile_explorer();" class="button" alt="Upload button">
                    <p>Drop file</p>
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
                    <button onclick="uploadFileAlaia()" class="buttonUpload">Upload</button>
                </div>
        </div>
    </div>
            
<?php }
if ($_SESSION['prefix_contractor'] == "patou")
{
?>      
        <h2>Upload files</h2>   
        <div class="upload">
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDrop(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <input type="file" id="selectfile" />
                    <img src="images/upload.svg" onclick="xlsfile_explorer();" class="button" alt="Upload button">
                    <p>Drop file</p>
                </div>
                
            </div>
            <div class="contenaire">
                
                <div class="labels">
                    <label><input type="radio" name="label" id="careLabel" value="carelabel" required>CARE LABEL</label>
                    <label><input type="radio" name="label" id="sticker" value="sticker" required>STICKER</label>
                </div>
                <div class="bouton">
                    <button onclick="uploadFilePatou()" class="buttonUpload">Upload</button>
                </div>
        </div>
        </div>
         
<?php }
?>
<div id="file_content" class="file-content"></div>
</div>
