<?php

// Les fonctions ind_debut et ind_fin vont nous aider à parcourir le fichier csv 

function ind_debut($nb, $t) {
    return $nb * ($t + 1) ;
}

function ind_fin($nb, $t) {
    return $t + $nb*($t + 1);
}


function Pourcent($prop,$ind_ques,$file){

    $count = 0;
    $taille = 0;

    if (($fichier = fopen($file, 'r')) !== FALSE) {
        while (($data = fgetcsv($fichier, 1000, ",")) !== FALSE ) {
            $taille++;
            if ($prop == $data[$ind_ques]){
            $count++;
            }

        }
    
        fclose($fichier);
    }
    
    $result = ($count/$taille) * 100;
    return $result  ;
}



    if ((isset($_GET['name'])) && (isset($_GET['type'])) ){
        $nom = $_GET['name'];
        $type = $_GET['type'];

        $file = "Player_".$nom.".csv";

        echo "<table>";

        if ($type = 'Ecole'){
           
           echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>note</th>";
            echo "</tr>";

            if (($fichier = fopen($file, 'r')) !== FALSE) {
                while (($data = fgetcsv($fichier, 1000, ",")) !== FALSE ) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($data[0]) . "</td>"; 
                    echo "<td>" . htmlspecialchars($data[1]) . "</td>"; 
                    echo "</tr>";
                }
                fclose($fichier);
            }
        }

        elseif ($type = 'Entreprise'){

            $fichier_quiz = fopen('quiz.csv', 'r');

            $quiz_found = false;
            if ($fichier_quiz !== FALSE) {
                while (($data = fgetcsv($fichier_quiz, 1000, ",")) !== FALSE ) {
                   
                    $test_info = str_getcsv($data[0]); //  Transforme ma chaîne de caractères en tableau afin  d'y accéder plus facilement
                    if ($test_info[0] == $nom) {
                        $quiz_found = true;   
                        $quiz = $data;     //Récupère la ligne csv correspondant au quiz 
                        break;
                    }
                }
                fclose($fichier_quiz);
            }

            if ($quiz_found) {
                // Convertir la ligne CSV en tableau
                $info_quiz = str_getcsv($quiz[0]);
                $contenu = str_getcsv($quiz[1]);
                $role_creator =  $info_quiz[1];
        
                $nbq = $info_quiz[4];
                $np = $info_quiz[5];
            }   
            
            echo "<tr>";
                 echo "<th>Question</th>";
                 
                for($i = 1; $i <= $np; $i++){
                     echo "<th>P".$i."</th>";
                }    
            echo "</tr>";

            for ($i = 0; $i < $nbq; $i++) {  
                $question = array();
                $debut_question = ind_debut($i, $np) ;
                $fin_question = ind_fin($i, $np);
                
                for ($j = $debut_question; $j <= $fin_question; $j++) {   
                    $question[] = $contenu[$j];
                }
    
                
                echo "<tr>";
                echo "<td>".$question[0]."</td>";
                for ($k = 1; $k <= $np; $k++) {
                    echo "<td>".Pourcent($question[$k],$i,$file)."</td>";
                }
     
            }
        } 
        echo "</table>";   
    }

 

?>