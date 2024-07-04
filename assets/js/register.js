// show and hide register form

function show_reg_form(){
    document.querySelector(".reg_form").classList.add("show_register_form");
    document.querySelector(".creat_account").classList.add("hide_creat_account");
}

function close_register_form(){
    document.querySelector(".reg_form").classList.remove("show_register_form");
    document.querySelector(".creat_account").classList.remove("hide_creat_account");
}