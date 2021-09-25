<?php
require_once 'Manager.php';
class UsersManager extends Connect {
    public function getUsers() {
        $database = $this->connection();
        $request = $database->query('SELECT * FROM users');
        return $request;
    }
}