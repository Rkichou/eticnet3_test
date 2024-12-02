<?php
	session_start();
	require_once("../config.inc.php");
    require_once("./is_session_active.php");
    // Récupérer les données transmises via POST
    
    $reference = $_POST['reference'];
    $user_id = $_POST['user_id'];
    $qty = $_POST['qty'];
    
    $supplier = $_POST['supplier'];
    $ref_contractor= $_SESSION['prefix_contractor'];
    $prefix=strtoupper($ref_contractor);
  
    $statut = 0;
    $date_ordre = new DateTime();
    $date_ordre=$date_ordre->format('Y-m-d H:i:s');
    //enregsitrement du nouveau ordre
    $sqlCart="insert into `cart` (`id`,`qty`,`reference_article`,`id_user`,`code_supplier`,`date_integration`,`status`) ";
    $sqlCart.="VALUES (NULL,";
    
    $sqlCart.="'" . $qty . "',";
    $sqlCart.="'" . $reference . "',";
    $sqlCart.="'" . $user_id . "',";
    $sqlCart.="'" . $supplier . "',";
    $sqlCart.="'" . $date_ordre. "',";
    
    $sqlCart.="'". $statut . "');";
    $retour=mysqli_query($con,$sqlCart);
 