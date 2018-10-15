<?php
class Session {

    protected function isLoggedin() {
        if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
            return true;
        } else {
            return false;
        }
    }

    protected function logIn($user, $pass) {
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

    protected function logOut() {
        session_unset();
        session_destroy();
        if(!isLoggedin()) {
            return true;
        } else {
            return false;
        }
    }
}

?>