<?php
    include('core.php');

    if(isset($_POST['exec']) && $_POST['exec'] === "loginReq") {
        $core = new Core;
        $user = $_POST['user'];
        $pass = md5($_POST['pass']);
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

    if(isset($_POST['exec']) && $_POST['exec'] === "logoutReq") {
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
        $core = new Core;
        $parent = $_GET['parent'];
        $data = $core->__loadSub($parent);
        if($data != "0") {
            echo $data;
        } else {
            echo "0";
        }
        
        //echo  
        exit;
    }
?>