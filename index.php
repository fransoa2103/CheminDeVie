<?php
    if (isset($_GET['error'])){
        if($_GET['error'] == 1){
            echo '<h3 style="color: red;">'.$_GET['message'].'</h3>';
        }
        else
        {
            echo '<h3 style="color: green;">'.$_GET['message'].'</h3>';
        }
    }
    ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calcul CDV en PHP/POO</title>
        <link rel="stylesheet" type="text/css" href="./css/index.css">
    </head>
    <body>
        <h1>Calcul de votre Chemin De Vie</h1>
        <section class="left_section">
            <div class="rules">
                <ul>
                    <li>Simplifiez votre saisie en utilisant les caractères en minuscule</li>
                    <li>Précisez les voyelles accentuées: à-â-ä-é-è-ê-ë-ì-î-ï-ò-ô-ö-ù</li>
                    <li>Si besoin la cédille de la lettre ç avec la touche 9 du clavier alphabétique</li>
                    <li>Indiquez vos pénoms dans le même ordre que votre fiche d\'état civil</li>
                    <li>Séparez tous vos pénoms par un espace</li>
                    <li>Pour les prénoms composés, utilisez le tiret de la touche 6 du clavier alphabétique</li>
                </ul>
            </div>
        </section>
        <section class="right_section">
            <form id="userNew" action="./src/page_resultats.php" method="POST">
                <label for="prenoms"><b>Vos prénoms</b><br>
                    <input class="precision lenght_input" required type="text" name="prenoms" id="prenoms" placeholder="ex: Jean-Pierre François émile"></br></br>
                </label>

                <label for="nomPere"><b>Nom de naissance de votre père</b></br>
                    <input required type="text" name="nomPere" id="nomPere" placeholder="Nom de votre père"></br></br>
                </label>
                
                <label for="nomMere"><b>Nom de jeune fille de votre mère</b></br>
                    <input required type="text" name="nomMere" id="nomMere" placeholder="Nom de jeune fille de votre mère"></br></br>
                </label>

                <label for="dateNaissance"><b>Votre date de naissance</b></br>
                    <input required type="date" id="dateNaissance" name="dateNaissance">                        
                </label>

                <input type="submit" value="valider">
            </form>    
        </section>
        <script src="index.js"></script>
</body>
</html>