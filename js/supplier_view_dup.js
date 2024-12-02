$(document).ready(function(){
	 $('#setting-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('supplier_setting.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
     $('#Ticket-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('supplier_ticketing.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
	$('#dayoff-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('supplier_dayoff.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
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
            loadPage('supplier_cart.php');
            });
		  $('.back-link').click(function(e) { 
            e.preventDefault();
            loadPage('supplier_store.php');
          });
		  $('.place-order-btn').click(function(e) {
            e.preventDefault();
            loadPage('supplier_order_succes.php');
            });
			$('.btn-delete').click(function(e) {
            e.preventDefault();
            loadPage('AskDelete.php');
            });
            $('.OrderHis-btn').click(function(e) {
            e.preventDefault();
            loadPage('supplier_orderhistory.php');
            });
			$('.Next-btn').click(function(e) {
            e.preventDefault();
            loadPage('supplier_next.php');
            });
        });
    }
    
    
    function reattachEventHandlers(page) {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const rows = document.querySelectorAll('.main-row');
        const orderSummaryBtn = document.querySelector('.order-summary-btn2'); // Sélectionnez le bouton

    //bouton dans tabbleau

	const Btncomment = document.querySelectorAll('.btn-comment');
	

	//pour les colonnes 
	const statutCells = document.querySelectorAll('.StatutRow'); // Sélectionner les cellules de la colonne à masquer
	const ProdCells = document.querySelectorAll('.ProdRow');
	const TimRemCells = document.querySelectorAll('.TimRemRow');
	const DatFiniCells = document.querySelectorAll('.DatFiniRow');
	const TrakNumCells = document.querySelectorAll('.TrakNumRow');
	const viewButtons = document.querySelectorAll('.orderview-btn, .supplierview-btn');
	     
		 viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Supprimer la classe active de tous les boutons
            viewButtons.forEach(btn => btn.classList.remove('active'));
            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');
        });
       });
		 
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to the clicked button
                this.classList.add('active');
                
                const status = this.getAttribute('data-status');
                let columnSelector;
                
                // Determine the column selector based on the loaded page
                if (page === 'supplier_dashboard.php') {
                    columnSelector = 'td:nth-child(10)';
                }  else if (page === 'supplier_store.php') {
                    columnSelector = 'td:nth-child(4)';
                } else if (page === 'supplier_ticketing.php') {
                    columnSelector = 'td:nth-child(7)';
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
				if (page === 'supplier_dashboard.php') {
                    // Afficher ou masquer le bouton "Order state summary" en fonction du statut
            if (!(status === 'all' || status === 'New order')) {
				orderSummaryBtn.style.display = 'none';
				if (status === 'In production') {
                
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
       if (page === 'supplier_dashboard.php') {
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
		else if (page === 'supplier_store.php') {
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
		else if (page === 'PS_Ticketing.php') {
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
    reattachEventHandlers('supplier_dashboard.php');

    document.querySelector('.admin-view-btn').addEventListener('click', function() {
        const menu = document.querySelector('.dropdown-menu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            
        }
    });
	
	
});



