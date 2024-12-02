
    <link rel="stylesheet" href="css/PS_cart_dup.css">

    <a href="PS_Store.php" class="back-link">← Back to store</a>
    

    <!-- Order Section -->
    <div class="order2-container">
        <!-- Shipping and Billing Section -->
        <div class="address-section">
            <div class="address-block">
                <h4>Shipping address</h4>
                <div class="company-section">
				<select>
                    <option value="Company name" disabled selected>Company name</option>
                    <option value="Company 1">Company 1</option>
                   <option value="Company 2">Company 2</option>
                    <!-- Other options here -->
                </select>
				</div>
                <input type="text" class="address-input" placeholder="Address 1"><br>
                <input type="text" class="address-input" placeholder="Additional address"><br>
                <input type="text" class="address-input-half" placeholder="ZIP code">
                <input type="text" class="address-input-half" placeholder="City"><br>
                <input type="text" class="address-input" placeholder="Country">
            </div>

            <div class="address-block">
                <h4>Billing address</h4>
				<div class="company-section">
				<select>
                    <option value="Company name" disabled selected>Company name</option>
                    <option value="Company 1">Company 1</option>
                   <option value="Company 2">Company 2</option>
                    <!-- Other options here -->
                </select>
				</div>
                <input type="text" class="address-input" placeholder="Address 1"><br>
                <input type="text" class="address-input" placeholder="Additional address"><br>
                <input type="text" class="address-input-half" placeholder="ZIP code">
                <input type="text" class="address-input-half" placeholder="City"><br>
                <input type="text" class="address-input" placeholder="Country">
            </div>
			
        </div>

        <!-- Contact Section <div class="address-block">
                <h4>Contact</h4>
                <input type="text" class="address-input-half" placeholder="1st name"><br>
                <input type="text" class="address-input-half" placeholder="Last name"><br>
                <input type="text" class="address-input" placeholder="Email address"><br>
                <div class="phone-section">
                <input type="text" class="phone-code" placeholder="+XXX">
                <input type="text" class="contact-input-phone" placeholder="Phone number">
                </div>
            </div>-->
		<div class="address-block">
                <h4>Contact</h4>
                <input type="text" class="address-input-half" placeholder="1st name">
                <input type="text" class="address-input-half" placeholder="Last name"><br>
                <input type="email" class="address-input" placeholder="Email address">
				<div class="phone-section">
				<select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" class="contact-input-phone" placeholder="Phone number">
                </div>
        </div>
        <button class="place-order-btn">Place order</button>
    </div>

