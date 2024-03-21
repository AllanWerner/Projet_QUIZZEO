<?php
// Récupérer l'action du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if((isset($_POST['creator'])) && (isset($_POST['quiz_name'])) && (isset($_POST['action_quiz']))) {
        $creator = $_POST['creator'];
        $name = $_POST['quiz_name'];
        $action = $_POST['action_quiz'];

        $ban_file = 'ban_quiz.csv';
        
        // Si l'action est d'activer le quiz
        if ($action == 'Activer') {
            // Supprimer l'utilisateur du fichier de bannissement
            $ban_file_contents = file($ban_file);
            $new_contents = [];
            foreach ($ban_file_contents as $line) {
                $line_data = str_getcsv($line);
                if ($line_data[0] != $name) { // Assurez-vous que la clé correspond au nom du quiz
                    $new_contents[] = $line;
                }
            }
            file_put_contents($ban_file, implode("", $new_contents));
            
        } else {
            // Sinon, le désactiver
            // Ajouter le quiz au fichier
            $ban_entry = [$name, $creator]; // Créer une nouvelle entrée CSV
            $ban_entry_formatted = implode(",", $ban_entry) . "\n"; // Formater l'entrée pour le fichier CSV
            file_put_contents($ban_file, $ban_entry_formatted, FILE_APPEND); // Ajouter l'entrée au fichier
        }
    }
    
    header('Location: accueil.php'); // Rediriger l'utilisateur après le traitement
}
?>
