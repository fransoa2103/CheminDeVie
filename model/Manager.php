<?php
class Connect {
    protected function connection(){
        try {
            $database = new PDO('mysql:host=localhost;dbname=MVC_POO;charset=utf8', 'root', '');
        }
        catch(Exception $e) {
            throw new Exception ('Erreur : '.$e->getMessage());
        }
        return $database;
    }
}