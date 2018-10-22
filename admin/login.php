<div class="container">
    <div class="row" style="margin-top:2.5%;">
        <div class="col"></div>
        <div class="col-2">
            <img src="../images/kaffee-barista.png" alt="" class="img-fluid">
        </div>
        <div class="col"></div>
    </div>
    <div id="loginFrm" class="row" style="margin-top:2%;">
        <div class="col"></div>
        <div class="col-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input id="user" type="text" class="form-control" placeholder="Username here" aria-label="Small" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">
                        <i class="fas fa-unlock-alt"></i>
                    </span>
                </div>
                <input id="pass" type="password" class="form-control" placeholder="Password here" aria-label="Small" aria-describedby="inputGroup-sizing-default">
            </div>
            <button id="loginTrig" onclick="loginExec()" type="button" class="btn btn-sm btn-kaffee form-control"> Login </button>
        </div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-4" id="loginMsg" style="display: none;">
            <!-- REMOTE -->
        </div>
        <div class="col"></div>
    </div>
</div>
<div class="main-foot">
    <span class="copyright">&copy; 2018 <a href="#">.cupofkaffee.</a> | All Rights Reserved.</span>
</div>
<script>
$(function(_e) {
    $( this ).keypress(function(_e) {
        if (_e.which == 13) { loginExec(); }
    });
});
</script>
<?php
ERROR_REPORTING(E_ALL ^ E_NOTICE);
?>