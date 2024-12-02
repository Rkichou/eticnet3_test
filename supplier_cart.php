
<link rel="stylesheet" href="css/PS_cart_dup.css">
    <a href="PS_Store.php" class="back-link">← Back to store</a>

    <!-- Order Section -->
    <div class="order-container">
	   <!-- TabCart Section -->
    <div class="tabCart-container">
        <table class="tabCart-table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Qty/unit</th>
                    <th>Enter unit qty</th>
                    <th>Total pcs</th>
                    <th>Price</th>
                    <th></th> <!-- Empty header for the delete icon column -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tencel rope</td>
                    <td>150 pcs</td>
                    <td><input type="text" value="10 000 000"></td>
                    <td>100 000 000</td>
                    <td>100 000€</td>
                    <td><button class="delete-btn"><i class="bi bi-trash3"></i></button></td>
                </tr>
                <tr>
                    <td>Tencel rope</td>
                    <td>150 pcs</td>
                    <td><input type="text" value="10 000 000"></td>
                    <td>100 000 000</td>
                    <td>100 000€</td>
                    <td><button class="delete-btn"><i class="bi bi-trash3"></i></button></td>
                </tr>
                <tr>
                    <td>Tencel rope</td>
                    <td>150 pcs</td>
                    <td><input type="text" value="10 000 000"></td>
                    <td>100 000 000</td>
                    <td>100 000€</td>
                    <td><button class="delete-btn"><i class="bi bi-trash3"></i></button></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="1">Total price (ex-works)</td>
                    <td colspan="4">30 000£$€</td>
                </tr>
            </tfoot>
        </table>
    </div>
	
	   
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
                    <h4>Billing address</h4>
                    <input type="text" class="billing-input" placeholder="Order reference"><br>
                </div>
            </div>
            <button class="Next-btn">Next</button>
        </div>
    </div>

