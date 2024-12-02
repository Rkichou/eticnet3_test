
    <style>
        
        select, input[type="text"], input[type="Date"] {
            padding: 12px 20px;
            border: 1px solid #ccc;
            border-radius: 12px;
            font-size: 18px;
            color: #555;
        }

        input[type="text"] {
            width: 200px;
        }

        .export-btn {
            background-color: #FFA300;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .export-btn:hover {
            background-color: #ff8c00;
        }

        .label-text {
            font-weight: 500;
            margin-right: 8px;
        }

      
    </style>




<div class="export-container">
    <!-- Select for Status -->
    <select name="status">
        <option value="status" disabled selected>Status</option>
        <option value="completed">Completed</option>
        <option value="pending">Pending</option>
        <option value="cancelled">Cancelled</option>
    </select>

    <!-- From Date Input -->
    <span class="label-text">From</span>
    <input type="Date" placeholder="aaaa-mm-jj">

    <!-- To Date Input -->
    <span class="label-text">to</span>
    <input type="Date" placeholder="aaaa-mm-jj ">

    <!-- Download Button -->
    <button class="export-btn">Download Excel</button>
</div>


