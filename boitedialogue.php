<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="boitedialogue.css">
<title>Boîte de dialogue</title>

</head>
<body>

<!-- Partie navbar -->
<section class="navbar">
    <div class="left-div">
        <img class="img" src="logo.png" alt="">    
    </div>
    <div class="right-div">
        <button class="button">Logout</button>
    </div>
</section>
 
<div class="boite-center">
    <button id="open-boite_d">Ouvrir la boîte de dialogue</button>
</div>
 
<div id="boite_d" class="boite_d">
  <div class="content">
    <span class="close">&times;</span>
    <h2>Informations du quiz</h2>
    <form id="myForm" action="quiz.php" method="post">
      <input type="number"  name="nbq" placeholder = "Entrer le nombre de questions " required><br/>
      <input type="number"  name="np" placeholder = "Entrer le nombre de propositions par question  " required><br/>
      <input type="submit"  value="Soumettre">
    </form>
  </div>
</div>
 
<script>
document.addEventListener('DOMContentLoaded', function() {
    var boite_d = document.getElementById('boite_d');
    var openButton = document.getElementById('open-boite_d');
    var closeButton = boite_d.querySelector('.close');
    var form = document.getElementById('myForm');
 
    openButton.addEventListener('click', function() {
        boite_d.style.display = 'block';
    });
 
    closeButton.addEventListener('click', function() {
        boite_d.style.display = 'none';
    });
 
    form.addEventListener('submit', function() {
        boite_d.style.display = 'none'; // Ferme la boîte de dialogue
        // Redirige vers la page quiz.php
        window.location.href = this.action;
    });
});
</script>
 
</body>
</html>