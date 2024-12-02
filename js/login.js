function check_access()
{  
	var data = new FormData();
	var oReq = new XMLHttpRequest();
	var url= "includes/check_access.php";
	oReq.open("POST", url, true);
	oReq.onload = function (oEvent) 
	{
		if (this.readyState == 4 && this.status == 200) {
            var response = oReq.responseText.trim();
            
            // Redirection en fonction de la réponse
            if (response.substr(0, 2) === "OK") {
                // Vérification du rôle renvoyé dans la réponse
                if (response.indexOf("PRINTSHOP") > -1) {
                    // Redirection vers la page printshop
                    window.location.href = 'printshop_view.php';
                } else if (response.indexOf("contractor") > -1) {
                    // Redirection vers la page client
                    window.location.href = 'corporate_view.php';
                }
				else if (response.indexOf("manufacturer") > -1) {
					// Redirection vers la page supplier
					window.location.href = 'supplier_view.php';
				}
				else if (response.indexOf("admin") > -1) {
					// Redirection vers la page supplier
					window.location.href = 'admin_view.php';
				}
				else {
                    // Si le rôle n'est pas reconnu
                    document.getElementById('error-group').innerHTML = "Unknown user. Please check your credentials";
                }
            } else if (response === "DISABLED") {
                display_account_disabled();
            } else {
                // Affichage de l'erreur de connexion
                document.getElementById('error-group').innerHTML = response;
            }
        }
	};
	data.append('login', document.getElementById('email').value);
	data.append('password', document.getElementById('password').value);
	oReq.send(data);
}	
	function populate_menu()
	{
		// Affectation des menus en fonction des roles utilisateurs
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/populate_menu.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			// alert(this.readyState);	48%
			if (this.readyState == 4 && this.status == 200) 
			{
				 // alert(oReq.responseText);
				var m=1;
				var tbl_menu = JSON.parse(oReq.responseText);
				for (let x in tbl_menu) 
				{
					//class='as_agence-fa fa-solid fa-dashboard'
					idMenu="label_menu_" + m.toString().trim();
					idIcon="menu_icon_" + m.toString().trim();
					idBox="menu_box_" + m.toString().trim();
					document.getElementById(idMenu).innerHTML = tbl_menu[x].message;
					document.getElementById(idIcon).className = "as_agence-fa fa-solid " + tbl_menu[x].icon;
					document.getElementById(idBox).setAttribute( "onClick", "javascript: " + tbl_menu[x].action_js +";" );
					document.getElementById(idBox).style.display="block";
					m++;
				}
				// Active le menu 1 par défaut
				document.getElementById('menu_box_1').click();				
			}
		};
		oReq.send(data);
	}
	function disconnect()
	{
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/disconnect.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.location.href="login.php";
			}
			
		};
		oReq.send(data);
	}
function send_new_password()
	{
		var email=document.getElementById('email').value;;
		//email=prompt("Please, enter you email to receive a new password.");
		if(email!="")
		{
			var data = new FormData();
			var oReq = new XMLHttpRequest() ;
			var url= "includes/send_new_pwd.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				if (this.readyState == 4 && this.status == 200) 
				{	
					//alert ( oReq.responseText)		;		
					// Affichage de succès de lenvoie
					document.getElementById('forgot_password').innerHTML = oReq.responseText;
				}
			};
			data.append('email', email);
			// Envoi l'email
			oReq.send(data);
		}
		else{
			document.getElementById('error-group').innerHTML="<p> Please enter a valid Email</p>";
		}
	}