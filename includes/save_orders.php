<?php
	require_once("../config.inc.php");
    require_once("./is_session_active.php");
    // Récupérer les données transmises via POST
    
    
    $user_id = $_POST['id_user'];
    $orders = $_POST['orders'];
    $addresses = $_POST['addresses'];
    $suppliers=$_POST['suppliers'];  
    $quantities=$_POST['quantities'];
    //$adresses = $company . "\r\n" . $address1 . "\r\n" . $addaddress . "\r\n \r\n \r\n" . $zipcode . "\r\n \n\r" .$city . "\n\r". $country;
    $date_ordre = new DateTime();
    $date_ordre=$date_ordre->format('Y-m-d H:i:s');

    // Assurez-vous que les tableaux ont la même longueur
    if (count($addresses) === count($suppliers) && count($suppliers) === count($quantities)) {
        for ($i = 0; $i < count($quantities); $i++) {

            $num_of = $user_id . date('YmdHis') . $i;
            $address = $addresses[$i];
            $supplier = $suppliers[$i];
            $quantity = $quantities[$i];
            $order = $orders[$i];
            // Récupère le printshop

           $sqlSupplier="select * from  users_adresses where company_name='"  . $supplier . "' and `contractor`='" . $_SESSION['prefix_contractor_id'] . "'limit 1"; 
                
            $retourSupplier=mysqli_query($con,$sqlSupplier); 
            $rowSupplier=mysqli_fetch_object($retourSupplier);

            $addresse= $supplier . "\r\n" . $rowSupplier->$address . "\r\n" . "". "\r\n \r\n \r\n" . $rowSupplier->zip . "\r\n \n\r" .$rowSupplier->city . "\n\r". $rowSupplier->country;
            if($rowSupplier->printshop==0){
                $printshop=1;
            }else{
                $printshop=$rowSupplier->printshop;
            }
            $code_supplier=$rowSupplier->code_supplier;

            //Mise à jour de la cart
            $sqlUpdate="UPDATE cart SET  status = 1 , date_validation = '". date('Y-m-d H:i:s') ."' , num_commande = '".$num_of."', qty = ".$quantity." , code_supplier ='".$code_supplier."' "; 
            $sqlUpdate.= "WHERE id_user="  .$user_id . " and status = 0 and id = ".$order.";";
            $retourUpdate=mysqli_query($con,$sqlUpdate);
            $user=$rowSupplier->id_user;
            $statut = 4;
            //$code_service= "NULL";
    
            // Récupère les commandes validés par l'utilisateur
            $sqlCart="select * from  cart where id_user='"  . mysqli_real_escape_string($con,$user_id) . "' and id = '".$order."' ";
            $sqlCart.=" and code_supplier ='".$code_supplier."' limit 1"; 
            
            $retourCart=mysqli_query($con,$sqlCart); 
            
            $rowCart=mysqli_fetch_object($retourCart);
    
        
            // Récupère les références validés par l'utilisateur
            $sqlRef="select * from  articles where ref_produit_fini='"  . $rowCart->reference_article . "';"; 
            $retourRef=mysqli_query($con,$sqlRef); 
            $rowRef=mysqli_fetch_object($retourRef);
            
            $ref_support=$rowRef->ref_produit_fini;
            $ref_contractor=$rowRef->ref_contractor;
            $libelle=$rowRef->libelle;

            if($ref_contractor=='mmg'){           
                $qty_to_produce=$rowCart->qty;
            }
            else{
                $qty_to_produce=$rowCart->qty;
            }
            //  Injection dans la base de données
            $sql="insert into " . $_SESSION['prefix_contractor'] . "_orders ";
            $sql.="(`id`, `validation_supplier`,`code_ean`, `made_in`,`coloris`,`size`,`cup`, `num_of`, `code_supplier`, `type_label`,  `reference_support`, `reference`,"; 
            $sql.="`qty_init`, `qty_to_produce`,  `status`, `id_printshop` , `other_delivery_adress`,`date_integration`)"; 
            $sql.= " VALUES (NULL,";
            $sql.="'" . "1"  . "',";
            $sql.="'" . "NONE"  . "',";
            $sql.="'" . "NONE"  . "',";
            $sql.="'" . "NONE"  . "',";
            $sql.="'" . "NONE"  . "',";
            $sql.="'" . "NONE"  . "',";
            
            $sql.="'" . $num_of . "',";
            $sql.="'" .  $code_supplier . "',";
            $sql.="\"" . mysqli_real_escape_string($con,$libelle ) . "\",";
            $sql.="\"" . mysqli_real_escape_string($con,$ref_contractor)  . "\",";
            $sql.="\"" . mysqli_real_escape_string($con,$ref_support)  . "\",";
            
            $sql.="'" . $rowCart->qty  . "',";
            $sql.="'" . $qty_to_produce  . "',";
            $sql.="'" . $statut  . "',";
            $sql.="'" . $printshop  . "',";
            $sql.="\"" . $addresse  . "\",";
            
            $sql.="'" . date('Y-m-d H:i:s') . "')";
            
            $retour=mysqli_query($con,$sql);
        }
        // echo $sql;
    echo "<div class='orders'>";                           
    echo "<p>Your order has been successfully processed</p>";
    echo "<a href='includes/download_summary.php?user_id=" . $user_id . "' target='_blank' class='button'>Download Summary</a>";
    echo "</div>";
    
    } 
    else {
        echo "Values mismatch.";
    }

?>