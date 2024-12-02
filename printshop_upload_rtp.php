<?php
	//session_start();
	require_once("config.inc.php");
	//require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("includes/is_session_active.php");
    // Récupère le code PRINTSHOP
    $sql="select * from contractors";
    $retour=mysqli_query($con,$sql);
    $options[] =array();
    $option="";
    while($row=mysqli_fetch_array($retour))
    {
        $option = "<option value='" . $row['prefix'] . "'>" . $row['name'] . "</option>";
                            
        $options[] = $option; // Ajouter l'option à la fin du tableau pour les autres contractors
    }

?> 

<div class="contenaire-upload"> 
        <h2>Upload files</h2>   
        <div class="zipUpload">
            <div class="selectContractors">  
                    <label class="contactLabel">Contractor</label>
                    <select id="contractor" name="contractor" title="contractor" class="contractor">
                        <?php      
                            foreach ($options as $option) 
                            {
                                echo $option;
                            }
                        ?> 
                    </select>
            </div>
            <div class="selectContractors">  
                    <label class="contactLabel">File (zip):</label>
                    <button onclick="help_popup()" class="help-icon"><img src="images/icones/questionmark_circle.svg" alt="Upload rtp" class="navbar-icon">Help</button>
            </div>
            <div id="drop_file_zone" ondragover="handleDragOver(event)" ondrop="handleDropZip(event)" ondragleave="handleDragLeave(event)">
                <div id="drag_upload_file">
                    <p>Drop your files here</p>
                    <p>or</p>
                    <p><input type="button" value="Select Files" onclick="zipfile_explorer();" /></p>
                    <input type="file" id="zipfile" />
                </div>
                <div class="bouton">
                <button onclick="uploadBatsFile()"><img src="images/icones/download.svg" alt="Upload rtp" class="navbar-icon">Upload</button>
            </div>
                
        </div>
            
    </div>
</div>    
<div id="file_content" class="file-content"></div>    

       