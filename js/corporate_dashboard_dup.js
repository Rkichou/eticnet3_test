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
            icon.classList.remove('fa-angle-down');
            icon.classList.add('fa-angle-up');
        } else {
            table.style.display = 'none';
            icon.classList.remove('fa-angle-up');
            icon.classList.add('fa-angle-down');
        }
    });
});
  
//pour le filtrage
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const rows = document.querySelectorAll('.main-row');
    const orderSummaryBtn = document.querySelector('.order-summary-btn2'); // Sélectionnez le bouton
	//pour les colonnes 
	const DateOrderCells = document.querySelectorAll('.DateOrderRow'); // Sélectionner les cellules de la colonne à masquer
	const DateCancelCells = document.querySelectorAll('.DateCancelRow');
	const ShippingDateCells = document.querySelectorAll('.ShippingDateRow');
	const TrackNumCells = document.querySelectorAll('.TrackNumRow');
	const DateCells = document.querySelectorAll('.DateRow');
    const StateCells = document.querySelectorAll('.StateRow');	
	const TimRemCells = document.querySelectorAll('.TimRemRow');
	const Addells = document.querySelectorAll('.AddRow');
	const StatutCells = document.querySelectorAll('.StatutRow');
	const PrintshopCells = document.querySelectorAll('.PrintshopRow');
	const PriorityCells = document.querySelectorAll('.PriorityRow');	
	const ActionsCells = document.querySelectorAll('.ActionsRow');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Supprimer la classe active de tous les boutons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');
            
            const status = this.getAttribute('data-status');
            
            // Afficher ou masquer les lignes en fonction du statut
            rows.forEach(row => {
                const rowStatus = row.querySelector('td:nth-child(14)').textContent.trim();
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Afficher ou masquer le bouton "Order state summary" en fonction du statut
            if (status === 'all') {
                DateOrderCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DateCells.forEach(cell => {
                    cell.style.display = '';
                });
				StateCells.forEach(cell => {
                    cell.style.display = '';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
				Addells.forEach(cell => {
                    cell.style.display = '';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = '';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ActionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			   }
				else if (status === 'Waiting confirmation') {
           	
                DateOrderCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DateCells.forEach(cell => {
                    cell.style.display = '';
                });
				StateCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				Addells.forEach(cell => {
                    cell.style.display = '';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = '';
                });				
				ActionsCells.forEach(cell => {
                    cell.style.display = '';
                }); }
				else if (status === 'Waiting production') {
           	
                DateOrderCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DateCells.forEach(cell => {
                    cell.style.display = '';
                });
				StateCells.forEach(cell => {
                    cell.style.display = '';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
				Addells.forEach(cell => {
                    cell.style.display = '';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = '';
                });				
				ActionsCells.forEach(cell => {
                    cell.style.display = 'none';
                }); }
				
				else if (status === 'In production') {
           	
                DateOrderCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DateCells.forEach(cell => {
                    cell.style.display = '';
                });
				StateCells.forEach(cell => {
                    cell.style.display = '';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
				Addells.forEach(cell => {
                    cell.style.display = '';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				ActionsCells.forEach(cell => {
                    cell.style.display = 'none';
                }); }
				else if (status === 'Quality control'){
           	
                DateOrderCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DateCells.forEach(cell => {
                    cell.style.display = '';
                });
				StateCells.forEach(cell => {
                    cell.style.display = '';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
				Addells.forEach(cell => {
                    cell.style.display = '';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				ActionsCells.forEach(cell => {
                    cell.style.display = 'none';
                }); }
				else if (status === 'Ready for shipping'){
           	
                DateOrderCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DateCells.forEach(cell => {
                    cell.style.display = '';
                });
				StateCells.forEach(cell => {
                    cell.style.display = '';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
				Addells.forEach(cell => {
                    cell.style.display = '';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				ActionsCells.forEach(cell => {
                    cell.style.display = 'none';
                }); }
				
             else if (status === 'Shipped'){
           	
                DateOrderCells.forEach(cell => {
                    cell.style.display = '';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = '';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = '';
                });
				DateCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				StateCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				Addells.forEach(cell => {
                    cell.style.display = '';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				ActionsCells.forEach(cell => {
                    cell.style.display = 'none';
                }); }
				else if (status === 'Canceled'){
           	
                DateOrderCells.forEach(cell => {
                    cell.style.display = '';
                });
			    DateCancelCells.forEach(cell => {
                    cell.style.display = '';
                });
				ShippingDateCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				TrackNumCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				DateCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				StateCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				Addells.forEach(cell => {
                    cell.style.display = 'none';
                });
				StatutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
				PriorityCells.forEach(cell => {
                    cell.style.display = 'none';
                });				
				ActionsCells.forEach(cell => {
                    cell.style.display = 'none';
                }); }
					  
            
        });
    });
});

function openPopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = 'inline-block';
}

function closePopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = "none";
}

function openPopupRtpValid() {
    //onsole.log('Popup ouvert');
    document.getElementById('popup-overlay').style.display = 'flex';
}
function closePopupRtpValid() {
    //console.log('Popup fermée'); // Pour tester si la fonction est bien appelée
    document.getElementById('popup-overlay').style.display = 'none'; // Cache la popup
}

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



