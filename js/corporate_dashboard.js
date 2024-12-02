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

function openPopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = 'inline-block';
}

function closePopupAdSh() {
    document.getElementById("popup-advanced-search").style.display = "none";
}

function openPopupRtpValid() {
    //console.log('Popup ouvert');
    document.getElementById('popup-overlay').style.display = 'flex';
}
function closePopupRtpValid() {
    //console.log('Popup fermée'); 
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
function set_comment_contractor(num_of,reference)
	{
		
		var comment=document.getElementById('comment').value;
		//alert(comment);
		if(comment!="")
		{
			var data = new FormData();
			var oReq = new XMLHttpRequest();
			var url= "includes/set_orders_comment_contractor.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					//alert(oReq.responseText);
					close_order_modal('commentPopup');
					corporate_dashboard(); // Retourne sur le dashboard
					// document.getElementById('container_right').innerHTML=oReq.responseText; 
				}
			};
			data.append('num_of', num_of);
			data.append('reference', reference);
			data.append('comment', comment);
			// Poste les datas
			oReq.send(data);
		}
		else{
			document.getElementById('container_error').innerHTML="<p style='color:red'>Please enter your comment first</p>";
		}
	}
function openPopupComment(num_of, reference){
    
		var output = document.getElementById('order-details');
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/get_order_comments.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent)
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				output.innerHTML =  oReq.responseText ;			
				// Affiche le modal
				document.getElementById('commentPopup').style.display = "block";
			}
		};
		data.append('num_of', num_of);
		data.append('reference', reference);
		// Poste les datas
		oReq.send(data);
}
function set_orders_urgent(num_of,reference)
{
		
			var data = new FormData();
			var oReq = new XMLHttpRequest();
			var url= "includes/set_orders_urgent.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					
					corporate_dashboard() // Retourne sur le dashboard
					
				}
			};
			data.append('num_of', num_of);
			data.append('reference', reference);
			// Poste les datas
			oReq.send(data);
		
}
/*function set_status_state_dashboard(status,number) 
	{
		// Utilisé pour le dashboard contractor
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/set_state_criteria_dashboard.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				corporate_dashboard(); // Rappel l'affichage
			}
		};
		data.append('criteria_value', status);
		data.append('criteria_id', number);
		data.append('table', 'corporate_dashboard');
		oReq.send(data);
	}*/

function set_status_state_dashboard(selectedStatus, statusCode) {
    const rows = document.querySelectorAll('.main-row');
    const filterButtons = document.querySelectorAll('.filter-btn');



    // Function to filter rows based on status
    function filterRows(status) {
		// Function to toggle column visibility
		function toggleColumnVisibility(column, displayStyle) {
			columns[column].forEach(cell => {
				cell.style.display = displayStyle;
			});
		}
		
		const columns = {
			BuyerCells: document.querySelectorAll('.BuyerRow'),
			DateOrderCells: document.querySelectorAll('.DateOrderRow'),
			DateCancelCells: document.querySelectorAll('.DateCancelRow'),
			ShippingDateCells: document.querySelectorAll('.ShippingDateRow'),
			TrackNumCells: document.querySelectorAll('.TrackNumRow'),
			DateCells: document.querySelectorAll('.DateRow'),
			TimRemCells: document.querySelectorAll('.TimRemRow'),
			Addells: document.querySelectorAll('.AddRow'),
			StateCells: document.querySelectorAll('.StateRow'),
			StatutCells: document.querySelectorAll('.StatutRow'),
			PrintshopCells: document.querySelectorAll('.PrintshopRow'),
			PriorityCells: document.querySelectorAll('.PriorityRow'),
			ActionsCells: document.querySelectorAll('.ActionsRow')
		};
		
        rows.forEach(row => {
            const rowStatus = row.querySelector('td:nth-child(12)').textContent.trim().toLowerCase();
            row.style.display = (status === 'all' || rowStatus === status.toLowerCase()) ? 'table-row' : 'none';
        });

        const visibilitySettings = {
            'all': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: '', StatutCells: '', PrintshopCells: '', PriorityCells: 'none', ActionsCells: 'none' },
            'waiting confirmation': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: 'none', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: '', ActionsCells: '' },
            'waiting production': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'in production': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'quality control': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'ready for shipping': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'shipped': { DateOrderCells: 'none', DateCancelCells: 'none', ShippingDateCells: '', TrackNumCells: '', DateCells: '', TimRemCells: 'none', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'canceled': { DateOrderCells: '', DateCancelCells: '', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: 'none', Addells: 'none', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: 'none' }
        };

        const settings = visibilitySettings[status.toLowerCase()];
        for (const [column, display] of Object.entries(settings)) {
            toggleColumnVisibility(column, display);
        }
    }

    // Update active button and filter rows
    filterButtons.forEach(btn => btn.classList.remove('active'));

    const activeButton = document.querySelector(`button[data-status="${selectedStatus}"]`);
    if (activeButton) {
        activeButton.classList.add('active');
    } else {
        console.error(`Button with data-status "${selectedStatus}" not found.`);
    }

    var data = new FormData();
	var oReq = new XMLHttpRequest();
	var url= "corporate_table_content.php?statusCode=" + statusCode;
	oReq.open("POST", url, true);
	oReq.onload = function (oEvent)
	{
		if (this.readyState == 4 && this.status == 200)
		{
			document.getElementById('dashboard-table-content').innerHTML = oReq.responseText;
			filterRows(selectedStatus);
		}
		else
		{
			console.error('Error loading table content');
		}
	};
	data.append('criteria_value', selectedStatus);
	data.append('criteria_id', statusCode);
	//data.append('table', 'corporate_dashboard');
	oReq.send(data);
	
	//display or hide status span
	//alert(statusCode);
	if(statusCode == 1){
		document.getElementById('statusWaitingcheck').style.display = "block";
		document.getElementById('statusWaitingRtp').style.display = "block";
		document.getElementById('statusInTime').style.display = "block";
		document.getElementById('statusPriority').style.display = "block";
		document.getElementById('statusRefused').style.display = "block";
	}
	else if(statusCode == 2){
		document.getElementById('statusWaitingcheck').style.display = "block";
		document.getElementById('statusWaitingRtp').style.display = "block";
		document.getElementById('statusInTime').style.display = "none";
		document.getElementById('statusPriority').style.display = "none";
		document.getElementById('statusRefused').style.display = "none";
	}
	else if(statusCode == 4 || statusCode == 5 || statusCode == 6 || statusCode == 9){
		document.getElementById('statusWaitingcheck').style.display = "none";
		document.getElementById('statusWaitingRtp').style.display = "none";
		document.getElementById('statusInTime').style.display = "block";
		document.getElementById('statusPriority').style.display = "block";
		document.getElementById('statusRefused').style.display = "block";
	}
	else{
		document.getElementById('statusWaitingcheck').style.display = "none";
		document.getElementById('statusWaitingRtp').style.display = "none";
		document.getElementById('statusInTime').style.display = "none";
		document.getElementById('statusPriority').style.display = "none";
		document.getElementById('statusRefused').style.display = "none";
	}
}

