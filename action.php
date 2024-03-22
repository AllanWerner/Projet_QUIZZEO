<?php
session_start();

$role = $_SESSION['role'] ;
$mail = $_SESSION['mail'] ;


# Stockage  des quiz 


if (isset($_POST['Create_quiz'])) {


    $file = fopen('quiz.csv', 'a+');

    if(isset($_GET[ 'nbq'])  && isset($_GET['np'])) {
        $nbq=$_GET['nbq'];
        $np=$_GET['np'] ;
    
        $nom = $_POST['name_qcm'];
        $lien = "http://localhost/PHP/Projet/Quizzeo/start_quiz.php?name=".$nom;
        $contenu = array();
        $quiz = array();
        $time = $_POST['duree'];
        $info_quiz = [$nom,$role,$mail,$lien,$nbq,$np,$time,"En cours"]; 

        if ($role  == "Ecole"){
            
        
            for ($i = 1; $i <= $nbq; $i++) {
                $info_ques = array();  
                $propositions = array();

                $question = $_POST["q".$i]; // Récupère la question depuis le formulaire 

                for ($j = 1; $j <= $np; $j++) {
                    $prop = $_POST["pq".$i."_".$j]; // Récupère les propositions depuis le formulaire
                    array_push($propositions, $prop);
                }

                array_push($propositions, $_POST["rq".$i]);  // Récupère la réponse depuis le formulaire
                array_push($propositions, $_POST["point".$i]);  // Récupère la valeur de la question depuis le formulaire
                array_push($info_ques, $question);

                foreach ($propositions as $prop) {
                    array_push($info_ques, $prop);
                }

                array_push($contenu, implode(", ",$info_ques));    // Transforme le tableau $info_ques en chaîne pour être inséré dans le CSV
            }

            array_push( $quiz,implode(",",$info_quiz ));    // Transforme le tableau $info_quiz en chaîne pour être inséré dans le CSV
            array_push( $quiz,implode(",",$contenu ));      // Transforme le tableau $contenu en chaîne pour être inséré dans le CSV
            fputcsv($file,$quiz);                            // Insère le tableau dans le fichier csv
            fclose($file); // Fermez le fichier 

        }

        elseif( $role=="Entreprise" ){
          
        
            for ($i = 1; $i <= $nbq; $i++) {
                $info_ques = array();  
                $propositions = array();

                $question = $_POST["q".$i]; // Récupère la question depuis le formulaire 

                for ($j = 1; $j <= $np; $j++) {
                    $prop = $_POST["pq".$i."_".$j]; // Récupère les propositions depuis le formulaire
                    array_push($propositions, $prop);
                }
                
                array_push($info_ques, $question);

                foreach ($propositions as $prop) {
                    array_push($info_ques, $prop);
                }

                array_push($contenu, implode(", ",$info_ques));    // Transforme le tableau $info_ques en chaîne pour être inséré dans le CSV
            }

            array_push( $quiz,implode(", ",$info_quiz ));    // Transforme le tableau $info_quiz en chaîne pour être inséré dans le CSV
            array_push( $quiz,implode(", ",$contenu ));      // Transforme le tableau $contenu en chaîne pour être inséré dans le CSV
            fputcsv($file,$quiz);                            // Insère le tableau dans le fichier csv
            fclose($file); // Fermez le fichier
        }
        
    }

    //Création du fichier  CSV pour stocker l'historique des participants au quiz 
    $nomFichier = "Player_".$nom.".csv";

    if (!file_exists($nomFichier)) {
        touch($nomFichier);
        echo "Le fichier a été créé avec succès !";
    } else {
        echo "Le fichier existe déjà.";
    }
    header('location: accueil.php');   // Redirige vers la page d'accueil une fois le  quizz créé

}
?>
