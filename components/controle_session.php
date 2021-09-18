<?php
    // var_dump($_POST);
    if(!isset($_POST)){
        header('location:http://localhost/CheminDeVie/index.php?error=1&message=Attention, Vous n\'avez rien saisi !');
        exit();
    }
    else {
    if ($_POST['prenoms'] =="" || $_POST['nomPere'] =="" || $_POST['nomMere'] ==""){
            header('location:http://localhost/CheminDeVie/index.php?error=1&message=Attention, Un ou plusieurs champs sont vides !');
            exit();
        }
    }
?>