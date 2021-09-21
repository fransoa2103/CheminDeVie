<?php
    
require('model/listUsers_connect.php');
require('model/pathLife_connect.php');

function home(){
    $request = getUsers();
    require('view/listUsers_view.php');
}
function cdv(){
    $request = getUsersCDV();
    require('view/pathLife_view.php');
}

