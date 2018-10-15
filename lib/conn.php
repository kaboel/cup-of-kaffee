<?php
class Conn {
    function conn() {
        $host    = "127.0.0.1";
        $user    = "root";
        $pass    = "";
        $db      = "cupakaffee";

        $link = mysqli_connect($host, $user, $pass, $db);

        if (!$link) {
            return false;
            exit;
        }
        
        return true;
        mysqli_close($link);
    }
}
?>