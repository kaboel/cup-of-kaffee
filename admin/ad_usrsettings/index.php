<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('../../lib/core.php');
$core = new Core;
$core::__locVerify();
$prefix = $core::__prefix();
$eid    = $core::__getUsrInfo("ID_EMPLOYEE");
$eimg   = $core::__getUsrInfo("PICTURE");
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
            <div class="box">
                <h5><!-- Title -->
                    <i class="fas fa-user"></i>
                    <span>Profile Information</span>
                </h5>
                <form method="post" action="">
                <div id="profileBox" class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td width="170" class="text-right centralized"><b>Full Name :</b></td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control frm-def">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right centralized"><b>Gender :</b></td>
                                    <td>
                                        <div class="merge-inputs">
                                            <div>
                                                <input type="radio" name="gender" value="1" id="radL" class="">
                                                <label for="radL">Laki - Laki</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="gender" value="0" id="radP" class="">
                                                <label for="radP">Perempuan</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right centralized"><b>Place & Date Of Birth :</b></td>
                                    <td>
                                        <div class="merge-inputs">
                                            <input type="text" name="gender" value="" id="radL" class="">
                                            <input type="text" name="gender" value="" id="radP" class="">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right centralized"><b>Home Address :</b></td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control frm-def">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right centralized"><b>Phone Number :</b></td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control frm-def">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-right">
                        <div class="btn-field">
                            <input type="reset" value="Reset" class="btn btn-sm btn-kaffee btn-fixed">
                            <input type="submit" value="Save" class="btn btn-sm btn-kaffee btn-fixed">
                        </div>
                    </div>
                </div>
                </form>
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
                        <form id="ePassFrm" action="" method="post">
                            <input name="oldp" type="password" class="form-control frm-def" placeholder="Old Password" required>
                            <input name="newp" type="password" class="form-control frm-def gap-20" placeholder="New Password" required>
                            <input name="verp" type="password" class="form-control frm-def" placeholder="Confirm Password" required>
                            <p id="Notif" style="text-align:center;font-size:0.75rem;margin:10px 0 0 0;font-style:italic;font-weight:bold;">Fill all the blanks.</p>
                            <div class="btn-field">
                                <input type="reset" value="Reset" class="btn btn-sm btn-kaffee btn-fixed">
                                <input type="submit" value="Save" class="btn btn-sm btn-kaffee btn-fixed">
                            </div>
                        </form>
                    </div>
                    <li id="eProfile">Update Profile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $("#meBox").empty().load("ad_usersettings/profile");
});

$("#eProfileFrm").on('submit', function(_e) {
    
    
});

$('#ePassFrm').on('submit', function(_e) {
    resetCol();
    _e.preventDefault();
    var exec  = "reqChgPass";
    var Notif = $("#Notif");
    var Msg   = "";
    var Css   = "red";
    var oldp  = $( this ).find('input[name="oldp"]').val();
    var newp  = $( this ).find('input[name="newp"]').val();
    var verp  = $( this ).find('input[name="verp"]').val();

    $.ajax({
        type: 'GET',
        data: 'exec='+exec+'&oldp='+oldp+'&newp='+newp+'&verp='+verp,
        url : '../lib/handler',
        success : function(_e){
            if(_e == "SUCCESS") {
                resetCol();
                Msg+="Password Updated.<br>Please Logout then Relogin.";
                Css ="green";
            } else if(_e == "ERR") {
                resetCol();
                Msg+="Please try again later.";
            } else if(_e == "Old-Inval") {
                Msg+="Old password invalid.";
                $('input[name="oldp"]').css("border-color", "red");
                $('input[name="oldp"]').css("color", "red");
            } else if(_e == "New-Inval") {
                Msg+="New password doesn't match.";
                $('input[name="newp"]').css("border-color", "red");
                $('input[name="verp"]').css("border-color", "red");
                $('input[name="newp"]').css("color", "red");
                $('input[name="verp"]').css("color", "red");
            }
            Notif.empty().append(Msg).css("color", Css);
        }
    });
});
$('#ePassFrm').on('reset', function(_e) {
    $("#Notif").empty().append("Fill all the blanks.").css("color", "inherit");
    resetCol();
});
function resetCol() {
    $('input[name="oldp"]').css("border-color", "#CCC");
    $('input[name="oldp"]').css("color", "inherit");
    $('input[name="newp"]').css("border-color", "#CCC");
    $('input[name="newp"]').css("color", "inherit");
    $('input[name="verp"]').css("border-color", "#CCC");
    $('input[name="verp"]').css("color", "inherit");
}

</script>