//pour les bouton + et - 
         function toggleDetails(element) {
            const detailsRow = element.closest('tr').nextElementSibling;
            if (detailsRow.style.display === "none" || !detailsRow.style.display) {
                detailsRow.style.display = "table-row";
                element.innerText = "-";
                element.classList.remove('btn-green');
                element.classList.add('btn-red');
            } else {
                detailsRow.style.display = "none";
                element.innerText = "+";
                element.classList.remove('btn-red');
                element.classList.add('btn-orange');
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
            // Supprimer la classe active de tous les boutons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');
            
            const status = this.getAttribute('data-status');
            
            // Afficher ou masquer les lignes en fonction du statut
            rows.forEach(row => {
                const rowStatus = row.querySelector('td:nth-child(11)').textContent.trim();
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            
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

