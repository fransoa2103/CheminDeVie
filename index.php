<?php
// ROOTER
require ('controller/controller.php');

try{
    if(isset($_GET['page'])){
        if ($_GET['page'] == 'home'){
            home();
        }
        else if ($_GET['page'] == 'cdv'){
            cdv();
        }
        else {
            throw new Exception('cette page n\'existe pas! ');
        }
    }
    else {
        home();
    }
}
catch(Exception $e){
    $error =$e->getMessage();
    require('view/error_view.php');
}