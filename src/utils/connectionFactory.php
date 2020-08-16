<?php
    class ConnectionFactory {
        private static $host = "localhost";
        private static $port = "5432";
        private static $db = "unico";
        private static $db_user = "postgres";
        private static $db_password = "FA@2003us";


        private static $con = null;

        public static function getConection() {
            if (is_null(self::$con)) {
                
                self::$con = new PDO("pgsql:host=" . self::$host . ";port=" .self::$port . ";dbname=".self::$db, self::$db_user, self::$db_password);
                return self::$con;

            }

            return self::$con;
        }
    }
?>