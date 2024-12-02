<?php
	session_start();
	require_once("../config.inc.php");
	require_once("../languages.inc.php");
	// Controle si une session est active
	// Si non active on stop le script
	require_once("./is_session_active.php");
	//
			$sql="select * from " . $_SESSION['prefix_contractor'] . "_orders order by id";
			
			echo $sql;
			echo "<table border=1px >";
			// die();
			$retour=mysqli_query($con,$sql);
			// echo $sql;
			while($row2=mysqli_fetch_array($retour))
			{
				echo "<tr>";
					echo "<td>";
						echo $row2['id'];
						echo "</td>";
						echo "<td>";
							echo $row2['num_of'];
						echo "</td>";
						echo "<td>";
							echo $row2['reference'];
						echo "</td>";
						echo "<td>";
							echo $row2['coloris'];
						echo "</td>";
						echo "<td>";
							echo $row2['size'];
						echo "</td>";
						echo "<td>";
							echo $row2['type_label'];
						echo "</td>";
						echo "<td>";
							echo $row2['code_ean'];
						echo "</td>";
						echo "<td>";
							echo $row2['qty_init'];
						echo "</td>";
						echo "<td>";
							echo $row2['status'];
						echo "</td>";
						echo "<td>";
							// echo $row2['customer_datas'];
						echo "</td>";
						
						// Vérifie dans les datas
						$tbl_datas=explode("\n",$row2['customer_datas']);
						echo "<td>";
							for($i=0;$i<=count($tbl_datas);$i++)
							{
								// echo $value . "<br/>";
								$tbl2=explode(";",$tbl_datas[$i]);
								if($tbl2[0]=="Style")
								{
									if(trim($tbl2[2])==trim($row2['reference']))
									{
										echo $i . " : <b>" .   $tbl2[2] . "</b> ";
									}
									else
									{
										echo $i . " : " .   $tbl2[2] . " / "; 
									}
								}
								if($tbl2[0]=="couleur")
								{
									if(trim($tbl2[2])==trim($row2['coloris']))
									{
										echo $i . " : <b>" .   $tbl2[2] . "</b> ";
									}
									else
									{
										echo $i . " : " .   $tbl2[2] . " / "; 
									} 
								}
								if($tbl2[0]=="taille")
								{
									if(trim($tbl2[2])==trim($row2['size']))
									{
										echo $i . " : <b>" .   $tbl2[2] . "</b> ";
									}
									else
									{
										echo $i . " : " .   $tbl2[2] . " / "; 
									} 
								}
								if($tbl2[0]=="Code EAN")
								{
									if(trim($tbl2[2])==trim($row2['code_ean']))
									{
										echo $i . " : <b>" .   $tbl2[2] . "</b> ";
									}
									else
									{
										echo $i . " : " .   $tbl2[2] . " / "; 
									}
									echo "<br/>";
								}
								
							}
						echo "</td>";
						
				echo "</tr>";
			} // Fin $row2 	
							echo "</table>";
					


?>

