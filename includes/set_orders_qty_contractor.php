<?php
	session_start();
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	include 'set_quantities_lemaire.php';	
	
	switch ($_SESSION['prefix_contractor'])
	{
		case "lem":
			$qty_init = intval($_POST['comment']);
			// Update de l'enregistrement
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_init=\"" . $qty_init. "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql); 
			// echo $sql;
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql); 
			// echo $sql;
			if($_POST['comment']>0)
			{
				$quantity_toProduce = calculateQuantityToProduce($qty_init);
				// Update de l'enregistrement
				$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
				$sql.= "qty_to_produce=\"" . $quantity_toProduce . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
				$retour=mysqli_query($con,$sql);
			}				
			break;
		case "lan":
				$qty_init = intval($_POST['comment']);
				// Update de l'enregistrement
				$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
				$sql.= "qty_init=\"" . $qty_init. "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
				$retour=mysqli_query($con,$sql); 
				// echo $sql;
				$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
				$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
				$retour=mysqli_query($con,$sql); 
				// echo $sql;
				if($_POST['comment']>0)
				{
					$quantity_toProduce = calculateQuantityToProduce($qty_init);
					// Update de l'enregistrement
					$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
					$sql.= "qty_to_produce=\"" . $quantity_toProduce . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
					$retour=mysqli_query($con,$sql);
				}				
				break;
		case "dior":
			// Update de l'enregistrement
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_init=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql);
			// Premier enregistrement sans freinte (gère les qty à zéro)
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql); 
			// echo $sql;
			if($_POST['comment']>0)
			{
				if($_POST['comment']<=10)
				{
					$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
					$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']+1) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
				}
				else
				{
					$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
					$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']+2) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte	
				}
				$retour=mysqli_query($con,$sql);
			}
			break;
		case "mmg":
			// Update de l'enregistrement
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_init=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql); 
			// echo $sql;
			// Premier enregistrement sans freinte (gère les qty à zéro)
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql); 
			if($_POST['comment']>0)
			{
				$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
				$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']*1.10) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
				$retour=mysqli_query($con,$sql);
			}
			break;
			
		default:
			// Update de l'enregistrement
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_init=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql); 
			// echo $sql;
			// Update de l'enregistrement
			// Premier enregistrement sans freinte (gère les qty à zéro)
			$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
			$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
			$retour=mysqli_query($con,$sql); 
			if($_POST['comment']>0)
			{
				$sql="update " . $_SESSION['prefix_contractor'] . "_orders set ";
				$sql.= "qty_to_produce=\"" . mysqli_real_escape_string($con,$_POST['comment']*1.05) . "\" where id='"  . $_POST['id'] . "' "; // enregistre la qte
				$retour=mysqli_query($con,$sql);
			}
			break;
		}
	
		
?>

