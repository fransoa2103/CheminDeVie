<!DOCTYPE html>
<html lang="fr">
    <?php include './asset/html_head.php'; ?>
    <body>
        
        <h1>Chemin De Vie</h1>
            
        <?php
            echo '<h1>'.$_SESSION['user']['prenoms'].'.</h1>';
            echo '<p> Le nom de naissance de votre père est: '.$_SESSION['user']['nomPere'].'.</p>';
            echo '<p> Le nom de naissance de votre mère est: '.$_SESSION['user']['nomMere'].'.</p>';
            echo '<p> Vous est né(e) le '.$_SESSION['user']['birthday'].'</p>';
            echo '<p> Et voici votre chemin de Vie:'.'</p>';
            for($i = 0; $i<8; $i++){
                $img = './images/'.$_SESSION['user']['resultat'.$i].'.png';
                ?>
                    <div>
                        <?php
                            echo '<img src='.$img.' alt="" srcset="" width="100">';
                            echo $_SESSION['user']['formule'.$i].' > '.$_SESSION['user']['resultat'.$i].'</br>';
                        ?>
                    </div>
                <?php
            }
        ?>
    
</body>
</html>