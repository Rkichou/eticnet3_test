<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
	require_once("../config.inc.php");
	require_once("is_session_active.php");
    
	$user_id = $_SESSION['id'];
	$reference = $_POST['reference'];
	$num_of = $_POST['num_of'];
	$sessionPrefix = $_SESSION['prefix_contractor']; // Récupérer le préfixe du contractor de la session
	if($_SESSION['prefix_contractor']=="mmg" || $_SESSION['prefix_contractor']=="lan")
	{
	$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders Where num_of='".$num_of."' and reference='".$reference."' group by num_of,reference ";
}
	else{
	$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders Where num_of='".$num_of."' group by num_of ";

	}	
$result = mysqli_query($con, $sql);
	$row=mysqli_fetch_object($result)
?>
	<div class="popupComment-content">
		<div class="modal_title">      
			<h5>Comments</h5>
			<button class="close-popupComment-btn modal-close"  data-dismiss='modal' aria-label='Close' onclick="close_order_modal('commentPopup')">
				<img src="images/icones/close.svg" alt="close" class="navbar-icon">
			</button>
		</div>
		<?php if($row->comment_contractor!=""){ ?>
			<div class="customer-comment">
				<div class="header-row">
					<h5>Corporate</h5>
					<p><?php if($row->horodatage_contractor_comment!=""){
							echo $row->horodatage_contractor_comment;
						}

					?></p>
				</div>
				<p><?= $row->comment_contractor ?></p>
				
			</div>
		<?php }  if($row->comment_production!=""){ ?>
			<div class="customer-comment">
				<div class="header-row">
					<h5>Etic Europe</h5>
					<p><?php if($row->horodatage_production_comment!=''){
							echo $row->horodatage_production_comment;
						}

					?></p>
				</div>
				<p><?= $row->comment_production ?></p>
            
        	</div><?php } 
			if($row->comment_kac!=""){ ?>
			<div class="customer-comment">
				<div class="header-row">
					<h5>Key Account Coordinator</h5>
					<p><?php if($row->horodatage_production_comment!=''){
							echo $row->horodatage_production_comment;
						}

					?></p>
				</div>
				<p><?= $row->comment_kac ?></p>
            
        	</div><?php }
		if($row->comment_supplier!=""){ ?>
			<div class="customer-comment">
				<div class="header-row">
					<h5>Supplier</h5>
					<p><?php if($row->horodatage_supplier_comment!=''){
							echo $row->horodatage_supplier_comment;
						}

					?></p>
				</div>
				<p><?= $row->comment_supplier ?></p>
            
        	</div><?php } ?>
        <div class="comment-input-section">
            <h5>Message</h5>
            <textarea placeholder="Write here..." id="comment" class="comment-input"></textarea>
            <div class="right" style="text-align:right;">
                <button class="add-comment-btn" onclick="set_comment_contractor('<?= $num_of ?>','<?= $reference ?>');">Add <img src="images/icones/send.svg" alt="Add comment" class="navbar-icon"></button>
            </div>
			<div id="container_error">	</div>
        </div>
    </div>

    
