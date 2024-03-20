<?php
session_start();

// Les fonctions ind_debut et ind_fin vont nous aider à parcourir le fichier csv 

function ind_debut($nb, $t) {
    return $nb * ($t + 1) ;
}

function ind_fin($nb, $t) {
    return $t + $nb*($t + 1);
}

if (isset($_GET['name'])) {


    $name_quiz = $_GET['name'];
    $file = 'quiz.csv';
    $quiz_found = false;

    if (($handle = fopen($file, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $test_info = str_getcsv($data[0]); //  Transforme ma chaîne de caractères en tableau afin  d'y accéder plus facilement

            if ($test_info[0] == $name_quiz) {
                $quiz_found = true;   
                $quiz = $data;     //Récupère la ligne csv correspondant au quiz 
                break;
            }
        }
        fclose($handle);
    }

    if ($quiz_found) {
        // Convertir la ligne CSV en tableau
        $info_quiz = str_getcsv($quiz[0]);
        $contenu = str_getcsv($quiz[1]);
        $role_creator =  $info_quiz[1];

        $nbq = $info_quiz[4];
        $np = $info_quiz[5];
       
        echo  "<form action='resultat.php?name=".$name_quiz."&nbq=".$nbq."&role_creator=".$role_creator."' method='post' >";
        
        echo "<h1> Intitulé du quiz : ".$info_quiz[0]."</h1>" ;
       
        for ($i = 0; $i < $nbq; $i++) {  // Crée une div à chaque itération pour  afficher le contenu de chaque question
            $question = array();
            $debut_question = ind_debut($i, $np) ;
            $fin_question = ind_fin($i, $np);
            
            for ($j = $debut_question; $j <= $fin_question; $j++) {   // Récupère à chaque itération  une question et ses propositions
                $question[] = $contenu[$j];
            }

            
            echo "<div>";
            echo "Question n°" . ($i + 1) . " : " . $question[0] . "<br />";
            for ($k = 1; $k <= $np; $k++) {
                echo "<label>";
                echo "<input type='radio' name='q".($i + 1)."' value='" . $question[$k] . "'>" . $question[$k] . "<br />";
                echo "</label><br />";
            }
            echo "</div>";
 
        }

        echo "<div>";
        echo "<input type = 'submit' class = 'submitBtn' value = 'Terminer'>";
        echo "</div>";

        echo "</form>";

    } else {
        echo 'Quiz non trouvé.';
    }
} 
?>