<?php
include('conn.php');
include('session.php');

class Core extends Session {

    function verify() {
        $sess = new Session;
        if($sess->isLoggedin()) {
            echo "<script>alert('Session Detected')</script>";
        } else {
            echo "<script>alert('No Session Detected')</script>";
        }
    }
}
?>