<?php
session_start();
require_once("../config.inc.php");
require_once("./is_session_active.php");

$targetDir = '../bats/loe/zip/';
$dir = '../bats/loe/';
$unzipDir = $dir . 'unzip/';
$tempDir = $dir . 'temp/';
$tmpDir = $dir . 'tmp/';
if (!file_exists($unzipDir)) {
    if (!mkdir($unzipDir, 0777, true)) {
        die("Erreur : Impossible de créer le répertoire $unzipDir");
    }
}
if (!file_exists($tempDir)) {
    if (!mkdir($tempDir, 0777, true)) {
        die("Erreur : Impossible de créer le répertoire $tempDir");
    }
}
if (!file_exists($tmpDir)) {
    if (!mkdir($tmpDir, 0777, true)) {
        die("Erreur : Impossible de créer le répertoire $tmpDir");
    }
}
$files = glob($targetDir . '*.zip');

foreach ($files as $file) {
    $zip = new ZipArchive;
    $res = $zip->open($file);

    if ($res === TRUE) {
        // Obtenir le nom de base du fichier zip
        $zipBaseName = pathinfo($file, PATHINFO_FILENAME);

        // Extraire la référence et le code
        $parts = explode('-', $zipBaseName, 2);
        $reference = $parts[1];
        $referenceParts = explode('_', $reference, 2);
        $code = $referenceParts[1];
        $reference = $referenceParts[0];
        $codeParts = explode('_', $code, 2);
        $code = $codeParts[0];
        if($code!='1727170')
        {
            $param_type_label = "CARE_LABEL " . $code;
            $sqlcode="select * from loe_orders where reference='" . $reference . "' and type_label like ' ".$param_type_label." '";
            $retourcode=mysqli_query($con,$sqlcode);
            $rowcode = mysqli_fetch_assoc($retourcode);
            if(!$rowcode){
                $sqlRef="select * from loe_orders where reference='" . $reference . "' and type_label like 'CARE_LABEL 1727170' ";
                $retourRef=mysqli_query($con,$sqlRef);
                while($row=mysqli_fetch_array($retourRef))
                {
                    
                    $type_label=$row['type_label'];
                    
                    //INTEGRATION CARE LABEL
                    $code_supplier = $row['code_supplier'];
                    $num_of=$row['num_of'];
                    $reference = $row['reference'];
                    $code_service=$row['code_service'];
                    $coloris = $row['coloris'];
                    $saison = $row['saison'];
                    $size=$row['size'];
                    $cup=$row['cup'];;
                    $made_in=$row['made_in'];
                    $code_ean=$row['code_ean'];
                    $qty_init=$row['qty_init'];
                    $qty_to_produce = $row['qty_to_produce'];
                    $reference_bat=$row['reference_bat'];
                    $status=$row['status'];
                    $adresse_faconnier=$row['adresse_faconnier'];
                    $id_printshop=$row['id_printshop'];
                    $status_composition=$row['status_composition'];
                    $file_name=	$row['file_name'];	
                    $groupe_produit="";               
                    $type_ordre=$row['type_ordre'];
                    $product_name =$row['product_name'];	
                    $date_integration=$row['date_integration'];
                    $validation_supplier=$row['validation_supplier'];
                    $date_validation_supplier=$row['date_validation_supplier'];

                    $sql= "INSERT INTO `loe_orders` (`id`, `product_name` , `groupe_produit`,`type_ordre`,`status_composition`,`code_service`,`date_integration`,`num_of`, `code_supplier`, `prefix_bat`,`reference_support`, `type_label`, `reference`, `coloris`, `size`, `cup`, `made_in`, `code_ean`, `qty_init`, `qty_to_produce`,";
                    $sql.= "`status`, `validation_supplier`, `date_validation_supplier`,`reference_bat`, `id_printshop`, `saison`,`file_name`) ";
                    $sql.="VALUES (NULL,";
                    $sql.="\"" . $product_name. "\",";
                    $sql.="\"" . $groupe_produit. "\",";
                    $sql.="\"" . $type_ordre . "\",";
                    $sql.="\"" . $status_composition . "\",";
                    $sql.="\"" . $code_service . "\",";
                    $sql.="\"" . $date_integration. "\",";
                    $sql.="\"" . $num_of. "\",";
                    $sql.="\"" . $code_supplier. "\",";
                    $sql.="\"" . "CL". "\",";//A REVOIR NOMMAGE
                    $sql.="\"" . "6C0188B0005". "\",";
                    $sql.="\"" . "CARE_LABEL ".$code. "\",";
                    $sql.="\"" . $reference. "\",";
                    $sql.="\"" . $coloris. "\",";
                    $sql.="\"" . $size. "\",";
                    $sql.="\"" . $cup. "\",";
                    $sql.="\"" . $made_in. "\",";
                    $sql.="\"" . $code_ean. "\",";
                    $sql.="\"" . $qty_init. "\",";
                    $sql.="\"" . $qty_to_produce. "\",";
                    $sql.="\"" . $status . "\",";
                    $sql.="\"" . $validation_supplier . "\",";
                    $sql.="\"" . $date_validation_supplier. "\",";
                    $sql.="\"" . $reference_bat . "\",";
                    $sql.="\"" . $id_printshop . "\",";
                    $sql.="\"" . $saison . "\",";
                    $sql.="\"" . $file_name . "\")";
                    // $sql.="\"" . mysqli_real_escape_string($con,$data_customer) . "\");";
                    $retour=mysqli_query($con,$sql); 
                
                }
            }
        }
        // Extraire tous les fichiers dans le répertoire temporaire
        if (!$zip->extractTo($tmpDir)) {
            echo "Erreur lors de l'extraction de l'archive $file !\n";
            continue; // Passer à l'archive suivante en cas d'erreur d'extraction
        }

        // Fermer l'archive zip
        if (!$zip->close()) {
            echo "Erreur lors de la fermeture de l'archive $file !\n";
            continue; // Passer à l'archive suivante en cas d'erreur de fermeture
        }

        // Créer une nouvelle archive ZIP pour les fichiers renommés
        $newZip = new ZipArchive;
        $newZipPath = $tempDir . $zipBaseName . '_renamed.zip';
        if ($newZip->open($newZipPath, ZipArchive::CREATE) !== TRUE) {
            echo "Erreur, impossible de créer l'archive ZIP $newZipPath !\n";
            continue; // Passer à l'archive suivante en cas d'erreur de création
        }

        // Parcourir les fichiers extraits et les ajouter à la nouvelle archive ZIP
        $extractedFiles = glob($tmpDir . '*.bmp');
        foreach ($extractedFiles as $extractedFile) {
            $oldName = basename($extractedFile);
            $newName = $zipBaseName . '_' . pathinfo($oldName, PATHINFO_FILENAME) . '.' . pathinfo($oldName, PATHINFO_EXTENSION);
            $newZip->addFile($extractedFile, $newName);
        }

        // Fermer la nouvelle archive ZIP
        if (!$newZip->close()) {
            echo "Erreur lors de la fermeture de la nouvelle archive $newZipPath !\n";
            continue; // Passer à l'archive suivante en cas d'erreur de fermeture
        }

        //Archiver les fichiers décompressés
        $destinationFile = $dir . "archives/" . $zipBaseName .".zip";
        rename($file, $destinationFile);

        // Supprimer les fichiers temporaires extraits
        array_map('unlink', $extractedFiles);
    } 
    else 
    {
        echo "Erreur, impossible d'ouvrir le fichier $file ! Code d'erreur : $res\n";
    }
}
//fichier temporaires contenant les bats renommés
$tempfiles = glob($tempDir . '*.zip');

    foreach ($tempfiles as $tempfile) 
    {
        $zip = new ZipArchive;
        $res = $zip->open($tempfile);

        if ($res === TRUE) {
        
            // Extraire tous les fichiers dans le répertoire temporaire
            if (!$zip->extractTo($unzipDir)) {
                echo "Erreur lors de l'extraction de l'archive temp $tempfile !\n";
                continue; // Passer à l'archive suivante en cas d'erreur d'extraction
            }

            // Fermer l'archive zip
            if (!$zip->close()) {
                echo "Erreur lors de la fermeture de l'archive $tempfile !\n";
                continue; // Passer à l'archive suivante en cas d'erreur de fermeture
            }
        }
        unlink($tempfile);
    }
    // Déplacer les fichiers BMP extraits vers le répertoire de waiting
    $bmpFiles = glob($unzipDir . '*.bmp');
    $batsFiles = glob($dir . 'waiting/' . '*.bmp');
    foreach ($bmpFiles as $bmpFile) 
    {
        $bmpName = basename($bmpFile, '.bmp');
        $bmpparts = explode('_', $bmpName, 3);
        $bmpfeuillet = substr($bmpName,-1);
        $bmpcode=$bmpparts[1];
        
        foreach ($batsFiles as $batFile) 
        {
            $batName = basename($batFile, '.bmp');
            $batparts = explode('_', $batName, 3);
            $batfeuillet = substr($batName, -1); 
            $batcode=$batparts[1];
            if(($batparts[0] . "_". $batcode==$bmpparts[0]. "_". $bmpcode) && ($batfeuillet===$bmpfeuillet)){
                // Supprimer le fichier batFile
                if (unlink($batFile)) {
                    echo "<hr/> Fichier " . basename($batFile) . " supprimé avec succès <hr/>";
                } 
                else 
                {
                    echo "<hr/> Erreur lors de la suppression du fichier " . basename($batFile) . "<hr/>";
                }
            }
        }
        $destinationFile = $dir . "waiting/" . basename($bmpFile);
        if (rename($bmpFile, $destinationFile)) {
            echo "<hr/> File " . basename($bmpFile) . " integraté et déplacé dans waiting <hr/>";           
        } 
        else {
            echo "<hr/> Erreur de déplacement de" . basename($bmpFile) . " à waiting <hr/>";
        }
    }


