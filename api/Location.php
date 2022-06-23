<?php
require_once "Database.php";

class Location {
    public static $DB;

    public static function getByStateAbrv($stateAbrv) {
        $cities = self::$DB->query("SELECT c.name FROM states s, cities c  WHERE s.id = c.state AND s.abrv = '$stateAbrv' ORDER BY c.name");
        $result_set = [];
        if (!$cities) return [];
        while ($row = $cities->fetchArray(SQLITE3_ASSOC)) {
            $result_set[] = $row;
        }
        return $result_set;
    }

    public static function listStates() {
        $state_list = self::$DB->query("SELECT * FROM states s ORDER BY s.name");
        $result_set = [];
        if (!$state_list) return [];
        while ($row = $state_list->fetchArray(SQLITE3_ASSOC)) {
            $result_set[] = $row;
        }
        return $result_set;
    }
}

Location::$DB = new Database();
