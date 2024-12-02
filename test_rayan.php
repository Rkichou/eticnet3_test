<?php
include('config.inc.php');

// Requête pour récupérer les informations de tous les utilisateurs
$userQuery = "SELECT * FROM users";
$userResult = mysqli_query($con, $userQuery);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .user-container {
            margin-bottom: 40px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .general-info, .contacts-section, .adresses-section {
            width: 32%;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }

        .section-header button {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        .actions button {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .actions .edit-btn {
            color: #4CAF50;
            font-size: 16px;
        }

        .actions .delete-btn {
            color: #f44336;
            font-size: 16px;
        }

        .actions .delete-btn:hover, 
        .actions .edit-btn:hover {
            color: #333;
        }

        .user-row {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #FFFFFF;
            cursor: pointer;
            align-items: center;
        
        }

        .user-row:hover {
            background-color: #eee;
        }

        .user-row div {
            flex: 1;
            text-align: center;
        }

        .details {
            display: none;
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            margin-top: 5px;
            border-radius: 5px;
        }

    </style>
</head>
<body>
<h1>Informations Utilisateurs</h1>

<?php while ($userData = mysqli_fetch_assoc($userResult)): ?>
<div class="user-row" data-user-id="<?php echo $userData['id']; ?>">
    <div>ID: <?php echo $userData['id']; ?></div>
    <div>Login: <?php echo $userData['login']; ?></div>
    <div>Password: *********</div>
    <div>Company: <?php echo $userData['printshop']; ?></div>
    <div>
        <span class="role-label"><?php echo $userData['role']; ?></span>
    </div>
    <div class="actions">
        <button class="edit-btn">✎</button>
        <button class="delete-btn">🗑️</button>
    </div>
</div>

<!-- Details section (hidden by default) -->
<div class="details" id="details-<?php echo $userData['id']; ?>">
    <h3>Détails pour l'utilisateur ID: <?php echo $userData['id']; ?></h3>

    <div class="user-container">
        <div class="container">
            <!-- Section Informations Générales -->
            <div class="general-info">
                <div class="section-header">
                    <h2>General informations (Utilisateur ID: <?php echo $userData['id']; ?>)</h2>
                </div>
                <form>
                    <label for="login">Login</label>
                    <input type="text" id="login" value="<?php echo $userData['login']; ?>" readonly>

                    <label for="password">Password</label>
                    <input type="password" id="password" value="************" readonly>

                    <label for="email">Email</label>
                    <input type="email" id="email" value="<?php echo $userData['user_email']; ?>" readonly>

                    <label for="username">Username</label>
                    <input type="text" id="username" value="<?php echo $userData['user_name']; ?>" readonly>

                    <label for="role">Role</label>
                    <select id="role" disabled>
                        <option><?php echo $userData['role']; ?></option>
                    </select>

                    <label for="printshop">Prints</label>
                    <select id="printshop" disabled>
                        <option><?php echo $userData['printshop']; ?></option>
                    </select>
                </form>
            </div>

            <!-- Section Contacts -->
            <div class="contacts-section">
                <div class="section-header">
                    <h2>Contact</h2>
                    <button>+</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>login</th>
                            <th>name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Requête pour récupérer les contacts de l'utilisateur
                        $contactsQuery = "SELECT * FROM users_contacts WHERE id_user = " . $userData['id'];
                        $contactsResult = mysqli_query($con, $contactsQuery);
                        while ($contact = mysqli_fetch_assoc($contactsResult)): ?>
                        <tr>
                            
                            <td><?php echo $contact['login']; ?></td>
                            <td><?php echo $contact['contact_name']; ?></td>
                            <td><?php echo $contact['contact_email']; ?></td>
                            <td class="actions">
                                <button class="edit-btn">✎</button>
                                <button class="delete-btn">🗑️</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Section Adresses -->
            <div class="adresses-section">
                <div class="section-header">
                    <h2>Address</h2>
                    <button>+</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Address name</th>
                            <th>Supp code</th>
                            <th>Company</th>
                            <th>Country</th>
                            <th>Contact</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Requête pour récupérer les adresses de l'utilisateur
                        $adressesQuery = "SELECT * FROM users_adresses WHERE id_user = " . $userData['id'];
                        $adressesResult = mysqli_query($con, $adressesQuery);
                        while ($adress = mysqli_fetch_assoc($adressesResult)): ?>
                        <tr>
                            <td><?php echo $adress['adresse_name']; ?></td>
                            <td><?php echo $adress['code_supplier']; ?></td>
                            <td><?php echo $adress['company_name']; ?></td>
                            <td><?php echo $adress['country']; ?></td>
                            <td><?php echo $adress['contact']; ?></td>
                            <td><?php echo $adress['telephone']; ?></td>
                            <td class="actions">
                                <button class="edit-btn">✎</button>
                                <button class="delete-btn">🗑️</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>
<script>
    // Script to handle row click and toggle display of details
    document.querySelectorAll('.user-row').forEach(row => {
        row.addEventListener('click', function() {
            var userId = this.getAttribute('data-user-id');
            var details = document.getElementById('details-' + userId);
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block"; // Show details
            } else {
                details.style.display = "none"; // Hide details
            }
        });
    });
</script>

</body>
</html>

<?php
// Fermer la connexion à la base de données
mysqli_close($con);
?>
