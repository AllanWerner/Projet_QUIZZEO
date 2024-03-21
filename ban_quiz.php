<?php
// Récupérer l'action du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_GET['creator'])){
        $creator = $_GET['creator'];
    }

    foreach ($_POST as $key => $value) {
        // Vérifier si l'utilisateur est banni ou non
        $ban_file = 'ban_quiz.csv';
        $ban = array_map('str_getcsv', file($ban_file));
        $is_banned = FALSE;
        foreach ($ban as $banish) {
            if ($banish[0] == $key) {
                $is_banned = TRUE;
                break;
            }
        }

        // Si l'utilisateur est banni, le débannir
        if ($is_banned) {
            // Supprimer l'utilisateur du fichier de bannissement
            $ban_file_contents = file($ban_file);
            $new_contents = [];
            foreach ($ban_file_contents as $line) {
                $line_data = str_getcsv($line);
                if ($line_data[0] != $key) {
                    $new_contents[] = $line;
                }
            }
            file_put_contents($ban_file, implode("", $new_contents));
            echo "L'utilisateur $key a été débanni.";
        } else {
            // Sinon, le désactiver
            // Ajouter le quiz au fichier
            $ban_entry = "$key,$creator\n"; // Créer une nouvelle entrée CSV
            file_put_contents($ban_file, $ban_entry, FILE_APPEND); // Ajouter l'entrée au fichier
            echo "L'utilisateur $key a été banni.";
        }
    }
    header('Location: test1.php'); // Rediriger l'utilisateur après le traitement
}
?>
