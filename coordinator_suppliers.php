<link rel="stylesheet" href="css/suppliers_dup.css">
<style>
  


</style>

        
        <div class="order-summary">
            
           
            <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>&nbsp &nbsp <i class="bi bi-sliders" onclick="openPopupAddSupp();"></i>
                    </button>
            </div>
			<button class="DownUp-btn">
                <i class="bi bi-download"></i>
                Download template
            </button>
			<button class="DownUp-btn">
                <i class="bi bi-upload"></i>
                Upload contacts 
            </button>			
            <button class="add-user-btn">
                <i class="bi bi-plus"></i> Add Supplier
            </button>
        </div>
        <div id="dashboard-content">
            <table class="table1">
        <thead>
            <tr class='entête'>
                <th>Code<i class="bi bi-arrow-down"></th>
				<th>Company<i class="bi bi-arrow-down"></th>
				<th>Adress<i class="bi bi-arrow-down"></th>
				<th>Country<i class="bi bi-arrow-down"></th>
				<th>Phone<i class="bi bi-arrow-down"></th>
				<th>Actions<i class="bi bi-arrow-down"></th>
            </tr>
        </thead>
        <tbody>
    <?php
    $data = [
        ['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
        ['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
		['0133206', 'Nom entreprise', 'Lorem ipsum dolor sit amet consectetur. Sit morbi lobortis.', 'Pays', '+333 333 333 3333'],
    ];

    foreach ($data as $index => $row) {
        $btnClass = ($index % 2 == 0) ? 'btn-green' : 'btn-green';
        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
        ?>
        <tr class="main-row <?= $rowClass ?>" onclick="toggleDetails(this)">
            <td>
                <button class="icon <?= $btnClass ?>" >
                       <img src="Image/OfVert1.png" alt="Icon" style="width: 15px; height: 14px;">
                      </button>
                    <?= $row[0] ?>
            </td>            <td><?= $row[1] ?></td>
            <td><?= $row[2] ?></td>
            <td><?= $row[3] ?></td>
            <td><?= $row[4] ?></td>
            <td>
			     <button class="btn-fact-user" onclick="event.stopPropagation();">
                     <i class="bi bi-plus"></i>&nbsp Add factory
                 </button>
                 <button class="btn-edit-user" onclick="event.stopPropagation();">
                  <i class="bi bi-pencil-square"></i>&nbsp
				  Edit</button>
                  <button class="btn-delete-user" onclick="event.stopPropagation();">
				  <i class="bi bi-trash3"></i>
				  Delete</button>               
            </td>  
        </tr>
        <tr class="main-row <?= $rowClass ?>" style="display: none;">
            <td colspan="6">
                <div class="details-content">
                    <span>Adresses</span>
                    
                </div>
                <table class="sub-table2 details-table">
                    <thead>
                        <tr class="entête">
                            <th>Default</th>
                            <th>Contact</th>
                            <th>Company name</th>
                            <th>Adress</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="default" ></td>
                            <td>
							     <button class="info-button">
                                 <i class="bi bi-person"></i>
					             <div class="popupp">
                                 <p>Nom du contact</p>
                                 <p>+00 0000 0000 000 <i class="bi bi-copy"></i></p>
                                 <p>theo.dupont@emailfaçonnier.com <i class="bi bi-copy"></i></p>
                                 </div>
                                </button>
						    </td>	
                            <td>Company name</td>
                            <td>LEVELOOP GLOVES & CAPS (HAIFENG) LIMITED Gongdishan Industrial Estate, Chengdong Town, Haifeng County, Shanwei City, Guangdong, P.R. of China</td>
                            <td>
                                <button class="btn-edit-contact">
                                  <i class="bi bi-pencil-square"></i>&nbsp
								Edit</button>
                                <button class="btn-delete-contact">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td>      
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="default" ></td>
                            <td>
							     <button class="info-button">
                                 <i class="bi bi-person"></i>
					             <div class="popupp">
                                 <p>Nom du contact</p>
                                 <p>+00 0000 0000 000 <i class="bi bi-copy"></i></p>
                                 <p>theo.dupont@emailfaçonnier.com <i class="bi bi-copy"></i></p>
                                 </div>
                                </button></td>
                            <td>Company name</td>
                            <td>LEVELOOP GLOVES & CAPS (HAIFENG) LIMITED Gongdishan Industrial Estate, Chengdong Town, Haifeng County, Shanwei City, Guangdong, P.R. of China</td>
                            <td>
                                <button class="btn-edit-contact">
                                  <i class="bi bi-pencil-square"></i>&nbsp
								Edit</button>
                                <button class="btn-delete-contact">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td> 
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="default" ></td>
                            <td>
							     <button class="info-button">
                                 <i class="bi bi-person"></i>
					             <div class="popupp">
                                 <p>Nom du contact</p>
                                 <p>+00 0000 0000 000 <i class="bi bi-copy"></i></p>
                                 <p>theo.dupont@emailfaçonnier.com <i class="bi bi-copy"></i></p>
                                 </div>
                                </button></td>
                            <td>Company name</td>
                            <td>LEVELOOP GLOVES & CAPS (HAIFENG) LIMITED Gongdishan Industrial Estate, Chengdong Town, Haifeng County, Shanwei City, Guangdong, P.R. of China</td>
                            <td>
                                <button class="btn-edit-contact">
                                  <i class="bi bi-pencil-square"></i>&nbsp
								Edit</button>
                                <button class="btn-delete-contact">
								<i class="bi bi-trash3"></i>
								Delete</button>
                            </td> 
                        </tr>
                    </tbody>
                </table>
               


   
            </td>
        </tr>
    <?php } ?>

</tbody>

    </table>
	<!-- popup create user-->
     <div id="createUserPopupS" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Add supplier</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">
            <button type="button" class="add-new-btn">+ Add new address</button>

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            <button type="button" class="add-new-btn">+ Add new contact</button>
            
            <button  class="createS-btn">
			<img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;">
			Create</button>
        </form>
    </div>
</div>  

<!-- popup Add fact-->
     <div id="Addfact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Add factory</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            
            
            <button class="createF-btn"><img src="Image/addProd.png" alt="Icon" style="width: 24px; height: 23px;">
			 Create</button>
        </form>
    </div>
</div> 
<!-- popup Edit fact-->
     <div id="Editfact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Edit factory</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            
            
            <button type="submit" class="Save-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </form>
    </div>
</div>

<!-- popup Edit contact-->
     <div id="Editcontact" class="popupS-container">
    <div class="popupS-content">
        <span class="closeS-btn" onclick="closePopup33()"><i class="bi bi-x-lg"></i></span>
        <h5>Edit contact</h5>

        <h4>General informations</h4>
        <form>
            <input type="text" placeholder="Company name">
            <input type="text" placeholder="Address 1">
            <input type="text" placeholder="Additional address">
            <div class="form-group">
                <input type="text" placeholder="ZIP code">
                <input type="text" placeholder="City">
            </div>
            <input type="text" placeholder="Country">

            <h4>Contact</h4>
            <div class="form-group">
                <input type="text" placeholder="1st name">
                <input type="text" placeholder="Last name">
            </div>
            <input type="email" placeholder="Email address">
            <div class="form-group2">
                <select>
                    <option value="+XXX" disabled selected>+XXX</option>
                    <option value="+123">+123</option>
                   <option value="+456">+456</option>
                    <!-- Other options here -->
                </select>
                <input type="text" placeholder="Phone number">
            </div>
            
            
            <button type="submit" class="Save-btn"><i class="bi bi-floppy"></i>&nbsp Save</button>
        </form>
    </div>
</div>
 
 <!-- popup delete supp --> 
 <div id="deletePopup" class="deletePopup">
    <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once a supplier has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>

 <!-- popup delete contact --> 
 <div id="deletePopup2" class="deletePopup">
     <div class="deletePopup-content">
        <h5>Are you sure ?</h5>
        <p>Once a factory has been deleted, you will not be able to recover his datas.</p>
        <div class="deletePopup-buttons">
            <button class="btn-cancel" ><i class="bi bi-x-lg"></i> Cancel</button>
            <button class="btn-confirm-delete" ><i class="bi bi-trash3"></i> Delete</button>
        </div>
    </div>
</div>
        </div>



<!-- recheche rapide  -->
 <div id="popup-advanced-search_Supp" class="modal">
        <div class="modal-content">
            <span class="popup-close"><i class="bi bi-x-lg"  onclick="closePopupAdSupp()"></i></span>
            <h2 class="popup-title">Advanced research</h2>

            <div class="popup-section">
                <h3 class="section-title">General informations</h3>
                <div class="input-group2">
                    <input type="text" placeholder="Company" class="input-field1">
                    <input type="text" placeholder="Type" class="input-field1">
					<input type="text" placeholder="Country" class="input-field1">
                    <input type="text" placeholder="Reference" class="input-field1">
					<input type="text" placeholder="Phone" class="input-field1">
                </div>

            </div>

            <div class="popup-section">
                <h3 class="section-title">Adress</h3>
                <div class="input-group2">
                    <input type="text" placeholder="Country" class="input-field1">
                    <input type="text" placeholder="Province" class="input-field1">
					<input type="text" placeholder="City" class="input-field1">
                    <input type="text" placeholder="Zip code" class="input-field1">
					<input type="text" placeholder="Street" class="input-field1">
					<input type="text" placeholder="N°" class="input-field1">
					<input type="text" placeholder="Adress 2" class="input-field1">
                </div>

            </div>

            

            <div class="Recher-button-container">
                <button class="btn-Recher"><i class="bi bi-search"></i>&nbsp Search</button>
            </div>
        </div>
    </div>
     	
<script src="js/dashboard_dup.js"></script>
<script>
function openPopupAddSupp() {
    document.getElementById("popup-advanced-search_Supp").style.display = 'block';
}

function closePopupAddSupp() {
    document.getElementById("popup-advanced-search_Supp").style.display = "none";
}

</script>
<div class="footer">

     <div class="pagination">
	 <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows">
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                </select>
                <span>rows</span>
            </div>
        <a href="#" class="page-link0"> < Previous</a>
        <a href="#" class="page-link">1</a>
        <a href="#" class="page-link">2</a>
        <a href="#" class="page-link">3</a>
        <a href="#" class="page-link">4</a>
        <a href="#" class="page-link0">Next ></a>
    </div>
   
</div>