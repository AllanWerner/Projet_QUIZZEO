<?php
// Récupérer l'action du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if((isset($_GET['name'])) && (isset($_GET['mail'])) ){
        $name = $_GET['name'];
        $mail = $_GET['mail'];
    }

        // Vérifier si le quiz est désactiver ou non
        $ban_file = 'ban_quiz.csv';
        $ban = array_map('str_getcsv', file($ban_file));
        $is_banned = FALSE;
        foreach ($ban as $banish) {
            if ($banish[1] == $mail) { // Utiliser $mail  pour l'email de l'utilisateur
                $is_banned = TRUE;
                break;
            }
        }

        // Si le quiz est désactivé, l'activer
        if ($is_banned) {
            // Supprimer le quiz du fichier de bannissement
            $ban_file_contents = file($ban_file);
            $new_contents = [];
            foreach ($ban_file_contents as $line) {
                $line_data = str_getcsv($line);
                if ($line_data[1] != $mail) { // Utiliser $mail  pour l'email de l'utilisateur
                    $new_contents[] = $line;
                }
            }
            file_put_contents($ban_file, implode("", $new_contents));
            echo "L'utilisateur $mail a été débanni."; // Utiliser $mail  pour l'email de l'utilisateur
        } else {
            // Sinon, le bannir
            // Ajouter l'utilisateur au fichier de bannissement
            $ban_entry = "$name,$mail\n"; // Utiliser $mail  pour l'email de l'utilisateur
            file_put_contents($ban_file, $ban_entry, FILE_APPEND); // Ajouter l'entrée au fichier
            echo "L'utilisateur $mail a été banni."; // Utiliser $mail  pour l'email de l'utilisateur
        }

    header('Location: accueil.php'); // Rediriger l'utilisateur après le traitement
    exit;
}
?>
