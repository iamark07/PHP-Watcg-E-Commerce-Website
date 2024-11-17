// show and hide register form

function show_log_form(){
    document.querySelector(".log_form").classList.add("show_login_form");
    document.querySelector(".sign_in_account").classList.add("hide_log_account");
}

function close_log_form(){
    document.querySelector(".log_form").classList.remove("show_login_form");
    document.querySelector(".sign_in_account").classList.remove("hide_log_account");
}

function show_pass(){
    document.querySelector("#pass").setAttribute("type", "text");
    document.querySelector(".pass_icon_show").classList.add("hide_pass_icon");
    document.querySelector(".pass_icon_hide").classList.add("show_pass");
}

function hide_pass(){
    document.querySelector("#pass").setAttribute("type", "password");
    document.querySelector(".pass_icon_show").classList.remove("hide_pass_icon");
    document.querySelector(".pass_icon_hide").classList.remove("show_pass");
}