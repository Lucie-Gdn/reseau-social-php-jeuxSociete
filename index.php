<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Jeux de Société en folie</title>
</head>
<body>
    <div class="container">
        <h1>Jeux de société en folie!</h1>
        <p>Bienvenue sur le premier réseau social consacré aux amoureux des jeux de société!</p>
        <p>Découvrez des tonnes de jeux de société et une communauté incroyable d'amateurs passionnés de jeux en tout genre.</p>
        <div class="button_container">
            <button class="inscription"><a style="text-decoration: none; color: white;" href="./inscription/inscription.php">Inscription</a></button>
            <button class="connexion"><a style="text-decoration: none; color: white;" href="./connexion/connexion.php">Connexion</a></button>
        </div>
    </div>
    <?php
        include "connectdatabase.php";
        // include "./inscription/inscription.php";
    ?>
</body>
</html>