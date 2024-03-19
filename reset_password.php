<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <!--<link rel="stylesheet" href="reset.css">-->
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 400px;
    margin: 100px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

.input-group {
    margin-bottom: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
}

.input-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
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
            <div class="input-box">
                <select class="input-field" id="account-type" name="account-type">
                    <option value="Ecole">Ecole</option>
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
    </div>
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
                    $file = $role.'.csv';
                    
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
                    $tab_csv = array_map('str_getcsv',file($file));
                    unset($tab_csv[$ind]);
                    
                    // Remplace la ligne à l'indice ind  par une nouvelle ligne contenant les mêmes données avec le nouveau mot de passe 
                    $tab_csv = array_replace($tab_csv, array($ind => [$ind,$nom,$email,password_hash($new_password, PASSWORD_DEFAULT)]));
    
                    //Réécrit le contenu du fichier avec les données modifiées
                    $fp = fopen($file, 'w');
                    foreach ($tab_csv as $line) {
                        fputcsv($fp, $line);
                    }
                    fclose($fp);
                    echo "<p style='color:green '>mot de passe a bien été réinitialisé.</p>";
                    
                    header('Location: login.php');
                }else {
                    echo "<p style='color:red'>Les mots de passe ne correspondent pas.</p>";
                } 
            }else {
                echo "Tous les champs sont obligatoires.";
            }
    }
    
    
    ?>

</body>
</html>
