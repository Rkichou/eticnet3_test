<?php
	session_start();
	require_once("config.inc.php");
	require_once("languages.inc.php");
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
		<title>ETICNET V2</title>
		<link rel="stylesheet" type="text/css" href="css/ee_eticnet2.css?v=<?php echo date('Ymdhis');?>"/>
		<script src="js/ee_eticnet2.js?date=<?php echo date('Ymdhis');?>"></script>
		<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
		<!-------------------- fontawesome ------------------------------------------>
		<link href="css/fontawesome.css" rel="stylesheet">
		<link href="css/brands.css" rel="stylesheet">
		<link href="css/solid.css" rel="stylesheet">
		<!---------------------------------------------------------------------------->
		<link rel="shortcut icon" href="/images/favicon.ico">
	</head>
	<body onload="populate_menu();js_version();">
		<div class='as_agence-main as_agence-center'> <!--  Start main --> 
			<?php 
				
				require_once("header.php");
				// print_r($_SESSION);
				// print_r($TBL_MESSAGE);
				// echo "<hr/>";
				// print_r($_COOKIE);
				
				/////////////////////////////////////////////////////////////////////////////////////////////
					$login="";
					if(isset($_COOKIE['validateeekeylogin']))
					{	
						$login=$_COOKIE['validateeekeylogin'];
					}
					$password="";
					if(isset($_COOKIE['validateeekeyconf']))
					{	
						$password=$_COOKIE['validateeekeyconf'];
					}
					$remember="";
					if(isset($_COOKIE['validateeekeyremember']))
					{	
						$remember=$_COOKIE['validateeekeyremember'];
						if($remember==1)
						{
							$remember=" checked=checked";
						}
						else
						{
								$remember="";
						}
					}
			?>
			<div class="as_agence-corps">
				
				<!-------------------------- Affichage des menus -------------------------------------------------------->
				<div id="container_left" class="as_agence-menu-container-left ">
						<?php require_once("includes/menu_box.php");?>
				</div><!--- End Container left -->
				<!------------------------------------------------------------------------------------------------------>
				<!-------------------------- Affichage du contenair right ----------------------------------------------->
				<div id="container_right" class="as_agence-menu-container-right as_agence-image-accueil as_agence-right">
					<h3>
						<br/>
						<?php echo $TBL_MESSAGE[3];?>
					</h3>
					<div class="as_agence-spacer-middle"></div>
					<div class="as_agence-spacer-middle"></div>
					<div class="as_agence-spacer-middle"></div>
					<div class="as_agence_box-connect as_agence-ombre as_agence-center">				
						<input class='as_agence-input' placeholder='Login' id='login' name='login' style='width:80%' value='<?php echo $login; ?>'>
						<br/><br/>
						<input class='as_agence-input' type='password' placeholder='Password' id='password' name='password' value='<?php echo $password; ?>' style='width:80%'>
						<br/><br/>
								<!-- 
									<div style='text-align:center;vertical-align:middle;line-height:32px;border:0px solid #202020'>
										<h6 style='display:inline-block;line-height:32px;vertical-align:middle'><?php // echo "" . $TBL_MESSAGE[4] . "";?></h6>
										<input type='checkbox' id='memo' name='memo' <?php //echo $remember;?> style='display:inline-block;height:32px;vertical-align:middle' >
									</div>
								-->
						<br/>
						<input type='button' onclick='check_access();' class='as_agence-bouton' value='<?php echo $TBL_MESSAGE[11] ;?>' style='width:40%'>
						<br/><br/><br/>
						<label style='cursor:pointer;' onclick='send_new_password();' ><h6><?php echo "<u>" . $TBL_MESSAGE[5] . "</u>";?></h6></label>
						<br/><br/><br/>
						<label id='retour_conexion'></label>
					</div>
					<div class="as_agence-spacer-middle"></div>
					<div class="as_agence-spacer-middle"></div>
					<div class="as_agence-center" style='margin-left:40%;width:58%;padding-right:0%;border:0px solid #303030'>
						<label style='display:inline-block'><h6><?php echo "" . $TBL_MESSAGE[8] . "";?></h6></label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label style='display:inline-block' onclick=\"document.location.href='https://www.eticeurope.com'\"><h6>ETICEUROPE.COM</h6></label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label style='display:inline-block'><h6><?php echo "" . $TBL_MESSAGE[10] . " : <a href='mailto:supportit@eticeurope.com' style='color:#202020;'>supportit@eticeurope.com</a>";?></h6></label>
					</div>
				</div>	<!--- End container right -->
			</div> <!--- End Corps -->
		</div> <!--  End main -->
	<?php require_once("footer.php");?>
	</body>
</html>
