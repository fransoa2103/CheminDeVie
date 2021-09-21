<?php
$title = "Home";
ob_start();
?>
<section>
    <p><?= $error ?>ou il est impossible d'acceder à la base de données.</p>
</section>
<?php
    $content = ob_get_clean();
    require ('template_view.php');
?>