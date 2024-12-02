
<div class="exportForm">
    <h2>Select integration date</h2>
    <label for="date">FROM </label>
    <input type="date" id="dateFrom" name="date" value="">
    <label for="date">TO</label>
    <input type="date" id="dateTo" name="date" value="">
    <button onclick="exportFile()">GENERATE FILE</button> 

</div>
<div id="loadingMessage" style="display: none;">
    <p><img class="loading" src="/images/loading.gif">
    Generating file, please wait...</p>
</div>
<div class="content"></div>

