$(document).ready(function(){
	 $('#add-user-link').click(function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
		$('.navbar-link').removeClass('active');
        loadPage('AddUser.php'); // Charge la page AddUser.php dans le contenu du tableau de bord
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
            loadPage('cart.php');
            });
		  $('.back-link').click(function(e) { 
            e.preventDefault();
            loadPage('store.php');
          });
		  $('.place-order-btn').click(function(e) {
            e.preventDefault();
            loadPage('OrdSuc.php');
            });
			$('.btn-delete').click(function(e) {
            e.preventDefault();
            loadPage('AskDelete.php');
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
                if (page === 'Dashboard.php') {
                    columnSelector = 'td:last-child';
                } else if (page === 'readytoprint.php') {
                    columnSelector = 'td:nth-child(2)';
                } else if (page === 'store.php') {
                    columnSelector = 'td:nth-child(4)';
                } else if (page === 'ticketing.php') {
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
        if (page === 'readytoprint.php') {
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
			
            var modal = document.getElementById("commentModal");
            var closeBtn = document.getElementsByClassName("close-btn")[0];

            document.querySelectorAll('.btn-comment').forEach(button => {
                button.addEventListener('click', () => {
                    modal.style.display = "block";
                });
            });

            closeBtn.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
		else if (page === 'Dashboard.php') {
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
		else if (page === 'ticketing.php') {
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
    reattachEventHandlers('Dashboard.php');

    document.querySelector('.admin-view-btn').addEventListener('click', function() {
        const menu = document.querySelector('.dropdown-menu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            
        }
    });
	
	
});



