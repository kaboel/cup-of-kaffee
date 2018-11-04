<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../lib/core.php');
$core = new Core;
$core::__locVerify();
$un = $core::__getUsrInfo("FIRST_NAME"). " " .$core::__getUsrInfo("LAST_NAME");

?>

<div class="pg-title">
    <h3>Profile</h3>
    <p id="breadCrumb"> 
        <img src="../images/kaffee-icon.png" width="25" height="25" style="margin-top: -10px;">
        <i class="fas fa-chevron-right"></i>
        <span>Pages</span>
        <i class="fas fa-chevron-right"></i>
        <span>Profile</span>
    </p>
</div>
<div class="pg-content">
    <div class="row boxes">
        <div class="col-md-8">
            <div id="profileInfo" class="box">
                <h5><!-- Title -->
                    <i class="fas fa-user"></i>
                    <span>Profile Information</span>
                </h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="box">
                <h5><!-- Title -->
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </h5>
                <ul>
                    <li><i class="fas fa-caret-down"></i> Change Password</li>
                    <div class="li-sub">
                        <form action="" method="post">
                            <input name="old" type="password" class="form-control frm-def" placeholder="Old Password">
                            <input name="new" type="password" class="form-control frm-def gap-20" placeholder="New Password">
                            <input name="ver" type="password" class="form-control frm-def" placeholder="Confirm Password">
                            <div class="text-right">
                                <input type="reset" value="Reset" class="btn btn-sm btn-kaffee btn-fixed gap-20">
                                <input type="button" value="Save" class="btn btn-sm btn-kaffee btn-fixed gap-20">
                            </div>
                        </form>
                    </div>
                    <li>Update Profile</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>

</script>