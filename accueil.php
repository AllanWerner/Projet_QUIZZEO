<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<?php

if (isset($_SESSION['user']) && isset($_SESSION['role']) && isset($_SESSION['mail']) ) {  
    $user = $_SESSION['user'] ;
    $role = $_SESSION['role'] ;
    $mail = $_SESSION['mail'] ;



    if ($role == 'Admin'){ 
        echo "Bienvenue administrateur ". $user;
    }
    else if($role == 'User'){
        echo "Bienvenue utilisateur ". $user;
    }
    else if($role == 'Ecole' || $role == 'Entreprise' ){
        echo "Bienvenue  ". $user ;
         
    }
    


echo "<form  action='start_quiz.php?name=machine' method='post'>";
echo "<input type= 'submit' value = 'Voir quiz'>";
echo "</form>";



} else{
    header("Location: login.php?erreur=3"); 
    exit();
}
    ?>


</body>
</html>