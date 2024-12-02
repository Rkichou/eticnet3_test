//pour les bouton + et - 
function toggleDetails(element) {
    const detailsRow = element.closest('tr').nextElementSibling;
    const img = element.querySelector('img'); // Récupérer l'image à l'intérieur du bouton
    const button = element.querySelector('button.icon'); // Récupérer le bouton d'icône dans la ligne

    if (detailsRow.style.display === "none" || !detailsRow.style.display) {
        // Afficher les détails et changer l'image à "OfRouge.png"
        detailsRow.style.display = "table-row";
        img.src = "images/icones/close-red.svg"; // Change l'image pour une icône rouge
        button.classList.remove('btn-green');
        button.classList.add('btn-red');
    } else {
        // Masquer les détails et changer l'image à "OfOrange.png"
        detailsRow.style.display = "none";
        img.src = "images/icones/open-green.svg"; // Change l'image pour une icône orange
        button.classList.remove('btn-red');
        button.classList.add('btn-green');
    }
}
    
// Filter rows based on status
function filterRowsByStatus(selectedStatus) {
    const rows = document.querySelectorAll('.ticket-main-row');
    const filterButtons = document.querySelectorAll('.filter-btn');
    // Update active class for buttons
    filterButtons.forEach(btn => {
        btn.classList.toggle('active', btn.getAttribute('data-status') === selectedStatus);
    });
    // Show or hide rows based on the selected status
    rows.forEach(row => {
        const rowStatus = row.querySelector('td:nth-child(7)').textContent.trim();

        if (selectedStatus === 'all' || rowStatus === selectedStatus) {
            row.style.display = 'table-row'; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}
function addTicket() {
    // Get values from the form elements
    const service = document.getElementById("service").value;
    const title = document.getElementById("title").value;
    const message = document.getElementById("message").value;
    const fileInput = document.querySelector('.attach-btn input[type="file"]');
var output = document.getElementById('error-box');
    // Check if the required fields are filled
    if (service === "assign" || !title || !message) {
        output.innerText = "Please fill in all fields.";
        return;
    }
    
    // Prepare form data
    const formData = new FormData();
    formData.append("service", service);
    formData.append("title", title);
    formData.append("message", message);
    
    // Append file if there is one
    if (fileInput && fileInput.files.length > 0) {
        formData.append("file", fileInput.files[0]);
    }

    // Send data to PHP script
    var oReq = new XMLHttpRequest();
    var url= "includes/add_corporate_ticket.php";
	oReq.open("POST", url, true);
	oReq.onload = function (oEvent) 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			// alert(oReq.responseText);	
            output.innerHTML =  oReq.responseText +"<hr> Ticket submitted successfully!";
		}
        else{
            output.innerText = "An error occurred while sending the ticket.";
        }
	};
    oReq.send(formData);
    
}
function show_infos(){
    document.getElementById('infos_ticket').display="block";
}

function openPopup(popupId) {
    document.getElementById(popupId).style.display = 'flex';
}
