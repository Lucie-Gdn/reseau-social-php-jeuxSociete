

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_profil.css">
    <link rel="stylesheet" href="../../style_navbar.css">
    <title>Profil</title>
</head>
<body>

<nav>
    <ul>
        <li><a href="#"><img class="icone_jeux" src="../../images/jeu-de-plateau.png" alt="Icône Jeux"></a></li>
        <li><a href="../accueil.php">Accueil</a></li>
        <li><a href="./profil/profil.php">Profil</a></li>
        <li><a href="../../jeux/jeux.php">Jeux de Société</a></li>
        <li><button class="deconnexion"><a href="../../deconnexion.php" class="button">Deconnexion</a></button></li>
    </ul>
</nav>

<div class="profil">

    <div class="photo">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="file">Fichier</label>
            <input type="file" name="file">
            <button type="submit">Enregistrer</button>
        </form>

        <?php 

    include "../../connectdatabase.php";

    $req = $conn->query('SELECT photo FROM photo');
    while($data = $req->fetch()){
        // var_dump($data);
        echo "<img src='uploads/".$data['photo']."' width='300px' ><br>";
    }
        ?>
    </div>

    <div class="info_connexion"> Info <br>
        <?php 
        // include "../../connectdatabase.php";
        session_start();
        echo "Prénom : ".$_SESSION["prenom"].'</br>';
        echo "Nom : ".$_SESSION["nom"].'</br>';
        echo "Adresse Mail : ".$_SESSION["mail"].'</br>';
        ?>

        <form action="modification.php" method="post">
            <button>
                <img src="./modify_icon.png" alt="">
            </button>
        </form>
    </div>
</div>

<div class="Info_perso_ajout">
    <form method="post" action="traitement.php">
        <p>
            <label for="pseudo">Ton pseudo:</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="Ex : luludu44" size="30" maxlength="10"/>
        </p>
    </form>

    <form method="post" action="traitement.php">
        <p>
            <label for="biographie">Biographie</label><br/>
            <textarea name="ameliorer" id="ameliorer" rows="10" cols="50">
                Qui es-tu?
            </textarea>
        </p>
    </form>

    <form method="post" action="Niveau.php">
        <label for="level-select">Quel est ton niveau ?</label>
        <select name="niveau" id="">
            <option value="">Choisie ton niveau</option>
            <option value="">Débutant</option>
            <option value="">Initié</option>
            <option value="">Archi-FAN !</option>
        </select>
        <input type="submit" value="Valider">
    </form>

    <form method="post" action="traitement.php">
        <p>
            <label for="pseudo">Ta ville:</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="Ex : Paris" size="30" maxlength="10"/>
        </p>
    </form>
</div>

</body>
</html>

