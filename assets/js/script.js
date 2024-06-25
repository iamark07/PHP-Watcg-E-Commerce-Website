// menu slider function

// open menu funtion

let open_menu_btn = document.getElementById("open_menu_btn");

open_menu_btn.addEventListener("click" , ()=> {
    document.querySelector(".menu_slider").classList.add("open_menu_active");
})

// close menu function

let close_menu_btn = document.getElementById("close_menu_btn");

close_menu_btn.addEventListener("click" , ()=> {
    document.querySelector(".menu_slider").classList.remove("open_menu_active");
})
let show_all_menu_icon = document.querySelector(".show_all_menu_icon");

show_all_menu_icon.addEventListener("click" , ()=> {
    document.querySelector(".mob_all_nav_show").classList.toggle("all_nav_show_hide");
    document.querySelector(".show_all_menu_icon").classList.toggle("show_all_menu_active");
    document.querySelector(".mob_nav_container").classList.toggle("mob_nav_container_active");
});