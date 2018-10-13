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

    function logIn($user, $pass, $sess) {
        if(isLoggedin()) {

        } else {

        }
    }

    function logOut() {

    }
}

?>