function set_status_state_rtp(selectedStatus, statusCode) {
    const rows = document.querySelectorAll('.main-row');
    const filterButtons = document.querySelectorAll('.filter-btn');



    // Function to filter rows based on status
    function filterRows(status) {
		// Function to toggle column visibility
		function toggleColumnVisibility(column, displayStyle) {
			columns[column].forEach(cell => {
				cell.style.display = displayStyle;
			});
		}
		
		const columns = {
			BuyerCells: document.querySelectorAll('.BuyerRow'),
			DateOrderCells: document.querySelectorAll('.DateOrderRow'),
			DateCancelCells: document.querySelectorAll('.DateCancelRow'),
			ShippingDateCells: document.querySelectorAll('.ShippingDateRow'),
			TrackNumCells: document.querySelectorAll('.TrackNumRow'),
			DateCells: document.querySelectorAll('.DateRow'),
			TimRemCells: document.querySelectorAll('.TimRemRow'),
			Addells: document.querySelectorAll('.AddRow'),
			StateCells: document.querySelectorAll('.StateRow'),
			StatutCells: document.querySelectorAll('.StatutRow'),
			PrintshopCells: document.querySelectorAll('.PrintshopRow'),
			PriorityCells: document.querySelectorAll('.PriorityRow'),
			ActionsCells: document.querySelectorAll('.ActionsRow')
		};
		
        rows.forEach(row => {
            const rowStatus = row.querySelector('td:nth-child(12)').textContent.trim().toLowerCase();
            row.style.display = (status === 'all' || rowStatus === status.toLowerCase()) ? 'table-row' : 'none';
        });

        const visibilitySettings = {
            'all': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: '', StatutCells: '', PrintshopCells: '', PriorityCells: 'none', ActionsCells: 'none' },
            'waiting confirmation': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: 'none', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: '', ActionsCells: '' },
            'waiting production': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'in production': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'quality control': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'ready for shipping': { DateOrderCells: '', DateCancelCells: 'none', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'shipped': { DateOrderCells: 'none', DateCancelCells: 'none', ShippingDateCells: '', TrackNumCells: '', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: '' },
            'canceled': { DateOrderCells: '', DateCancelCells: '', ShippingDateCells: 'none', TrackNumCells: 'none', DateCells: '', TimRemCells: '', Addells: '', StateCells: 'none', StatutCells: 'none', PrintshopCells: '', PriorityCells: 'none', ActionsCells: 'none' }
        };

        const settings = visibilitySettings[status.toLowerCase()];
        for (const [column, display] of Object.entries(settings)) {
            toggleColumnVisibility(column, display);
        }
    }

    // Update active button and filter rows
    filterButtons.forEach(btn => btn.classList.remove('active'));

    const activeButton = document.querySelector(`button[data-status="${selectedStatus}"]`);
    if (activeButton) {
        activeButton.classList.add('active');
    } else {
        console.error(`Button with data-status "${selectedStatus}" not found.`);
    }

    var data = new FormData();
	var oReq = new XMLHttpRequest();
	var url= "corporate_table_content.php?statusCode=" + statusCode;
	oReq.open("POST", url, true);
	oReq.onload = function (oEvent)
	{
		if (this.readyState == 4 && this.status == 200)
		{
			document.getElementById('dashboard-table-content').innerHTML = oReq.responseText;
			filterRows(selectedStatus);
		}
		else
		{
			console.error('Error loading table content');
		}
	};
	data.append('criteria_value', selectedStatus);
	data.append('criteria_id', statusCode);
	//data.append('table', 'corporate_dashboard');
	oReq.send(data);
	
	//display or hide status span
	//alert(statusCode);
	if(statusCode == 1){
		document.getElementById('statusWaitingcheck').style.display = "block";
		document.getElementById('statusWaitingRtp').style.display = "block";
		document.getElementById('statusInTime').style.display = "block";
		document.getElementById('statusPriority').style.display = "block";
		document.getElementById('statusRefused').style.display = "block";
	}
	else if(statusCode == 2){
		document.getElementById('statusWaitingcheck').style.display = "block";
		document.getElementById('statusWaitingRtp').style.display = "block";
		document.getElementById('statusInTime').style.display = "none";
		document.getElementById('statusPriority').style.display = "none";
		document.getElementById('statusRefused').style.display = "none";
	}
	else if(statusCode == 4 || statusCode == 5 || statusCode == 6 || statusCode == 9){
		document.getElementById('statusWaitingcheck').style.display = "none";
		document.getElementById('statusWaitingRtp').style.display = "none";
		document.getElementById('statusInTime').style.display = "block";
		document.getElementById('statusPriority').style.display = "block";
		document.getElementById('statusRefused').style.display = "block";
	}
	else{
		document.getElementById('statusWaitingcheck').style.display = "none";
		document.getElementById('statusWaitingRtp').style.display = "none";
		document.getElementById('statusInTime').style.display = "none";
		document.getElementById('statusPriority').style.display = "none";
		document.getElementById('statusRefused').style.display = "none";
	}
}

