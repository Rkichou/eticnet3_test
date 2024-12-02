$(document).ready(function(){
	 $('#add-user-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('AddUser.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
     $('#Ticket-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('printshop_ticketing.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
	$('#dayoff-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('printshop_dayoff.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
    function loadPage(page) {
        $('#dashboard-content').load(page, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Sorry but there was an error: ";
                $("#dashboard-content").html(msg + xhr.status + " " + xhr.statusText);
            } else {
                // Re-attach event handlers here if necessary
                reattachEventHandlers(page);
            }
			$('.cart-btn').click(function(e) {
            e.preventDefault();
            loadPage('PS_cart.php');
            });
		  $('.back-link').click(function(e) { 
            e.preventDefault();
            loadPage('PS_Store.php');
          });
		  $('.place-order-btn').click(function(e) {
            e.preventDefault();
            loadPage('OrdSuc.php');
            });
			$('.btn-delete').click(function(e) {
            e.preventDefault();
            loadPage('AskDelete.php');
            });
            $('.OrderHis-btn').click(function(e) {
            e.preventDefault();
            loadPage('printshop_orderhistory.php');
            });
			$('.Next-btn').click(function(e) {
            e.preventDefault();
            loadPage('printshop_next.php');
            });
        });
    }

    function reattachEventHandlers(page) {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const rows = document.querySelectorAll('.main-row');
        const orderSummaryBtn = document.querySelector('.order-summary-btn'); // Sélectionnez le bouton
    const sitesSelect = document.querySelector('.sites-select'); 
	const BtnInprod = document.querySelector('.btn-InProd'); 
	const BtnQuaCont = document.querySelector('.btn-QuaCont'); 
	const BtnShipp = document.querySelector('.btn-Shipp');
    //bouton dans tabbleau
    const BtnInProd2 = document.querySelectorAll('.btn-InProd2');
	const BtnQuaCont2 = document.querySelectorAll('.btn-QuaCont2');
	const BtnShipp2 = document.querySelectorAll('.btn-Shipp2');
	const BtnShipped = document.querySelectorAll('.btn-Shipped');
	const Btncomment = document.querySelectorAll('.btn-comment');
	
	const BtnIdSt = document.querySelectorAll('.btn-IdSt');
	const BtnIdSt2 = document.querySelectorAll('.btn-IdSt2');
	//pour les colonnes 
	const statutCells = document.querySelectorAll('.StatutRow'); // Sélectionner les cellules de la colonne à masquer
	const ProdCells = document.querySelectorAll('.ProdRow');
	const TimRemCells = document.querySelectorAll('.TimRemRow');
	const DatFiniCells = document.querySelectorAll('.DatFiniRow');
	const TrakNumCells = document.querySelectorAll('.TrakNumRow');
	
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to the clicked button
                this.classList.add('active');
                
                const status = this.getAttribute('data-status');
                let columnSelector;
                
                // Determine the column selector based on the loaded page
                if (page === 'printshop_dashboard.php') {
                    columnSelector = 'td:nth-child(13)';
                } else if (page === 'printshop_store.php') {
                    columnSelector = 'td:nth-child(4)';
                } else if (page === 'printshop_ticketing.php') {
                    columnSelector = 'td:nth-child(8)';
                }
                
                // Show or hide rows based on the status
                rows.forEach(row => {
                    const rowStatus = row.querySelector(columnSelector).textContent.trim();
                    if (status === 'all' || rowStatus === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
				if (page === 'printshop_dashboard.php') {
                    // Afficher ou masquer le bouton "Order state summary" en fonction du statut
            if (!(status === 'all' || status === 'New order')) {
                sitesSelect.style.display = 'none'; 
				orderSummaryBtn.style.display = 'none';
				if (status === 'In production') {
                BtnInprod.style.display = 'inline-block'; 
				BtnQuaCont.style.display = 'none';
				BtnShipp.style.display = 'none';
				BtnInProd2.forEach(btn => {
                      btn.style.display = 'none';});
				Btncomment.forEach(btn => {
                      btn.style.display = 'inline-block';});
				BtnIdSt.forEach(btn => {
                      btn.style.display = 'inline-block';});
                // Masquer les cellules de la colonne avec la classe .StatutRow
                statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
                DatFiniCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TrakNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				}
				else if (status === 'Quality control') {
                BtnQuaCont.style.display = 'inline-block'; 
				BtnShipp.style.display = 'none';
				BtnInprod.style.display = 'none';
				BtnQuaCont2.forEach(btn => {
                      btn.style.display = 'none';});
				Btncomment.forEach(btn => {
                      btn.style.display = 'inline-block';});
				statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });		
                ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
                DatFiniCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TrakNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				}
				else if (status === 'Ready for shipping') {
                BtnShipp.style.display = 'inline-block'; 
				BtnInprod.style.display = 'none';
				BtnQuaCont.style.display = 'none';
				BtnShipp2.forEach(btn => {
                      btn.style.display = 'none';});
				Btncomment.forEach(btn => {
                      btn.style.display = 'inline-block';});
				BtnIdSt2.forEach(btn => {
                      btn.style.display = 'inline-block';});
                 statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
                ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });	
                DatFiniCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TrakNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				}
				else if (status === 'Shipped') {
                BtnInprod.style.display = 'none';
				BtnQuaCont.style.display = 'none';
				BtnShipp.style.display = 'none';
				
				BtnShipped.forEach(btn => {
                      btn.style.display = 'none';});
				
				Btncomment.forEach(btn => {
                      btn.style.display = 'none';});  
				statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
                ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
                TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });		
                DatFiniCells.forEach(cell => {
                    cell.style.display = '';
                });
                TrakNumCells.forEach(cell => {
                    cell.style.display = '';
                });				
				}
				else if (status === 'Canceled'){
					BtnInprod.style.display = 'none';
				    BtnQuaCont.style.display = 'none';
				    BtnShipp.style.display = 'none';
					Btncomment.forEach(btn => {
                      btn.style.display = 'inline-block';});
				statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
                  ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DatFiniCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TrakNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				}
            } else {                
				orderSummaryBtn.style.display = 'inline-block'; // Afficher le bouton
				sitesSelect.style.display = 'inline-block';
				BtnInprod.style.display = 'none';
				BtnQuaCont.style.display = 'none';
				BtnShipp.style.display = 'none';
				BtnInProd2.forEach(btn => {
                      btn.style.display = 'inline-block';});
				BtnQuaCont2.forEach(btn => {
                      btn.style.display = 'inline-block';});
				BtnShipp2.forEach(btn => {
                      btn.style.display = 'inline-block';});
				BtnShipped.forEach(btn => {
                      btn.style.display = 'inline-block';});
				
				Btncomment.forEach(btn => {
                      btn.style.display = 'inline-block';});
				
				BtnIdSt.forEach(btn => {
                      btn.style.display = 'none';});
				BtnIdSt2.forEach(btn => {
                      btn.style.display = 'none';});	  
				DatFiniCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TrakNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				if (status === 'all'){
					ProdCells.forEach(cell => {
                    cell.style.display = '';
                });
				statutCells.forEach(cell => {
                    cell.style.display = '';
                });		
				
				} else if (status === 'New order'){
				statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });		
				}
              }
					  
			
                }
            });
        });
        
        // Other event handlers for the dashboard
        document.querySelectorAll('.sortable').forEach(header => {
            header.addEventListener('click', function() {
                // Sort logic
                alert('Sort column: ' + this.textContent);
            });
        });

        // Event handlers specific to readytoprint.php
        if (page === 'printshop_dashboard.php') {
			   var popup = document.getElementById("popup-advanced-search");
               var openBtn = document.getElementById("btn-open-popup");

              openBtn.addEventListener("click", function() {
               popup.style.display = "block";
              });

               function closePopup() {
                popup.style.display = "none";
            }

               document.querySelector('.popup-close').addEventListener('click', closePopup);

             window.onclick = function(event) {
                 if (event.target == popup) {
                    closePopup();
                 }
               };
        }
		else if (page === 'printshop_store.php') {
			   var popup = document.getElementById("popup-advanced-search");
               var openBtn = document.getElementById("btn-open-popup");

              openBtn.addEventListener("click", function() {
               popup.style.display = "block";
              });

               function closePopup() {
                popup.style.display = "none";
            }

               document.querySelector('.popup-close').addEventListener('click', closePopup);

             window.onclick = function(event) {
                 if (event.target == popup) {
                    closePopup();
                 }
               };
        }
		else if (page === 'printshop_ticketing.php') {
			   var popup = document.getElementById("NewTick");
               var openBtn = document.getElementById("NewTick-btn");

              openBtn.addEventListener("click", function() {
               popup.style.display = "flex";
              });

               function closePopup() {
                popup.style.display = "none";
            }

               document.querySelector('.closeTick-btn').addEventListener('click', closePopup);

        }
    }

    $('.navbar-link').click(function(e){
        e.preventDefault();

        // Remove active class from all links
        $('.navbar-link').removeClass('active');
        
        // Add active class to the clicked link
        $(this).addClass('active');

        // Load the page into the dashboard-content div
        //var page = $(this).data('page');
        //loadPage(page);
		
    });

    // Initial event handler attachment for the initially loaded content 
    reattachEventHandlers('printshop_dashboard.php');

    document.querySelector('.admin-view-btn').addEventListener('click', function() {
        const menu = document.querySelector('.dropdown-menu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            
        }
    });
	
	
});

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

	//
	function display_printshop_order_statut()
	{
		var tmpBAT=document.getElementById('isBATOK').value;
		var TBL_BAT=tmpBAT.split('|');
		// alert(tmpBAT);
		
		for(i=0;i<=TBL_BAT.length-2;i++)
		{
			// alert(TBL_BAT[i]);
			var TBL_BAT_2=TBL_BAT[i].split('~');
			if(TBL_BAT_2[1]*1==0)
			{
				// alert(TBL_BAT_2[0]);
				var tmpID='statut_bat_' + TBL_BAT_2[0];
				document.getElementById(tmpID).innerHTML='Waiting for BAT validation';
				var tmpID2='ligne_table_' + TBL_BAT_2[0];
				document.getElementById(tmpID2).src='/images/details_orange.png';
				var tmpID3='button_begin_production_' + TBL_BAT_2[0];
				document.getElementById(tmpID3).disabled=true
				document.getElementById(tmpID3).style.backgroundColor='#eeeeee';
				document.getElementById(tmpID3).style.color='#800000';
			}
		}
		
	}
	
	function set_contractor_printshop() {
		var contractor = document.getElementById("contractors").value;
		
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/set_contractor_printshop.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				// alert(oReq.responseText);
				//init_container_right();
				printshop_dashboard() // Retourne sur le dashboard
			}
		};
		data.append('prefix_contractor', contractor);
		// Poste les datas
		oReq.send(data);
	}

    function exportFile() {
        var dateFrom = document.getElementById('dateFrom').value;
		var dateTo = document.getElementById('dateTo').value;
		var output = document.querySelector('.content');
        var error=document.getElementById('errorMessage');
		var status = document.getElementById("status").value;
		if(status=='completed'){
			statut='7';
		}
		else if(status=='pending'){
			statut='4,5,6';
		}
		else if(status=='cancelled'){
			statut='0';
		}
		else{
			error.innerHTML = "<p > Please select a status</p>";
		}
        if ((dateFrom!=="") && (dateTo!=="")) {
			// Afficher le message de chargement
			document.getElementById('loadingMessage').style.display = 'block';	
			// Effacer l'historique des précédentes intégrations
			output.innerHTML = "";	
            error.innerHTML="";	
            var formData = new FormData();
            
            formData.append('dateFrom', dateFrom);
			formData.append('dateTo', dateTo);
			formData.append('status', statut);
            var xhr = new XMLHttpRequest();
			var $dossier="includes/file_export.php";
            xhr.open('POST', $dossier, true);
            xhr.onload = function(event) 
			{				
            	
                if (xhr.status == 200 && xhr.responseText != 'error') {

                    output.innerHTML = "<p> " + xhr.responseText + "</p>";
                } else {
                    output.innerHTML = "<p style='color: red;'>Error occurred when trying to export your file.</p>";
                }
				// Masquer le message de chargement une fois la réponse reçue
				document.getElementById('loadingMessage').style.display = 'none';                
            };

            xhr.send(formData);
        } 
		else {
            error.innerHTML += "<p > Please select a date</p>";
        }
    }


