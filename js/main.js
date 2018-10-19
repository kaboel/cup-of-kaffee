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
                    alert(_e);
                }
            }
        });
    });
});

$(function(_e){
    $("#logoutTrig").on('click', function(_e){
        _e.preventDefault();
        var exec = "logoutReq";

        $.ajax({
            type:   "POST",
            data:   "exec="+exec,
            url:    '../lib/handler',
            success: function(_e){
                if(_e == true) {
                    location.reload(true);
                } else {
                    alert("Server Error. Cannot Logout.");
                }
            }
        });
    });
});

// OTHER
function reset() {
    $("input[type='text']").val("");
    $("input[type='password']").val("");
}