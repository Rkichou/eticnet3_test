document.addEventListener('DOMContentLoaded', function() {
                    const filterButtons = document.querySelectorAll('.filter-btn');
                    const rows = document.querySelectorAll('.main-row');
                    
                    filterButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            // Remove active class from all buttons
                            filterButtons.forEach(btn => btn.classList.remove('active'));
                            // Add active class to the clicked button
                            this.classList.add('active');
                            
                            const status = this.getAttribute('data-status');
                            
                            // Show or hide rows based on the status
                            rows.forEach(row => {
                                const rowStatus = row.querySelector('td:nth-child(2)').textContent.trim();
                                if (status === 'all' || rowStatus === status) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        });
                    });
                });

//pour popup comment
document.addEventListener('DOMContentLoaded', (event) => {
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
    });          
	
//pour RTP visualisation
        document.querySelectorAll('.btn-rtp').forEach(button => {
            button.addEventListener('click', function() {
                var modal = document.getElementById("imageModal");
                var img = document.getElementById("modalImage");
                img.src = this.getAttribute('data-img');
                modal.style.display = "block";
            });
        });

        document.querySelectorAll(".close-btn").forEach(button => {
            button.addEventListener('click', function() {
                var modal = this.closest(".modal");
                modal.style.display = "none";
            });
        });

        window.onclick = function(event) {
            var modal = document.getElementById("imageModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.getElementById('downloadBtn').addEventListener('click', function() {
            var img = document.getElementById("modalImage");
            var link = document.createElement('a');
            link.href = img.src;
            link.download = 'RTP.png'; 
            link.click();
        });

        

        // JavaScript pour gérer l'affichage de la popup
         /*const btnOpenPopup = document.getElementById('btn-open-popup');
        const btnClosePopup = document.getElementById('btn-close-popup');
        const popup = document.getElementById('popup-advanced-search');

        btnOpenPopup.addEventListener('click', () => {
            popup.style.display = 'block';
        });

        btnClosePopup.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        // Fermer la popup si l'utilisateur clique en dehors de celle-ci
        window.addEventListener('click', (event) => {
            if (event.target == popup) {
                popup.style.display = 'none';
            }
        });
  */

