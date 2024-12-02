<?php

require_once("../config.inc.php");

// Préchargement BAT MMG
function verify_bats($num_of,$reference,$contractor,$con) // vérification des bats validés avant de confirmer la production	
{
    // Reconstitution du nom de BAT
    $initDirectory=$contractor;
    $batsDirectoryV = "../bats/" . $initDirectory ."/validate/";
    $batsDirectoryW = "../bats/" . $initDirectory ."/waiting/";
    
    if($contractor=="mmg")
    {
											
        $sqlB="select * from suivi_bats where  (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $contractor. "' order by id desc";
                                                                                                                                                                                // Retourne le plus récent en 1er
        $retourB=mysqli_query($con,$sqlB);
        $cpt_BAT_MMG=0;
        while($rowB=mysqli_fetch_array($retourB))
        {
            $cpt_BAT_MMG++;
            $TBL_BAT_MMG[$cpt_BAT_MMG]=$rowB['bat_name'];
        }
	
    }
    // Préchargement des BAT LOEWE 24/07/2024 -- SAMUEL AUGER 
    if($contractor=="loe")
    {
	    // On doit récupérer les derniers  BATS validés et en attente avec un classement par Date	
	    // ATTENTION ICI IL VA FALLOIR METTRE UNE GESTION DES ATTENTES / VALIDES QUI PEUVENT EXISTER EN MEME TEMPS
        // Rècupère la liste des BATs en attente
			$files = scandir($batsDirectoryW, SCANDIR_SORT_DESCENDING);
			// Tri par Date
			foreach($files as $key=>$value)
			{
				$tmpKey=explode("_",$value);
				// Mettre un tri par date ! 24/07/2024
				$clef=$tmpKey[0]."_" . $tmpKey[1];
				//echo $clef . " ";
				if(isset($TBL_BAT_LOE[$clef]))
				{
					$tmpKey2=explode("_",$TBL_BAT_LOE[$clef]);
					$tmpkey3= $tmpKey[2] ."-". $tmpKey[3];
					$tmpkey4= $tmpKey2[2] ."-". $tmpKey2[3];
					$TBL_tmpNum1=explode("-",$tmpkey3);
					$TBL_tmpNum2=explode("-",$tmpkey4);
					
					$num1=$TBL_tmpNum1[0].$TBL_tmpNum1[1].$TBL_tmpNum1[2].$TBL_tmpNum1[3].$TBL_tmpNum1[4].$TBL_tmpNum1[5];
					$num2=$TBL_tmpNum2[0].$TBL_tmpNum2[1].$TBL_tmpNum2[2].$TBL_tmpNum2[3].$TBL_tmpNum2[4].$TBL_tmpNum2[5];
					// echo "<i>" . $num1 . "</i> : " . $num2 . "<br/>";
					// On remplace si la clef est plus récente
					if($num1>$num2)
					{
						// echo "ok";
						$TBL_BAT_LOE[$clef]=$value ."|";
					}
				}
				else
				{
					$TBL_BAT_LOE[$clef]=$value ."|";
				}
			}
		// Récupère la liste des BATs validés
		$files = scandir($batsDirectoryV, SCANDIR_SORT_DESCENDING);
		// Tri par Date
		foreach($files as $key=>$value)
		{
			$tmpKey=explode("_",$value);
			// Mettre un tri par date ! 24/07/2024
			$clef=$tmpKey[0]."_" . $tmpKey[1];
			
			if(isset($TBL_BAT_LOE[$clef]))
			{
				$tmpKey2=explode("_",$TBL_BAT_LOE[$clef]);
				$tmpkey3= $tmpKey[2] ."-". $tmpKey[3];
				$tmpkey4= $tmpKey2[2] ."-". $tmpKey2[3];
				$TBL_tmpNum1=explode("-",$tmpkey3);
				$TBL_tmpNum2=explode("-",$tmpkey4);
				$num1=$TBL_tmpNum1[0].$TBL_tmpNum1[1].$TBL_tmpNum1[2].$TBL_tmpNum1[3].$TBL_tmpNum1[4].$TBL_tmpNum1[5];
				$num2=$TBL_tmpNum2[0].$TBL_tmpNum2[1].$TBL_tmpNum2[2].$TBL_tmpNum2[3].$TBL_tmpNum2[4].$TBL_tmpNum2[5];
				// echo "<i>" . $num1 . "</i> : " . $num2 . "<br/>";
				// On remplace si la clef est plus récente
				if($num1>$num2)
				{
					// echo "ok";
					$TBL_BAT_LOE[$clef]=$value ."|";
				}
			}
			else
			{
				$TBL_BAT_LOE[$clef]=$value ."|";
			}
		}
		// print_r($TBL_BAT_LOE);
    }
    $articles=array();
    $sqlArticles="Select * from articles where prefix_contractor = '" . $contractor. "'";
    $retourArticles=mysqli_query($con,$sqlArticles);
    while($rowArticle=mysqli_fetch_array($retourArticles))
    {
        $articles[]= $rowArticle['ref_produit_fini'];
    }
    $batValid=false;
    $sql2="select * from " . $contractor . "_orders  where num_of='" . $num_of. "' order by type_label asc, id desc";
    if($contractor=="lem")
    {									
        // Requête pour les lignes avec CARE LABEL
        $sql2 = "select *, SUM(qty_init) as qty_init_total, SUM(qty_to_produce) as qty_to_produce_total
        FROM lem_orders WHERE num_of= '".$num_of."' and type_ordre = 'COMPO' GROUP BY num_of, reference ;";
                                                    
    }
    if($contractor=="mmg")
    {									
                                        
        $sql2 = "select * FROM mmg_orders WHERE num_of= '".$num_of."' and reference= '".$reference."' GROUP BY 
        CONCAT(num_of, '_', reference,'_',type_label,'_',size,'_',coloris) order by type_label asc, id desc;";													
    }
    if($contractor=="lan")
    {									
        $sql2 = "select * FROM lan_orders WHERE num_of= '".$num_of."' and reference= '".$reference."' and type_label = 'CARE LABEL' GROUP BY num_of, reference order by  id desc;";													
    }
    $retour2=mysqli_query($con,$sql2);
    while($row2=mysqli_fetch_array($retour2))
    {
	    $fullLinkImage="";
	
		// Exception DIOR
		if($contractor=="dior" || $contractor=="diorhc")
		{
			if($row2['size']=="U" and $row2['prefix_bat']=='CL')//
			{
				$row2['size']="TU";
			}
			if($row2['prefix_bat']=='STK')
			{
				$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" ;
			}
			else
			{
				$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['size'] . "_" ;
			}
			
		// Recherche la dernière version validées
			$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
			$retourB=mysqli_query($con,$sqlB);
			// echo "<td>";
				// echo $sqlB;
			// echo "</td>";
			while($rowB=mysqli_fetch_array($retourB))
			{
				$fullLinkImage=$rowB['bat_name'];
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			// Recherche spécifique Dior Taille U depuis un fichier extracfinal à la place du fichier Excel fournit en début de saison
			// Recherche uniquement si on n'a pas trouvé précédemment avec TU
			if(trim($fullLinkImage)=="")
			{
				
				if($row2['size']=="TU" and $row2['prefix_bat']=='CL')//
				{
					$row2['size']="U";
				}
				if($row2['prefix_bat']=='STK')
				{
					$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" ;
				}
				else
				{
					$fullNameBAT=$row2['prefix_bat'] . "_" . $row2['reference'] . "_" . $row2['size'] . "_" ;
				}
				// Recherche la dernière version validées
				$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
				$retourB=mysqli_query($con,$sqlB);
				$fullLinkImage="";
				while($rowB=mysqli_fetch_array($retourB))
				{
					$fullLinkImage=$rowB['bat_name'];
				}
			}
		} // Fin Exception DIOR
		// Exception MMG
		if($contractor=="mmg")
		{	
			if($row2['type_label']=="CARE_LABEL")
			{
				$row2['type_label']="CARE LABEL";
			}
			//
			$row2['size']=str_replace("/",".",$row2['size']);
			//
			$fullNameBAT=$row2['num_of'] . "_" . $row2['reference'] . "_" . $row2['coloris'] . "_" . $row2['code_ean'] . "_" . $row2['size'] . "_" . $row2['type_label'] . "_" ;
			
			// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
			$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
				
			// Modification du 18.04.2024
			
			for($b=1;$b<=$cpt_BAT_MMG;$b++)
			{
				
				if(strpos($TBL_BAT_MMG[$b],$fullNameBAT)===false)
				{
					// Rien
				}
				else
				{
					// BAT trouvé
					$fullLinkImage=$TBL_BAT_MMG[$b];
					break;			
				}
				
			}
		} // Fin MMG
		// Exception Lemaire
		if($contractor=="lem")
		{	

			// Eliminer le _1 ou _2 en cas de commande introduite plusieurs fois
			$num_of=explode('_', $row2['num_of'], 2);
			// $fullNameBAT=$row2['num_of'] . "_" . $row2['type_label'] . "_" ;
			$fullNameBAT=$num_of[0] . "_" . $row2['type_ordre']  ;
			// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
			$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
			// Recherche la dernière version validées
			$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
			// echo $sqlB;
			$retourB=mysqli_query($con,$sqlB);												
			
			while($rowB=mysqli_fetch_array($retourB))
			{
				$fullLinkImage=$rowB['bat_name'];
			}
		} // Fin Lemaire
		// Exception Loewe
		if($contractor=="loe")
		{	
			// !!!!!!!!!!!! ATTENTION ON PEUT AVOIR PLUSIEURS TYPE ETIQUETTES !!!!!!!!!!!!!!!!!!!
			// $fullNameFolder = substr($row2['saison'],0,4)  . "-" . $row2['reference'] . "_" ;//Date proelia ensuite
			$fullNameImage = substr($row2['saison'],0,4)  . "-" . $row2['reference'] . "_" . $row2['prefix_bat'] ;												
			if(isset($TBL_BAT_LOE[$fullNameImage]))
			{
				$TBL_IMG_LOE=explode("|",$TBL_BAT_LOE[$fullNameImage]);
				// print_r($TBL_IMG_LOE); 
				// echo $fullNameImage . ":" ;
				// echo $TBL_BAT_LOE[$fullNameImage];
				// print_r($TBL_BAT_LOE);
				$fullNameBAT  = $TBL_IMG_LOE[0];
				// Recherche la dernière version validée
				$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
				// echo $sqlB;
				// $fullLinkImage="";
				$retourB=mysqli_query($con,$sqlB);											
				while($rowB=mysqli_fetch_array($retourB))
				{
					$fullLinkImage=$rowB['bat_name'];
				}
				// echo "<b>" . $fullLinkImage . "</b>";
			}
			
		} // Fin Loewe
		
		//
		// Exception CHLOE
		if($contractor=="chloe")
		{
			if($row2['type_label']=="CARE_LABEL")
			{
				$row2['type_label']="CARE LABEL";
			}
			//
			$row2['size']=str_replace("/",".",$row2['size']);
			// echo $row2['type_label'];
			// echo substr($row2['type_label'],0,8);
			if(substr($row2['type_label'],0,8)=="BAR_CODE")
			{
				// C'est du sticker
				$fullNameBAT=$row2['reference'] . "_S_" ;
			}
			else
			{
				// C'est du care_label ..... A la place de S on a 20...début du 21ème siècle (2024...2025....)
				$fullNameBAT=$row2['reference'] . "_20" ;
			}
			// echo "..."  . $fullNameBAT . "<br/>";
			// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
			$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
		// Recherche la dernière version validées
			$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
			$retourB=mysqli_query($con,$sqlB);
			
			
			while($rowB=mysqli_fetch_array($retourB))
			{
				$fullLinkImage=$rowB['bat_name'];
			}
		} // Fin CHLOE
		// Exception lanvin
		if($contractor=="lan")
		{
			if($row2['type_label']=="CARE LABEL")
			{
				// 
				$fullNameBAT=$row2['reference'] . "_" ;	
				// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
				$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
				// Recherche la dernière version validées
				$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
				$retourB=mysqli_query($con,$sqlB);
				//echo $sqlB;
				
				while($rowB=mysqli_fetch_array($retourB))
				{
					$fullLinkImage=$rowB['bat_name'];
				}
			}
            
			
		} // Fin LANVIN
		// Exception ALAIA
		if($contractor=="ala")
		{
			if($row2['type_label']=="CARE LABEL")
			{
				// 
				$fullNameBAT=$row2['num_of'] . "_" ;	
				// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
				$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
			// Recherche la dernière version validées
				$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
				$retourB=mysqli_query($con,$sqlB);
													
				while($rowB=mysqli_fetch_array($retourB))
				{
					$fullLinkImage=$rowB['bat_name'];
				}
			}
		} // Fin ALAIA
		// Exception PATOU
		if($contractor=="patou")
		{
			$prefix="";
			if($row2['type_label']=="CARE LABEL"){
				$prefix="1_";
			}
			if($row2['type_label']=="QRCODE COTTON LABEL"){
				$prefix="2_";
			}
			if($row2['type_label']=="STICKER CARELABEL BLISTER"){
				$prefix="3_";
			}
			if($row2['type_label']=="STICKER QR CARELABEL BLISTER"){
				$prefix="4_";
			}
			if($row2['type_label']=="PICTURE HANGTAG"){
				$prefix="5_";
			}
			if($row2['type_label']=="QR HANGTAG"){
				$prefix="6_";
			}
			if($row2['type_label']=="QR SAC HANGTAG"){
				$prefix="7_";
			}
			// 
			$fullNameBAT=$row2['reference'] . "_" . $prefix ;	
			// ATTENTION POUR LES BAT COMMENCANTS PAR UN NUMERO D'O.F. ON ENLEVE LE DUP_
			$fullNameBAT=str_replace("DUP_","",$fullNameBAT);
		// Recherche la dernière version validées
			$sqlB="select * from suivi_bats where bat_name like '%" . $fullNameBAT . "%' and (bat_name like '%_1.png' or bat_name like '%_1.bmp') and state=1 and prefix_contractor='" . $contractor. "' order by horodatage desc limit 1";
			$retourB=mysqli_query($con,$sqlB);
															
			while($rowB=mysqli_fetch_array($retourB))
			{
				$fullLinkImage=$rowB['bat_name'];
			}
		} // Fin PATOU
		//On est sur un BAT validé
		if(trim($fullLinkImage)>"")
		{
			$batValid=true;
		}
		else // Bat en attente de validation
		{			
			$batValid=false;
			break;
		}
        

	}
    if($contractor=="lan")
	{
		if($row2['type_label']!="CARE LABEL")
		{
            $batValid=true;
        }
    }
    for($i=0;$i<count($articles);$i++){
        if($reference==$articles[$i]){
            $batValid=true;
            break;
        }
    }
    if($batValid==true)	{
        return true;
    }
    else{
        // Pas de BAT validé 
        return false;
    }
}