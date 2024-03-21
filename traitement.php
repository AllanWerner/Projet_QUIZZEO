<?php

// Fonction pour vérifier si un utilisateur est banni
function isUserBanned($email, $role, $ban_file) {
    $user_found = false;

    if (($handle = fopen($ban_file, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            if ($data[0] == $email && ($data[1] == $role)) { // Utilisation de password_verify() 
                $user_found = true;
                break;
            }
        }
        fclose($handle);
    }

    return  $user_found;
}

if (isset($_POST['account-type'])){
    $type = $_POST['account-type'];
}else{
    print_r("errror");
}


#Choix du fichier à ouvrir en fonction du rôle
if($type == 'Ecole'){
 $file = "Ecole.csv";
}
 elseif($type == 'Entreprise'){
 $file = "Entreprise.csv";
 }
 elseif($type == 'User'){
 $file = "user.csv";
 }
 elseif($type == 'Admin'){
 $file = "admin.csv";
 }
 

#  A propos de la connexion  
if (isset($_GET['root']) && $_GET['root'] == 'login') {
    
    if (isset($_POST['mail']) && isset($_POST['password'])) {
        $email = $_POST['mail'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Utilisation de password_hash() pour crypter le mot de passe

        $user_found = false;
        $con_file = fopen("connexion.csv", "a");
        $ban_file = 'ban.csv';
        $ban = array_map('str_getcsv', file($ban_file));

        if(isUserBanned($email,$type, $ban_file)){
            fclose($con_file);
            header('Location: login.php?erreur=5');
        }

        # Parcourir le fichier correspondant pour trouver  l'utilisateur
        if (($handle = fopen($file, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                if ($data[2] == $email && password_verify($_POST['password'], $data[3])) { // Utilisation de password_verify() 
                    $user_found = true;
                    $user = $data[1];
                    break;
                }
            }
            fclose($handle);
        }

        # Si l'utilisateur est trouvé on lui crée une session et on récupère ses informations  redirige vers la page d'accueil sinon une erreur
        if ($user_found) {
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['role'] = $type;
            $_SESSION['mail'] = $_POST['mail'];
            fputcsv($con_file, [$_POST['mail'],$type]);
            fclose($con_file);
            header('Location: accueil.php');
            exit();
        } else {
            header('Location: login.php?erreur=1');
            exit();
        }
    }
}


// Captcha Authentification
if(!empty($_POST['g-recaptcha-response']) || isset($_POST['g-recaptcha-response'])) {
    $secret="6LfOg5gpAAAAAOuyBgzvJw4SxxEtwqOK0jhF0DJ5";
   
    $data=json_decode($response);
    if($data->success){
        echo"<h2>Données envoyés !";
    }
    else{
        echo"<h2>Essayez encore !";
    }
}


#  A propos de l'inscription

if (isset($_GET['root']) && $_GET['root'] == 'inscription') {
 
    $registre = fopen($file, 'a+');
    $ind = 0;

    if(filesize($file) !== 0){
        if ($file == 'admin.csv'){
            header('location: login.php?erreur=4');  // Pour éviter d'avoir plusieurs  admins  dans la base de fichiers
        }
        while($line = fgetcsv($registre) !== FALSE) {
            $ind++;      // pour récupérer l'indice du dernier  élément inséré dans le fichier
        }
    }

   
    $user = [strval($ind + 1),$_POST['name'],$_POST['mail'],password_hash($_POST['password'], PASSWORD_DEFAULT)];

    $found = false; // Variable pour indiquer si l'utilisateur est déjà enregistré

    if (($handle = fopen($file, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            if ($data[2] == $user[2]) {  // Vérifie si l'utilisateur est déjà enregistré
                $found = true;
                break; 
            }
        }
        fclose($handle);
    }

    if ($found) {
        header("Location: login.php?erreur=2");
    }else{
        fputcsv($registre,  [strval($ind + 1),$_POST['name'],$_POST['mail'],password_hash($_POST['password'], PASSWORD_DEFAULT)]);
    }


 
    session_start();
    $_SESSION['user'] = $_POST['name'];
    $_SESSION['role'] = $type;
    $_SESSION['mail'] = $_POST['mail'];

    $con_file = fopen("connexion.csv", "a");
    fputcsv($con_file, [$_POST['mail'],$type]);
    fclose($con_file);

    if ($type == "User") {

        $nomFichier = "MesQuiz_".$_SESSION['mail'].".csv";

    if (!file_exists($nomFichier)) {
        touch($nomFichier);
        echo "Le fichier a été créé avec succès !";
    } else {
        echo "Le fichier existe déjà.";
    }

    }
    fclose($registre);
    header('Location: accueil.php');
 
    exit(); 
}
else {
    print_r("error");
}
?>
