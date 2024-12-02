
      <link rel="stylesheet" href="css/AddUser_dup.css">
        <div class="order-summary">
            
             <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
            </div>
            <button class="Down-dict-btn">
                <i class="bi bi-download"></i> Download dictionary
            </button>
        </div>
        <div class="table-container">
            <table id="myTable" class="table1">
                <thead class="entête">
                    <tr>
                        <th>English<i class="bi bi-arrow-down"></i></th>
                        <th>Korean <i class="bi bi-arrow-down"></i></th>
                        <th>Chinese<i class="bi bi-arrow-down"></i></th>
                        <th>French<i class="bi bi-arrow-down"></i></th>
						<th>Japanese<i class="bi bi-arrow-down"></i></th>
						<th>Russian<i class="bi bi-arrow-down"></i></th>
					
                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = [
                        ['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
						['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
						['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
						['MANILA', '마닐라', '马尼拉麻','ABACA', 'マニラ麻','МАНИЛА'],
                        ['STAINLESS STEEL', '스테인리스강', '不锈钢','ACIER INOXIDABLE', 'ステンレス鋼','НЕРЖАВЕЮЩАЯ СТАЛЬ'],
						['ALCOHOL', '알코올', '사슴','ALCOOL', '폴리아크릴','АЛКОГОЛЬ'],
                        ['STAG', '사슴', '鹿皮革','CERF', '雄鹿','ОЛЕНЬ'],
                    ];

                    foreach ($data as $index => $row) {
                        $rowClass = ($index % 2 == 0) ? 'even-row' : 'odd-row';
                        ?>
                        <tr class="main-row <?= $rowClass ?>">
                            <td><?= $row[0] ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= $row[3] ?></td>
                            <td><?= $row[4] ?></td>
                            <td><?= $row[5] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


	<!-- popup Select Costomer-->
	<div id="popupSelect" class="popupSelect">
        <div class="popupSelect-content">
            
            <div class="popupSelect-header">
                <h5 class="left-align2">Select customer</h5>				
              
            </div>
 
                <div class="company-section">
				<select>
                    <option value="Company name" disabled selected>Customer name</option>
                    <option value="Company 1">Customer 1</option>
                   <option value="Company 2">Customer 2</option>
                    <!-- Other options here -->
                </select>
				</div>
         
            <div class="popupSelect-footer">
                <button class="popupApp-validate" onclick="closepopupSelect()";><i class="bi bi-check-lg"></i>&nbsp Apply</button>
            </div>
        </div>
    </div>
	
    <script src="js/readytoprint_dup.js"></script>
    


<script>


  //popup Select Customer Dictionary
  function closepopupSelect() {
    document.getElementById("popupSelect").style.display = "none";
}
</script>

    <link rel="stylesheet" href="css/footer_dup.css">
<div class="footer">
     <div class="pagination">
	 
	    <div class="table-controls">
                <label for="rows">Show</label>
                <select id="rows" name="rows" class="rows-select">
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

