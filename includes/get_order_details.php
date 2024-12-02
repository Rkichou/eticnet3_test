<?php

	require_once("../config.inc.php");
	require_once("./is_session_active.php");
    
	$user_id = $_SESSION['id'];
	$reference = $_POST['reference'];
	$sessionPrefix = $_SESSION['prefix_contractor']; // Récupérer le préfixe du contractor de la session
	// Rècupère la global SumUP en fonction du contractor et du status
	$sql2="select * from articles where prefix_contractor='" . $sessionPrefix. "' and ref_produit_fini ='".$reference."' limit 1;";
	$retour2=mysqli_query($con,$sql2);
	$row2=mysqli_fetch_object($retour2);
	// Rècupère les suppliers en fonction du contractor
		// Manufacturer
		$sqlS="select * from  users_adresses  where `contractor`='" . $_SESSION['prefix_contractor_id'] . "'";
		$retourS=mysqli_query($con,$sqlS);
		while($rowS=mysqli_fetch_array($retourS))
		{	
			$option = "<option value=\"" . $rowS['code_supplier'] . "\">" . $rowS['company_name'] . "</option>";		
			$options[] = $option; // Ajouter l'option à la fin du tableau 
			
		}
	//$stock= $row2->in_stock;
	?>
	<div class='modal-header'>
			
		<h4 class='modal-title left-align2' id='orderModalLabel'><?php echo $reference ?></h4>
		<button type='button' class='modal-close' data-dismiss='modal' aria-label='Close' onclick="close_order_modal('orderModal')">
			<img src="images/icones/close.svg" alt="Delete order" class="delete">
		</button>
	</div>
		<div class='modal-body'>		
			<form id="order-form" method="POST" action="">

					<div class="form-groups popup-body">
						<div class='form-group'>
							<label for="suppliers">Manufacturer</label>
							<select id="suppliers" name="suppliers" title="suppliers" class="suppliers">
				
									<?php 
									foreach ($options as $option) {
										echo $option;
									} 
									?>
							</select>
						</div>
						<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id;?>">
						<input type="hidden" class="form-control" id="reference" name="reference" value="<?php echo $reference;?>">
						
						<div class="form-group">
							<label for="qty">Quantity</label>
							<input type="text" class="form-control popup-input" id="qty" name="qty" value="0">
						</div>
						<div class="form-group">
							<div class="error-box" id="error-box"></div>			
						</div>
					</div>
				
				<div class="modal-footer popup-footer">
					<button type="button" class="popup-validate" onclick="save_cart_order()">Place Order</button>
				</div>
			</form>
	  	</div>

    
