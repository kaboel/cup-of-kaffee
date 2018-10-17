<?php
session_start([
    'cookie_lifetime' => 7200,
]);
include('conn.php');

class Core {
    //SESSION CONTROL
    public function __construct() { }

    private static function __sesVerify() {
        if(isset($_SESSION['uid']) && isset($_SESSION['user']) && isset($_SESSION['pass'])) {
            return true;
        } else {
            return false;
        }
    }

    public function __loginVerify() {
        if(self::__sesVerify()) {
            echo "<script>loadMainAdm();</script>";
        } else {
            echo "<script>loadLoginAdm();</script>";
        }
    }

    public function __loginExec($user, $pass) {
        $conn = new Conn;
        $link = $conn->__init();
        $sqls = sprintf(
            "SELECT ID_USER, USERNAME, PASSWORD
            FROM t_user
            WHERE USERNAME = '%s'
            AND PASSWORD = '%s'"
            , $user
            , $pass                
        );
        if($sqls = $link->query($sqls)) {
            $count = $sqls->num_rows;
            $data  = $sqls->fetch_assoc();
            if($count == 1) {

                $sqli = sprintf(
                    "UPDATE t_user SET 
                     LAST_LOGIN = NOW()
                     WHERE USERNAME = '%s'
                     AND PASSWORD = '%s'"
                     , $data['USERNAME']
                     , $data['PASSWORD']               
                );
                if($sqli = $link->query($sqli)) {

                    $_SESSION['uid']  = $data['ID_USER'];
                    $_SESSION['user'] = $data['USERNAME'];
                    $_SESSION['pass'] = $data['PASSWORD'];
                    return "1";
                } else {
                    return "SQL[2]ERRNO - Cannot Login.";
                }
            } else {
                return "Invalid username or password.";
            }
        } else {
            return "SQL[1]ERRNO - Cannot Login.";
        }
        $link->close();
    }

    public function __loginExit() {
        if(self::__sesVerify()) {
            session_unset();
            if(!self::__sesVerify()) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>