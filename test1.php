<?php
function Quiz_Dashboard($file){
    echo "<h2>Les QUIZ</h2>";
    
        echo "<table>";
           echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>Compte</th>";
                echo "<th>Créateur</th>";
                echo "<th>Statut</th>";
                echo "<th>Etat</th>";
                echo "<th>Résultats</th>";
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
                    $banned = FALSE;
                    if (($handle = fopen($ban_file, 'r')) !== false) {
                        while (($line = fgetcsv($handle, 1000, ',')) !== false) {
                            if(($line[0] == $info_quiz[0]) && ($line[1] == $info_quiz[2])){ 
                                $creator =  $info_quiz[2];
                                $banned = TRUE;
                                break;
                            }
                        }
                        fclose($handle);
                    }

                    echo "<form method='post' action='ban_quiz.php' >";
                    if($banned){
                        echo "<input type='submit' name='". htmlspecialchars($info_quiz[0]) ."' value='Désactivé'> ";
                    }else{
                        echo "<input type='submit' name='". htmlspecialchars($info_quiz[0]) ."' value='Activé'> ";
                    }
                    echo "</td>";
                    echo "</form>";

                    echo "<td>";
                    echo "<form method='post' action='affichage.php?name=".$info_quiz[0]."&type=".$info_quiz[1]."' >";
                    echo "<input type='submit' name='quiz' value='Voir '> ";
                    echo "</form>";
                    echo "</td>";

                    echo "</tr>";
                }
                fclose($fichier); // Fermeture du fichier
            }
            
        echo "</table>";

}

Quiz_Dashboard('quiz.csv');

?>