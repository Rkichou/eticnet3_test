<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/cart.css">
    <title>Order Place</title>
	
</head>
<body>
    <a href="store.php" class="back-link">← Back to store</a>
    <button class="place-order-btn">Place order</button>
    <div class="order-container">
        <!-- Product Section -->
        <div class="product-section">
            <div class="product-item">
                 <div class="popup-header2">
                   <h2>CD201</h2>			
                   <button class="popup-delete2"><img src="Image/deletepopup.png" alt="Delete" class="popup-delete2-icon"></button>
                </div> 
                <div class="product-details">
                    <select class="product-select">
                        <option>Etic Europe Portugal</option>
                    </select>
                    <input type="text" class="product-input" placeholder="Quantity">
                    <button class="cancel-btn">X</button>
                </div>
                <button class="add-site-btn">+ Add site</button>
            </div>

            <div class="product-item">
                <div class="popup-header2">
                   <h2>CD232</h2>			
                   <button class="popup-delete2"><img src="Image/deletepopup.png" alt="Delete" class="popup-delete2-icon"></button>
                </div> 
                <div class="product-details">
                    <select class="product-select">
                        <option>Etic Europe Tunisia</option>
                    </select>
                    <input type="text" class="product-input" placeholder="Quantity">
                    <button class="cancel-btn">X</button>
                </div>
                <div class="product-details">
                    <select class="product-select">
                        <option>Etic Europe Portugal</option>
                    </select>
                    <input type="text" class="product-input" placeholder="Quantity">
                    <button class="cancel-btn">X</button>
                </div>
                <div class="product-details">
                    <select class="product-select">
                        <option>Etic Europe Egypt</option>
                    </select>
                    <input type="text" class="product-input" placeholder="Quantity">
                    <button class="cancel-btn">X</button>
                </div>
                <button class="add-site-btn">+ Add site</button>
            </div>

            <div class="product-item">
			<div class="popup-header2">
                <h2>CD298</h2>			
                   <button class="popup-delete2"><img src="Image/deletepopup.png" alt="Delete" class="popup-delete2-icon"></button>
            </div>
                <div class="product-details">
                    <select class="product-select">
                        <option>Etic Europe Portugal</option>
                    </select>
                    <input type="text" class="product-input" placeholder="Quantity">
                    <button class="cancel-btn">X</button>
                </div>
                <div class="product-details">
                    <select class="product-select">
                        <option>Etic Europe Egypt</option>
                    </select>
                    <input type="text" class="product-input" placeholder="Quantity">
                    <button class="cancel-btn">X</button>
                </div>
                <button class="add-site-btn">+ Add site</button>
            </div>
        </div>

        <!-- Order Section -->
        <div class="order-Gauche">
		     <div class="order-section">
            <div class="shipment-method">
                <h3>Shipment method</h3>
                <label><input type="radio" name="shipment" value="forwarder" checked> By Etic Europe’s forwarder</label>
                <label><input type="radio" name="shipment" value="pickup"> Pickup by yourself*</label>
                <p>*the packing list will be provided once the production is completed</p>
            </div>
			</div>
			<div class="order-sectionBill">
            <div class="billing-address">
                <h3>Billing address</h3>
                <input type="text" class="billing-input" placeholder="Company name"><br>
                <input type="text" class="billing-input" placeholder="Address 1"><br>
                <input type="text" class="billing-input" placeholder="Additional address"><br>
                <input type="text" class="billing-input2" placeholder="ZIP code">
                <input type="text" class="billing-input2" placeholder="City">
                <input type="text" class="billing-input2" placeholder="Country">
            </div>
        </div>
    </div>
</body>
</html>
