<?php
//
//  * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
//  * Copyright 2018 faiq.kaboel@gmail.com | In Effect
//

class Conn {
// DB CONTROL
    private static $__User = "root";
    private static $__Pass = "";
    private static $__Name = "cupakaffee";
    private static $__Host = "127.0.0.1";
    private static $__Conn = NULL;

    public function __construct() { }

    public function __init() {
        if (!self::$__Conn) {
            self::$__Conn = new mysqli(
                self::$__Host, 
                self::$__User, 
                self::$__Pass, 
                self::$__Name
            );
            if (self::$__Conn -> connect_error) {
                die("Connect Error: " . self::$__Conn->connect_error);
            }
        }
        return self::$__Conn;
    }
}
?>