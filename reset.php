<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 350px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus,
        .input-group select:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #e35f5e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        button:hover {
            background-color: #e23737;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="reset_password.php" method="post">
            <h2>Réinitialiser le mot de passe</h2>
            <div class="input-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="mail" required>
            </div>
            <div class="input-group">
                <label for="account-type">Type de compte :</label>
                <select id="account-type" name="account-type">
                    <option value="Ecole">École</option>
                    <option value="Entreprise">Entreprise</option>
                    <option value="User">Utilisateur</option>
                    <option value="Admin">Administrateur</option>
                </select>
            </div>
            <div class="input-group">
                <label for="new_password">Nouveau mot de passe :</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="reset_password">Réinitialiser le mot de passe</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifie si les champs ont été soumis et ne sont pas vides
            if (isset($_POST["mail"]) && isset($_POST["account-type"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {
                $email = $_POST["mail"];
                $role = $_POST["account-type"];
                $new_password = $_POST["new_password"];
                $confirm_password = $_POST["confirm_password"];

                // Vérifie si les mots de passe correspondent
                if ($new_password === $confirm_password) {
                    $file = $role . '.csv';

                    if (($handle = fopen($file, 'r')) !== false) {
                        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                            if ($data[2]  == $email) {
                                $ind = $data[0];
                                $nom = $data[1];
                                break;
                            }
                        }
                        fclose($handle);
                    }

                    //Copie les lignes du fichier dans un tableau
                    $tab_csv = array_map('str_getcsv', file($file));
                    unset($tab_csv[$ind]);

                    // Remplace la ligne à l'indice ind  par une nouvelle ligne contenant les mêmes données avec le nouveau mot de passe
                    $tab_csv = array_replace($tab_csv, array($ind => [$ind, $nom, $email, password_hash($new_password, PASSWORD_DEFAULT)]));

                    //Réécrit le contenu du fichier avec les données modifiées
                    $fp = fopen($file, 'w');
                    foreach ($tab_csv as $line) {
                        fputcsv($fp, $line);
                    }
                    fclose($fp);
                    echo "<p class='message' style='color:green'>Le mot de passe a été réinitialisé avec succès.</p>";

                    header('Location: login.php');
                } else {
                    echo "<p class='message' style='color:red'>Les mots de passe ne correspondent pas.</p>";
                }
            } else {
                echo "<p class='message'>Tous les champs sont obligatoires.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
