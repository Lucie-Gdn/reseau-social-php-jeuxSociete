<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../style_navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>    <title>Jeux</title>
    <style>
        img {
            height: 200px;
            width: 200px;
            
        }
    </style>
</head>

<!-- <form action="../deconnexion/logout.php" method="POST">
    <input type="submit" name="logout" value="Déconnexion">
</form> -->

<?php // Le formulaire pour entrer un nouveau jeu dans le catalogue ?>

<body>
<nav>
        <ul>
            <li><a href="#"><img class="icone_jeux" src="../images/jeu-de-plateau.png" alt="Icône Jeux"></a></li>
            <li><a href="../accueil/accueil.php">Accueil</a></li>
            <li><a href ="../accueil/profil/profil.php">Profil</a></li>
            <li><a href="#">Jeux de Société</a></li>
            <li><button class="deconnexion"><a href="../deconnexion.php" class="button">Deconnexion</a></button></li>
        </ul>
    </nav>
    <div class="form-container">
        <h2 class="form-title">Ajout d'un jeu dans la liste</h2>
            <form class="form" action="newgame.php" method="post" enctype="multipart/form-data">
                <p class="form-name">Nom du jeu : <input type="text" name="nom" /></p>
                <p class="form-min-player">Combien de joueurs minimum : <input type="text" name="nb_min_joueurs" /></p>
                <p class="form-max-player">Combien de joueurs maximum: <input type="text" name="nb_max_joueurs" /></p>
                <p class="form-time">Quel est le temps de jeu estimé ? (en minutes) <input type="text" name="temps_de_jeux" /></p>
                <div class="container-select">
                    <p class="form-niveau">Quel est la difficultée du jeu ?</p>
                        <select class="form-select" name="selectNiveau">
                            <option value="facile">Facile</option>
                            <option value="moyen">Moyen</option>
                            <option value="difficile">Difficile</option>
                        </select>
                </div>
                <p class="form-description">Ajoutez une description. (1000 caractères maximum) <input type="text" name="content" /></p>
                <p class="form-img">Ajoutez une photo (format autorisé : jpg, png, jpeg) <input type="file" name="my_image">
                <p class="form-submit"><input class="form-input-submit" type="submit" value="Ajouter votre jeu"></p>
            </form>
    </div>

    <?php // Affichage du contenu de la table collection ?>

    <div class="game-container">
        <?php
        include "../connectdatabase.php";
        session_start();
            
        $sql_game="SELECT * FROM `jeux` ORDER BY `jeux`.`nom` ASC";
        $result_game = $conn->query($sql_game);

        while ($game = $result_game->fetch(PDO::FETCH_ASSOC))
        {
        ?>
        <div class="game-box">
            <div class="game-id" data-game-id="<?php echo $game['id']; ?>">
            <h3 class="game-name"><?php echo $game['nom'] ?></h3>
            <img class="game-img" src="./uploads/<?= $game['image_url'] ?>">
            <p class="nb-min-player"><?php echo $game['nb_min_joueurs']?></p>
            <p class="nb-max-player"><?php echo $game['nb_max_joueurs']?></p>
            <p class="game-time"><?php echo $game['temps_de_jeux']?></p>
            <p class="game-niveau"><?php echo $game['niveau']?></p>
            <div class="game-description"><?php echo $game['content']?></div>
            <form method="POST" action="addToCollection.php">
                <input type="hidden" name="nom" value="<?php echo $game['nom']; ?>">
                <input type="hidden" name="nb_min_joueurs" value="<?php echo $game['nb_min_joueurs']; ?>">
                <input type="hidden" name="nb_max_joueurs" value="<?php echo $game['nb_max_joueurs']; ?>">
                <input type="hidden" name="temps_de_jeux" value="<?php echo $game['temps_de_jeux']; ?>">
                <input type="hidden" name="niveau" value="<?php echo $game['niveau']; ?>">
                <input type="hidden" name="content"value="<?php echo $game['content']; ?>">
                <input type="hidden" name="my_image" value="<?php echo $game['image_url'] ?>" >
                <button type="submit">Ajouter à la collection</button>
            </form>
            <div class="game-like">
                <p class="game-count-like"> <?php echo $game['liked'] ?> </p>



                <button class="game-button" type="button" name="like" onclick="update()">
                    <img class="game-like-img" src="../images/like.png" alt="symbole like"/>
                </button>



            </div>
        </div>
        <?php
        // ENTRE CES DEUX COMMENTAIRES JE PEUX ENCORE UTILISER $GAME
         include "./updateLike.php";        
         
        // ENTRE CES DEUX COMMENTAIRES JE PEUX ENCORE UTILISER $GAME
        }
        ?>

        <script>
        // LA OU JE DOIS JQUERRY !!!!!

        // CELUI LA MARCHE

        function update() {
            // Récupérer l'identifiant du jeu
            var gameId = $(event.target).closest('.game-id').data('game-id');
            var game_count_like = $(event.target).closest('.game-like').find('.game-count-like');

            $.ajax({
                type: "GET",
                url: "./updateLike.php",
                data: {
                    id: gameId
                },
                success: function(data) {
                    if (!isNaN(data)) {
                        game_count_like.text(data);
                    } else {
                        console.error(data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status + ": " + error);
                }
            });
        }
        </script>
    </div>
</body>
</html>