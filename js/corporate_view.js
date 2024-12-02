$(document).ready(function(){
	

    $('.navbar-link').click(function(e){
        e.preventDefault();

        // Remove active class from all links
        $('.navbar-link').removeClass('active');
        
        // Add active class to the clicked link
        $(this).addClass('active');

       
		
    });


	
});

function openPopupCM(){
	document.getElementById("commentPopup").style.display = "block";
	document.getElementById("sendCommentBtn").style.display = "block";
	document.getElementById("refuseRTPBtn").style.display = "none";
	document.getElementById("titlePopup").innerHTML = "Comment";
}

function openPopupRefuse(){
	document.getElementById("commentPopup").style.display = "block";
	document.getElementById("sendCommentBtn").style.display = "none";
	document.getElementById("refuseRTPBtn").style.display = "block";
	document.getElementById("titlePopup").innerHTML = "Refuse RTP";
}

function closePopupCM(){
	document.getElementById("commentPopup").style.display = "none";
}

function exportFile() {
        var dateFrom = document.getElementById('dateFrom').value;
		var dateTo = document.getElementById('dateTo').value;
		var output = document.querySelector('.content');
        var error=document.getElementById('errorMessage');
		
        if ((dateFrom!=="") && (dateTo!=="")) {
			// Afficher le message de chargement
			document.getElementById('loadingMessage').style.display = 'block';	
			// Effacer l'historique des précédentes intégrations
			output.innerHTML = "";	
            error.innerHTML="";	
            var formData = new FormData();
            
            formData.append('dateFrom', dateFrom);
			formData.append('dateTo', dateTo);
			
            var xhr = new XMLHttpRequest();
			var $dossier="includes/corporate_file_export.php";
            xhr.open('POST', $dossier, true);
            xhr.onload = function(event) 
			{				
            	
                if (xhr.status == 200 && xhr.responseText != 'error') {

                    output.innerHTML = "<p> " + xhr.responseText + "</p>";
                } else {
                    output.innerHTML = "<p style='color: red;'>Error occurred when trying to export your file.</p>";
                }
				// Masquer le message de chargement une fois la réponse reçue
				document.getElementById('loadingMessage').style.display = 'none';                
            };

            xhr.send(formData);
        } 
		else {
            error.innerHTML += "<p > Please select a date</p>";
        }
    }

function disconnect()
{
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/disconnect.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.location.href="login.php";
			}
			
		};
		oReq.send(data);
}
function file_explorer() 
	{
        document.getElementById('selectfile').click();
		if(document.getElementById('selectfile')){
			document.getElementById('selectfile').onchange = function(){
				var fileObj = document.getElementById('selectfile').files[0];				
				var fileName = fileObj.name;
    			var fileExtension = fileName.split('.').pop();
				// Vérification de l'extension du fichier
				if (fileExtension.toLowerCase() !== 'txt') 
				{
					alert('Please select a text file (.txt)');
					return;
				}
				else
				{
					file = document.getElementById('selectfile').files[0];
					document.getElementById("drag_upload_file").classList.add("uploaded");
					//document.getElementById('file_content').innerHTML= "<p>Uploading file </p>";
				}
			}
		}
    }
function handleDragOver(event) {
        event.preventDefault();
        event.stopPropagation();
        event.dataTransfer.dropEffect = 'copy';
    }

    function handleDrop(event) {
		event.preventDefault();
		event.stopPropagation();
		
		var dt = event.dataTransfer;
		var files = dt.files;
		
		// Vérifier s'il y a des fichiers déposés
		if (files.length > 0) {
			var fileName = files[0].name;
			var fileExtension = fileName.split('.').pop();
			
			// Vérification de l'extension du fichier
			if ((fileExtension.toLowerCase() !== 'txt') || (fileExtension.toLowerCase() !== 'csv')||(fileExtension.toLowerCase() !== 'xlsx') ||(fileExtension.toLowerCase() !== 'zip'))
			{
				alert('Please select a file.');
				return;
			}
			else
			{
				file = files[0];
			}
		
		} 
		else 
		{
			alert('Please select a file');
		}
	}
	function handleDragLeave(event) 
	{
        event.preventDefault();
        event.stopPropagation();
    }
