<div class="container">
    <div class="row" style="margin-top:2.5%;">
        <div class="col"></div>
        <div class="col-2">
            <img src="../images/kaffee-barista.png" alt="" class="img-fluid">
        </div>
        <div class="col"></div>
    </div>
    <div class="row" style="margin-top:2%;">
        <div class="col"></div>
        <div class="col-4">
            <form id="loginForm" method="POST" action="" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" class="form-control" placeholder="Username here" aria-label="Small" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">
                        <i class="fas fa-unlock-alt"></i>
                    </span>
                </div>
                <input type="password" class="form-control" placeholder="Password here" aria-label="Small" aria-describedby="inputGroup-sizing-default" required>
            </div>
            <button type="submit" class="btn btn-sm btn-kaffee form-control">Login</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-4" id="loginMsg">
            <!-- REMOTE -->
        </div>
        <div class="col"></div>
    </div>
</div>
<div class="main-foot">
    <span class="copyright">&copy; 2018 <a href="#">.cupofkaffee.</a> | All Rights Reserved.</span>
</div>

<?php
ERROR_REPORTING(E_ALL ^ E_NOTICE);
?>