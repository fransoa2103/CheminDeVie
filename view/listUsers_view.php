<?php
    $title = "Liste des utilisateurs";
    ob_start();
?>

<section>
    <?php
    while ($user = $request->fetch()) {
        ?>
            <p><?= $user['first_name'] ?> > <?= $user['email'] ?></p>
        <?php
    }
    ?>
</section>

<?php
    $content = ob_get_clean();
    require('template_view.php');
?>
