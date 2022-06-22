<?php
class Database {
    function __construct() {
        $this->conn = new SQLite3(dirname(__DIR__) . "/database/db.sqlite");
    }

    function query($query) {
        $db_resp = $this->conn->query($query);
        if (!$db_resp) return false;
        return $db_resp;
    }

    function insert($query) {
        $db_resp = $this->conn->exec($query);
        if (!$db_resp) return false;
        return true;
    }
};
