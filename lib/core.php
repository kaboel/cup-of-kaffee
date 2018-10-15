<?php
include('conn.php');
include('session.php');

class Core {

    public function loginVerify() {
        $sess = new Session;
        if($sess->sessionVerify()) {
            echo "<script>loadMainAdm();</script>";
        } else {
            echo "<script>loadLoginAdm();</script>";
        }
    }

    public function logOut() {
        
    }
}
?>