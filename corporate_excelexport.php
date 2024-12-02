<link rel="stylesheet" href="css/corporate_excelexport.css">
<div class="export-container">
    <!-- Select for Status -->
     <h1>Select integration date</h1>
<div class="exportForm">
    <!-- From Date Input -->
    <span class="label-text">From</span>
    <input type="Date" id="dateFrom" placeholder="aaaa-mm-jj">

    <!-- To Date Input -->
    <span class="label-text">to</span>
    <input type="Date" id="dateTo" placeholder="aaaa-mm-jj ">

    <!-- Download Button -->
    <button class="export-btn" onclick="exportFile()">Download Excel</button>
</div>
<div id="loadingMessage" style="display: none;">
        <p><img class="loading" src="/images/loading.gif">
        Generating file, please wait...</p>
    </div>
    <div class="content"></div>
    <div id="errorMessage" class="errorMessage"></div>
</div>



