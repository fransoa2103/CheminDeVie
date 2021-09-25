<?php
    
require_once('model/ListUsers_manager.php');
require_once('model/PathLife_manager.php');

function home(){
    $userManager = new UsersManager();
    $request = $userManager->getUsers();
    require('view/listUsers_view.php');
}
function cdv(){
    $userManager = new UsersCDV();
    $request = $userManager->getUsersCDV();
    require('view/pathLife_view.php');
}

