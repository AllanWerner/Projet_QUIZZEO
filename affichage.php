<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
    <style>
 
body{
    background-color: #efab23;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}
 
table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}
 
th, td {
    padding: 12px;
    text-align: center;
    box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 2);
}
 
th {
    background-color: #e35f5e;
    color: #fff;
}
 
td {
    background-color: #f8f9fa;
    color: #000;
    border: 1px solid #dee2e6;
}
 
td.nom {
    background-color: #ffc107;
    color: #000;
}
 
td.note {
    background-color: #28a745; /* Couleur de fond pour la note */
    color: #fff; /* Couleur du texte pour la note */
}
 
 
    </style>
</head>
<body>

<?php
 include 'header.php';
// Les fonctions ind_debut et ind_fin vont nous aider à parcourir le fichier csv 

function ind_debut($nb, $t) {
    return $nb * ($t + 1) ;
}

function ind_fin($nb, $t) {
    return $t + $nb*($t + 1);
}

// Cette fonction  va permettre de déterminer le pourcentage des occurences pour les quiz de satisfaction
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
    return [$result,$prop] ;
}

// Traitement des résultats du quiz  

    if ((isset($_POST['name'])) && (isset($_POST['type'])) ){
        $nom = $_POST['name'];
        $type = $_POST['type'];

        $file = "Player_".$nom.".csv";


        echo "<table>";

        if ($type == 'Ecole'){

            if(filesize($file) === 0){
                echo "Aucune réponse pour ce test.";
            }else{
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
        }

        elseif ($type == 'Entreprise'){

            $fichier_quiz = fopen('quiz.csv', 'r');

            $quiz_found = false;
            if ($fichier_quiz !== FALSE) {
                while (($data = fgetcsv($fichier_quiz, 1000, ",")) !== FALSE ) {
                   
                    $test_info = str_getcsv($data[0]); //  Transforme ma chaîne de caractères en tableau afin  d'y accéder plus facilement
                    if (($test_info[0] == $nom) && ($test_info[1] == $type)) {
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
            
            if(filesize($file) === 0){
                echo "Aucune réponse pour ce test.";
            }else{
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
                    echo "<td>".implode(", ",Pourcent($question[$k],$i + 1,$file))."</td>";
                }
     
            }
            }

        } 
        echo "</table>";   
    }

?>

</body>
</html>