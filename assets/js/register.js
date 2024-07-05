// show and hide register form

function show_reg_form(){
    document.querySelector(".reg_form").classList.add("show_register_form");
    document.querySelector(".creat_account").classList.add("hide_creat_account");
}

function close_register_form(){
    document.querySelector(".reg_form").classList.remove("show_register_form");
    document.querySelector(".creat_account").classList.remove("hide_creat_account");
}

// for hide show password

document.querySelectorAll(".pass_icon_show").forEach(show_pass =>{
    show_pass.addEventListener("click", ()=>{
        show_pass.classList.add("hide_pass_icon");
        let input_pass = show_pass.previousElementSibling;
        let pass_icon_hide = show_pass.nextElementSibling;
        pass_icon_hide.classList.add("show_pass");
        input_pass.setAttribute("type", "text");
    });
});

document.querySelectorAll(".pass_icon_hide").forEach(hide_pass =>{
    hide_pass.addEventListener("click", ()=>{
        let show_pass_icon = hide_pass.previousElementSibling;
        show_pass_icon.classList.remove("hide_pass_icon");
        let input_pass = hide_pass.previousElementSibling.previousElementSibling;
        hide_pass.classList.remove("show_pass");
        input_pass.setAttribute("type", "password");
    });
});