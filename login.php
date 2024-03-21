<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="login.css">
    <title> Login & Registration</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <img class='logo' src='./images/logo.png'>
        </div>
       
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>
 
       
    <div class="form-box">
       
        <!------------------- Formulaire de connexion -------------------------->
 
        <form method="post" action="traitement.php?root=login" class="login-container" id="login">
            <div class="top">
                <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                <header>Login</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name = "mail" placeholder="Email" required>
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name = "password" placeholder="Password" required>
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <select class="input-field" id="account-type" name="account-type">
                    <option value="Ecole">Ecole</option>
                    <option value="Entreprise">Entreprise</option>
                    <option value="User">Utilisateur</option>
                    <option value="Admin">Administrateur</option>
                </select>
            </div>
            <br>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="reset_password.php">Forgot password?</a></label>
                </div>
            </div>
            <?php
                if (isset($_GET['erreur'])) {
                    $err = $_GET['erreur'];
                    if ($err == 1) {
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }elseif($err == 2){
                        echo "<p style='color:red'>Utilisateur déjà existant !</p>";
                    } elseif ($err ==  3) {
                        echo "Echec de récupération des informations de connexion ";
                    }
                }
                ?>
        </form>
 
        <!------------------- Formulaire d'inscription -------------------------->
        <form method="post" action="traitement.php?root=inscription" class="register-container" id="register">
            <div class="top">
                <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                <header>Sign Up</header>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" name = "name"  placeholder="Name" required>
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field"  name = "mail" placeholder="Email" required>
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name = "password" placeholder="Password" required>
                <i class="bx bx-lock-alt"></i>
            </div>
            <!-- Dropdown menu for account type -->
            <div class="input-box">
                <select class="input-field" id="account-type" name="account-type">
                    <option value="Ecole">Ecole</option>
                    <option value="Entreprise">Entreprise</option>
                    <option value="User">Utilisateur</option>
                    <option value="Admin">Administrateur</option>
                </select>
            </div>
            <div class="g-recaptcha" data-sitekey="6LfOg5gpAAAAAOuyBgzvJw4SxxEtwqOK0jhF0DJ5"></div>
            <!-- End of dropdown menu -->
            <div class="input-box">
                <input type="submit" class="submit" value="Register">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>
            <?php
                if (isset($_GET['erreur'])) {
                    $err = $_GET['erreur'];
                    if ($err == 1) {
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }elseif($err == 2){
                        echo "<p style='color:red'>Utilisateur déjà existant !</p>";
                    } elseif ($err ==  3) {
                        echo "Echec de récupération des informations de connexion ";
                    }
                    elseif ($err == 4 ) {
                        echo "Vous n'êtes pas autorisé à vous connecter en tant  que Administrateur";
                    }
                }
                ?>
        </form>
    </div>
</div>  
 
<script>
    function myMenuFunction() {
        var i = document.getElementById("navMenu");
 
        if(i.className === "nav-menu") {
            i.className += " responsive";
        } else {
            i.className = "nav-menu";
        }
    }
</script>
 
<script>

    // Ce  script permet de switcher entre les formulaires en cliquant soit sur le bouton soit le terme correspondant 
    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");
 
    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }
 
    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }
</script>
 
</body>
</html>
 
