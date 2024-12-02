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
	$sql2="select * from lem_orders  where num_of='" . $_GET['num_of'] . "' and  status>=4 and status<=7 order by type_label,reference,coloris $limit;";
	$retour2=mysqli_query($con,$sql2);
	// echo $sql2;
	$qty=0;
	while($row2=mysqli_fetch_array($retour2))
	{
			if($row2['type_label']=="CARE LABEL")
			{
				$a= $row2['id'] . "|";
				$b= $row2['num_of'] . "|";
				$c= $row2['reference'] . "|";
				$d= $row2['coloris'] . "|";
				$e= $row2['type_label'] . "|";
				$qty+= $row2['qty_to_produce'];
			}
	}
	echo $a ;
	echo $b ;
	echo $c ;
	echo $d ;
	echo $e ;
	echo $qty . "\r\n";

?>

