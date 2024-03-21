<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="reset.css">
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
