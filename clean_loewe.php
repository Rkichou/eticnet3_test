<?php
	session_start();
	require_once("config.inc.php");
	$sql="select * from loe_orders";
	$retour=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($retour))
	{
		echo $row['num_of'] . "<br/>";
		$sql2="update loe_orders set num_of='" . trim($row['num_of']) . "' where num_of='" . $row['num_of'] . "'" ;
		$retour2=mysqli_query($con,$sql2);
	}