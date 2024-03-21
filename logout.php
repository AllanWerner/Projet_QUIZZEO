<?php 
session_start();
        // Récupérer les infos de l'utilisateur
        $mail = $_SESSION['mail'];
        $role = $_SESSION['role'];
        
        // Chemin vers le fichier CSV
        $file_path = "connexion.csv";
        
        // Lire le contenu du fichier CSV dans un tableau
        $users_online = array_map('str_getcsv', file($file_path));
        
        // Parcourir le tableau pour trouver et supprimer l'identifiant de l'utilisateur
        foreach ($users_online as $key => $user) {
            if (($user[0] == $mail) && ($user[1] == $role)  ){
                unset($users_online[$key]);
            }
        }
        
        // Réécrire le contenu mis à jour dans le fichier CSV
        $file = fopen($file_path, 'w');
        foreach ($users_online as $user) {
            fputcsv($file, $user);
        }
        fclose($file);
session_destroy();
header( 'location: index.php' ) ;
?>