function duplique_order(num_of,reference)
	{
		// alert(numOF);
		if(confirm("Confirm to duplicate this order  " + num_of + " / " + reference))
		{
			var data = new FormData();
			var oReq = new XMLHttpRequest();
			var url= "includes/duplicate_order.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				//alert("readyState = " + this.readyState + ", " + this.status);
				if (this.readyState == 4 && this.status == 200) 
				{
					//console.log(oReq.responseText);					
					corporate_dashboard() // Retourne sur le dashboard
					//document.getElementById('container_right').innerHTML=oReq.responseText; 
				}
			};
			data.append('num_of', num_of);
			data.append('reference', reference);
			// Poste les datas
			oReq.send(data);
		}
	}
function set_orders_cancel_mmg(num_of,reference)
	{
		// alert(numOF);
		if(confirm("Confirm to cancel / destroy this order " + num_of + " / " + reference))
		{
			motif=prompt("Comment for cancel this order");
			if(motif=="")
			{
				return 0;
			}
			var data = new FormData();
			var oReq = new XMLHttpRequest();
			var url= "includes/set_orders_cancel_destroy_mmg.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					// alert(oReq.responseText);
					corporate_dashboard(); // Retourne sur le dashboard
					// document.getElementById('container_right').innerHTML=oReq.responseText; 
				}
			};
			data.append('num_of', num_of);
			data.append('reference', reference);
			data.append('motif', motif);
			// Poste les datas
			oReq.send(data);
		}
	}
	
	function set_orders_cancel(num_of)
	{
		// alert(numOF);
		if(confirm("Confirm to cancel this order " + num_of))
		{
			motif=prompt("Comment for cancel this order");
			if(motif=="")
			{
				return 0;
			}
			var data = new FormData();
			var oReq = new XMLHttpRequest();
			var url= "includes/set_orders_cancel.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					// alert(oReq.responseText);
					corporate_dashboard(); // Retourne sur le dashboard
					// document.getElementById('container_right').innerHTML=oReq.responseText; 
				}
			};
			data.append('num_of', num_of);
			data.append('motif', motif);
			
			// Poste les datas
			oReq.send(data);
		}
	}
function corporate_dashboard()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_dashboard.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{				  
				//init_container();
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;				
			}
		};
		oReq.send(data);
}