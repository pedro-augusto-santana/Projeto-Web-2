<?php
class Database {
    function __construct() {
        $this->cursor = new SQLite3(dirname(__DIR__) . "/database/db.sqlite");

        if (!$this->cursor) {
            echo json_encode([
                "error" => true,
                "reason" => "Houve um erro na conexão com o banco de dados",
                "code" => 500
            ], JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    function execute($query) {
        $data = [];
        $db_response = $this->cursor->query($query);
        if ($db_response == false) return $data;
        try {
            while ($row = $db_response->fetchArray(SQLITE3_ASSOC)) {
                $data = $row;
            }
        } catch (Exception $e) {}
        return $data;
    }

    function insert($query) {
        $statement = $this->cursor->prepare($query);
        $statement->execute();
        if (!$statement) return false;
        return true;
    }
}
