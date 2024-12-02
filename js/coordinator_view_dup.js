$(document).ready(function(){
	 $('#add-user-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('AddUser.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
     $('#Ticket-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('coordinator_ticketing.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
	$('#dayoff-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('coordinator_dayoff.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
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
			$('.btn-delete').click(function(e) {
            e.preventDefault();
            loadPage('AskDelete.php');
            });
            $('.OrderHis-btn').click(function(e) {
            e.preventDefault();
            loadPage('coordinator_orderhistory.php');
            });

        });
    }

    function reattachEventHandlers(page) {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const rows = document.querySelectorAll('.main-row');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
    // Remove active class from all buttons
    filterButtons.forEach(btn => btn.classList.remove('active'));
    // Add active class to the clicked button
    this.classList.add('active');
    
    const status = this.getAttribute('data-status');
    let columnSelector;

    // Determine the column selector based on the loaded page
    if (page === 'coordinator_dashboard.php') {
        columnSelector = 'td:nth-child(14)';
    } else if (page === 'coordinator_store.php') {
        columnSelector = 'td:nth-child(4)';
    } else if (page === 'coordinator_ticketing.php') {
        columnSelector = 'td:nth-child(8)';
    } else if (page === 'coordinator_invoicing.php') {
        // For 'coordinator_invoicing.php', handle the display of different tables
        const uninvoicedTab = document.getElementById('uninvoiced_tab');
        const invoicedTab = document.getElementById('invoiced_tab');
        const paidTab = document.getElementById('paid_tab');
        const commissionTab = document.getElementById('commission_tab');
        const invoiceBTNS = document.querySelectorAll('#btns_invoice'); // Assuming buttons inside this element

        // Hide all tables initially
        uninvoicedTab.style.display = 'none';
        invoicedTab.style.display = 'none';
        paidTab.style.display = 'none';
        commissionTab.style.display = 'none';

        // Display the correct table based on the status
        if (status === 'uninvoiced') {
            uninvoicedTab.style.display = 'table'; // Or 'block' if needed
            invoiceBTNS.forEach(btn => {
                btn.style.display = '';  // Show buttons
            });
        } else if (status === 'invoiced') {
            invoicedTab.style.display = 'table';
            invoiceBTNS.forEach(btn => {
                btn.style.display = 'none';  // Hide buttons
            });
        } else if (status === 'paid') {
            paidTab.style.display = 'table';
            invoiceBTNS.forEach(btn => {
                btn.style.display = 'none';  // Hide buttons
            });
        } else if (status === 'commission') {
            commissionTab.style.display = 'table';
            invoiceBTNS.forEach(btn => {
                btn.style.display = 'none';  // Hide buttons
            });
        } else if (status === 'informations') {
            // Hide all tables and buttons for 'informations'
            invoiceBTNS.forEach(btn => {
                btn.style.display = 'none';
            });
        }
        
        // Return early to avoid executing the row filtering logic for this page
        return;
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
        if (page === 'coordinator_dashboard.php') {
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
		else if (page === 'coordinator_store.php') {
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


	
});



