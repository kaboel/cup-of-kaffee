<?php
//
//  * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
//  * Copyright 2018 faiq.kaboel@gmail.com | In Effect
//

    include('core.php');

    if(isset($_GET['exec']) && $_GET['exec'] === "sessionVerify") {
        $core = new Core;
        if($core::__sesVerify()) {
            echo "1";
        } else {
            echo "0";
        }

        //echo
        exit;
    }


// -----------------------------------------------------------------------------------------


    if(isset($_GET['exec']) && $_GET['exec'] === "loginReq") {
        $core = new Core;
        $user = $_GET['user'];
        $pass = md5($_GET['pass']);
        $exec = $core->__loginExec($user, $pass);
        if($exec == "1") {
            echo "1";
        } else if($exec == "0") {
            echo "0";
        } else {
            echo $exec;
        }

        // echo
        exit;
    }

    if(isset($_GET['exec']) && $_GET['exec'] === "logoutReq") {
        $core = new Core;
        if($core->__loginExit()) {
            echo "1";
        } else {
            echo "0";
        }

        // echo
        exit;
    }

    if(isset($_GET['exec']) && $_GET['exec'] === 'loadMenu') {
        $core = new Core;
        $data = $core->__loadMenu();
        if($data != "0") {
            echo $data;
        } else {
            echo "0";
        }

        //echo
        exit;
    }

    if(isset($_GET['exec']) && $_GET['exec'] === "loadSub") {
        $core   = new Core;
        $parent = $_GET['parent'];
        $data   = $core->__loadSub($parent);
        if($data != "0") {
            echo $data;
        } else {
            echo "0";
        }
        
        //echo  
        exit;
    }

    if(isset($_GET['exec']) && $_GET['exec'] === "loadPage") {
        $core = new Core;
        $pgid = $_GET['pgid'];
        $data = $core->__loadPage($pgid);
        if($data != "0") {
            echo $data;
        } else {
            echo "0";
        }

        //echo
        exit;
    }

    if(isset($_GET['exec']) && $_GET['exec'] === "reqEmProfile") {
        $core   = new Core;
        $usrid  = $_GET['usrid'];
        $data   = $core->__getEmProfile($usrid);
        if($data != "0") {
            echo $data;
        } else {
            echo "0";
        }

        //echo
        exit;
    }

    if(isset($_GET['exec']) && $_GET['exec'] === 'reqChgPass') {
        $core = new Core;
        $oldpass    = $_GET['oldp'];
        $newpass    = $_GET['newp'];
        $verpass    = $_GET['verp'];
        $data = $core->__editPass($oldpass, $newpass, $verpass);
        echo $data;

        exit;
    }
?>