function csvfile_explorer() 
	{
        document.getElementById('selectfile').click();
		if(document.getElementById('selectfile')){
			document.getElementById('selectfile').onchange = function(){
				var fileObj = document.getElementById('selectfile').files[0];				
				var fileName = fileObj.name;
    			var fileExtension = fileName.split('.').pop();
				// Vérification de l'extension du fichier
				if (fileExtension.toLowerCase() !== 'csv') 
				{
					alert('Please select file (.csv)');
					return;
				}
				else
				{
					file = document.getElementById('selectfile').files[0];
					document.getElementById("drag_upload_file").classList.add("uploaded");
					//document.getElementById('file_content').innerHTML= "<p>Uploading file </p>";
				}
			}
		}
    }
	function xlsfile_explorer() 
	{
        document.getElementById('selectfile').click();
		if(document.getElementById('selectfile')){
			document.getElementById('selectfile').onchange = function(){
				var fileObj = document.getElementById('selectfile').files[0];				
				var fileName = fileObj.name;
    			var fileExtension = fileName.split('.').pop();
				// Vérification de l'extension du fichier
				if (fileExtension.toLowerCase() !== 'xls' && fileExtension.toLowerCase() !== 'xlsx' && fileExtension.toLowerCase() !== 'xlsm') 
				{
					alert('Please select a file (.xls)');
					return;
				}
				else
				{
					selectfile = document.getElementById('selectfile').files[0];
					document.getElementById("drag_upload_file").classList.add("uploaded");
					//document.getElementById('file_content').innerHTML= "<p>Uploading file. Click integrate to  </p>";
				}
			}
		}
    }
	
	
	function uploadFileLemaire() {
        var selectedService = document.getElementById('services').value;
		file = document.getElementById('selectfile').files[0];
        if (file) {		
	
            var formData = new FormData();
            formData.append('file', file);
            formData.append('selected_service', selectedService);

            var xhr = new XMLHttpRequest();
			var dossier="integrations/integrations_lemaire_2024.php";
            xhr.open('POST', dossier, true);
            xhr.onload = function(event) 
			{
                var output = document.querySelector('.file-content');
            	// Effacer l'historique des précédentes intégrations
            	output.innerHTML = "";

                if (xhr.status == 200 && xhr.responseText != 'error') {
					output.innerHTML = "<p>" + xhr.responseText + "</p>";
				} else if (xhr.status == 404) {
					output.innerHTML = "<p style='color: red;'>File not found (404)."+ xhr.responseText + "</p>";
				} else if (xhr.status == 500) {
					output.innerHTML = "<p style='color: red;'>Server error (500)."+ xhr.responseText + "</p>";
				} else {
					output.innerHTML = "<p style='color: red;'>Error occurred when trying to upload your file. Status: " + xhr.status + ", Response: " + xhr.responseText + "</p>";
				}
            
            };
        xhr.onerror = function() {
            alert('Network error. Could not reach the server.');
        };

            xhr.send(formData);
			// Réinitialiser le champ de sélection de fichier
			document.getElementById('selectfile').value = null;
			document.getElementById("drag_upload_file").classList.remove("uploaded");
        } 
		else {
            alert('Please select a text file');
        }
    }
	
	function uploadFileLoe() {
        var selectedService = document.getElementById('services').value;
		
        //if (selectfile && pdffile) {		
			if (selectfile) {	
            var formData = new FormData();
            formData.append('selectfile', selectfile);
			//formData.append('pdffile', pdffile);
            formData.append('selected_service', selectedService);

            var xhr = new XMLHttpRequest();
			var dossier="integrations/integrations_loewe_files.php";
            xhr.open('POST', dossier, true);
            xhr.onload = function(event) 
			{
                var output = document.querySelector('.file-content');
            	// Effacer l'historique des précédentes intégrations
            	output.innerHTML = "";
                if (xhr.status == 200 && xhr.responseText != 'error') {
					output.innerHTML = "<p> " + xhr.responseText + "</p>";
				} else if (xhr.status == 404) {
					output.innerHTML = "<p style='color: red;'>File not found (404).</p>";
				} else if (xhr.status == 500) {
					output.innerHTML = "<p style='color: red;'>Server error (500).</p>";
				} else {
					output.innerHTML = "<p style='color: red;'>Error occurred when trying to upload your file. Status: " + xhr.status + ", Response: " + xhr.responseText + "</p>";
				}
            };
            xhr.send(formData);
			// Réinitialiser le champ de sélection de fichier
			document.getElementById('selectfile').value = null;
			//document.getElementById('pdffile').value = null;
			document.getElementById("drag_upload_file").classList.remove("uploaded");
			//document.getElementById("drag_pdf_file").classList.remove("uploaded");
        } 
		else {
            alert('Please select a file');
        }
    }
	
	function uploadFileChloe() {
        // var selectedService = document.getElementById('services').value;
		
        if (file) {			
            var formData = new FormData();
            formData.append('file', file);
            // formData.append('selected_service', selectedService);

            var xhr = new XMLHttpRequest();
			var dossier="integrations/integrations_chloe_file_2024.php";
            xhr.open('POST', dossier, true);
            xhr.onload = function(event) 
			{
                var output = document.querySelector('.file-content');
            	// Effacer l'historique des précédentes intégrations
            	output.innerHTML = "";
                if (xhr.status == 200 && xhr.responseText != 'error') {
					output.innerHTML = "<p>" + xhr.responseText + "</p>";
				} else if (xhr.status == 404) {
					output.innerHTML = "<p style='color: red;'>File not found (404).</p>";
				} else if (xhr.status == 500) {
					output.innerHTML = "<p style='color: red;'>Server error (500).</p>";
				} else {
					output.innerHTML = "<p style='color: red;'>Error occurred when trying to upload your file. Status: " + xhr.status + ", Response: " + xhr.responseText + "</p>";
				}
            };
            xhr.send(formData);
			// Réinitialiser le champ de sélection de fichier
			document.getElementById('selectfile').value = null;
			document.getElementById("drag_upload_file").classList.remove("uploaded");
        } 
		else {
            alert('Please select a text file');
        }
    }
	function uploadFileLanvin() {
		var selectedService = document.getElementById('services').value;
		if (selectfile) {			
			var formData = new FormData();
			formData.append('file', selectfile);
			formData.append('selected_service', selectedService);
			var xhr = new XMLHttpRequest();
			var dossier = "integrations/integrations_lanvin_2024.php";
			xhr.open('POST', dossier, true);
			xhr.onload = function(event) 
			{
                var output = document.querySelector('.file-content');
            	// Effacer l'historique des précédentes intégrations
            	output.innerHTML = "";
                if (xhr.status == 200 && xhr.responseText != 'error') {
					output.innerHTML = "<p>" + xhr.responseText + "</p>";
				} else if (xhr.status == 404) {
					output.innerHTML = "<p style='color: red;'>File not found (404).</p>";
				} else if (xhr.status == 500) {
					output.innerHTML = "<p style='color: red;'>Server error (500).</p>";
				} else {
					output.innerHTML = "<p style='color: red;'>Error occurred when trying to upload your file. Status: " + xhr.status + ", Response: " + xhr.responseText + "</p>";
				}
            };
			xhr.send(formData);
			document.getElementById('selectfile').value = null; // Réinitialiser le champ de sélection de fichier
			document.getElementById("drag_upload_file").classList.remove("uploaded");
		} 
		else
		{
			alert('Please select an xlsx file');
		}
	}
	
	function uploadFileAlaia() {
		var selectedService = document.getElementById('services').value;
		//var labels = document.getElementsByName('label').value;
		var selectedLabel = document.querySelector('input[name="label"]:checked');
		
		if (!selectedLabel) {
			alert('Please select a label.');
			return;
		}
		//var selectfile = document.getElementById('selectfile').files[0];
		if (selectfile) {			
			var formData = new FormData();
			formData.append('file', selectfile);
			formData.append('selected_service', selectedService);
			formData.append('selected_label', selectedLabel.value);
			var xhr = new XMLHttpRequest();
			var dossier = "integrations/integrations_alaia_2024.php";
			xhr.open('POST', dossier, true);
			xhr.onload = function(event) 
			{
                var output = document.querySelector('.file-content');
            	// Effacer l'historique des précédentes intégrations
            	output.innerHTML = "";
                if (xhr.status == 200 && xhr.responseText != 'error') {
					output.innerHTML = "<p>" + xhr.responseText + "</p>";
				} else if (xhr.status == 404) {
					output.innerHTML = "<p style='color: red;'>File not found (404).</p>";
				} else if (xhr.status == 500) {
					output.innerHTML = "<p style='color: red;'>Server error (500).</p>";
				} else {
					output.innerHTML = "<p style='color: red;'>Error occurred when trying to upload your file. Status: " + xhr.status + ", Response: " + xhr.responseText + "</p>";
				}
            };
			xhr.send(formData);
			document.getElementById('selectfile').value = null; // Réinitialiser le champ de sélection de fichier
			document.getElementById("drag_upload_file").classList.remove("uploaded");
		} 
		else{
			alert('Please select an xlsx file');
		}
	}
	function uploadFilePatou() {
		
		var selectedLabel = document.querySelector('input[name="label"]:checked');
		
		if (!selectedLabel) {
			alert('Please select a label type.');
			return;
		}
		var selectfile = document.getElementById('selectfile').files[0];
		if (selectfile) {			
			var formData = new FormData();
			formData.append('file', selectfile);
			//formData.append('selected_service', selectedService);
			formData.append('selected_label', selectedLabel.value);
			var xhr = new XMLHttpRequest();
			var dossier = "integrations/integrations_patou_2024.php";
			xhr.open('POST', dossier, true);
			xhr.onload = function(event) 
			{
                var output = document.querySelector('.file-content');
            	// Effacer l'historique des précédentes intégrations
            	output.innerHTML = "";
                if (xhr.status == 200 && xhr.responseText != 'error') {
					output.innerHTML = "<p>" + xhr.responseText + "</p>";
				} else if (xhr.status == 404) {
					output.innerHTML = "<p style='color: red;'>File not found (404).</p>";
				} else if (xhr.status == 500) {
					output.innerHTML = "<p style='color: red;'>Server error (500).</p>";
				} else {
					output.innerHTML = "<p style='color: red;'>Error occurred when trying to upload your file. Status: " + xhr.status + ", Response: " + xhr.responseText + "</p>";
				}
            };
			xhr.send(formData);
			document.getElementById('selectfile').value = null; // Réinitialiser le champ de sélection de fichier
			document.getElementById("drag_upload_file").classList.remove("uploaded");
		} 
		else{
			alert('Please select an xlsx file');
		}
	}
