function place_order(reference) 
{	
	//var reference = document.getElementById('editButton').getAttribute("data-gs-reference");
	var output = document.getElementById('order-details');
	var data = new FormData();
	var oReq = new XMLHttpRequest();
	var url= "includes/get_order_details.php";
	oReq.open("POST", url, true);
	oReq.onload = function (oEvent)
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			output.innerHTML =  oReq.responseText ;			
			// Affiche le modal
			document.getElementById('orderModal').style.display = "block";
		}
	};
	data.append('reference', reference);
	// Poste les datas
	oReq.send(data);
}

function corporate_place_order()
{
	var data = new FormData();
	var oReq = new XMLHttpRequest();
	var url= "includes/corporate_order_placed.php";
	oReq.open("POST", url, true);
	oReq.onload = function (oEvent) 
	{
		if (this.readyState == 4 && this.status == 200) 
		{
			  // alert(oReq.responseText);
			  //init_container_right();
			document.getElementById('dashboard-content').innerHTML=oReq.responseText;
		}
	};
	// data.append('tableName', tableName);
	// data.append('id', id);
	oReq.send(data);
}

	
function save_cart_order(){

		var reference=document.getElementById('reference').value;
		var user_id=document.getElementById('user_id').value;
		var qty = document.getElementById('qty').value;
		var number = document.getElementById('number').innerHTML;
		var supplier = document.getElementById('suppliers').value;
		var output = document.getElementById('error-box');
		var valid = true; // Variable pour vérifier la validité des quantités
		if (qty <= 0) {
			output.innerText ="The quantity should be superior to 0. Kindly reenter a valid number.";
			valid = false; // Marquer comme invalide
			return; // Sortir de la boucle si une quantité invalide est trouvée
		}
		if (valid) {
			var data = new FormData();
			var oReq = new XMLHttpRequest();
			var url= "includes/add_cart_order.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					var modal = document.getElementById('orderModal');
					modal.style.display = 'none';	
					document.getElementById('number').innerHTML=parseInt(number,10)+1;	
					
				}
			};
			data.append('user_id', user_id);
			data.append('reference', reference);
			data.append('qty', qty);
			data.append('supplier', supplier);
			// Poste les datas
			oReq.send(data);
		}
	}
	function delete_cart_order(id)
	{	
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/delete_cart_order.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				//var modal = document.getElementById('orderModal');
				//modal.style.display = 'none';	
				//alert(oReq.responseText);	
				corporate_cart();
				
			}
		};
		data.append('order_id', id);
		
		// Poste les datas
		oReq.send(data);
	}
	function save_orders(id)
	{
		// Récupération des éléments du formulaire
		var suppliers = document.querySelectorAll("input[name='suppliers[]']");
		var addresses = document.querySelectorAll("select[name='adresses[]']");
		var quantities = document.querySelectorAll("input[name='quantities[]']");
		var orders = document.querySelectorAll("input[name='orders[]']");
		var data = new FormData();
		var valid = true; // Variable pour vérifier la validité des quantités
		// Boucle pour récupérer les valeurs et vérifier les quantités
		addresses.forEach((address, index) => {
			var order = orders[index].value;
			var supplierValue = suppliers[index].value;
			var addressValue = address.options[address.selectedIndex].value;
			var quantityValue = parseInt(quantities[index].value, 10);
	
			if (quantityValue <= 0) {
				alert("The quantity should be superior to 0. Kindly reenter a valid number.");
				valid = false; // Marquer comme invalide
				return; // Sortir de la boucle si une quantité invalide est trouvée
			}
	
			// Ajouter les valeurs au FormData
			data.append('orders[]', order);
			data.append('suppliers[]', supplierValue);
			data.append('addresses[]', addressValue);
			data.append('quantities[]', quantityValue);
		});
		// Si toutes les quantités sont valides, envoyer les données via XMLHttpRequest
		if (valid) {
			data.append('id_user', id);
			var oReq = new XMLHttpRequest();
			var url = "includes/save_orders.php";
			oReq.open("POST", url, true);
			oReq.onload = function (oEvent) {
				if (this.readyState == 4 && this.status == 200) {
					//init_container_right();
					document.getElementById('dashboard-content').innerHTML = oReq.responseText;
				}
			};
	
			oReq.send(data); // Envoyer les données via POST
		}	
	}
	function delete_order(reference,user_id)
	{		
		if(confirm("Confirm delete reference order " + reference))
		{		
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/delete_order.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{	
				//alert(oReq.responseText);				
				corporate_cart();				
			}
		};
		data.append('user_id', user_id);
		data.append('reference', reference);
		// Poste les datas
		oReq.send(data);
		}
	}
	function corporate_cart()
	{
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "includes/corporate_cart.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				  // alert(oReq.responseText);
				  //init_container_right();
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;
			}
		};
		// data.append('tableName', tableName);
		// data.append('id', id);
		oReq.send(data);
	}

function corporate_orderhistory(){
		//var id=id;
		var data = new FormData();
		var oReq = new XMLHttpRequest();
		var url= "corporate_orderhistory.php";
		oReq.open("POST", url, true);
		oReq.onload = function (oEvent) 
		{
			if (this.readyState == 4 && this.status == 200) 
			{				
				document.getElementById('dashboard-content').innerHTML=oReq.responseText;			
				
			}
		};
		//data.append('id', id);
		// Poste les datas
		oReq.send(data);
	}
//Pour poppup QTY
	function openQTYPopup() {
    document.getElementById("qtyPopup").style.display = "block";
}

function closeQTYPopup(){
    document.getElementById("qtyPopup").style.display = "none";
}