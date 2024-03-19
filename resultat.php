<?php
session_start();
$user = $_SESSION['user'] ;
$role = $_SESSION['role'] ;
$mail = $_SESSION['mail'] ;


if (isset($_GET['name']) && isset($_GET['nbq'])) {
    $name_quiz = $_GET['name'];
    $nbq = intval($_GET['nbq']);

    $reponses_quiz = fopen("answer_".$name_quiz.".csv", "r");

    if ($reponses_quiz !== false) {

        $total = 0;
        $correct = 0;

        for ($i = 1; $i <= $nbq; $i++ ){
            while (($data = fgetcsv($reponses_quiz, 1000, ',')) !== false) {
                $total = $total + intval($data[2]);
                if($_POST["q".$i.""] == $data[1]){
                    $correct = $correct + intval($data[2]);
                    break;
                }
            }
        }
        fclose($reponses_quiz);

        $joueur_quiz = fopen("Player_".$name_quiz.".csv", "a+");
        fputcsv($joueur_quiz,[$user,$correct."/".$total]);
        fclose($joueur_quiz);

        echo $user." Vous avez obtenu :".$correct."/".$total;
    }
    else {
        echo "not found";
        exit();
    }
}


?>