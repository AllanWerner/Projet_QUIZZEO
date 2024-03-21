<?php include 'header.php';?>
<?php
function User_dashboard($file,$role){
    echo "<h2>Comptes ".$role."</h2>";
    echo "<form method='post' action='ban.php?role=".$role."' >";
        echo "<table>";
           echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>Email</th>";
                echo "<th>Etat</th>";
                echo "<th>Statut</th>";
            echo "</tr>";
            
            $ban_file = 'ban.csv';
            
            $login_file = 'ONLINE.csv';
            

            // Vérification de l'existence du fichier d'utilisateurs
            if (($fichier = fopen($file, 'r')) !== FALSE) {
                while (($data = fgetcsv($fichier, 1000, ",")) !== FALSE ) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($data[1]) . "</td>"; // Nom de l'utilisateur
                    echo "<td>" . htmlspecialchars($data[2]) . "</td>"; // Email de l'utilisateur
                    echo "<td>";
                    $connected = FALSE;
                    if (($handle = fopen($login_file, 'r')) !== false) {
                        while (($line = fgetcsv($handle, 1000, ',')) !== false) {
                            if(($line[0] == $data[2]) && ($line[1] == $role)){
                                $connected = TRUE;
                                break;
                            }
                        }
                        fclose($handle);
                    }

                    if($connected){ 
                        echo "Connecté";
                    }else{
                        echo "Déconnecté";
                    }
                    echo "</td>";
                    // bouton pour bannir l'utilisateur
                    echo "<td>";
                    $banned = FALSE;
                    if (($handle = fopen($login_file, 'r')) !== false) {
                        while (($line = fgetcsv($handle, 1000, ',')) !== false) {
                            if(($line[0] == $data[2]) && ($line[1] == $role)){      
                                $banned = TRUE;
                                break;
                            }
                        }
                        fclose($handle);
                    }

                    if($banned){
                        echo "<input type='submit' name='". htmlspecialchars($data[2]) ."' value='Désactivé'> ";
                    }else{
                        echo "<input type='submit' name='". htmlspecialchars($data[2]) ."' value='Activé'> ";
                    }
                    echo "</td>";
                    
                    echo "</tr>";
                }
                fclose($fichier); // Fermeture du fichier
            }
            
        echo "</table>";
    echo "</form>";

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<?php

if (isset($_SESSION['user']) && isset($_SESSION['role']) && isset($_SESSION['mail']) ) {  
    $user = $_SESSION['user'] ;
    $role = $_SESSION['role'] ;
    $mail = $_SESSION['mail'] ;


    if ($role == 'Admin'){ 
        echo "Bienvenue administrateur ". $user;
        echo "<h1>Tableau de bord de l'administration</h1>";
        echo "<br>";
        User_dashboard('Ecole.csv','Ecole');
        echo "<br>";
        User_dashboard('Entreprise.csv','Entreprise');
        echo "<br>";
        User_dashboard('user.csv','User');
        echo "<br>";
    }
    else if($role == 'User'){
        echo "Bienvenue utilisateur ". $user;
    }
    else if($role == 'Ecole' || $role == 'Entreprise' ){
        echo "Bienvenue  ". $user ;
         
    }
    


echo "<form  action='start_quiz.php?name=machine' method='post'>";
echo "<input type= 'submit' value = 'Voir quiz'>";
echo "</form>";



} else{
    header("Location: login.php?erreur=3"); 
    exit();
}
    ?>


</body>
</html>