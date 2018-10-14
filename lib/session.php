<?php
session_start();

class Sess {
    public $user = $_SESSION['user'];
    public $pass = $_SESSION['pass'];
    public $perm = $_SESSION['perm'];

    function isLoggedin() {
        if($user != "" && $pass != "" && $perm != "") {
            return true;
        } else {
            return false;
        }
    }

    function logIn($user, $pass) {
        if(isLoggedin()) {
            return false;
        } else {
            require_once('conn.php');
            $conn = new Conn;
            if($conn->conn()) {

            } else {
                return "Connection Error.";
            }
        }
    }

    function logOut() {

    }
}

?>