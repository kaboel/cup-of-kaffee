<?php
//
//  * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
//  * Copyright 2018 faiq.kaboel@gmail.com | In Effect
//

session_start([
    'cookie_lifetime' => 10800,
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

    private static function __getUsrInfo($param) {
        $conn   = new Conn;
        $link   = $conn->__init();
        $sql    = sprintf(
                "SELECT *
                 FROM t_user 
                 WHERE USERNAME = '%s'
                 AND PASSWORD = '%s'"
                , $_SESSION['user']
                , $_SESSION['pass']
        );
        if($sql = $link->query($sql)) {
            $data = $sql->fetch_assoc();
            return $data[$param];
        } else {
            return "0";
        }
    }

    public function __loginVerify() {
        if(self::__sesVerify()) {
            echo "<script>loadAdm('main');</script>";
        } else {
            echo "<script>loadAdm('login');</script>";
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
                return "Invalid Username or Password.";
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

    public function __loadMenu() {
        $conn   = new Conn;
        $link   = $conn->__init();
        $permit = self::__getUsrInfo("PERMIT");

        $sql    = sprintf(
                "SELECT ID_MENU, TITLE, STR_ID, ICON, PATH
                 FROM t_menu
                 WHERE PERMIT <= '%d'
                 AND ID_SUPER <= '0'"
                , $permit
        );        
        if($sql = $link->query($sql)) {
            while($arr = $sql->fetch_assoc()) {
                $data[] = $arr;
            }
            return json_encode($data);
            die();
        } else {
            return "0";
        }
    }

    public function __loadSub($parent) {
        $conn = new Conn;
        $link = $conn->__init();
        $sql = sprintf(
            "SELECT ID_MENU, ID_SUPER, TITLE, STR_ID, PATH
             FROM t_menu
             WHERE ID_SUPER = %d"
            , $parent
        );
        if($sql = $link->query($sql)) {
            while($arr = $sql->fetch_assoc()) {
                $data[] = $arr;
            }
            return json_encode($data);
            die();
        } else {
            return "0";
        }
    }
}
?>