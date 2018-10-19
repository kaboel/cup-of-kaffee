//
//  * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
//  * Copyright 2018 faiq.kaboel@gmail.com | In Effect
//

// MAIN REMOTE 


// ADMIN INDEX REMOTE
function loadLoginAdm() {
    $("#admIdx").load("login.php");
}
function loadMainAdm() {
    $("#admIdx").load("main.php");
}

// ADMIN PAGES REMOTE
function __load(param) {
    var target  = param+".php";
    $("#admPgs").load(target);    
}

// ADMIN EXECS
// --> Session Controls
// Login
$(function(_e) {
    $("#loginForm").on('submit', function(_e) {
        _e.preventDefault();
        var exec = "loginReq";

        var user = $("input[type='text']").val();
        var pass = $("input[type='password']").val();
        $.ajax({
            type:   'POST',
            data:   'exec='+exec+'&user='+user+'&pass='+pass,
            url:    '../lib/handler',
            success: function(_e) {
                reset();
                if(_e == "1") {
                    location.reload(true);
                } else {
                    alert("loginMsg", "Login Failed ! ", _e);
                }
            }
        });
    });
});
// Logout
$(function(_e){
    $("#logoutTrig").on('click', function(_e){
        var exec = "logoutReq";
        var obj = "<div> Are you sure you want to go ? </div>";
        $(obj).dialog({
            modal: true,
            resizable: false,
            draggable: false,
            title : ".barista.",
            buttons: [
                {
                    text: "Yes, Log Me Out.",
                    click: function(_e) {
                        $.ajax({
                            type:   "POST",
                            data:   "exec="+exec,
                            url:    '../lib/handler',
                            success: function(_e){
                                if(_e == true) {
                                    location.reload(true);
                                } else {
                                    alert(_e);
                                }
                            }
                        });
                        $( this ).dialog( "close" );
                    }
                } ,
                {
                    text: "Cancel",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
            ],
            position: { 
                my: "center",
                at: "top+25%"
            }
        });
    });
});

// OTHER
$(function(_e) {
    $( document ).tooltip();
});

function reset() {
    $("input[type='text']").val("");
    $("input[type='password']").val("");
}

//ERR
function alert(target, info, msg) {
    var obj =    "<div class='alert alert-danger alert-dismissible fade show' role='alert'>"
                +"  <div>"
                +"     <strong>"+ info +"</strong></br>"
                +"     <span>"+ msg +"</span>"
                +"  </div>"
                +"  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                +"      <span aria-hidden='true'>&times;</span>"
                +"  </button>"
                +"</div>";
    $("#"+target).append(obj);
}