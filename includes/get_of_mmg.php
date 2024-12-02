<?php
	session_start();
	require_once("../config.inc.php");
	//
	if(isset($_GET['page']))
	{
		if($_GET['page']==1)
		{
			$limit="limit 0,100";
		}
		else
		{
			$limit="limit " . ($_GET['page']-1)*100 . ",100";
		}
		
			
		
		
	}
	else
	{
		$limit="limit 0,100";
	}
	$sql2="select * from mmg_orders  where num_of='" . $_GET['num_of'] . "' and  status>=4 and status<=7 order by type_label,reference,coloris $limit;";
	$retour2=mysqli_query($con,$sql2);
	// echo $sql2;
	while($row2=mysqli_fetch_array($retour2))
	{
			echo $row2['id'] . "|";
			echo $row2['num_of'] . "|";
			echo $row2['reference'] . "|";
			echo $row2['coloris'] . "|";
			echo $row2['type_label'] . "|";
			echo $row2['qty_to_produce'] . "\r\n";
	}
			

?>

