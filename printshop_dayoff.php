<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Day Off Form</title>
    <style>


        .dayoff-container {
            width: 90%;
            max-width: 1000px;
			margin-top: 7%;
			margin-left: 18%;
        }

        .dayoff-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .dayoff-row label {
            margin-right: 10px;
			font-weight: bold;
			font-size: 18px;
			margin-top: -1.5%;
        }

        input[type="date"],
        input[type="text"] {
            padding: 12px 20px;
            border: 1px solid #ccc;
            border-radius: 12px;
            font-size: 18px;
            color: #555;
        }

        input[type="text"] {
            width: 200px;
        }

        .add-dayoff {
            color: #000;
            cursor: pointer;
            margin-top: 10px;
            font-size: 14px;
            display: inline-block;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .actions button {
            border: none;
            padding: 4px 12px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 6px;
        }

        .cancel-btn {
            background-color: #555555;
            color: #fff;
            margin-right: 10px;
        }

        .validate-btn {
            background-color: #59A735;
            color: #fff;
        }

        .validate-btn i {
            margin-right: 5px;
        }

        .cancel-btn i {
            margin-right: 5px;
        }
        .validate-btn:hover, .cancel-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="dayoff-container">
    <!-- First Row -->
    <div class="dayoff-row">
        <label>From</label>
        <input type="Date"  placeholder="aaaa-mm-jj">
        <label>to</label>
        <input type="Date" placeholder="aaaa-mm-jj">
        <input type="text" placeholder="Justification">
    </div>

    <!-- Second Row -->
    <div class="dayoff-row">
        <label>From</label>
                <input type="Date" placeholder="aaaa-mm-jj">
        <label>to</label>
                <input type="Date" placeholder="aaaa-mm-jj">
        <input type="text" placeholder="Justification">
    </div>

    <!-- Third Row -->
    <div class="dayoff-row">
        <label>From</label>
        <input type="Date"  placeholder="aaaa-mm-jj">
        <label>to</label>
        <input type="Date" placeholder="aaaa-mm-jj">
        <input type="text" placeholder="Justification">
    </div>

    <!-- Add Day Off Button -->
    <span class="add-dayoff"><i class="bi bi-plus"></i> Add day off</span>

    <!-- Action Buttons -->
    <div class="actions">
        <button class="cancel-btn"><i class="bi bi-x"></i> Cancel</button>
        <button class="validate-btn"><i class="bi bi-check"></i> Validate</button>
    </div>
	<br><br><br>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Initialisation de Flatpickr sur les champs de date
    flatpickr("#from-date", {
        dateFormat: "Y-m-d",
        defaultDate: "aaaa-mm-jj",
        minDate: "2023-01-01",
        maxDate: "2024-12-31",
        locale: {
            firstDayOfWeek: 1  // La semaine commence par lundi
        }
    });

    flatpickr("#to-date", {
        dateFormat: "Y-m-d",
        defaultDate: "aaaa-mm-jj",
        minDate: "2023-01-01",
        maxDate: "2024-12-31",
        locale: {
            firstDayOfWeek: 1  // La semaine commence par lundi
        }
    });
</script>

</body>
</html>
