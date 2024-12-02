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
                if (page === 'PS_Dashboard.php') {
                    columnSelector = 'td:nth-child(13)';
                } else if (page === 'PS_Store.php') {
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
				if (page === 'PS_Dashboard.php') {
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
        if (page === 'PS_Dashboard.php') {
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
		else if (page === 'PS_Store.php') {
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
        var page = $(this).data('page');
        loadPage(page);
		
    });

    // Initial event handler attachment for the initially loaded content 
    reattachEventHandlers('PS_Dashboard.php');

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

