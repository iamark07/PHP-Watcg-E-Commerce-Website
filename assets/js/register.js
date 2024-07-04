// show and hide register form

function show_reg_form(){
    document.querySelector(".reg_form").classList.add("show_register_form");
    document.querySelector(".creat_account").classList.add("hide_creat_account");
}

function close_register_form(){
    document.querySelector(".reg_form").classList.remove("show_register_form");
    document.querySelector(".creat_account").classList.remove("hide_creat_account");
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