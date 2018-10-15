<?php
class Session {

    public function sessionVerify() {
        if(isset($_SESSION['user']) && isset($_SESSION['pass'])) {
            return true;
        } else {
            return false;
        }
    }

    public function sessionStart($user, $pass) {
        if(isLoggedin()) {
            return false;
        } else {
            require_once('conn.php');
            $conn = new Conn;
            if($conn->conn()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function sessionDestroy() {
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