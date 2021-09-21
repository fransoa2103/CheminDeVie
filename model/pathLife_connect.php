<?php
function getUsersCDV() {
    try {
            $database = new PDO('mysql:host=localhost;dbname=MVC_POO;charset=utf8', 'root', '');
        }
        catch(Exception $e) {
            die ('Erreur : '.$e->getMessage());
        }
        $request = $database->query('SELECT * FROM cdv');
        return $request;
    }