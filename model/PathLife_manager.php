<?php
require_once 'Manager.php';
class UsersCDV extends Connect {
    public function getUsersCDV() {
        $database = $this->connection();
        $request = $database->query('SELECT * FROM cdv');
        return $request;
    }
}