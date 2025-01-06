<?php

class Database {
    private static $connection;

    private static function createConnection() {
        if(!isset(Database::$connection)) {
            Database::$connection = new mysqli(
                "localhost",
                "root",
                "mydb@Aadhil09",
                "amila_karunarathne",
                "3306"
            );
        }
    }

    public static function iud($query) {
        Database::createConnection();
        Database::$connection->query($query);
    }

    public static function s($query) {
        Database::createConnection();
        return Database::$connection->query($query);
    }

    public static function getAffectedRows() : int {
        return Database::$connection->affected_rows;
    }
}
?>