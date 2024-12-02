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
    const orderSummaryBtn3 = document.querySelector('.order-summary-btn3'); // Sélectionnez le bouton
	const sitesSelect = document.querySelector('.sites-select2'); 

	//pour les colonnes 
	const tracknumCells = document.querySelectorAll('.tracknumRow');
	const statutCells = document.querySelectorAll('.StatutRow'); // Sélectionner les cellules de la colonne à masquer
	const TimRemCells = document.querySelectorAll('.TimRemRow');
	const actionsCells = document.querySelectorAll('.ActionsRow');
	const addCells = document.querySelectorAll('.AddRow');
	const ProdCells = document.querySelectorAll('.ProdRow');
	const PrintshopCells = document.querySelectorAll('.PrintshopRow');
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
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = '';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				addCells.forEach(cell => {
                    cell.style.display = '';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = '';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
                orderSummaryBtn3.style.display = 'inline-block';				
				
				sitesSelect.style.display = 'inline-block';				
				}
				else if (status === 'Waiting confirmation') {
           	
                TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = '';
                });	
				addCells.forEach(cell => {
                    cell.style.display = '';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
                orderSummaryBtn3.style.display = 'none';				
				
				sitesSelect.style.display = 'none';				
				}
				else if (status === 'Waiting production') {
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				addCells.forEach(cell => {
                    cell.style.display = '';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
                orderSummaryBtn3.style.display = 'none';				
				
				sitesSelect.style.display = 'none';				
				}		
				
				else if (status === 'In production') {
                TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				addCells.forEach(cell => {
                    cell.style.display = '';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
                orderSummaryBtn3.style.display = 'none';				
				
				sitesSelect.style.display = 'none';				
				}		
				
				else if (status === 'Ready for shipping'){
					TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				addCells.forEach(cell => {
                    cell.style.display = '';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
                orderSummaryBtn3.style.display = 'none';				
				
				sitesSelect.style.display = 'none';				
				}		
				
				else if (status === 'Quality control'){
				TimRemCells.forEach(cell => {
                    cell.style.display = '';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				addCells.forEach(cell => {
                    cell.style.display = '';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = '';
                });
                orderSummaryBtn3.style.display = 'none';				
				
				sitesSelect.style.display = 'none';				
				}		
				
             else if (status === 'Shipped'){
				TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = '';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				addCells.forEach(cell => {
                    cell.style.display = '';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                orderSummaryBtn3.style.display = 'none';				
				
				sitesSelect.style.display = 'none';				
				}		
				
				else if (status === 'Canceled'){
				TimRemCells.forEach(cell => {
                    cell.style.display = 'none';
                });
			    statutCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				tracknumCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				actionsCells.forEach(cell => {
                    cell.style.display = 'none';
                });	
				addCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				ProdCells.forEach(cell => {
                    cell.style.display = 'none';
                });
				PrintshopCells.forEach(cell => {
                    cell.style.display = 'none';
                });
                orderSummaryBtn3.style.display = 'none';				
				
				sitesSelect.style.display = 'none';				
				}		
					  
					  
            
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

function openPopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = 'inline-block';
}

function closePopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = "none";
}


function openPopupBP() {
    document.getElementById("productionPopup").style.display = 'inline-block';
}

function closePopupBP() {
    const btn1 = document.querySelector('.popupProd-btn1');
    const btn3 = document.querySelector('.popupProd-btn3');
    
    // Rétablir le bouton "Production order(s)" à son état initial
    btn1.classList.remove('btn-disabled');
    btn1.disabled = false; // Réactiver le bouton

    // Masquer le bouton "Apply"
    btn3.style.display = 'none';

    // Fermer la popup
    const popupContainer = document.querySelector('.popupProd-container');
    popupContainer.style.display = 'none'; // Assurez-vous que cette ligne correspond à la logique de fermeture de votre popup
}
function openPopupCM() {
    document.getElementById("commentPopup").style.display = 'inline-block';
}

function closePopupCM() {
    document.getElementById("commentPopup").style.display = "none";
}
function openPopupPL() {
    document.getElementById("PackingPopup").style.display = 'inline-block';
}

function closePopupPL() {
    const btn1 = document.querySelector('.popupProd-btn4');
    const btn3 = document.querySelector('.popupProd-btn6');
    
    // Rétablir le bouton "Production order(s)" à son état initial
    btn1.classList.remove('btn-disabled');
    btn1.disabled = false; // Réactiver le bouton

    // Masquer le bouton "Apply"
    btn3.style.display = 'none';

    // Fermer la popup
    const popupContainer = document.querySelector('.popupList-container');
    popupContainer.style.display = 'none';
}

function ProdOrd() {
    const btn1 = document.querySelector('.popupProd-btn1');
    const btn3 = document.querySelector('.popupProd-btn3');
    
    // Changer la couleur du bouton en gris
    btn1.classList.add('btn-disabled');
    btn1.disabled = true; // Désactiver le bouton pour empêcher de cliquer à nouveau

    // Afficher le bouton "Apply"
    btn3.style.display = 'inline-block';
}
function PackList() {
    const btn1 = document.querySelector('.popupProd-btn4');
    const btn3 = document.querySelector('.popupProd-btn6');
    
    // Changer la couleur du bouton en gris
    btn1.classList.add('btn-disabled');
    btn1.disabled = true; // Désactiver le bouton pour empêcher de cliquer à nouveau

    // Afficher le bouton "Apply"
    btn3.style.display = 'inline-block';
}

