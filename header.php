	<div class='as_agence-header-box as_agence-right'>
		<?php
				echo "<label style='display:inline-block;color:#ccc;cursor:pointer;line-height:40px;width:80%;vertical-align:middle' id='header_login'></label>";
				echo "<label style='display:inline-block;color:#ccc;cursor:pointer;line-height:40px;width:150px;vertical-align:middle' id='js_version'>logout</label>";
				echo "<label style='display:inline-block;color:#fefefe;cursor:pointer;line-height:40px;width:150px;vertical-align:middle;padding-right: 20px;' onclick='disconnect();'><i class='fa fa-sign-out' aria-hidden='true'></i> Logout</label>";
				echo "<div style='display:inline-block;cursor:pointer;line-height:40px;vertical-align:top;color:#ffffff;padding-right:10px;' onclick=\"document.location.href='index.php?lg=fr'\">";
					echo "&nbsp;<img src='https://flagcdn.com/w40/fr.png' srcset='https://flagcdn.com/w80/fr.png 2x' width='20' alt='French'>";
				echo "</div>";
				echo "<div style='display:inline-block;cursor:pointer;line-height:40px;vertical-align:top;color:#ffffff;padding-right:10px;' onclick=\"document.location.href='index.php?lg=en'\">";
					echo "&nbsp;<img src='https://flagcdn.com/w40/us.png' srcset='https://flagcdn.com/w80/us.png 2x' width='20' alt='English'>";
				echo "</div>";
				// echo "<div style='display:inline-block;line-height:40px;vertical-align:top;color:#ffffff;padding-right:10px;' onclick=\"document.location.href='index.php?lg=cn'\">";
					// echo "<img src='images/chinese_flag.png' class='as_agence-drapeau'>";
				// echo "</div>";
		?>
	</div>
	<div class='as_agence-header-box-logo as_agence-left'> 
		<div class='as_agence-logo-ee as_agence-left'>
			<table style='width:100%;border-spacing:0px;'>
				<tr>
					<td style="width:120px;background:#202020;padding: 0;"></td>
					<td style='width:50%;text-align:left;border-bottom: 1px solid #d9d9d9;'><img style='cursor:pointer;margin: 10px 10px;' onclick="document.location.href='index.php'" src="images/myeticnet.png" class='as_agence-dimension-logo' alt='EticNeT'></td>
					<td style='width:auto;text-align:right;border-bottom: 1px solid #d9d9d9;'><img src="images/eticeurope.png" class='as_agence-dimension-logo' alt='EticNeT'></td>
				</tr>
			</table>
		</div>
	</div>
	<?php
		if(isset($_SESSION['id']))
		{
			// echo "
			// <div id='header-menu' class='as_agence-header-box-menu as_agence-left'> 
			// ";
			// print_r($_SESSION);
			// Succès de connexion. On renvoit à js le OK plus les variables de connection
			$service=str_replace("|"," - ",$_SESSION['user_service']);
			$service=str_replace(":"," ",$service);
			$service=substr($service,0,-2);
			// 
			$contractor=strtoupper($_SESSION['prefix_contractor']);
			//
			echo "<script>document.getElementById('header_login').innerHTML=\"" ;
				echo strtoupper($_SESSION['user_name']) . " " . $_SESSION['user_role_name'] . " " . $service . " " . $contractor; 
			echo "\";</script>"; 
			
		}
	?>
<!-- ALL DEVICES -->
<?php
			$page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);
			// echo $page;
			// if(!isset($_SESSION['id']))
			// {
				// if($page != "valide_pointage.php" && $page != "update_pointage.php" && $page != "index.php" && $page != "index_stock_recept.php" && $page != "index_stock_recept_validate.php" && $page != "enregistre_stock_vip.php"  && $page != "index_stock_vip.php" && $page != "enregistre_stock_hc.php"  && $page != "index_stock_hc.php" && $page != "enregistre_stock_papf.php"  && $page != "index_stock_papf.php" && $page != "portal_access.php" && $page != "check_access.php" && $page != "index_quick.php" && $page != "check_access_quick.php" && $page != "index_heure.php" && $page != "analyse_value_dior_SH.php" && $page != "analyse_value_dior_SH_enregistre.php")
				// {
					// echo "<div class='as_agence-spacer'></div>";
					// echo "<div class='as_agence-div as_agence-ombre as_agence-center' onclick=\"document.location.href='index.php'\";>";
						// echo "<img src='images/AdobeStock_203344926.jpg' style='width:98%'>";
					
				
						// echo "<br/><br/><h1>Vous devez vous <u>identifier</u> pour continuer.</h1>";
					// echo "</div>";
					// die();
				// }
			// }
		
	?>