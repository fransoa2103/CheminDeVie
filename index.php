<?php
    if (isset($_GET['error'])){
        if($_GET['error'] == 1){
            echo '<h1 style="color: red;">'.$_GET['message'].'</h1>';
        }
        else
        {
            echo '<h1 style="color: green;">'.$_GET['message'].'</h1>';
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
    </head>
    <body>
        <form id="userNew" action="./src/page_resultats.php" method="POST">
            <label for="prenoms"><b>Saisissez TOUS vos prénoms</label></br>
            <input required type="text" name="pre_noms[0]" id="prenoms" size="75" placeholder="en minuscule"></br></br>

            <label for="nomPere"><b>Nom de naissance de votre père</label></br>
            <input required type="text" name="pre_noms[1]" id="nomPere" size="25" placeholder="en minuscule"></br></br>
            
            <label for="nomMere"><b>Nom de jeune fille de votre mère</label></br>
            <input required type="text" name="pre_noms[2]" id="nomMere" size="25" placeholder="en minuscule"></br></br>

            <label for="dateNaissance">Date de naissance</label></br>
            <input required type="date" id="dateNaissance" name="dateNaissance">                        

            <input type="submit" value="valider">
        </form>    
    
</body>
</html>