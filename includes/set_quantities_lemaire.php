<?php
function calculateQuantityToProduce($qty_init) 
{
    if ($qty_init >= 1 && $qty_init <= 50) {
        return $qty_init + 5;
    } 
    else if ($qty_init > 50 && $qty_init <= 100) {
        return $qty_init + 10;
    } 
    else if ($qty_init > 100 && $qty_init <= 150) {
        return $qty_init + 15;
    } 
    else if ($qty_init > 151 && $qty_init <= 200) {
        return $qty_init + 20;
    } 
    else if ($qty_init > 201 && $qty_init <= 250) {
        return $qty_init + 25;
    } 
    else {
        // Ajoutez ici d'autres conditions si nécessaire
        return $qty_init+30; // Par défaut, retourne la quantité initiale
    }
}
function calculateQuantityInit($id, $qty_init)
{
    $sql=" SELECT * FROM lem_orders where id ='".$id. "'";
    $retour=mysqli_query($con,$sql);
    $row =  mysqli_fetch_array($retour);
    $qty_double = $qty_init;
    if($row['type_ordre']=="COMPO-STICKER") {
        if (strpos($reference, 'FO') === 0)
		{
			$qty_double = $qty_init;
		}
		else
		{
		    $qte_double= $qty_init * 2;										
		}
    }
    return $qty_double;
}
?>