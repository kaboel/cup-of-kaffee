<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('../lib/core.php');
$core = new Core;
$core::__locVerify();
$up = "../". $core::__getUsrInfo("PICTURE");
$un = $core::__getUsrInfo("FULL_NAME");
?>

<div class="admin-menu wrap">
    <div class="menu-panel-menu main-menu" style="width: 56px;">
        <div class="logo">
            <img src="<?= $up ?>" alt="" width="40" height="40">
        </div>
        <ul class="p-menu" id="mainMenu">
            <!-- REMOTE -->
        </ul>
    </div>
    <div id="subContainer" class="menu-panel-menu sub-menu">
        <div class="logo">
            <span>.barista.</span><br>
            <i>Control panel</i>
        </div>
        <ul class="s-menu" id="subMenu">
            <!-- REMOTE -->
        </ul>
    </div>
</div>
<div onclick="dismissSub()" class="admin-content wrap">
    <div id="admPnl" class="top-bar">
        <div class="wrap" width="50%">
            <span> <i class="fas fa-chevron-right"></i> <b><?= $un ?></b></span>
        </div>
        <div class="text-right wrap"  width="50%">
            <span onclick="__loadPage(99)" class="applet" title="Profile">
                <i class="fas fa-user-cog"></i>
            </span>
            <span onclick="logoutExec()" class="applet" title="Logout">
                <i class="fas fa-power-off"></i>
            </span>
        </div>
    </div>
    <div id="admPgs" style="display:none;">
        <!-- REMOTE -->
    </div>
</div>
<script>
$(function(_e){
    __loadMenu();
    __loadPage(99);
})
</script>

