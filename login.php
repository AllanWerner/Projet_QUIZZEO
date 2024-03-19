<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!--<link rel="stylesheet" href="login.css">-->
    <title> Login & Registration</title>
    
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
 
 *{  
     margin: 0;
     padding: 0;
     box-sizing: border-box;
     font-family: 'Poppins', sans-serif;
 }
 body{
     background: url("./images/Login_back.jpeg");
     background-size: cover;
     background-repeat: no-repeat;
     background-attachment: fixed;
     overflow: hidden;
 }
 .wrapper{
     display: flex;
     justify-content: center;
     align-items: center;
     min-height: 110vh;
     background: rgba(39, 39, 39, 0.4);
 }
 .nav{
     position: fixed;
     top: 0;
     display: flex;
     justify-content: space-around;
     width: 100%;
     height: 100px;
     line-height: 100px;
     background: linear-gradient(rgba(39,39,39, 0.6), transparent);
     z-index: 100;
 }
  
 .logo {
     background-size: contain;
     background-repeat: no-repeat;
     background-position: center;
     width: 130px;
     height: 80px;
     transition: all 0.2s ease-in-out; /* Avoir una animation fluide */
     }
  
  
 .logo:hover{
     transform: scale(1.3); /* Agrandit mon logo de de 10% */
 }
  
 .nav-menu ul{
     display: flex;
 }
 .nav-menu ul li{
     list-style-type: none;
 }
 .nav-menu ul li .link{
     text-decoration: none;
     font-weight: 500;
     color: #fff;
     padding-bottom: 15px;
     margin: 0 25px;
 }
 .link:hover, .active{
     border-bottom: 2px solid #fff;
 }
 .nav-button .btn{
     width: 130px;
     height: 40px;
     font-weight: 500;
     background: rgba(255, 255, 255, 0.4);
     border: none;
     border-radius: 30px;
     cursor: pointer;
     transition: .3s ease;
 }
 .btn:hover{
     background: rgba(255, 255, 255, 0.3);
 }
 #registerBtn{
     margin-left: 15px;
 }
 .btn.white-btn{
     background: rgba(255, 255, 255, 0.7);
 }
 .btn.btn.white-btn:hover{
     background: rgba(255, 255, 255, 0.5);
 }
 .nav-menu-btn{
     display: none;
 }
 .form-box{
     position: relative;
     display: flex;
     align-items: center;
     justify-content: center;
     width: 512px;
     height: 580px;
     overflow: hidden;
     z-index: 2;
 }
 .login-container{
     position: absolute;
     left: 4px;
     width: 500px;
     display: flex;
     flex-direction: column;
     transition: .5s ease-in-out;
 }
 .register-container{
     position: absolute;
     right: -520px;
     width: 500px;
     display: flex;
     flex-direction: column;
     transition: .5s ease-in-out;
 }
 .top span{
     color: #fff;
     font-size: small;
     padding: 10px 0;
     display: flex;
     justify-content: center;
 }
 .top span a{
     font-weight: 500;
     color: #fff;
     margin-left: 5px;
 }
 header{
     color: #fff;
     font-size: 30px;
     text-align: center;
     padding: 10px 0 30px 0;
 }
  
  
 .input-field{
     font-size: 15px;
     background: rgba(255, 255, 255, 0.2);
     color: #000000;
     height: 50px;
     width: 100%;
     padding: 0 10px 0 45px;
     border: none;
     border-radius: 30px;
     outline: none;
     transition: .2s ease;
 }
 .input-field:hover, .input-field:focus{
     background: rgba(255, 255, 255, 0.25);
 }
 ::-webkit-input-placeholder{
     color: #fff;
 }
 .input-box i{
     position: relative;
     top: -35px;
     left: 17px;
     color: #fff;
 }
 .submit{
     font-size: 15px;
     font-weight: 500;
     color: black;
     height: 45px;
     width: 100%;
     border: none;
     border-radius: 30px;
     outline: none;
     background: rgba(255, 255, 255, 0.7);
     cursor: pointer;
     transition: .3s ease-in-out;
 }
 .submit:hover{
     background: rgba(255, 255, 255, 0.5);
     box-shadow: 1px 5px 7px 1px rgba(0, 0, 0, 0.2);
 }
 .two-col{
     display: flex;
     justify-content: space-between;
     color: #fff;
     font-size: small;
     margin-top: 10px;
 }
 .two-col .one{
     display: flex;
     gap: 5px;
 }
  
 .g-recaptcha{
     display: flex;
     justify-content: center;
     margin-top: 20px;
     margin-bottom: 20px;
 }
 .two label a{
     text-decoration: none;
     color: #fff;
 }
 .two label a:hover{
     text-decoration: underline;
 }
 @media only screen and (max-width: 786px){
     .nav-button{
         display: none;
     }
     .nav-menu.responsive{
         top: 100px;
     }
     .nav-menu{
         position: absolute;
         top: -800px;
         display: flex;
         justify-content: center;
         background: rgba(255, 255, 255, 0.2);
         width: 100%;
         height: 90vh;
         backdrop-filter: blur(20px);
         transition: .3s;
     }
     .nav-menu ul{
         flex-direction: column;
         text-align: center;
     }
     .nav-menu-btn{
         display: block;
     }
     .nav-menu-btn i{
         font-size: 25px;
         color: #fff;
         padding: 10px;
         background: rgba(255, 255, 255, 0.2);
         border-radius: 50%;
         cursor: pointer;
         transition: .3s;
     }
     .nav-menu-btn i:hover{
         background: rgba(255, 255, 255, 0.15);
     }
 }
 @media only screen and (max-width: 540px) {
     .wrapper{
         min-height: 100vh;
     }
     .form-box{
         width: 100%;
         height: 500px;
     }
     .register-container, .login-container{
         width: 100%;
         padding: 0 20px;
     }
     .register-container .two-forms{
         flex-direction: column;
         gap: 0;
     }
 }
    </style>
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
 
