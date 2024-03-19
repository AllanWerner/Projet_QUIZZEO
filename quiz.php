<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="quiz.css">
    <title>Document</title>
</head>
<body>
 
<?php
 
if(isset($_POST[ 'nbq'])  && isset($_POST['np'])) {
    $nbq=$_POST['nbq'];
    $np=$_POST['np'] ;
 
    echo "<form action='action.php?nbq=".$nbq."&np=".$np."' method='post'>";
 
    echo "<input type ='text' name = 'name_qcm'  placeholder= 'Intitulé du QCM '>";
    echo "<br><br>";
    echo "<input type ='number' name = 'duree'  placeholder= 'Durée du qcm en minutes '>"."<br>";
   
    for ($i = 1; $i <= $nbq; $i++)  {
        echo "<div>";
        echo "<input type ='text' name = 'q".$i."'  placeholder='Entrer la question " . $i . "'>" ."<br>";
        echo "<ul>";
        for ($j = 1; $j <= $np; $j++) {
            echo "<li><input type ='text' name = 'pq".$i."_".$j."' placeholder='Proposition " . $j . "'></li>" . '<br>';
            $j++;
        }
        echo "<input type ='text' name = 'rq".$i."'  placeholder='Entrer la bonne réponse'>" . '<br>';
        echo "<input type ='number' name = 'point".$i."'  placeholder='POINTS'>" . '<br>';
       
       
       
        echo  "</ul><br>";
        echo "</div>";
       
    }
}
echo "<input type='submit' name = 'Create_quiz' value='Terminer'>";
echo "</form>";
?>
 
 
   
 
</body>
</html>