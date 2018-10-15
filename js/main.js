//
//  * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
//  * Copyright 2018 faiq.kaboel@gmail.com | In Effect
//

// MAIN REMOTE 


// ADMIN REMOTE
function loadLoginAdm() {
    $("#Contadmin").load("login.php");
}
function loadMainAdm() {
    $("#Contadmin").load("main.php");
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
            url:    '../lib/handler.php',
            success: function(_e) {
                reset();
                location.reload();
                alert(_e);
            }
        });
    });
});

$(function(_e){
    $("button[name='logout']").on('click', function(_e){
        _e.preventDefault();
        var exec = "logoutReq";

        $.ajax({
            type:   "POST",
            data:   "exec="+exec,
            url:    '../lib/handler.php',
            success: function(_e){
                location.reload();
                alert(_e);
            }
        });
    });
});

// OTHER
function reset() {
    $("input[type='text']").val("");
    $("input[type='password']").val("");
}