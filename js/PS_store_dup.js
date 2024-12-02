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
                                const rowStatus = row.querySelector('td:nth-child(4)').textContent.trim();
                                if (status === 'all' || rowStatus === status) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                        });
                    });
                });


//Pour poppup plae order
function openPopupAddCart() {
    document.getElementById("popup").style.display = "block";
}

function closePopupAddCart() {
    document.getElementById("popup").style.display = "none";
}
//Pour poppup UP rtp
	function openPopupUP() {
    document.getElementById("popupUP").style.display = "block";
}

function closePopupUP() {
    document.getElementById("popupUP").style.display = "none";
}

//Pour poppup QTY
	function openQTYPopup() {
    document.getElementById("qtyPopup").style.display = "block";
}

function closeQTYPopup() {
    document.getElementById("qtyPopup").style.display = "none";
}
//Pour poppup QTY
	function openPopupEditQty() {
    document.getElementById("qtyPopupEdit").style.display = "block";
}

function closeQTYPopupEdit() {
    document.getElementById("qtyPopupEdit").style.display = "none";
}

function openPopupAVS() {
    document.getElementById("popup-advanced-search").style.display = "block";
}

function closePopupAVS() {
    document.getElementById("popup-advanced-search").style.display = "none";
}
  //popup Select Customer Dictionary
  function closepopupSelect() {
    document.getElementById("popupSelect").style.display = "none";
}
	 
function enterEditMode() {
    const editBtn = document.querySelector('.edit-btn');
    const submitBtn = document.querySelector('.submit-btn');
    const cancelBtn = document.querySelector('.cancel-btn');
    const newMinQtyHeader = document.querySelector('.new-min-qty-header');
    const newMinQtyCells = document.querySelectorAll('.new-min-qty');

    editBtn.style.display = 'none';
    submitBtn.style.display = 'inline-block';
    cancelBtn.style.display = 'inline-block';
    newMinQtyHeader.style.display = 'table-cell';

    newMinQtyCells.forEach(cell => {
        cell.style.display = 'table-cell';
        const input = cell.querySelector('input');
        input.disabled = false;
    });
}

function cancelChanges() {
    const editBtn = document.querySelector('.edit-btn');
    const submitBtn = document.querySelector('.submit-btn');
    const cancelBtn = document.querySelector('.cancel-btn');
    const newMinQtyHeader = document.querySelector('.new-min-qty-header');
    const newMinQtyCells = document.querySelectorAll('.new-min-qty');

    editBtn.style.display = 'inline-block';
    submitBtn.style.display = 'none';
    cancelBtn.style.display = 'none';
    newMinQtyHeader.style.display = 'none';

    newMinQtyCells.forEach(cell => {
        cell.style.display = 'none';
        const input = cell.querySelector('input');
        input.disabled = true;
    });
}

function submitChanges() {
    // Ici, vous pouvez ajouter la logique pour soumettre les changements, comme une requête AJAX.

    // Une fois les changements soumis, vous pouvez revenir à l'état normal.
    cancelChanges();
}


	//Pour poppup Create Prod
	function openPopupAddProd() {
    document.getElementById("popup-add-prod").style.display = "block";
     }

    function closePopupAddProd() {
    document.getElementById("popup-add-prod").style.display = "none";
     }
	 
	 //Pour poppup Edit Prod
	function openPopupEditProd() {
    document.getElementById("popup-Edit-prod").style.display = "block";
     }

    function closePopupEditProd() {
    document.getElementById("popup-Edit-prod").style.display = "none";
     }
	 // Lorsqu'on clique sur le bouton, déclenche le champ de fichier caché
document.getElementById('uploadBtn').addEventListener('click', function() {
    document.getElementById('pdfInput').click();
});
document.getElementById('uploadBtn2').addEventListener('click', function() {
    document.getElementById('pdfInput').click();
});
// Gérer l'événement lorsque le fichier est sélectionné
document.getElementById('pdfInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        // Ici, tu peux ajouter des actions à effectuer avec le fichier PDF
        console.log("Fichier sélectionné : " + file.name);
        // Tu pourrais également uploader le fichier vers un serveur via AJAX
    }
});


// Lorsqu'on clique sur le bouton, déclenche le champ de fichier caché
document.getElementById('uploadImageBtn').addEventListener('click', function() {
    document.getElementById('imageInput').click();
});

// Gérer l'événement lorsque le fichier image est sélectionné
document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        // Vérifier si le fichier est bien une image (PNG ou JPG)
        const validImageTypes = ['image/png', 'image/jpeg'];
        if (validImageTypes.includes(file.type)) {
            // Actions à effectuer avec l'image (par exemple, affichage ou upload)
            console.log("Fichier image sélectionné : " + file.name);
            // Afficher l'image sur la page
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.width = 200;  // Taille de l'image à afficher (optionnel)
                document.body.appendChild(img);
            };
            reader.readAsDataURL(file);
        } else {
            alert("Veuillez sélectionner une image PNG ou JPG.");
        }
    }
});