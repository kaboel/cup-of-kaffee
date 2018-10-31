//
//  * cupofkaffee v.1 (https://github.com/kaboel/cupofkaffee)
//  * Copyright 2018 faiq.kaboel@gmail.com | In Effect
//

// MAIN REMOTE 



// ADMIN INDEX REMOTE
function loadAdm(target) {
    $("#admIdx").empty().load(target);

    return false;
}

// ADMIN PAGES REMOTE
function __loadMenu() {
    var exec = "loadMenu";
    var cont = $("#mainMenu");

    $.ajax({
        type: 'GET',
        data: 'exec='+exec,
        url:  '../lib/handler',
        success : function(_e) {
            var obj = JSON.parse(_e);
            var list = "";
            $.each(obj, function(_key, _val) {
                var strid = _val['STR_ID'];
                var title = _val['TITLE'];
                var icon  = _val['ICON'];
                var trig  = "__loadSubMenu("+ _val['ID_MENU'] +")";
                if(_val['ID_MENU'] <= 1) {
                    trig  = "__loadPage("+ _val['ID_MENU'] +")";
                }
                list += "<li id='"+ strid +"' onclick='"+ trig +"'  title='"+ title +"'>"
                     +      "<i class='"+ icon +"'></i>"
                     +  "</li>"; 
            });
            cont.empty().append(list);
        }
    });

    return false;
}
function __loadSubMenu(parent) {
    var exec = "loadSub";
    var cont = $("#subMenu");

    $.ajax({
        type : 'GET',
        data : 'exec='+exec+'&parent='+parent,
        url  : '../lib/handler',
        success : function(_e) {
            if(_e != "0") {
                var obj = JSON.parse(_e);
                var list = "";
                $.each(obj, function(_key, _val) {
                    var strid = _val['STR_ID'];
                    var title = _val['TITLE'];
                    var trig  = "__loadPage("+ _val['ID_MENU'] +")";
                    list += "<li id='"+ strid +"' onclick='"+ trig +"'  title='"+ title +"'>"
                         +      title
                         +  "</li>";
                });
                cont.empty().append(list);
                openSub();
            } else { dismissSub(); }
        }
    });

    return false;
}
function __loadPage(pgid) {
    dismissSub();
    var exec = "loadPage";
    var cont = $("#admPgs");
    cont.fadeOut('300');
    
    $.ajax({
        type: 'GET',
        data: 'exec='+exec+'&pgid='+pgid,
        url : '../lib/handler',
        success : function(_e){
            if(_e != "0") {
                var obj   = JSON.parse(_e);
                var path  = obj['PG_PATH'];
                var partl = obj['PAR_TITLE'];
                var subtl = obj['SUB_TITLE'];
                var subid = obj['SUB_STRID'];
                setTimeout( function() {
                    cont.load(path+"/", function() {
                        $( this ).fadeIn('300');
                    });
                }, 300);
            }
        }
    });

    return false;
}

// ADMIN EXECS
// --> Session Controls
// Login
function loginExec() {
    var exec = "loginReq";

    var user = $("#user").val();
    var pass = $("#pass").val();
    
    if(verFrm("login")) {
        $.ajax({
            type:   'GET',
            data:   'exec='+exec+'&user='+user+'&pass='+pass,
            url:    '../lib/handler',
            success : function(_e) {
                clrFrm("login");
                if(_e == "1") {
                    location.reload();
                } else {
                    msgOut(
                        "loginMsg",         // Target Container
                        "danger",           // Alert Type
                        "Login Failed ! ",  // Strong (Output)
                        _e                  // Details (Output)
                    );
                }
            }
        });
    } else {
        msgOut(
            "loginMsg", 
            "warning", 
            "Couldn't Proceed !", 
            "Please fill all the blanks."
        );
    }

    return false;
}

// Logout
function logoutExec() {
    var exec = "logoutReq";
    
    var obj = "<div> You sure you want to go ? </div>";
    $(obj).dialog({
        modal: true,
        resizable: false,
        draggable: false,
        title : ".barista.",
        open: function() {
            $('.ui-widget-overlay').click(function(){
                $( this ).dialog( "close" );
            })
        },
        buttons: [
            {
                text: "Yes, Log Me Out",
                click: function(_e) {
                    $.ajax({
                        type:   'GET',
                        data:   'exec='+exec,
                        url :    '../lib/handler',
                        success : function(_e){
                            if(_e == "1") {
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
        position: { my: "center", at: "top+25%" }
    });

    return false;
}

// INDIVIDUAL PAGES REMOTES AND EXECS



// OTHER(S)
function active(param) {
    if($("#"+param).hasClass( "active" )) {
        $("#"+param).removeClass( "active" );
    } else {
        $("#"+param).addClass( "active" );
    }
}

function dismissSub() {
    if($("#subContainer").hasClass( "menu-collapse" )) {
        $("#subContainer").removeClass( "menu-collapse" );
    }

    return false;
}
function openSub() {
    if(!$("#subContainer").hasClass( "menu-collapse" )) {
        $("#subContainer").addClass( "menu-collapse" );
    }

    return false;
}

// $(function(_e) {
//     $( document ).tooltip({    
//         position: { my: "left center", at: "right center" },
//         show: { effect: "fadeIn", duration: 200 },
//         hide: { effect: "fadeOut", duration: 200 },
//         open: function (event, ui) {
//             var $elem = $(event.target);
//             this.click(function () {
//                 $elem.tooltip('close');
//             });
//         },
//     });
// });

function verFrm(type) {
    switch(type) {
        case "login" : 
            var user = $("input[type='text']").val();
            var pass = $("input[type='password']").val();
            if(user != "" && pass != "") {
                return true;
            } else {
                return false;
            }
        break;
    }

    return false;
}

function clrFrm(type) {
    switch(type) {
        case "login" : 
            $("input[type='text']").val("");
            $("input[type='password']").val("");
        break;
    }

    return false;
}

function msgOut(target, type, info, msg) {
    var box = $("#"+target);
    var icon = "";
    switch(type) {
        case "danger" :
            type = "alert-danger";
            icon = "fas fa-times-circle";
        break;
        case "warning" :
            type = "alert-warning";
            icon = "fas fa-exclamation-circle";
        break;
        case "success" :
            type = "alert-success";
            icon = "fas fa-check-circle";
        break;
    }
    var obj =    "<div class='alert "+ type +" alert-dismissible fade show gap-20' role='alert'>"
                +"  <div>"
                +"     <i class='"+ icon +"'></i>&nbsp;"
                +"     <strong>"+ info +"</strong></br>"
                +"     <span>"+ msg +"</span>"
                +"  </div>"
                +"  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
                +"      <span aria-hidden='true'>&times;</span>"
                +"  </button>"
                +"</div>";
    box.empty().append(obj).show();

    return false;
}