function set_rows(page){
    var rows = document.getElementById("rows").value;
    var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= page + ".php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{				  
				//init_container();
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;
				
			}
		};

		data.append('rows', rows);
		oReq.send(data);
}
function corporate_dictionary()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_dictionary.php";
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
function waiting_load(){
    var codeVideo="<image src='./images/eticnet_wait_mini.gif' alt='wait'>";
	
	document.getElementById('dashboard-content').innerHTML=codeVideo;
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
function corporate_excelexport()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_excelexport.php";
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
function corporate_importpo()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_importpo.php";
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
function corporate_suppliers() {
    var data = new FormData();
    var oReq = new XMLHttpRequest();
    var url = "corporate_suppliers.php";
    oReq.open("POST", url, true);
    oReq.onload = function (oEvent) {
        if (this.readyState == 4 && this.status == 200) {
            // Remplacer le contenu de 'dashboard-content' avec la réponse
            document.getElementById('dashboard-content').innerHTML = oReq.responseText;

            // Initialiser les événements après avoir chargé dynamiquement la page
            initializeSuppliersEvents();
        }
    };
    oReq.send(data);
}

function corporate_store()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_store.php";
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
function corporate_readytoprint()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_readytoprint.php";
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
function corporate_ticket()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_ticket.php";
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
function corporate_daysoff()
{
		//waiting_load();
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_daysoff.php";
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
function close_order_modal(modal){
		
		var modal = document.getElementById(modal);
		modal.style.display = 'none';	
	}