$(document).ready(function(){
	 $('#add-user-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('admin_AddUser.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
     $('#Ticket-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('admin_ticketing.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
    });
	$('#dayoff-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('admin_dayoff.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
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

            $('.OrderHis-btn').click(function(e) {
            e.preventDefault();
            loadPage('admin_orderhistory.php');
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

      if (page === 'admin_articles.php') {
        columnSelector = 'td:nth-child(4)';
    } else if (page === 'admin_ticket.php') {
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
       if (page === 'admin_articles.php') {
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
		else if (page === 'admin_ticket.php') {
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



