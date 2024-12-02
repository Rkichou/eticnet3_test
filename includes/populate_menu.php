<?php
	session_start();
	require_once("../config.inc.php");
	 // print_r($_SESSION);
	//
	$sql="select * from `users_menu` as UM inner join ( select id as idmsg, english as message from messages) as MSG on  UM.id_message = MSG.idmsg where id_role='" . $_SESSION['role'] ."' order by  display_order";
	if($_SESSION['lg']=="en")
	{
		$sql="select * from `users_menu` as UM inner join ( select id as idmsg, english as message from messages) as MSG on  UM.id_message = MSG.idmsg where id_role='" . $_SESSION['role'] ."' order by  display_order";
	}
	if($_SESSION['lg']=="fr")
	{
		$sql="select * from `users_menu` as UM inner join ( select id as idmsg, french as message from messages) as MSG on  UM.id_message = MSG.idmsg where id_role='" . $_SESSION['role'] ."' order by  display_order";
	}
	if($_SESSION['lg']=="cn")
	{
		$sql="select * from `users_menu` as UM inner join ( select id as idmsg, chinese as message from messages) as MSG on  UM.id_message = MSG.idmsg where id_role='" . $_SESSION['role'] ."' order by  display_order";
	}
	// echo $sql;
	$retour=mysqli_query($con,$sql); 
	$row=mysqli_fetch_all($retour,MYSQLI_ASSOC);
	echo json_encode($row);
 
