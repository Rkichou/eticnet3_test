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
  

function changeBackgroundColor(button) {
    button.style.backgroundColor = "gray";
}
// Fonction pour ouvrir la popup
function openPopupAdUser() {
    document.getElementById("userPopup").style.display = "flex";
}

// Fonction pour fermer la popup
function closePopupAdUser() {
    document.getElementById("userPopup").style.display = "none";
}

function openPopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = 'inline-block';
}

function closePopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = "none";
}


// Fonction pour ouvrir un popup en fonction de l'id
function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex'; // Utiliser 'flex' pour centrer
}



document.querySelectorAll('#DeleteUser').forEach(button => {
    button.addEventListener('click', () => openPopup('deleteuser'));
});
document.querySelectorAll('#DeleteContact').forEach(button => {
    button.addEventListener('click', () => openPopup('deletecontact'));
});
document.querySelectorAll('#DeleteAdress').forEach(button => {
    button.addEventListener('click', () => openPopup('deleteadress'));
});
// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('.btn-cancel').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('deleteuser').style.display = 'none';
		document.getElementById('deletecontact').style.display = 'none';
		document.getElementById('deleteadress').style.display = 'none';
    });
});

document.querySelectorAll('#EditUser').forEach(button => {
    button.addEventListener('click', () => openPopup('userEditPopup'));
});

// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('.closeAdUser-btn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('userEditPopup').style.display = 'none';
    });
});

document.querySelectorAll('#add_currency_1').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectCurr_add'));
});
document.querySelectorAll('#add_contractor_1').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectCon_add'));
});
document.querySelectorAll('#add_serv_1').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectServ_add'));
});
document.querySelectorAll('#add_currency_2').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectCurr'));
});
document.querySelectorAll('#add_contractor_2').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectCon'));
});
document.querySelectorAll('#add_serv_2').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectServ'));
});
document.querySelectorAll('#add_currency_3').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectCurr'));
});
document.querySelectorAll('#add_contractor_3').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectCon'));
});
document.querySelectorAll('#add_serv_3').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSelectServ'));
});
document.querySelectorAll('#swapview').forEach(button => {
    button.addEventListener('click', () => openPopup('popupSwapView'));
});

// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('.popup-close2').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('popupSelectCurr').style.display = 'none';
		document.getElementById('popupSelectCon').style.display = 'none';
		document.getElementById('popupSelectServ').style.display = 'none';
		document.getElementById('popupSwapView').style.display = 'none';
    });
});


document.querySelectorAll('#AddContact').forEach(button => {
    button.addEventListener('click', () => openPopup('Addcontact'));
});

// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('#closeAC').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('Addcontact').style.display = 'none';
    });
});

document.querySelectorAll('#AddAdress').forEach(button => {
    button.addEventListener('click', () => openPopup('Addadress'));
});

// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('#closeAA').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('Addadress').style.display = 'none';
    });
});

document.querySelectorAll('#EditContact').forEach(button => {
    button.addEventListener('click', () => openPopup('Editcontact'));
});

// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('#closeEC').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('Editcontact').style.display = 'none';
    });
});

document.querySelectorAll('#EditAdress').forEach(button => {
    button.addEventListener('click', () => openPopup('Editadress'));
});

// Ajouter un écouteur d'événement pour fermer la popup de suppression
document.querySelectorAll('#closeEA').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('Editadress').style.display = 'none';
    });
});


// Fonction pour ouvrir la popup
function openPopupAdUser() {
    document.getElementById("userPopup").style.display = "flex";
}

// Fonction pour fermer la popup
function closePopupAdUser() {
    document.getElementById("userPopup").style.display = "none";
}