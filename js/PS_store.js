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
function openPopup() {
    document.getElementById("popup").style.display = "block";
}

function closePopup() {
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


