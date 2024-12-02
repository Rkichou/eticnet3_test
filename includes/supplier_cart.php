<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	//
	// print_r($_SESSION);
	// die();
	// Rècupère les services en fonction du contractor
	$sql2="select * from services where prefix_contractor='" . $_SESSION['prefix_contractor']. "' order by name";
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		// Attention ici on prends le code service comme clef et non pas l'id vue que la recherche se fait par le contractor et que le code service est injecté dans les fichiers d'échanges
		$tbl_service[$row2['code_service']] = $row2['code_service'] . ":" . $row2['name'];
	}
	// Rècupère les unités de facturations
	$sql2="select * from unite_facturation ";
	$retour2=mysqli_query($con,$sql2); 
	while($row2=mysqli_fetch_array($retour2))
	{
		$tbl_unite[$row2['id']] =  $row2['name'];
	}
	// Barre de recherche
	echo "<div class='as_agence-div-header-table-dashboard'>";
		$nomParametre="search_criteria_supplier";
		if(!isset($_SESSION[$nomParametre]))
		{
			$searchCriteria="";
		}
		else
		{
			$searchCriteria=$_SESSION[$nomParametre];
		}

	echo "<div class='as_agence-div-header-table-dashboard'>";
		// state_criteria_chk_state_1_status
		echo "<b>SUPPLIER CART</b> " . $TBL_MESSAGE[17];
		echo "&nbsp;";
		echo  "<input class='as_agence-input2' name='dashboard_customer_search_criteria". "' value=\"" . $searchCriteria . "\" onkeyup=\"set_search_criteria_cart_supplier_keyup(event,this);\" onblur=\"set_search_criteria_cart_supplier(this);\">";
		echo "<br/><br/>";
		print_r($_SESSION['user_id_service']); 
	echo "</div>";
	echo "<div class='as_agence-div-content-table'>";
			$num_ligne++;
			if($num_ligne % 2==0)
			{
				$classLigne="class='as_agence-table-datas as_agence-table-pair'";
			}
			else
			{
				$classLigne="class='as_agence-table-datas as_agence-table-impair'";
			}
			$sql="select * from articles where prefix_contractor='" . $_SESSION['prefix_contractor'] . "' and retails='O' and (libelle like \"%$searchCriteria%\" or ref_produit_fini like \"%$searchCriteria%\" or ref_contractor like \"%$searchCriteria%\")";
			$retour=mysqli_query($con,$sql);
			// echo $sql;
			echo "<table style='min-width:100%'>";
				echo "<tr style='background-color:#202020;color:#fefefe'>";
					echo "<td onclick=\"set_order_display_dashboard('num_of','$orderTriDefault');\"><b>REF.</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('reference','$orderTriDefault');\"><b>DESIGNATION</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('coloris','$orderTriDefault');\"><b>DESCRIPTION</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('code_service','$orderTriDefault');\"><b>INVOICE UNIT</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('code_supplier','$orderTriDefault');\"><b>EURO PRICE</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('code_supplier','$orderTriDefault');\"><b>USA PRICE</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('made_in','$orderTriDefault');\"><b>YEN PRICE</b></td>";
					echo "<td><b>Delivrate to</b></td>";
					
					echo "<td onclick=\"set_order_display_dashboard('date_integration','$orderTriDefault');\"><b>QTY</b></td>";
				echo "</tr>";
				while($row=mysqli_fetch_array($retour))
				{
					$num_ligne2++;
					if($num_ligne2 % 2==0)
					{
						$classLigne2="class='as_agence-table-datas '";
					}
					else
					{
						$classLigne2="class='as_agence-table-datas ' style='background-color:#dadada'";
					}
					echo "<tr $classLigne2>";
						echo "<td>";
							echo $row['ref_produit_fini'];
						echo "</td>";
						echo "<td>";
							echo "<label id='lbl_$num_ligne2' >" . $row['ref_contractor'] . "</label>";
						echo "</td>";
						echo "<td>";
							echo $row['libelle'];
						echo "</td>";
						echo "<td>";
							echo $tbl_unite[$row['unite_facturation']];
						echo "</td>";
						echo "<td style='text-align:center'>";
							echo $row['price_eur'] . "&euro;";
						echo "</td>";
						echo "<td style='text-align:center'>";
							echo $row['price_usd'] . "$";
						echo "</td>";
						echo "<td style='text-align:center'>";
							echo $row['price_cny'] . "&yen;";
						echo "</td>";
						echo "<td style='text-align:center'>";
							echo "<select id='deliv_$num_ligne2'  style='background-color:transparent' >";
								$sqlD="select * FROM users_adresses where id_user='" . $_SESSION['supplier_id'] . "'";
								$retourD=mysqli_query($con,$sqlD); 
								while($rowD=mysqli_fetch_array($retourD))
								{
									echo "<option value=\"" . $rowD['id'] . "\">(" . $_SESSION['supplier_id'] . ")" . $rowD['adresse_name'] . " " . $rowD['code_supplier'] . "</option>";
									
								}
							echo "</select>";
						echo "</td>";
						
						echo "<td style='text-align:center'>";
							echo "<input id='qty_$num_ligne2' type='number' style='background-color:transparent' >";
						echo "</td>";
						echo "<td style='text-align:center'>";
							echo "<input type='button' value='Place Order' onclick=\"place_order_supplier('qty_$num_ligne2','lbl_$num_ligne2','deliv_$num_ligne2'," . $row['id'] . ");\"  >";
						echo "</td>";
					echo "</tr>";
				} // While $row 
			echo "</table>";
	echo "</div>";


?>

