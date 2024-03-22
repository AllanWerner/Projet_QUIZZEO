<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .navbar{
    width: 100%;
    height: 13vh;
    background-color: #734db0;
    display: flex;
    justify-content: center;
    align-items: center;
}
 
.left-div{
    width: 50%;
    height: 10vh;
    background-color:#734db0;
    display: flex;
    justify-content: center;
    align-items: center;
}
 
/* img du logo quizzeo */
.img{
    width: 250px;
    height: 70px;
}
 
.right-div{
    width: 50%;
    height: 100%;
    background-color: #734db0;
    display: flex;
    justify-content: right;
    align-items: center;
}
 
/* Le bouton logout */
.button {
    position: relative;
    background-color: #f1696a;
    border: none;
    font-size: 18px;
    color: #f5eeee;
    padding: 20px;
    width: 100px;
    height: 40px;
    text-align: center;
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
    cursor: pointer;
    margin-right: 80px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}
 
.button:after {
    content: "";
    background: #f1f1f1;
    display: block;
    position: absolute;
    padding-top: 300%;
    padding-left: 350%;
    margin-left: -20px !important;
    margin-top: -120%;
    opacity: 0;
    transition: all 0.8s
}
 
.button:active:after {
    padding: 0;
    margin: 0;
    opacity: 1;
    transition: 0s;
}
    </style>
</head>
<body>
<nav class="navbar">
        <a href="accueil.php"><img class="img" src="./images/logo.png"></a>  
        
        <?php
session_start();
if(isset($_SESSION['role']) && $_SESSION['role'] == 'Ecole' || $_SESSION['role'] == 'Entreprise' ){    
    echo "<button><a class= 'quizBtn' href='Boite_quiz.php'>New quiz</a></button>";
} elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'User'){
    echo "<a class= 'dashBtn' href='#'>Mon Profil</a>";
}

?>

<a class= 'log-button' href='./Logout.php'>logout</a>
    </nav>
</body>
</html>