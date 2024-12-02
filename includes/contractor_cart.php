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
		if($row2['name']=="AU MILLE"){
			$row2['name']="1000 pcs";
		}
		else if($row2['name']=="U"){
			$row2['name']="1 pc";
		}
		
		$tbl_unite[$row2['id']] =  $row2['name'];
	}
	$num_ligne=$num_ligne2=0;
	// Affichage des tris
	$orderTriDefault="ASC";
	$nomParametre="order_display_customer_dashboard" ;
	if(isset($_SESSION[$nomParametre]))
	{
		$tbl_tri=explode(":",$_SESSION[$nomParametre]);
		$ordre_tri="order by " . $tbl_tri[0] . " " . $tbl_tri[1];
		if($tbl_tri[1]=="ASC")
		{
			$orderTriDefault="DESC";
		}
		else
		{
			$orderTriDefault="ASC";
		}
	}
	else
	{
		$ordre_tri="order by num_of desc ,date_integration desc";
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
		echo "<b></b> " . $TBL_MESSAGE[17];
		echo "&nbsp;";
		echo  "<input class='as_agence-input2' name='dashboard_customer_search_criteria". "' value=\"" . $searchCriteria . "\" onkeyup=\"set_search_criteria_cart_supplier_keyup(event,this);\" onblur=\"set_search_criteria_cart_supplier(this);\">";
		echo "<br/><br/>";
		//print_r($_SESSION['user_id_service']); 
	echo "</div>";
	echo "<button class='cartButton' id='cartButton' onclick=\"cart_order();\" >Cart <img src='/images/cart.png' alt='Cart'></button>";
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
					echo "<td onclick=\"set_order_display_dashboard('reference','$orderTriDefault');\"><b>Customer Ref</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('internal_ref','$orderTriDefault');\"><b>Internal Ref</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('designation','$orderTriDefault');\"><b>Designation</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('type','$orderTriDefault');\"><b>Type</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('sales_unit','$orderTriDefault');\"><b>Sales Unit</b></td>";
					echo "<td onclick=\"set_order_display_dashboard('price','$orderTriDefault');\"><b>Price/Unity</b></td>";
					//echo "<td onclick=\"set_order_display_dashboard('in_stock','$orderTriDefault');\"><b>In Stock</b></td>";
					//echo "<td onclick=\"set_order_display_dashboard('in_progress','$orderTriDefault');\"><b>In Progress</b></td>";
					echo "<td><b>Actions</b></td>";
					
					
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
							echo $row['ref_contractor'];
						echo "</td>";
						echo "<td>";
							$reference=$row['ref_produit_fini'];
							echo "<label id='lbl_$num_ligne2' >" .  $reference. "</label>";
						echo "</td>";
						echo "<td>";
							echo $row['libelle'];
						echo "</td>";
						echo "<td>";						
							echo $row['type'];
															
						echo "</td>";
						echo "<td>";
							echo $tbl_unite[$row['unite_facturation']];
						echo "</td>";
						echo "<td style='text-align:center'>";
								$sqlD="select * FROM users where id='" . $_SESSION['id'] . "'";
								//echo $sqlD;
								$retourD=mysqli_query($con,$sqlD); 
								$rowD=mysqli_fetch_object($retourD);
								$devise= $rowD->devise;
								//echo $devise;
								switch ($devise){
									case "{1}": 
										echo $row['price_eur'] . " &euro; ";
										break;
									case "{2}":
										echo $row['price_usd'] . " $ ";
										break;
									case "{3}":
										echo $row['price_cny'] . " &yen";
										break;
								}					
						echo "</td>";
						
						$sqlStock="select * FROM articles_stock where contractor='" . $_SESSION['prefix_contractor'] . "' and ref_article='".$row['ref_produit_fini']."' limit 1";
						$retourStock=mysqli_query($con,$sqlStock);
						$rowStock=mysqli_fetch_object($retourStock);
						/*echo "<td style='text-align:center'>";						
							if($rowStock){
								echo $rowStock->in_stock;							
							}
							else{
								echo "-";
							}
						echo "</td>";
						echo "<td style='text-align:center'>";
							if($rowStock){
								echo  $rowStock->in_progress;
							}
							else{
								echo "-";
							}
						echo "</td>";*/
						echo "<td style='text-align:center'>";
							//echo "<input type='button' value='Place Order' onclick=\"place_order_supplier('qty_$num_ligne2','lbl_$num_ligne2','deliv_$num_ligne2'," . $row['id'] . ");\"  >";
							echo "<button class='orderButton' id='orderButton' data-toggle='modal' data-target='#orderModal' data-gs-reference='".$row['ref_produit_fini']."' onclick=\"place_order('".$row['ref_produit_fini']."');\"><img src='/images/place-order.png' alt='Place Order'>Add to cart</button>";
						echo "</td>";
					echo "</tr>";
				} // While $row 
			echo "</table>";
	echo "</div>";
	echo "<div class='modal fade' id='orderModal' tabindex='-1' role='dialog' aria-labelledby='orderModalLabel' aria-hidden='undefined'>";
	echo "<div class='modal-dialog' role='document'>";
		echo "<div class='modal-content'>";
			echo "<div id='order-details'>";
				
			echo "</div>";
		echo "</div>";
	echo "</div>";
echo "</div>"; // Fin de la fenêtre modale -->
?>

