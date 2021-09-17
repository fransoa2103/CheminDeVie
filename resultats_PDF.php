<!-- <?php session_start(); ?> -->

<style>

    *, ::after, ::before {
        box-sizing:         border-box;
        padding:            0px;
        margin:             0px;
    }
    @font-face {
        src:                url('./images/Botera-Regular.otf');
        font-family:        'Botera';
    }
    body{
        color:              black;
        background-color:   white;

        width:              100%;
        padding:            1%;    
        margin: 0 auto;
    }
    h1 {
        width: 100%;
        padding: 1%;
        text-align:
        center; font-size: 2rem
    }
    .entete {
        width: 100%;
        padding: 1%;
        margin: 1% 0 5% 0;
        border: 1px black solid;
        text-align: center;
    }
    .grid_resultat {
        width: 100%;
        height: 200px;
        display:            flex;
        justify-content:    center;
        align-items:        center;
        /* flex-wrap:          wrap; */
}



/* DIV avec le fond de couleur */
/* P. le numéro */
/* IMG. l'image de la pierre */
div.fond_couleur_pierre {
    width: 100px;
    height: 100px;
}
p.firstLetter::first-letter {
    font-size: 4rem;
    color: black;
    padding: 10px 0px 0px 10px;
}
img.image_position_pierre {
    width: 100px;
    position: relative;
    transform: translate(35%,-25%);
}
/* section.grid_resultat>div:nth-child(2) {
    margin-top: 5%;
}
section.grid_resultat>div:nth-child(3) {
    font-weight: bold;
    font-size: 1rem;
}
section.grid_resultat>div:nth-child(4) {
    margin-bottom: 5%;
} */
</style>

<html>
<body>
    <div class = "entete">
        <?php
            echo
            '<p>
                Bonjour '.$_SESSION['user']['prenoms'].' '.$_SESSION['user']['nomPere'].' '.$_SESSION['user']['nomMere'].'
                Vous êtes né(e) le '.$_SESSION['user']['birthday'].'
            </p>';
        ?>
        <h1>VOICI VOTRE CHEMIN DE VIE</h1>
    </div>
    <?php
    // for($i = 0; $i<count(BaseDeCalcul::$formules); $i++ ){
    for($i = 0; $i<8; $i++ ){
        echo '<section class="grid_resultat">';
            echo '<div style="width: 25%">';
                echo '<div class = "fond_couleur_pierre" style="background-color:'.$_SESSION['user']['couleur'.$i].'">';
                    echo '<p class = "firstLetter">'.($i+1).'</p>';
                    echo '<img class = "image_position_pierre" src = "../images/'.$_SESSION['user']['nom_pierre'.$i].'.png" alt = "" >';
                echo '</div>';
            echo '</div>';
            echo '<div style="width: 65%">';
                echo '<div>'.$_SESSION['user']['definition_formule'.$i].'</div>';
                echo '<div>Votre pierre de '.$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i].'.</div>';
                echo '<div>';
                echo '<p>'.$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i].'</p>';
                echo '</div>';
            echo '</div>';
        echo '</section>';
    }
    ?>
</body>
</html>
