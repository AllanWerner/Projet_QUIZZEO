<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre titre ici</title>
    <link rel="stylesheet" href="Entreprise_quiz.css">
</head>
<body>

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
        $duree = $info_quiz[6];
       

        echo  "<form action='resultat.php?name=".$name_quiz."&nbq=".$nbq."&role_creator=".$role_creator."' method='post' >";
        
        echo "<h1> Intitulé du quiz : ".$info_quiz[0]."</h1>" ;
        echo "<div class='minuteur' id='minuteur'></div>";
       
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
        echo "<button id='startTimer' >Commencer</button>";
        echo "<input type = 'submit' class = 'submitBtn' value = 'Terminer'>";
        echo "</div>";

        echo "</form>";

    } else {
        echo 'Quiz non trouvé.';
    }
} 
?>

<script>
       
        const duree = <?php echo $duree * 60; ?>;    // Imprimer la valeur de la variable duree dans le script 
        
        const endTime = Date.now() + duree * 1000;   // Date de fin du minuteur en  millisecondes

        var startButton = document.getElementById('startTimer');
        var stopButton = document.querySelector('.submitBtn');

        // Fonction du minuteur 
        function updateMinuteur() {
            const currentTime = Date.now();
            const remainingTime = Math.max(0, endTime - currentTime);

            const minutes = Math.floor(remainingTime / 60000);
            const seconds = Math.floor((remainingTime % 60000) / 1000); 
            document.getElementById("minuteur").innerHTML = `Temps restant : ${minutes} minutes ${seconds} secondes`;

            if (seconds === 0 && minutes === 0) { 
                document.getElementById("minuteur").innerHTML = "Temps écoulé !";
                clearInterval(interval);  // Arrête le minuteur lorsque le temps est écoulé
                window.location.href = this.action;     // Redirige vers la page resultat.php après le temps imparti
            }
        }

        function startTimer() {
            const interval = setInterval(updateMinuteur, 1000);  // Affiche le résultat du minuteur toutes les secondes 
        }

        // Lance la fonction lorsque l'on clique sur le bouton  
        startButton.addEventListener('click', function() {
            startTimer();
            startButton.disabled = true;  // Désactiver le bouton une fois que le minuteur est démarré
            stopButton.style.display = 'block';  // Active le bouton de fin 
        });

        stopButton.addEventListener('click', function() {
            window.location.href = this.action;   // Redirige vers la page resultat.php
        });
    </script>

</body>
</html>