function printshop_dashboard()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "printshop_dashboard.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{				  
				//init_container();
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;				
			}
		};
		oReq.send(data);
}
function printshop_store()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "printshop_store.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{				  
				//init_container();
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;				
			}
		};
		oReq.send(data);
}
function printshop_dictionnary()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "printshop_dictionary.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{				  
				//init_container();
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;				
			}
		};
		oReq.send(data);
}
function printshop_excelexport()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "printshop_excelexport.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{				  
				//init_container();
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;				
			}
		};
		oReq.send(data);
}
function set_contractor_dictionnary() {
		var contractor = document.getElementById("contractors").value;
		if(contractor!="Company name"){
            document.getElementById("btn_dictionary").disabled=false;
			var data = new FormData();
			var oReq = new XMLHttpRequest();
			var url= "includes/set_contractor_printshop.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					document.getElementById("popupSelect").classList.add('inactive');;
				    
					printshop_dictionnary() // Retourne sur le dashboard
				}
			};
			data.append('prefix_contractor', contractor);
			// Poste les datas
			oReq.send(data);
		}
		else{
			document.getElementById("btn_dictionary").disabled=true;
		}
	}
function enable_button(){
    var contractor = document.getElementById("contractors").value;
	if(contractor!="Company name"){
        document.getElementById("btn_dictionary").disabled=false;
    }
	else{
		document.getElementById("btn_dictionary").disabled=true;
	}
}
function printshop_upload_rtp() 
	    {
		// Utilisé pour l'import des OFs
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "printshop_upload_rtp.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;
			}
		};
		//data.append('prefix_contractor', prefix_contractor);
		oReq.send(data);
	}
