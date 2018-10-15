<?php
class Conn {

   private static $_dbUser  = 'root';
   private static $_dbPass  = '';
   private static $_dbDB    = 'cupakaffee';
   private static $_dbHost  = '127.0.0.1';
   private static $_dbConn  = NULL;

   public function __construct() { }

    public function Start() {
        if (!self::$_dbConn) {
            self::$_dbConn = new mysqli(self::$_dbHost, self::$_dbUser, self::$_dbPass, self::$_dbDB);
            if (self::$_dbConn -> connect_error) {
                die('Connect Error: ' . self::$_dbConn->connect_error);
            }
        }
        return self::$_dbConn;
    }
}
?>