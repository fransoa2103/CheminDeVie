<?php
    $title = "liste des chemins de vie";
    ob_start();
?>

<section>
    <?php
    while ($pathLifeUser = $request->fetch()) {
        ?>
            <p>Voici le chemin de vie de <?= $pathLifeUser['id_cdv'] ?> et sa pierre de base est = à <?= $pathLifeUser['base'] ?></p>
        <?php
    }
    ?>
</section>

<?php
    $content = ob_get_clean();
    require('template_view.php');
?>
