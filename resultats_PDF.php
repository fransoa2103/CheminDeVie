<style>

    *, ::after, ::before {
        box-sizing:         border-box;
        padding:            0px;
        margin:             0px;
    }
    body{
        color:              black;
        background-color:   white;
        width:              100%;
        padding:            1%;    
        font-family:        'arial', 'sans-serif';
    }
    h1 {
        width: 100%;
        padding: 1%;
        text-align: center;
        font-size: 2rem;
    }
    .entete {
        width: 100%;
        padding: 1%;
        margin: 1% 0 5% 0;
        border: 1px black solid;
        text-align: center;
    }
   
    .fond_couleur_pierre {
        width: 100px;
        height: 100px;
    }
    
    p.firstLetter::first-letter {
        font-size: 3rem;
        color: black;
        padding: 5px 0px 0px 5px;
    }
    .image_position_pierre {
        width: 100px;
        position: relative;
        transform: translate(35%,-25%);
    }
   
    td {
        border: 1px solid #333;
    }
    p {
        padding: 1%;
    }
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
    for($i = 0; $i<count(BaseDeCalcul::$formules); $i++ ){
        echo
            '<table style="font-size: 0.8rem;">'.
                '<tr style = "width: 100%">'.
                    '<td style ="width: 30%;">'.
                        '<div class = "fond_couleur_pierre" style=" margin: 0 auto; background-color:'.$_SESSION['user']['couleur'.$i].'">'.
                        '<p class = "firstLetter">'.($i+1).'</p>'.
                        '<img class = "image_position_pierre" src = "../images/'.$_SESSION['user']['nom_pierre'.$i].'.png" alt = "" >'.
                    '</td>'.
                    '<td>'.
                        '<p>'.$_SESSION['user']['definition_formule'.$i].'</p>'.
                        '<p style = "font-weight: bold; font-size: 1rem;">Votre pierre de '.$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i].'.</p>'.
                        '<p>'.$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i].'</p>'.
                    '</td>'.
                '</tr>'.
            '</table>';
        }
    ?>
</body>
</html>
