<?php
ERROR_REPORTING(E_ALL ^ E_NOTICE);
?>
<div class="container">
    <div class="row" style="margin-top:5%;">
        <div class="col"></div>
        <div class="col-2">
            <img src="../images/kaffee-barista.png" alt="" class="img-fluid">
        </div>
        <div class="col"></div>
    </div>
    <div class="row" style="margin-top:1.5%;">
        <div class="col"></div>
        <div class="col-4">
            <form id="Login">
            <div style="margin-bottom: 5px;">
                <input class="form-control" name="user" type="text" placeholder="Username here">
            </div>
            <div style="margin-bottom: 15px;">
                <input class="form-control" name="pass" type="password" placeholder="Password here">
            </div>
            <div style="margin-top: 15px;" class="text-center">
                <button type="button" class="btn btn-kaffee form-control">Login</button>
            </div>
            <form>
        </div>
        <div class="col"></div>
    </div>
</div>
<div class="main-foot" style="position: absolute; bottom:0; left:37%;">
    <span class="copyright">&copy; 2018 <a href="#">.cupofkaffee.</a> | All Rights Reserved.</span>
</div>