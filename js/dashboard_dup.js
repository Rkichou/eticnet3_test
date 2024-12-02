//pour les bouton + et - 
function toggleDetails(element) {
    const detailsRow = element.closest('tr').nextElementSibling;
    const img = element.querySelector('img'); // Récupérer l'image à l'intérieur du bouton
    const button = element.querySelector('button.icon'); // Récupérer le bouton d'icône dans la ligne

    if (detailsRow.style.display === "none" || !detailsRow.style.display) {
        // Afficher les détails et changer l'image à "OfRouge.png"
        detailsRow.style.display = "table-row";
        img.src = "Image/OfRouge.png"; // Change l'image pour une icône rouge
        button.classList.remove('btn-green');
        button.classList.add('btn-red');
    } else {
        // Masquer les détails et changer l'image à "OfOrange.png"
        detailsRow.style.display = "none";
        img.src = "Image/OfOrange.png"; // Change l'image pour une icône orange
        button.classList.remove('btn-red');
        button.classList.add('btn-orange');
    }
}
//^pour le bouton < : affichage sous tableau 
		document.querySelectorAll('.details-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function() {
        var table = this.closest('.details-content').nextElementSibling;
        var icon = this;

        if (table.style.display === 'none') {
            table.style.display = 'table';
            icon.classList.remove('fa-angle-up');
            icon.classList.add('fa-angle-down');
        } else {
            table.style.display = 'none';
            icon.classList.remove('fa-angle-down');
            icon.classList.add('fa-angle-up');
        }
    });
});
   
//pour le filtrage
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
                const rowStatus = row.querySelector('td:last-child').textContent.trim();
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
});

//pour le popup adresse

document.querySelectorAll('.info-btn').forEach(button => {
    button.addEventListener('mouseover', function() {
        const popupId = this.getAttribute('data-popup');
        document.getElementById(popupId).style.display = 'block';
    });

    button.addEventListener('mouseout', function() {
        const popupId = this.getAttribute('data-popup');
        document.getElementById(popupId).style.display = 'none';
    });
});
//pour le popup info
document.addEventListener("DOMContentLoaded", function() {
    const infoButton = document.querySelector(".info-button");
    const popup = document.querySelector(".popupp");

    infoButton.addEventListener("mouseover", function() {
        popup.style.display = "block";
    });

    infoButton.addEventListener("mouseout", function() {
        popup.style.display = "none";
    });
});




// Fonction pour ouvrir un popup en fonction de l'id
function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex'; // Utiliser 'flex' pour centrer
}

// Fonction pour fermer tous les popups
function closeAllPopups() {
    const popups = document.querySelectorAll('.popupS-container');
    popups.forEach(popup => popup.style.display = 'none');
}

// Ajouter des écouteurs d'événements aux boutons
document.querySelectorAll('.add-user-btn').forEach(button => {
    button.addEventListener('click', () => openPopup('createUserPopupS'));
});

document.querySelectorAll('.btn-fact-user').forEach(button => {
    button.addEventListener('click', () => openPopup('Addfact'));
});

document.querySelectorAll('.btn-edit-user').forEach(button => {
    button.addEventListener('click', () => openPopup('Editfact'));
});

document.querySelectorAll('.btn-edit-contact').forEach(button => {
    button.addEventListener('click', () => openPopup('Editcontact'));
});
document.querySelectorAll('.btn-delete-user').forEach(button => {
    button.addEventListener('click', () => openPopup('deletePopup'));
});
document.querySelectorAll('.btn-delete-contact').forEach(button => {
    button.addEventListener('click', () => openPopup('deletePopup2'));
});
// Fonction pour fermer les popups
function closePopup33() {
    closeAllPopups();
}

// Ajouter l'écouteur d'événement pour les boutons de fermeture
document.querySelectorAll('.closeS-btn').forEach(button => {
    button.addEventListener('click', closePopup33);
});
// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('.btn-cancel').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('deletePopup').style.display = 'none';
		document.getElementById('deletePopup2').style.display = 'none';
    });
});

