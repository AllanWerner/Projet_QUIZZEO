<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="login.css">
    <title>Ludiflex | Login & Registration</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <img class='logo' src='./images/logo.png'>
        </div>
        
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Connexion</button>
            <button class="btn" id="registerBtn" onclick="register()">Inscription</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

    <!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->

        <form metohd = "post" action = "traitement.php?root=login"  class="login-container" id="login">
            <div class="top">
                <span>Pas de compte ? <a href="#" onclick="register()">Inscription</a></span>
                <header>Connexion</header>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Email">
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Mot de passe">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Connexion">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check">Se souvenir de moi</label>
                </div>
                <div class="two">
                    <label><a href="#">Mot de passe oublié ?</a></label>
                </div>
            </div>
        </form>

        <!------------------- registration form -------------------------->
        <form metohd = "post" action = "traitement.php?root=inscription" class="register-container" id="register">
            <div class="top">
                <span>Déjà un compte ? <a href="#" onclick="login()">Connexion</a></span>
                <header>Inscription</header>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Nom">
                    <i class="bx bx-user"></i>
                </div>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Email">
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Mot de passe">
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
             <!-- End of dropdown menu -->
             
            <!-- Captcha -->
            <div class="g-recaptcha" data-sitekey="6LfOg5gpAAAAAOuyBgzvJw4SxxEtwqOK0jhF0DJ5"></div>

            <div class="input-box">
                <input type="submit" class="submit" value="S'inscrire">
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="register-check">
                    <label for="register-check">Se souvenir de moi</label>
                </div>
                <div class="two">
                    <label><a href="#">Terms & conditions</a></label>
                </div>
            </div>
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
