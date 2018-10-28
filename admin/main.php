<div class="admin-menu wrap">
    <div class="menu-panel-menu main-menu">
        <div class="logo">
            <img src="../images/kaffee-icon.png" alt="" class="img-fluid">
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
        <span onclick="" class="applet" title="Settings">
            <i class="fas fa-user-cog"></i><b> </b>
        </span>
        <span onclick="logoutExec()" class="applet" title="Logout">
            <i class="fas fa-power-off"></i>
        </span>
    </div>
    <div id="admPgs" style="display:none;">
        <!-- REMOTE -->
    </div>
</div>
<script>
$(function(_e){
    __loadMenu();
    __loadPage(1);
})
</script>

<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('../lib/core.php');
$core = new Core;
$core::__locVerify();
?>
