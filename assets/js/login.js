// show and hide register form

function show_log_form(){
    document.querySelector(".log_form").classList.add("show_login_form");
    document.querySelector(".sign_in_account").classList.add("hide_log_account");
}

function close_log_form(){
    document.querySelector(".log_form").classList.remove("show_login_form");
    document.querySelector(".sign_in_account").classList.remove("hide_log_account");
}