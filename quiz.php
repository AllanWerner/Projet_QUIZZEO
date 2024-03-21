
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création Quiz</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
 
<?php
session_start();

$role = $_SESSION['role'] ;


// Vérifie si les champs ont été remplis puis récupère les valeurs et crée un formulaire sur la base  de ces données
if(isset($_POST[ 'nbq'])  && isset($_POST['np'])) {
    $nbq=$_POST['nbq'];
    $np=$_POST['np'] ;

    // Formulaire de création du quiz adapté en fonction du type de compte qui le crée 

    echo "<form action='action.php?nbq=".$nbq."&np=".$np."' method='post'>";
    if ($role  == "Ecole"){

        echo "<input type ='text' name = 'name_qcm'  placeholder= 'Intitulé du qcm '>";
        echo "<br><br>";
        echo "<input type ='number' name = 'duree'  placeholder= 'Durée du qcm en minutes '>"."<br>";
        
        // A chaque itération une div sera créée avec des zones de texte respectivement pour la question, les propsitions, la réponse et la valeur de la question
        for ($i = 1; $i <= $nbq; $i++)  {
            echo "<div>";
            echo "<input type ='text' name = 'q".$i."'  placeholder='Entrer la question " . $i . "'>" ."<br>";
            echo "<ul>";
            for ($j = 1; $j <= $np; $j++) {
                echo "<li><input type ='text' name = 'pq".$i."_".$j."' placeholder='Proposition " . $j . "'></li>" . '<br>';
            }
            echo "<input type ='text' name = 'rq".$i."'  placeholder='Entrer la bonne réponse'>" . '<br>';
            echo "<input type ='number' name = 'point".$i."'  placeholder='POINTS'>" . '<br>';
            
            echo  "</ul><br>";
            echo "</div>";
            
        }
    
    }
    elseif($role=="Entreprise"){
        

        echo "<input type ='text' name = 'name_qcm'  placeholder= 'Intitulé du qcm '>";
        echo "<br></br>";
        echo "<input type ='number' name = 'duree'  placeholder= 'Durée du qcm en minutes '>"."<br>";
    
        
        // A chaque itération une div sera créée avec des zones de texte respectivement pour la question et  les propsitions
        for ($i = 1; $i <= $nbq; $i++)  {
            echo "<div>";
            echo "<input type ='text' name = 'q".$i."'  placeholder='Entrer la question " . $i . "'>" ."<br>";
          
            echo "<ul>";
            for ($j = 1; $j <= $np; $j++) {
                echo "<li><input type ='text' name = 'pq".$i."_".$j."' placeholder='Proposition " . $j . "'></li>" . '<br>';
            }
            
            echo  "</ul><br>";
            echo "</div>";
            
        }
    }

echo "<input type='submit' name = 'Create_quiz' value='Terminer'>";
echo "</form>";
} 
?>

 
    

</body>
</html>