function uploadBatsFile(){
    var contractor = document.getElementById('contractor').value;
	var zipfile = document.getElementById('zipfile').files[0]; // Obtenez le fichier à partir de l'input

	if (!zipfile) {
		alert('Please select a zip file');
		return;
	}
    if (zipfile.type !== "application/zip" && zipfile.name.slice(-4).toLowerCase() !== ".zip") {
        alert('Please upload a valid zip file');
        return;
    }

    var formData = new FormData();
    formData.append('file', zipfile);
    formData.append('contractor', contractor);

    var xhr = new XMLHttpRequest();
    var dossier = "integrations/integrations_bats_2024.php";

    xhr.open('POST', dossier, true);

    xhr.onload = function(event) {
        var output = document.querySelector('.file-content');
        // Effacer l'historique des précédentes intégrations
        output.innerHTML = "";

        if (xhr.status === 200) {
            if (xhr.responseText !== 'error') {
                output.innerHTML = "<p>" + xhr.responseText + "</p>";
            } else {
                output.innerHTML = "<p style='color: red;'>An error occurred during the integration process.</p>";
            }
        } else {
            output.innerHTML = "<p style='color: red;'>Error occurred when trying to upload your file. Server responded with status: " + xhr.status + "</p>";
        }
    };

    // Gestion des erreurs réseau
    xhr.onerror = function() {
        var output = document.querySelector('.file-content');
        output.innerHTML = "<p style='color: red;'>Network error occurred. Please try again later.</p>";
    };

    xhr.send(formData);

    // Réinitialiser le champ de sélection de fichier après envoi
    document.getElementById('zipfile').value = null;
    document.getElementById("drag_upload_file").classList.remove("uploaded");
}