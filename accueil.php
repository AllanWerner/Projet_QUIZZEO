<?php include 'header.php';?>
<?php

//Déclaration des fonctions d'affichage des dashboard 

function Quiz_Dashboard($file){
    echo "<h2>Les QUIZ</h2>";
    
        echo "<table>";
           echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>Compte</th>";
                echo "<th>Créateur</th>";
                echo "<th>Statut</th>";
                echo "<th>Etat</th>";
            echo "</tr>";
            
            $ban_file = 'ban_quiz.csv';
            

            if (($fichier = fopen($file, 'r')) !== FALSE) {
                while (($data = fgetcsv($fichier, 1000, ",")) !== FALSE ) {
                    $info_quiz = str_getcsv($data[0]);
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($info_quiz[0]) . "</td>"; // Nom du quiz
                    echo "<td>" . htmlspecialchars($info_quiz[1]) . "</td>"; // Type de compte du créateur
                    echo "<td>" . htmlspecialchars($info_quiz[2]) . "</td>"; // Email du créateur
                    echo "<td>" . htmlspecialchars($info_quiz[7]) . "</td>"; // Statut du quiz 

                    // bouton pour désactiver un quiz
                    echo "<td>";
                    
                    echo "<form method='post' action='ban_quiz.php' >";
                        echo "<input type='hidden' name='quiz_name' value='{$info_quiz[0]}'>";
                        echo "<input type='hidden' name='creator' value='{$info_quiz[1]}'>";
                        echo "<input type='hidden' name='action_quiz' value='" . ($info_quiz[7] == 'activé' ? 'Désactiver' : 'Activer') . "'>";
                        echo "<input type='submit' value='" . ($info_quiz[7] == 'active' ? 'Désactiver' : 'Activer') . "'>";
                    echo "</form>";
                    echo "</td>";

                    echo "</tr>";
                }
                fclose($fichier); // Fermeture du fichier
            }
            
        echo "</table>";

}


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

function Role_dashboard($file,$role,$mail){
    echo "<h2>Mes QUIZ</h2>";
    
        echo "<table>";
           echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>Lien</th>";
                echo "<th>Nombre de questions</th>";
                echo "<th>Durée</th>";
                echo "<th>Résultats</th>";
            echo "</tr>";


            if (($fichier = fopen($file, 'r')) !== FALSE) {
                while (($data = fgetcsv($fichier, 1000, ",")) !== FALSE ) {
                    $info_quiz = str_getcsv($data[0]);
                    if(($role == $info_quiz[0]) && ($mail == $info_quiz[2])){
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($info_quiz[0]) . "</td>"; // Nom du quiz
                        echo "<td>" . htmlspecialchars($info_quiz[3]) . "</td>"; // Lien
                        echo "<td>" . htmlspecialchars($info_quiz[4]) . "</td>"; // Nombre de questions
                        echo "<td>" . htmlspecialchars($info_quiz[6]) . "</td>"; // Durée du quiz 
                        echo "<td>";
                        echo "<form method='post' action='affichage.php' >";
                        echo "<input type='hidden' name='name' value='".$info_quiz[0]."'>";
                        echo "<input type='hidden' name='type' value='".$info_quiz[1]."'>";
                        echo "<input type='submit'  value='Voir '> ";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
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
        Quiz_Dashboard('quiz.csv');
    }
    else if($role == 'Ecole' || $role == 'Entreprise' ){
        echo "Bienvenue  ". $user ;
        Role_dashboard('quiz.csv',$role, $mail);     
    }
    else if($role == 'User'){
        echo "Bienvenue utilisateur ". $user;

        echo "<h2>Mes QUIZ</h2>";
    
        echo "<table>";
           echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>Type</th>";
            echo  "</tr>";
        
        $file = fopen('MesQuiz_'.$mail.'.csv', "r");
        if($file !== false){
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE ) {
                echo "<tr>";
                        echo "<td>" . htmlspecialchars($data[0]) . "</td>"; 
                        echo "<td>" . htmlspecialchars($data[1]) . "</td>"; 
                echo   "</tr>";
            }
            fclose($file);
        }

        echo "<form  action='Entreprise_quiz.php?name=Sondage' method='post'>";
        echo "<input type= 'submit' value = 'Voir quiz'>";
        echo "</form>";

    }
    






} else{
    header("Location: login.php?erreur=3"); 
    exit();
}
    ?>


</body>
</html>