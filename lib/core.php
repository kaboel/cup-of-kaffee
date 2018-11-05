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

    public static function __sesVerify() {
        return ( 
            isset($_SESSION['uid'])     && 
            isset($_SESSION['user'])    && 
            isset($_SESSION['pass'])
        );
    }

    public static function __httpVerify() {
        return (isset($_SERVER['HTTP_REFERER']));
    } 

    // public static function __accVerify() {
    //     if(isset($_SESSION['pgac'])) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public static function __locVerify() {
        if(!self::__httpVerify()) {
            header('header("HTTP/1.1 403 Forbidden', true, 403);
            header('Location: /cupofkaffee/errors/oops?');
        }

        // if(self::__accVerify()) {
        //     if($_SESSION['pgac'] != $param) {
        //         header('location:index.php');
        //         die();
        //     } else {
        //         $_SESSION['pgac'] = "0";
        //     }
        // } else {
        //     $_SESSION['pgac'] = "0";
        //     header("Refresh:0; url=index.php");
        // }
    } 

    public static function __loginVerify() {
        // $_SESSION['pgac'] = "0";

        if(self::__sesVerify()) {
            // $_SESSION['pgac'] = "admMain";
            echo "<script>loadAdm('main')</script>";
        } else {
            // $_SESSION['pgac'] = "admLogin";
            echo "<script>loadAdm('login')</script>";
        }
    }

    public static function __getUsrInfo($param) {
        $conn   = new Conn;
        $link   = $conn->__init();
        $sql    = sprintf(
            "SELECT U.*, E.* FROM t_user AS U
                INNER JOIN m_employee AS E
                ON U.ID_EMPLOYEE = E.ID_EMPLOYEE 
                WHERE U.USERNAME = '%s'
                AND U.PASSWORD = '%s'"
            , $_SESSION['user']
            , $_SESSION['pass']
        );
        if($sql = $link->query($sql)) {
            $data = $sql->fetch_assoc();
            return $data[$param];
        } else {
            return "0";
        }
        $link->close();
    }  

    public static function __passVerify($param) {
        $conn   = new Conn;
        $link   = $conn->__init();
        $param  = md5($param);
        $sql    = sprintf(
            "SELECT PASSWORD AS PASS
             FROM t_user 
             WHERE PASSWORD = '%s'"
            , $param
        );
        if($sql = $link->query($sql)) {
            if($sql->num_rows == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        $link->close();
    }

    // AJAX CALLBACKS
    public function __loginExec($user, $pass) {
        $conn = new Conn;
        $link = $conn->__init();
        $sqls = sprintf(
            "SELECT ID_USER, USERNAME, PASSWORD, ACTIVE, DELETED
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
                if($data['DELETED'] != 0) {
                    $str = "You are no longer listed as Admin.
                            <br>
                            <small>
                                <i>*Contact Supervisor for further information.</i>
                            </small>";
                    return $str;
                    exit;
                } else if($data['ACTIVE'] != 0) {
                    $str = "Your account has been deactivated.
                            <br>
                            <small>
                                <i>*Contact Supervisor for further information.</i>
                            </small>";
                    return $str;
                    exit;
                } else {
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
                        return "SQL[2]ERR - Server Failed.";
                    }
                }
            } else {
                return "Invalid Username or Password.";
            }
        } else {
            return "SQL[1]ERR - Server Failed.";
        }
        $link->close();
    }

    public function __loginExit() {
        if(self::__sesVerify()) {
            session_unset();
            session_destroy();
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
                AND ID_SUPER <= '1'"
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
        $link->close();
    }

    public function __loadSub($parent) {
        $conn = new Conn;
        $link = $conn->__init();
        $sql  = sprintf(
            "SELECT ID_MENU, ID_SUPER, TITLE, STR_ID, PATH
             FROM t_menu
             WHERE ID_SUPER = %d"
            , $parent
        );
        if($sql = $link->query($sql)) {
            if($sql->num_rows > 0) {
                while($arr = $sql->fetch_assoc()) {
                    $data[] = $arr;
                }
                return json_encode($data);
                die();
            } else {
                return "0";
            }
        } else {
            return "0";
        }
        $link->close();
    }

    public function __loadPage($pgid) {
        $conn = new Conn;
        $link = $conn->__init();
        $sql  = sprintf(
            "SELECT PAR.TITLE   AS PAR_TITLE,
                    SUB.TITLE   AS SUB_TITLE,
                    SUB.STR_ID  AS SUB_STRID,
                    SUB.PATH    AS PG_PATH
             FROM t_menu AS PAR
             JOIN t_menu AS SUB 
                ON PAR.ID_MENU = SUB.ID_SUPER
             WHERE SUB.ID_MENU = '%d'"
            , $pgid
        );
        if($sql = $link->query($sql)) {
            if($sql->num_rows == 1) {
                $data = $sql->fetch_assoc();
                return json_encode($data);
                die();
            } else {
                return "0";
            }
        } else {
            return "0";
        }
        $link->close();
    }

    
    public function __getEmProfile($usrid) {
        $conn   = new Conn;
        $link   = $conn->__init();
        $sql    = NULL;
        if($usrid == 0) {
            $sql = sprintf(
                "SELECT 
                    E.ID_EMPLOYEE, E.PICTURE, E.BIRTH_DATE, E.ADDRESS, E.PHONE,
                    CONCAT(E.FIRST_NAME, ' ', E.LAST_NAME) AS FULL_NAME,
                    IF(E.GENDER > 0, 'Male', 'Female') AS GENDER,
                    IF(E.POSITION > 0, 'Supervisor', 'Employee') AS POSITION,
                    IF(U.PERMIT > 0, 'Superuser', 'Limited') AS PERMIT, 
                    IF(U.ACTIVE < 1, 'Active', 'Disabled') AS ACTIVE, 
                    U.DELETED
                 FROM m_employee AS E
                 INNER JOIN t_user AS U 
                 ON E.ID_EMPLOYEE = U.ID_EMPLOYEE"
            );
        } else {
            $sql = sprintf(
                "SELECT 
                    E.ID_EMPLOYEE, E.PICTURE, E.BIRTH_DATE, E.ADDRESS, E.PHONE,
                    CONCAT(E.FIRST_NAME, ' ', E.LAST_NAME) AS FULL_NAME,
                    IF(E.GENDER > 0, 'Male', 'Female') AS GENDER,
                    IF(E.POSITION > 0, 'Supervisor', 'Employee') AS POSITION,
                    IF(U.PERMIT > 0, 'Superuser', 'Limited') AS PERMIT
                 FROM m_employee AS E
                 INNER JOIN t_user AS U 
                 ON E.ID_EMPLOYEE = U.ID_EMPLOYEE
                 WHERE E.ID_EMPLOYEE = '%d'"
                , $usrid 
            );
        }
        if($sql = $link->query($sql)) {
            if($sql->num_rows > 0) {
                while($arr = $sql->fetch_assoc()) {
                    $data[] = $arr;
                }
                return json_encode($data);
                die();
            } else {
                return "0";
            }
        } else {
            return "0";
        }
        $link->close();
    }

    public function __editPass($oldpass, $newpass, $verpass) {
        $param      = $oldpass;
        $oldpass    = md5($oldpass);
        $newpass    = md5($newpass);
        $verpass    = md5($verpass);

        if(!self::__passVerify($param)) {
            return "Old-Inval";
        } else if($newpass != $verpass) {
            return "New-Inval";
        } else {
            $conn = new Conn;
            $link = $conn->__init();
            $sql  = sprintf(
                "UPDATE t_user SET
                 PASSWORD = '%s'
                 WHERE PASSWORD = '%s'"
                , $newpass
                , $oldpass
            );
            if($sql = $link->query($sql)) {
                return "SUCCESS";
            } else {
                return "ERR";
            }
            $link->close();
        }
    }
}
?>